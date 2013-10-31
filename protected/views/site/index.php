<?php
/* @var $this FolderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'',
);

if(!Yii::app()->user->isGuest)
	$this->menu=array(
	array('label'=>'Create Folder', 'icon'=>'plus', 'url'=>array('folder/create')),
	);
?>

<?php $this->widget('bootstrap.widgets.TbThumbnails', array(
    'dataProvider'=>$dataProvider,
    'template'=>"{items}\n{pager}",
    'itemView'=>'_thumb',
)); ?>
