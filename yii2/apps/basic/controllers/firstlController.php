<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
        
        class firstlController extends \yii\base\Controller {
            public function actionHello()
            {
              return $this->renderPartial('Hello');
            }
        }


?>