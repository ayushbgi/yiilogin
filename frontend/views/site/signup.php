<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'User Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>



    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'id')->textInput(['autofocus' => true,'type'=>'number','placeholder'=>'Id provided'])->label('Employee Id') ?>   

                <?= $form->field($model, 'username')->textInput(['placeholder'=>'Username'])?>

                <?= $form->field($model, 'email')->textInput(['placeholder'=>'Email']) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

                <div style="color:#999;margin:1em 0">
                   
                  <?= Html::a('Already a User? Login ! ', ['login']) ?>
                  
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
