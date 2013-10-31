<?php
/* @var $this ImageController */
/* @var $model Image */

$this->breadcrumbs=array(
	$model->foldera->name=>array('folder/view', 'id'=>$model->folder),
	$model->title=>array('image/view', 'id'=>$model->id),
	'Update Image'
);

$this->menu=array(
	array('label'=>'Back to Folder', 'icon'=>'folder-open', 'url'=>array('folder/view', 'id'=>$model->folder)),
	array('label'=>'Create Image', 'icon'=>'plus', 'url'=>array('image/create', 'id'=>$model->folder)),
	array('label'=>'Delete Image', 'icon'=>'trash', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Upload Image', 'icon'=>'picture', 'url'=>array('folder/upload', 'id'=>$model->folder)),
);

?>

<h1>Update Image <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'folder'=>$folder)); ?>