/**
 * Hhennes Alerts
 * Nouvelles règles de validation pour le formulaire d'administration
 */
Validation.addAllThese([
    
    //Les conditions ne peuvent pas contenir select update ou delete
    ['validate-hhennes-alerts-conditions', 'Invalid conditions, you can only use SELECT commands', function (v) {
            return !/UPDATE|DELETE/i.test(v) ;
        }],
    
    //Validation du format cron
    ['validate-hhennes-alerts-cron-expr', 'Invalid cron expression', function (v) {
            return true;
        }]
]);


