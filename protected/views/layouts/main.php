<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- blueprint CSS framework -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print"> -->
    <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
        <![endif]-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"> -->

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

    <div class="_container" id="page">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container -fluid">
                <a class="navbar-brand" href="#" title="<?php echo CHtml::encode(Yii::app()->name); ?>">PHPP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <?php $this->widget('zii.widgets.CMenu', array(
                        'htmlOptions' => array('class' => 'navbar-nav'),
                        'itemCssClass' => 'nav-item',
                        'linkLabelWrapperHtmlOptions' => 'nav-link',
                        // 'activeCssClass' => 'active',
                        'items' => array(
                            array('label' => 'Home', 'linkOptions' => array('class' => 'nav-link', 'activeCssClass' => 'active'), 'url' => array('/site/index')),
                            array('label' => 'About', 'linkOptions' => array('class' => 'nav-link', 'activeCssClass' => 'active'), 'url' => array('/site/page', 'view' => 'about')),
                            array('label' => 'Contact', 'linkOptions' => array('class' => 'nav-link', 'activeCssClass' => 'active'), 'url' => array('/site/contact')),
                            array('label' => 'Login', 'linkOptions' => array('class' => 'nav-link', 'activeCssClass' => 'active'), 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                            array('label' => 'Administrator', 'linkOptions' => array('class' => 'nav-link fw-bold'), 'url' => array('/users/index'), 'visible' => !Yii::app()->user->isGuest),
                            array('label' => 'Logout (' . Yii::app()->user->name . ')', 'linkOptions' => array('class' => 'nav-link'), 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                        ),
                    )); ?>

                </div>
            </div>
        </nav>

        <section class="bread-section">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <?php if (isset($this->breadcrumbs)) : ?>
                        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links' => $this->breadcrumbs,
                        )); ?>
                        <!-- breadcrumbs -->
                    <?php endif ?>
                </nav>
            </div>
        </section><!-- footer -->

        <?php echo $content; ?>

        <div class="clear"></div>

        <div class="footer-copyright bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="text-white my-3">Copyright <?php echo CHtml::encode(Yii::app()->name); ?> © <?php echo Yii::powered(); ?>. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div><!-- footer -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </div><!-- page -->

</body>

</html>