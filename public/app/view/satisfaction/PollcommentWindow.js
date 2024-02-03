Ext.define('PHNet.view.satisfaction.PollcommentWindow', {
    extend: 'Ext.window.Window',
    id: 'pollcommentwindow',
    alias : 'widget.pollcommentwindow',
    closable: true,
    resizable: false,
    width: 500,
    height: 300,
    layout: 'border',
    modal: true,
    tools: [{
        type: 'refresh',
        tooltip: 'Actualizar',
        callback: function() {
            var grid = Ext.getCmp('pollcommentgrid');
            grid.getStore().load({
                callback: function(records, operation, success) {
                    grid.getSelectionModel().deselect(records, true);
                }
            });
        }
    }],
    renderTo: Ext.getBody(),
    animateTarget: 'poll-issues-btn',
    initComponent: function() {
        this.items = [
            {
                xtype: 'pollcommentgrid',
                layout: 'fit',
                region: 'center'
            }
        ];
        this.callParent(arguments);
    }
});