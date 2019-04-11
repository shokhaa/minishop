<?php
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\shop\models\Products */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'price',
            'description:ntext',
            [
             'attribute' => 'price_to',
             'value' => function($data){
        return $data->price_to." ".$data->type->title;

}
],
        ],
    ]) ?>



    <table class="table table-bordered">
        <?
        $i = 0;
        foreach ($productInfo as $item) {
            $i++;
            echo "<tr>";
            echo "<td>{$item['info_name']} : <b>{$item['info_value']}</b></td>";
            echo "</tr>";

        }
        ?>
    </table>

    <?php
    foreach ($productImages as $images) {
        echo Html::img("/uploads/product/" . $images['name'], ['width' => '200', 'height' => '100']);
//        echo Html::a('Delete', '/admin/objects/delimg?id='.$imagesObject['id'])." | ";


    }

    ?>

</div>
