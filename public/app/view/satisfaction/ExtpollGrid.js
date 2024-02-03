Ext.define('PHNet.view.satisfaction.ExtpollGrid', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.extpollgrid',
    id: 'extpollgrid',
    requires: [
        'Ext.grid.*',
        'Ext.data.*',
        'Ext.tip.QuickTipManager'
    ],
    store: 'Extpolls',
    listeners: {
        'render': function(grid, opt) {
            var windowHeight = Ext.getCmp('extcustomerswindow').getHeight();
            grid.setHeight(windowHeight - 127);
        },
        'afterrender': function(grid, opt) {
            if (!localStorage.getItem('userrol')) {
                Ext.getCmp('extpoll_columndel').hide();
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
    features: [{
        id: 'department',
        ftype: 'grouping',
        groupHeaderTpl: '{name}',
        hideGroupedHeader: true,
        enableGroupingMenu: false
    }],
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
                    text: ' ',
                    id: 'extpoll_columndel',
                    width: 40,
					align: 'center',
                    menuDisabled: true,
                    sortable: false,
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (record !== null) {
                            var number = record.get('number');
                            if (number == null) {
                                metaData.tdCls = 'group_subgroup';
                                return null;
                            }
                            else if (number == -1) {
                                return null;
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="Eliminar Actividad"';
                                metaData.tdCls = 'row-icon';
                                return '<a><i class="fas fa-minus-circle icon-red"></i></a>';
                            }
                        }
                    }
                }, {
                    header: 'No.',
                    width: 45,
                    dataIndex: 'number',
                    menuDisabled: true,
                    sortable: false,
                    align: 'center',
                    renderer: function(val, metaData, record, colIndex, store){
                        if (record.get('number') == null) {
                            metaData.tdCls = 'group_subgroup';
                            return val;
                        }
                        else if (record.get('number') == -1) {
                            return null;
                        }
                        else {
                            return val;
                        }
                    }
                },
                {
                    header: "Actividad",
                    flex: 1.2, 
                    dataIndex: 'description',
                    menuDisabled: true,
                    renderer: function(val, metaData, record, colIndex, store){
                        if (record.get('number') == null) {
                            metaData.tdCls = 'group_subgroup';
                            return val;
                        }
                        else if (record.get('number') == -1) {
                            return '<strong style="color: rgb(36, 37, 37)">' + val + '</strong>';
                        }
                        else {
                            metaData['tdAttr'] = 'data-qtip="' + val + '"';
                            return val;
                        }
                    }
                },
                {
                    header: 'Nivel',
                    width: 120,
                    align: 'center',
                    dataIndex: 'act_level',
                    menuDisabled: true,
                    renderer: function(val, metaData, record, colIndex, store){
                        if (record.get('number') == null) {
                            metaData.tdCls = 'group_subgroup';
                            return val;
                        }
                        else if (record.get('number') == -1) {
                            return null;
                        }
                        else {
                            metaData['tdAttr'] = 'data-qtip="Nivel: ' + val + '"';
                            return val;
                        }
                    }
                },
                {
                    header: "Evaluaci&oacute;n por No. de Encuesta Realizada",
                    align: 'center',
                    menuDisabled: true,
                    columns: [
                        {
                            header: '1',
                            menuDisabled: true,
                            dataIndex: 'p1',
                            align: 'center',
                            width: 70,
                            renderer: function(val, metaData, record, colIndex, store) {
                                if(val > 0){
                                    if (record.get('number') == null) {
                                        metaData.tdCls = 'group_subgroup';
                                    }
                                    else if (record.get('number') == -1) {
                                        return '<strong style="color: rgb(36, 37, 37)">' + val + '</strong>';
                                    }
                                    else {
                                        return val;
                                    } 
                                }
                                else {
                                    if (record.get('number') == null) {
                                        metaData.tdCls = 'group_subgroup';
                                    }
                                    return null;
                                }                        
                            }       
                        },
                        {
                            header: '2',
                            menuDisabled: true,
                            dataIndex: 'p2',
                            align: 'center',
                            width: 70,
                            renderer: function(val, metaData, record, colIndex, store) {
                                if(val > 0){
                                    if (record.get('number') == null) {
                                        metaData.tdCls = 'group_subgroup';
                                    }
                                    else if (record.get('number') == -1) {
                                        return '<strong style="color: rgb(36, 37, 37)">' + val + '</strong>';
                                    }
                                    else {
                                        return val;
                                    } 
                                }
                                else {
                                    if (record.get('number') == null) {
                                        metaData.tdCls = 'group_subgroup';
                                    }
                                    return null;
                                }                       
                            }
                        },
                        {
                            header: '3',
                            menuDisabled: true,
                            dataIndex: 'p3',
                            align: 'center',
                            width: 70,
                            renderer: function(val, metaData, record, colIndex, store) {
                                if(val > 0){
                                    if (record.get('number') == null) {
                                        metaData.tdCls = 'group_subgroup';
                                    }
                                    else if (record.get('number') == -1) {
                                        return '<strong style="color: rgb(36, 37, 37)">' + val + '</strong>';
                                    }
                                    else {
                                        return val;
                                    } 
                                }
                                else {
                                    if (record.get('number') == null) {
                                        metaData.tdCls = 'group_subgroup';
                                    }
                                    return null;
                                }                       
                            }
                        },
                        {
                            header: '4',
                            menuDisabled: true,
                            dataIndex: 'p4',
                            align: 'center',
                            width: 70,
                            renderer: function(val, metaData, record, colIndex, store) {
                                if(val > 0){
                                    if (record.get('number') == null) {
                                        metaData.tdCls = 'group_subgroup';
                                    }
                                    else if (record.get('number') == -1) {
                                        return '<strong style="color: rgb(36, 37, 37)">' + val + '</strong>';
                                    }
                                    else {
                                        return val;
                                    } 
                                }
                                else {
                                    if (record.get('number') == null) {
                                        metaData.tdCls = 'group_subgroup';
                                    }
                                    return null;
                                }                       
                            }
                        },
                        {
                            header: '5',
                            menuDisabled: true,
                            dataIndex: 'p5',
                            align: 'center',
                            width: 70,
                            renderer: function(val, metaData, record, colIndex, store) {
                                if(val > 0){
                                    if (record.get('number') == null) {
                                        metaData.tdCls = 'group_subgroup';
                                    }
                                    else if (record.get('number') == -1) {
                                        return '<strong style="color: rgb(36, 37, 37)">' + val + '</strong>';
                                    }
                                    else {
                                        return val;
                                    } 
                                }
                                else {
                                    if (record.get('number') == null) {
                                        metaData.tdCls = 'group_subgroup';
                                    }
                                    return null;
                                }                          
                            }
                        }
                    ]
                },
                { 
                    header: "Total", 
                    width: 70,
                    dataIndex: 'sum',
                    align: 'center',
                    menuDisabled: true,
                    renderer: function(val, metaData, record, colIndex, store){
                        if(val > 0){
                            if (record.get('number') == null) {
                                metaData.tdCls = 'group_subgroup';
                            }
                            else if (record.get('number') == -1) {
                                return '<strong style="color: rgb(36, 37, 37)">' + val + '</strong>';
                            }
                            else {
                                return val;
                            } 
                        }
                        else {
                            if (record.get('number') == null) {
                                metaData.tdCls = 'group_subgroup';
                            }
                            return null;
                        } 
                    }
                },
                { 
                    header: "Promedio", 
                    width: 90,
                    dataIndex: 'prom',
                    align: 'center',
                    menuDisabled: true,
                    renderer: function(val, metaData, record, colIndex, store){
                        if(val > 0){
                            if (record.get('number') == null) {
                                metaData.tdCls = 'group_subgroup';
                            }
                            else if (record.get('number') == -1) {
                                if (parseFloat(val) >= 4.5) {
                                    metaData['tdAttr'] = 'data-qtip="Muy Bueno"';
                                    metaData.tdCls = 'row-poll-e';
                                    return val; 
                                }
                                else if (4 <= parseFloat(val) && parseFloat(val) < 4.5) {
                                    metaData['tdAttr'] = 'data-qtip="Bueno"';
                                    metaData.tdCls = 'row-poll-b';
                                    return val;
                                }
                                else if (3 <= parseFloat(val) && parseFloat(val) < 4) {
                                    metaData['tdAttr'] = 'data-qtip="Regular"';
                                    metaData.tdCls = 'row-poll-r';
                                    return val;
                                }
                                else if (parseFloat(val) < 3) {
                                    metaData['tdAttr'] = 'data-qtip="Mal"';
                                    metaData.tdCls = 'row-poll-m';
                                    return val;
                                } 
                            }
                            else {
                                return val;
                            } 
                        }
                        else {
                            if (record.get('number') == null) {
                                metaData.tdCls = 'group_subgroup';
                            }
                            return null;
                        } 
                    }
                }
            ]
        }

        this.callParent(arguments);
    }
});