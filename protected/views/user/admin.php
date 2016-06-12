<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$link_list_users = (isset($translations['List User'])?$translations['List User']:'List User');
$link_create_users = (isset($translations['Create User'])?$translations['Create User']:'Create User');
//$link_update_users = (isset($translations['Update User'])?$translations['Update User']:'Update User');
//$link_delete_users = (isset($translations['Delete User'])?$translations['Delete User']:'Delete User');
//$link_manage_users = (isset($translations['Manage User'])?$translations['Manage User']:'Manage User');
//$link_view_users = (isset($translations['View User'])?$translations['View User']:'View User');

$this->menu=array(
	array('label'=>$link_list_users, 'url'=>array('index')),
	array('label'=>$link_create_users, 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>
    <?php
    $heading = (isset($translations['Manage User'])?$translations['Manage User']:'Manage Users');
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
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'uid',
		'enabled',
		'loginname',
		'familyname',
		'firstname',
		'password',
		/*
		'club_id',
		'deleted',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
