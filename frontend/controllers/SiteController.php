<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\ImageUpload;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [

                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {

        $data = Article::getPopular();

        return $this->render('index',[
            'recent' => $data]);

    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
                'recent' => Article::getRecent(),
                'categories' => Article::getCategories(),

            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if(isset($_POST['SignupForm']))
        {
            $model->attributes = Yii::$app->request->post('SignupForm');
            if($model->validate() && $user = $model->signup())
            {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }

            }
        }

        return $this->render('signup',[
            'model'=>$model,
            'recent' => Article::getRecent(),
            'categories' => Article::getCategories(),]);
    }

    public function actionPersonal()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('personal');
    }

    public function action404()
    {
        return $this->render('404.php');
    }


}
