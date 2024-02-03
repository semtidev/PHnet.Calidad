Ext.define('PHNet.view.satisfaction.IntcustomersWindow', {
    extend: 'Ext.window.Window',
    id: 'intcustomerswindow',
    alias : 'widget.intcustomerswindow',
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
    title: 'Satisfacci&oacute;n de Servicios a Clientes Internos',
    frame: true,
    listeners: {
        'destroy': function(window, opt) {
            localStorage.removeItem('current_window');
            localStorage.removeItem('current_window_id');
            localStorage.removeItem('polltype');
            localStorage.removeItem('pollservice');
            $('#dropdown-quality').removeClass('focus');
            $('#lnk-home').addClass('active');
        },
        'maximize': function(window, opt) {
            Ext.getCmp('intcfeedtab').setHeight(this.height - 127);
            Ext.getCmp('intchostab').setHeight(this.height - 127);
            Ext.getCmp('intcequiptab').setHeight(this.height - 127);
        },
        'restore': function(window, opt) {
            Ext.getCmp('intcfeedtab').setHeight(this.height - 127);
            Ext.getCmp('intchostab').setHeight(this.height - 127);
            Ext.getCmp('intcequiptab').setHeight(this.height - 127);
        }
    },

    initComponent: function() {
        this.items = [{
                xtype: 'intcustomerstab'
            }];                        
        this.callParent(arguments);
    }
});