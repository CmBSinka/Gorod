<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Request;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1>Личный кабинет</h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'FIO',
            'login',
            'email:email',
            //'password',
            //'is_admin',
        ],
    ]) ?>
    <h2>Мои заявки</h2>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Дата</th>
            <th scope="col">Имя</th>
            <th scope="col">Описание</th>
            <th scope="col">Категория</th>
            <th scope="col">Статус</th>
            <th scope="col">Управление</th>
        </tr>
        </thead>
        <tbody>
            
<?php
  $requests=\app\models\Request::find()->where(['user_id'=>Yii::$app->user->identity->id])->all();
foreach ($requests as $request) {
    echo "<tr>";
            echo "<td>" .  $request->getRequest()->one()->data ."</td>";
            echo "<td>" .  $request->getRequest()->one()->request_name ."</td>";
            echo "<td>" .  $request->getRequest()->one()->request_description ."</td>";
            echo "<td>" .  $request->getRequest()->one()->category_id ."</td>";
            echo "<td>" .  $request->status ."</td>";
            ?> <td>
            <?= Html::a('☓', ['../request/delete', 'id' => $request->getRequest()->one()->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить заявку?',
                'method' => 'post',
            ],
        ]) ?>
        </td>
        <?php
    echo "</tr>";
}
 ?>
        </tbody>
    </table>
</div>
