Ext.define('PHNet.store.Extpolls', {
	extend: 'Ext.data.Store',
    model: 'PHNet.model.Extpolls',
    autoLoad: false,
    sortOnLoad: false,
    groupField: 'department',
    listeners: {
        load: function(store, records, successful, eOpts ) {
            if (store.count() > 0) {
                var prom = store.getAt(store.count() - 1).data.work_prom,
                    eval = store.getAt(store.count() - 1).data.work_eval;                        
                Ext.getCmp('box-extcustomer-prom').update('Promedio Total: ' + prom);
                Ext.getCmp('box-extcustomer-eval').update('Evaluaci&oacute;n: ' + eval);
            }
            else {
                Ext.getCmp('box-extcustomer-prom').update('Promedio Total: -');
                Ext.getCmp('box-extcustomer-eval').update('Evaluaci&oacute;n: -');
            }
        }
    },
    proxy: {
        pageParam: false, //to remove param "page"
        startParam: false, //to remove param "start"
        limitParam: false, //to remove param "limit"
        noCache: false, //to remove param "_dc"
        type: 'ajax',
        reader: {
            type: 'json',
            root: 'satisfaction',
            successProperty: 'success',
            messageProperty: 'message'
        },
        listeners: {
            exception: function(proxy, response, operation) {
                Ext.MessageBox.show({
                    title: 'Mensaje del Sistema',
                    msg: 'Lo sentimos, ha ocurrido un error en el sistema durante su ejecución. Presione la tecla F5 de su teclado para que todo inicie nuevamente. Si el problema persiste póngase en contacto con el <a href="mailto:jmachadog@ecm4hab.co.cu">Administrador del Sistema</a>.',
                    icon: 'fas fa-exclamation-triangle fa-2x dlg-error',
                    buttons: Ext.Msg.OK
                });
            }
        }
    }
});