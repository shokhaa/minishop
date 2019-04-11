<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\shop\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <?
    echo kartik\select2\Select2::widget([
        'name' => 'category',
        'data' => $category,
        'value' => isset($selectedCategory) ? $selectedCategory : '',
        'options' => [
            'placeholder' => 'Select category ...',
            'multiple' => true,
            'required' => true
        ],
        'pluginOptions' => [
            'closeOnSelect' => false

        ],
    ]);

    ?>
    <div class="info" style="margin-top: 15px">
<div style="display: flex">
    <input class="form-control" placeholder="product info name" type="text" name="info[0][name]">
    <input class="form-control" type="text"  placeholder="product info value" name="info[0][value]">
</div>

    </div>

    <br>
    <div onclick="addInputForm();" class="dobavit">Add more info</div>
    <br>
<!--    --><?//= $form->field($model, 'price_to')->textInput() ?>
<!--    --><?//= $form->field($model, 'type_id')->widget(kartik\select2\Select2::classname(), [
//        'data' => $type,
//        'value' => '2',
//        'language' => 'ru',
//        'options' => ['placeholder' => 'Select a state ...', 'value' => $model->type_id],
//        'pluginOptions' => [
//            'allowClear' => true
//        ],
//    ]);
//    ?>
    <?= $form->field($uploadPhotoProduct, 'file[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
