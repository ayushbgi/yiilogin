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

                <?= $form->field($model, 'sub')->textInput(['autofocus' => true,'placeholder'=>'Subject'])->label('Subject') ?>
                
                <?= $form->field($model, 'brief')->textarea(['rows' => 6,'placeholder'=>'Brief Description'])->label('Brief') ?>

                
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'leave-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
 <br><br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'leave_id',
            'sub',
            'brief',
            'status',
            [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'label' => 'Action',
                //'value' => function(){return "";},
                'content' => function() { return Html::a('Edit', ['site/index'], ['class' => 'btn btn-success btn-xs'])."   ". Html::a('Delete', ['site/index'], ['class' => 'btn btn-danger btn-xs']); } ,
               
            ],
            
           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

