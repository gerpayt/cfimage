<?php
/* @var $this ImageController */
/* @var $model Image */

$this->breadcrumbs=array(
	$model->foldera->name=>array('folder/view', 'id'=>$model->folder),
	'Create Image',
);

if(!Yii::app()->user->isGuest)
	$this->menu=array(
	array('label'=>'Back to Folder', 'icon'=>'folder-open', 'url'=>array('folder/view', 'id'=>$model->folder)),
	array('label'=>'Upload Image', 'icon'=>'picture', 'url'=>array('folder/upload', 'id'=>$model->folder)),
	);

?>

<h1>Create Image</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'folder'=>$folder)); ?>