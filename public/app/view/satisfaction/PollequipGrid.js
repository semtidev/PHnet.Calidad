Ext.define('PHNet.view.satisfaction.PollequipGrid', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.pollequipgrid',
    id: 'pollequipgrid',
    requires: [
        'Ext.grid.*',
        'Ext.Form.*',
        'Ext.grid.plugin.CellEditing'
    ],
    store: 'Pollequip',
    listeners: {
        'render': function(grid, opt) {
            var windowHeight = Ext.getCmp('intcustomerswindow').getHeight();
            grid.setHeight(windowHeight - 127);
        },
        'afterrender': function(grid, opt) {
            if (!localStorage.getItem('userrol')) {
                Ext.getCmp('poll_equip_columndel').hide();
            }
        },
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
                pluginId: 'intcEquipGridEditing',
                clicksToEdit: 2,
                listeners: {
                    beforeedit: function(editor, e, eOpts) {
                        if (e.record.get('id') == 0) {
                            return false;
                        }
                    }
                }
            });

        me.plugins = [cellEditingPlugin];
        me.columns = {
            defaults: {
                draggable: false,
                resizable: false,
                hideable: false,
                sortable: false
            },
            items: [{
                    text: ' ',
                    id: 'poll_equip_columndel',
                    width: 40,
                    align: 'center',
                    menuDisabled: true,
                    sortable: false,
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (record !== null) {
                            var id = record.get('id');
                            if (id > 0) {
                                metaData['tdAttr'] = 'data-qtip="Eliminar Encuesta"';
                                metaData.tdCls = 'row-icon';
                                return '<a><i class="fas fa-minus-circle icon-red"></i></a>';
                            } else if (id == 0) {
                                metaData.tdCls = 'footer_row';
                                return ' ';
                            } else {
                                return ' ';
                            }
                        }
                    }
                }, {
                    text: 'No. Encuesta',
                    dataIndex: 'number',
                    width: 100,
                    align: 'center',
                    menuDisabled: true,
                    sortable: false,
                    /*editor: {
                        xtype: 'numberfield',
                        value: 5,
                        minValue: 1,
                        selectOnFocus: true
                    },*/
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val === null) {
                            metaData.tdCls = 'footer_row';
                            return 'Promedio';
                        }
                        return val;
                    }
                }, {
                    header: "Evaluaci\xF3n por Pregunta",
                    align: 'center',
                    menuDisabled: true,
                    columns: [{
                            header: '1',
                            menuDisabled: true,
                            dataIndex: 'q1',
                            align: 'center',
                            width: 100,
                            editor: {
                                xtype: 'numberfield',
                                value: 5,
                                minValue: 1,
                                maxValue: 5,
                                selectOnFocus: true
                            },
                            renderer: function(val, metaData, record, colIndex, store) {
                                if (record.get('id') == 0) {
                                    metaData.tdCls = 'footer_row';
                                    return val;
                                } else {
                                    return val;
                                }
                            }
                        },
                        {
                            header: '2',
                            menuDisabled: true,
                            dataIndex: 'q2',
                            align: 'center',
                            width: 100,
                            editor: {
                                xtype: 'numberfield',
                                value: 5,
                                minValue: 1,
                                maxValue: 5,
                                selectOnFocus: true
                            },
                            renderer: function(val, metaData, record, colIndex, store) {
                                if (record.get('id') == 0) {
                                    metaData.tdCls = 'footer_row';
                                    return val;
                                } else {
                                    return val;
                                }
                            }
                        },
                        {
                            header: '3',
                            menuDisabled: true,
                            dataIndex: 'q3',
                            align: 'center',
                            width: 100,
                            editor: {
                                xtype: 'numberfield',
                                value: 5,
                                minValue: 1,
                                maxValue: 5,
                                selectOnFocus: true
                            },
                            renderer: function(val, metaData, record, colIndex, store) {
                                if (record.get('id') == 0) {
                                    metaData.tdCls = 'footer_row';
                                    return val;
                                } else {
                                    return val;
                                }
                            }
                        },
                        {
                            header: '4',
                            menuDisabled: true,
                            dataIndex: 'q4',
                            align: 'center',
                            width: 100,
                            emptyCellText: '',
                            editor: {
                                xtype: 'numberfield',
                                value: 5,
                                minValue: 1,
                                maxValue: 5,
                                selectOnFocus: true
                            },
                            renderer: function(val, metaData, record, colIndex, store) {
                                if (record.get('id') == 0) {
                                    metaData.tdCls = 'footer_row';
                                    return val;
                                } else {
                                    return val;
                                }
                            }
                        },
                        {
                            header: '5',
                            menuDisabled: true,
                            dataIndex: 'q5',
                            align: 'center',
                            width: 100,
                            emptyCellText: '',
                            editor: {
                                xtype: 'numberfield',
                                value: 5,
                                minValue: 1,
                                maxValue: 5,
                                selectOnFocus: true
                            },
                            renderer: function(val, metaData, record, colIndex, store) {
                                if (record.get('id') == 0) {
                                    metaData.tdCls = 'footer_row';
                                    return val;
                                } else {
                                    return val;
                                }
                            }
                        }
                    ]
                },
                {
                    header: "Total",
                    flex: 2,
                    dataIndex: 'sum',
                    align: 'center',
                    menuDisabled: true,
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (record.get('id') == 0) {
                            metaData.tdCls = 'footer_row';
                            return val;
                        } else {
                            return val;
                        }
                    }
                },
                {
                    header: "Promedio",
                    flex: 2,
                    dataIndex: 'prom',
                    align: 'center',
                    menuDisabled: true,
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (record.get('id') == 0) {
                            if (parseFloat(val) >= 4.5) {
                                metaData['tdAttr'] = 'data-qtip="Muy Bueno"';
                                metaData.tdCls = 'row-poll-e';
                                return val;
                            } else if (4 <= parseFloat(val) && parseFloat(val) < 4.5) {
                                metaData['tdAttr'] = 'data-qtip="Bueno"';
                                metaData.tdCls = 'row-poll-b';
                                return val;
                            } else if (3 <= parseFloat(val) && parseFloat(val) < 4) {
                                metaData['tdAttr'] = 'data-qtip="Regular"';
                                metaData.tdCls = 'row-poll-r';
                                return val;
                            } else if (parseFloat(val) < 3) {
                                metaData['tdAttr'] = 'data-qtip="Mal"';
                                metaData.tdCls = 'row-poll-m';
                                return val;
                            }
                        } else {
                            return val;
                        }
                    }
                }
            ]
        };

        this.callParent(arguments);

        // Add Events
        me.addEvents('recordedit');
        me.on('edit', function(edt, e) {
            var record = {
                id: e.record.data.id,
                field: e.column.dataIndex,
                oldvalue: e.originalValue,
                newvalue: e.value,
                rowIdx: e.rowIdx,
                colIdx: e.colIdx,
                data: e.record.data,
                number: e.store.getAt(e.rowIdx).get('number')
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