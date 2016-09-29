<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Стоимости расходов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cost-index">

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'transaction_id',
            [
                'attribute' => 'resource_id',
                'value' => function($model) {
                    return  $model->transaction->resource->name;
                },
                'filter' => false,
            ],
            'income_id',
            'consume_amount',
            [
                'attribute' => 'consume_cost',
                'value' => function($model) {
                    return  $model->consumeCost;
                },
                'filter' => false,
            ],
            'date',

        ],
    ]); ?>

</div>
