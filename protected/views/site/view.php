<?php
/* @var $this FolderController */
/* @var $model Folder */

$this->breadcrumbs=array(
	$model->name,
);

$this->menu=array(
	array('label'=>'OPTION'),
	array('label'=>'Back to Home', 'icon'=>'home', 'url'=>array('/')),
	array('label'=>'Create Folder', 'icon'=>'plus', 'url'=>array('folder/create')),
	array('label'=>'Edit Folder', 'icon'=>'pencil', 'url'=>array('folder/update', 'id'=>$model->id)),
	array('label'=>'Delete Folder', 'icon'=>'trash', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Upload Image', 'icon'=>'picture', 'url'=>array('folder/upload', 'id'=>$model->id)),
	array('label'=>'ANOTHER LIST HEADER'),
	array('label'=>'Profile', 'icon'=>'user', 'url'=>'#'),
	array('label'=>'Settings', 'icon'=>'cog', 'url'=>'#'),
	array('label'=>'Help', 'icon'=>'flag', 'url'=>'#'),
);


?>


<?php $this->widget('bootstrap.widgets.TbThumbnails', array(
    'dataProvider'=>$dataProvider,
    'template'=>"{items}\n{pager}",
    'itemView'=>'_thumb',
)); ?>

<dl>
	<dt><?php echo $model->name; ?></dt>
	<dd><?php echo $model->description; ?></dd>
</dl>