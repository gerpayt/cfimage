<?php
/* @var $this FolderController */
/* @var $data Folder */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('folder/view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createtime')); ?>:</b>
	<?php echo date('Y-m-d h:i:s',$data->createtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('private')); ?>:</b>
	<?php echo CHtml::encode($data->private); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('封面')); ?>:</b>
	<?php if($data->perfaceimage) echo Chtml::link(CHtml::encode($data->perfaceimage->title),$data->perfaceimage->filename); 
	else echo CHtml::encode($data->getAttributeLabel('UNKNOWN')); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('meta')); ?>:</b>
	<?php echo CHtml::encode($data->meta); ?>
	<br />

	<b><?php echo CHtml::encode("图片"); ?>:</b><br />
	<?php foreach($data->images as $image)
	{
		echo $image->id;
		echo CHtml::link(CHtml::encode($image->title),array('image/view','id'=>$image->id));
		echo $image->description;
		echo $image->filename;
		echo '<br />';
	}
	?>
	<br />

</div>