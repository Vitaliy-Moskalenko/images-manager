<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\Image;
use app\models\ImageForm;
use yii\web\UploadedFile;


class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$dataProvider = new ActiveDataProvider([
			'query' => Image::find()
		]);
		                   
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
	
    /**
     * Displays upload images form.
     *
     * @return Response|string
     */
    public function actionUpload()
    {
        $formModel = new ImageForm();
		
		if(Yii::$app->request->isPost) {
			
			$formModel->file = UploadedFile::getInstances($formModel, 'file');			  

			if($formModel->file && $formModel->validate()) {
				foreach($formModel->file as $file) {
					$preparedFilename = mb_strtolower($this->_translit_cyr($file->basename));
					$preparedFilename = str_replace(" ", "-", $preparedFilename);
					if(file_exists(\Yii::$app->params['uploadDir'].$preparedFilename.'.'.$file->extension)) { 
						$preparedFilename .= uniqid();
					}					
					
					$file->saveAs(\Yii::$app->params['uploadDir'].$preparedFilename.'.'.$file->extension);
					
					$imageModel = new Image();
					$imageModel->filename = $preparedFilename.'.'.$file->extension;
					$imageModel->save();
				}
				
				return $this->redirect(['/']);
			}  
		}

        return $this->render('upload', ['model' => $formModel]);
    }
	
	 /**
     * Function for translit cyrillic characters into latin
     *
     * @return string
     */
	private function _translit_cyr($text = '') {
		$cyr = ['а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
				'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
				'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
				'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'];
		$lat = ['a','b','v','g','d','e','yo','zh','z','i','y','k','l','m','n','o','p',
				'r','s','t','u','f','h','ts','ch','sh','sch','','y','','ae','yu','ya',
				'A','B','V','G','D','E','Yo','Zh','Z','I','Y','K','L','M','N','O','P',
				'R','S','T','U','F','H','Ts','Ch','Sh','Sch','','Y','','Ae','Yu','Ya'];
					   
		return str_replace($cyr, $lat, $text);
	}
}
