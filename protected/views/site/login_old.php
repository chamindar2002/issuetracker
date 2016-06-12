<div class="login-left">
    <h2>
        <?php
        if(isset($translations['welcome_message'])){
            echo $translations['welcome_message'];
        }else{
            echo "Quasar Golf Handicapping System";
        }

        
        ?>

    </h2>
    <div>

    </div>
</div>

<div class="login-right">

    <?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

    $this->pageTitle=Yii::app()->name . ' - Login';
    $this->breadcrumbs=array(
        'Login',
    );
    ?>

    <h1>
        <?php
        if(isset($translations['Account Login'])){
            echo $translations['Account Login'];
        }else{
            echo 'Login';
        }
        ?>
        
    </h1>

    <p>
        <?php
            if(isset($translations['Please_fill_out'])){
                //echo $translations['Please_fill_out'];
            }else{
                //echo "Please fill out the following form with your login credentials:";
            }
        ?>

    </p>

    <div class="form">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
            'validateOnSubmit'=>true,
            ),
        )); ?>

       

        <div class="row">
            <?php
            $lbl_username = "<span class='required'>*</span>";
            $lbl_username .= (isset($translations['Username'])?$translations['Username']:'Username');
            echo $form->labelEx($model,$lbl_username);
            //echo $lbl_username.'<br>';
            ?>
            <?php echo $form->textField($model,'username'); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>

        <div class="row">
            <?php
            $lbl_password = "<span class='required'>*</span>";
            $lbl_password .= (isset($translations['Password'])?$translations['Password']:'Password');
            echo $form->labelEx($model,$lbl_password);
            ?>
            <?php echo $form->passwordField($model,'password'); ?>
            <?php echo $form->error($model,'password'); ?>
            <!--<p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
            </p>
            -->
        </div>

         <p class="note">
           <?php
                $req_fields = (isset($translations['common_labels']['Fields_Required'])?$translations['common_labels']['Fields_Required']:"Indicates a mandatory field");
                //echo $req_fields;
                echo "<span class='required'>*</span> $req_fields";
            ?>
            <!--Fields with <span class="required">*</span> are required.-->
        </p>

        <div class="row rememberMe">
            <table>
                <tr>
                    <td>
                        <?php echo $form->checkBox($model,'rememberMe'); ?>
                    </td>
                    <td>
                         <?php echo $form->label($model,'rememberMe'); ?>
                         <?php echo $form->error($model,'rememberMe'); ?>
                    </td>
                </tr>
            </table>
           
           
        </div>

        <div class="row buttons">

            <?php
             $login_button_val = (isset($translations['Login'])?$translations['Login']:'Login');

                echo CHtml::submitButton($login_button_val);
            ?>

                       
        </div>

        <div class="row buttons">
             <?php
             if(isset($_POST['LngLanguages']['language_code'])){
                 $selected_language = $_POST['LngLanguages']['language_code'];
             }else{
                 $selected_language = DEFAULT_LANGUAGE;
             }


             $languagesArray = CHtml::listData(LngLanguages::model()->findAll(),'language_code','language_desc');

             /*echo $form->DropDownList(LngLanguages::model(),'language_code',$languagesArray,
                                        array('options' => array($selected_language=>array('selected'=>true)))
                                      );*/
            /*
            echo $form->DropDownList(LngLanguages::model(),'language_code',$languagesArray,
                                        array(
                                            'ajax' => array(
                                            'type'=>'POST', //request type
                                            'url'=>CController::createUrl('Site/SetLanguage'), //url to call.
                                            //Style: CController::createUrl('currentController/methodToCall')
                                            'update'=>'#language_div', //selector to update
                                            //'data'=>'js:javascript statement'
                                            //leave out the data key to pass all form values through
                                            ),'options' => array($selected_language=>array('selected'=>true)))
                                    );*/

             /*
              * THIS LANGUAGE SELECTOR DROP DOWN BELOW WAS MOVE TO THE FOOTER IN THE TEMPLATE
              *
             echo $form->DropDownList(LngLanguages::model(),'language_code',$languagesArray,
                                        array(
                                            'onchange'=>'this.form.submit()',
                                            'class'=>'language_dropdown',
                                            'options' => array($selected_language=>array('selected'=>true)))
                                    );


                                    */
            ?>

        </div>

        <div class="socialmedialogins">
            <div id="socialmediabutton_twitter">
                <?php
                //require_once('socialmedia/twitter/twitterlogin.php');
                //echo CHtml::link(CHtml::encode('Sign in with Twitter'), array('SocialMedia/TwitterLogin'));

                $imghtml=CHtml::image(yii::app()->baseUrl.'/themes/images/signin_twitter.png');
                echo CHtml::link($imghtml, array('SocialMedia/TwitterLogin'));
                ?>
            </div>

            <div id="socialmediabutton_fb">
                <?php
                include('socialmedia/fb/fbaccess.php');


                ?>

                <a href="<?php echo $loginUrl;?>">
                    <img src="<?php echo yii::app()->baseUrl;?>/themes/images/singin_fb.png" alt="sign in with fb">
                </a>
            </div>
            <div class="clear"></div>
            
            
        </div>

        
        <!--
            <div id="socialmediabutton_fb">
        <?php //require_once('socialmedia/fb/fblogin.php');?>
            </div>
        -->

       

        <?php $this->endWidget(); ?>
    </div><!-- form -->

</div>

<div class="clear"></div>
