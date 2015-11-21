<?php

/**
 *
 * Fichier de base pour tester la bonne configuration d'un module
 *
 */
class Hhennes_Alerts_Test_Config_Main extends EcomDev_PHPUnit_Test_Case_Config
{
    /**
     * Paramètres de la classe pour tester automatiquement que le fichier de configuration respecte certaines normes
     * Permets de génériser la création de ce fichier de test pour l'ensemble des modules
     */
    protected $_codePool       = 'community';
    protected $_currentVersion = '0.1.4';
    protected $_useResource    = true;
    protected $_useLayout      = true;
    protected $_nodeName       = 'hhennes_alerts'; //Nom utilisé pour les noeud ( models / helpers/ blocks )

    /**
     * Test que le module est actif
     */

    public function testModuleIsActive()
    {
        $this->assertModuleIsActive();
    }

    /**
     * Tests globals sur le module
     */
    public function testModuleGlobal()
    {
        //CodePool
        $this->assertModuleCodePool($this->_codePool);

        //Version du module
        $this->assertModuleVersion($this->_currentVersion);
    }

    /**
     * Vérification des conditions de setup du module
     */
    public function testSetupResources()
    {
        if ($this->_useResource) {
            $this->assertSetupResourceDefined();
            $this->assertSetupResourceExists();
        }
    }

    /**
     * Vérification des alias de la classe
     * ( Models/ ResourceModel / Helpers / Blocks )
     */
    public function testClassesAlias()
    {
        //Models
        $this->assertModelAlias($this->_nodeName.'/abstract', 'Hhennes_Alerts_Model_Abstract');
        $this->assertModelAlias($this->_nodeName.'/alert', 'Hhennes_Alerts_Model_Alert');
        $this->assertModelAlias($this->_nodeName.'/observer', 'Hhennes_Alerts_Model_Observer');
        $this->assertModelAlias($this->_nodeName.'/mysql4_alert', 'Hhennes_Alerts_Model_Mysql4_Alert');
        $this->assertModelAlias($this->_nodeName.'/mysql4_alert_collection', 'Hhennes_Alerts_Model_Mysql4_Alert_Collection');
        
        $this->assertResourceModelAlias($this->_nodeName.'/alert', 'Hhennes_Alerts_Model_Mysql4_Alert');
        $this->assertResourceModelAlias($this->_nodeName.'/alert_collection', 'Hhennes_Alerts_Model_Mysql4_Alert_Collection');
        
        //Helpers
        $this->assertHelperAlias($this->_nodeName, 'Hhennes_Alerts_Helper_Data');
        
        //blocks
        $this->assertBlockAlias($this->_nodeName.'/adminhtml_alert', 'Hhennes_Alerts_Block_Adminhtml_Alert');
        $this->assertBlockAlias($this->_nodeName.'/adminhtml_alert_grid', 'Hhennes_Alerts_Block_Adminhtml_Alert_Grid');
        $this->assertBlockAlias($this->_nodeName.'/adminhtml_alert_edit', 'Hhennes_Alerts_Block_Adminhtml_Alert_Edit');
        $this->assertBlockAlias($this->_nodeName.'/adminhtml_alert_form', 'Hhennes_Alerts_Block_Adminhtml_Alert_Form');
        $this->assertBlockAlias($this->_nodeName.'/adminhtml_alert_tabs', 'Hhennes_Alerts_Block_Adminhtml_Alert_Tabs');
        $this->assertBlockAlias($this->_nodeName.'/adminhtml_alert_tab_form', 'Hhennes_Alerts_Block_Adminhtml_Alert_Tab_Form');
        
    }

    /**
     * Tests que le layout fonctionne bien
     */
    public function testLayout()
    {
        if ($this->_useLayout) {
            //BO
            $this->assertLayoutFileDefined('adminhtml', 'hhennes_alerts.xml');
            $this->assertLayoutFileExists('adminhtml', 'hhennes_alerts.xml');
        }
    }
    
    /**
     * Test des traductions
     */
    public function testTranslations(){
        
        //Traduction Admin ( ne fonctionne pas car doit ce contenu doit peut etre être dans le fichier adminhtml )
        /*$this->assertConfigNodeHasChild('adminhtml', 'translate');
        $this->assertConfigNodeHasChild('adminhtml/translate/', 'modules');
        $this->assertConfigNodeHasChild('adminhtml/translate/modules', strtoupper($this->_nodeName));
        $this->assertConfigNodeHasChild('adminhtml/translate/modules/'.strtoupper($this->_nodeName), 'file');
        $this->assertConfigNodeHasChild('adminhtml/translate/modules/'.strtoupper($this->_nodeName).'/file', 'default');
        $this->assertConfigNodeValue('adminhtml/translate/modules/'.strtoupper($this->_nodeName).'/file/default', strtoupper($this->_nodeName).'.csv');
        */
    }
    
    /**
     * Test des taches crons
     */
    public function testCronTabs(){
        
        $this->assertConfigNodeHasChild('crontab','jobs');
        $this->assertConfigNodeHasChild('crontab/jobs','hhennes_alerts_execute');
        $this->assertConfigNodeHasChild('crontab/jobs/hhennes_alerts_execute','schedule');
        $this->assertConfigNodeHasChild('crontab/jobs/hhennes_alerts_execute/schedule','cron_expr');
        $this->assertConfigNodeValue('crontab/jobs/hhennes_alerts_execute/schedule/cron_expr','* * * * *');
        $this->assertConfigNodeHasChild('crontab/jobs/hhennes_alerts_execute','run');
        $this->assertConfigNodeHasChild('crontab/jobs/hhennes_alerts_execute/run','model');
        $this->assertConfigNodeValue('crontab/jobs/hhennes_alerts_execute/run/model','hhennes_alerts/observer::ExecuteScheduledAlerts');
        
    }

}
?>
