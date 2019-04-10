<?php
/**
 * Created by PhpStorm.
 * User: Shokhaa
 * Date: 4/10/19
 * Time: 12:03 PM
 */


use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Carts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

<table class="table table-bordered">
<th>№</th>
<th>Product name</th>
<th>Quantity</th>
    <?
    $i = 0;
    foreach ($model as $item) {
        $i++;
    echo "<tr>";
    echo "<td>{$i}</td>";
    echo "<td><a href='/shop/products/view?id={$item['product_id']}'>{$item['product']['title']}</a></td>";
    echo "<td>{$item['qty']}</td>";

    }
    ?>
</table>

</div>