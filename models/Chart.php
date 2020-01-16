<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "chart".
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string|null $description
 * @property string|null $options
 * @property string $created_on
 * @property string $updated_on
 * @property UploadedFile $uploadedFile
 */
class Chart extends ChartBase
{
    public $uploadedFile = '';

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_on', 'updated_on'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_on'],
                ],
                'value' => new Expression('NOW()')
            ]
        ];
    }

    public function rules()
    {
        return array_merge([
            ['uploadedFile','file','extensions' => ['txt','csv'],'maxFiles' => 1],
        ], parent::rules());
    }

    public function upload() {
        if($this->validate()){
            $path = \Yii::getAlias('@webroot/files/'.$this->id);
            FileHelper::createDirectory($path);
            $fileName=$path.'/'.$this->file;
//            is_uploaded_file($this->uploadedFile->tempName) ?
//                $this->uploadedFile->saveAs($fileName) :
//                rename($this->uploadedFile->tempName,$fileName);
            if(!$this->uploadedFile->saveAs($fileName)){
                $this->addError('file','Не удалось сохранить файл');
                return false;
            } else {
                return true;
            }
        }

        return false;
    }

}
