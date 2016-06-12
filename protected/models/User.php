<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $uid
 * @property integer $enabled
 * @property string $loginname
 * @property string $familyname
 * @property string $firstname
 * @property string $password
 * @property integer $club_id
 * @property integer $deleted
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('enabled, loginname, familyname, firstname, password', 'required'),
                        array('loginname, familyname, firstname, password, club_id', 'required'),
			array('enabled, club_id, deleted', 'numerical', 'integerOnly'=>true),
			array('loginname, familyname, firstname, password', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, enabled, loginname, familyname, firstname, password, club_id, deleted', 'safe', 'on'=>'search'),
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
			'uid' => $translated_labels['User Id'],
			'enabled' => 'Enabled',
			'loginname' => $translated_labels['Login Name'],
			'familyname' => $translated_labels['Family Name'],
			'firstname' => $translated_labels['First Name'],
			'password' => $translated_labels['Password'],
			'club_id' => $translated_labels['Golf Club'],
			'deleted' => 'Deleted',
		);
            }else{
                return array(
			'uid' => 'Id',
			'enabled' => 'Enabled',
			'loginname' => 'Login name',
			'familyname' => 'Family name',
			'firstname' => 'First name',
			'password' => 'Password',
			'club_id' => 'Club',
			'deleted' => 'Deleted',
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

		$criteria->compare('uid',$this->uid);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('loginname',$this->loginname,true);
		$criteria->compare('familyname',$this->familyname,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('club_id',$this->club_id);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


        public function encryptPassword($password){
            return md5($password);
        }

        
        
}