<?php
header('Content-Type: text/html; charset=utf-8');
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);


define('ENFORCE_AUTHENTICATION',true);
//define('ENFORCE_AUTHENTICATION',false);

error_reporting(E_ALL ^ E_NOTICE);

//define('DEFAULT_LANGUAGE','fr');
define('DEFAULT_LANGUAGE','en');

//maximum no of scores used to display member scores and handicap calculation
define('MAX_SCORES_HCAP_CALC',20);

date_default_timezone_set('Asia/Colombo');

require_once($yii);
Yii::createWebApplication($config)->run();



/*set default language*/
//Yii::app()->session['Language'] = 'en';


//Yii::app()->language = 'fr';
//Yii::app()->setLanguage('fr');


