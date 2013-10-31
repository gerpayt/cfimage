<?php
/* @var $this FolderController */
/* @var $model Folder */

$this->breadcrumbs=array(
	$model->name=>array('view','id'=>$model->id),
	'Update Folder',
);

$this->menu=array(
	array('label'=>'Back to Home', 'icon'=>'home', 'url'=>array('/')),
	array('label'=>'Create Folder', 'icon'=>'plus', 'url'=>array('folder/create')),
	array('label'=>'Delete Folder', 'icon'=>'trash', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Upload Image', 'icon'=>'picture', 'url'=>array('folder/upload', 'id'=>$model->id)),
);

?>

<h1>Update Folder <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>