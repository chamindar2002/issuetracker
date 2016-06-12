<?php

/**
 * This is the model class for table "action_permission".
 *
 * The followings are the available columns in table 'action_permission':
 * @property integer $id
 * @property string $module
 * @property string $action
 * @property string $description
 * @property integer $systemid
 */
class ActionPermission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ActionPermission the static model class
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
		return 'action_permission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('module, action', 'required'),
			array('systemid', 'numerical', 'integerOnly'=>true),
			array('module', 'length', 'max'=>50),
			array('action', 'length', 'max'=>100),
			array('description', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, module, action, description, systemid', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
            $translated_labels = LngTextTranslated::model()->getLanguageTranslations();

            if(sizeof($translated_labels) > 0 && (Yii::app()->session['Language']) != 'en'){

		return array(
			'id' => $translated_labels['Id'],
			'module' => $translated_labels['Module'],
			'action' => $translated_labels['Action'],
			'description' => 'Description',
			'systemid' => 'Systemid',
		);
            }else{

                return array(
			'id' => 'ID',
			'module' => 'Module',
			'action' => 'Action',
			'description' => 'Description',
			'systemid' => 'Systemid',
		);
            }
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
		$criteria->compare('module',$this->module,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('systemid',$this->systemid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


       
}