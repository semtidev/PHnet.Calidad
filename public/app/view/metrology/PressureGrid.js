Ext.define('PHNet.view.metrology.PressureGrid', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.pressuregrid',
    id: 'pressuregrid',
    requires: [
        'Ext.grid.*',
        'Ext.Form.*',
        'Ext.grid.plugin.CellEditing'
    ],
    store: 'Metropressure',
    listeners: {
        'render': function(grid, opt) {
            var windowHeight = Ext.getCmp('equipmentwindow').getHeight();
            grid.setHeight(windowHeight - 127);
        },
        'afterrender': function(grid, opt) {
            if (!localStorage.getItem('userrol')) {
                Ext.getCmp('eq_pressure_columndel').hide();
            }
        },
        'cellclick': function(grid, td, cellIndex, record, tr, rowIndex, e, eOpts) {
            var id = record.data.id;
            if (cellIndex == 0) {
                this.fireEvent('deleteclick', id);
            }
            else if (cellIndex == 2) {
                if (localStorage.getItem('userrol')) {
                    var animtarget = 'photolnk-pressure-' + id;
                    this.fireEvent('photoclick', record, animtarget);
                }
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
                pluginId:'pressureGridEditing', 
                clicksToEdit: 2,
            });

        if (localStorage.getItem('userrol')) {
            me.plugins = [cellEditingPlugin];
        }
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
                    id: 'eq_pressure_columndel',
                    width: 40,
					align: 'center',
                    menuDisabled: true,
                    sortable: false,
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (record !== null) {
                            var id = record.get('id');
                            if (id > 0) {
                                if (parseInt(record.get('active')) == 0) {
                                    metaData.tdCls = 'row-inactive';
                                    metaData['tdAttr'] = 'data-qtip="Eliminar Instrumento"';
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
                                    metaData['tdAttr'] = 'data-qtip="Eliminar Instrumento"';
                                }
                                return '<a class="lnk-metrology-del" data-id="'+record.get('id')+'"><i class="fas fa-minus-circle icon-red"></i></a>';
                            }
                            else {
                                return ' ';
                            }
                        }
                    }
                }, { 
                    header: "No.",
                    dataIndex: 'number', 
                    width: 50, 
                    align: 'center', 
                    menuDisabled: true,
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            } 
                        }
                        return '<span style="color:#000;">' + val + '</span>';                  
                    }
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
                                if (parseInt(record.get('active')) == 0) {
                                    metaData.tdCls = 'row-inactive';
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
                                }
                                
                                metaData['tdAttr'] = 'data-qtip="<div class=photo><img src=/phnet.calidad/public/dist/img/metrology/' + val + '.jpg></div>"';
                                
                                if (!localStorage.getItem('userrol')) {
                                    return '<img src="/phnet.calidad/public/dist/img/metrology/' + val + '.jpg" width="24" height="20">';
                                }
                                else {
                                    return '<a id="photolnk-pressure-'+ record.get('id') +'" class="lnk-metrology-photo"><img src="/phnet.calidad/public/dist/img/metrology/' + val + '.jpg" width="24" height="20"></a>';
                                }                                
                            }
                            else {
                                if (parseInt(record.get('active')) == 0) {
                                    metaData.tdCls = 'row-inactive';
                                    metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
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
                                }
                                
                                metaData['tdAttr'] = 'data-qtip="<div class=photo><img src=/phnet.calidad/public/dist/img/metrology/nophoto.png></div>"';
                                
                                if (!localStorage.getItem('userrol')) {
                                    return '<img src="/phnet.calidad/public/dist/img/metrology/nophoto.png" width="24" height="20">';
                                }
                                else {
                                    return '<a id="photolnk-pressure-'+ record.get('id') +'" class="lnk-metrology-photo"><img src="/phnet.calidad/public/dist/img/metrology/nophoto.png" width="24" height="20"></a>';
                                }                                
                            }
                        }
                    }
                },
                {
                    text: 'Proyecto',
                    width: 80,
                    align: 'center',
                    hideable: true,
                    menuDisabled: true,
                    sortable: false,
                    dataIndex: 'workname',
                    editor: {
                        xtype: 'worksabbrcombo',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            } 
                        }
                        return '<span style="color:#000;">' + val + '</span>';
                    }
                },
                { 
                    header: "Denominaci\xF3n", 
                    width: 200, 
                    dataIndex: 'name',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="' + val + ': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="' + val + ': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="' + val + ': Disponible/Apto"';
                            }
                        }
                        return '<span style="color:#000;">' + val + '</span> ' + record.get('history');
                    }
                },
                { 
                    header: "Modelo", 
                    width: 180, 
                    dataIndex: 'model',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';     
                    }
                },
                { 
                    header: "Serie", 
                    width: 120,
                    align: 'center',
                    dataIndex: 'serie',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';   
                    }
                },
                { 
                    header: "Ctdad", 
                    width: 70, 
                    dataIndex: 'ctdad',
                    align: 'center',
                    editor: {
                        xtype: 'numberfield',
                        value: 1,
                        minValue: 1,
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            }
                        } 
                        return '<span style="color:#000;">' + value + '</span>';                
                    }
                },
                { 
                    header: "Demanda", 
                    width: 80, 
                    dataIndex: 'demand',
                    align: 'center',
                    editor: {
                        xtype: 'numberfield',
                        value: 1,
                        minValue: 1,
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';            
                    }
                },
                { 
                    header: "Precisi\xF3n", 
                    width: 100, 
                    dataIndex: 'precision',
                    align: 'center',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                if (value != ''){
                                    metaData['tdAttr'] = 'data-qtip="' + val + '"';
                                }
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                if (value != ''){
                                    metaData['tdAttr'] = 'data-qtip="' + val + '"';
                                }
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                if (value != ''){
                                    metaData['tdAttr'] = 'data-qtip="' + val + '"';
                                }
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';
                    }
                },
                { 
                    header: "L\xEDmite", 
                    width: 100, 
                    dataIndex: 'limit',
                    align: 'center',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                if (value != ''){
                                    metaData['tdAttr'] = 'data-qtip="' + val + '"';
                                }
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                if (value != ''){
                                    metaData['tdAttr'] = 'data-qtip="' + val + '"';
                                }
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                if (value != ''){
                                    metaData['tdAttr'] = 'data-qtip="' + val + '"';
                                }
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';                  
                    }
                },
                { 
                    header: "\xDAlt. Verif.",
                    //xtype: 'datecolumn', // the column type
                    //format: 'd/m/Y',
                    width: 110, 
                    dataIndex: 'last_check',
                    align: 'center',
                    editor: {
                        xtype: 'datefield',
                        maxValue: new Date(),
                        value: new Date(),
                        format: 'Y/m/d',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';
                    }
                }, 
                { 
                    header: "Plazo Verif.", 
                    width: 100, 
                    dataIndex: 'term_check', 
                    align: 'center',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';     
                    }
                }, 
                { 
                    header: "Fecha Plan",
                    //xtype: 'datecolumn', // the column type
                    //format: 'd/m/Y',
                    width: 110, 
                    dataIndex: 'plan_date', 
                    align: 'center',
                    editor: {
                        xtype: 'datefield',
                        value: new Date(),
                        format: 'd/m/Y',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';         
                    }
                },
                { 
                    header: "Fecha Real",
                    //xtype: 'datecolumn', // the column type
                    //format: 'd/m/Y',
                    width: 110, 
                    dataIndex: 'real_date', 
                    align: 'center',
                    editor: {
                        xtype: 'datefield',
                        maxValue: new Date(),
                        value: new Date(),
                        format: 'd/m/Y',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';           
                    }
                },
                { 
                    header: "Resultado", 
                    width: 100, 
                    dataIndex: 'result_check', 
                    align: 'center',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';              
                    } 
                },
                { 
                    header: "Reparaci\xF3n", 
                    width: 100, 
                    dataIndex: 'reparation', 
                    align: 'center',
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';     
                    }
                },
                { 
                    header: "Pr\xF3ximo Plan",
                    //xtype: 'datecolumn', // the column type
                    //format: 'd/m/Y',
                    width: 110, 
                    dataIndex: 'next_plan', 
                    align: 'center',
                    editor: {
                        xtype: 'datefield',
                        value: new Date(),
                        format: 'd/m/Y',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';         
                    }
                },
                { 
                    header: "\xC1rea", 
                    width: 150, 
                    dataIndex: 'location', 
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';    
                    }
                },
                { 
                    header: "Responsable", 
                    width: 150, 
                    dataIndex: 'owner', 
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                if (value != ''){
                                    metaData['tdAttr'] = 'data-qtip="' + val + '"';
                                }
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                if (value != ''){
                                    metaData['tdAttr'] = 'data-qtip="' + val + '"';
                                }
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                if (value != ''){
                                    metaData['tdAttr'] = 'data-qtip="' + val + '"';
                                }
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';                 
                    }
                },
                { 
                    header: "Observaciones", 
                    width: 250, 
                    dataIndex: 'comment', 
                    editor: {
                        xtype: 'textfield',
                        selectOnFocus: true
                    },
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                if (value != ''){
                                    metaData['tdAttr'] = 'data-qtip="' + val + '"';
                                }
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                if (value != ''){
                                    metaData['tdAttr'] = 'data-qtip="' + val + '"';
                                }
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                if (value != ''){
                                    metaData['tdAttr'] = 'data-qtip="' + val + '"';
                                }
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';      
                    }
                },
                { 
                    header: "Actualizado", 
                    width: 150, 
                    dataIndex: 'updated_at',
                    renderer: function(val, metaData, record, colIndex, store) {
                        if (val !== null) { value = val; } else { value = ''; }
                        if (parseInt(record.get('active')) == 0) {
                            metaData.tdCls = 'row-inactive';
                            metaData['tdAttr'] = 'data-qtip="Instrumento Inactivo"';
                        }
                        else {
                            if(record.get('id_state') == 2){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': No Disponible/No Apto"';
                                metaData.tdCls = 'row-noavailable';
                            }
                            else if(record.get('id_state') == 3){
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Entregado para calibrar"';
                                metaData.tdCls = 'row-send';
                            }
                            else {
                                metaData['tdAttr'] = 'data-qtip="'+record.get('name')+': Disponible/Apto"';
                            }
                        }
                        return '<span style="color:#000;">' + value + '</span>';              
                    }
                }
            ]
        };

        this.callParent(arguments);

        // Add Events
        me.addEvents('recordedit');

        //cellEditingPlugin.on('edit', me.handleCellEdit, this);
        me.on('edit', function(edt, e){
            var record = {
                    id: e.record.data.id,
                    workname: e.record.data.workname,
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

