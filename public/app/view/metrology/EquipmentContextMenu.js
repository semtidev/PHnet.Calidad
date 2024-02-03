Ext.define('PHNet.view.metrology.EquipmentContextMenu', {
    extend: 'Ext.menu.Menu',
    xtype: 'equipmentcontextmenu',
    id: 'equipmentcontextmenu',
    items: [
        {
            text: 'Activo',
            id: 'metroActive',
            listeners: {
                'render': function(item, opt) {
                    var equipmentab = Ext.getCmp('equipmentab'),
                        activetab   = equipmentab.getActiveTab().itemId
                        grid        = Ext.getCmp(activetab),
                        record      = grid.getSelectionModel().getSelection()[0]
                    if (record.data.active == 1) {
                        item.setIconCls('fas fa-check');
                    }
                    else {
                        item.setIconCls('no-icon');
                    }
                },
                'click': function(item, e, eOpts) {
                    this.fireEvent('itemclick', item);
                }
            }
        },
        {
            text: 'Mover a...',
            iconCls: 'fas fa-file-export',
            id: 'metrorowmove'
        },
        {
            text: 'Duplicar Fila',
            iconCls: 'fas fa-clone',
            id: 'metrorowclon'
        },
        {
            text: 'Ver Hist&oacute;rico',
            iconCls: 'fas fa-reply',
            id: 'metrostory'
        },
        {
            text: 'Estado Actual',
            iconCls: 'fas fa-check',
            menu: {        // <-- submenu by nested config object
                items: [
                    {
                        text: 'Disponible/Apto',
                        id: 'metroStateDisp',
                        listeners: {
                            'render': function(item, opt) {
                                var equipmentab = Ext.getCmp('equipmentab'),
                                    activetab   = equipmentab.getActiveTab().itemId
                                    grid        = Ext.getCmp(activetab),
                                    record      = grid.getSelectionModel().getSelection()[0]
                                if (record.data.id_state == 1) {
                                    item.setIconCls('fas fa-check');
                                }
                                else {
                                    item.setIconCls('no-icon');
                                }
                            },
                            'click': function(item, e, eOpts) {
                                this.fireEvent('itemclick', item);
                            }
                        }
                    },
                    {
                        text: '<span style="color:#DE7601">No Disponible/No Apto</span>',
                        id: 'metroStateNoDisp',
                        listeners: {
                            'render': function(item, opt) {
                                var equipmentab = Ext.getCmp('equipmentab'),
                                    activetab   = equipmentab.getActiveTab().itemId
                                    grid        = Ext.getCmp(activetab),
                                    record      = grid.getSelectionModel().getSelection()[0]
                                if (record.data.id_state == 2) {
                                    item.setIconCls('fas fa-check');
                                }
                                else {
                                    item.setIconCls('no-icon');
                                }
                            },
                            'click': function(item, e, eOpts) {
                                this.fireEvent('itemclick', item);
                            }
                        }
                    },
                    {
                        text: '<span style="color:#29A703">Entregado para calibrar</span>',
                        id: 'metroStateSend',
                        listeners: {
                            'render': function(item, opt) {
                                var equipmentab = Ext.getCmp('equipmentab'),
                                    activetab   = equipmentab.getActiveTab().itemId
                                    grid        = Ext.getCmp(activetab),
                                    record      = grid.getSelectionModel().getSelection()[0]
                                if (record.data.id_state == 3) {
                                    item.setIconCls('fas fa-check');
                                }
                                else {
                                    item.setIconCls('no-icon');
                                }
                            },
                            'click': function(item, e, eOpts) {
                                this.fireEvent('itemclick', item);
                            }
                        }
                    }
                ]
            }
        }
    ],
    /**
     * Associates this menu with a specific list.
     * @param {SimpleTasks.model.List} list
     */
    setList: function(list) {
        this.list = list;
    },
    /**
     * Gets the list associated with this menu
     * @return {Task.model.List}
     */
    getList: function() {
        return this.list;
    }

});