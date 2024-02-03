Ext.define('PHNet.view.satisfaction.ExtcustomersTab', {
    extend: 'Ext.tab.Panel',
    alias: 'widget.extcustomerstab',
    id: 'extcustomerstab',
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
                this.down('#extpoll-add-btn').setVisible(false);
                this.down('#extpoll-btn-exp').setVisible(false);
                this.down('#extpoll-upload-btn').setVisible(false);
                this.down('#extpoll-alldelete-btn').setVisible(false);
            }
        }
    },
    items: [{
        title: 'Volumen Constructivo',
        xtype: 'extpollgrid',
        id: 'extctab',
        itemId: 'extctab',
        bodyPadding: 0
    }],
    initComponent: function() {

        var worksCombo = Ext.create('PHNet.view.app.WorksCombo', {
                id: 'extcustomersworkscombo',
                margin: '2 0 2 5',
                width: 280
            }),
            worksProxy = worksCombo.getStore().getProxy();

        Ext.apply(worksProxy.api, {
            read: '/phnet.calidad/public/api/works/extcustomer'
        });
        worksCombo.getStore().load({
            callback: function(records, operation, success) {

                if (!localStorage.getItem('work')) {
                    worksCombo.setValue(worksCombo.getStore().getAt(0).data.id);
                    localStorage.setItem('work', worksCombo.getValue());
                } else {
                    //console.log(worksCombo.getStore().findExact('id', parseInt(localStorage.getItem('work'))));
                    if (worksCombo.getStore().findExact('id', parseInt(localStorage.getItem('work'))) != -1) {
                        worksCombo.setValue(parseInt(localStorage.getItem('work')));
                    } else {
                        worksCombo.setValue(worksCombo.getStore().getAt(0).data.id);
                    }
                }

                var proxy = Ext.getCmp('extctab').getStore().getProxy();

                Ext.apply(proxy.api, {
                    read: '/phnet.calidad/public/api/extpolls/' + worksCombo.getValue() + '/' + localStorage.getItem('month') + '/' + localStorage.getItem('year')
                });
                Ext.getCmp('extctab').getStore().load();
            }
        });

        this.dockedItems = [{
            xtype: 'toolbar',
            id: 'extcustomerstoolbar',
            cls: 'toolbar',
            height: 50,
            items: [{
                    iconCls: 'fas fa-plus icon-green',
                    id: 'extpoll-add-btn',
                    cls: 'toolbar_button',
                    xtype: 'button',
                    text: '',
                    margin: '2 5 2 3',
                    tooltip: 'Agregar Actividad',
                    action: 'add'
                }, {
                    iconCls: 'fas fa-upload icon-blue',
                    id: 'extpoll-upload-btn',
                    cls: 'toolbar_button',
                    xtype: 'button',
                    text: '',
                    margin: '2 7 2 2',
                    tooltip: 'Importar Actividades desde Excel',
                    action: 'import'
                }, {
                    iconCls: 'fas fa-minus-circle icon-red',
                    id: 'extpoll-alldelete-btn',
                    cls: 'toolbar_button',
                    xtype: 'button',
                    text: '',
                    margin: '2 7 2 2',
                    tooltip: 'Eliminar todas las Actvidades',
                    action: 'alldelete'
                }, {
                    iconCls: 'fas fa-sync-alt icon-blue',
                    cls: 'toolbar_button',
                    text: '',
                    margin: '2 7 2 2',
                    tooltip: 'Recargar Listado',
                    action: 'reload'
                }, {
                    iconCls: 'fas fa-file-pdf icon-blue',
                    id: 'extpoll-btn-exp',
                    cls: 'toolbar_button',
                    text: '',
                    tooltip: 'Generar Informes como documento PDF',
                    menu: {
                        lid: 'extpollExportMenu',
                        items: [
                            { text: 'Encuesta de Satisfacci&oacute;n', lid: 'extpollExpModel', iconCls: 'fas fa-file-pdf' },
                            { text: 'An&aacute;lisis de Encuestas', lid: 'extpollExpProject', iconCls: 'fas fa-file-pdf' },
                            { text: 'Certifico de Calidad', lid: 'extpollExpCert', iconCls: 'fas fa-file-pdf' }
                        ]
                    }
                }, {
                    xtype: 'box',
                    id: 'box-extcustomer-prom',
                    margin: '0 10 0 5',
                    html: 'Promedio Total:'
                }, '-', {
                    xtype: 'box',
                    id: 'box-extcustomer-eval',
                    html: 'Evaluaci&oacute;n:'
                }, '->', worksCombo, {
                    xtype: 'monthcombo',
                    id: 'extcustomersmonthcombo',
                    action: 'regcashchangemonth',
                    value: localStorage.getItem('month')
                },
                {
                    xtype: 'yearcombo',
                    id: 'extcustomersyearcombo',
                    action: 'regcashchangeyear',
                    value: localStorage.getItem('year')
                }
            ]
        }];

        this.callParent(arguments);
    }
});