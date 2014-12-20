<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;

class HelloWorldController extends Controller {
    public function actionHelloWorld () {
        return $this->render('HelloWorld');
        
    }
    
    public function actionHelloWorld2 () {
        return $this->render('HelloWorld2',array('a'=>'aaa','b'=>'bbb','c'=>'ccc'));
    }
}

