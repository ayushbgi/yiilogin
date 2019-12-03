<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

$this->title = 'Password Reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label("Old Password") ?>

                <?= $form->field($model, 'password1')->passwordInput()->label("New Password") ?>

                <?= $form->field($model, 'password2')->passwordInput()->label("Retype Password") ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                        

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
