Ext.define('PHNet.view.metrology.HistoryWindow', {
    extend: 'Ext.window.Window',
    id: 'historywindow',
    alias : 'widget.historywindow',
    closable: true,
    resizable: false,
    width: 750,
    height: 300,
    layout: 'border',
    modal: true,
    renderTo: Ext.getBody(),
    initComponent: function() {
        this.items = [
            {
                xtype: 'historygrid',
                layout: 'fit',
                region: 'center'
            }
        ];
        this.callParent(arguments);
    }
});