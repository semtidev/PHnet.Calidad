Ext.define('PHNet.view.metrology.EquipmentWindow', {
    extend: 'Ext.window.Window',
    id: 'equipmentwindow',
    alias : 'widget.equipmentwindow',
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
    title: 'Instrumentos de Metrolog&iacute;a',
    frame: true,
    listeners: {
        'destroy': function(window, opt) {
            localStorage.removeItem('current_window');
            localStorage.removeItem('current_window_id');
            localStorage.removeItem('equipment_activetab');
            $('#dropdown-quality').removeClass('focus');
            $('#lnk-home').addClass('active');
        },
        'maximize': function(window, opt) {
            Ext.getCmp('weightab').setHeight(this.height - 127);
            Ext.getCmp('pressuretab').setHeight(this.height - 127);
            Ext.getCmp('electab').setHeight(this.height - 127);
            Ext.getCmp('topgeotab').setHeight(this.height - 127);
            Ext.getCmp('lengthtab').setHeight(this.height - 127);
        },
        'restore': function(window, opt) {
            Ext.getCmp('weightab').setHeight(this.height - 127);
            Ext.getCmp('pressuretab').setHeight(this.height - 127);
            Ext.getCmp('electab').setHeight(this.height - 127);
            Ext.getCmp('topgeotab').setHeight(this.height - 127);
            Ext.getCmp('lengthtab').setHeight(this.height - 127);
        }
    },
 
    initComponent: function() {
        this.items = [{
                xtype: 'equipmentab'
            }];                        
        this.callParent(arguments);
    }
});