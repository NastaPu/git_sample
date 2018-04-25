<?php

namespace app\controllers;

use app\models\Comment;
use app\models\Tag;
use app\models\User;
use app\models\CommentForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Post;
use yii\data\Pagination;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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

    /**
     * Displays homepage.
     *
     * @return string
     */


public function actionIndex()
    {
        //$model = new Post();
        $query = Post::find()->where(['status' => Post::STATUS_PUBLISHED])->orderBy('update_time desc');
        $page = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
        $posts = $query->offset($page->offset)
            ->limit($page->limit)
            ->all();

        $lastComments = Comment::find()->orderBy('CREATE_TIME desc')->limit(3)->all();
        $tags = Tag::find()->all();

        return $this->render('index', [
            'posts' => $posts,
            'page' => $page,
            'lastComments'=>$lastComments,
            'tags'=>$tags,
        ]);
    }
    public function actionView($id)
    {
        $post = Post::findOne($id);
        $comments = $post->getPostComments();
        $commentForm = new CommentForm();
        return $this->render('view',[
            'post' => $post,
            'comments' => $comments,
            'commentForm' => $commentForm,
        ]);
    }

    public function actionComment($id)
    {
        $commentForm = new CommentForm();
        if(Yii::$app->request->isPost) {
            $commentForm->load(Yii::$app->request->post());

            if($commentForm->saveComment($id)){
                return $this->redirect(['site/view', 'id' => $id ]);
            }
        }
    }
    public function actionTag($id)
    {
        $query = Post::find()->where(['tag_id'=>$id]);
        $page = new Pagination(['totalCount' => $query->count(), 'pageSize' => 2]);
        $postTag = $query->offset($page->offset)
            ->limit($page->limit)
            ->all();

        return $this->render('tag',[
            'postTag' => $postTag,
            'page' => $page,
        ]);
    }
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


}
