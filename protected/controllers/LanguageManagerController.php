<?php

class LanguageManagerController extends Controller
{
	public function actionIndex()
	{
            $data = array();
            $translations = LngTextTranslated::model()->getLanguageTranslations();

            if(isset($_POST['module_id'])){

                $module_id = $_POST['module_id'];
                $language_code = $_POST['language_code'];
                $english_labels_array = array();

                // find all records irrespective of module
                if($module_id == ''){
                    $english_labels_array = LngTextEnglish::model()->findAll();
                    
                }else{
                    // find records specific to module
                    $english_labels_array = LngTextEnglish::model()->findAllByAttributes(array('module_id'=>$module_id));
                    
                }
                
                foreach($english_labels_array As $ela){
                    //echo $ela->english_lebel_text;
                    $translated = LngTextTranslated::model()->findByAttributes(array('english_label_id'=>$ela->english_label_id,'language_code'=>$language_code));
                    if(sizeof($translated) > 0){
                    
                      $data[$ela->english_label_id] = array(
                            'english_lebel_text'=>$ela->english_lebel_text,
                            'translated_label_id'=>$translated->translated_label_id,
                            'translated_label_text'=>$translated->translated_label_text,
                            'label_meangin'=>$ela->label_meaning,
                            );

                    }else{
                          $data[$ela->english_label_id] = array(
                            'english_lebel_text'=>$ela->english_lebel_text,
                            'translated_label_id'=>0,
                            'translated_label_text'=>'',
                            'label_meangin'=>$ela->label_meaning,
                            );
                    }

                }
            }


            //echo '<pre>';
            //print_r($data);
            //echo '</pre>';
		$this->render('index',array('data'=>$data,'language_code'=>$language_code,'translations'=>$translations));
	}

        public function ActioncommitChanges(){
            
            //ini_set('max_execution_time', 300);
           
            if(isset($_POST['no_of_records'])){

                $no_of_records = $_POST['no_of_records'];
                $language_code = $_POST['language_code'];
                
                for($i=0;$i<$no_of_records;$i++){

                    $translated_label_id = $_POST['translated_label_id'.$i];
                    $translated_label_text = $_POST['translated_label_text'.$i];
                    $english_label_id = $_POST['english_label_id'.$i];
                    $original_label_text = $_POST['original_label_text'.$i];
                    

                        if($translated_label_id  != 0){
                            /*
                             * update record here
                             */
                            //echo "$translated_label_id => $translated_label_text <br>";

                            /*
                             * Compare the original text value of the label in the hidden fields with
                             * the values in the editable fields. strcmp will return < 0 if str1 is less than str2; > 0 if str1 is greater than str2, and 0 if they are equal.
                             * therefore update only if there is a difference to the two strings.
                             */
                            $modified = strcmp($original_label_text,$translated_label_text);

                            if($modified != 0){
                                //$LngTextTranslated = LngTextTranslated::model()->findByAttributes(array('translated_label_id'=>$translated_label_id));

                                /*$LngTextTranslated = LngTextTranslated::model()->findByPk($translated_label_id);
                                $LngTextTranslated->translated_label_text = $translated_label_text;
                                $LngTextTranslated->save();*/


                                /*
                                 * The above code had a bug where it only save a part of string when the string is long and consists spaces
                                 * therefore the code below was used instead.
                                 */



                                $connection = yii::app()->db;
                                $sql = "UPDATE lng_text_translated SET translated_label_text = '".addslashes($translated_label_text)."' WHERE 	translated_label_id='$translated_label_id'";
                                $command=$connection->createCommand($sql);
                                $command->execute();


                            }

                            // echo "$translated_label_id => $translated_label_text [$translated_label_id]<br>";

                        }else{
                            if((trim($translated_label_text)) != ''){
                                /*
                                 * create new record here
                                 */
                                
                                /*
                                $LngTextTranslated = new LngTextTranslated();
                                $LngTextTranslated->translated_label_text = $translated_label_text;
                                $LngTextTranslated->language_code = $language_code;
                                $LngTextTranslated->english_label_id = $english_label_id;
                                $LngTextTranslated->save();
                                */
                                
                                
                                /*
                                 * same issue here as update, did not save special characters with above code.
                                 * but the following with sql statements works.
                                 */
                                $connection = yii::app()->db;
                                $sql = "INSERT INTO lng_text_translated (language_code,english_label_id,translated_label_text) VALUES (:v1,:v2,:v3)";
                                $params = array(":v1"=> $language_code,":v2"=>$english_label_id,":v3"=>addslashes($translated_label_text));
                                $command=$connection->createCommand($sql)->execute($params);
                                //$command->execute();
                                
                            }
                        }



                }

            }

            $this->render('index',array());
        }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}