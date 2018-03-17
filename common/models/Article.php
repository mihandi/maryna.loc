<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\Pagination;
use yii\data\SqlDataProvider;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $image
 * @property int $viewed
 * @property int $user_id
 * @property int $status
 * @property int $category_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','description','content','user_id'], 'required'],
            [['title','description','content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['category_id'], 'number']
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
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
            'description' => 'Description',
            'content' => 'Content',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'user_id' => 'User ID',
            'status' => 'Status',
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    public function saveImage($filename)
    {
        $this->image = $filename;
        return $this->save(false);
    }

    public function getImage()
    {
        return ($this->image) ? '/uploads/article_'.$this->id.'/' . $this->image : '/no-image.png';
    }

    public function deleteImage()
    {
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }

    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete();
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public static function getCategories()
    {
        $categories =  Yii::$app->db->createCommand(
            'SELECT * FROM category Limit 4')
            ->queryAll();

        foreach ($categories as $category)
        {
            $category['count'] = Article::find()->where(['category_id' => $category['id']])->count();
            $res[] = $category;
        }

        return $res;
    }

    public function saveCategory($category_id)
    {
        $category = Category::findOne($category_id);
        if($category != null)
        {
            $this->link('category', $category);
            return true;
        }
    }


    //FRONTEND


    public static function getAll($pageSize = 4)
    {
        $query = Article::find();
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=>$pageSize]);
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['articles'] = $articles;
        $data['recent'] = Article::getRecent();
        $data['categories'] = Article::getCategories();
        $data['pagination'] = $pagination;

        return $data;
    }

    public static function getPrevNext($article)
    {
       $res['prev'] = Yii::$app->db->createCommand(
           "SELECT id,title FROM article WHERE created_at <:time
            ORDER BY created_at DESC LIMIT 1")
           ->bindValue('time',$article['created_at'])
           ->queryOne();

        $res['next'] = Yii::$app->db->createCommand(
            "SELECT id,title FROM article WHERE created_at >:time
            ORDER BY created_at ASC LIMIT 1")
            ->bindValue('time',$article['created_at'])
            ->queryOne();

       return $res;
    }

    public static function getSingle()
    {
        $id  = yii::$app->request->get('id');
        $article['article'] = Article::findOne($id);
        $article['author'] = self::getAuthor($article['article']['user_id']);
        $article['recent'] = Article::getRecent();
        $article['categories'] = Article::getCategories();
        $article['np'] = Article::getPrevNext($article['article']);



        $articleObj = new Article();
        $article['comments'] = $articleObj->getArticleComments($id);

        return $article;
    }

    public static function getPopular()
    {
        $articles =  Yii::$app->db->createCommand(
            'SELECT id,image,title,viewed FROM article
                  ORDER BY viewed DESC Limit 4')
            ->queryAll();

        foreach ($articles as $article)
        {
            $article['count'] = Comment::find()->where(['article_id' => $article['id']])->count();
            $res[] = $article;
        }

        return $res;
    }

    public static function getRecent()
    {
        $articles =  Yii::$app->db->createCommand(
            'SELECT id,image,title,viewed FROM article
                  ORDER BY created_at DESC Limit 4')
            ->queryAll();

        foreach ($articles as $article)
        {
            $article['count'] = Comment::find()->where(['article_id' => $article['id']])->count();
            $res[] = $article;
        }

        return $res;

    }

    public function getArticleComments($id)
    {
        $comments['count'] = Comment::find()->where(['article_id' => $id])->count();
        $pagination = new Pagination(['totalCount' => $comments['count'], 'pageSize'=>6]);

        $comments['comments'] = Yii::$app->db->createCommand(
            'SELECT c.id,c.text,c.created_at,c.user_id,u.login,u.created_at as "user_created_at" FROM `comment` c
                Inner join user as u 
                where c.article_id =:article_id and c.user_id = u.id 
                LIMIT :offset, :limit')
            ->bindValue('article_id',$id)
            ->bindValue('offset',$pagination->offset)
            ->bindValue('limit',$pagination->limit)
            ->queryAll();

        $comments['pagination'] = $pagination;

        return  $comments;
    }

    public static function getAuthor($user_id)
    {
        return Yii::$app->db->createCommand(
            'SELECT login from user where id =:user_id')
            ->bindValue('user_id',$user_id)
            ->queryOne();
    }

    public static function viewedCounter($article_id,$viewed)
    {
       return $comments['comments'] = Yii::$app->db->createCommand(
            'UPDATE article
                      SET viewed=:viewed
                      WHERE id=:article_id')
            ->bindValue('viewed',$viewed+1)
            ->bindValue('article_id',$article_id)
            ->execute();
    }

}
