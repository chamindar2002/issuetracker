<?php
/* @var $this UserRoleRefController */
/* @var $model UserRoleRef */

$this->breadcrumbs=array(
	'User Role Refs'=>array('index'),
	$model->uid,
);

$link_list_urf = (isset($translations['List User Role Ref'])?$translations['List User Role Ref']:'List User Role Ref');
$link_create_urf = (isset($translations['Create User Role Ref'])?$translations['Create User Role Ref']:'Create User Role Ref');
$link_update_urf = (isset($translations['Update User Role Ref'])?$translations['Update User Role Ref']:'Update User Role Ref');
$link_delete_urf = (isset($translations['Delete User Role Ref'])?$translations['Delete User Role Ref']:'Delete User Role Ref');
$link_manage_urf = (isset($translations['Manage User Role Ref'])?$translations['Manage User Role Ref']:'Manage User Role Ref');
//$link_view_urf = (isset($translations['View User Role Ref'])?$translations['View User Role Ref']:'View User Role Ref');

$this->menu=array(
	array('label'=>$link_list_urf, 'url'=>array('index')),
	array('label'=>$link_create_urf, 'url'=>array('create')),
	array('label'=>$link_update_urf, 'url'=>array('update', 'id'=>$model->uid)),
	array('label'=>$link_delete_urf, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->uid),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>$link_manage_urf, 'url'=>array('admin')),
);
?>

<h1>
<?php
$heading = (isset($translations['View User Role Ref'])?$translations['View User Role Ref']:'View User Role Ref');
echo $heading.' #'.$model->uid;
?>
</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'uid',
		'rid',
	),
)); ?>
