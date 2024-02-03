Ext.define('PHNet.view.metrology.MovetoprojectForm', {
    extend: 'Ext.window.Window',
    id: 'movetoprojectform',
    alias : 'widget.movetoprojectform',
    requires: ['Ext.form.*'],
    title: 'Mover Instrumento al Proyecto',
    layout: 'fit',
    autoShow: true,
    width: 350,
    modal: true,
	initComponent: function() {
		this.items = [{
            xtype: 'form',
            id: 'metromove-form',
            padding: '15 15 15 15',
            border: false,
			modal: true,
            //style: 'background-color: #F4F6F8;',
            waitMsgTarget: true,
            fieldDefaults: {
            	anchor: '100%',
                labelAlign: 'top',
                combineErrors: true,
                msgTarget: 'side'
            },
            items: [{
                    xtype: 'workscombo',
                    id: 'metromove-project',
                    allowBlank: false,
                    margin: '3 3 3 3',
                    name: 'project',
                    fieldLabel: ''
                },{
                    xtype: 'textfield',
                    allowBlank: false,
                    margin: '10 3 3 3',
                    name: 'owner',
                    emptyText: 'Responsable del Instrumento',
                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                }
            ]
        }];
         
        this.dockedItems = [{
            xtype: 'toolbar',
            dock: 'bottom',
            id: 'buttons',
            ui: 'footer',
            items: [{
                xtype: 'label',
                id: 'metromove-error',
                cls: 'error-msg',
                text: '',
                margin: '0 0 0 10'
            },'->', {
                text: 'Aceptar',
                id: 'metromove-btn',
                cls: 'app-form-btn',
                scale: 'medium',
                margin: '0 10 0 0',
                action: 'storeclose'
            }]
        }];
 
        this.callParent(arguments);
    }
});