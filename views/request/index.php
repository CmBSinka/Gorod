<?php

use app\models\Request;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RequestSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'id',
        ['attribute'=>'Описание заявки', 'value'=> function($data){return $data->getRequest()->One()->request_name;}],
        ['attribute'=>'Описание заявки', 'value'=> function($data){return $data->getRequest()->One()->request_description;}],
        //'category_id',
        //'user_id',
        ['attribute'=>'Фото', 'format'=>'html', 'value'=> function($data){return "<img src='{$data->photo}' alt='photo' style='width: 70px;'>";}],
        //'photo_after',
        'data',
        //'status',
        //'reason',
    ],
]); ?>


</div>
