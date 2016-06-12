<?php
/* @var $this UserRoleRefController */
/* @var $model UserRoleRef */

$this->breadcrumbs=array(
	'User Role Refs'=>array('index'),
	'Manage',
);

$link_list_urf = (isset($translations['List User Role Ref'])?$translations['List User Role Ref']:'List User Role Ref');
$link_create_urf = (isset($translations['Create User Role Ref'])?$translations['Create User Role Ref']:'Create User Role Ref');
//$link_update_urf = (isset($translations['Update User Role Ref'])?$translations['Update User Role Ref']:'Update User Role Ref');
//$link_delete_urf = (isset($translations['Delete User Role Ref'])?$translations['Delete User Role Ref']:'Delete User Role Ref');
//$link_manage_urf = (isset($translations['Manage User Role Ref'])?$translations['Manage User Role Ref']:'Manage User Role Ref');
//$link_view_urf = (isset($translations['View User Role Ref'])?$translations['View User Role Ref']:'View User Role Ref');

$this->menu=array(
	array('label'=>$link_list_urf, 'url'=>array('index')),
	array('label'=>$link_create_urf, 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-role-ref-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>
    <?php
    $heading = (isset($translations['Manage User Role Ref'])?$translations['Manage User Role Ref']:'Manage User Role Ref');
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
	'id'=>'user-role-ref-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'uid',
		'rid',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
