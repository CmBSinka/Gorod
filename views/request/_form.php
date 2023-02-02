<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Request $model */
/** @var yii\widgets\ActiveForm $form */
$li=[]; $requests=\app\models\Request::find()->all();
 foreach ($requests as $request)
{ 
$li[$request->id]=$request->request_name; 
}
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'request_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($li)?>

    <!-- <?= $form->field($model, 'user_id')->textInput() ?>-->

    <?= $form->field($model, 'photo')->fileInput() ?>

    <!--<?= $form->field($model, 'data')->textInput() ?>-->

    <!-- <?= $form->field($model, 'status')->dropDownList([ 'Новая' => 'Новая', 'Решенная' => 'Решенная', 'Отклоенная' => 'Отклоенная', ], ['prompt' => '']) ?>-->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
