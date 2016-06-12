<?php
/* @var $this UserRoleRefController */
/* @var $model UserRoleRef */

$this->breadcrumbs=array(
	'User Role Refs'=>array('index'),
	$model->uid=>array('view','id'=>$model->uid),
	'Update',
);

$this->menu=array(
	array('label'=>'List User Role Ref', 'url'=>array('index')),
	array('label'=>'Create User Role Ref', 'url'=>array('create')),
	//array('label'=>'View User Role Ref', 'url'=>array('view', 'id'=>$model->uid)),
	//array('label'=>'Manage User Role Ref', 'url'=>array('admin')),
);
?>

<h1>
<?php
    $heading = (isset($translations['Update User Role Ref'])?$translations['Update User Role Ref']:'Update User Role Ref');
    echo $heading.' #'.$model->uid;
?>
</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'translations'=>$translations,)); ?>