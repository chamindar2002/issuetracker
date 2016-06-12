<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->uid=>array('view','id'=>$model->uid),
	'Update',
);

$link_list_users = (isset($translations['List User'])?$translations['List User']:'List User');
$link_create_users = (isset($translations['Create User'])?$translations['Create User']:'Create User');
//$link_update_users = (isset($translations['Update User'])?$translations['Update User']:'Update User');
//$link_delete_users = (isset($translations['Delete User'])?$translations['Delete User']:'Delete User');
$link_manage_users = (isset($translations['Manage User'])?$translations['Manage User']:'Manage User');
$link_view_users = (isset($translations['View User'])?$translations['View User']:'View User');

$this->menu=array(
	array('label'=>$link_list_users, 'url'=>array('index')),
	array('label'=>$link_create_users, 'url'=>array('create')),
	//array('label'=>$link_view_users, 'url'=>array('view', 'id'=>$model->uid)),
	//array('label'=>$link_manage_users, 'url'=>array('admin')),
);
?>

<h1>

 <?php
$heading = (isset($translations['Update User'])?$translations['Update User']:'Update User');
echo $heading.' | '.$model->loginname;
?>
</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'translations'=>$translations,)); ?>