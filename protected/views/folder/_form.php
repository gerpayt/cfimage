<?php
/* @var $this FolderController */
/* @var $model Folder */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
'id'=>'horizontalForm',
'type'=>'horizontal',
)); ?>
<?php if(CHtml::errorSummary($model)): ?>
<div class="alert alert-block alert-error">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<?php echo CHtml::errorSummary($model); ?>
</div>
<?php endif; ?>
<fieldset>
<?php echo $form->textFieldRow($model, 'name', array('hint'=>'Name of the folder.')); ?>
<?php echo $form->textAreaRow($model, 'description', array('class'=>'span6', 'rows'=>5, 'hint'=>'Any description to the folder.')); ?>
<?php echo $form->radioButtonListRow($model, 'private', array('Public to everyone','Access by password','Private'), array('hint'=>'Permission')); ?>
<?php echo $form->textFieldRow($model, 'password', array('type'=>'passowrd', 'hint'=>'Password of the folder.')); ?>

</fieldset>

<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
</div>

<?php $this->endWidget(); ?>