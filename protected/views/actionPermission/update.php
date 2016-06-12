<?php
/* @var $this ActionPermissionController */
/* @var $model ActionPermission */

$this->breadcrumbs=array(
	'Action Permissions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


//$link_list_aps = (isset($translations['List Action Permissions'])?$translations['List Action Permissions']:'List Action Permissions');
$link_create_aps = (isset($translations['Create Action Permissions'])?$translations['Create Action Permissions']:'Create Action Permissions');
//$link_update_aps = (isset($translations['Update Action Permissions'])?$translations['Update Action Permissions']:'Update Action Permissions');
//$link_delete_aps = (isset($translations['Delete Action Permissions'])?$translations['Delete Action Permissions']:'Delete Action Permissions');
$link_manage_aps = (isset($translations['Manage Action Permissions'])?$translations['Manage Action Permissions']:'Manage Action Permissions');
//$link_view_aps = (isset($translations['View Action Permissions'])?$translations['View Action Permissions']:'View Action Permissions');

$this->menu=array(
	//array('label'=>'List ActionPermission', 'url'=>array('index')),
	array('label'=>$link_create_aps, 'url'=>array('create')),
	//array('label'=>'View ActionPermission', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>$link_manage_aps, 'url'=>array('admin')),
);
?>

<h1>

<?php
$heading = (isset($translations['Update Action Permissions'])?$translations['Update Action Permissions']:'Update Action Permissions');
 echo $heading.' #'.$model->id;
?>
</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'translations'=>$translations,)); ?>