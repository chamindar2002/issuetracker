<?php

class IssuefeedbackController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionAdd(){


            $model = new Issuefeedback;
            
            if(isset($_POST['txtissueid']))
            {
                $rnd = substr(number_format(time() * rand(), 0, '', ''), 0, 20);

                
                //$model->file1 = $_FILES['file1']['name'];
                $model->comment = $_POST['comments'];
                $model->issueid = $_POST['txtissueid'];
                $model->createdby = Yii::app()->user->userId;
                $model->createddate =  date('Y-m-d h:i:s a', time());

                $uploadedFile = CUploadedFile::getInstanceByName('file1');


                $fileName_unstripped = "{$rnd}-{$uploadedFile}";


                /*replace white spcase with _)*/
                $fileName = preg_replace('/\s+/', '_', $fileName_unstripped);


                
                if($uploadedFile != null)
                    $model->file1 = $fileName;
                
                //$model->file1type = $uploadedFile->type;
                //echo Yii::app()->basePath.'/uploadedfiles/'.$_FILES['file1']['name'];
                //exit;
                if($model->save()){

                    var_dump($model);exit;
                    
                    if($uploadedFile != null){
                               // $uploadedFile->saveAs(Yii::app()->basePath.'/../uploadedfiles/'.$fileName);  // image 
                        $uploadedFile->saveAs($model->getFileUploadUrl($fileName));
                    }
                    Issues::model()->alertTeam($model->issueid,'New Comment Added');        
                    $this->redirect(array('issues/view','id'=>$_POST['txtissueid']));
                 }

                var_dump($model->getErrors());
                Yii::app()->end();
            }
            
        }
        
        public function actionDownloadfile($id){
           $filecontent=file_get_contents(Yii::getPathOfAlias('webroot') . '/uploadedfiles/'.$id);
           //$filecontent=file_get_contents(Yii::app()->basePath . '/uploadedfiles/'.$id);
            header("Content-Type: text/plain");
            header("Content-disposition: attachment; filename=$id");
            header("Pragma: no-cache");
            echo $filecontent;
            exit;
        }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}