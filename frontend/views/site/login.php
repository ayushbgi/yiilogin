<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'User Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <div style="color:#999;margin:1em 0">
                    <?= Html::a('Forgot Password', ['site/request-password-reset']) ?>.
                    <br>
                  <?= Html::a('Resend verification email? ', ['site/resend-verification-email']) ?>
                  <br><br>
                  <?= Html::a('Dont have account? Signup ! ', ['signup']) ?>
                  
                </div>

                

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
