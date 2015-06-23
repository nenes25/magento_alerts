<?php

class Hhennes_Alerts_Model_Mysql4_Alert_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('hhennes_alerts/alert');
    }

    
}

?>
