Ext.define('PHNet.view.satisfaction.ImportForm', {
    extend: 'Ext.window.Window',
    id: 'importform',
    alias: 'widget.importform',
    requires: ['Ext.form.*'],
    title: 'Importar Actividades...',
    layout: 'fit',
    autoShow: true,
    resizable: false,
    width: 530,
    height: 190,
    modal: true,
    initComponent: function() {
        this.items = [{
            xtype: 'form',
            padding: '10 15 15 15',
            border: false,
            modal: true,
            style: 'background-color: #f2f8fc;',
            waitMsgTarget: true,
            fieldDefaults: {
                anchor: '100%',
                labelAlign: 'top',
                combineErrors: true,
                msgTarget: 'side'
            },
            items: [{
                xtype: 'textfield',
                name: 'id_poll',
                fieldLabel: 'id',
                hidden: true
            }, {
                xtype: 'textfield',
                name: 'id_activity',
                fieldLabel: 'id_activity',
                hidden: true
            }, {
                xtype: 'filefield',
                name: 'excel_doc',
                fieldLabel: 'Documento MS Excel',
                labelWidth: 50,
                msgTarget: 'side',
                allowBlank: false,
                margin: '0 3 10 3',
                buttonConfig: {
                    text: '<i class="fas fa-search"></i>&nbsp;Buscar...',
                    cls: 'app-form-btn',
                    scale: 'medium',
                }
            }]
        }];

        this.dockedItems = [{
            xtype: 'toolbar',
            dock: 'bottom',
            id: 'buttons',
            ui: 'footer',
            items: ['->', {
                id: 'importform-okbtn',
                text: '<i class="fas fa-check"></i>&nbsp;Aceptar',
                cls: 'app-form-btn',
                scale: 'medium',
                margin: '3 0 3 0',
                action: 'import'
            }, {
                id: 'importform-cancelbtn',
                text: '<i class="fas fa-times"></i>&nbsp;Cancelar',
                cls: 'app-form-btn',
                scale: 'medium',
                margin: '3 15 3 5',
                scope: this,
                handler: this.close
            }]
        }];

        this.callParent(arguments);
    }
});