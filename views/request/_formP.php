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

    <?= $model->status=='Новая' ? $form->field($model, 'photo_after')->fileInput(['required'=>true]) : $form->field($model, 'photo_after')->fileInput(['required'=>false]) ?>

    <!--<?= $form->field($model, 'data')->textInput() ?>-->

     <?= $model->status=='Новая' ? $form->field($model, 'status')->dropDownList([ 'Новая' => 'Новая', 'Решенная' => 'Решенная', 'Отклоненная' => 'Отклоненная', ], ['prompt' => '', 'disabled'=>false]): 
       $form->field($model, 'status')->dropDownList([ 'Новая' => 'Новая', 'Решенная' => 'Решенная', 'Отклоненная' => 'Отклоненная', ], ['prompt' => '', 'disabled'=>true])?>

    <?= $model->status=='Новая' ? $form->field($model, 'reason')->textInput(['required'=>true]) : $form->field($model, 'reason')->textInput(['required'=>false]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
