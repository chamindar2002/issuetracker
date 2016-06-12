<?php
/* @var $this ActionPermissionController */
/* @var $model ActionPermission */

$this->breadcrumbs=array(
	'Action Permissions'=>array('index'),
	'Manage',
);

$link_list_aps = (isset($translations['List Action Permissions'])?$translations['List Action Permissions']:'List Action Permissions');
$link_create_aps = (isset($translations['Create Action Permissions'])?$translations['Create Action Permissions']:'Create Action Permissions');
//$link_update_aps = (isset($translations['Update Action Permissions'])?$translations['Update Action Permissions']:'Update Action Permissions');
//$link_delete_aps = (isset($translations['Delete Action Permissions'])?$translations['Delete Action Permissions']:'Delete Action Permissions');
//$link_manage_aps = (isset($translations['Manage Action Permissions'])?$translations['Manage Action Permissions']:'Manage Action Permissions');
//$link_view_aps = (isset($translations['View Action Permissions'])?$translations['View Action Permissions']:'View Action Permissions');

$this->menu=array(
	array('label'=>$link_list_aps, 'url'=>array('index')),
	array('label'=>$link_create_aps, 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#action-permission-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>
<?php 
$heading = (isset($translations['Manage Action Permissions'])?$translations['Manage Action Permissions']:'Manage Action Permissions');
echo $heading;
?>
</h1>


<?php echo CHtml::link($translations['common_labels']['Advanced Search'],'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'action-permission-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'module',
		'action',
		'description',
		'systemid',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
