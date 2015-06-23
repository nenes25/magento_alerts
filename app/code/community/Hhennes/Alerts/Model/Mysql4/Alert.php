<?php
class Hhennes_Alerts_Model_Mysql4_Alert extends Mage_Core_Model_Mysql4_Abstract {

    /**
     * Initialize resource model
     */
    protected function _construct() {
        
        $this->_init('hhennes_alerts/alert', 'alert_id');
    
    }
    

}
