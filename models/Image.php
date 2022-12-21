<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;


class Image extends ActiveRecord
{

	public function behaviors()
	{
		return [
			TimestampBehavior::class,
		];
	}	
	
    public function rules() {
         return [
			[['filename'], 'string'],
			[['filename'], 'required'],
         ];
    }

    public function attributeLabels() {
        return [
            'id'         => 'ID',
            'filename'   => 'Name',
            'updated_at' => 'Upload Date'           
        ];
    }
}	