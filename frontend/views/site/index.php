<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Home';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Hii!</h1>

        <p class="lead">Welcome to <?= Yii::$app->name; ?>.</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
                <h2><?= Html::img('images/1.png', ['alt'=>'Logo', 'class'=>'thing', 'width'=>200]) ?></h2>

                <p>The Joint Supplier Registration System (JSRS), 
                    an industry wide procurement system, is a 'single window' 
                    supplier registration and certification system.<p>

                <p><a class="btn btn-default" target="_blank" href="https://businessgateways.com/joint-supplier-registration-system">Read more &raquo;</a></p>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-3">
                <h2><?= Html::img('images/2.png', ['alt'=>'Logo', 'class'=>'thing', 'width'=>85]) ?></h2>

                <p>The National Business Framework (NBF) is a 
                    'B2B stimulation' platform equipped with multiple 
                    proactive B2B tools to connect with companies across 
                    the globe.</p>

                <p><a class="btn btn-default" target="_blank" href="https://businessgateways.com/national-business-framework">Read more &raquo;</a></p>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-3">
                <h2><?= Html::img('images/globeconnect.svg', ['alt'=>'Logo', 'class'=>'thing', 'width'=>250]) ?></h2>
                <br><br>
                <p>Globe Connect, a <?= Yii::$app->name; ?> initiative, 
                    is a one-stop platform for international companies 
                    that need critical information to set up business in Oman.</p>

               
            </div>
        </div>

    </div>
</div>
