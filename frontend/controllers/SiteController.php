<?php

namespace frontend\controllers;


use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\UserLeave;
use frontend\models\UserStatus;
use app\models\AdminSearch;
use app\models\TaskSearch;
use app\models\UserReset;
use yii\web\NotFoundHttpException;
date_default_timezone_set('Asia/Kolkata');

//use app\models\UserLeave;
use app\models\UserLeaveForm;
use app\models\UserTask;
use PHP_Token_WHERE;
use yii\db\Query;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
          return $this->render('index');}
        else {
        return $this->redirect(['my']);}
    }


    public function actionStatus()
    {
           
        if (Yii::$app->user->isGuest) {
            return $this->goHome(); }
        else {
            

            $status = UserStatus::find()
            ->where(['user_id'=>Yii::$app->user->identity->id])
            ->all();
            $total=0;
            $present=0;
            $sick=0;
            $absent=0;
            $check=1;
            $mystatus="Report Present"; $mystat="Red"; $myread=false; 
            foreach($status as $count) {
                if($count['status']!=3)
                {
                    $total++;
                }
                if($count['status']==2)
                {
                    $present++;
                }
                if($count['status']==1)
                {
                    $sick++;
                }
                if($count['status']==0)
                {
                    $absent++;
                }
                if($count['date']==date("Y-m-d"))
                {
                    $check=0;
                    switch($count['status']){

                        case 0 : $mystatus="Report Present"; $mystat="Red"; $myread=false; $check=1; break;
                        case 1 : $mystatus="Sick Leave"; $mystat="Yellow"; $myread=true; $check=0; break; 
                        case 2 : $mystatus="Present"; $mystat="Green"; $myread=true; $check=0; break;
                        case 3 : $mystatus="Waiting Confirmation"; $mystat="Orange"; $myread=true; $check=0; break;
                        default : $mystatus="Report Present"; $mystat="Red"; $myread=false; $check=1;
                    }
        
                }
            }

            
            $model = new UserStatus();
            if ((Yii::$app->request->post('status-button')) && $check==1) {
                $model->user_id=Yii::$app->user->identity->id;
                $model->date=date("Y-m-d");
                $model->status=3;
                $model->subject="Blah";
                $model->save();
                Yii::$app->session->setFlash('success', 'You are Present! Witing for conformation.');
                return $this->redirect(['status']);
            }
           
        return $this->render('status',array('absent'=>$absent,'sick'=>$sick,'present'=>$present,'total'=>$total,'mystatus'=>$mystatus,'mystat'=>$mystat,'myread'=>$myread)); }
    }
    
       
    public function actionMy()
    {
        if (Yii::$app->user->isGuest) {
          return $this->goHome();
      }
      else {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('user_id = :id' , array(':id'=>Yii::$app->user->identity->id));

        $model =  UserTask::find()
        ->where(['user_id'=>Yii::$app->user->identity->id])
        ->all();
        $today="";$yesterday="";$tomorrow="";
        foreach($model as $date){
           
            if(date("Y-m-d")==$date['date']){
                $today=$date['task'];
            }
            if(date("Y-m-d", strtotime( '-1 days' ))==$date['date']){
                $yesterday=$date['task'];
            }
            if(date("Y-m-d", strtotime( '+1 days' ))==$date['date']){
                $tomorrow=$date['task'];
            }
        }
        
        return $this->render('my',[
             'today' => $today,
             'yesterday'=> $yesterday,
             'tomorrow' => $tomorrow,
             'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
        
    }
    
    public function actionLeave()
    {
        
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        else {
            $searchModel = new AdminSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andWhere('user_id = :id' , array(':id'=>Yii::$app->user->identity->id));

            $model = new UserLeave();
            if(Yii::$app->request->post('leave-button')==1){
            
            $model->user_id = Yii::$app->user->identity->id;
            $model->status = 0;
            $model->leave_id='';
                       
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Leave received! We will respond to you for conformation.');
                return $this->redirect(['leave']);
            }}
            
            if (Yii::$app->request->post('delete')) {
                $delid=Yii::$app->request->post('delete');
                $deletemodel = UserLeave::find()
                 ->where(['leave_id'=>$delid])
                 ->one()
                 ->delete();

                 Yii::$app->session->setFlash('success', 'Leave Deleted!');
                 return $this->redirect(['leave']);
            }
                
            if(Yii::$app->request->post('leave-button')!=null && Yii::$app->request->post('leave-button')!=1){
            
                
                $model1 = UserLeave::findOne(Yii::$app->request->post('leave-button'));
               
                
                if ($model1->load(Yii::$app->request->post()) && $model1->save()) {
                    Yii::$app->session->setFlash('success', 'Leave updated! We will respond to you for conformation.');
                    return $this->redirect(['leave']);
                }
            }

            if (Yii::$app->request->post('edit')) {
                $editid=Yii::$app->request->post('edit');

                $editmodel = UserLeave::find()
                 ->where(['leave_id'=>$editid])
                 ->one();
                 $editsub=$editmodel['sub'];
                 $editbrief=$editmodel['brief'];
                        
                 return $this->render('leave',[
                     'leaveid' => $editid,
                    'editid' => $editid,
                     'editsub' => $editsub,
                     'editbrief' => $editbrief,
                     'model' => $model,
                     'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
                 ]);
            }
      
        
        

      
        return $this->render('leave', [
            'leaveid' => 1,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'editid' => '',
            'editsub' =>'',
            'editbrief' => '',
            ]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
            
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            return $this->redirect(['my']);
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionReset()
    {
    
        $model = new UserReset();
        return $this->render('reset', [
            'model' => $model,
       ]);
    }



    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
