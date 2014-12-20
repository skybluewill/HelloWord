<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use yii\web\Controller;
use app\models\Country;
use yii\data\Pagination;

class CountryController extends Controller {
    
    public function actionIndex(){
        $query = Country::find();

        $pagination = new Pagination([
                'defaultPageSize' => 5,
                'totalCount'      => $query->count(),
            ]);
        
        $countries = $query->orderBy('Name')->offset($pagination->offset)->limit($pagination->limit)->all();
        
        return $this->render('index',['countries'=>$countries,'pagination'=>$pagination]);
    }
    
}

