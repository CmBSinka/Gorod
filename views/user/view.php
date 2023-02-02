<?php

use app\models\Category;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Request;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$requests=Request::find()->where(['user_id'=>Yii::$app->user->identity->id])->orderBy(['data'=>SORT_DESC])->all();
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
    <h4>Фильтрация</h4>
    <div class="dropdown">


    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Выберите статус
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <?php
            $items='';
            foreach ($requests as $request)  {
                $items .= " <li><a class='dropdown-item' href='/request/index?RequestSearch[status]={$request->status}&[user_id]={$request->user_id}'>$request->status</a></li>";
            }
            echo $items;

            ?>
        </ul>
    </div>

</div>
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
//$categoria = Category::find()->all();
foreach ($requests as $request) 
{
    echo "<tr>";
            echo "<td>" .  $request->getRequest()->one()->data ."</td>";
            echo "<td>" .  $request->getRequest()->one()->request_name ."</td>";
            echo "<td>" .  $request->getRequest()->one()->request_description ."</td>";
            echo "<td>" .  $request->getCategory()->one()->name ."</td>";
            echo "<td>" .  $request->status ."</td>";
            ?> <td>
            <?php
            if ($request->status == 'Новая') {
                echo
                    Html::a('☓', ['../request/delete', 'id' => $request->getRequest()->one()->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Вы уверены что хотите удалить заявку?',
                            'method' => 'post',
                        ],
                    ]);
            }
            ?>
        </td>
        <?php
    echo "</tr>";
}
 ?>
        </tbody>
    </table>
</div>
