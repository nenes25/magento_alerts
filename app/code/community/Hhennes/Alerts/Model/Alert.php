<?php
class Hhennes_Alerts_Model_Alert extends Hhennes_Alerts_Model_Abstract {
    
    /**
     * Initialisation du modèle Bdd
     */
    protected function _construct() {
        $this->_init('hhennes_alerts/alert');
    }

    /**
     * Lancement de l'alerte
     * @param $manual : Alerte lancée en mode manuel ou non
     */
    public function executeAlert($manual = false) {

        try {

            // Si la requête comporte des commandes autre que select on ne le fait pas
            if (preg_match('#insert|delete|update#i', $this->getConditions())) {

                throw new Exception('Les commandes Sql autres que select ne sont pas autorisées.');
            }
            
            //Traitement normal
            else {

                //Exécution de la requête Sql du module
                $read = Mage::getSingleton('core/resource')->getConnection('core_read');
                
                $datasList = $read->fetchAll($this->getConditions());
                
                if ( !sizeof($datasList) )
                    return;

                //Export des données au format csv si défini
                
                if ($this->getExportToCsv() == 1) {

                    $csvHeader = '';
                    $csvLine ='';
                    $i=0;
                    
                    //Génération du fichier
                    foreach ($datasList as $data) {
                        
                        foreach ( $data as $fieldname => $value ) {
                            
                            //Entête du fichier
                            if ( $i == 0)
                                $csvHeader .= '"'.$fieldname.'";';
                            
                            $csvLine .= '"'.$value.'";';
                        }
                       $csvLine.= "\n";
                       $i++;
                    }
                    //On assemble l'entete et les données du fichier csv
                    $csvFile = $csvHeader."\n".$csvLine;
                    
                    //Vérification que le dossier de destination existe bien
                    $this->_checkExportDir($this->getExportCsvFilePath());
                    
                    //Si l'alerte à été lancée manuellement on change le path du fichier
                    if ( $manual)
                        $path = self::EXPORT_PATH_DIR_MANUAL;
                    else
                        $path = self::EXPORT_PATH;
                    
                    //Enregistrement du fichier dans le nom donné
                    $fileName = date('Ymd-His').$this->getExportCsvFileName().'.csv';
                    $fp = fopen($path.$this->getExportCsvFilePath().'/'.$fileName,'w+');
                    fputs($fp,$csvFile);
                    fclose($fp);
                    
                }
                
                //Envoi de l'email de confirmation si défini
                if ( $this->getEmailToSend() == 1 ) {
                                        
                    //Paramètres de l'emails
                    $params = array(
                        'recipient' => $this->getEmailRecipient(),
                        'subject' => $this->getEmailSubject(),
                        'message' => $this->getEmailMessage(),
                        'file' => __FILE__
                    );
                    
                    //Si la pièce jointe doit être ajoutée au mail
                    if ( $this->getExportCsvAttachedToEmail() == 1) {
                    
                        $params['attachment'] = $path.$this->getExportCsvFilePath().'/'.$fileName;
                        $params['attachment_name'] = $this->getExportCsvFileName().'.csv';
                    }

                    //Envoi de l'email
                    $this->_sendMail($params);
                    
                }
         
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } 
}
