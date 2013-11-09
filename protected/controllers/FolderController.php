<?php

class FolderController extends Controller
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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','upload','delete'),
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
		$prev=Folder::model()->find(array(
				'condition'=>'id>'.$id,
				'order'=>'id ASC',
			));
		$next=Folder::model()->find(array(
				'condition'=>'id<'.$id,
				'order'=>'id DESC',
			));
		$url['home']=CHtml::normalizeUrl(array('/'));
		$url['prev']=$prev?CHtml::normalizeUrl(array('folder/view','id'=>$prev->id)):'';
		$url['next']=$next?CHtml::normalizeUrl(array('folder/view','id'=>$next->id)):'';
		if(Yii::app()->user->name=='admin' || $model->private == 0 || ($model->private == 1 && $session['auth_folder_'.$id]))
		{
			$dataProvider=new CActiveDataProvider('Image', array(
				'criteria'=>array(
					'condition'=>'folder='.$id,
					'order'=>'id DESC',
				),
				'pagination'=>array(
					'pageSize'=>15,
				),
			));
			$this->render('view',array(
				'model'=>$model,
				'dataProvider'=>$dataProvider,
				'url'=>$url,
			));
		}
		elseif($model->private == 1)
		{
			if(isset($_POST['Folder']))
			{
				$password=$_POST['Folder']['password'];
				if($password==$model->password)
				{
					$session['auth_folder_'.$id]=1;
					$this->redirect(array('view','id'=>$id));
				}
				$model->addError('password', 'Wrong password!');

			}
			$this->render('password',array(
				'model'=>$model,
				'url'=>$url,
			));
		}
		else
		{
			$this->render('private',array(
				'model'=>$model,
				'url'=>$url,
			));
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Folder;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Folder']))
		{
			$model->attributes=$_POST['Folder'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Folder']))
		{
			$model->attributes=$_POST['Folder'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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
		foreach($model->images as $image)
		{
			@unlink(dirname(Yii::app()->BasePath).'/'.Yii::app()->params['image_dir'].'/'.$image->filename);
			@unlink(dirname(Yii::app()->BasePath).'/'.Yii::app()->params['thumb_dir'].'/'.$image->filename);
		}
		Image::model()->deleteAll(array('condition'=>'folder='.$id));
		$this->loadModel($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Folder');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Folder the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Folder::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Folder $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='folder-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionUpload($id)
	{
		//$post_content=file_get_contents('php://input');
		$file_content=file_get_contents('php://input');
		
		if ($file_content) {
			//$part1index = strpos($post_content,"\n");
			//$title = base64_decode(substr($post_content,0,$part1index));
			//$part1index += 1;

			//$part2index = strpos($post_content,"\n",$part1index);
			//$description = base64_decode(substr($post_content,$part1index,$part2index-$part1index));
			//$part2index += 1;

			//$part3index = strpos($post_content,"\n",$part2index);
			//$fn = base64_decode(substr($post_content,$part2index,$part3index-$part2index));
			//$part3index += 1;

			//$file_content=base64_decode(substr($post_content,$part3index));

			//echo $title."\n";
			//echo $description."\n";
			//echo $fn."\n";
			//echo $file_content;

			$title = $_GET['title'];
			$description = $_GET['description'];
			$fn = $_GET['filename'];
			$filename=time().rand(1000,9999).'.'.strtolower(pathinfo($fn, PATHINFO_EXTENSION));
			
			$model=new Image;
			$model->title=$title;
			$model->folder=$id;
			$model->filename=$filename;
			$model->description=$description;
			$model->size=strlen($file_content);
			$model->save();
			file_put_contents(dirname(Yii::app()->BasePath) .'/'.Yii::app()->params['image_dir'].'/' . $filename, $file_content);
			CThumb::resizeImage (dirname(Yii::app()->BasePath).'/'.Yii::app()->params['image_dir'].'/'.$model->filename,
						320, 240,dirname(Yii::app()->BasePath).'/'.Yii::app()->params['thumb_dir'].'/'.$model->filename);

			echo $model->id.'/'.$fn;
			exit();
		}
		else
		{
			$this->render('upload',array(
				'model'=>$this->loadModel($id),
			));
		}
	}
}
