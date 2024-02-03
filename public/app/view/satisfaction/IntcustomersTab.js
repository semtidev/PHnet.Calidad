Ext.define('PHNet.view.satisfaction.IntcustomersTab', {
    extend: 'Ext.tab.Panel',
    alias: 'widget.intcustomerstab',
    id: 'intcustomerstab',
    frame: false,
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
                this.down('#btn_add_intcustomers').setVisible(false);
                this.down('#poll-issues-btn').setVisible(false);
                this.down('#intpoll-btn-exp').setVisible(false);
            }
        }
    },
    items: [{
            title: 'Alimentación',
            xtype: 'pollfeedgrid',
            id: 'intcfeedtab',
            itemId: 'intcfeedtab',
            bodyPadding: 0
        },
        {
            title: 'Alojamiento y Recreaci\xF3n',
            xtype: 'pollhostgrid',
            id: 'intchostab',
            itemId: 'intchostab',
            bodyPadding: 0
        },
        {
            title: 'Choferes u Operadores de Equipos',
            xtype: 'pollequipgrid',
            id: 'intcequiptab',
            itemId: 'intcequiptab',
            bodyPadding: 0
        },
        {
            title: 'Jefes de Brigadas',
            xtype: 'pollbrigadesgrid',
            id: 'intcbrigadestab',
            itemId: 'intcbrigadestab',
            bodyPadding: 0
        },
        {
            title: 'Transporte de Personal',
            xtype: 'pollpersonaltranspgrid',
            id: 'intcpersonaltransptab',
            itemId: 'intcpersonaltransptab',
            bodyPadding: 0
        },
        {
            title: 'Transporte de Carga',
            xtype: 'pollfreightranspgrid',
            id: 'intcfreightransptab',
            itemId: 'intcfreightransptab',
            bodyPadding: 0
        }
    ],
    initComponent: function() {

        var worksCombo = Ext.create('PHNet.view.app.WorksCombo', {
                id: 'intcustomersworkscombo',
                margin: '2 0 2 5',
            }),
            worksProxy = worksCombo.getStore().getProxy();

        Ext.apply(worksProxy.api, {
            read: '/phnet.calidad/public/api/works/intcustomer'
        });
        worksCombo.getStore().load({
            callback: function(records, operation, success) {

                if (!localStorage.getItem('work')) {
                    worksCombo.setValue(worksCombo.getStore().getAt(0).data.id);
                    localStorage.setItem('work', worksCombo.getValue());
                } else {
                    if (worksCombo.getStore().findExact('id', parseInt(localStorage.getItem('work'))) != null) {
                        worksCombo.setValue(parseInt(localStorage.getItem('work')));
                    } else {
                        worksCombo.setValue(worksCombo.getStore().getAt(0).data.id);
                    }
                }

                var proxy_feed = Ext.getCmp('intcfeedtab').getStore().getProxy(),
                    proxy_host = Ext.getCmp('intchostab').getStore().getProxy(),
                    proxy_equip = Ext.getCmp('intcequiptab').getStore().getProxy(),
                    proxy_brigades = Ext.getCmp('intcbrigadestab').getStore().getProxy(),
                    proxy_personaltransp = Ext.getCmp('intcpersonaltransptab').getStore().getProxy(),
                    proxy_freightransp = Ext.getCmp('intcfreightransptab').getStore().getProxy();

                Ext.apply(proxy_feed.api, {
                    read: '/phnet.calidad/public/api/poll/feed/' + worksCombo.getValue() + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
                });
                Ext.getCmp('intcfeedtab').getStore().load();

                Ext.apply(proxy_host.api, {
                    read: '/phnet.calidad/public/api/poll/host/' + worksCombo.getValue() + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
                });
                Ext.getCmp('intchostab').getStore().load();

                Ext.apply(proxy_equip.api, {
                    read: '/phnet.calidad/public/api/poll/equip/' + worksCombo.getValue() + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
                });
                Ext.getCmp('intcequiptab').getStore().load();

                Ext.apply(proxy_brigades.api, {
                    read: '/phnet.calidad/public/api/poll/brigades/' + worksCombo.getValue() + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
                });
                Ext.getCmp('intcbrigadestab').getStore().load();

                Ext.apply(proxy_personaltransp.api, {
                    read: '/phnet.calidad/public/api/poll/personaltransp/' + worksCombo.getValue() + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
                });
                Ext.getCmp('intcpersonaltransptab').getStore().load();

                Ext.apply(proxy_freightransp.api, {
                    read: '/phnet.calidad/public/api/poll/freightransp/' + worksCombo.getValue() + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
                });
                Ext.getCmp('intcfreightransptab').getStore().load();
            }
        });

        this.dockedItems = [{
            xtype: 'toolbar',
            id: 'intcustomerstoolbar',
            cls: 'toolbar',
            height: 50,
            items: [{
                    iconCls: 'fas fa-plus icon-green',
                    id: 'btn_add_intcustomers',
                    cls: 'toolbar_button',
                    xtype: 'button',
                    text: '',
                    margin: '2 5 2 3',
                    tooltip: 'Agregar Encuesta',
                    action: 'add'
                }, {
                    iconCls: 'fas fa-sync-alt icon-blue',
                    id: 'btn_reload_intcustomers',
                    cls: 'toolbar_button',
                    text: '',
                    margin: '2 7 2 2',
                    tooltip: 'Recargar Listado',
                    action: 'reload'
                }, {
                    iconCls: 'fas fa-list icon-blue',
                    id: 'poll-issues-btn',
                    cls: 'toolbar_button',
                    text: '',
                    margin: '2 7 2 0',
                    tooltip: 'Aspectos a Mejorar',
                    action: 'comments'
                }, {
                    iconCls: 'fas fa-file-pdf icon-blue',
                    id: 'intpoll-btn-exp',
                    cls: 'toolbar_button',
                    text: '',
                    tooltip: 'Generar Informes como documento PDF',
                    menu: {
                        lid: 'intpollExportMenu',
                        items: [
                            { text: 'An&aacute;lisis de Encuestas UBPH', lid: 'intpollExpAll', iconCls: 'fas fa-file-pdf' },
                            { text: 'An&aacute;lisis de Encuestas Proyecto Actual', lid: 'intpollExpCurrent', iconCls: 'fas fa-file-pdf' }
                        ]
                    }
                }, '->', worksCombo, {
                    xtype: 'monthcombo',
                    id: 'intcustomersmonthcombo',
                    action: 'regcashchangemonth',
                    value: localStorage.getItem('month')
                },
                {
                    xtype: 'yearcombo',
                    id: 'intcustomersyearcombo',
                    action: 'regcashchangeyear',
                    value: localStorage.getItem('year')
                }
            ]
        }];

        this.callParent(arguments);
    }
});