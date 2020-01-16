<?php

namespace app\models;

use Yii;

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
 * @property int|null $file_id
 * @property int $active
 *
 * @property Files[] $files
 */
class ChartBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'type', 'active'], 'required'],
            [['description', 'options'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['file_id', 'active'], 'integer'],
            [['title'], 'string', 'max' => 256],
            [['type'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'options' => Yii::t('app', 'Options'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'file_id' => Yii::t('app', 'File ID'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['chart_id' => 'id']);
    }
}
