<?php
use app\models\Request;

/** @var yii\web\View $this */

$this->title = 'Мой город';
?>
<head>
    
<link type="image/x-icon" href="web/photo/favicon.ico" rel="shortcut icon">
<link type="Image/x-icon" href="web/photo/favicon.ico" rel="icon">

</head>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <img src='web/photo/favicon.ico' alt='image'></a>
        <h1 class="display-4">Сайт городских проблем "Мой город"</h1>

        <p class="lead">Тут вы можете оставить наши заявки для решения проблем.</p>

        
    </div>

    <div class="body-content">
   <?php 
   $requests = Request::find()->all();

foreach ($requests as $request) 
{
    if ($request->status = 'Решенная') 
    {

        echo "<div class='container py-3'>";
        echo "<div class='row-cols-1 row-cols-md-2 g-5 card-img-top hover-image-scale'  style='width: 66%; min-width: 501px;'>
 <div class='card col change-photos hover-image-scale'>
    <div class='change-photo hover-image-scale'>
 <img src='{$request->photo}' 'max-height: 400px;' alt='image'></a>
    </div>

    <div class='card-body change-photo'>
      <img src='{$request->photo_after}' alt='photo' class='hover-image-scale'>
    </div>
 <div class='card-body'>
 <h5 class='card-title'>{$request->request_name}</h5>
 <p class='card-text'>{$request->data}</p>
 <p class='text-danger'>{$request->getCategory()->one()->name}</p>
 </div>
 </div>
 </div>
 </div>";
    }
}
?>
<link rel="stylesheet" href="../../web/assets/css/css.css">
<html>



    </div>
</div>
