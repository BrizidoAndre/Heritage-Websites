<?php
namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $imagePath;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
            ['imagePath','string']
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('./content-pages/images/' . $this->imagePath . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}