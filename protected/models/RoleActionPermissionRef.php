<?php

/**
 * This is the model class for table "role_action_permission_ref".
 *
 * The followings are the available columns in table 'role_action_permission_ref':
 * @property integer $rid
 * @property integer $aid
 */
class RoleActionPermissionRef extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RoleActionPermissionRef the static model class
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
		return 'role_action_permission_ref';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rid, aid', 'required'),
			array('rid, aid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rid, aid', 'safe', 'on'=>'search'),
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
		return array(
			'rid' => 'Rid',
			'aid' => 'Aid',
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

		$criteria->compare('rid',$this->rid);
		$criteria->compare('aid',$this->aid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function authenticateUser($controller,$action_permission_id,$roleId){

        if(!ENFORCE_AUTHENTICATION){return true;}

            if($controller == 'login'){
                return true;
            }

            if($controller == 'site'){
               return true;
            }

            $result = $this->findAllByAttributes(array('rid'=>$roleId,'aid'=>$action_permission_id));
            if(sizeof($result) != 0){
                return true;
            }

            return false;
            }

}