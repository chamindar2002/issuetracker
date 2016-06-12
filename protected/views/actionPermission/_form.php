<?php
/* @var $this ActionPermissionController */
/* @var $model ActionPermission */
/* @var $form CActiveForm */
?>
<div id="cspec_top">
    <div class="form">

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'action-permission-form',
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
            <?php echo $form->labelEx($model,'module'); ?>
            <?php echo $form->textField($model,'module',array('size'=>50,'maxlength'=>50)); ?>
            <?php echo $form->error($model,'module'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'action'); ?>
            <?php echo $form->textField($model,'action',array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'action'); ?>
        </div>

        <div class="row">
            <?php //echo $form->labelEx($model,'description'); ?>
            <?php //echo $form->textField($model,'description',array('size'=>60,'maxlength'=>150)); ?>
            <?php //echo $form->error($model,'description'); ?>
        </div>

        <div class="row">
            <?php //echo $form->labelEx($model,'systemid'); ?>
            <?php //echo $form->textField($model,'systemid'); ?>
            <?php //echo $form->error($model,'systemid'); ?>
        </div>

        <div class="row buttons">
            <?php
            $btn_create_text = (isset($translations['common_labels']['Create'])?$translations['common_labels']['Create']:'Create');
            $btn_Save_text = (isset($translations['common_labels']['Save'])?$translations['common_labels']['Save']:'Save');
            echo CHtml::submitButton($model->isNewRecord ? $btn_create_text : $btn_Save_text);
            //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');

            $btn_cancel_text = (isset($translations['common_labels']['Cancel'])?$translations['common_labels']['Cancel']:'Cancel');
            $tip_cancel = (isset($translations['common_labels']['tip_cancel'])?$translations['common_labels']['tip_cancel']:'Cancel');
            echo CHtml::link($btn_cancel_text,Yii::app()->request->urlReferrer,array('title'=>$tip_cancel,'class'=>'cancel_button'));
            ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>