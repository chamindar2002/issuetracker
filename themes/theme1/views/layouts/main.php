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
            <?php echo CHtml::encode($this->pageTitle); ?>
            
        </title>
        
</head>

<body>

    <div class="container">
        <div class="header">
            <div class="logo1">
                <a href="<?php echo yii::app()->baseUrl.'/index.php/siteManager/index'; ?>">
                <img src="<?php echo yii::app()->baseUrl;?>/themes/images/arax_img_02.png" height="70px" width="200px" border="0"></img>
                </a>
            </div>

            <div id="language_selector">
<!--                language selector-->

            </div>
        </div>

        <?php
        //$tpl_translations = LngTextTranslated::model()->getTemplateTranslations();
        //print_r($tpl_translations);
        $menu_itm_home = (isset($tpl_translations['Home'])?$tpl_translations['Home']:'Home');
        $menu_itm_umanager = (isset($tpl_translations['User Manager'])?$tpl_translations['User Manager']:'User Manager');
        $menu_itm_setup = (isset($tpl_translations['Setup'])?$tpl_translations['Setup']:'Setup');
        $menu_itm_logout = (isset($tpl_translations['Logout'])?$tpl_translations['Logout']:'Logout');
        ?>

        <?php if(Yii::app()->controller->action->id != 'login'){?>
        <div id="menu-topw">
                <?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				//array('label'=>$menu_itm_home, 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
                                //array('label'=>'Articles', 'url'=>array('/Articles/index')),
//                                array('label'=>'ActionPermission', 'url'=>array('/actionPermission/index')),
                                //array('label'=>$menu_itm_umanager, 'url'=>array('/UserManager/index')),
                                //array('label'=>$menu_itm_setup, 'url'=>array('/SiteManager/index')),
                                
                                //array('label'=>$menu_itm_home, 'url'=>array('/SiteManager/index')),
				//array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>$menu_itm_logout.' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
            
            
        <?php
        if(Yii::app()->user->getState('roleId') == 5){
        /*
         * hide user options from client
         */
                    $this->widget('application.extensions.mbmenu.MbMenu',array( 
                    'items'=>array( 
                        array('label'=>'Home', 'url'=>array('/site/index')), 
                        
                        /*array('label'=>'User Manager', 'url'=>array('#'), 
                          'items'=>array( 
                            array('label'=>'ActionPermission','url'=>array('/actionPermission/index')),
                            array('label'=>'List Roles','url'=>array('/securitydata/index')), 
                            array('label'=>'Users','url'=>array('user/index')), 
                            array('label'=>'Users Role References','url'=>array('/userRoleRef/index')),   

                          ), 
                        ), */

                        array('label'=>'Issues', 'url'=>array('#'), 
                          'items'=>array( 
                            array('label'=>'List Issues (All)','url'=>array('/issues/admin'),
                              'items'=>array( 
                                array('label'=>'Pending', 'url'=>array('/issues/admin?issuestat=1')), 
                                array('label'=>'Done', 'url'=>array('/issues/admin?issuestat=2')), 
                                array('label'=>'Closed', 'url'=>array('/issues/admin?issuestat=3')), 
                              ), 

                          ), 
                        ),
                        ),

                        /*
                        array('label'=>'Test', 
                          'items'=>array( 
                            array('label'=>'Sub 1', 'url'=>array('/site/page','view'=>'sub1')), 
                            array('label'=>'Sub 2', 
                              'items'=>array( 
                                array('label'=>'Sub sub 1', 'url'=>array('/site/page','view'=>'subsub1')), 
                                array('label'=>'Sub sub 2', 'url'=>array('/site/page','view'=>'subsub2')), 
                              ), 
                            ), 
                          ), 
                        ),
                        */


                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>$menu_itm_logout.' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                    ), 
            ));
        }else{

                        $this->widget('application.extensions.mbmenu.MbMenu',array( 
                       'items'=>array( 
                           array('label'=>'Home', 'url'=>array('/site/index')), 
                           array('label'=>'User Manager', 'url'=>array('#'), 
                             'items'=>array( 
                               array('label'=>'ActionPermission','url'=>array('/actionPermission/index')),
                               array('label'=>'List Roles','url'=>array('/securitydata/index')), 
                               array('label'=>'Users','url'=>array('user/index')), 
                               array('label'=>'Users Role References','url'=>array('/userRoleRef/index')),   

                             ), 
                           ), 

                           array('label'=>'Issues', 'url'=>array('#'), 
                             'items'=>array( 
                               array('label'=>'List Issues (All)','url'=>array('/issues/admin'),
                                 'items'=>array( 
                                   array('label'=>'Pending', 'url'=>array('/issues/admin?issuestat=1')), 
                                   array('label'=>'Done', 'url'=>array('/issues/admin?issuestat=2')), 
                                   array('label'=>'Closed', 'url'=>array('/issues/admin?issuestat=3')), 
                                 ), 

                             ), 
                           ),
                           ),

                           /*
                           array('label'=>'Test', 
                             'items'=>array( 
                               array('label'=>'Sub 1', 'url'=>array('/site/page','view'=>'sub1')), 
                               array('label'=>'Sub 2', 
                                 'items'=>array( 
                                   array('label'=>'Sub sub 1', 'url'=>array('/site/page','view'=>'subsub1')), 
                                   array('label'=>'Sub sub 2', 'url'=>array('/site/page','view'=>'subsub2')), 
                                 ), 
                               ), 
                             ), 
                           ),
                           */


                           array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                           array('label'=>$menu_itm_logout.' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                       ), 
               ));
        }
        ?>
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

            //}

          //echo "$controller : $action : $action_permission_id";
          //var_dump($action);"
          //echo "$controller";
          //echo Yii::app()->user->getState('userId');
        ?>





        
        </div>

        <div id="footer">
            <div id="footer_left_div">
            Copyright &copy; <?php echo date('Y'); ?> by Aranxa Software.<br/>
		All Rights Reserved.<br/>
            <?php //echo Yii::powered(); ?>

            </div>

            <div id="footer_right_div">
                 &nbsp;
                
            </div>

            <div class="clear"></div>
        </div>


    </div>

</body>
</html>