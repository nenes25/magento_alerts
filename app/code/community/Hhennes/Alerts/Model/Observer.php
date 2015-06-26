<?php

class Hhennes_Alerts_Model_Observer {

    /**
     * Fonction lancées toutes les minutes pour voir si des alertes doivent être lancées
     */
    public function ExecuteScheduledAlerts() {

        $errors = array();
        $alertsCollection = Mage::getModel('etatpur_alerts/alert')->getCollection();

        foreach ($alertsCollection as $alert) {

            try {
                $cron = (Mage::getModel('cron/schedule')->setCronExpr($alert->getCronSchedule())->trySchedule(time()));

                if ($cron && $alert->getActive() == 1) {
                    $alert->executeAlert();
                    $alert->setLastExecution(Mage::getSingleton('core/date')->gmtDate());
                    $alert->save();
                }
            } catch (Exception $e) {

                $errors[] = $e->getMessage();
            }
        }
    }

}
