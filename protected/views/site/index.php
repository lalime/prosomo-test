<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;

// $userName = User::model()->findAll();
// var_dump($userName); die;
?>

<section class="min-vh-100 d-flex align-items-center justify-content-center py-3 text-sm-center p-5 bg-info text-white " style="background: url(images/banner-1920.jpg) no-repeat center; background-size:cover;">
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center">
            <!-- bg-light is background color & p-5 is padding -->
            <h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

            <p class="lead">A One-day Conference About All Things JavaScript!</p>
        </div>
    </div>
</section>
<!-- <div style="margin-top:55px; padding-top:55px;" class="container-fluid text-sm-center p-5 bg-info text-white ">
    <!-- bg-light is background color & p-5 is padding -->
<!-- <h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

    <p class="lead">A One-day Conference About All Things JavaScript!</p>
</div> -->
