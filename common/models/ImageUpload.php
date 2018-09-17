<?php
namespace common\models;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model{

    public $image;

    const GALLERY_UPLOAD_SCENARIO = 1;
    const ARTICLE_UPLOAD_SCENARIO = 2;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png,jpeg,JPG,JPEG']
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

    public function getFolder($obj_id = null)
    {
        if($this->scenario == self::GALLERY_UPLOAD_SCENARIO){
            $gallery = Gallery::findOne($obj_id);
            $path_to_folder = Yii::getAlias('@backend') . '/web/elfinder/global/gallery/'.$gallery->dir_name."/";
        }elseif($this->scenario == self::ARTICLE_UPLOAD_SCENARIO) {
            $path_to_folder = Yii::getAlias('@backend') . '/web/elfinder/global/article_'.Yii::$app->request->get('id');
        }
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

    public function saveImage($obj_id = null)
    {
        $image = new Image();
        $image->name = $this->image->name;
        $image->gallery_id = $obj_id;
        if(!$image->save()){
            Functions::pretty_var_dump($image->errors);die();
        }
        $filename = $this->generateFilename();
        $this->image->saveAs($this->getFolder($obj_id) . $filename);
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
  public function createFolder($article_id)
    {
        $path_to_folder = Yii::getAlias( '@backend' ).'/web/elfinder/global/article_'.$article_id;
        if(!is_dir($path_to_folder)){
            mkdir($path_to_folder);
        }
        return $path_to_folder.'/';
    }

  public function createUserFolder($user_id)
    {
        $path_to_folder = Yii::getAlias( '@backend' ).'/web/elfinder/global/users/user_'.$user_id;
        if(!is_dir($path_to_folder)){
            mkdir($path_to_folder);
        }
        return $path_to_folder.'/';
    }
}