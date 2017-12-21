<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanHeaderSummaryDaily */

$this->title = 'Update Trans Penjualan Header Summary Daily: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Trans Penjualan Header Summary Dailies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-penjualan-header-summary-daily-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
