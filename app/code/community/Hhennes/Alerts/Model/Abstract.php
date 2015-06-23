<?php
abstract class Hhennes_Alerts_Model_Abstract extends Mage_Core_Model_Abstract {
    
    /* Dossier de base des exports */
    const EXPORT_PATH = 'var/export/alerts/';
    const EXPORT_PATH_DIR_MANUAL = 'var/export/alerts/';
     
    /* Paramètres par défaut de l'email
     * @ToDo Mettre en configuration 
     */
    const DEFAULT_EMAIL_SENDER = 'contact@h-hennes.fr';
    const DEFAULT_EMAIL_SENDER_NAME = 'Alertes Automatiques';
    const EMAIL_ADDRESS_DEV_TEAM = 'contact@h-hennes.fr';
       
    /**
     * Si le dossier de destination n'existe pas on le créée
     * @param type $dir 
     */
    protected function _checkExportDir($dir) {
        
        if ( !is_dir(self::EXPORT_PATH.$dir) ) {
            mkdir(self::EXPORT_PATH.$dir,0777);
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
            $recipient = self::EMAIL_ADDRESS_DEV_TEAM;
        }

        //Gestion des destinataires multiples :
        if ( preg_match('#;#',$recipient)) {
            $recipents = explode(';',$recipient);
        }
        
        $mail = new Zend_Mail('UTF-8');
        $mail->setFrom(self::DEFAULT_EMAIL_SENDER, self::DEFAULT_EMAIL_SENDER_NAME);
             
        //Si destinataires multiples
        
        if ( $recipents ) {
            foreach($recipents as $emailCopy) {
                $mail->addTo($emailCopy);
            }
        }
        else {
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
