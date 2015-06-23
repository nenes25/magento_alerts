<?php
class Hhennes_Alerts_Block_Adminhtml_Alert_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    /**
     * Paramètres du block
     */
    public function __construct() {
        parent::__construct();
        $this->setId('AlertsGrid');
        $this->setDefaultSort('alert_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Paramètres de la collection
     * @return type 
     */
    protected function _prepareCollection() {

        $collection = Mage::getModel('hhennes_alerts/alert')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Paramètres des colonnes à afficher
     * @return type 
     */
    protected function _prepareColumns() {
       
        $this->addColumn('alert_id', array(
            'header' => Mage::helper('hhennes_alerts')->__('ID'),
            'align' => 'right',
            'width' => '20px',
            'index' => 'alert_id',
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('hhennes_alerts')->__('name'),
            'align' => 'right',
            'index' => 'name',
        ));
        
        $this->addColumn('description', array(
            'header' => Mage::helper('hhennes_alerts')->__('description'),
            'align' => 'right',
            'index' => 'description',
        ));

        
        $this->addColumn('date_add', array(
            'header' => Mage::helper('hhennes_alerts')->__('Date add'),
            'align' => 'left',
            'index' => 'date_add',
        ));


        return parent::_prepareColumns();
    }
     
    /**
     * Lien d'édition des urls
     */
    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
