<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'My Status';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-index">

    <div class="jumbotron">
    <?php $form = ActiveForm::begin(['id' => 'status-form']);
            ?>
        <div class="form-group">
                    <?= Html::submitButton($mystatus, ['value'=>'submit','disabled' => $myread,'class' => 'btn btn-primary', 'name' => 'status-button','style'=>['width'=>'300px','border-color'=>'black','background-color'=>$mystat]]) ?>
                </div>

    <?php ActiveForm::end(); ?>


        <h1>Total <span style="color: #ea7c09;"><?php echo $present; ?></span>/<span style="color: #096db7;"><?php echo $total; ?></span></h1>

        <p class="lead">My Attendance.</p>

    </div>

    <div class="body-content">

        <div class="row">
        <div class="col-lg-1"></div>
            <div class="col-lg-2">
                <h2>Leave</h2>
                <h1><?php echo $absent; ?></h1>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-2">
                <h2>Sick</h2>
                <h1><?php echo $sick; ?></h1>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-2">
                <h2>Present</h2>
                <h1><?php echo $present; ?></h1>                               
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-2">
                <h2>Total</h2>
                <h1><?php echo $total; ?></h1>                               
            </div>
            
        </div>
        
    </div>
   


    






</div>

