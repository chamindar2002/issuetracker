<?php
/* @var $this UserRoleRefController */
/* @var $model UserRoleRef */

$this->breadcrumbs=array(
	'User Role Refs'=>array('index'),
	'Create',
);

$link_list_urf = (isset($translations['List User Role Ref'])?$translations['List User Role Ref']:'List User Role Ref');
//$link_create_urf = (isset($translations['Create User Role Ref'])?$translations['Create User Role Ref']:'Create User Role Ref');
//$link_update_urf = (isset($translations['Update User Role Ref'])?$translations['Update User Role Ref']:'Update User Role Ref');
//$link_delete_urf = (isset($translations['Delete User Role Ref'])?$translations['Delete User Role Ref']:'Delete User Role Ref');
$link_manage_urf = (isset($translations['Manage User Role Ref'])?$translations['Manage User Role Ref']:'Manage User Role Ref');
//$link_view_urf = (isset($translations['View User Role Ref'])?$translations['View User Role Ref']:'View User Role Ref');

$this->menu=array(
	array('label'=>$link_list_urf, 'url'=>array('index')),
	array('label'=>$link_manage_urf, 'url'=>array('admin')),
);
?>

<h1>
    <?php
    $heading = (isset($translations['Create User Role Ref'])?$translations['Create User Role Ref']:'Create User Role Ref');
    echo $heading;
    ?>
</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'translations'=>$translations,)); ?>