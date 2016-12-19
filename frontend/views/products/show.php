<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Link',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a('Click', $data->link);
            },
        ],
        'buy',
        'sell',
        'diff',
        'sold',
        'avg',
        [
            'label' => 'Refresh',
            'format' => 'raw',
            'value' => function($data) {
                return Html::a('Refresh', 'refresh?id=' . $data->id);
            }
        ]
    ],
]);
?>
    <div class="products-show">

