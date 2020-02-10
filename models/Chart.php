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
 * @property string $page
 * @property string|null $description
 * @property string|null $options
 * @property string $created_on
 * @property string $updated_on
 * @property string|null $localFile
  * @property UploadedFile $uploadedFile
 */
class Chart extends ChartBase
{
    const CHART_FILES_PATH = 'files/sftp-root/';
    const CHART_DEFAULTS = [
        'options' => [
            'responsive' => true,
            'tooltips' => [
                'mode' => 'point',
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
        'rgba(255, 159, 64, 0.4)',

        'rgba(99, 255, 132, 0.4)',
        'rgba(162, 54, 235, 0.4)',
        'rgba(206, 255, 86, 0.4)',
        'rgba(192, 75, 192, 0.4)',
        'rgba(102, 153, 255, 0.4)',
        'rgba(159, 255, 64, 0.4)',

        'rgba(99, 132, 255, 0.4)',
        'rgba(162, 235, 54, 0.4)',
        'rgba(206, 86, 255, 0.4)',
        'rgba(192, 192, 75, 0.4)',
        'rgba(102, 255, 153, 0.4)',
        'rgba(159, 64, 255, 0.4)',
    ];

    const COLORS = [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',

        'rgba(99, 255, 132, 1)',
        'rgba(162, 54, 235, 1)',
        'rgba(206, 255, 86, 1)',
        'rgba(192, 75, 192, 1)',
        'rgba(102, 153, 255, 1)',
        'rgba(159, 255, 64, 1)',

        'rgba(99, 132, 255, 1)',
        'rgba(162, 235, 54, 1)',
        'rgba(206, 86, 255, 1)',
        'rgba(192, 192, 75, 1)',
        'rgba(102, 255, 153, 1)',
        'rgba(159, 64, 255, 1)',
    ];
    const SEPARATOR = ';';

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
            ['page', 'trim'],
            ['type', 'required'],
            ['type', 'trim'],
        ], parent::rules());
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'type' => 'Тип',
            'file' => 'Локальный файл',
            'page' => 'Страница',
            'options' => 'Опции (json-строка)',
            'uploadedFile' => 'Сторонний файл (имеет приоритет перед локальным)',
        ];
    }

    public function upload() {
        if (!$this->uploadedFile) {
            return true;
        }
        if($this->validate()){
            $path = \Yii::getAlias('@webroot/'.self::CHART_FILES_PATH);
            FileHelper::createDirectory($path);
            $fileName=$path.'/'.$this->file;
            $this->checkDir(dirname($fileName));
            if(!$this->uploadedFile->saveAs($fileName)){
                $this->addError('file','Не удалось сохранить файл');
                return false;
            } else {
                return true;
            }
        }

        return false;
    }

    public function checkDir($dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    public function getExampleData($type){
        $fileName = \Yii::getAlias('@webroot/'.self::CHART_FILES_PATH.$type.'.csv');
        return file_exists($fileName) ? file($fileName) : [];
    }

    public function getUTF8Data($fileName) {
        $enc = shell_exec('file -bi '.$fileName);
        if (substr_count($enc, 'charset=utf-8') === 0) {
            // charset=[\w\W]+
//            $tmp = explode(';',$enc);
//            $coding = explode('=', trim($tmp[1]));
            shell_exec('iconv -f cp1251 -t utf-8 -o '.$fileName.' '.$fileName);
//            shell_exec('iconv -f '.$coding[1].' -t utf-8 -o '.$fileName.' '.$fileName);
        }
        $result = str_replace(',','.', trim(file_get_contents($fileName)));

        return explode(PHP_EOL, $result);
    }

    public function getChartData() {
//        $strings = file('files/'.$this->id.'/'.$this->file);
        $chartFile = \Yii::getAlias('@webroot/'.self::CHART_FILES_PATH.$this->file);
        $strings = file_exists($chartFile)
            ? $this->getUTF8Data($chartFile)
            : $this->getExampleData($this->type);

        $colNames = explode(self::SEPARATOR, trim(array_shift($strings)));
        $dataNames = explode(self::SEPARATOR, trim(array_shift($strings)));
        $data = [];
        foreach ($strings as $string) {
            $data[] = explode(self::SEPARATOR, trim($string));
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
        $xValues = array_column($data, $xIndex ? $xIndex : 0);
        foreach ($xValues as &$value) {
            $value = trim($value);
            if ($value == '') {
                $value = null;
            }
        }

        return $xValues;
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
            $yData = array_column($data, $yIndex  ? $yIndex : 1);
            foreach ($yData as &$value) {
                $value = trim($value);
                if ($value == '' || $value == '0') {
                    $value = null;
                }
            }
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
        if ($type == 'doughnut' || $type == 'pie') {
            return array_slice(self::BG_COLORS, 0, $count);
        }

        return self::BG_COLORS[$current] ?? 'rgba(255, 99, 132, 0.4)';
    }

    public function getBorderColors($current, $count, $type) {
        if ($type == 'doughnut' || $type == 'pie') {
            return array_slice(self::COLORS, 0, $count);
        }

        return self::COLORS[$current] ?? 'rgba(255, 99, 132, 1)';
    }

}
