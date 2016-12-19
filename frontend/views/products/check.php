<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;

echo "<pre>";
var_dump($dataProvider);
echo "</pre>";

?>

<?//=  GridView::widget([
//    'dataProvider' => $dataProvider,
//    'filterModel' => $searchModel,
//    'columns' => [
//        ['class' => 'yii\grid\SerialColumn'],
//        [
//            'label'=>'Products',
//            'format' => 'raw',
//            'value'=>function ($data) {
//                return Html::a($data->link, $data->link);
//            },
//        ],
//        ['class' => 'yii\grid\ActionColumn',
//            'template' => '{update}{delete}',
//        ],
//    ],
//]); ?>