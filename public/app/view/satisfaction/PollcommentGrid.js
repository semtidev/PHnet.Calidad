Ext.define('PHNet.view.satisfaction.PollcommentGrid', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.pollcommentgrid',
    id: 'pollcommentgrid',
    requires: [
        'Ext.grid.*',
        'Ext.Form.*',
        'Ext.grid.plugin.CellEditing'
    ],
    store: 'Pollcomment',
    listeners: {
        'cellclick': function(grid, td, cellIndex, record, tr, rowIndex, e, eOpts) {
            var id = record.data.id;
            if (cellIndex == 0) {
                this.fireEvent('deleteclick', id);
            }
        }
    },
    autoScroll: true,
    viewConfig: {
        columnLines: true,
        stripeRows: true
    },
    initComponent: function() {

        var me = this,
            cellEditingPlugin = Ext.create('Ext.grid.plugin.CellEditing', { 
                pluginId:'pollissuesGridEditing',
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
                    width: 40,
					align: 'center',
                    menuDisabled: true,
                    sortable: false,
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (record !== null) {
                            var id = record.get('id');
                            if (id > 0) {
                                metaData['tdAttr'] = 'data-qtip="Eliminar Observaci&oacute;n"';
                                metaData.tdCls = 'row-icon';
                                return '<a><i class="fas fa-minus-circle icon-red"></i></a>';
                            }
                            else {
                                return ' ';
                            }
                        }
                    }
                }, {
                    header: 'Observaciones',
                    dataIndex: 'comment',
                    flex: 1,
                    menuDisabled: true,
                    sortable: false,
                    emptyCellText: '',
                    editor: {
                        xtype: 'textfield',
                        maxLength: 191,
                        selectOnFocus: true
                    }
                }
            ]
        };

        this.callParent(arguments);

        // Add Events
        me.addEvents('recordedit');
        me.on('edit', function(edt, e){
            var record = {
                    id: e.record.data.id,
                    field: e.column.dataIndex,
                    oldvalue: e.originalValue,
                    newvalue: e.value,
                    rowIdx: e.rowIdx,
                    colIdx: e.colIdx,
                    data: e.record.data
                }
            this.fireEvent('recordedit', record);
        });
    },

    /**
     * Handles the CellEditing plugin's "edit" event
     * @private
     * @param {Ext.grid.plugin.CellEditing} editor
     * @param {Object} e an edit event object
     */
    handleCellEdit: function(editor, e) {
        console.log(e);
        this.fireEvent('recordedit', e);
    }
});

