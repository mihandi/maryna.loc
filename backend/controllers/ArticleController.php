<?php

namespace backend\controllers;

use common\models\Category;
use common\models\Comment;
use common\models\ImageUpload;
use Yii;
use common\models\Article;
use common\models\ArticleSearch;
use yii\base\DynamicModel;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        }

        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        }

        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $create_folder = new ImageUpload();
            $create_folder->createFolder($model->id);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => Category::find()->all()
        ]);

    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => Category::find()->all()
        ]);

    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        }

        $this->findModel($id)->delete();

        $imageU = new ImageUpload();
        $imageU->removeDirectory(Yii::getAlias('@backend') . '/web/elfinder/global/article_' . yii::$app->request->get('id'));

        $comment = new Comment();
        $comment->deleteArticleComments($id);

        return $this->redirect(['index']);

    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetImage()
    {
        if(yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        }
        $id = yii::$app->request->get('id');

        $model = new ImageUpload();
        $article = $this->findModel($id);
        $path_to_folder = Yii::getAlias( '@backend' ).'/web/elfinder/global/article_'.$id;

        if (Yii::$app->request->isPost) {
            $post = yii::$app->request->post();
            $file = UploadedFile::getInstanceByName('file');
//var_dump($file);die();
            $model = new DynamicModel(compact('file'));
            $image = Image::crop(
                $file->tempName,
                intval($post['w']),
                intval($post['h']),
                [$post['x'], $post['y']]
            )->resize(
                new Box($post['width'],$post['height'])
            );
//            var_dump($image);die();

            $saveOptions = ['jpeg_quality' => 100, 'png_compression_level' => 1];

            if(!is_dir($path_to_folder)){
                mkdir($path_to_folder);
            }
            $imageName = 'main.jpg';
            if ($image->save($path_to_folder . $imageName, $saveOptions) && $article->saveImage($imageName)) {
                $result = [
                    'filelink' => '/elfinder/global/article_'.$id.'main.jpg'
                ];
            } else {
                $result = [
                    'error' => Yii::t('cropper', 'ERROR_CAN_NOT_UPLOAD_FILE')
                ];
            }
            Yii::$app->response->format = Response::FORMAT_JSON;

            return $result;
        }

        return $this->render('image', ['model' => $model,'article_id' => $article['id']]);

    }


    public function actionSetCategory($id)
    {
        if(yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        }

        $article = $this->findModel($id);
        $selectedCategory = $article->category->id;
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');
        if (Yii::$app->request->isPost) {
            $category = Yii::$app->request->post('category');
            if ($article->saveCategory($category)) {
                return $this->redirect(['view', 'id' => $article->id]);
            }
        }
        return $this->render('category', [
            'article' => $article,
            'selectedCategory' => $selectedCategory,
            'categories' => $categories
        ]);

    }
}