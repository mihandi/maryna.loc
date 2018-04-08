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

        if($category_id = yii::$app->request->get('category_id'))
        {
            $data = Article::getArticlesByCategories($category_id);

            return $this->render('blog_grid', [
                'pagination' => $data['pagination'],
                'articles' => $data['article'],
                'count' => $data['count'],
                'popular_articles' => Article::getPopular(),
                'categories' => Article::getCategories(),
                'months' => Article::getArchive()


            ]);

        }elseif($var = yii::$app->request->get('var')){
            $data = Article::getArticles(6);

            return $this->render('blog_grid_var_2', [
                'pagination' => $data['pagination'],
                'articles' => $data['article'],
                'popular_articles' => Article::getPopular(),
                'categories' => Article::getCategories(),
            ]);
        }
        else {
            $data = Article::getArticles();

            return $this->render('blog_grid', [
                'pagination' => $data['pagination'],
                'articles' => $data['article'],
                'popular_articles' => Article::getPopular(),
                'categories' => Article::getCategories(),
                'months' => Article::getArchive()
            ]);
        }
    }

    public function actionArticle()
    {

        if(Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest) {
                return $this->goBack();
            }
            if(Yii::$app->request->get('comment')) {


                $id  = yii::$app->request->get('comment');
                Comment::deleteComment($id);

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
        if(!$data){return $this->redirect('/site/error');}
        Article::viewedCounter($data['article']['id'], $data['article']['viewed']);

        return $this->render('blog_single', [
            'article' => $data['article'],
            'nextprev' => $data['np'],
            'categories' => Article::getCategories(),
            'comments' => $data['comments'],
            'popular_articles' => Article::getPopular(),
            'gallery' => Article::getGallery(),
            'months' => Article::getArchive(),
        ]);


    }

    public function actionSearch()
    {
        $search_result = Article::searchFr();

        return $this->render('blog_grid', [
            'pagination' => $search_result['pagination'],
            'articles' => $search_result['articles'],
            'popular_articles' => Article::getPopular(),
            'categories' => Article::getCategories(),
            'months' => Article::getArchive()

        ]);
    }
}
