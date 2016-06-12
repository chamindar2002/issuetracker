<?php $this->widget('ext.AskToSaveWork', array('watchElement'=>'#modifylanguages-form','message'=>Yii::t('messages', "You haven't save your work yet!")))?>
<?php
/* @var $this LanguageManagerController */

$this->breadcrumbs=array(
	'Language Manager',
);

?>

<?php
$heading = (isset($translations['Heading'])?$translations['Heading']:'Label Text Language Manager');
$lbl_module_text = (isset($translations['Module'])?$translations['Module']:'Module Name');
$lbl_language_text = (isset($translations['Language'])?$translations['Language']:'Language');
$lbl_label_text = (isset($translations['Label'])?$translations['Label']:'Label');
$lbl_translation_text = (isset($translations['Translation'])?$translations['Translation']:'Translation');
$lbl_actual_text = (isset($translations['Actual Text'])?$translations['Actual Text']:'Label Actual Text');
?>
<h1>
    <?php
    //echo $this->id . '/' . $this->action->id;
    echo $heading;
    ?>
</h1>

<?php $form=$this->beginWidget('CActiveForm',
        array('id'=>'getlanguages-form',
        'action' => Yii::app()->createUrl('/LanguageManager/index/'),
	'enableAjaxValidation'=>false,
)); ?>

<div id="cspec_top">
    <div class="form">

        <div class="row">
            <?php
                echo CHtml::label($lbl_module_text,'');
            ?>

            <?php
                $module_selected = (isset($_POST['module_id'])?$_POST['module_id']:'');

                $modulesArray = CHtml::listData(LngModule::model()->findAll(),'module_id','module_name');
                
                echo CHtml::dropDownList('module_id','',$modulesArray,array(
                                                'empty'=>'All',
                                                'options'=>array($module_selected=>array('selected'=>'selected'))
                                         )



                                        );
            ?>
        </div>

        <div class="row">
            <?php
                echo CHtml::label($lbl_language_text,'');
            ?>

            <?php
            $language_selected = (isset($_POST['language_code'])?$_POST['language_code']:DEFAULT_LANGUAGE);
            
            $languagesArray = CHtml::listData(LngLanguages::model()->findAll(),'language_code','language_desc');

            /*
             * remove language 'english' from the list. cannot modify or add translations to this
             */
            unset($languagesArray['en']);

            echo CHtml::dropDownList('language_code','',$languagesArray,array(
                                                //'prompt'=>'selecte',
                                                'options'=>array($language_selected=>array('selected'=>'selected'))
                                         )

                                        );
            ?>
         </div>

        <div class="row">
            <?php
            $button_text = (isset($translations['Submit'])?$translations['Submit']:'Submit');
            ?>
            <input type="button" value="<?php echo $button_text; ?>" onclick="submit_getlanguages_form()">

             <?php

        $btn_cancel_text = (isset($translations['common_labels']['Cancel'])?$translations['common_labels']['Cancel']:'Cancel');
                        $tip_cancel = (isset($translations['common_labels']['tip_cancel'])?$translations['common_labels']['tip_cancel']:'Cancel');
                        echo CHtml::link($btn_cancel_text,Yii::app()->request->urlReferrer,array('title'=>$tip_cancel,'class'=>'cancel_button'));
            ?>
        </div>

        


    </div>
</div>

<?php $this->endWidget(); ?>


<?php $form=$this->beginWidget('CActiveForm',
        array('id'=>'modifylanguages-form',
        'action' => Yii::app()->createUrl('/LanguageManager/commitChanges/'),
	'enableAjaxValidation'=>false,
)); ?>


<?php  if(sizeof($data) > 0){?>

<div id="cspec_top">
    <div class="row">
        <table>
            <tr>
                <td><strong><?php echo $lbl_label_text;?></strong></td>
                <td>&nbsp;</td>
                <td><strong><?php echo $lbl_translation_text; ?></strong></td>
                <td><strong><?php echo $lbl_actual_text; ?></strong></td>
            </tr>
            <?php

            if(($data) > 0) {

                $i = 0;
                foreach($data As $key=>$value) {

                    $english_lebel_text = $value['english_lebel_text'];

                    $translated_label_id = $value['translated_label_id'];
                    $translated_label_text = $value['translated_label_text'];

                    echo '<tr>';
                        echo '<td>';
                        echo $value['english_lebel_text'];
                        echo '</td>';

                        echo '<td>';
                        echo "<input type='hidden' name=\"translated_label_id$i\" value=\"$translated_label_id\" >";
                        echo "<input type='hidden' name=\"english_label_id$i\" value=\"$key\">";
                        echo "<input type='hidden' name=\"original_label_text$i\" value=\"$translated_label_text\">";

                        //echo "<input type='text' name=\"translated_label_id$i\" value=\"$translated_label_id\" size='2' readonly='readonly'>";
                        //echo "<input type='text' name=\"english_label_id$i\" value=\"$key\" size='2' readonly='readonly'>";
                        //echo "<input type='text' name=\"original_label_text$i\" value=\"$translated_label_text\" readonly='readonly'>";

                        //echo $value['translated_label_id'];
                        echo '</td>';

                        echo '<td>';
                        echo "<input type='text' name=\"translated_label_text$i\" value=\"$translated_label_text\" size='40'>";
                        //echo $value['translated_label_text'];
                        echo '</td>';

                        echo '<td>';
                        echo $value['label_meangin'];
                        echo '</td>';

                    echo '</tr>';

                    $i++;
                }

            }

            ?>
        </table>

        <div class="row">
            <input type="hidden" name="no_of_records" id="no_of_records" value="<?php echo sizeof($data);?>">
            <input type='hidden' name="language_code" value="<?php echo $language_selected; ?>">
            <?php
            $button_text = (isset($translations['common_labels']['Save'])?$translations['common_labels']['Save']:'Save');
            ?>
            <input type="button" value="<?php echo $button_text; ?>" onclick="modifylanguages_form()">

        </div>
        
        <?php
        /*
        echo '<pre>';
        print_r($data);
        echo '</pre>';
         * 
         */
        ?>


    </div>


</div>
<?php } ?>


<?php $this->endWidget(); ?>


<script type="text/javascript">
    function submit_getlanguages_form(){
        document.getElementById('getlanguages-form').submit();
    }

    function modifylanguages_form(){
        document.getElementById('modifylanguages-form').submit();
    }
</script>
