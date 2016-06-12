
<?php
//$link_list_aps = (isset($translations['List Action Permissions'])?$translations['List Action Permissions']:'List Action Permissions');
$link_create_aps = (isset($translations['Create Action Permissions'])?$translations['Create Action Permissions']:'Create Action Permissions');
//$link_update_aps = (isset($translations['Update Action Permissions'])?$translations['Update Action Permissions']:'Update Action Permissions');
//$link_delete_aps = (isset($translations['Delete Action Permissions'])?$translations['Delete Action Permissions']:'Delete Action Permissions');
$link_manage_aps = (isset($translations['Manage Action Permissions'])?$translations['Manage Action Permissions']:'Manage Action Permissions');
//$link_view_aps = (isset($translations['View Action Permissions'])?$translations['View Action Permissions']:'View Action Permissions');

$this->menu=array(
	array('label'=>$link_create_aps, 'url'=>array('create')),
	array('label'=>$link_manage_aps, 'url'=>array('admin')),
);
?>

<h1>
    <?php
    $heading = (isset($translations['Action Permissions'])?$translations['Action Permissions']:'Action Permissions');
    echo $heading;
    //echo $translations['Country'];
    ?>
</h1>


<?php
//$dataProvider=new CActiveDataProvider('Members');
//echo '<pre>';
//var_dump($dataProvider->model);
//echo '</pre>';
//exit;
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'id',          // display the 'title' attribute
        array(
          'name' => 'module',
          'type' => 'raw',
          'value' => 'CHtml::link($data->module,$data->id)'
        ),
        //'module',  // display the 'name' attribute of the 'category' relation
        'action',
        
        /*
        array(            // display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
        ),
         * 
         */
    ),
));

?>
