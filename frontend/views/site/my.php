<?php

/* @var $this yii\web\View */
use yii\grid\GridView;

$this->title = 'My Yii Application';
//echo Yii::$app->view->id;
// echo $this->context->action->id;
// exit;
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

                <!-- <p"><a id="show" class="btn btn-default" >&laquo; Previous </a></p> -->
            </div>
            <div class="col-lg-4 text-center">
                <h2>Today</h2>

                <p><?php echo $today;?></p>

                <p"><a id="show" class="btn btn-default" >&laquo; Explore &raquo;</a></p>
            </div>
            <div class="col-lg-4 text-center">
                <h2>Tomorrow</h2>

                <p><?php echo $tomorrow;?></p>

                <!-- <p"><a id="show" class="btn btn-default" > &nbsp; Next &nbsp;&nbsp; &raquo;</a></p> -->
            </div>
        </div>

    </div>
</div>
<br><br><br>
<div id="showit" style="display:none">
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'leave_id',
            'date',
            'task',
            'status',
           // 'status',
           
           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
    <script>
        $( document ).ready(function() {
    //document.getElementById('w0').style.display = "none";
    
    $("div [id=show]").click(function(){
        document.getElementById("showit").removeAttribute("style");
        //$("div showit").removeAttribute("style");
});
         });
    </script>
