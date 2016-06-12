<?php

/**
 * This is the model class for table "lng_text_translated".
 *
 * The followings are the available columns in table 'lng_text_translated':
 * @property integer $translated_label_id
 * @property string $language_code
 * @property integer $english_label_id
 * @property string $translated_label_text
 */
class LngTextTranslated extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LngTextTranslated the static model class
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
		return 'lng_text_translated';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('language_code, english_label_id, translated_label_text', 'required'),
			array('english_label_id', 'numerical', 'integerOnly'=>true),
			array('language_code', 'length', 'max'=>10),
			array('translated_label_text', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('translated_label_id, language_code, english_label_id, translated_label_text', 'safe', 'on'=>'search'),
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
			'translated_label_id' => 'Translated Label',
			'language_code' => 'Language Code',
			'english_label_id' => 'English Label',
			'translated_label_text' => 'Translated Label Text',
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

		$criteria->compare('translated_label_id',$this->translated_label_id);
		$criteria->compare('language_code',$this->language_code,true);
		$criteria->compare('english_label_id',$this->english_label_id);
		$criteria->compare('translated_label_text',$this->translated_label_text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function getLanguageTranslations(){
            $controller = Yii::app()->controller->id;
            
            $language_module = LngModule::model()->findByAttributes(array('module_name'=>$controller));

            //Yii::app()->language = 'FR';
            Yii::app()->language = Yii::app()->session['Language'];
            
            $translated_labels = array();
            $translated_common_labels = array();
            /*
             * if there is an entry in the lng_module table get its id
             */
            if(sizeof($language_module)){

                /*
                 * Get all labels associated with the module
                 */
                 $labels_english = LngTextEnglish::model()->findAllByAttributes(array('module_id'=>$language_module->module_id));

//                 echo '<pre>';
//                 print_r($labels_english);
//                 echo '</pre>';

                 /*
                  * Get all labels that are common to all create,update,delete,view etc. module_id = 2 is
                  * a category to hold common labels.
                  */
                 $labels_english_common = LngTextEnglish::model()->findAllByAttributes(array('module_id'=>2));
                 
                 
                 foreach($labels_english As $le) {
                     /*
                      * go through the lng_text_translated table to get matching translations for each english label
                      * and populate the $translated_labels[] array. the key of the array elements will be the
                      * english word of the label and the value of the element will be the matching translated
                      * word for that label associated with the language code
                      */
                     $translations = LngTextTranslated::model()->findByAttributes(array(
                                                                                     'english_label_id'=>$le->english_label_id,
                                                                                     'language_code'=>Yii::app()->session['Language'],
                                                                                 ));
                     $translated_labels[$le->english_lebel_text] = $translations->translated_label_text;
                 }


                 /*
                  * get common labels such as 'create','save','required fields', etc
                  */
                 foreach($labels_english_common As $lec){

                     $translations = LngTextTranslated::model()->findByAttributes(array(
                                                                                     'english_label_id'=>$lec->english_label_id,
                                                                                     'language_code'=>Yii::app()->session['Language'],
                                                                                 ));

                     $translated_common_labels[$lec->english_lebel_text] = $translations->translated_label_text;
                 }

                 //$translated_labels['common_labels'] = $translated_common_labels;
            }

            /*
             * assign common labels array to an element in the translated_labels array so that
             * it will be one array and can be accessed together.
             */
            $translated_labels['common_labels'] = $translated_common_labels;

            return $translated_labels;
            //return $translated_common_labels;
        }

        public function getTemplateTranslations() {

            $translated_tpl_labels = array();

            $template_labels_english = LngTextEnglish::model()->findAllByAttributes(array('module_id'=>18));

            foreach($template_labels_english As $tle) {

                $translations = LngTextTranslated::model()->findByAttributes(array(
                    'english_label_id'=>$tle->english_label_id,
                    'language_code'=>Yii::app()->session['Language'],
                ));

                 $translated_tpl_labels[$tle->english_lebel_text] = $translations->translated_label_text;
            }

            return $translated_tpl_labels;
        }
}