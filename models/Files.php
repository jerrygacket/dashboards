<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property string $filename
 * @property int $chart_id
 * @property string $created_on
 *
 * @property Chart $chart
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filename', 'chart_id'], 'required'],
            [['chart_id'], 'integer'],
            [['created_on'], 'safe'],
            [['filename'], 'string', 'max' => 512],
            [['chart_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chart::className(), 'targetAttribute' => ['chart_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'filename' => Yii::t('app', 'Filename'),
            'chart_id' => Yii::t('app', 'Chart ID'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChart()
    {
        return $this->hasOne(Chart::className(), ['id' => 'chart_id']);
    }
}
