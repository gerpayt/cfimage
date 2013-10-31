<?php
/* @var $this FolderController */
/* @var $model Folder */

$this->breadcrumbs=array(
	$model->name,
);

if(!Yii::app()->user->isGuest)
	$this->menu=array(
	array('label'=>'Create Image', 'icon'=>'plus', 'url'=>array('image/create', 'id'=>$model->id)),
	array('label'=>'Edit Folder', 'icon'=>'pencil', 'url'=>array('folder/update', 'id'=>$model->id)),
	array('label'=>'Delete Folder', 'icon'=>'trash', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Upload Image', 'icon'=>'picture', 'url'=>array('folder/upload', 'id'=>$model->id)),
	);
?>

<?php 
if($model->description)$this->side_info_content.='<strong>Description:</strong><br />'.$model->description.'<br />';
if($model->createtime)$this->side_info_content.='<strong>Create time:</strong><br />'.date('Y-m-d h:i:s',$model->createtime).'<br />';
$this->side_info_content.='<strong>'.count($model->images).' images</strong><br />';
?>

<?php 
$this->side_nav_content.='<div class="row">';

$this->side_nav_content.='<span class="span1">';
if($url['prev'])
	$this->side_nav_content.='<a class="btn" href="'.$url['prev'].'">';
else
	$this->side_nav_content.='<a class="btn" disabled="disabled">';
$this->side_nav_content.='<i class="icon-chevron-left"></i> Prev </a></span>';

$this->side_nav_content.='<span class="span1"><a class="btn" href="'.$url['home'].'"><i class="icon-home"></i> Home </a></span>';


$this->side_nav_content.='<span class="span1">';
if($url['next'])
	$this->side_nav_content.='<a class="btn btn-primary" href="'.$url['next'].'">';
else
	$this->side_nav_content.='<a class="btn btn-primary" disabled="disabled">';
$this->side_nav_content.='<i class="icon-chevron-right icon-white"></i> Next </a></span>';

$this->side_nav_content.='</div>';
?>

<?php $this->widget('bootstrap.widgets.TbThumbnails', array(
    'dataProvider'=>$dataProvider,
    'template'=>"{items}\n{pager}",
    'itemView'=>'_thumb',
)); ?>

