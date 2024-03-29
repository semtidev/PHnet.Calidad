Ext.define('PHNet.store.Pollhost', {
	extend: 'Ext.data.Store',
    model: 'PHNet.model.Pollhost',
    autoLoad: false,
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
                console.log('response:');
                console.log(response);
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