<?php
namespace common\models;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model{

    public $image;
    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png']
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;
        if($this->validate())
        {
            $this->deleteCurrentImage($currentImage);
            return $this->saveImage();
        }
    }

    private function getFolder()
    {
        $path_to_folder = Yii::getAlias( '@webFrontend' ).'/uploads/article_'.yii::$app->request->get('id');
        if(!is_dir($path_to_folder)){
           mkdir($path_to_folder);
        }
        return $path_to_folder.'/';
    }

    private function generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    public function deleteCurrentImage($currentImage)
    {
        if($this->fileExists($currentImage))
        {
            unlink($this->getFolder() . $currentImage);
        }
    }

    public function fileExists($currentImage)
    {
        if(!empty($currentImage) && $currentImage != null)
        {
            return file_exists($this->getFolder() . $currentImage);
        }
    }

    public function saveImage()
    {
        $filename = $this->generateFilename();
        $this->image->saveAs($this->getFolder() . $filename);
        return $filename;
    }

    public function removeDirectory($dir) {
        if ($objs = glob($dir."/*")) {
            foreach($objs as $obj) {
                is_dir($obj) ? $this->removeDirectory($obj) : unlink($obj);
            }
        }
        rmdir($dir);
    }
}