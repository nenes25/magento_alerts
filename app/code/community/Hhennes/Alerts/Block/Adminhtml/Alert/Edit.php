<?php
class Hhennes_Alerts_Block_Adminhtml_Alert_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {

        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'hhennes_alerts';
        $this->_controller = 'adminhtml_alert';
        $this->_updateButton('save', 'label', Mage::helper('adminhtml')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('adminhtml')->__('Delete'));
        
        //Ajout d'un bouton pour lancer l'alerte directement
        $this->_addButton('run', array(
                'label'=> Mage::helper('hhennes_alerts')->__('Run alert now'),
                'onclick' => 'runAlert();'
                ));
        
        //Ajout d'un bouton pour dupliquer l'alerte
        $this->_addButton('duplicate', array(
                'label'=> Mage::helper('hhennes_alerts')->__('Duplicate'),
                'onclick' => 'duplicateAlert();'
                ));
        
        //Js Spécifique du bouton de lancement de l'alerte
        $this->_formScripts[] = "
            function runAlert() {
             window.open('".$this->getUrl('hhennes_alerts/specificalert/executeAlert/',array('alert_id' => $this->getRequest()->getParam('id')))."'); 
             return false;  
            }
            function duplicateAlert(){
            document.location.href = '".$this->getUrl('*/*/duplicateAlert/',array('id' => $this->getRequest()->getParam('id')))."'
            }
        ";
    }
    
    /**
     * Titre de la page
     * @return type 
     */
    public function getHeaderText() {
        if (Mage::registry('alert_data') && Mage::registry('alert_data')->getId()) {
            return Mage::helper('hhennes_alerts')->__("Edition of the alert '%s'", $this->htmlEscape(Mage::registry('alert_data')->getId()));
        } else {
            return Mage::helper('hhennes_alerts')->__('Add an Alert');
        }
    }

}