<?php
/* @var $this FolderController */
/* @var $model Folder */
?>
<li class="span3">
	<a href="<?php echo CHtml::normalizeUrl(array('image/view','id'=>$data->id)); ?>" class="thumbnail" rel="tooltip" data-title="<?php echo $data->title; ?>">
		<img src="<?php echo Yii::app()->request->baseUrl.'/'.Yii::app()->params['thumb_dir'].'/'.$data->filename; ?>" alt="">
	</a>
</li>