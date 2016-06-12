<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
           // echo Yii::app()->session['Language'];
            /*if(isset($_GET['lan'])){
                Yii::app()->session['Language'] = $_GET['lan'];
            }else{
                Yii::app()->session['Language'] = DEFAULT_LANGUAGE;
            }*/
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                $translations = LngTextTranslated::model()->getLanguageTranslations();

		$this->render('index',array('translations'=>$translations));
                //$this->actionLogin();
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
                $model=new LoginForm();
                
                //Yii::app()->theme = 'theme1'; 

                //---------------------------------------------------------------

                //***************THIS CODE HAS BEEN MOVED TO SWAPLANGUAGE FUNCTION BELOW*****
                /*
                 * language translation
                 */

//                if(isset($_POST['LngLanguages']['language_code'])){
//
//                    if($_POST['LngLanguages']['language_code'] != 'en'){
//                      /*
//                       * if language is changed from the language selector dropdown
//                       * set the language to the selected.
//                       */
//                      Yii::app()->session['Language'] = $_POST['LngLanguages']['language_code'];
//                      $translations = LngTextTranslated::model()->getLanguageTranslations();
//
//                    }else{
//                      //unset(Yii::app()->session['Language']);
//                      Yii::app()->session['Language'] = 'en';
//                    }
//                }else{
//                    /*
//                     * on page page load check for the language and change the login form
//                     * to the defined language set by DEFAULT_LANGUAGE constant
//                     */
//                    if(DEFAULT_LANGUAGE != 'en'){
//                        Yii::app()->session['Language'] = DEFAULT_LANGUAGE;
//                        $translations = LngTextTranslated::model()->getLanguageTranslations();
//                    }
//                }
                
                //---------------------------------------------------------------


                //----------------------------------------------------------------
                /*
                 * Instead this code was added to change languange in the login form
                 */

                   if(isset(Yii::app()->session['Language'])){
                        $translations = LngTextTranslated::model()->getLanguageTranslations();
                   }else{
                        Yii::app()->session['Language'] = DEFAULT_LANGUAGE;
                        $translations = LngTextTranslated::model()->getLanguageTranslations();
                   }
                //----------------------------------------------------------------

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){


                             /*
                             * if user logs in then direct him to home page. else if the user tries to
                             * access a page directly without loging in, then log him first and then redirect to
                             * his requested page he tried to access.
                             */
                            if(Yii::app()->user->returnUrl == Yii::app()->baseUrl.'/index.php'){
				//$this->redirect(Yii::app()->user->returnUrl);
                                //$this->redirect('index.php/site/index');
                                $this->redirect(yii::app()->baseUrl.'/index.php/issues/admin');

                            }else{
                                $this->redirect(Yii::app()->user->returnUrl);
                            }
                        }
		}
		// display the login form
		$this->render('login',array('model'=>$model,'translations'=>$translations));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}


        public function actionSwapLanguage(){
         
//            if(isset($_POST['language_code'])){
//                echo $_POST['language_code'];
//            }
            //echo  Yii::app()->user->returnUrl;exit;

            if(isset($_POST['language_code'])){

            //echo $_POST['language_code'];exit;
                    if($_POST['language_code'] != 'en'){
                      /*
                       * if language is changed from the language selector dropdown
                       * set the language to the selected.
                       */
                      Yii::app()->session['Language'] = $_POST['language_code'];
                      $translations = LngTextTranslated::model()->getLanguageTranslations();

                    }else{
                      //unset(Yii::app()->session['Language']);
                      Yii::app()->session['Language'] = 'en';
                    }
                }else{
                    /*
                     * on page page load check for the language and change the login form
                     * to the defined language set by DEFAULT_LANGUAGE constant
                     */
                    if(DEFAULT_LANGUAGE != 'en'){
                        Yii::app()->session['Language'] = DEFAULT_LANGUAGE;
                        $translations = LngTextTranslated::model()->getLanguageTranslations();
                    }
                }

            //$this->redirect(array("securitydata/index"));
            //$return_url = $_SERVER['HTTP_REFERER'];
            //$this->redirect($return_url);

            $this->redirect(Yii::app()->request->urlReferrer);
            
        }


}