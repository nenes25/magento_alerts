<?php
class Hhennes_Alerts_Block_Adminhtml_Alert_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('alert_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('hhennes_alerts')->__('Alert detail'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('hhennes_alerts')->__('Alert detail'),
            'title' => Mage::helper('hhennes_alerts')->__('Alert detail'),
            'content' => $this->getLayout()->createBlock('hhennes_alerts/adminhtml_alert_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}
