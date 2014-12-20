<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\events;

use yii\base\Component;

class testEvent extends Component{
    
    const   EVENT_TEST1 = 'test1';
    
    public function test1 ($event){
        echo 'test1';
        exit;
    }
    
}


