Ext.define('PHNet.view.metrology.EquipmentTab', {
    extend: 'Ext.tab.Panel',
    alias: 'widget.equipmentab',
    id: 'equipmentab',
    frame:false,
    layout: 'fit',
    requires: [
        'Ext.tab.*',
        'Ext.tip.QuickTipManager'
    ],
    activeTab: 0,
    listeners: {
        beforerender: function(view, opts) {
            // Activate/Desactivate Functions Buttons
            if (!localStorage.getItem('userrol')) {
                this.down('#btn_add_equipment').setVisible(false);
                this.down('#btn_print_equipment').setVisible(false);
                this.down('#metro-btn-exp').setVisible(false);
                this.down('#btn-metrosyncplanning').setVisible(false);
                this.down('#check_inactives_equipment').setVisible(false);
            }
        }
    },
    items: [
        {
            title: 'Masa',
            xtype: 'weightgrid',
            id: 'weightab',
            itemId: 'weightab',
            bodyPadding: 0
        },
        {
            title: 'Presi&oacute;n',
            xtype: 'pressuregrid',
            id: 'pressuretab',
            itemId: 'pressuretab',
            bodyPadding: 0
        },
        {
            title: 'Magnitudes El&eacute;ctricas',
            xtype: 'electgrid',
            id: 'electab',
            itemId: 'electab',
            bodyPadding: 0
        },
        {
            title: 'Topograf&iacute;a & Geodesia',
            xtype: 'topgeogrid',
            id: 'topgeotab',
            itemId: 'topgeotab',
            bodyPadding: 0
        },
        {
            title: 'Longitud',
            xtype: 'lengthgrid',
            id: 'lengthtab',
            itemId: 'lengthtab',
            bodyPadding: 0
        }
    ],
    initComponent: function() {

        var worksCombo  = Ext.create('PHNet.view.app.WorksCombo', {
                            id : 'metroworkscombo'
                          }),
            worksProxy  = worksCombo.getStore().getProxy(),
            statesCombo = Ext.create('PHNet.view.metrology.MetrostateCombo');

        Ext.apply(worksProxy.api, {
            read: '/phnet.calidad/public/api/works/metro'
        });
        worksCombo.getStore().load({
            callback: function(records, operation, success) {

                if (!localStorage.getItem('work')){
                    worksCombo.setValue(worksCombo.getStore().getAt(0).data.id);
                    localStorage.setItem('work', worksCombo.getValue());
                }
                else {
                    if (worksCombo.getStore().findExact('id', parseInt(localStorage.getItem('work'))) != null) {
                        worksCombo.setValue(parseInt(localStorage.getItem('work')));
                    }
                    else {
                        worksCombo.setValue(worksCombo.getStore().getAt(0).data.id);
                    }
                }

                var proxy_weight   = Ext.getCmp('weightgrid').getStore().getProxy(),
                    proxy_pressure = Ext.getCmp('pressuregrid').getStore().getProxy(),
                    proxy_topgeo   = Ext.getCmp('topgeogrid').getStore().getProxy(),
                    proxy_elect    = Ext.getCmp('electgrid').getStore().getProxy(),
                    proxy_length   = Ext.getCmp('lengthgrid').getStore().getProxy(),
                    state          = Ext.getCmp('metrostatecombo').getValue();

                switch (state) {
                    case 'Entregados para calibrar':
                        state = 'send'
                        break;
                    case 'Disponibles/Aptos':
                        state = 'available'
                        break;
                    case 'No Disponibles/No Aptos':
                        state = 'no-available'
                        break;
                    default:
                        state = 'all'
                        break;
                }
                
                Ext.apply(proxy_weight.api, {
                    read: '/phnet.calidad/public/api/metrology/weightab/' + worksCombo.getValue() + '/' + state
                });
                Ext.getCmp('weightgrid').getStore().load();

                Ext.apply(proxy_pressure.api, {
                    read: '/phnet.calidad/public/api/metrology/pressuretab/' + worksCombo.getValue() + '/' + state
                });
                Ext.getCmp('pressuregrid').getStore().load();

                Ext.apply(proxy_topgeo.api, {
                    read: '/phnet.calidad/public/api/metrology/topgeotab/' + worksCombo.getValue() + '/' + state
                });
                Ext.getCmp('topgeogrid').getStore().load();

                Ext.apply(proxy_elect.api, {
                    read: '/phnet.calidad/public/api/metrology/electab/' + worksCombo.getValue() + '/' + state
                });
                Ext.getCmp('electgrid').getStore().load();

                Ext.apply(proxy_length.api, {
                    read: '/phnet.calidad/public/api/metrology/lengthtab/' + worksCombo.getValue() + '/' + state
                });
                Ext.getCmp('lengthgrid').getStore().load();

            }
        });
        this.dockedItems = [{
            xtype: 'toolbar',
            id: 'equipmentoolbar',
            cls: 'toolbar',
            height: 50,
            items: [{
                iconCls: 'fas fa-plus icon-green',
                id: 'btn_add_equipment',
                cls: 'toolbar_button',
                xtype: 'button',
                text: '',
                margin: '2 5 2 3',
                tooltip: 'Agregar Instrumento',
                action: 'add'
            }, {
                iconCls: 'fas fa-sync-alt icon-blue',
                cls: 'toolbar_button',
                text: '',
                margin: '2 7 2 2',
                tooltip: 'Actualizar Listado',
                action: 'reload'
            }, {
                iconCls: 'fas fa-print icon-blue',
                id: 'btn_print_equipment',
                cls: 'toolbar_button',
                text: '',
                margin: '2 7 2 0',
                tooltip: 'Imprimir Proyecto Acual como Libro PDF',
                action: 'print'
            }, {
                iconCls: 'fas fa-search icon-blue',
                id: 'btn-metrosearch',
                cls: 'toolbar_button',
                text: '',
                margin: '2 7 2 0',
                tooltip: 'Buscar Instrumento...',
                action: 'search'
            }, {
                iconCls: 'fas fa-calendar-alt icon-blue',
                id: 'btn-metrosyncplanning',
                cls: 'toolbar_button',
                text: '',
                margin: '2 7 2 0',
                tooltip: 'Sincronizar Plan de Calibración UBPH',
                action: 'syncplanning'
            }, {
                iconCls: 'fas fa-file-pdf icon-blue',
                id: 'metro-btn-exp',
                cls: 'toolbar_button',
                text: '',
                tooltip: 'Generar Informes como documento PDF',
                menu: {
                    lid: 'metroExportMenu',
                    items: [
                        { text: 'Plantilla UBPH', lid: 'metroExpAll', iconCls: 'fas fa-file-pdf' },
                        { text: 'Plantilla Proyecto Actual', lid: 'metroExpCurrent',  iconCls: 'fas fa-file-pdf' }
                    ]
                }
            }, '-', {
                xtype: 'fieldcontainer',
                id: 'check_inactives_equipment',
                items: [{
                    xtype: 'checkboxfield',
                    boxLabel: 'Mostrar Instrumentos Inactivos',
                    name: 'metro-show-inactives',
                    id: 'metro-show-inactives',
                    margin: '2 0 0 5',
                    checked: false
                }]
            }, '->', worksCombo, statesCombo]
        }];

        this.callParent(arguments);
    }
});