<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

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








<div class="container" id="page">

	<div id="header">
		<!--<div id="logo"><?php //echo CHtml::encode(Yii::app()->name); ?></div>-->
            <div id="newlogo">
                <img src="<?php echo yii::app()->baseUrl;?>/themes/images/QuasarGolfLogo.jpg" height="80px" width="200px"></img>
                
            </div>

            
        </div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
                                //array('label'=>'Articles', 'url'=>array('/Articles/index')),
//                                array('label'=>'ActionPermission', 'url'=>array('/actionPermission/index')),
                                array('label'=>'UserManager', 'url'=>array('/UserManager/index')),
                                array('label'=>'Setup', 'url'=>array('/SiteManager/index')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php //echo $content; ?>

        <!-- -------------------------------------------------------------------------------- -->
       
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
                   throw new CHttpException('You do not have permission to view this page.');
                }

            //}

          //echo "$controller : $action : $action_permission_id";
          //var_dump($action);
        ?>
        
        </div>
        <!-- -------------------------------------------------------------------------------- -->

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Quasar Golf.<br/>
		All Rights Reserved.<br/>
		<?php //echo Yii::powered(); ?>



            <div id="google_language_selector">
                <!--
                    Google language translater drop down box
                -->
                <!--
                <div id="google_translate_element"></div>
                <script type="text/javascript">
                    function googleTranslateElementInit() {
                        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                    }
                </script>
                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                -->

                <div id="google_translate_element"></div>
                <script type="text/javascript">
                    function googleTranslateElementInit() {
                        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL}, 'google_translate_element');
                    }
                </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            </div>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>