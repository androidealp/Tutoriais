<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Tests;
use app\models\Games;

class SiteController extends Controller
{



  public function actionDeleteRelations()
  {

    $testes = Tests::search();
    $games = Games::search();

      return $this->render('delete',[
        'testes'=>$testes,
        'games'=>$games,
      ]);
  }

  public function actionDeletarTest($id)
  {

    $session = \Yii::$app->session;

    $testes = Tests::findOne($id);

    if($testes->delete())
    {
      $session->addFlash('resposta', [
        'type'=>'success',
        'msg'=>'Teste deletado com sucesso.'
      ]);
    }else{
      $session->addFlash('resposta', [
        'type'=>'danger',
        'msg'=>'Erro encontrado favor resolver.'
      ]);
    }

    return $this->redirect(['site/delete-relations']);

  }

  public function actionDeletarGame($id)
  {

    $games = Games::findOne($id);
    $session = \Yii::$app->session;

    if($games->delete())
    {
      $session->addFlash('resposta', [
        'type'=>'success',
        'msg'=>'Tabela deletada com sucesso!'
      ]);
    }else{
      $session->addFlash('resposta', [
        'type'=>'danger',
        'msg'=>'Ocorreu um erro no processo de remoção'
      ]);
    }

    return $this->redirect(['site/delete-relations']);
  }

  public function actionDeleteListGames()
  {
    $array_id = [1,2,3,4];

    $games = Games::find()->where(['in','id',$array_id])->all();

    foreach($games as $k => $game)
    {
      $game->delete();
    }

  }

  public function actionDeleteTheRelation($id)
  {


    $game = Games::find()->joinWith(['tests'=>function($q){
      return $q->where(['like','nome','proccess'])
    }])->where(['id'=>$id])->one();

    foreach($games->tests as $k => $test)
    {
      $test->delete();
    }

  }





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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
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
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


}
