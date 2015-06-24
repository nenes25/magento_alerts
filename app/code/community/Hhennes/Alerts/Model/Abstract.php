<?php

abstract class Hhennes_Alerts_Model_Abstract extends Mage_Core_Model_Abstract {
    /* Dossier de base des exports */

    const EXPORT_PATH = 'var/export/alerts/';
    const EXPORT_PATH_DIR_MANUAL = 'var/export/alerts/';

    /**
     * Si le dossier de destination n'existe pas on le créée
     * @param type $dir 
     */
    protected function _checkExportDir($dir) {

        if (!is_dir(self::EXPORT_PATH . $dir)) {
            mkdir(self::EXPORT_PATH . $dir, 0777);
        }
    }

    /**
     * Fonction d'envoi d'email
     * @param array $params
     * @return send mail
     */
    protected function _sendMail($params) {

        $params['message'] .= '<p><i>Email envoyé depuis le fichier ' . $params['file'] . ' le ' . date('Y-m-d-H:i:s') . '</p>';

        //Destinataire du mail
        if ($params['recipient']) {
            $recipient = $params['recipient'];
        } else {
            $recipient = Mage::getStoreConfig('system/hhennes_alerts/alert_email_default_recipient');
        }

        //Gestion des destinataires multiples :
        if (preg_match('#;#', $recipient)) {
            $recipents = explode(';', $recipient);
        }

        //Gestion de l'expéditeur et de son nom
        if (Mage::getStoreConfig('system/hhennes_alerts/alert_email_sender') && Mage::getStoreConfig('system/hhennes_alerts/alert_email_sender') != '')
            $senderEmail = Mage::getStoreConfig('system/hhennes_alerts/alert_email_sender');
        else
            $senderEmail = Mage::getStoreConfig('trans_email/ident_general/email');

        if (Mage::getStoreConfig('system/hhennes_alerts/alert_email_sender_name') && Mage::getStoreConfig('system/hhennes_alerts/alert_email_sender_name') != '')
            $senderName = Mage::getStoreConfig('system/hhennes_alerts/alert_email_sender_name');
        else
            $senderName = Mage::getStoreConfig('trans_email/ident_general/name');

        $mail = new Zend_Mail('UTF-8');
        $mail->setFrom($senderEmail, $senderName);

        //Si destinataires multiples
        if ($recipents) {
            foreach ($recipents as $emailCopy) {
                $mail->addTo($emailCopy);
            }
        } else {
            $mail->addTo($recipient);
        }

        $mail->setSubject($params['subject'])
                ->setBodyHtml($params['message']);

        //Si il y'a une pièce jointe
        if ($params['attachment']) {

            $attachement = new Zend_Mime_Part(file_get_contents($params['attachment']));
            $attachement->type = 'text/csv';
            $attachement->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
            $attachement->encoding = Zend_Mime::ENCODING_BASE64;
            $attachement->filename = $params['attachment_name'];
            $mail->addAttachment($attachement);
        }

        //Envoi de l'email
        $mail->send();
    }

}
