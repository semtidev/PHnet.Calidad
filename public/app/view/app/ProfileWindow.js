Ext.define('PHNet.view.app.ProfileWindow', {
    extend: 'Ext.window.Window',
    alias : 'widget.userprofile',
    id: 'userprofile',
    requires: [
        'Ext.form.*',
    ],     
    layout: 'fit',
    autoShow: true,
    width: 300,
    resizable: false,
    modal: true,
    title: 'Perfil de Usuario',  
    initComponent: function() {
        this.items = [{
            xtype: 'form',
            padding: '5 20 20 20',
            style: 'background: #fff url(dist/img/profile-bg.jpg) repeat-x;',
            
            fieldDefaults: {
            	anchor: '100%',
                labelAlign: 'left',
                style: 'background: transparent;',
                margin: '10 0 10 0',
                combineErrors: true,
                msgTarget: 'side'
            },
            items: [{
            	xtype: 'textfield',
                name: 'exportto',
                hidden: true
            }, {
                xtype: 'component',
                width: 240,
                cls: 'profile-name',
                html: localStorage.getItem('username'),
                margin: '15 0 10 0'
            }, {
                xtype: 'component',
                cls: 'profile-avatar',
                style: 'background: url(/phnet.calidad/public/dist/img/users/'+localStorage.getItem('userphoto')+'.jpg)'
            }, {
                xtype: 'component',
                width: 240,
                cls: 'profile-rol',
                html: localStorage.getItem('userrol')
            }, {
                xtype: 'component',
                width: 240,
                cls: 'profile-notify',
                html: 'Recibir Notificaciones por Correo:'
            }, {
                xtype: 'checkboxfield',
                id: 'notify_metrology',
                boxLabel: 'Plan de Calibraci&oacute;n de Metrolog&iacute;a',
                name: 'metrology',
                margin: '0 0 5 15'
            }, {
                xtype: 'checkboxfield',
                id: 'notify_normalization',
                boxLabel : 'Plan de Normalizaci&oacute;n',
                name: 'normalization',
                disabled: true,
                margin: '0 0 5 15'
            }, {
                xtype: 'checkboxfield',
                id: 'notify_satisfaction_ci',
                boxLabel: 'Satisfacci&oacute;n de Clientes Internos',
                name: 'satisfaction_ci',
                disabled: true,
                margin: '0 0 5 15'
            }, {
                xtype: 'checkboxfield',
                id: 'notify_satisfaction_ce',
                boxLabel: 'Satisfacci&oacute;n de Clientes Externos',
                name: 'satisfaction_ce',
                disabled: true,
                margin: '0 0 5 15'
            }]
        }];
          
    this.callParent(arguments);
    }
});