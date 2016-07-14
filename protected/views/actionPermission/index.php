<?php
/* @var $this ActionPermissionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Action Permissions',
);

$this->menu=array(
	array('label'=>'Create ActionPermission', 'url'=>array('create')),
	array('label'=>'Manage ActionPermission', 'url'=>array('admin')),
);
?>

<h1>Action Permissions</h1>

<?php
/*override default items per page*/
    $dataProvider->pagination->pageSize = 2;
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
