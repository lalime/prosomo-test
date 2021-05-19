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
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
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
		$contact = new Contact;

		if(isset($_POST['ContactForm']))
		{
			$model->attributes = $_POST['ContactForm'];
            // Fill contact with values and save to DB
            $contact->attributes = $_POST['ContactForm'];
            $contact->save();
            // die(var_dump($model->attributes, $_POST['ContactForm']));

			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->first_name .' '. $model->last_name).'?=';
				$subject='=?UTF-8?B?'.base64_encode('New contact submitted').'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					'Content-type: text/html; charset=iso-8859-1' . "\r\n". // Specify Content type HTML
                    'X-Mailer: PHP/' . phpversion();

                // Compose a HTML email message with inputs
                $message = '<html><body>';
                $message .= '<h1 style="">Hi!</h1>';
                $message .= '<b>First name : </b>'. $model->first_name .'<br/>';
                $message .= '<b>Last name : </b>'. $model->last_name .'<br/>';
                $message .= '<b>Last name : </b>'. $model->last_name .'<br/>';
                $message .= '<b>Phone number : </b>'. $model->phone_number .'<br/>';
                $message .= '<b>City : </b>'. $model->city .'<br/>';
                $message .= '<b>State : </b>'. $model->state .'<br/>';
                $message .= '<b>Zipcode : </b>'. $model->zipcode .'<br/>';
                $message .= '<b>Country : </b>'. $model->country .'<br/>';

                $message .= $model->comment ? '<b>Comment 1 : </b>'. $model->comment .'<br/>':'';
                $message .= $model->comment_2 ? '<b>Comment 2 : </b>'. $model->comment_2 .'<br/>':'';

                $message .= '</body></html>';
                
				mail(Yii::app()->params['adminEmail'],$subject,$message,$headers);

                // Write log for user login action in errors.log
                Yii::log(' >>> ['. $model->first_name .' '. $model->last_name .' - '. $model->email .'] Message Submitted', 'info', 'application');

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
		$model=new LoginForm;

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
			if($model->validate() && $model->login()) {

                // Write log for user login action in errors.log
                Yii::log(' >>> ['. Yii::app()->user->id .'] Login', 'info', 'application');

				$this->redirect(Yii::app()->user->returnUrl);
            }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
        // Write log for user logout action
        Yii::log(' >>> ['. Yii::app()->user->id .'] Logout', 'info', 'application');

		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}