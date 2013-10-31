<?php
/* @var $this ImageController */
/* @var $model Image */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
'id'=>'horizontalForm',
'type'=>'horizontal',
'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<?php if(CHtml::errorSummary($model)): ?>
<div class="alert alert-block alert-error">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<?php echo CHtml::errorSummary($model); ?>
</div>
<?php endif; ?>
<fieldset>
<?php echo $form->textFieldRow($model, 'title', array('hint'=>'Title of the image.')); ?>
<?php echo $form->textAreaRow($model, 'description', array('class'=>'span6', 'rows'=>5, 'hint'=>'Any description to the image.')); ?>
<?php echo $form->dropDownListRow($model, 'folder', $folder); ?>
<?php echo $form->fileFieldRow($model, 'file'); ?>
</fieldset>

<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
</div>

<?php $this->endWidget(); ?>