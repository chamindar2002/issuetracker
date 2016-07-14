<?php
/* @var $this UserRoleRefController */
/* @var $data UserRoleRef */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->uid), array('view', 'id'=>$data->uid)); ?>

        <?php
            $user = User::model()->findByPk($data->uid);
            $user_name = $user->loginname;
            echo CHtml::encode($user_name);
        ?>

	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rid')); ?>:</b>
	<?php
        //echo CHtml::encode($data->rid);
            $user_role = Role::model()->findByPk($data->rid);
            $user_role_name = $user_role->name;
            echo CHtml::encode($user_role_name);
        ?>
	<br />


</div>