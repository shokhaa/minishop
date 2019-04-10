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


    <?= $form->field($model, 'price_to')->textInput() ?>
    <?= $form->field($model, 'type_id')->widget(kartik\select2\Select2::classname(), [
        'data' => $type,
        'value' => '2',
        'language' => 'ru',
        'options' => ['placeholder' => 'Select a state ...', 'value' => $model->type_id],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
