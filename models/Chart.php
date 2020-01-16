<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

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
 *
 * @property Files[] $files
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

}
