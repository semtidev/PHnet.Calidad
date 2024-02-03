Ext.define('PHNet.view.app.MetrotypeGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'metrotypegrid',
    id: 'metrotypegrid',
    requires: [
        'Ext.grid.*',
        'Ext.grid.plugin.CellEditing'
    ],
    store: 'Metrotype',
    listeners: {
        'render': function(grid, opt) {
            var windowHeight = Ext.getCmp('configwindow').getHeight();
            grid.setHeight(windowHeight - 120);
        }
    },
    viewConfig: {
        columnLines: true,
        stripeRows: true
    },
    autoShow: true,
    frame: false,
    layout: 'fit',
    initComponent: function() {
        var me = this,
            cellEditingPlugin = Ext.create('Ext.grid.plugin.CellEditing', { 
                pluginId:'metrotypeGridEditing', 
                clicksToEdit: 2
            });

        me.plugins = [cellEditingPlugin];
        me.columns = {
            defaults: {
                draggable: false,
                resizable: false,
                hideable: false,
                sortable: false
            },
            items: [
                {
                    text: 'Especialidad',
                    dataIndex: 'name',
                    align: 'left',
                    flex: 1
                }, {
                    text: 'C&oacute;digo',
                    dataIndex: 'code',
                    align: 'left',
                    flex: 1,
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    }
                }
            ]
        };

        me.callParent(arguments);

        // Load Store
        var proxy = me.getStore().getProxy();
        Ext.apply(proxy.api, {
            read: '/phnet.calidad/public/api/metrotypes'
        });
        me.getStore().load();

        // Add Events
        me.addEvents(

            /**
             * @event edit
             * Fires when a record is edited using the CellEditing plugin or the statuscolumn
             * @param {SimpleTasks.model.Task} task     The task record that was edited
             */
            'recordedit'
        );

        cellEditingPlugin.on('edit', me.handleCellEdit, this);
    },

    /**
     * Handles the CellEditing plugin's "edit" event
     * @private
     * @param {Ext.grid.plugin.CellEditing} editor
     * @param {Object} e an edit event object
     */
    handleCellEdit: function(editor, e) {
        this.fireEvent('recordedit', e);
    }

});