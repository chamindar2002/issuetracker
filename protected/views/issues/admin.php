<?php
/* @var $this IssuesController */
/* @var $model Issues */

$this->breadcrumbs=array(
	'Issues'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Issues', 'url'=>array('index')),
	array('label'=>'Create Issues', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#issues-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php if(!isset($_GET['issuestat'])){ ?>
<h1>Manage Issues</h1>
<?php
}  else {
    $status_headings = array('1'=>'Pending','2'=>'Done','3'=>'Closed');
    echo '<h1>Manage Issues :: '.$status_headings[$_GET['issuestat']].'</h1>';
}

?>
<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<style>
    ._orange{
        color: orange;
        font-weight: bold;
    }
    ._green{
        color:green;
        font-weight: bold;
    }
    ._red{
        color:red;
        font-weight: bold;
    }
    
    ._blue{
        color:blue;
        font-weight: bold;
    }
</style>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
if(!isset($_GET['issuestat'])){
    
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'issues-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'task',
		//'projectid',
                array(
                    'name'=>'projectid',
                    'value'=>'getUnserializedProjects($data->projectid)',
                    'filter' => CHtml::listData(Projects::model()->findAll(), 'id', 'projectname'),
                ),
		'timeline',
		//'comments',
                array(
                    'name'=>'comments',
                    //'value'=>'$data->description',
                    'value' => 'Issues::model()->trunctateText($data->comments,90)',
                    'htmlOptions'=>array('width'=>'420px'),
                  ),
                //'statusid',
                array(
                  'name'=>'statusid',
                  'value'=>'Issuestatus::model()->findByPk($data->statusid)->statusname',
                  'filter' => CHtml::listData(Issuestatus::model()->findAll(), 'id', 'statusname'),
                  'cssClassExpression' => 'getCssClass($data->statusid)',
                     //'Inventory::model()->findByPk($data->inventoryid)->chassisno',
                ),
            
                array(
                  'name'=>'priority',
                  'value'=>'IssueSeverities::model()->findByPk($data->priority)->severity_label',
                  'filter' => CHtml::listData(IssueSeverities::model()->findAll(), 'id', 'severity_label'),
                  //'cssClassExpression' => 'getCssClass($data->statusid)',
                     //'Inventory::model()->findByPk($data->inventoryid)->chassisno',
                ),
            
                array(
                  'name'=>'issue_category',
                  'value'=>'IssueCategories::model()->findByPk($data->issue_category)->category_name',
                  'filter' => CHtml::listData(IssueCategories::model()->findAll(), 'id', 'category_name'),
                  //'cssClassExpression' => 'getCssClass($data->statusid)',
                     //'Inventory::model()->findByPk($data->inventoryid)->chassisno',
                ),
		/*
		'createdby',
		'createddate',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
));

}else{
    
       
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'issues-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'task',
		//'projectid',
                array(
                    'name'=>'projectid',
                    'value'=>'getUnserializedProjects($data->projectid)',
                    'filter' => CHtml::listData(Projects::model()->findAll(), 'id', 'projectname'),
                ),
		'timeline',
		//'comments',
                array(
                    'name'=>'comments',
                    //'value'=>'$data->description',
                    'value' => 'Issues::model()->trunctateText($data->comments,90)',
                    'htmlOptions'=>array('width'=>'420px'),
                  ),
                //'statusid',
                array(
                  'name'=>'statusid',
                  'value'=>'Issuestatus::model()->findByPk($data->statusid)->statusname',
                  'filter' => false,
                  'cssClassExpression' => 'getCssClass($data->statusid)',
                     //'Inventory::model()->findByPk($data->inventoryid)->chassisno',
                ),
            
                array(
                  'name'=>'priority',
                  'value'=>'IssueSeverities::model()->findByPk($data->priority)->severity_label',
                  'filter' => CHtml::listData(IssueSeverities::model()->findAll(), 'id', 'severity_label'),
                  //'cssClassExpression' => 'getCssClass($data->statusid)',
                     //'Inventory::model()->findByPk($data->inventoryid)->chassisno',
                ),
            
                array(
                  'name'=>'issue_category',
                  'value'=>'IssueCategories::model()->findByPk($data->issue_category)->category_name',
                  'filter' => CHtml::listData(IssueCategories::model()->findAll(), 'id', 'category_name'),
                  //'cssClassExpression' => 'getCssClass($data->statusid)',
                     //'Inventory::model()->findByPk($data->inventoryid)->chassisno',
                ),
		/*
		'createdby',
		'createddate',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
));
}
?>


<?php
function getCssClass($id){
    $status_colors = array('1'=>'_green','2'=>'_orange','3'=>'_red','4'=>'_blue');
    
    if(array_key_exists($id,$status_colors)){
        return $status_colors[$id];
    }else{
        return 'no_class';
    }
}

function getUnserializedProjects($project){
//    $projectsarray = unserialize($project);
//    $str = '';
//    foreach($projectsarray As $key=>$value){
//        $str .= Projects::model()->findByPk($value)->projectname.', ';
//                
//    }
    
    $projectsarray = explode(',',$project);
    foreach($projectsarray As $key=>$value){
        $str .= Projects::model()->findByPk($value)->projectname.',';
    }
    
    return $str;
}
?>