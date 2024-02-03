Ext.define('PHNet.view.metrology.PlanningWindow', {
    extend: 'Ext.window.Window',
    id: 'planningwindow',
    alias : 'widget.planningwindow',
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
    title: 'Plan de Calibraci&oacute;n de Instrumentos de Metrolog&iacute;a',
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
            Ext.getCmp('metroplanprojectab').setHeight(this.height - 127);
            Ext.getCmp('metroplanubphtab').setHeight(this.height - 127);
        },
        'restore': function(window, opt) {
            Ext.getCmp('metroplanprojectab').setHeight(this.height - 127);
            Ext.getCmp('metroplanubphtab').setHeight(this.height - 127);
        }
    },
 
    initComponent: function() {
        this.items = [{
                xtype: 'planningtab'
            }];                        
        this.callParent(arguments);
    }
});