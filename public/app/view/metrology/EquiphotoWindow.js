Ext.define('PHNet.view.metrology.EquiphotoWindow', {
    extend: 'Ext.window.Window',
    id: 'equiphotowindow',
    alias: 'widget.equiphotowindow',
    closable: true,
    resizable: false,
    width: 708,
    height: 550,
    layout: 'border',
    modal: true,
    title: 'Foto',
    renderTo: Ext.getBody(),
    bodyStyle: {
        "background": "#1A76CC"
    },

    initComponent: function() {
        this.items = [{
                html: '<div class="metro-gallery-title">Galer&iacute;a de Fotos - Instrumentos de Medici&oacute;n</div>',
                region: 'north',
                padding: 0,
                height: 35,
                bodyStyle: {
                    "background": "#D2E4F9"
                }
            },
            {
                xtype: 'panel',
                id: 'metrogallery',
                layout: 'fit',
                region: 'center',
                items: {
                    xtype: 'metroimageview',
                    trackOver: true,
                    listeners: {
                        containermouseout: function(view, e) {
                            console.log('containermouseout');
                        },
                        containermouseover: function(view, e) {
                            console.log('containermouseover');
                        },
                        itemmouseleave: function(view, record, item, index, e) {
                            console.log('itemmouseleave');
                        },
                        itemmouseenter: function(view, record, item, index, e) {
                            console.log('itemmouseenter');
                        }
                    }
                }
            },
            {
                xtype: 'form',
                layout: {
                    type: 'vbox',
                    align: 'stretch' // Child items are stretched to full width
                },
                fieldDefaults: {
                    labelWidth: 55
                },
                items: [{
                    xtype: 'component',
                    height: 100,
                    id: 'metroviewphoto',
                    cls: 'metroviewphoto',
                    margin: '20 40 0 20'
                }, {
                    xtype: 'component',
                    id: 'metroviewname',
                    html: '<h3>Seleccione la foto del instrumento</h3><h5>Modelo: Ninguno</h5><h6>Especialidad: Ninguna</h6>',
                    cls: 'metroviewname',
                    margin: '0 40 0 220'
                }, {
                    xtype: 'button',
                    text: 'Seleccionar Foto',
                    id: 'metroviewbtn',
                    cls: 'metro-imgview-btn',
                    disabled: true,
                    margin: '0 0 0 385',
                    action: 'setMetroImg'
                }, {
                    xtype: 'button',
                    text: 'Quitar Foto',
                    id: 'metroviewbtndel',
                    cls: 'metro-imgview-btndel',
                    margin: '0 0 0 545',
                    disabled: true,
                    action: 'delMetroImg'
                }],
                region: 'south',
                padding: '5 0 0 0',
                height: 200,
                bodyStyle: {
                    "background": "url(dist/img/bg1.jpg)",
                    "background-size": "cover"
                }
            }
        ];

        this.callParent(arguments);
    }
});