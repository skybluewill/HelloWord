<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use yii\base\Theme;
use app\events\testEvent;
use app\events\testEvent2;

class SiteController extends Controller
{
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
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionHelloWorld($message = 'helloworld')
    {
        return $this->render('HelloWorld',['message' => $message]);    
    }
    
    public function actionSay($message = '你好')
    {
        return $this->render('say', ['message' => $message]);
    }
    
    public function actionWhy($message = '你好')
    {
        return $this->render('why', ['message' => $message]);
    }
    
    public function actionEntry()
    {
        $model = new EntryForm();
        
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            return $this->render('entry-confirm',['model'=>$model]);
        } else {
            return $this->render('entry',['model'=>$model ]);
        }
    }
    
    public function actionEvent1(){
        
        $test1 = new testEvent();
        $test2 = new testEvent2();

        $test1->on(testEvent::EVENT_TEST1, [$test2, 'test2']);
        $test1->on(testEvent::EVENT_TEST1, [$test1, 'test1']);
        echo $test1::EVENT_TEST1;
        $test1->trigger(testEvent::EVENT_TEST1);
    }
    
    public function actionAlias(){
        
        echo '@webroot path is-----',Yii::getAlias('@webroot'),'<br>';
        echo '@app path is --------',Yii::getAlias('@app'),'<br>';
        Yii::setAlias('@layouts','@app/views/layouts');
        echo '@layouts path is ----',Yii::getAlias('@layouts'),'<br>';
        //Yii::setAlias('app/views/layouts',)
        return $this->render('@layouts/testFrame');  
    }
    
    public function actionTheme(){
        
       
        //return var_dump($theme->applyTo($theme->pathMap));
        //return print_r($theme->pathMap) && var_dump($theme->pathMap);
      //  Yii::$app ->applyTo(Yii::getAlias('@app/views/HelloWorld'));
        
        
        
    }
}
