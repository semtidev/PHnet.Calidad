Ext.define('PHNet.view.satisfaction.ExtcustomersWindow', {
    extend: 'Ext.window.Window',
    id: 'extcustomerswindow',
    alias : 'widget.extcustomerswindow',
    autoShow: true,
    autoScroll: true,
    overflowX: 'auto',
    minWidth: 1100,
    minHeight: 540,
    resizable: false,
    maximizable: true,
    closable: true,
    layout: {
        type: 'vbox',    // Arrange child items vertically
        align: 'stretch',    // Each takes up full width
        overflow: 'auto'
    },
    renderTo: Ext.getBody(),
    title: 'Satisfacci&oacute;n de Servicios a Clientes Externos',
    frame: true,
    listeners: {
        'destroy': function(window, opt) {
            localStorage.removeItem('current_window');
            localStorage.removeItem('current_window_id');
            $('#dropdown-quality').removeClass('focus');
            $('#lnk-home').addClass('active');
        },
        'maximize': function(window, opt) {
            Ext.getCmp('extctab').setHeight(this.height - 127);
        },
        'restore': function(window, opt) {
            Ext.getCmp('extctab').setHeight(this.height - 127);
        }
    },
 
    initComponent: function() {
        
        this.items = [{
            xtype: 'extcustomerstab'
        }];
                      
        this.callParent(arguments);
    }
});