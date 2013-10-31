<?php
/* @var $this FolderController */
/* @var $model Folder */
?>
<li class="span3">
	<a href="<?php echo Chtml::normalizeUrl(array('folder/view','id'=>$data->id)); ?>" class="thumbnail" rel="tooltip" data-title="<?php echo $data->name; ?>">
		<img src="<?php if($data->perfaceimage) echo Yii::app()->request->baseUrl.'/'.Yii::app()->params['thumb_dir'].'/'.$data->perfaceimage->filename; else echo Yii::app()->request->baseUrl.'/images/no-perface.png'; ?>" alt="<?php echo $data->name; ?>">
	</a>
</li>