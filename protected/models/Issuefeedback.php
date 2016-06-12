<?php

/**
 * This is the model class for table "issuefeedback".
 *
 * The followings are the available columns in table 'issuefeedback':
 * @property integer $id
 * @property string $comment
 * @property integer $issueid
 * @property integer $createdby
 * @property string $createddate
 * @property string $file1
 * @property string $file2
 */
class Issuefeedback extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Issuefeedback the static model class
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
		return 'issuefeedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment, issueid', 'required'),
			array('issueid, createdby', 'numerical', 'integerOnly'=>true),
			array('file1, file2', 'length', 'max'=>50),
			array('createddate', 'safe'),
                        array('file1type', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, comment, issueid, createdby, createddate, file1, file2', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'comment' => 'Comment',
			'issueid' => 'Issueid',
			'createdby' => 'Createdby',
			'createddate' => 'Createddate',
			'file1' => 'File',
                        'file1type' => 'File type',
			'file2' => 'File2',
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
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('issueid',$this->issueid);
		$criteria->compare('createdby',$this->createdby);
		$criteria->compare('createddate',$this->createddate,true);
		$criteria->compare('file1',$this->file1,true);
		$criteria->compare('file2',$this->file2,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getFileUploadUrl($fileName){
            return Yii::app()->basePath.'/../uploadedfiles/'.$fileName;
        }
}