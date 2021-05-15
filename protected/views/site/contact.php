<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>

<div class="container h-75" id="page">
    <section class="my-5">
        <div class="form w-50 p-3 m-auto">
            <h1 class="text-center">Contact Us</h1>

            <?php if (Yii::app()->user->hasFlash('contact')) : ?>

                <div class="flash-success">
                    <?php echo Yii::app()->user->getFlash('contact'); ?>
                </div>

            <?php else : ?>

                <p class="text-center">
                    If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
                </p>

                <div class="form">

                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'contact-form',
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                    )); ?>

                    <p class="note text-danger mb-5">Fields with <span class="required">*</span> are required.</p>

                    <?php echo $form->errorSummary($model); ?>

                    <div class="row mb-3">
                        <?php echo $form->labelEx($model, 'first_name', ['class' => 'col-sm-3 col-form-label']); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model, 'first_name', ['class' => 'form-control']); ?>
                            <?php echo $form->error($model, 'first_name'); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <?php echo $form->labelEx($model, 'last_name', ['class' => 'col-sm-3 col-form-label']); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model, 'last_name', ['class' => 'form-control']); ?>
                            <?php echo $form->error($model, 'last_name'); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <?php echo $form->labelEx($model, 'email', ['class' => 'col-sm-3 col-form-label']); ?>
                        <div class="col-sm-9">
                                <?php echo $form->textField($model, 'email', ['class' => 'form-control']); ?>
                                <?php echo $form->error($model, 'email'); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <?php echo $form->labelEx($model, 'phone_number', ['class' => 'col-sm-3 col-form-label']); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model, 'phone_number', ['class' => 'form-control']); ?>
                            <?php echo $form->error($model, 'phone_number'); ?>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <?php echo $form->labelEx($model, 'city', ['class' => 'col-sm-3 col-form-label']); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model, 'city', ['class' => 'form-control']); ?>
                            <?php echo $form->error($model, 'city'); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <?php echo $form->labelEx($model, 'state', ['class' => 'col-sm-3 col-form-label']); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model, 'state', ['class' => 'form-control']); ?>
                            <?php echo $form->error($model, 'state'); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <?php echo $form->labelEx($model, 'zipcode', ['class' => 'col-sm-3 col-form-label']); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model, 'zipcode', ['class' => 'form-control']); ?>
                            <?php echo $form->error($model, 'zipcode'); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <?php echo $form->labelEx($model, 'country', ['class' => 'col-sm-3 col-form-label']); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model, 'country', ['class' => 'form-control']); ?>
                            <?php echo $form->error($model, 'country'); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <?php echo $form->labelEx($model, 'comment', ['class' => 'col-sm-3 col-form-label']); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textArea($model, 'comment', ['class' => 'form-control']); ?>
                            <?php echo $form->error($model, 'comment'); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <?php echo $form->labelEx($model, 'comment_2', ['class' => 'col-sm-3 col-form-label']); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textArea($model, 'comment_2', ['class' => 'form-control']); ?>
                            <?php echo $form->error($model, 'comment_2'); ?>
                        </div>
                    </div>

                    <?php if (CCaptcha::checkRequirements()) : ?>
                        <div class="row mb-3">
                            <?php echo $form->labelEx($model, 'verifyCode'); ?>
                            <div>
                                <?php $this->widget('CCaptcha'); ?>
                                <?php echo $form->textField($model, 'verifyCode'); ?>
                            </div>
                            <div class="hint">Please enter the letters as they are shown in the image above.
                                <br />Letters are not case-sensitive.
                            </div>
                            <?php echo $form->error($model, 'verifyCode'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="row buttons">
                        <div class="col-12 text-center">
                            <?php echo CHtml::submitButton('Submit', ['class' => 'btn btn-primary ']); ?>
                        </div>
                    </div>

                    <?php $this->endWidget(); ?>

                </div><!-- form -->
    </section><!-- form -->
</div><!-- container -->

<?php endif; ?>