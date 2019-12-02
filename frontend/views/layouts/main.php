<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="images/tlogo.png" />
    <script src="js/jquery-3.4.1.min.js"></script>
    <?php $this->head() ?>
    <style>
    .dropdown-menu li a{ padding: 10px 20px;;
                    padding-top: 5px;
    }
    .dropdown-menu{
        padding:0;
        padding-top: 5px;
    }
    </style>
    
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        //'brandUrl' => Yii::$app->homeUrl,
        'brandUrl' => Yii::$app->user->isGuest ? (['index']) : (['my']),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
       /*  ['label' => 'Dropdown',
            'items' => [
                 ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                 '<li class="divider"></li>',
                 '<li class="dropdown-header">Dropdown Header</li>',
                 ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
            ]], */
    ];
    if (Yii::$app->user->isGuest) {
        array_push($menuItems , ['label' => 'Signup', 'url' => ['/site/signup']],
         ['label' => 'Login', 'url' => ['/site/login']]
            );
    } else {
        $menuItems = [
        ['label' => 'My', 'url' => ['/site/my']],
        ['label' => 'Status', 'url' => ['/site/status']],
        ['label' => 'Leave', 'url' => ['/site/leave']],
        ['label' => ucfirst( Yii::$app->user->identity->username),
            'items' => [
                 ['label' => 'Update Password', 'url' => '#'],
                // '<li class="dropdown-header">Dropdown Header</li>',
                 ['label' => 'Update Profile', 'url' => '#','options'=>['class' => 'logout btn-block text-body m-5']],
               //  '<li class="divider"></li>',
                  '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout',
                ['class' => 'btn-danger  logout btn-block text-body']
            )
            . Html::endForm()
            . '</li>',
            ]],
    ];
        /* $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'; */
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <div>
        <?= Html::img('images/logo.png', ['alt'=>'Logo', 'class'=>'thing', 'width'=>250]) ?>
      </div><br>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name; ?> <?= date('Y') ?></p>

<!--        <p class="pull-right"><?= Yii::powered() ?></p>-->
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script>

$('#w1-success-0').delay(5000).fadeOut(500); 
$('#w2-success-0').delay(5000).fadeOut(500); 
$('#w3-success-0').delay(5000).fadeOut(500);

</script>

<!--$('#w2-success-0').delay(15000).attr('class', 'alert-success alert fade out'); 
    
   alert-success alert fade in -->

