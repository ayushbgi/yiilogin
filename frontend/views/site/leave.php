<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;


$this->title = 'Leave';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-leave-create">
    <h1>Apply for <?= Html::encode($this->title) ?>, <?= ucfirst(Yii::$app->user->identity->username) ?>!</h1>

    <p>
        If you have any inquiries or other questions, please contact Reception desk . Thank you!
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'leave-form']);
            ?>
             
                <?= $form->field($model, 'demo')->textInput(['readonly' => true,'value'=>Yii::$app->user->identity->id])->label('My Id') ?>

                <?= $form->field($model, 'sub')->textInput(['autofocus' => true,'placeholder'=>'Subject','value'=>$editsub])->label('Subject') ?>
                
                <?= $form->field($model, 'brief')->textarea(['rows' => 6,'placeholder'=>'Brief Description','value'=>$editbrief])->label('Brief') ?>

                
                <div class="form-group">
                    <?= Html::submitButton('Save', ['value'=>$leaveid,'class' => 'btn btn-primary', 'name' => 'leave-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'leave-form1']);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'leave_id',
            'sub',
            'brief',
           // 'status',
            [
                'class' => 'yii\grid\DataColumn',
                'label' =>'Status',
                'value' => function($model)
                            {
                                if($model->status==0)
                                {
                                    return "Pending.";
                                }
                                if($model->status==1)
                                {
                                    return "Confirm.";
                                }
                                if($model->status==3)
                                {
                                    return "Rejected.";
                                }
                            }
            ],
            [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'label' => 'Action',
                //'value' => function(){return "";},
                'content' => function($model) 
                { 
                    if($model->status==0)
                    {
                        return Html::submitButton('Edit', ['value'=> $model->leave_id,'class' => 'btn btn-warning btn-xs btn-block','name' => 'edit'])."   ". Html::submitButton('Delete', ['value'=> $model->leave_id,'class' => 'btn btn-danger btn-xs btn-block','name' => 'delete']);
                    }
                    if($model->status==1)
                    {
                        return Html::submitButton('Confirmed', ['class' => 'btn btn-success btn-xs btn-block','disabled'=>true]);
                    }
                    if($model->status==3)
                    {
                        return Html::submitButton('Rejected', ['class' => 'btn btn-danger btn-xs btn-block','disabled'=>true]);
                    }
                } ,
               
            ],
            
           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php ActiveForm::end(); ?>
        </div>
    </div>
    <script>
$( document ).ready(function() {
    if(<?php echo $leaveid; ?>!=1)
    $("table [data-key=<?php echo $leaveid; ?>]").css("background-color", "#ea7c092e");
    $("tr [value=<?php echo $leaveid; ?>]").attr('disabled', 'disabled');
    //alert($("tr").attr("data-id"));.removeClass().addClass('btn btn-xs')
    //document.getElementById('id1').bgColor = '#ea7c092e';
});
</script>
 
</div>


