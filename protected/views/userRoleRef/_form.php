<?php
/* @var $this UserRoleRefController */
/* @var $model UserRoleRef */
/* @var $form CActiveForm */
?>

<?php
foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<div id="cspec_top">
    
    <?php if($model->isNewRecord != 1){ ?> 
        <div class='view_edit_links_holder'>
            <a id='edit_btn'>Edit Mode</a>
            <a id='view_btn' style='display:none'>View Mode</a>
        </div>
    <?php } ?>
    
    <div class="form">

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'user-role-ref-form',
            'enableAjaxValidation'=>false,
        )); ?>

        <p class="note">
            <?php
                $req_fields = (isset($translations['common_labels']['Fields_Required'])?$translations['common_labels']['Fields_Required']:"Indicates a mandatory field");
                //echo $req_fields;
                echo "<span class='required'>*</span> $req_fields";
            ?>
            <!--Fields with <span class="required">*</span> are required.-->
        </p>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'uid'); ?>
            <?php
            //echo $form->textField($model,'uid');
            if ($model->isNewRecord != 1) { 
                $options[$selected]= array('selected'=>true);
                echo $form->dropDownList($model,'uid',CHtml::listData(User::model()->findAll(), 'uid', 'loginname'),
                        array('prompt'=>'Select User','options'=>$options,'style'=>'display:none'));
                
                $users = User::model()->findByPk($model->uid);
                echo CHtml::textField('txt_uid',$users->loginname,
                        array('size'=>20, 'maxlength'=>20,'readonly'=>'readonly','class'=>'greyed_out'));
            }else{
                $options[$selected]= array('selected'=>true);
                echo $form->dropDownList($model,'uid',CHtml::listData(User::model()->findAll(), 'uid', 'loginname'),
                        array('prompt'=>'Select User','options'=>$options));
            }
            ?>
            <?php echo $form->error($model,'uid'); ?>
            
            <?php if ($model->isNewRecord != 1) { 
                  EditSaveNavs::appendEditSaveNavlinks('uid');
            } ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'rid'); ?>
            <?php
            //echo $form->textField($model,'rid');
            if ($model->isNewRecord != 1) { 
                $options[$selected]= array('selected'=>true);
                echo $form->dropDownList($model,'rid',CHtml::listData(Role::model()->findAll(), 'rid', 'name'), 
                        array('prompt'=>'Select Role','options'=>$options,'style'=>'display:none'));
                
                $roles = Role::model()->findByPk($model->rid);
                echo CHtml::textField('txt_rid',$roles->name,
                        array('size'=>20, 'maxlength'=>20,'readonly'=>'readonly','class'=>'greyed_out'));
            }else{
                echo $form->dropDownList($model,'rid',CHtml::listData(Role::model()->findAll(), 'rid', 'name'), 
                        array('prompt'=>'Select Role','options'=>$options));
            }
            ?>
            <?php echo $form->error($model,'rid'); ?>
            
            <?php if ($model->isNewRecord != 1) { 
                  EditSaveNavs::appendEditSaveNavlinks('rid');
            } ?>
        </div>

        <div class="row buttons">
            <?php
            /* $btn_create_text = (isset($translations['common_labels']['Create'])?$translations['common_labels']['Create']:'Create');
              $btn_Save_text = (isset($translations['common_labels']['Save'])?$translations['common_labels']['Save']:'Save');
              echo CHtml::submitButton($model->isNewRecord ? $btn_create_text : $btn_Save_text);
              //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');

              $btn_cancel_text = (isset($translations['common_labels']['Cancel'])?$translations['common_labels']['Cancel']:'Cancel');
              $tip_cancel = (isset($translations['common_labels']['tip_cancel'])?$translations['common_labels']['tip_cancel']:'Cancel');
              echo CHtml::link($btn_cancel_text,Yii::app()->request->urlReferrer,array('title'=>$tip_cancel,'class'=>'cancel_button'));
             * 
             */
            ?>

            <?php if ($model->isNewRecord != 1) { ?>

                <div class='save_cancel_button_holder' id="save_cancel_button_holder">


                    <?php
                    $btn_create_text = (isset($translations['common_labels']['Create']) ? $translations['common_labels']['Create'] : 'Create');
                    $btn_Save_text = (isset($translations['common_labels']['Save']) ? $translations['common_labels']['Save'] : 'Save');
                    echo CHtml::submitButton($model->isNewRecord ? $btn_create_text : $btn_Save_text);


                    $btn_cancel_text = (isset($translations['common_labels']['Cancel']) ? $translations['common_labels']['Cancel'] : 'Cancel');
                    $tip_cancel = (isset($translations['common_labels']['tip_cancel']) ? $translations['common_labels']['tip_cancel'] : 'Cancel');
                    echo CHtml::link($btn_cancel_text, Yii::app()->request->urlReferrer, array('title' => $tip_cancel, 'class' => 'cancel_button'));
                    ?>

                </div>

            <?php } else { ?>


                <?php
                $btn_create_text = (isset($translations['common_labels']['Create']) ? $translations['common_labels']['Create'] : 'Create');
                $btn_Save_text = (isset($translations['common_labels']['Save']) ? $translations['common_labels']['Save'] : 'Save');
                echo CHtml::submitButton($model->isNewRecord ? $btn_create_text : $btn_Save_text);


                $btn_cancel_text = (isset($translations['common_labels']['Cancel']) ? $translations['common_labels']['Cancel'] : 'Cancel');
                $tip_cancel = (isset($translations['common_labels']['tip_cancel']) ? $translations['common_labels']['tip_cancel'] : 'Cancel');
                echo CHtml::link($btn_cancel_text, Yii::app()->request->urlReferrer, array('title' => $tip_cancel, 'class' => 'cancel_button'));
                ?>


            <?php } ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->

</div>

<?php
Yii::app()->clientScript->registerScript('format_golf_club_number', "

//-------------------------------txt_uid--------------------------
$('#txt_uid').dblclick(function(){
     $.fn.show_edit_cancel_nav_links('_uid');
});

$('#enable_uid').click(function(){
    $('#UserRoleRef_uid').show();
    $('#txt_uid').hide();
});

$('#disable_uid').click(function(){
    $('#UserRoleRef_uid').hide();
    $('#txt_uid').show();
    $.fn.disable_text_box('','_uid');
});

$('#save_uid').click(function(){
    $.fn.submitSave();
});


//-------------------------------txt_rid--------------------------
$('#txt_rid').dblclick(function(){
     $.fn.show_edit_cancel_nav_links('_rid');
});

$('#enable_rid').click(function(){
    $('#UserRoleRef_rid').show();
    $('#txt_rid').hide();
});

$('#disable_rid').click(function(){
    $('#UserRoleRef_rid').hide();
    $('#txt_rid').show();
    $.fn.disable_text_box('','_rid');
});

$('#save_rid').click(function(){
    $.fn.submitSave();
});


//----------------------------------edit/view button click---------------------

$('#edit_btn').click(function(){
    $('#view_btn').show();
    $('#edit_btn').hide();
    
    $('#save_cancel_button_holder').slideDown('slow');
    $.fn.enable_all_text_fields();
});

$('#view_btn').click(function(){
    $('#view_btn').hide();
    $('#edit_btn').show();
    
    $('#save_cancel_button_holder').slideUp('slow');
    $.fn.disable_all_text_fields();
});


//--------------------------------functions-------------------------------
$.fn.show_edit_cancel_nav_links = function(nav_name) {
   
    if($('#edit_btn').is(':visible')){
        $('#nav'+nav_name).slideToggle('slow');
    }
};

$.fn.enable_text_box = function(textbox_name) {
    $('#UserRoleRef_'+textbox_name).css({'background-color': '#fff'});
    $('#UserRoleRef_'+textbox_name).attr('readonly', false);
    $('#UserRoleRef_'+textbox_name).focus();
};

$.fn.disable_text_box = function(textbox_name,nav_name) {

    $('#user-role-ref-form').reset();
     
    $('#UserRoleRef_'+textbox_name).css({'background-color': '#f1f1f1'});
    $('#UserRoleRef_'+textbox_name).attr('readonly', true);
    
    $.fn.show_edit_cancel_nav_links(nav_name);
};

jQuery.fn.reset = function () {
  $(this).each (function() { this.reset(); });
}

$.fn.submitSave = function() {
    $('#user-role-ref-form').submit();
};

//-----------------------------enable all text fields----------------------
$.fn.enable_all_text_fields = function(nav_name) {
   $('#txt_uid').hide();
   $('#UserRoleRef_uid').show();
   $('#nav_uid').slideUp();
   
   $('#txt_rid').hide();
   $('#UserRoleRef_rid').show();
   $('#nav_rid').slideUp();
}

//-----------------------------disable all text fields----------------------
$.fn.disable_all_text_fields = function(nav_name) {
   $('#txt_uid').show();
   $('#UserRoleRef_uid').hide();
   
   $('#txt_rid').show();
   $('#UserRoleRef_rid').hide();
   
    $('#user-role-ref-form').reset();
}

");
?>

