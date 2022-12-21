<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;


class ImageForm extends Model
{
	public $file;
	
	public function rules() {
		return [
			[['file'], 'file', 'maxFiles' => 5, 'skipOnEmpty' => false, 'extensions' => 'jpg, jpeg, png']
		];	
	}
} 