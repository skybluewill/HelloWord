<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\events;

use yii\base\Component;

class testEvent2 extends Component {
    
    public function test2($event){
        echo 'this is Index testEvent2';
        $event->handled = true;
    }
    
}

