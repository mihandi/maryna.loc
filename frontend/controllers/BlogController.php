<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\Comment;
use Yii;

use yii\db\Exception;
use yii\web\Controller;


/**
 * Site controller
 */
class BlogController extends Controller
{

    public $enableCsrfValidation = false;

    public function actionIndex()
    {

        $data = Article::getAll(4);

        return $this->render('blog_grid',[
            'pagination' => $data['pagination'],
            'categories' => $data['categories'],
            'recent' => $data['recent'],
            'articles' => $data['articles']]);
    }

    public function actionArticle()
    {

        if(Yii::$app->request->isAjax) {
            if(Yii::$app->request->get('comment')) {
                $id  = yii::$app->request->get('comment');
                Comment::findOne($id)->delete();

                $data = Article::getSingle();

                return $this->renderAjax('/blog/comments',[
                    'article' => $data['article'],
                    'comments' => $data['comments']
                ]);
            }else {
                $commentPost = new Comment();
                if ($commentPost->load(Yii::$app->request->post()) && $commentPost->validate()) {
                    $commentPost->save();
                }else{
                    var_dump($commentPost->errors);die();
                }
                $data = Article::getSingle();

                return $this->renderAjax('/blog/comments',[
                    'article' => $data['article'],
                    'comments' => $data['comments'],
                    'commentPost' => $commentPost,]);

            }
        }

        $data = Article::getSingle();
        Article::viewedCounter($data['article']['id'],$data['article']['viewed']);

        return $this->render('blog_single',[
            'article' => $data['article'],
            'author' => $data['author'],
            'categories' => $data['categories'],
            'comments' => $data['comments'],
            'recent' => $data['recent'],
            'nextprev' => $data['np']
        ]);
    }
}
