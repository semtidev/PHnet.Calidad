Ext.define('PHNet.view.satisfaction.ExtpollForm', {
    extend: 'Ext.window.Window',
    id: 'extpollform',
    alias : 'widget.extpollform',
    requires: ['Ext.form.*'],
    title: 'Nueva Actividad Encuestada a Cliente Externo',
    layout: 'fit',
    autoShow: true,
    resizable: false,
    width: 530,
    height: 360,
    modal: true,
	initComponent: function() {
		this.items = [{
        	xtype: 'form',
            padding: '10 15 15 15',
            border: false,
			modal: true,
            style: 'background-color: #f2f8fc;',
            waitMsgTarget: true,
            fieldDefaults: {
            	anchor: '100%',
                labelAlign: 'top',
                combineErrors: true,
                msgTarget: 'side'
            },
                items: [{
                    xtype: 'textfield',
                    name: 'id_poll',
                    fieldLabel: 'id',
                    hidden: true
                }, {
                    xtype: 'textfield',
                    name: 'id_activity',
                    fieldLabel: 'id_activity',
                    hidden: true
                }, {
                    xtype: 'textfield',
                    id: 'extpollform_activity',
                    allowBlank: false,
                    fieldLabel: 'Descripci&oacute;n de la Actividad',
                    flex: 1,
                    margin: '0 3 10 3',
                    name: 'activity',
                    emptyText: 'Describa la actividad realizada',
                    afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>',
                    listeners: {
                        afterrender: function(field) {
                          field.focus(false, 600);                          
                        },
                        specialkey: function(field, e){
                            // e.HOME, e.END, e.PAGE_UP, e.PAGE_DOWN,
                            // e.TAB, e.ESC, arrow keys: e.LEFT, e.RIGHT, e.UP, e.DOWN
                            if (e.getKey() == e.ENTER) {
                                Ext.getCmp('extpollform_department').focus();
                            }
                        }
                    }
                }, {
                    xtype: 'fieldcontainer',
                    combineErrors: true,
                    msgTarget: 'none', // qtip  title  under
                    margin: '0 auto 5 auto',
                    layout: 'hbox',
                    items: [{
                            xtype: 'departmentscombo',
                            id: 'extpollform_department',
                            allowBlank: false,
                            fieldLabel: 'Departamento',
                            emptyText: 'Elija el Departamento',
                            flex: 2,
                            margin: '0 10 5 3',
                            name: 'department',
                            afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                        }, {
                            xtype: 'specialitiescombo',
                            id: 'extpollform_speciality',
                            allowBlank: false,
                            fieldLabel: 'Especialidad',
                            emptyText: 'Especialidad...',
                            flex: 2,
                            margin: '0 10 5 3',
                            name: 'speciality',
                            afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>'
                        }, {
                            xtype: 'textfield',
                            id: 'extpollform_level',
                            allowBlank: false,
                            fieldLabel: 'Nivel',
                            flex: 1,
                            margin: '0 3 5 3',
                            name: 'actlevel',
                            emptyText: 'Nivel 0',
                            afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>',
                            listeners: {
                                specialkey: function(field, e){
                                    if (e.getKey() == e.ENTER) {
                                        Ext.getCmp('extpollform-okbutton').fireEvent('click', Ext.getCmp('extpollform-okbutton'));
                                    }
                                }
                            }
                        }
                    ]
                }, {
                    xtype: 'fieldset',
                    flex: 1,
                    collapsible: false,
                    collapsed: false,
                    title: 'Evaluaci&oacute;n por Encuesta Aplicada',
                    layout: 'anchor',
                    padding: '5 15 10 15',
                    margin: '10 3 0 3',
                    defaults: {
                            anchor: '100%',
                            labelWidth: 100,
                            hideEmptyLabel: true
                    },
                    items: [{
                        xtype: 'fieldcontainer',
                        combineErrors: true,
                        msgTarget: 'none', // qtip  title  under
                        margin: '0 auto 0 auto',
                        layout: 'hbox',
                        items: [{
                                xtype: 'numberfield',
                                id: 'extpollform_p1',
                                value: 4,
                                minValue: 1,
                                maxValue: 5,
                                //id: 'extpollform_speciality',
                                allowBlank: false,
                                fieldLabel: 'No. 1',
                                flex: 1,
                                margin: '0 3 5 3',
                                name: 'p1',
                                afterLabelTextTpl: '<span style="color:red;font-weight:bold" data-qtip="Required"> *</span>',
                                listeners: {
                                    specialkey: function(field, e){
                                        // e.HOME, e.END, e.PAGE_UP, e.PAGE_DOWN,
                                        // e.TAB, e.ESC, arrow keys: e.LEFT, e.RIGHT, e.UP, e.DOWN
                                        if (e.getKey() == e.ENTER) {
                                            Ext.getCmp('extpollform_p2').focus();
                                        }
                                    }
                                }
                            }, {
                                xtype: 'numberfield',
                                id: 'extpollform_p2',
                                minValue: 1,
                                maxValue: 5,
                                //id: 'extpollform_speciality',
                                allowBlank: true,
                                fieldLabel: 'No. 2',
                                flex: 1,
                                margin: '0 3 5 3',
                                name: 'p2',
                                listeners: {
                                    specialkey: function(field, e){
                                        // e.HOME, e.END, e.PAGE_UP, e.PAGE_DOWN,
                                        // e.TAB, e.ESC, arrow keys: e.LEFT, e.RIGHT, e.UP, e.DOWN
                                        if (e.getKey() == e.ENTER) {
                                            Ext.getCmp('extpollform_p3').focus();
                                        }
                                    }
                                }
                            }, {
                                xtype: 'numberfield',
                                id: 'extpollform_p3',
                                minValue: 1,
                                maxValue: 5,
                                //id: 'extpollform_speciality',
                                allowBlank: true,
                                fieldLabel: 'No. 3',
                                flex: 1,
                                margin: '0 3 5 3',
                                name: 'p3',
                                listeners: {
                                    specialkey: function(field, e){
                                        // e.HOME, e.END, e.PAGE_UP, e.PAGE_DOWN,
                                        // e.TAB, e.ESC, arrow keys: e.LEFT, e.RIGHT, e.UP, e.DOWN
                                        if (e.getKey() == e.ENTER) {
                                            Ext.getCmp('extpollform_p4').focus();
                                        }
                                    }
                                }
                            }, {
                                xtype: 'numberfield',
                                id: 'extpollform_p4',
                                minValue: 1,
                                maxValue: 5,
                                //id: 'extpollform_speciality',
                                allowBlank: true,
                                fieldLabel: 'No. 4',
                                flex: 1,
                                margin: '0 3 5 3',
                                name: 'p4',
                                listeners: {
                                    specialkey: function(field, e){
                                        // e.HOME, e.END, e.PAGE_UP, e.PAGE_DOWN,
                                        // e.TAB, e.ESC, arrow keys: e.LEFT, e.RIGHT, e.UP, e.DOWN
                                        if (e.getKey() == e.ENTER) {
                                            Ext.getCmp('extpollform_p5').focus();
                                        }
                                    }
                                }
                            }, {
                                xtype: 'numberfield',
                                id: 'extpollform_p5',
                                minValue: 1,
                                maxValue: 5,
                                //id: 'extpollform_speciality',
                                allowBlank: true,
                                fieldLabel: 'No. 5',
                                flex: 1,
                                margin: '0 3 5 3',
                                name: 'p5',
                                listeners: {
                                    specialkey: function(field, e){
                                        // e.HOME, e.END, e.PAGE_UP, e.PAGE_DOWN,
                                        // e.TAB, e.ESC, arrow keys: e.LEFT, e.RIGHT, e.UP, e.DOWN
                                        if (e.getKey() == e.ENTER) {
                                            Ext.getCmp('extpollform_store').focus();
                                        }
                                    }
                                }
                            }
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
                id: 'extpollform-okbutton',
                text: '<i class="fas fa-check"></i>&nbsp;Aplicar',
                cls: 'app-form-btn',
                scale: 'medium',
                margin: '3 0 3 0',
                action: 'store'
            }, {
                id: 'extpollform-okclosebutton',
                text: '<i class="fas fa-check"></i>&nbsp;Aceptar y Cerrar',
                cls: 'app-form-btn',
                scale: 'medium',
                margin: '3 0 3 5',
                action: 'storeclose'
            }, {
                id: 'extpollform-cancelbtn',
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