<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

    <div class="row">
        <div class="col">
            <?php echo $form->label($model,'first_name'); ?>
            <?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>128, 'class' => 'form-control')); ?>
        </div>
        <div class="col">
            <?php echo $form->label($model,'last_name'); ?>
            <?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>128, 'class' => 'form-control')); ?>
        </div>
        <div class="col">
            <?php echo $form->label($model,'email'); ?>
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128, 'class' => 'form-control')); ?>
        </div>
        <div class="col">
            <label for="search">&nbsp;</label>
		    <?php echo CHtml::submitButton('Search', array('class' => 'btn btn-primary d-block')); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->