Ext.define('PHNet.view.metrology.MetroSearch', {
    extend: 'Ext.window.Window',
    id: 'metrosearch',
    alias : 'widget.metrosearch',
    requires: ['Ext.form.*'],
    title: 'Buscar Instrumento...',
    layout: 'fit',
    autoShow: true,
    width: 280,
    height: 130,
    modal: true,
	initComponent: function() {
		this.items = [{
        	xtype: 'form',
            padding: '15 15 15 15',
            border: false,
			modal: true,
            style: 'background-color: #F4F6F8;',
            waitMsgTarget: true,
            fieldDefaults: {
            	anchor: '100%',
                labelAlign: 'top',
                combineErrors: true,
                msgTarget: 'side'
            },
            items: [{
                xtype: 'textfield',
                id: 'metrosearch_serial',
                allowBlank: false,
                flex: 1,
                margin: '5',
                name: 'searchtext',
                emptyText: 'No. de Serie del instrumento',
                afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>',
            }, {
                xtype: 'box',
                id: 'box-search-desc',
                visible: false,
                margin: '4 0 0 12',
                html: 'Teclee el No. Serie y presione Enter.'
            }, {
                xtype: 'box',
                id: 'box-search-loading',
                visible: false,
                margin: '15 0 0 85',
                html: '<span class="fas fa-cog fa-spin"></span>'
            }, {
                xtype: 'box',
                id: 'box-search-msg',
                cls: 'error-msg',
                visible: false,
                margin: '4 0 0 30',
                html: 'El instrumento no existe.'
            }]
        }];
         
        /*this.dockedItems = [{
            xtype: 'toolbar',
            dock: 'bottom',
            id: 'buttons',
            ui: 'footer',
            items: ['->', {
                text: 'Aceptar',
                cls: 'app-form-btn',
                scale: 'medium',
                action: 'storeclose'
            }, {
                text: 'Cancelar',
                cls: 'app-form-btn',
                scale: 'medium',
                scope: this,
                handler: this.close
            }]
        }];*/

        this.callParent(arguments);
    }
});