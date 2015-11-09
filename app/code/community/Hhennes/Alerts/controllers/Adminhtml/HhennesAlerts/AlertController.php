<?php
class Hhennes_Alerts_Adminhtml_HhennesAlerts_AlertController extends Mage_Adminhtml_Controller_Action {

    /**
     * Initialisation du module
     *
     */
    protected function _initAction() {

        $this->loadLayout()
                ->_setActiveMenu('report');

        return $this;
    }

    /**
     * Fonction d'index par défaut
     */
    public function indexAction() {

        $this->_title($this->__('Hhennes Alerts'))
                ->_title($this->__('Manage Alerts'));

        $this->_initAction();
        $this->renderLayout();
    }

    /**
     * Edition d'une alerte
     */
    public function editAction() {

        $alertId = $this->getRequest()->getParam('id');
        $alertModel = Mage::getModel('hhennes_alerts/alert')->load($alertId);
        if ($alertModel->getId() || $alertId == 0) {
            Mage::register('alert_data', $alertModel);
            $this->loadLayout();
            $this->_setActiveMenu('report/alert/');
            $this->_addBreadcrumb('alert Manager', 'alert Manager');
            $this->_addBreadcrumb('alert Description', 'alert Description');
            $this->getLayout()->getBlock('head')
                    ->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()
                            ->createBlock('hhennes_alerts/adminhtml_alert_edit'))
                    ->_addLeft($this->getLayout()
                            ->createBlock('hhennes_alerts/adminhtml_alert_edit_tabs')
            );
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('hhennes_alerts')->__('alert does not exist'));
            $this->_redirect('*/*/');
        }
    }

    /**
     * Nouvelle Alerte
     */
    public function newAction() {

        $this->_forward('edit');
    }

    /**
     *  Sauvegarde du modèle;
     */
    
    public function saveAction() {
        
        if ($this->getRequest()->getPost()) {
            
            try {
                
                $postData = $this->getRequest()->getPost();
                
                $alertModel = Mage::getModel('hhennes_alerts/alert');

                $alertModel->addData($postData)
                           ->setDateAdd(Mage::getSingleton('core/date')->gmtDate())
                           ->setAlertId($this->getRequest()->getParam('id'))
                           ->save();
                
                if ( $this->getRequest()->getParam('id') ) {
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('hhennes_alerts')->__('Successfully Modified'));
                }
                else {
                   Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('hhennes_alerts')->__('Successfully Added')); 
                }
                
                Mage::getSingleton('adminhtml/session')->setalertData(false);
                
                $this->_redirect('*/*/');
                return;
            } 
            catch (Exception $e) {
                
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setalertData($this->getRequest()->getPost());
                
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        
        $this->_redirect('*/*/');
    }
    
    
    /**
     * Suppression d'un modèle
     */ 
     public function deleteAction() {
         
        if ($this->getRequest()->getParam('id') > 0) {
            
            try {
                
                $alertModel = Mage::getModel('hhennes_alerts/alert');
                $alertModel->setAlertId($this->getRequest()->getParam('id'))->delete();
                
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('hhennes_alerts')->__('Successfully Deleted'));
                
                $this->_redirect('*/*/');
            } 
            catch (Exception $e) {
                
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        
        $this->_redirect('*/*/');
    }
    
    /**
     * Duplication d'une alerte existante
     */
    public function duplicateAlertAction(){
        
        if ($this->getRequest()->getParam('id')) {
            
            try {
                $alertModel = Mage::getModel('hhennes_alerts/alert')->load($this->getRequest()->getParam('id'));
                $alertModel->setAlertId();
                $alertModel->save();
                
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('hhennes_alerts')->__('Successfully Duplicated'));
                Mage::getSingleton('adminhtml/session')->setalertData($alertModel->getData());
                $this->_redirect('*/*/edit', array('id' => $alertModel->getAlertId()));
                return;
            } 
            catch (Exception $e) {
                
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setalertData($this->getRequest()->getPost());
                
                $this->_redirect('*/*/edit', array('id' => $alertModel->getAlertId()));
                return;
            }
        }
        
        $this->_redirect('*/*/');
        
    }

}
