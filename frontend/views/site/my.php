<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome back, <?= ucfirst(Yii::$app->user->identity->username) ?>!</h1>


        <p class="lead"><?= Yii::$app->name; ?> Intr@Net.</p>

        
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 text-center">
                <h2>Yesterday</h2>

                <p><?php echo $yesterday;?></p>

                <p"><a class="btn btn-default" href="http://www.yiiframework.com/doc/">&laquo; Previous </a></p>
            </div>
            <div class="col-lg-4 text-center">
                <h2>Today</h2>

                <p><?php echo $today;?></p>

                <p"><a class="btn btn-default" href="http://www.yiiframework.com/forum/">&laquo; Explore &raquo;</a></p>
            </div>
            <div class="col-lg-4 text-center">
                <h2>Tomorrow</h2>

                <p><?php echo $tomorrow;?></p>

                <p"><a class="btn btn-default" href="http://www.yiiframework.com/extensions/"> &nbsp; Next &nbsp;&nbsp; &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
