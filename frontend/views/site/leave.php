<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Leave';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1>Apply for <?= Html::encode($this->title) ?>, <?= ucfirst(Yii::$app->user->identity->username) ?>!</h1>

    <p>
        If you have any inquiries or other questions, please contact Reception desk . Thank you!
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'leave-form']); ?>

                <?= $form->field($model, 'subject')->textInput(['autofocus' => true,'placeholder'=>'Subject']) ?>
                
                <?= $form->field($model, 'body')->textarea(['rows' => 6,'placeholder'=>'Brief Description'])->label('Brief') ?>

                
                <div class="form-group">
                    <?= Html::submitButton('Apply Leave', ['class' => 'btn btn-primary', 'name' => 'leave-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
