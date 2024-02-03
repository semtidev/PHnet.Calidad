Ext.define('PHNet.controller.App', {
    extend: 'Ext.app.Controller',
    models: ['Departments', 'Specialities', 'Work', 'Workscombo'],
    stores: ['Departments', 'Specialities', 'Work', 'Workscombo'],
    views: [
        'app.ConfigWindow',
        'app.ConfigTab',
        'app.WorksGrid',
        'app.MetrotypeGrid',
        'app.ProfileWindow',
        'app.ProfilePassword'
    ],
    refs: [
        {
            ref: 'configtab',
            selector: 'configtab'
        },
        {
            ref: 'worksgrid',
            selector: 'worksgrid'
        },
        {
            ref: 'metrotypegrid',
            selector: 'metrotypegrid'
        },
        {
            ref: 'userprofile',
            selector: 'userprofile'
        },
        {
            ref: 'userpassword',
            selector: 'userpassword'
        }
    ],
    init: function() {

        this.control({
            'configtab button[action=reload]': {
                click: this.reloadConfig
            },
            'worksgrid': {
                recordedit: this.updateWork,
                deleteclick: this.deleteWork,
                changeStateMetrology: this.changeStateMetrology
            },
            'metrotypegrid': {
                recordedit: this.updateMetrotype
            },
            'userprofile checkboxfield': {
                change: this.updateNotify
            },
            'userpassword button[action=btn-changepass]': {
                click: this.changePassword
            }
        });
    },
    
    reloadConfig: function() {

        let workgrid      = this.getWorksgrid(),
            metrotypegrid = this.getMetrotypegrid();

        // Load Works
        let workproxy = workgrid.getStore().getProxy();
        Ext.apply(workproxy.api, {
            read: '/phnet.calidad/public/api/works/all'
        });
        workgrid.getStore().load({
            callback: function(records, operation, success) {
                workgrid.getSelectionModel().deselect(records, true);
            }
        });

        // Load Metrotypes
        let metrotypeproxy = metrotypegrid.getStore().getProxy();
        Ext.apply(metrotypeproxy.api, {
            read: '/phnet.calidad/public/api/metrotypes'
        });
        metrotypegrid.getStore().load({
            callback: function(records, operation, success) {
                metrotypegrid.getSelectionModel().deselect(records, true);
            }
        });
    },

    changePassword: function(button) {

        let win    = button.up('window'),
            form   = win.down('form'),
            values = form.getValues(),
            user   = localStorage.getItem('userid');

        if (form.isValid()) {

            // UPDATE
            if (values.new_pass == values.rep_pass)
            {
                form.getForm().submit({
                    method: 'POST',
                    url: '/phnet.calidad/public/api/user/password',
                    params: {
                        user: user,
                        old_pass: values.old_pass,
                        new_pass: values.new_pass
                    },
                    waitTitle: 'Espere', //Titulo del mensaje de espera
                    waitMsg: 'Procesando datos...', //Mensaje de espera
                    success: function(form, action) {
                        win.close();
                        Ext.MessageBox.show({
                            id: 'dlg-error-changepass-confirm',
                            title: 'Mensaje del Sistema',
                            msg: 'La Contraseña se ha cambiado satisfactoriamente.',
                            icon: 'fas fa-exclamation-triangle fa-2x dlg-info',
                            buttons: Ext.Msg.OK
                        });
                    },
                    failure: function(form, action) {
                        let data = Ext.decode(action.response.responseText);
                        Ext.MessageBox.show({
                            title: 'Mensaje del Sistema',
                            msg: data.message,
                            icon: 'fas fa-exclamation-triangle fa-2x dlg-error',
                            buttons: Ext.Msg.OK
                        });
                    }
                });
            }
            else {
                Ext.MessageBox.show({
                    id: 'dlg-error-changepass-confirm',
                    title: 'Mensaje del Sistema',
                    msg: 'Las Contraseñas nuevas No coinciden.',
                    icon: 'fas fa-exclamation-triangle fa-2x dlg-error',
                    buttons: Ext.Msg.OK
                });
            }
        }
    },

    updateWork: function(e) {

        let grid = this.getWorksgrid(),
            id   = e.record.get('id'),
            name = e.record.get('name'),
            abbr = e.record.get('abbr');
        
        if (name == '') {
            return;
        }
        else {
            Ext.Ajax.request({
                url: '/phnet.calidad/public/api/updateWork',
                method: 'POST',
                params: {
                    id: id,
                    name: name,
                    abbr: abbr
                },
                success: function(result, request) {
                    let jsonData = Ext.JSON.decode(result.responseText);
                    if (jsonData.failure) {
                        Ext.MessageBox.show({
                            title: 'Mensaje del Sistema',
                            msg: jsonData.message,
                            buttons: Ext.MessageBox.OK,
                            icon: 'fas fa-exclamation-triangle fa-2x dlg-error'
                        });
                    }
                    else {
                        grid.getStore().load({
                            callback: function(records, operation, success) {
                                grid.getSelectionModel().deselect(records, true);
                            }
                        });
                    }
                },
                failure: function() {

                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operacion, de continuar el problema consulte al Administrador del Sistema.',
                        buttons: Ext.MessageBox.OK,
                        icon: 'fas fa-exclamation-triangle fa-2x dlg-error'
                    });
                }
            });
        }
    },

    changeStateMetrology: function(appmodule, id, state) {

        let workgrid = this.getWorksgrid();

        switch (state) {
            case null:
                newstate = 1;
                break;        
            default:
                newstate = null;
                break;
        }
        
        Ext.Ajax.request({ 
            url: '/phnet.calidad/public/api/updateStateModuleWork',
            method: 'POST',
            params: {appmodule: appmodule, id: id, newstate: newstate},
            success: function() {
                workgrid.getStore().load({
                    callback: function(records, operation, success) {
                        workgrid.getSelectionModel().deselect(records, true);
                    }
                });
            },
            failure: function() {
                Ext.MessageBox.show({
                    title: 'Mensaje del Sistema',
                    msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operacion, de continuar el problema consulte al Administrador del Sistema.',
                    buttons: Ext.MessageBox.OK,
                    icon: 'fas fa-exclamation-triangle fa-2x dlg-error'
                });
            }
        });
    },
    
    deleteWork: function(id) {
        
        let grid  = this.getWorksgrid();

        Ext.Msg.confirm("Eliminar Obra", "Esta Obra y la informaci\xF3n asociada a ella ser\xE1n eliminadas definitivamente. Confirma que desea realizar esta operaci\xF3n?", function(btnText) {
            
            if (btnText === "yes") {
                Ext.Ajax.request({ 
                    url: '/phnet.calidad/public/api/deleteWork',
                    method: 'POST',
                    waitTitle: 'Espere',
                    waitMsg: 'Eliminando Obra...',
                    params: {id: id},
                    success: function() {
                        grid.getStore().load({
                            callback: function(records, operation, success) {
                                grid.getSelectionModel().deselect(records, true);
                            }
                        });
                    },
                    failure: function() {
                        Ext.MessageBox.show({
                            title: 'Mensaje del Sistema',
                            msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operacion, de continuar el problema consulte al Administrador del Sistema.',
                            buttons: Ext.MessageBox.OK,
                            icon: 'fas fa-exclamation-triangle fa-2x dlg-error'
                        });
                    }
                });
            }
        }, this);
    },

    updateMetrotype: function(e) {

        let grid = this.getMetrotypegrid(),
            id   = e.record.get('id'),
            code = e.record.get('code');
        
        if (e.originalValue == e.value) {
            return;
        }
        else {
            Ext.Ajax.request({
                url: '/phnet.calidad/public/api/metrotypes/upd',
                method: 'POST',
                params: {
                    id: id,
                    code: code
                },
                success: function(result, request) {
                    let jsonData = Ext.JSON.decode(result.responseText);
                    if (jsonData.failure) {
                        Ext.MessageBox.show({
                            title: 'Mensaje del Sistema',
                            msg: jsonData.message,
                            buttons: Ext.MessageBox.OK,
                            icon: 'fas fa-exclamation-triangle fa-2x dlg-error'
                        });
                    }
                    else {
                        grid.getStore().load({
                            callback: function(records, operation, success) {
                                grid.getSelectionModel().deselect(records, true);
                            }
                        });
                    }
                },
                failure: function() {

                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operacion, de continuar el problema consulte al Administrador del Sistema.',
                        buttons: Ext.MessageBox.OK,
                        icon: 'fas fa-exclamation-triangle fa-2x dlg-error'
                    });
                }
            });
        }
    },

    updateNotify: function (checkbox, newValue, oldValue, eOpts) {
        
        if (parseInt(localStorage.getItem('profile_metroplan_change')) > 0) {
            
            let notify  = checkbox.getId(),
                id_user = localStorage.getItem('userid');

            switch (notify) {
                case 'notify_metrology':
                    notify = 'Plan de Calibración'
                    break;
                case 'notify_normalization':
                    notify = 'Plan de Normalización'
                    break;
                case 'notify_satisfaction_ci':
                    notify = 'Satisfacción de Clientes Internos'
                    break;
                default:
                    notify = 'Satisfacción de Clientes Externos'
                    break;
            }
            
            Ext.Ajax.request({
                url: '/phnet.calidad/public/api/user/notify',
                method: 'POST',
                params: {
                    notify: notify,
                    id_user: id_user,
                    state: newValue
                },
                /*success: function(result, request) {
                    let jsonData = Ext.JSON.decode(result.responseText);
                    if (jsonData.failure) {
                        Ext.MessageBox.show({
                            title: 'Mensaje del Sistema',
                            msg: jsonData.message,
                            buttons: Ext.MessageBox.OK,
                            icon: Ext.MessageBox.ERROR
                        });
                    }
                    else {
                        grid.getStore().load({
                            callback: function(records, operation, success) {
                                grid.getSelectionModel().deselect(records, true);
                            }
                        });
                    }
                },*/
                failure: function() {

                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operacion, de continuar el problema consulte al Administrador del Sistema.',
                        buttons: Ext.MessageBox.OK,
                        icon: 'fas fa-exclamation-triangle fa-2x dlg-error'
                    });
                }
            });
        }
    }
})