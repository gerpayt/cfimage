<?php
/* @var $this FolderController */
/* @var $model Folder */

$this->breadcrumbs=array(
	$model->name=>array('folder/view', 'id'=>$model->id),
	'Upload Image',
);

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/zxxfile.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/zxxfile.js");
$this->menu=array(
	array('label'=>'Back to Folder', 'icon'=>'folder-open', 'url'=>array('folder/view', 'id'=>$model->id)),
	array('label'=>'Create Folder', 'icon'=>'plus', 'url'=>array('folder/create')),
	array('label'=>'Edit Folder', 'icon'=>'pencil', 'url'=>array('folder/update', 'id'=>$model->id)),
	array('label'=>'Delete Folder', 'icon'=>'trash', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);

?>

<h1>View Folder #<?php echo $model->id; ?></h1>


<form id="uploadForm" enctype="multipart/form-data" method="post" action="<?php echo CHtml::normalizeUrl(array('folder/upload','id'=>$model->id));?>">
	<div class="upload_box">
		<div class="upload_main">
			<div class="upload_choose">
			<input type="file" multiple="" name="fileselect[]" size="30" id="fileImage" class="">
			<span class="upload_drag_area" id="fileDragArea">Drag images HERE</span>
			</div>
		</div>
		<hr />	
		<div class="upload_inf" id="uploadInf"></div>
		<div id='preview'></div>
		<div class="upload_submit form-actions" id="fileSubmit">
			<button class="upload_submit_btn btn btn-primary" type="button">Upload</button>
		</div>
	</div>
</form>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/zxxfile_init.js"></script>
