<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Gallery".
 *
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property int $article_id
 * @property string $seo_url
 * @property string $dir_name
 */
class Gallery extends \yii\db\ActiveRecord
{
    public  $old_dir_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category_id', 'seo_url','dir_name'], 'required'],
            [['title', 'seo_url','dir_name'], 'string'],
            [['category_id', 'article_id'], 'integer'],
            [['old_dir_name'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'category_id' => 'Category ID',
            'article_id' => 'Article ID',
            'seo_url' => 'Seo Url',
            'dir_name' => 'Direcory Name'
        ];
    }

    public function createFolder($gallery_title)
    {
        $path_to_folder = Yii::getAlias( '@backend' ).'/web/elfinder/global/gallery/'.$gallery_title;
        if(!is_dir($path_to_folder)){
            mkdir($path_to_folder);
            chmod("$path_to_folder", 0777);
        }
        return $path_to_folder.'/';
    }

    public function updateFolder($old_gallery_title,$new_gallery_title)
    {
        $path_to_folder = Yii::getAlias( '@backend' ).'/web/elfinder/global/gallery/';

        return rename($path_to_folder.$old_gallery_title,$path_to_folder.$new_gallery_title);

    }

    public static function removeDirectory($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir."/".$object))
                        self::removeDirectory($dir."/".$object);
                    else
                        unlink($dir."/".$object);
                }
            }
            rmdir($dir);
        }
    }

    public static function getGalleries()
    {
            return Yii::$app->db->createCommand(
                'SELECT ga.*,c.seo_url as category_seo_url
                  FROM gallery ga 
                  INNER JOIN category c On ga.category_id =c.id 
                  GROUP BY ga.id')
                ->queryAll();
    }

    public static function getImage($id)
    {
        return '/elfinder/global/article_1/main.jpg';
    }

    public static function getLink($gallery_id,$gallery_seo_url){
        return "/gallery/single/".$gallery_seo_url.'-'.$gallery_id;
    }
}
