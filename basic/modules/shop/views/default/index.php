<?php

use app\modules\shop\models\ProductsSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\shop\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('MyCart', ['/shop/default/mycart'], ['class'=>'btn btn-primary']) ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'header' => '№'
            ],

            'title',
            'price',
            'description:ntext',
            [
                'attribute' => 'price_to',
                'value' => function ($data) {
                    return $data->price_to." ".$data->type->title;
                }

            ],
            [
                'attribute' => 'category',
                'value' => function ($model) {
                    return implode(', ', \yii\helpers\ArrayHelper::map($model->category, 'id', function ($model) {
                        return $model->title;
                    }
                    ));
                },
                'format' => 'html'

            ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{addtocart}',  // the default buttons + your custom button
            'buttons' => [
                'addtocart' => function ($url) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-check"></span>',
                        $url,
                        [
                            'title' => 'Добавить',
                            'data-pjax' => '0',
                            'data-confirm' => Yii::t('yii', 'Действительно хотите добавить корзинку?'),
                            'data-method' => 'post',
                        ]
                    );
                },
            ]
        ]



//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
