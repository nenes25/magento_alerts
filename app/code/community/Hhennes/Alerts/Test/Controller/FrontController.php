<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FrontController
 *
 * @author Herve <contact@h-hennes.fr>
 */
class Hhennes_Alerts_Test_Controller_FrontController extends EcomDev_PHPUnit_Test_Case_Controller {
    
    
    public function testRun(){
        $this->dispatch('hhennes_alerts/run');
        $this->assertLayoutLoaded();
        $this->assertResponseBodyContains("Test");
    }
}
