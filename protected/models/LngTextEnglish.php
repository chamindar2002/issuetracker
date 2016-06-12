<?php

/**
 * This is the model class for table "lng_text_english".
 *
 * The followings are the available columns in table 'lng_text_english':
 * @property integer $english_label_id
 * @property integer $module_id
 * @property string $english_lebel_text
 * @property string $label_meaning
 */
class LngTextEnglish extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LngTextEnglish the static model class
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
		return 'lng_text_english';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('module_id, english_lebel_text', 'required'),
			array('module_id', 'numerical', 'integerOnly'=>true),
			array('english_lebel_text', 'length', 'max'=>40),
                        array('label_meaning', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('english_label_id, module_id, english_lebel_text, label_meaning', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('trans'=>array(self::HAS_MANY, 'LngTextTranslated', 'english_label_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {

            return array(
                'english_label_id' => 'English Label',
                'module_id' => 'Module',
                'english_lebel_text' => 'English Lebel Text',
                'label_meaning' => 'Label Meaning',
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

		$criteria->compare('english_label_id',$this->english_label_id);
		$criteria->compare('module_id',$this->module_id);
		$criteria->compare('english_lebel_text',$this->english_lebel_text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}