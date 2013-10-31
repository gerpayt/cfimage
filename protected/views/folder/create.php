<?php
/* @var $this FolderController */
/* @var $model Folder */

$this->breadcrumbs=array(
	'Create Folder',
);

$this->menu=array(
	array('label'=>'Back to Home', 'icon'=>'home', 'url'=>array('/')),
);

?>

<h1>Create Folder</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>