<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->uid,
);

$link_list_users = (isset($translations['List User'])?$translations['List User']:'List User');
$link_create_users = (isset($translations['Create User'])?$translations['Create User']:'Create User');
$link_update_users = (isset($translations['Update User'])?$translations['Update User']:'Update User');
$link_delete_users = (isset($translations['Delete User'])?$translations['Delete User']:'Delete User');
$link_manage_users = (isset($translations['Manage User'])?$translations['Manage User']:'Manage User');
//$link_view_users = (isset($translations['View User'])?$translations['View User']:'View User');

$this->menu=array(
	array('label'=>$link_list_users, 'url'=>array('index')),
	array('label'=>$link_create_users, 'url'=>array('create')),
	array('label'=>$link_update_users, 'url'=>array('update', 'id'=>$model->uid)),
	array('label'=>$link_delete_users, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->uid),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>$link_manage_users, 'url'=>array('admin')),
);
?>

<h1>
  
<?php
$heading = (isset($translations['View User'])?$translations['View User']:'View User');
echo $heading.' #'.$model->uid;
?>
</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'uid',
		'enabled',
		'loginname',
		'familyname',
		'firstname',
		'password',
		'club_id',
		//'deleted',
	),
)); ?>
