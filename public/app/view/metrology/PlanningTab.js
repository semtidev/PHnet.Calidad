Ext.define('PHNet.view.metrology.PlanningTab', {
    extend: 'Ext.tab.Panel',
    alias: 'widget.planningtab',
    id: 'planningtab',
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
                this.down('#btn_print_plannig').setVisible(false);
            }
        }
    },
    items: [
        {
            title: 'Plan Proyecto',
            xtype: 'planningprojectgrid',
            id: 'metroplanprojectab',
            itemId: 'metroplanprojectab',
            bodyPadding: 0
        },
        {
            title: 'Plan General UBPH',
            xtype: 'planningubphgrid',
            id: 'metroplanubphtab',
            itemId: 'metroplanubphtab',
            bodyPadding: 0
        }
    ],
    initComponent: function () {

        var worksCombo = Ext.create('PHNet.view.app.WorksCombo', {
            id: 'planningworkscombo',
            margin: '2 0 2 5',
        }),
            worksProxy = worksCombo.getStore().getProxy();

        Ext.apply(worksProxy.api, {
            read: '/phnet.calidad/public/api/works/plan'
        });
        worksCombo.getStore().load({
            callback: function (records, operation, success) {

                if (!localStorage.getItem('work')) {
                    worksCombo.setValue(worksCombo.getStore().getAt(0).data.id);
                    localStorage.setItem('work', worksCombo.getValue());
                }
                else {
                    if (worksCombo.getStore().find('id', localStorage.getItem('work')) != null) {
                        worksCombo.setValue(parseInt(localStorage.getItem('work')));
                    }
                    else {
                        worksCombo.setValue(worksCombo.getStore().getAt(0).data.id);
                    }
                }

                /*var proxy_planningproject = Ext.getCmp('planningprojectgrid').getStore().getProxy(),
                    proxy_planningubph    = Ext.getCmp('planningubphgrid').getStore().getProxy();

                Ext.apply(proxy_planningproject.api, {
                    read: '/phnet.calidad/public/api/metro/planproject/' + worksCombo.getValue() + '/' + localStorage.getItem('year')
                });
                Ext.getCmp('planningprojectgrid').getStore().load();

                Ext.apply(proxy_planningubph.api, {
                    read: '/phnet.calidad/public/api/metro/planubph/' + localStorage.getItem('year')
                });
                Ext.getCmp('planningubphgrid').getStore().load();*/
            }
        });

        this.dockedItems = [{
            xtype: 'toolbar',
            id: 'metroplanningtoolbar',
            cls: 'toolbar',
            height: 50,
            items: [{
                iconCls: 'fas fa-sync-alt icon-blue',
                cls: 'toolbar_button',
                text: '',
                margin: '3 7 3 3',
                tooltip: 'Actualizar Listado',
                action: 'reload'
            }, {
                iconCls: 'fas fa-print icon-blue',
                id: 'btn_print_plannig',
                cls: 'toolbar_button',
                text: '',
                margin: '3 7 3 0',
                tooltip: 'Imprimir como PDF',
                action: 'print'
            }, '-' , {
                xtype: 'box',
                id: 'box-extcustomer-prom',
                margin: '0 10 0 5',
                html: '<strong>Leyenda</strong>:&nbsp;&nbsp;&nbsp;<span class="fas fa-stop text-planning"></span>&nbsp;Fecha Plan&nbsp;&nbsp;&nbsp;<span class="fas fa-stop text-real"></span>&nbsp;Fecha Real&nbsp;&nbsp;&nbsp;<span class="fas fa-stop text-backlog"></span>&nbsp;Pendiente'
            }, '->', worksCombo, {
                xtype: 'yearcombo',
                id: 'planningyearcombo',
                action: 'regcashchangeyear',
                value: localStorage.getItem('year')
            }]
        }];

        this.callParent(arguments);
    }
});