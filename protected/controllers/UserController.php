<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','listclubs'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            $translations = LngTextTranslated::model()->getLanguageTranslations();
            /*
		$this->render('view',array(
			'model'=>$this->loadModel($id),'translations'=>$translations,
		));
             * 
             */
            $this->actionUpdate($id);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                //print_r($_POST);exit;
                $translations = LngTextTranslated::model()->getLanguageTranslations();

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
                        $model->password = User::model()->encryptPassword($_POST['User']['password']);
			if($model->save())
                       
				$this->redirect(array('view','id'=>$model->uid));
		}

		$this->render('create',array(
			'model'=>$model,'translations'=>$translations,
		));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $translations = LngTextTranslated::model()->getLanguageTranslations();

		if(isset($_POST['User']))
		{

			$model->attributes=$_POST['User'];
                        $model->password = User::model()->encryptPassword($_POST['User']['password']);
			if($model->save())
				$this->redirect(array('view','id'=>$model->uid));
		}

		$this->render('update',array(
			'model'=>$model,'translations'=>$translations,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');

                $translations = LngTextTranslated::model()->getLanguageTranslations();
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));
                $this->render('listview',array(
			'dataProvider'=>$dataProvider,'translations'=>$translations,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values

                $translations = LngTextTranslated::model()->getLanguageTranslations();

		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,'translations'=>$translations,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

        public function actionListclubs()
        {

           $data=GolfClub::model()->findAll('golf_union_id=:parent_id',
           array(':parent_id'=>(int) $_POST['union_id']));

           $data=CHtml::listData($data,'gc_id','gc_name');

           $translations = LngTextTranslated::model()->getLanguageTranslations();
           $prompt_select_golf_club = (isset($translations['Select Club'])?$translations['Select Club']:'Select Club');

           echo "<option value=''>$prompt_select_golf_club</option>";
           
           foreach($data as $value=>$city_name)
           echo CHtml::tag('option', array('value'=>$value),CHtml::encode($city_name),true);
        }
}
