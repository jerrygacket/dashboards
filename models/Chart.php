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
    const CHART_DEFAULTS = [
        'options' => [
            'responsive' => true,
            'tooltips' => [
                'mode' => 'index',
                'intersect' => false,
            ],
            'hover' => [
                'mode' => 'nearest',
                'intersect' => true,
            ],
        ]
    ];
    const BG_COLORS = [
        'rgba(255, 99, 132, 0.4)',
        'rgba(54, 162, 235, 0.4)',
        'rgba(255, 206, 86, 0.4)',
        'rgba(75, 192, 192, 0.4)',
        'rgba(153, 102, 255, 0.4)',
        'rgba(255, 159, 64, 0.4)'
    ];

    const COLORS = [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
    ];
    const SEPARATOR = ',';

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
            ['uploadedFile','file','extensions' => ['txt','csv'], 'checkExtensionByMimeType' => false, 'maxFiles' => 1],
        ], parent::rules());
    }

    public function upload() {
        if (!$this->uploadedFile) {
            return true;
        }
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

    public function getChartData() {
        $strings = file('files/'.$this->id.'/'.$this->file);
        $colNames = explode(self::SEPARATOR, array_shift($strings));
        $dataNames = explode(self::SEPARATOR, array_shift($strings));
        $data = [];
        foreach ($strings as $string) {
            $data[] = explode(self::SEPARATOR, $string);
        }
        $result = [
            'type' => $this->type,
            'data' => [
                'labels' => $this->getXValues($dataNames, $data),
                'datasets' => $this->getYValues($colNames, $dataNames, $data),
            ],
            'options' => [
                'title' => [
                    'display' => true,
                    'text' => $this->title
                ],
            ],
        ];

        $result = array_merge_recursive($result, ['options' => json_decode($this->options, true)]);

        return array_merge_recursive(self::CHART_DEFAULTS, $result);
    }

    public function getXValues($names, $data) {
        $xIndex = array_search('x', $names);

        return array_column($data, $xIndex);
    }

    public function getYValues($columns, $names, $data) {
        $yIndexes = [];
        $labels = [];
        $result = [];
        foreach ($names as $key => $name) {
            if (substr_count($name, 'y') > 0) {
                $yIndexes[] = $key;
                $labels[] = $columns[$key];
            }
        }
        foreach ($yIndexes as $key => $yIndex) {
            $yData = array_column($data, $yIndex);
            $colorCount = count($yData);
            $result[] = [
                'label' => $labels[$key],
                'data' => $yData,
//                'backgroundColor' => 'rgba(255, 99, 132, 0.4)',
//                'borderColor' => 'rgba(255, 99, 132, 1)',
                'backgroundColor' => self::getBGColors($key, $colorCount, $this->type),
                'borderColor' => self::getBorderColors($key, $colorCount, $this->type),
                'fill' => ( $this->type != 'line'),
            ];
        }

        return $result;
    }

    public function getBGColors($current, $count, $type) {
        if ($type == 'doughnut') {
            return array_slice(self::BG_COLORS, 0, $count);
        }

        return self::BG_COLORS[$current];
    }

    public function getBorderColors($current, $count, $type) {
        if ($type == 'doughnut') {
            return array_slice(self::COLORS, 0, $count);
        }

        return self::COLORS[$current];
    }

}
