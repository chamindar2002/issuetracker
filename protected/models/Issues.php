<?php

/**
 * This is the model class for table "issues".
 *
 * The followings are the available columns in table 'issues':
 * @property integer $id
 * @property string $task
 * @property string $projectid
 * @property integer $statusid
 * @property string $timeline
 * @property string $comments
 * @property integer $createdby
 * @property string $createddate
 * @property integer $lastmodifiedby
 * @property string $lastmodifieddate
 * @property integer $priority
 * @property integer $issuetype
 *  @property integer $issue_category
 */
class Issues extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Issues the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'issues';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
             /*
		return array(
			array('task, projectid, statusid, comments', 'required'),
			array('statusid, createdby', 'numerical', 'integerOnly'=>true),
			array('task', 'length', 'max'=>100),
			//array('projectid', 'length', 'max'=>200),
                        //array('projectid', 'in','range'=>range(1,1),'message'=>'Range should be in 400 to 690'),   
			array('createddate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, task, projectid, statusid, timeline, comments, createdby, createddate', 'safe', 'on'=>'search'),
		);
              * 
              */
                
                 return array(
                    array('task, projectid, statusid, comments, issue_category, priority', 'required'),
                    array('statusid, createdby, lastmodifiedby, priority, issuetype, issue_category, priority', 'numerical', 'integerOnly'=>true),
                    array('task', 'length', 'max'=>100),
                    array('task', 'length', 'max'=>100),
                    //array('projectid', 'length', 'max'=>200),
                    array('timeline, createddate, lastmodifieddate', 'safe'),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('id, task, projectid, statusid, timeline, comments, createdby, createddate, lastmodifiedby, lastmodifieddate, priority, issuetype', 'safe', 'on'=>'search'),
                );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'id' => 'ID',
                    'task' => 'Task',
                    'projectid' => 'Project',
                    'statusid' => 'Status',
                    'timeline' => 'Timeline',
                    'comments' => 'Comments',
                    'createdby' => 'Created By',
                    'createddate' => 'Created Date',
                    'lastmodifiedby' => 'Lastmodified By',
                    'lastmodifieddate' => 'Lastmodified Date',
                    'priority' => 'Severity',
                    'issuetype' => 'Issue Type',
                    'issue_category' => 'Issue Category',
                );
                
                
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('task',$this->task,true);
		$criteria->compare('projectid',$this->projectid,true);
		//$criteria->compare('statusid',$this->statusid);
		$criteria->compare('timeline',$this->timeline,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('createdby',$this->createdby);
		$criteria->compare('createddate',$this->createddate,true);
                $criteria->compare('issue_category',$this->issue_category);
                $criteria->compare('priority',$this->priority,true);
                
                
                $criteria->order = 'id desc';
                
                if(isset($_GET['issuestat'])){
                    $issue_status = $_GET['issuestat'];
                    $criteria->compare('statusid',$issue_status);
                }else{
                    $criteria->compare('statusid',$this->statusid);
                }
                
                if(Yii::app()->user->getState('roleId') == 5){
                    $criteria->compare('issuetype', 1);
                }
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array('pageSize'=>20,),
		));
	}
        
        public function findMembersOfTeam($issueid){
            
            $issue = Issues::model()->findByPk($issueid);
            $project_ids = explode(',',$issue->projectid);
            $team_members = array();
            
            if(sizeof($project_ids) > 0){
                foreach($project_ids As $key=>$value){
                    
                    $projectteam = ProjectTeam::model()->findAllByAttributes(array('project_id'=>$value));
                    
                    foreach($projectteam As $pt){
                        $user = User::model()->findByPk($pt->user_id);
                        $team_members[$pt->user_id] = array('uid'=>$pt->user_id,
                                                            'email'=>$user->loginname,
                                                            'userfname'=>$user->firstname,
                                                            );
                    }
                }
            }
           
//            echo '<pre>';
//            print_r($team_members);
//            echo '</pre>';
            return $team_members;
        }
        
        public function alertTeam($issueid,$heading){
            $team = $this->findMembersOfTeam($issueid);
            $teamemails = '';
             
            //print_r($team);
            //echo '<hr>';
            /*
             * remove email of the person who creates/modifies the issue.
             */
            unset($team[Yii::app()->user->userId]);
            
            //print_r($team);exit;
            
            foreach ($team As $key=>$value){
                $teamemails .= $value['email'].',';
            }
            
            
            
                               //$to  = 'prasanna.p@idealmotors.lk' . ', ';
                               $to = $teamemails;
                               // $to  .= 'chaminda@aranxa.com' . ', ';
                               //$to = 'chaminda@aranxa.com,bhashini@aranxa.com';
                                
                               
                                    //$subject = 'New Receipt Issued Receipt #: '.$model->id.' Amount #: '.$advance;
                                   $subject =  $heading.' Issue ID: '.$issueid;
                                   $message = '<html><head><title>Issue Tracker Alerts</title></head>
                                            <body>
                                            <table>
                                            <tr><td>'.'Time : '.date('Y-m-d h:i:s a', time()).'</td></tr>
                                            <tr><td>'.'Issue ID : '.$issueid.'</td></tr>
                                            <tr><td>'.'Author : '.Yii::app()->user->name.'</td></tr>
                                            <tr><td>'.'Message : '.$heading.'</td></tr>
                                            <tr><td>'.'Url : <a href="http://timetracker.aranxa.com/issuetracker/index.php/issues/'.$issueid.'">Go to Issue</a></td></tr>
                                            </table>
                                            </body>
                                            </html>';

                                
                                $headers  = 'MIME-Version: 1.0' . "\r\n";
                                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                                //$headers .= 'From: <admin@aranxaevenware.com>' . "\r\n";
                                //added on 2013_11_19
                                $headers .= 'From: <'.Yii::app()->params['adminEmail'].'>' . "\r\n";
                                //$headers .= 'Cc: ' . "\r\n";
                               // $headers .= 'Bcc: chamindar2002@yahoo.com' . "\r\n";
                               // $headers .= 'chamindar2002@yahoo.com' . "\r\n";
                                
                                mail($to, $subject, $message, $headers);

                    
           //echo $teamemails;exit;       
        }
        
        public function trunctateText($text, $max_len)
        {
          $len = strlen($text);
          if ($len <= $max_len)
            return $text;
          else
            return mb_substr($text, 0, $max_len - 1, 'UTF-8') . '...';
        }
}