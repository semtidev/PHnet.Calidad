Ext.define('PHNet.view.metrology.PlanningubphGrid', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.planningubphgrid',
    id: 'planningubphgrid',
    requires: [
        'Ext.grid.*',
        'Ext.Form.*',
        'Ext.grid.plugin.CellEditing'
    ],
    store: 'Metroplanubph',
    listeners: {
        'render': function(grid, opt) {
            var windowHeight = Ext.getCmp('planningwindow').getHeight();
            grid.setHeight(windowHeight - 127);
        }
    },
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
                    xtype: 'rownumberer',
                    text: 'No.',
                    width: 45,
                    align: 'center'
                },
                { 
                    header: "Foto", 
                    width: 60,
                    dataIndex: 'photo', 
                    align: 'center',
                    menuDisabled: true,
                    emptyCellText: '',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (record !== null) {
                            var photo = record.get('photo');
                            if (photo != null && photo != '') {
                                if(record.get('id_state') == 2){
                                    metaData.tdCls = 'row-noavailable';
                                }
                                else if(record.get('id_state') == 3){
                                    metaData.tdCls = 'row-send';
                                }
                                else {
                                    metaData['tdAttr'] = 'data-qtip="' + val + ': Disponible/Apto"';
                                }
                                metaData['tdAttr'] = 'data-qtip="<div class=photo><img src=/phnet.calidad/public/dist/img/metrology/' + val + '.jpg></div>"';
                                
                                return '<img src="/phnet.calidad/public/dist/img/metrology/' + val + '.jpg" width="24" height="20">';
                            }
                            else {
                                if(record.get('id_state') == 2){
                                    metaData.tdCls = 'row-noavailable';
                                }
                                else if(record.get('id_state') == 3){
                                    metaData.tdCls = 'row-send';
                                }
                                else {
                                    metaData['tdAttr'] = 'data-qtip="' + val + ': Disponible/Apto"';
                                }
                                metaData['tdAttr'] = 'data-qtip="<div class=photo><img src=/phnet.calidad/public/dist/img/metrology/nophoto.png></div>"';
                                
                                return '<img src="/phnet.calidad/public/dist/img/metrology/nophoto.png" width="24" height="20">';
                            }
                        }
                    }
                },
                { 
                    header: "Proyeto", 
                    width: 80,
                    align: 'center',
                    dataIndex: 'project'
                },
                { 
                    header: "Denominaci\xF3n",
                    minWidth: 250,
                    flex: 3,
                    dataIndex: 'name',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if(record.get('id_state') == 2){
                            metaData['tdAttr'] = 'data-qtip="' + val + ': No Disponible/No Apto"';
                            metaData.tdCls = 'row-noavailable';
                            return '<span style="color:#000;">' + val + '</span> ' + record.get('history');
                        }
                        else if(record.get('id_state') == 3){
                            metaData['tdAttr'] = 'data-qtip="' + val + ': Entregado para calibrar"';
                            metaData.tdCls = 'row-send';
                            return '<span style="color:#000;">' + val + '</span> ' + record.get('history');
                        }
                        else {
                            metaData['tdAttr'] = 'data-qtip="' + val + ': Disponible/Apto"';
                            return '<span style="color:#000;">' + val + '</span> ' + record.get('history');
                        }                    
                    }
                },
                { 
                    header: "Serie", 
                    width: 130,
                    align: 'center',
                    dataIndex: 'serie',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        return value;
                    }
                },
                { 
                    header: "Ene", 
                    width: 48,
                    align: 'center', 
                    dataIndex: 'ene',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val == 1) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan: '+record.get('plan_date')+', Fecha Real: '+record.get('real_date')+'"';
                            metaData.tdCls = 'cell-real';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 2) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan"';
                            metaData.tdCls = 'cell-planning';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000;">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 3) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Real de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-real';
                            var realdate = record.get('real_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(realdate[2]) + '</span>';
                        }
                        else if (val == 4) {
                            metaData['tdAttr'] = 'data-qtip="Pendiente de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-backlog';
                            return '';
                        }
                        else {
                            return '';
                        }
                    }
                },
                { 
                    header: "Feb", 
                    width: 48,
                    align: 'center',
                    dataIndex: 'feb',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val == 1) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan: '+record.get('plan_date')+', Fecha Real: '+record.get('real_date')+'"';
                            metaData.tdCls = 'cell-real';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 2) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan"';
                            metaData.tdCls = 'cell-planning';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000;">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 3) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Real de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-real';
                            var realdate = record.get('real_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(realdate[2]) + '</span>';
                        }
                        else if (val == 4) {
                            metaData['tdAttr'] = 'data-qtip="Pendiente de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-backlog';
                            return '';
                        }
                        else {
                            return '';
                        }
                    }
                },
                { 
                    header: "Mar", 
                    width: 48,
                    align: 'center',
                    dataIndex: 'mar',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val == 1) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan: '+record.get('plan_date')+', Fecha Real: '+record.get('real_date')+'"';
                            metaData.tdCls = 'cell-real';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 2) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan"';
                            metaData.tdCls = 'cell-planning';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000;">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 3) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Real de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-real';
                            var realdate = record.get('real_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(realdate[2]) + '</span>';
                        }
                        else if (val == 4) {
                            metaData['tdAttr'] = 'data-qtip="Pendiente de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-backlog';
                            return '';
                        }
                        else {
                            return '';
                        }
                    }
                },
                { 
                    header: "Abr", 
                    width: 48,
                    align: 'center',
                    dataIndex: 'abr',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val == 1) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan: '+record.get('plan_date')+', Fecha Real: '+record.get('real_date')+'"';
                            metaData.tdCls = 'cell-real';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 2) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan"';
                            metaData.tdCls = 'cell-planning';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000;">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 3) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Real de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-real';
                            var realdate = record.get('real_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(realdate[2]) + '</span>';
                        }
                        else if (val == 4) {
                            metaData['tdAttr'] = 'data-qtip="Pendiente de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-backlog';
                            return '';
                        }
                        else {
                            return '';
                        }
                    }
                },
                { 
                    header: "May", 
                    width: 48,
                    align: 'center', 
                    dataIndex: 'may',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val == 1) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan: '+record.get('plan_date')+', Fecha Real: '+record.get('real_date')+'"';
                            metaData.tdCls = 'cell-real';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 2) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan"';
                            metaData.tdCls = 'cell-planning';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000;">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 3) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Real de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-real';
                            var realdate = record.get('real_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(realdate[2]) + '</span>';
                        }
                        else if (val == 4) {
                            metaData['tdAttr'] = 'data-qtip="Pendiente de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-backlog';
                            return '';
                        }
                        else {
                            return '';
                        }
                    }
                },
                { 
                    header: "Jun", 
                    width: 48,
                    align: 'center',
                    dataIndex: 'jun',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val == 1) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan: '+record.get('plan_date')+', Fecha Real: '+record.get('real_date')+'"';
                            metaData.tdCls = 'cell-real';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 2) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan"';
                            metaData.tdCls = 'cell-planning';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000;">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 3) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Real de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-real';
                            var realdate = record.get('real_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(realdate[2]) + '</span>';
                        }
                        else if (val == 4) {
                            metaData['tdAttr'] = 'data-qtip="Pendiente de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-backlog';
                            return '';
                        }
                        else {
                            return '';
                        }
                    }
                },
                { 
                    header: "Jul", 
                    width: 48,
                    align: 'center',
                    dataIndex: 'jul',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val == 1) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan: '+record.get('plan_date')+', Fecha Real: '+record.get('real_date')+'"';
                            metaData.tdCls = 'cell-real';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 2) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan"';
                            metaData.tdCls = 'cell-planning';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000;">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 3) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Real de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-real';
                            var realdate = record.get('real_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(realdate[2]) + '</span>';
                        }
                        else if (val == 4) {
                            metaData['tdAttr'] = 'data-qtip="Pendiente de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-backlog';
                            return '';
                        }
                        else {
                            return '';
                        }
                    }
                },
                { 
                    header: "Ago", 
                    width: 48,
                    align: 'center',
                    dataIndex: 'ago',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val == 1) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan: '+record.get('plan_date')+', Fecha Real: '+record.get('real_date')+'"';
                            metaData.tdCls = 'cell-real';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 2) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan"';
                            metaData.tdCls = 'cell-planning';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000;">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 3) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Real de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-real';
                            var realdate = record.get('real_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(realdate[2]) + '</span>';
                        }
                        else if (val == 4) {
                            metaData['tdAttr'] = 'data-qtip="Pendiente de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-backlog';
                            return '';
                        }
                        else {
                            return '';
                        }
                    }
                },
                { 
                    header: "Sep", 
                    width: 48,
                    align: 'center',
                    dataIndex: 'sep',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val == 1) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan: '+record.get('plan_date')+', Fecha Real: '+record.get('real_date')+'"';
                            metaData.tdCls = 'cell-real';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 2) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan"';
                            metaData.tdCls = 'cell-planning';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000;">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 3) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Real de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-real';
                            var realdate = record.get('real_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(realdate[2]) + '</span>';
                        }
                        else if (val == 4) {
                            metaData['tdAttr'] = 'data-qtip="Pendiente de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-backlog';
                            return '';
                        }
                        else {
                            return '';
                        }
                    }
                },
                { 
                    header: "Oct", 
                    width: 48,
                    align: 'center',
                    dataIndex: 'oct',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val == 1) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan: '+record.get('plan_date')+', Fecha Real: '+record.get('real_date')+'"';
                            metaData.tdCls = 'cell-real';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 2) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan"';
                            metaData.tdCls = 'cell-planning';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000;">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 3) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Real de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-real';
                            var realdate = record.get('real_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(realdate[2]) + '</span>';
                        }
                        else if (val == 4) {
                            metaData['tdAttr'] = 'data-qtip="Pendiente de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-backlog';
                            return '';
                        }
                        else {
                            return '';
                        }
                    }
                },
                { 
                    header: "Nov", 
                    width: 48,
                    align: 'center',
                    dataIndex: 'nov',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val == 1) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan: '+record.get('plan_date')+', Fecha Real: '+record.get('real_date')+'"';
                            metaData.tdCls = 'cell-real';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 2) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan"';
                            metaData.tdCls = 'cell-planning';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000;">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 3) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Real de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-real';
                            var realdate = record.get('real_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(realdate[2]) + '</span>';
                        }
                        else if (val == 4) {
                            metaData['tdAttr'] = 'data-qtip="Pendiente de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-backlog';
                            return '';
                        }
                        else {
                            return '';
                        }
                    }
                },
                { 
                    header: "Dic", 
                    width: 48,
                    align: 'center',
                    dataIndex: 'dic',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val == 1) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan: '+record.get('plan_date')+', Fecha Real: '+record.get('real_date')+'"';
                            metaData.tdCls = 'cell-real';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 2) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Plan"';
                            metaData.tdCls = 'cell-planning';
                            var plandate = record.get('plan_date').split('-');
                            return '<span style="color:#000;">' + parseInt(plandate[2]) + '</span>';
                        }
                        else if (val == 3) {
                            metaData['tdAttr'] = 'data-qtip="Fecha Real de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-real';
                            var realdate = record.get('real_date').split('-');
                            return '<span style="color:#000; font-weight:bold; text-shadow: 0 1px 0 rgb(226, 241, 216);">' + parseInt(realdate[2]) + '</span>';
                        }
                        else if (val == 4) {
                            metaData['tdAttr'] = 'data-qtip="Pendiente de Calibraci&oacute;n"';
                            metaData.tdCls = 'cell-backlog';
                            return '';
                        }
                        else {
                            return '';
                        }
                    }
                }
            ]
        };

        this.callParent(arguments);
    }

});