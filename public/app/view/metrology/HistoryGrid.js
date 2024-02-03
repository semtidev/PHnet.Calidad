Ext.define('PHNet.view.metrology.HistoryGrid', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.historygrid',
    id: 'historygrid',
    store: 'Metrohistory',
    autoScroll: true,
    viewConfig: {
        columnLines: true,
        stripeRows: true
    },
    initComponent: function() {

        var me = this;
        me.columns = {
            defaults: {
                draggable: false,
                resizable: false,
                hideable: false,
                sortable: false
            },
            items: [
                {
                    header: 'Acci&oacute;n',
                    id: 'metrostory_action',
                    dataIndex: 'action',
                    align: 'center',
                    width: 110,
                    menuDisabled: true,
                    sortable: false,
                    renderer: function(val, metaData, record, colIndex, store){
                        metaData.tdCls = 'metrostory_action_td';
                        return val;                          
                    }
                },{
                    header: 'Fecha',
                    dataIndex: 'action_date',
                    width: 100,
                    menuDisabled: true,
                    sortable: false
                },{
                    header: 'Proyecto',
                    dataIndex: 'project',
                    flex: 1,
                    menuDisabled: true,
                    sortable: false
                },{
                    header: 'Responsable',
                    dataIndex: 'owner',
                    flex: 1,
                    menuDisabled: true,
                    sortable: false
                }
            ]
        };

        this.callParent(arguments);
    },

});

