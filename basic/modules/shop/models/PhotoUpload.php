<?php
///**
// * Created by PhpStorm.
// * User: Shokhaa
// * Date: 18.05.2018
// * Time: 10:31
// */
//
//
namespace app\modules\shop\models;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class PhotoUpload extends Model
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'png, jpg, jpeg',  'maxFiles' => 4, 'maxSize' => 51200 * 1024, ],
        ];
    }

}