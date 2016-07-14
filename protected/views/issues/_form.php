<?php
/* @var $this IssuesController */
/* @var $model Issues */
/* @var $form CActiveForm */
//print_r($_POST);
//echo date('m-d-Y h:i:s a', time());
//echo Yii::app()->user->userId;

?>
<div id="cspec_top">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'issues-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'task'); ?>
		<?php echo $form->textField($model,'task',array('size'=>60,'maxlength'=>100)); ?>
		<?php //echo $form->error($model,'task'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'projectid'); ?>
		<?php
                //print_r($projects_data);
                //echo $form->textField($model,'projectid',array('size'=>60,'maxlength'=>200));
                //var_dump($model->isNewRecord);
                $prids_in_session = Yii::app()->session['projectsarr'];
                
                if($model->isNewRecord == 1){
                    $i = 0;
                    $j = 0;
                    foreach($projects_data As $pd){

                        if(isset($_POST['Issues']['projectid'])){
                            if($_POST['Issues']['projectid'][$i] == $pd->id){
                                echo "<input type='checkbox' name=\"Issues[projectid][]\" class='projects' value=\"$pd->id\" checked='checked'> $pd->projectname</input> <br>";
                                $i++;
                            }else{
                                echo "<input type='checkbox' name=\"Issues[projectid][]\" class='projects' value=\"$pd->id\"> $pd->projectname</input> <br>";
                            }

                        }else if(isset(Yii::app()->session['projectsarr']) && !isset($_POST['Issues']['projectid'])){
                            $prids_in_session = Yii::app()->session['projectsarr'];
                            if($prids_in_session[$j] == $pd->id){
                                echo "<input type='checkbox' name=\"Issues[projectid][]\" class='projects' value=\"$pd->id\" checked='checked'> $pd->projectname</input> <br>";
                                $j++;
                            }else{
                                echo "<input type='checkbox' name=\"Issues[projectid][]\" class='projects' value=\"$pd->id\"> $pd->projectname</input> <br>";
                            }
                            
                        }else{
                            echo "<input type='checkbox' name=\"Issues[projectid][]\" class='projects' value=\"$pd->id\"> $pd->projectname</input> <br>";
                        }

                    }
                    echo "<input type='checkbox' name=\"checkAll\" id=\"checkAll\"> All</input> <br>";
                    
                  }else{
                      $projectsarray = explode(',',$model->projectid);
                      
                      $i = 0;
                        foreach($projects_data As $pd){

                            if(sizeof($projectsarray) > 0){
                                if($projectsarray[$i] == $pd->id){
                                    echo "<input type='checkbox' name=\"Issues[projectid][]\" class='projects' value=\"$pd->id\" checked='checked'> $pd->projectname</input> <br>";
                                    $i++;
                                }else{
                                    echo "<input type='checkbox' name=\"Issues[projectid][]\" class='projects' value=\"$pd->id\"> $pd->projectname</input> <br>";
                                }

                            }else{
                                echo "<input type='checkbox' name=\"Issues[projectid][]\" class='projects' value=\"$pd->id\"> $pd->projectname</input> <br>";
                            }

                        }
                        echo "<input type='checkbox' name=\"checkAll\" id=\"checkAll\"> All</input> <br>";
                  }
                ?>
		<?php //echo $form->error($model,'projectid'); ?>
	</div>
        <script>
            $(function(){
                $("#checkAll").click(function(){
                    if($("#checkAll").attr('checked')){
                        $(".projects").attr('checked', true);
                    }else{
                        $(".projects").attr('checked', false);
                    }
                });
            });
            </script>
	<div class="row">
		<?php echo $form->labelEx($model,'statusid'); ?>
		<?php 
                
                if($model->isNewRecord ==1) {
                   
                    $options[$selected]= array('selected'=>true);
                    echo $form->dropDownList($model,'statusid',CHtml::listData(Issuestatus::model()->findAllByPk(1), 'id', 'statusname'), array("style"=>"display:block"));
                    
                }else{
                    //echo $form->textField($model,'statusid'); 
                    $options[$selected]= array('selected'=>true);
                    echo $form->dropDownList($model,'statusid',CHtml::listData(Issuestatus::model()->findAll(), 'id', 'statusname'), array('prompt'=>'Select Status','options'=>$options,"style"=>"display:block"));
                }
                ?>
		<?php //echo $form->error($model,'statusid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timeline'); ?>
		<?php
                //echo $form->textField($model,'timeline');
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $model,
                                'attribute' => 'timeline',
                                'htmlOptions' => array(
                                'size' => '10',         // textField size
                                'maxlength' => '10',    // textField maxlength
                                //'style'=>'display:none',
                                ),

                                'options' => array(
                                'showAnim' => 'fold',
                                'dateFormat'=>'yy-mm-dd',
                                //'dateFormat'=>$formatted_date,    
                                ),

                            ));
                ?>
		<?php //echo $form->error($model,'timeline'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('rows'=>6, 'cols'=>50)); ?>
		<?php //echo $form->error($model,'comments'); ?>
	</div>
            
        <div class="row">
                <?php echo $form->labelEx($model,'issuetype'); ?>
		<?php
                //echo $form->textField($model,'issuetype');
                /*
                 * if client
                 */
                if(Yii::app()->user->getState('roleId') == 5){
                    $options[$selected]= array('selected'=>true);
                    echo $form->dropDownList($model,'issuetype',CHtml::listData(IssueType::model()->findAllByPK(1), 'id', 'issuetype'), array('options'=>$options,"style"=>"display:block"));
                    
                }else{
                                       
                    if(Yii::app()->user->userId != 1 || Yii::app()->user->userId != 8){
                        /*
                         * if member of team aranxa
                         */
                        $options[$selected]= array('selected'=>true);
                        echo $form->dropDownList($model,'issuetype',CHtml::listData(IssueType::model()->findAll(), 'id', 'issuetype'), array('options'=>$options,"style"=>"display:block"));

                    }else{

                        $options[$selected]= array('selected'=>true);
                        echo $form->dropDownList($model,'issuetype',CHtml::listData(IssueType::model()->findAllByPK(2), 'id', 'issuetype'), array('options'=>$options,"style"=>"display:block"));
                    }
                }
                ?>
            
		<?php //echo $form->error($model,'issuetype'); ?>
	</div>
            
        <div class="row">
            <?php echo $form->labelEx($model,'issue_category'); ?>
            <?php echo $form->dropDownList($model,'issue_category',CHtml::listData(IssueCategories::model()->findAll(), 'id', 'category_name'), array('prompt'=>'','options'=>$options,"style"=>"display:block"));?>
            <?php echo $form->error($model,'issue_category'); ?>
        </div>
            
        <div class="row">
            <?php echo $form->labelEx($model,'priority'); ?>
            <?php echo $form->dropDownList($model,'priority',CHtml::listData(IssueSeverities::model()->findAll(), 'id', 'severity_label'), array('options'=>$options,"style"=>"display:block"));?>
            <?php echo $form->error($model,'priority'); ?>
        </div>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'createdby'); ?>
		<?php echo $form->textField($model,'createdby'); ?>
		<?php echo $form->error($model,'createdby'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'createddate'); ?>
		<?php echo $form->textField($model,'createddate'); ?>
		<?php echo $form->error($model,'createddate'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>