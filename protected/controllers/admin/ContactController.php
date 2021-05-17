<?php

class ContactController extends Controller
{

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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','admin', 'import'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=> array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function actionImport()
    {

        if(isset($_POST['import']))
        {
            // collects user input data      
            $csv_file = $_FILES['csv_file'];
            
            // validates user input and redirect to previous page if validated
            if (isset($csv_file['tmp_name']) && !empty($csv_file['tmp_name'])) {

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $csv_file['tmp_name']);
                $tmpName = $csv_file['tmp_name'];
                $csv = [];
                finfo_close($finfo);
    
                $allowed_mime = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

                if (in_array($mime, $allowed_mime) && is_uploaded_file($csv_file['tmp_name'])) {
    
                    if(($handle = fopen($tmpName, 'r')) !== FALSE) {
                        // necessary if a large csv file
                        set_time_limit(0);
            
                        $row = 0;
            
                        while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                            // number of fields in the csv
                            $col_count = count($data);

                            if (empty($data[1]) || empty($data[2]) || empty($data[3]) || empty($data[4]) || empty($data[5]) || empty($data[6]) || empty($data[7]) || empty($data[8]) || empty($data[9]) ) {
                                
                                // inc the row
                                $row++;

                                continue;
                            }
            
                            // get the values from the csv
                            // $csv['id'] = $data[0];
                            $csv['first_name'] = $data[1];
                            $csv['last_name'] = $data[2];
                            $csv['email'] = $data[3];
                            $csv['phone_number'] = $data[4];
                            $csv['city'] = $data[5];
                            $csv['state'] = $data[6];
                            $csv['zipcode'] = $data[7];
                            $csv['country'] = $data[8];
                            $csv['comment'] = $data[9];
                            $csv['comment_2'] = $data[10];
                            // $csv['created_at'] = $data[11];
                            // var_dump($csv);
            
                            $contact = new Contact;

                            // Fill contact with values and save to DB
                            if ($contact->exists("email='$data[3]'")) {
                                $model= Contact::model()->findByAttributes(array('email' => $data[3]));
                                
                                $model->attributes = $csv;
                                $model->save();
                            } else {
                                $contact->attributes = $csv;
                                $contact->save();
                            }

                            // inc the row
                            $row++;
                        }
                        fclose($handle);
                    }
    
                    // echo '<pre>';
                    // var_dump($col_count, $data);
                    // echo '<pre>';
                    // die;
                }
            }
        }
        // displays the login form
        Yii::app()->user->setFlash('success', "Data imported successfully!");

        $this->redirect(array('admin/contact/index'));
    }

    public function actionIndex()
    {
		$model=new Contact('search');
		$model->unsetAttributes();  // clear any default values

		if (isset($_GET['Contact'])) {
			$model->attributes=$_GET['Contact'];
        }

        $dataProvider = new CActiveDataProvider('Contact',  array(
            'criteria'=>array(
                'order'=>'created_at DESC',
            ),
            // 'countCriteria'=>array(
            //     'condition'=>'status=1',
            //     // 'order' and 'with' clauses have no meaning for the count query
            // ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }

    public function actionView()
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
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
        $model = Contact::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
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
