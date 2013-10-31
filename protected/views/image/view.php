<?php
/* @var $this ImageController */
/* @var $model Image */

$this->breadcrumbs=array(
	$model->foldera->name=>array('folder/view', 'id'=>$model->folder),
	$model->title,
);

if(!Yii::app()->user->isGuest)
	$this->menu=array(
	array('label'=>'Set perface', 'icon'=>'book', 'url'=>array('image/setperface', 'id'=>$model->id)),
	array('label'=>'Create Image', 'icon'=>'plus', 'url'=>array('image/create', 'id'=>$model->folder)),
	array('label'=>'Edit Image', 'icon'=>'pencil', 'url'=>array('image/update', 'id'=>$model->id)),
	array('label'=>'Delete Image', 'icon'=>'trash', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Upload Image', 'icon'=>'picture', 'url'=>array('folder/upload', 'id'=>$model->folder)),
	array('label'=>'Download Image', 'icon'=>'download', 'url'=>array('image/download', 'id'=>$model->id)),
	);

?>

<?php 
if($model->description)$this->side_info_content.='<strong>Description:</strong><br />'.$model->description.'<br />';
if($model->createtime)$this->side_info_content.='<strong>Create time:</strong><br />'.date('Y-m-d h:i:s',$model->createtime).'<br />';
if($model->size)$this->side_info_content.='<strong>File size:</strong><br />'.$model->size.'<br />';
?>

<?php 
$this->side_nav_content.='<div class="row">';

$this->side_nav_content.='<span class="span1">';
if($url['prev'])
	$this->side_nav_content.='<a class="btn" href="'.$url['prev'].'">';
else
	$this->side_nav_content.='<a class="btn" disabled="disabled">';
$this->side_nav_content.='<i class="icon-chevron-left"></i> Prev </a></span>';

$this->side_nav_content.='<span class="span1"><a class="btn" href="'.$url['folder'].'"><i class="icon-folder-open"></i> Folder </a></span>';


$this->side_nav_content.='<span class="span1">';
if($url['next'])
	$this->side_nav_content.='<a class="btn btn-primary" href="'.$url['next'].'">';
else
	$this->side_nav_content.='<a class="btn btn-primary" disabled="disabled">';
$this->side_nav_content.='<i class="icon-chevron-right icon-white"></i> Next </a></span>';

$this->side_nav_content.='</div>';
?>

<img src="<?php echo Yii::app()->request->baseUrl.'/'.Yii::app()->params['image_dir'].'/'.$model->filename; ?>" class="img-polaroid">
