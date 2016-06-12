
    
<?php
$this->breadcrumbs=array(
	'Permissions',
);
?>


<?php $form=$this->beginWidget('CActiveForm',
        array('id'=>'permissions-form',
        'action' => Yii::app()->createUrl('/Securitydata/UpdateRoles/'),
	'enableAjaxValidation'=>false,
)); ?>








<table border='0'>
<?php
$arr_action_perm_role_ref = array();

$action_permission_role_ref_records = $action_permissions_list['action_permission_role_ref_records'];
if(sizeof($action_permission_role_ref_records) > 0){
    foreach($action_permission_role_ref_records As $aprr){
        $arr_action_perm_role_ref[$aprr->aid] = true;
        //echo $aprr->aid.'<br>';
    }
}


$records = $action_permissions_list['action_permission_records'];


foreach ($records As $rr) :

    
        $id = $rr->id;
        $module = $rr->module;
        $method = $rr->action;

?>
<tr>
   <td>
       <?php
        if(isset($arr_action_perm_role_ref[$id])){
       ?>
            <input type="checkbox" name="Ap[]" value="<?php echo $id; ?>" checked>
       <?php
        }else{
       ?>
            <input type="checkbox" name="Ap[]" value="<?php echo $id; ?>">
       <?php
        }
       ?>
   </td>
   <td>
        <?php echo "<b> $module/$method </b>[controller id : $id]"; ?>
   </td>
</tr>

<?php endforeach; ?>


    <tr>
        <td colspan="2" align="right">
            <?php
                $button_text = (isset($translations['Submit'])?$translations['Submit']:'Submit');
            ?>
            <input type="button" value="<?php echo $button_text; ?>" onclick="submitme()">

            <input type="hidden" name="txt_hdn_rid" id="txt_hdn_rid" value="<?php echo Yii::app()->getRequest()->getQuery('id'); ?>">
        </td>
    </tr>
</table>

<?php $this->endWidget(); ?>


<script type="text/javascript">
    function submitme(){
        document.getElementById('permissions-form').submit();
    }
</script>

