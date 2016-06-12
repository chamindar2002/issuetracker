<?php
/* @var $this UserManagerController */

$this->breadcrumbs=array(
	'User Manager',
);
?>
<h1>
<?php
$heading =  (isset($translations['User Manager'])?$translations['User Manager']:'User Manager');
    echo $heading; //echo $this->id . '/' . $this->action->id;
?>
</h1>
<div id="submenu">
<p>
<ul>
    <?php
    $link_aps = (isset($translations['Action Permissions'])?$translations['Action Permissions']:'Action Permissions');
    $link_list_roles = (isset($translations['List Roles'])?$translations['List Roles']:'List Roles');
    $link_users = (isset($translations['Users'])?$translations['Users']:'Users');
    $link_ar = (isset($translations['Assign Roles'])?$translations['Assign Roles']:'Assign Roles');

    echo '<li>'.CHtml::link(CHtml::encode($link_aps), array('actionPermission/create')).'</li>';
    echo '<li>'.CHtml::link(CHtml::encode($link_list_roles), array('securitydata/index')).'</li>';
    echo '<li>'.CHtml::link(CHtml::encode($link_users), array('user/index')).'</li>';
    echo '<li>'.CHtml::link(CHtml::encode($link_ar), array('/userRoleRef/index')).'</li>';

    ?>
</ul>
</p>
</div>

<div id="box-pushdown">

</div>