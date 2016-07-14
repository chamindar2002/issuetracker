<?php

class IssuesController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin'),
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
            $issueFeedbackData = Issuefeedback::model()->findAllByAttributes(array('issueid'=>$id));
            $projectteamData = Issues::model()->findMembersOfTeam($id);
            
		$this->render('view',array(
			'model'=>$this->loadModel($id),'issueFeedbackData'=>$issueFeedbackData,'projectteamData'=>$projectteamData,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Issues;
                
                $projectsdata = Projects::model()->findAll();
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                //$model->issuetype = 1;
                
                $model->timeline = date('Y-m-d');
                
		if(isset($_POST['Issues']))
		{
			$model->attributes=$_POST['Issues'];
                        
                        //print_r($_POST);exit;
                        
                        $model->createddate = date('Y-m-d h:i:s a', time());
                        $model->createdby = Yii::app()->user->userId;
                        
                        $model->timeline = date("Y-m-d", strtotime(str_replace("-","/",$_POST['Issues']['timeline'])));
                        //$model->timeline = date('d-m-Y');
                        
                        $projectsarr = $_POST['Issues']['projectid'];
                        Yii::app()->session['projectsarr'] = $projectsarr;
                        
                        $projectstr = '';
                        
                        if(sizeof($projectsarr) > 0){
                            
                            foreach($projectsarr As $key=>$value){
                                $projectstr .= $value.',';
                            }
                        $projectstr = substr($projectstr, 0, -1);
                        
                        }
                        //$model->projectid = serialize($_POST['Issues']['projectid']);
                        $model->projectid = $projectstr;
                        
			if($model->save()){
                            Issues::model()->alertTeam($model->id,'New Issue Created');
				$this->redirect(array('admin','id'=>$model->id));
                        }
		}

		$this->render('create',array(
			'model'=>$model,'projectsdata'=>$projectsdata,
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
                $projectsdata = Projects::model()->findAll();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Issues']))
		{
                    //print_r($_POST['Issues']);exit;
                    
			$model->lastmodifieddate = date('Y-m-d h:i:s a', time());
                        $model->lastmodifiedby = Yii::app()->user->userId;
                        $model->timeline = date("Y-m-d", strtotime(str_replace("-","/",$_POST['Issues']['timeline'])));
                        $model->statusid = $_POST['Issues']['statusid'];
                        
                        $projectsarr = $_POST['Issues']['projectid'];
                        $projectstr = '';
                        if(sizeof($projectsarr) > 0){
                            
                            foreach($projectsarr As $key=>$value){
                                $projectstr .= $value.',';
                            }
                        $projectstr = substr($projectstr, 0, -1);
                        
                        }
                        //$model->projectid = serialize($_POST['Issues']['projectid']);
                        $model->projectid = $projectstr;
                        $model->issuetype = $_POST['Issues']['issuetype'];
                        $model->issue_category = $_POST['Issues']['issue_category'];
                        $model->comments = $_POST['Issues']['comments'];
                        $model->priority = $_POST['Issues']['priority'];
                        
			if($model->save()){
                            //print_r($model->getErrors());
                            Issues::model()->alertTeam($id,'Issue Modified');
				$this->redirect(array('admin','id'=>$model->id));
                        }
		}

		$this->render('update',array(
			'model'=>$model,'projectsdata'=>$projectsdata,
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Issues');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Issues('search');
                
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Issues']))
			$model->attributes=$_GET['Issues'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Issues the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Issues::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Issues $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='issues-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
