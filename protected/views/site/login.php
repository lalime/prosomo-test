<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<div class="container h-75" id="page">
    <section class="my-5">
        <div class="form w-50 p-3 m-auto">
            <h1>Login</h1>

            <p>Please fill out the following form with your login credentials:</p>

            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array(
                    'class' => 'row gy-2 gx-3 align-items-center',
                ),
            )); ?>

            <p class="note mb-5">Fields with <span class="required">*</span> are required.</p>

            <div class="row mb-3">
                <?php echo $form->labelEx($model, 'username', ['class' => 'col-sm-3 col-form-label']); ?>
                <div class="col-sm-9">
                    <?php echo $form->textField($model, 'username', ['class' => 'form-control']); ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>
            </div>

            <div class="row mb-3">
                <?php echo $form->labelEx($model, 'password', ['class' => 'col-sm-3 col-form-label']); ?>
                <div class="col-sm-9">
                    <?php echo $form->passwordField($model, 'password', ['class' => 'form-control']); ?>
                    <?php echo $form->error($model, 'password'); ?>
                    <p class="hint d-none">
                        Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
                    </p>
                </div>
            </div>

            <div class="row mb-3 rememberMe">
                <label for="colFormLabelLg" class="col-sm-3 col-form-label col-form-label-lg">&nbsp;</label>
                <div class="col-sm-9 form-check">
                    <?php echo $form->checkBox($model, 'rememberMe', ['class' => ' pl-2 form-check-input']); ?>
                    <?php echo $form->label($model, 'rememberMe', ['class' => 'form-check-label']); ?>
                    <?php echo $form->error($model, 'rememberMe'); ?>
                </div>
            </div>

            <div class="row buttons">
                <div class="col-12 text-center">
                    <?php echo CHtml::submitButton('Login', ['class' => 'btn btn-primary ']); ?>
                </div>
            </div>

            <?php $this->endWidget(); ?>
        </div><!-- form -->
    </section><!-- form -->
</div><!-- container -->