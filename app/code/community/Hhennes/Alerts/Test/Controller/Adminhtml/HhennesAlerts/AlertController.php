<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlertControler
 *
 * @author Herve <contact@h-hennes.fr>
 */
class Hhennes_Alerts_Test_Controller_Adminhtml_HhennesAlerts_AlertController extends EcomDev_PHPUnit_Test_Case_Controller {
    
    public function testGridAction(){
        
        $this->getRequest()->setMethod('POST')
                ->setPost(
                        array(
                            'email' => 'nenes_fr@yahoo.fr',
                            'password' => 'herve2584',
                        )
        );
        $this->dispatch('admin');
        $this->reset();
        
        $this->dispatch('admin/hhennes_alerts/alert/');
        $this->assertLayoutLoaded();
        $this->assertLayoutBlockCreated('hhennes_alert');
        
        $this->assertLayoutBlockTypeOf('hhennes_alert', 'hhennes_alerts/adminhtml_alert');
        $this->assertLayoutBlockInstanceOf('hhennes_alert', 'Hhennes_Alerts_Block_Adminhtml_Alert'); 
        $this->assertFalse(true);
    }
    
}
