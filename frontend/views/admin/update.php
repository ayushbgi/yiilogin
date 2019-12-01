<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserLeave */

$this->title = 'Update User Leave: ' . $model->leave_id;
$this->params['breadcrumbs'][] = ['label' => 'User Leaves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->leave_id, 'url' => ['view', 'id' => $model->leave_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-leave-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
