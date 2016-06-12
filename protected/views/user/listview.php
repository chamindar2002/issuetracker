
<?php
//$link_list_users = (isset($translations['List User'])?$translations['List User']:'List User');
$link_create_users = (isset($translations['Create User'])?$translations['Create User']:'Create User');
//$link_update_users = (isset($translations['Update User'])?$translations['Update User']:'Update User');
//$link_delete_users = (isset($translations['Delete User'])?$translations['Delete User']:'Delete User');
$link_manage_users = (isset($translations['Manage User'])?$translations['Manage User']:'Manage User');
//$link_view_users = (isset($translations['View User'])?$translations['View User']:'View User');

$this->menu=array(
	array('label'=>$link_create_users, 'url'=>array('create')),
	//array('label'=>$link_manage_users, 'url'=>array('admin')),
        array('label'=>'Assign Roles', 'url'=>array('userRoleRef/index')),
    
);
?>

<h1>
    <?php
        $heading = (isset($translations['Users'])?$translations['Users']:'Users');
        echo $heading;
    ?>
</h1>

<?php
//$dataProvider=new CActiveDataProvider('Members');
echo '<pre>';
//var_dump($dataProvider->model);
echo '</pre>';

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'uid',          // display the 'title' attribute
        array(
          'name' => 'loginname',
          'type' => 'raw',
          'value' => 'CHtml::link($data->loginname,$data->uid)'
        ),
        //'loginname',  // display the 'name' attribute of the 'category' relation
        'familyname',
        'firstname',

        /*
        array(            // display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
        ),
         * 
         */
    ),
));

?>
