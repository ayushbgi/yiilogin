<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


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

</div>
