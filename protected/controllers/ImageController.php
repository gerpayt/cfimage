<?php

class ImageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $side_info_content;
	public $side_nav_content;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','download'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','setperface'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$session = Yii::app()->session;
		$model=$this->loadModel($id);
		if(Yii::app()->user->name=='admin' || $model->foldera->private == 0 || ($model->foldera->private == 1 && $session['auth_folder_'.$model->folder]))
		{
			$prev=IMage::model()->find(array(
					'condition'=>'createtime>'.$model->createtime.' AND folder='.$model->folder,
					'order'=>'createtime ASC',
				));
			$next=Image::model()->find(array(
					'condition'=>'createtime<'.$model->createtime.' AND folder='.$model->folder,
					'order'=>'createtime DESC',
				));
			$url['folder']=CHtml::normalizeUrl(array('folder/view','id'=>$model->folder));
			$url['prev']=$prev?CHtml::normalizeUrl(array('image/view','id'=>$prev->id)):'';
			$url['next']=$next?CHtml::normalizeUrl(array('image/view','id'=>$next->id)):'';
			$this->render('view',array(
				'model'=>$model,
				'url'=>$url,
			));
		}
		else
		{
			$this->redirect(array('/folder/view','id'=>$model->folder));
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
		$model=new Image;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Image']))
		{
			$model->attributes=$_POST['Image'];
			if($model->save())
			{
				$this->saveImage($model);
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		$model->folder=$id;
		$objs=Folder::model()->findAll(array('select'=>'id,name'));
		$folder=array();
		foreach($objs as $obj)
			$folder[$obj->id] = $obj->name;
		$this->render('create',array(
			'model'=>$model,
			'folder'=>$folder
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Image']))
		{
			$model->attributes=$_POST['Image'];
			if($model->save())
			{
				$this->saveImage($model);
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		$objs=Folder::model()->findAll(array('select'=>'id,name'));
		$folder=array();
		foreach($objs as $obj)
			$folder[$obj->id] = $obj->name;
		$this->render('update',array(
			'model'=>$model,
			'folder'=>$folder
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
		unlink(dirname(Yii::app()->BasePath).'/'.Yii::app()->params['image_dir'].'/'.$model->filename);
		unlink(dirname(Yii::app()->BasePath).'/'.Yii::app()->params['thumb_dir'].'/'.$model->filename);
		$this->loadModel($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('folder/view','id'=>$model->folder));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Image');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionSetperface($id)
	{
		$image=$this->loadModel($id);
		$folder=Folder::model()->findByPk($image->folder);
		$folder->perface=$image->id;
		$folder->save();
		$this->redirect(array('image/view','id'=>$image->id));
	}

	/**
	 * Download the image.
	 */
	public function actionDownload($id)
	{
		$model=$this->loadModel($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		header('Content-type: application/octet-stream ');
		header('Content-Disposition: attachment; filename='.$model->title);
		echo file_get_contents(dirname(Yii::app()->BasePath).'/'.Yii::app()->params['image_dir'].'/'.$model->filename);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Image the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Image::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Image $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='image-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	protected function saveImage($model)
	{
		$image=CUploadedFile::getInstance($model,'file');
		if (is_object($image) && get_class($image)==='CUploadedFile')
		{
			$image->saveAs(dirname(Yii::app()->BasePath).'/'.Yii::app()->params['image_dir'].'/'.$model->filename);
			CThumb::resizeImage (dirname(Yii::app()->BasePath).'/'.Yii::app()->params['image_dir'].'/'.$model->filename,
						320, 240,dirname(Yii::app()->BasePath).'/'.Yii::app()->params['thumb_dir'].'/'.$model->filename);
		}
	}
}
