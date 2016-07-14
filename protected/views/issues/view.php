<?php
/* @var $this IssuesController */
/* @var $model Issues */
//echo Yii::app()->user->userId;


$this->breadcrumbs=array(
	'Issues'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Issues', 'url'=>array('index')),
	array('label'=>'Create Issues', 'url'=>array('create')),
	array('label'=>'Update Issues', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Issues', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Issues', 'url'=>array('admin')),
);
?>

<div id="cspec_top">
    <table width="100%">
        <tr><td colspan="2"><strong><?php echo $model->task;?></strong></td></tr>
        <tr>
            <td width="30%">
                <table>
                    
                    <tr>
                        <td>Id:</td><td><?php echo $model->id; ?></td>
                    </tr>
                    <tr>
                        <td>Project:</td><td><?php echo Projects::model()->findByPk($model->projectid)->projectname; ?></td>
                    </tr>
                    <tr>
                        <td>Status:</td><td><?php echo Issuestatus::model()->findByPk($model->statusid)->statusname; ?></td>
                    </tr>
                    <tr>
                        <td>Time Line:</td><td><?php echo $model->timeline; ?></td>
                    </tr>
                    
                </table>    
            </td>
            <td width="70%" valign="top">
                <table>
                    <tr>
                        <td>Created:</td><td><?php echo User::model()->findByPk($model->createdby)->loginname.' -- '.$model->createddate; ?></td>
                    </tr>
                    <tr>
                        <td>Last Modified:</td><td><?php echo User::model()->findByPk($model->lastmodifiedby)->loginname.' -- '.$model->lastmodifieddate; ?></td>
                    </tr>
                    <tr>
                        <td>Team:</td>
                        <td>
                            <?php
                             foreach($projectteamData As $pd){
                                 echo $pd['userfname'].',';
                             }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                </table>
                
            </td>
        </tr>
    </table>
    
    
 
    


<style>
/*    #tblfeedback tr td{border:1px solid black;}*/
#tblcommnets{
    border-collapse: collapse;
    background: #f1f1f1;
}
#tblcommnets td{
    padding: 3px;
}

.lang_even{
    background: #ffffff;
}
.lang_odd{
    
}

#notice{
    font-weight: bold;
    color:#FF3300;
}
</style>

<?php $this->beginClip('addcomments_box'); ?>

<div id="cspec_top">
<?php $this->beginWidget('CActiveForm', array(
            'id'=>'frmaddcomment',
            'enableAjaxValidation'=>false,
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
            ),
            'action'=>Yii::app()->createUrl('//issuefeedback/add'),
        )); ?>
    
<table id="tblfeedback">
    <tr>
        <td>
            <input type="hidden" name="txtissueid" id="txtissueid" value="<?php echo $model->id; ?>">
            <strong>Comments</strong>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo CHtml::textArea('comments','',array('rows'=>6, 'cols'=>50)); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo CHtml::label('Upload File', 'file1'); ?>
            <?php echo CHtml::fileField('file1'); ?>
            <?php //echo $form->error($model, 'file1'); ?>
            <br>
            <span id='notice'>
                Note: Please make sure the file names does NOT contain spaces or any special characters.
            </span>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo CHtml::button('Save',array('id'=>'confirmsave')); ?>
        </td>
    </tr>
    
</table>
</div>
<?php $this->endWidget(); ?>

<?php $this->endClip(); ?>

<?php $commentsbox = $this->clips['addcomments_box']; ?>




<br>
    
    <table width="100%" id='tblcommnets'>
        <tr>
            <td><strong>History</strong></td>
            <td>
                <?php

                //http://www.yiiframework.com/extension/econtentlightbox/
                 $this->widget('application.extensions.ELightBoxContentWidget.ELightBoxContentWidget',
                         array(
                          'classname'=> "show_div_on_lightbox" ,
                           'divid'   =>"div_lightbox",
                           'width'   => '600px',
                           'content' => $commentsbox,// content variable will carry html data to be displayed
                           'linklabel'=>"Add New Comment",
                     ) );

                ?>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr><td><?php echo $model->comments; ?></td><td><strong><?php echo User::model()->findByPk($model->createdby)->loginname.' -- '.$model->createddate; ?></strong></td></tr>
        
        <?php
        //echo  Yii::getPathOfAlias('webroot');exit;
        if(sizeof($issueFeedbackData) > 0){
            $i = 0;
            foreach($issueFeedbackData As $ifbd){
                $cssClass = ($i % 2 == 0) ? "lang_even" : "lang_odd";
                
                echo '<tr class='.$cssClass.'>';
                    echo '<td>'.$ifbd->comment.'</td>';
                    echo '<td><strong>'.User::model()->findByPk($ifbd->createdby)->loginname.' -- '.$ifbd->createddate.'</strong></td>';
                    echo '<td>';
                    
                    $filetype = substr($ifbd->file1, -3,3);
                    if(strtolower($filetype) == 'jpg' || strtolower($filetype) == 'gif' || strtolower($filetype) == 'png'){
                       echo CHtml::image((Yii::app()->request->baseUrl . '/uploadedfiles/' . $ifbd->file1), "image", array("width" => 50));
                       echo "<br><a href =".Yii::app()->createUrl('//issuefeedback/Downloadfile/id/'.$ifbd->file1).">Download</a>"; 
                       
                       
                       $this->widget('application.extensions.ELightBoxContentWidget.ELightBoxContentWidget',
                         array(
                          'classname'=> "show_div_on_lightbox" ,
                           'divid'   =>"div_lightbox_$i",
                           'width'   => '1000px',
                           'content' => CHtml::image((Yii::app()->request->baseUrl . '/uploadedfiles/' . $ifbd->file1), "image", array("width" => 700)),// content variable will carry html data to be displayed
                           'linklabel'=>" | Show",
                        ) );
                       
                       
                    }else{
                        //echo '<a href='.Yii::app()->request->baseUrl . '/uploadedfiles/' . $ifbd->file1.'/>'.$ifbd->file1.'</a>';
                        //echo "<a href =".Yii::app()->createUrl(Yii::getPathOfAlias('webroot') . '/uploadedfiles/' . $ifbd->file1)." target='blank'>download</a>";
                        //echo CHtml::link("Download",Yii::getPathOfAlias('webroot') . '/uploadedfiles/' . $ifbd->file1,array('class'=>'donwload_link'));
                        //echo CHtml::link("Download",'downloadfile&file=' . $ifbd->file1,array('class'=>'donwload_link'));
                        if($ifbd->file1 != ''){
                            echo $ifbd->file1." <a href =".Yii::app()->createUrl('//issuefeedback/Downloadfile/id/'.$ifbd->file1).">Download</a>";
                        }else{
                            echo '..';
                        }
                    }
                    echo '</td>';
                echo '</tr>';
                $i++;
            }
        }
        ?>
    </table>
</div>

<?php
Yii::app()->clientScript->registerScript('cabin-bookin-scripts', "
    
    $('#confirmsave').click(function(){
        
        var comment = $('#comments').val();
       
        if(comment.length > 5){
            $('#frmaddcomment').submit();
        }else{
            alert('Invalid comment: minimum 5 characters required');
        }
        
    });

    
");
?>