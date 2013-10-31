<?php

/**
 * This is the model class for table "{{image}}".
 *
 * The followings are the available columns in table '{{image}}':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $folder
 * @property string $filename
 * @property integer $size
 * @property integer $createtime
 * @property string $meta
 */
class Image extends CActiveRecord
{
	public $file;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Image the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{image}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, folder', 'required'),
			array('folder, size', 'numerical', 'integerOnly'=>true),
			array('title, filename', 'length', 'max'=>256),
			array('description, meta', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, folder, filename, size, createtime', 'safe', 'on'=>'search'),
			array('file','file','allowEmpty'=>true,
				'types'=>'jpg,gif,png',
				'maxSize'=>1024*1024*8, // 8MB
				//'tooLarge'=>'The file was larger than 8MB.',
			),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'foldera'=>array(self::BELONGS_TO, 'Folder', 'folder'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'folder' => 'Folder',
			'filename' => 'Filename',
			'size' => 'Size',
			'createtime' => 'Createtime',
			'meta' => 'Meta',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('folder',$this->folder);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('createtime',$this->createtime);
		$criteria->compare('meta',$this->meta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			$image=CUploadedFile::getInstance($this,'file');
			if(is_object($image))
			{
				$this->filename=time().rand(1000,9999).'.'.strtolower(pathinfo($image->name, PATHINFO_EXTENSION));
				$this->size=$image->size;
			}
			if($this->isNewRecord)
			{
				$this->createtime=time();
			}
			return true;
		}
		else
			return false;
	}
}