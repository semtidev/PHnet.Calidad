Ext.define('PHNet.view.satisfaction.CommentTypeWindow', {
    extend: 'Ext.window.Window',
    id: 'commentypewindow',
    alias: 'widget.commentypewindow',
    resizable: false,
    width: 430,
    height: 210,
    maximizable: false,
    closable: true,
    layout: 'fit',
    modal: true,
    title: 'Tipo de servicio...',
    renderTo: Ext.getBody(),
    animateTarget: 'poll-issues-btn',
    initComponent: function() {
        this.items = [{
            xtype: 'form',
            padding: 0,
            margin: 0,
            border: false,
            padding: '25 20 0 20',
            waitMsgTarget: true,
            style: 'background-color: #f2f8fc;',
            fieldDefaults: {
                anchor: '100%',
                labelAlign: 'top'
            },
            items: [{
                    xtype: 'textfield',
                    id: 'export-excel-type',
                    name: 'type',
                    hidden: true
                }, {
                    xtype: 'container',
                    layout: {
                        type: 'hbox'
                    },
                    anchor: '100%',
                    region: 'center',
                    height: 53,
                    margin: 0,
                    padding: 0,
                    items: [{
                        xtype: 'component',
                        html: '<i class="fas fa-bed icon_green_logo fa-3x"></i>',
                        width: 100,
                        margin: '0 80 10 70'
                    }, {
                        xtype: 'component',
                        html: '<i class="fas fa-chess icon_land_logo fa-3x"></i>',
                        width: 100,
                        margin: '0 0 10 0'
                    }]
                },
                {
                    xtype: 'container',
                    layout: {
                        type: 'hbox'
                    },
                    region: 'south',
                    height: 70,
                    margin: 0,
                    padding: 0,
                    items: [{
                        xtype: 'radiogroup',
                        id: 'radio-turn',
                        margin: '0 8 0 50',
                        anchor: '100%',
                        layout: {
                            autoFlex: false
                        },
                        defaults: {
                            name: 'ccType',
                            margin: '0 25 0 0'
                        },
                        items: [
                            { boxLabel: 'Alojamiento', name: 'hostype', inputValue: 'host', width: 150, checked: true },
                            { boxLabel: 'Recreaci\xF3n', name: 'hostype', inputValue: 'recr', width: 200 }
                        ]
                    }]
                }
            ]
        }];

        this.dockedItems = [{
            xtype: 'toolbar',
            dock: 'bottom',
            id: 'buttons',
            ui: 'footer',
            items: ['->', {
                text: '<i class="fas fa-check"></i>&nbsp;Aceptar',
                id: 'exportExcelform-okbutton',
                cls: 'app-form-btn',
                scale: 'medium',
                margin: '3 0 3 0',
                action: 'comments'
            }, {
                text: '<i class="fas fa-times"></i>&nbsp;Cancelar',
                cls: 'app-form-btn',
                scale: 'medium',
                margin: '3 15 3 5',
                scope: this,
                handler: this.close
            }]
        }];

        this.callParent(arguments);
    }
});