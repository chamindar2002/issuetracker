<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
        
        <!-- favicon .ico file -->
        <link rel="shortcut icon" href="<?php echo yii::app()->baseUrl;?>/favicon.ico"></link>

        <!-- Google translate api -->
        <meta name="google-translate-customization" content="9d45e256df435674-8e8346b2cac6443b-gd7c19734edc5663c-1b"></meta>

	<title>
            <?php //echo CHtml::encode($this->pageTitle); ?>
            Quasar Golf
        </title>
</head>
    
    <body>
        <div id="container">
            <div id="header">
                
                <div class="logo1">
                    <a href="<?php echo yii::app()->baseUrl.'/index.php/siteManager/index'; ?>">
                    <img src="<?php echo yii::app()->baseUrl;?>/themes/images/QuasarGolfLogo.jpg" height="70px" width="190px" border="0"></img>
                    </a>
                </div>
                
                <div id="language_selector">
                <form method="post" action="<?php echo yii::app()->baseUrl;?>/index.php/site/SwapLanguage">
                    <?php
                    $languagesArray = CHtml::listData(LngLanguages::model()->findAll(),'language_code','language_desc');

                    if(isset(Yii::app()->session['Language'])) {
                        $selected_language = Yii::app()->session['Language'];
                    }else {
                        $selected_language = DEFAULT_LANGUAGE;
                    }

                    echo "<select name='language_code' id='language_code' class='language_dropdown' onChange='this.form.submit()'>";

                    foreach($languagesArray As $key=>$value) {

                        if($key == $selected_language) {
                            echo "<option value=\"$key\" class=\"$key\" selected>$value</option>";
                        }else {
                            echo "<option value=\"$key\" class=\"$key\">$value</option>";
                        }

                    }

                    echo "</select>";
                    //echo Yii::app()->session['Language'];
                    ?>
                </form>


            </div>
                
            </div>
            
            <?php
            $tpl_translations = LngTextTranslated::model()->getTemplateTranslations();
            $menu_itm_home = (isset($tpl_translations['Home'])?$tpl_translations['Home']:'Home');
            $menu_itm_umanager = (isset($tpl_translations['User Manager'])?$tpl_translations['User Manager']:'User Manager');
            $menu_itm_setup = (isset($tpl_translations['Setup'])?$tpl_translations['Setup']:'Setup');
            $menu_itm_logout = (isset($tpl_translations['Logout'])?$tpl_translations['Logout']:'Logout');
            ?>
            
            <?php if(Yii::app()->controller->action->id != 'login'){?>
            <div id="menu-top">
                    <?php $this->widget('zii.widgets.CMenu',array(
                            'items'=>array(
                                    
                                    array('label'=>$menu_itm_home, 'url'=>array('/SiteManager/index')),
                                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                    array('label'=>$menu_itm_logout.' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                            ),
                    )); ?>
            </div>
            <?php } ?>
            <div class="content">
               <?php
            
                    //echo Yii::app()->user->getState('roleId');
                    $controller = Yii::app()->controller->id;
                    $action = Yii::app()->controller->action->id;
                    $action_permission_id = 0;
                    $actionPermission = ActionPermission::model()->findByAttributes(array('module'=>$controller,'action'=>$action));
                    //if($actionPermission != null){
                        $action_permission_id = $actionPermission->id;

                        $checkPermission = RoleActionPermissionRef::model()->authenticateUser($controller,$action_permission_id,Yii::app()->user->getState('roleId'));

                        if($checkPermission){
                            echo $content;
                        }else{
                           // echo '<p>You do not have permission to view this page</p>';
                           //throw new CHttpException('You do not have permission to view this page.');
                            throw new CHttpException('Please login with appropriate login credentials to view this page.');
                        }


                ?>
            </div>
            
            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by Quasar Golf. All Rights Reserved.
            </div>            
            
            
        </div>
        
        
    </body>
        
</html>