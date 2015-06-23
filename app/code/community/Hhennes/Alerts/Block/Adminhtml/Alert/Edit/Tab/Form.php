<?php
class Hhennes_Alerts_Block_Adminhtml_Alert_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('alert_form', array('legend' => Mage::helper('hhennes_alerts')->__('Alert information')));

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('hhennes_alerts')->__('name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'name',
        ));
        
        $fieldset->addField('active', 'select', array(
            'label' => Mage::helper('hhennes_alerts')->__('Alert Active'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'active',
            'values' => array(
                array(
                    'value' => '0',
                    'label' => Mage::helper('hhennes_alerts')->__('No'),
                ),
                array(
                    'value' => '1',
                    'label' => Mage::helper('hhennes_alerts')->__('Yes'),
                )
            )
                )
        );  

        $fieldset->addField('description', 'textarea', array(
            'label' => Mage::helper('hhennes_alerts')->__('description'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'description',
        ));

        $fieldset->addField('conditions', 'textarea', array(
            'label' => Mage::helper('hhennes_alerts')->__('conditions'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'conditions',
        ));

        $fieldset->addField('email_to_send', 'select', array(
            'label' => Mage::helper('hhennes_alerts')->__('Send an email'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'email_to_send',
            'values' => array(
                array(
                    'value' => '0',
                    'label' => Mage::helper('hhennes_alerts')->__('No'),
                ),
                array(
                    'value' => '1',
                    'label' => Mage::helper('hhennes_alerts')->__('Yes'),
                )
            )
                )
        );
        
        $fieldset->addField('email_recipient', 'text', array(
            'label' => Mage::helper('hhennes_alerts')->__('email recipient'),
            'class' => '',
            'required' => false,
            'name' => 'email_recipient',
        ));
        
         $fieldset->addField('email_subject', 'text', array(
            'label' => Mage::helper('hhennes_alerts')->__('email subject'),
            'class' => '',
            'required' => false,
            'name' => 'email_subject',
        ));
         
          $fieldset->addField('email_message', 'textarea', array(
            'label' => Mage::helper('hhennes_alerts')->__('email message'),
            'class' => '',
            'required' => false,
            'name' => 'email_message',
        ));

         
        $fieldset->addField('export_to_csv', 'select', array(
            'label' => Mage::helper('hhennes_alerts')->__('Export to csv'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'export_to_csv',
            'values' => array(
                array(
                    'value' => '0',
                    'label' => Mage::helper('hhennes_alerts')->__('No'),
                ),
                array(
                    'value' => '1',
                    'label' => Mage::helper('hhennes_alerts')->__('Yes'),
                )
            )
                )
        );  

         $fieldset->addField('export_csv_file_name', 'text', array(
            'label' => Mage::helper('hhennes_alerts')->__('Csv File name'),
            'class' => '',
            'required' => false,
            'name' => 'export_csv_file_name',
        ));
         
          $fieldset->addField('export_csv_file_path', 'text', array(
            'label' => Mage::helper('hhennes_alerts')->__('Csv File Path'),
            'class' => '',
            'required' => false,
            'name' => 'export_csv_file_path',
        ));
          
          $fieldset->addField('export_csv_attached_to_email', 'select', array(
            'label' => Mage::helper('hhennes_alerts')->__('Attach csv to email'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'export_csv_attached_to_email',
            'values' => array(
                array(
                    'value' => '0',
                    'label' => Mage::helper('hhennes_alerts')->__('No'),
                ),
                array(
                    'value' => '1',
                    'label' => Mage::helper('hhennes_alerts')->__('Yes'),
                )
            )
                )
        );  
          
          $fieldset->addField('cron_schedule', 'text', array(
            'label' => Mage::helper('hhennes_alerts')->__('Cron Schedule'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'cron_schedule',
        ));

        if (Mage::registry('alert_data')) {
            $form->setValues(Mage::registry('alert_data')->getData());
        }
        return parent::_prepareForm();
    }

}

?>
