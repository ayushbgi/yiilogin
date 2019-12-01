<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserLeave */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-leave-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sub')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brief')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
