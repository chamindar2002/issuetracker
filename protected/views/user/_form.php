<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
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
            'id'=>'user-form',
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
            <?php //echo $form->labelEx($model,'enabled'); ?>
            <?php //echo $form->textField($model,'enabled'); ?>
            <?php //echo $form->error($model,'enabled'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'loginname'); ?>
            <?php
            if ($model->isNewRecord != 1) {
                echo $form->textField($model,'loginname',
                        array('size'=>60,'maxlength'=>200,'readonly'=>'readonly','class'=>'greyed_out')); 
            }else{
                echo $form->textField($model,'loginname',array('size'=>60,'maxlength'=>200)); 
            }
            ?>
            <?php echo $form->error($model,'loginname'); ?>
            <?php if ($model->isNewRecord != 1) { 
                        
                  EditSaveNavs::appendEditSaveNavlinks('loginname');

            } ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'familyname'); ?>
            <?php 
            if ($model->isNewRecord != 1) {
                echo $form->textField($model,'familyname',
                        array('size'=>60,'maxlength'=>200,'readonly'=>'readonly','class'=>'greyed_out'));
            }else{
                echo $form->textField($model,'familyname',array('size'=>60,'maxlength'=>200));
            }
            ?>
            <?php echo $form->error($model,'familyname'); ?>
            <?php if ($model->isNewRecord != 1) { 
                        
                  EditSaveNavs::appendEditSaveNavlinks('familyname');

            } ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'firstname'); ?>
            <?php 
            if ($model->isNewRecord != 1) {
                echo $form->textField($model,'firstname',
                        array('size'=>60,'maxlength'=>200,'readonly'=>'readonly','class'=>'greyed_out'));
            }else{
                echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>200));
            }    
            ?>
            <?php echo $form->error($model,'firstname'); ?>
            <?php if ($model->isNewRecord != 1) { 
                        
                  EditSaveNavs::appendEditSaveNavlinks('firstname');

            } ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'password'); ?>
            <?php
            if ($model->isNewRecord != 1) {
                echo $form->passwordField($model,'password',
                        array('size'=>60,'maxlength'=>200,'readonly'=>'readonly','class'=>'greyed_out'));
            }else{
                echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>200));
            }
            ?>
            <?php echo $form->error($model,'password'); ?>
            <?php if ($model->isNewRecord != 1) { 
                        
                  EditSaveNavs::appendEditSaveNavlinks('password');

            } ?>
        </div>

        <div class="row" style="display:none" id="div_golfunion">
            <?php
            $golf_union_label_text = (isset($translations['Golf Union'])?$translations['Golf Union']:'Association');
            echo $form->labelEx($model,$golf_union_label_text);
                
            ?>

            <?php
                /*  
                $prompt_select_union_text = (isset($translations['Select Union'])?$translations['Select Union']:'Select Association');

                $unionsArray = CHtml::listData(GolfUnion::model()->findAll(),'union_id','union_name');
                echo $form->DropDownList(GolfUnion::model(),'union_id',$unionsArray,
                array(
                'prompt'=>$prompt_select_union_text,
                'ajax' => array(
                'type'=>'POST',
                'url'=>CController::createUrl('user/listclubs'),
                'update'=>'#User_club_id','data'=>array('union_id'=>'js:this.value'),)));
                 * 
                 */
            
            ?>
            <?php //echo $form->error($model,'deleted'); ?>
            
        </div>

        <div class="row">
            <?php //echo $form->labelEx($model,'club_id'); ?>
            <?php
            echo $form->hiddenField($model,'club_id',array('size'=>60,'maxlength'=>200,'value'=>'1'));
            
            /*
            if ($model->isNewRecord != 1) {
                $prompt_select_golf_club = (isset($translations['Select Club'])?$translations['Select Club']:'Select Club');

                $options[$selected]= array('selected'=>true);

                if(($action = Yii::app()->controller->action->id) == 'create') {
                    echo $form->dropDownList($model,'club_id',array(), array('prompt'=>$prompt_select_golf_club,'options'=>$options));
                }else {

                    //$clubsArray = GolfClub::model()->findAll(array('condition'=>'gc_id='.$model->club_id));
                    $clubsArray = GolfClub::model()->findAll();
                    echo $form->dropDownList($model,'club_id',CHtml::listData($clubsArray,'gc_id', 'gc_name'),
                            array('prompt'=>$prompt_select_golf_club,'options'=>$options,'style'=>'display:none'));
                    
                    $clubs = GolfClub::model()->findByPk($model->club_id);
                    echo CHtml::textField('txt_club_id', $clubs->gc_name,array('size'=>'30','readonly'=>'readonly','class'=>'greyed_out'));
                }
            }else{
                $prompt_select_golf_club = (isset($translations['Select Club'])?$translations['Select Club']:'Select Club');

                $options[$selected]= array('selected'=>true);

                if(($action = Yii::app()->controller->action->id) == 'create') {
                    echo $form->dropDownList($model,'club_id',array(), array('prompt'=>$prompt_select_golf_club,'options'=>$options));
                }else {

                    $clubsArray = GolfClub::model()->findAll(array('condition'=>'gc_id='.$model->club_id));
                    echo $form->dropDownList($model,'club_id',CHtml::listData($clubsArray,'gc_id', 'gc_name'),array('prompt'=>$prompt_select_golf_club,'options'=>$options));

                }
            }
            ?>
            <?php echo $form->error($model,'club_id'); ?>
            <?php if ($model->isNewRecord != 1) { 
                        
                  EditSaveNavs::appendEditSaveNavlinks('club_id');

            }*/
            ?>
        </div>

        <div class="row">
            <?php //echo $form->labelEx($model,'deleted'); ?>
            <?php //echo $form->textField($model,'deleted'); ?>
            <?php //echo $form->error($model,'deleted'); ?>
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
            }
            ?>


        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->

</div>


<?php 
Yii::app()->clientScript->registerScript('format_golf_club_number', "


//-------------------------------loginname--------------------------
$('#User_loginname').dblclick(function(){
     $.fn.show_edit_cancel_nav_links('_loginname');
});

$('#enable_loginname').click(function(){
    $.fn.enable_text_box('loginname');
});

$('#disable_loginname').click(function(){
    $.fn.disable_text_box('loginname','_loginname');
});

$('#save_loginname').click(function(){
    $.fn.submitSave();
});

//-------------------------------User_familyname--------------------------
$('#User_familyname').dblclick(function(){
     $.fn.show_edit_cancel_nav_links('_familyname');
});

$('#enable_familyname').click(function(){
    $.fn.enable_text_box('familyname');
});

$('#disable_familyname').click(function(){
    $.fn.disable_text_box('familyname','_familyname');
});

$('#save_familyname').click(function(){
    $.fn.submitSave();
});

//-------------------------------User_firstname--------------------------
$('#User_firstname').dblclick(function(){
     $.fn.show_edit_cancel_nav_links('_firstname');
});

$('#enable_firstname').click(function(){
    $.fn.enable_text_box('firstname');
});

$('#disable_firstname').click(function(){
    $.fn.disable_text_box('firstname','_firstname');
});

$('#save_firstname').click(function(){
    $.fn.submitSave();
});


//-------------------------------User_password--------------------------
$('#User_password').dblclick(function(){
     $.fn.show_edit_cancel_nav_links('_password');
});

$('#enable_password').click(function(){
    $.fn.enable_text_box('password');
});

$('#disable_password').click(function(){
    $.fn.disable_text_box('password','_password');
});

$('#save_password').click(function(){
    $.fn.submitSave();
});


//-------------------------------club_id--------------------------
$('#txt_club_id').dblclick(function(){
     $.fn.show_edit_cancel_nav_links('_club_id');
});

$('#enable_club_id').click(function(){
    $('#User_club_id').show();
    $('#txt_club_id').hide();
    
    $('#div_golfunion').show();
    $('#div_golfunion').focus();
    
});

$('#disable_club_id').click(function(){
        
    $('#User_club_id').hide();
    $('#txt_club_id').show();
    
    $('#div_golfunion').hide();
    
    $.fn.disable_text_box('','_club_id');
    
});

$('#save_club_id').click(function(){
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
    $('#User_'+textbox_name).css({'background-color': '#fff'});
    $('#User_'+textbox_name).attr('readonly', false);
    $('#User_'+textbox_name).focus();
};

$.fn.disable_text_box = function(textbox_name,nav_name) {

    $('#user-form').reset();
        
    $('#User_'+textbox_name).css({'background-color': '#f1f1f1'});
    $('#User_'+textbox_name).attr('readonly', true);
    
    $.fn.show_edit_cancel_nav_links(nav_name);
};

$.fn.submitSave = function() {
    $('#user-form').submit();
};

jQuery.fn.reset = function () {
  $(this).each (function() { this.reset(); });
}


//-----------------------------enable all text fields----------------------
$.fn.enable_all_text_fields = function(nav_name) {

   $.fn.enable_text_box('familyname');
   $('#nav_familyname').slideUp();
   
   $.fn.enable_text_box('firstname');
   $('#nav_firstname').slideUp();
   
   $.fn.enable_text_box('password');
   $('#nav_password').slideUp();
   
   $('#User_club_id').show();
   $('#txt_club_id').hide();
   $('#div_golfunion').show();
   $('#nav_club_id').slideUp();
   
   $.fn.enable_text_box('loginname');
   $('#nav_loginname').slideUp();
}

//-----------------------------disable all text fields----------------------
$.fn.disable_all_text_fields = function(nav_name) {

   $.fn.disable_text_box('familyname');
      
   $.fn.disable_text_box('firstname');
      
   $.fn.disable_text_box('password');
      
   $('#User_club_id').hide();
   $('#txt_club_id').show();
   
   $('#div_golfunion').hide();
   
   $.fn.disable_text_box('loginname');
   
}

");