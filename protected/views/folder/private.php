<?php
/* @var $this FolderController */
/* @var $model Folder */

//if(Yii::app()->controller->id == 'folder')
//{
	$this->breadcrumbs=array(
		$model->name,
	);
/*}
elseif(Yii::app()->controller->id == 'image')
{
	$this->breadcrumbs=array(
		$model->foldera->name=>array('folder/view', 'id'=>$model->folder),
		$model->title,
	);
}*/
if(!Yii::app()->user->isGuest)
	$this->menu=array(
	array('label'=>'Create Image', 'icon'=>'plus', 'url'=>array('image/create', 'id'=>$model->id)),
	array('label'=>'Edit Folder', 'icon'=>'pencil', 'url'=>array('folder/update', 'id'=>$model->id)),
	array('label'=>'Delete Folder', 'icon'=>'trash', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Upload Image', 'icon'=>'picture', 'url'=>array('folder/upload', 'id'=>$model->id)),
	);
?>

<h1>Forbidden</h1>
<p>The folder is private!</p>
Return <a href="<?php echo CHtml::normalizeUrl(array('/')); ?>">Home</a>


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