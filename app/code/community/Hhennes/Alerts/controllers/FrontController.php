<?php
class Hhennes_Alerts_FrontController extends Mage_Core_Controller_Front_Action {

    /**
     * Exécution manuelle d'une alerte
     */
    public function runAction(){
        
        $idAlert = $this->getRequest()->getParam('alert_id');
        try {
            $alert = Mage::getModel('hhennes_alerts/alert')->load($idAlert);            
            $alert->executeAlert(true);
            $alert->setLastExecution(Mage::getSingleton('core/date')->gmtDate());
            $alert->save();            
        } catch (Exception $e) {
            die($e->getMessage());
        }
        
        echo $this->__('Alert successfully executed');
        
    }
    
    
}

