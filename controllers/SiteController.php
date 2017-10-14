<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;
use app\models\Transfer;
use app\models\MakeTransfer;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
        return $this->render('index' , [
          'users' => User::findAllUsers()
        ]);
    }
    /**
     * Displays transfer page.
     *
     * @return string
     */
    public function actionTransfer()
    {
        if (Yii::$app->user->isGuest)
            return $this->redirect('/');

        $model = new MakeTransfer();
        $user = Yii::$app->user->identity;

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $user->username != $model->username){
            $reciever = User::findByUsername($model->username);

            if (!$reciever)
              $reciever = User::createUser($model->username);

            $reciever->balance += $model->amount;
            $user->balance -= $model->amount;

            if ($user->save() && $reciever->save())
                if (Transfer::createTransfer($user->id , $reciever->id , $model->amount));
                    return $this->redirect('/');
        }

        return $this->render('transfer' , [
          'model' => $model
        ]);
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionHistory()
    {
        if (Yii::$app->user->isGuest)
          return $this->redirect('/');

        return $this->render('history' , [
            'transfers' => Transfer::getTransfersByUser( Yii::$app->user->identity->id)
        ]);
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
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

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


}
