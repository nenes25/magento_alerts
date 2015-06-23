<?php
class Hhennes_Alerts_Block_Adminhtml_Alert  extends Mage_Adminhtml_Block_Widget_Grid_Container {
    
    public function __construct() {
       
        $this->_controller = 'adminhtml_alert';
        $this->_blockGroup = 'hhennes_alerts';
        $this->_headerText = $this->__('Manage Alerts');
        
        parent::__construct();
        
        $this->_updateButton('add', 'label', Mage::helper('hhennes_alerts')->__('Add New Alert'));
    }
}
