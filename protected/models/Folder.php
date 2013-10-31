<?php

/**
 * This is the model class for table "{{folder}}".
 *
 * The followings are the available columns in table '{{folder}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $createtime
 * @property integer $private
 * @property string $password
 * @property integer $perface
 * @property string $meta
 */
class Folder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Folder the static model class
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
		return '{{folder}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, private', 'required'),
			array('private, perface', 'numerical', 'integerOnly'=>true),
			array('private', 'in', 'range'=>array(0,1,2)),
			array('name', 'length', 'max'=>256),
			array('password', 'length', 'max'=>32),
			array('description, meta', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, createtime, private', 'safe', 'on'=>'search'),
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
			'images'=>array(self::HAS_MANY, 'Image', 'folder'),
			'perfaceimage'=>array(self::HAS_ONE, 'Image', array('id' => 'perface')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'createtime' => 'Createtime',
			'private' => 'Private',
			'password' => 'Password',
			'perface' => 'Perface',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('createtime',$this->createtime);
		$criteria->compare('private',$this->private);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('perface',$this->perface);
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