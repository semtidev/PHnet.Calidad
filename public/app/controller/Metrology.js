Ext.define('PHNet.controller.Metrology', {
    extend: 'Ext.app.Controller',
    models: ['Metrology', 'Metrotype', 'Metrohistory', 'Metroplanproject', 'Metroplanubph', 'Workabbr'],
    stores: ['Metroweight', 'Metropressure', 'Metroelect', 'Metrotopgeo', 'Metrolength', 'Metrotype', 'Metrohistory', 'Metroplanproject', 'Metroplanubph', 'Workabbr'],
    views: [
        'app.WorksCombo',
        'app.WorkAbbrCombo',
        'metrology.EquipmentWindow',
        'metrology.EquipmentTab',
        'metrology.MetrostateCombo',
        'metrology.WeightGrid',
        'metrology.PressureGrid',
        'metrology.ElectGrid',
        'metrology.TopgeoGrid',
        'metrology.LengthGrid',
        'metrology.EquiphotoWindow',
        'metrology.MetrotypeCombo',
        'metrology.MetroSearch',
        'metrology.EquipmentContextMenu',
        'metrology.MetroImageView',
        'metrology.MovetoprojectForm',
        'metrology.HistoryGrid',
        'metrology.HistoryWindow',
        'metrology.PlanningWindow',
        'metrology.PlanningTab',
        'metrology.PlanningprojectGrid',
        'metrology.PlanningubphGrid',
        'metrology.SyncPlanningForm'
    ],
    refs: [
        {
            ref: 'workscombo',
            selector: 'workscombo'
        },
        {
            ref: 'worksabbrcombo',
            selector: 'worksabbrcombo'
        },
        {
            ref: 'metrostatecombo',
            selector: 'metrostatecombo'
        },
        {
            ref: 'metrosearch',
            selector: 'metrosearch'
        },
        {
            ref: 'equipmentwindow',
            selector: 'equipmentwindow'
        },
        {
            ref: 'equipmentab',
            selector: 'equipmentab'
        },
        {
            ref: 'weightgrid',
            selector: 'weightgrid'
        },
        {
            ref: 'pressuregrid',
            selector: 'pressuregrid'
        },
        {
            ref: 'electgrid',
            selector: 'electgrid'
        },
        {
            ref: 'topgeogrid',
            selector: 'topgeogrid'
        },
        {
            ref: 'lengthgrid',
            selector: 'lengthgrid'
        },
        {
            ref: 'equiphotowindow',
            selector: 'equiphotowindow'
        },
        {
            ref: 'equipmentcontextmenu',
            selector: 'equipmentcontextmenu'
        },
        {
            ref: 'metroimageview',
            selector: 'metroimageview'
        },
        {
            ref: 'movetoprojectform',
            selector: 'movetoprojectform'
        },
        {
            ref: 'historygrid',
            selector: 'historygrid'
        },
        {
            ref: 'historywindow',
            selector: 'historywindow'
        },
        {
            ref: 'planningwindow',
            selector: 'planningwindow'
        },
        {
            ref: 'planningtab',
            selector: 'planningtab'
        },
        {
            ref: 'planningprojectgrid',
            selector: 'planningprojectgrid'
        },
        {
            ref: 'planningubphgrid',
            selector: 'planningubphgrid'
        },
        {
            ref: 'syncplanningform',
            selector: 'syncplanningform'
        }
    ],
    init: function() {

        this.control({
            'weightgrid': {
                recordedit: this.updMetrology,
                deleteclick: this.deleteMetrology,
                photoclick: this.photoMetrology,
                itemcontextmenu: this.showContextMenu
            },
            'pressuregrid': {
                recordedit: this.updMetrology,
                deleteclick: this.deleteMetrology,
                photoclick: this.photoMetrology,
                itemcontextmenu: this.showContextMenu
            },
            'electgrid': {
                recordedit: this.updMetrology,
                deleteclick: this.deleteMetrology,
                photoclick: this.photoMetrology,
                itemcontextmenu: this.showContextMenu
            },
            'topgeogrid': {
                recordedit: this.updMetrology,
                deleteclick: this.deleteMetrology,
                photoclick: this.photoMetrology,
                itemcontextmenu: this.showContextMenu
            },
            'lengthgrid': {
                recordedit: this.updMetrology,
                deleteclick: this.deleteMetrology,
                photoclick: this.photoMetrology,
                itemcontextmenu: this.showContextMenu
            },
            'equipmentab': {
                tabchange: this.loadMetrologyTab
            },
            'equipmentab button[action=add]': {
                click: this.addEquipment
            },
            'equipmentab button[action=print]': {
                click: this.metroExpBook
            },
            'equipmentab button[action=search]': {
                click: this.metroSearchForm
            },
            'equipmentab button[action=syncplanning]': {
                click: this.syncPlanningForm
            },
            'equipmentab menu[lid=metroExportMenu] menuitem[lid=metroExpCurrent]': {
                click: this.metroExpCurrent
            },
            'equipmentab menu[lid=metroExportMenu] menuitem[lid=metroExpAll]': {
                click: this.metroExpAll
            },
            '#metrosearch_serial': {
                specialkey: this.loadMetroSearch
            },
            '#metro-show-inactives': {
                change: this.loadActives
            },
            '#metroworkscombo': {
                change: this.loadMetrology
            },
            'metrostatecombo': {
                change: this.loadMetrostate
            },
            'equipmentab button[action=reload]': {
                click: this.reloadMetrology
            },
            '#metrorowclon': {
                click: this.handleMetroRowClone
            },
            '#metrorowmove': {
                click: this.handleMetroRowMove
            },
            '#metrostory': {
                click: this.handleMetroHistory
            },
            '#metroActive': {
                itemclick: this.handleMetroActive
            },
            '#metroStateDisp': {
                itemclick: this.handleMetroState
            },
            '#metroStateNoDisp': {
                itemclick: this.handleMetroState
            },
            '#metroStateSend': {
                itemclick: this.handleMetroState
            },
            'metroimageview': {
                itemkeydown: this.metroImageViewUpdate,
                itemclick: this.metroImageViewUpdate
            },
            'movetoprojectform button[action=storeclose]': {
                click: this.updMetroMove
            },
            'equiphotowindow button[action=setMetroImg]': {
                click: this.setMetroImg
            },
            'equiphotowindow button[action=delMetroImg]': {
                click: this.delMetroImg
            },
            'planningtab': {
                tabchange: this.loadPlanningTab
            },
            'planningtab button[action=reload]': {
                click: this.reloadPlanning
            },
            'planningtab button[action=print]': {
                click: this.printPlanning
            },
            '#planningworkscombo': {
                change: this.loadPlanning
            },
            '#planningyearcombo': {
                change: this.loadYearPlanning
            }
        });
    },
    
    loadMetrologyTab: function (tabPanel, newCard, oldCard, opt) {
        
        let equipmentab = this.getEquipmentab(),
            activetab   = equipmentab.getActiveTab().itemId;

        localStorage.setItem('equipment_activetab', activetab);
    },

    loadPlanningTab: function (tabPanel, newCard, oldCard, opt) {
        
        let planningtab = this.getPlanningtab(),
            activetab   = planningtab.getActiveTab().itemId;

        if (activetab == 'metroplanubphtab') {
            Ext.getCmp('planningworkscombo').setVisible(false);
        }
        else {
            Ext.getCmp('planningworkscombo').setVisible(true);
        }
        
        localStorage.setItem('planning_activetab', activetab);
    },
    
    reloadMetrology: function () {
        
        let equipmentab = this.getEquipmentab(),
            activetab   = equipmentab.getActiveTab().itemId,
            work        = parseInt(Ext.getCmp('metroworkscombo').getValue()),
            state       = Ext.getCmp('metrostatecombo').getValue();

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

        if (activetab == 'weightab') {
            let weightgrid  = this.getWeightgrid(),
                weightproxy = weightgrid.getStore().getProxy();
            Ext.apply(weightproxy.api, {
                read: '/phnet.calidad/public/api/metrology/weightab/' + work + '/' + state
            });
            weightgrid.getStore().load({
                callback: function(records, operation, success) {
                    weightgrid.getSelectionModel().deselect(records, true);
                }
            });
        }
        else if (activetab == 'pressuretab') {
            let pressuregrid  = this.getPressuregrid(),
                pressureproxy = pressuregrid.getStore().getProxy();
            Ext.apply(pressureproxy.api, {
                read: '/phnet.calidad/public/api/metrology/pressuretab/' + work + '/' + state
            });
            pressuregrid.getStore().load({
                callback: function(records, operation, success) {
                    pressuregrid.getSelectionModel().deselect(records, true);
                }
            });
        }
        else if (activetab == 'electab') {
            let electgrid  = this.getElectgrid(),
                electproxy = electgrid.getStore().getProxy();
            Ext.apply(electproxy.api, {
                read: '/phnet.calidad/public/api/metrology/electab/' + work + '/' + state
            });
            electgrid.getStore().load({
                callback: function(records, operation, success) {
                    electgrid.getSelectionModel().deselect(records, true);
                }
            });
        }
        else if (activetab == 'topgeotab') {
            let topgeogrid  = this.getTopgeogrid(),
                topgeoproxy = topgeogrid.getStore().getProxy();
            Ext.apply(topgeoproxy.api, {
                read: '/phnet.calidad/public/api/metrology/topgeotab/' + work + '/' + state
            });
            topgeogrid.getStore().load({
                callback: function(records, operation, success) {
                    topgeogrid.getSelectionModel().deselect(records, true);
                }
            });
        }
        else if (activetab == 'lengthtab') {
            let lengthgrid  = this.getLengthgrid(),
                lengthproxy = lengthgrid.getStore().getProxy();
            Ext.apply(lengthproxy.api, {
                read: '/phnet.calidad/public/api/metrology/lengthtab/' + work + '/' + state
            });
            lengthgrid.getStore().load({
                callback: function(records, operation, success) {
                    lengthgrid.getSelectionModel().deselect(records, true);
                }
            });
        }
    },

    reloadPlanning: function () {
        
        let planningtab = this.getPlanningtab(),
            activetab   = planningtab.getActiveTab().itemId,
            work        = parseInt(Ext.getCmp('planningworkscombo').getValue()),
            year        = Ext.getCmp('planningyearcombo').getValue();

        if (activetab == 'metroplanprojectab') {
            let projectplanninggrid  = this.getPlanningprojectgrid(),
                projectplanningproxy = projectplanninggrid.getStore().getProxy();
            Ext.apply(projectplanningproxy.api, {
                read: '/phnet.calidad/public/api/metro/planproject/' + work + '/' + year
            });
            projectplanninggrid.getStore().load({
                callback: function(records, operation, success) {
                    projectplanninggrid.getSelectionModel().deselect(records, true);
                }
            });
        }
        else if (activetab == 'metroplanubphtab') {
            let ubphplanninggrid  = this.getPlanningubphgrid(),
                ubphplanningproxy = ubphplanninggrid.getStore().getProxy();
            Ext.apply(ubphplanningproxy.api, {
                read: '/phnet.calidad/public/api/metro/planubph/' + year
            });
            ubphplanninggrid.getStore().load({
                callback: function(records, operation, success) {
                    ubphplanninggrid.getSelectionModel().deselect(records, true);
                }
            });
        }
    },
    
    loadActives: function (check, newValue, oldValue, eOptsparams) {
        
        let weightgrid    = this.getWeightgrid(),
            weightproxy   = weightgrid.getStore().getProxy(),
            pressuregrid  = this.getPressuregrid(),
            pressureproxy = pressuregrid.getStore().getProxy(),
            electgrid     = this.getElectgrid(),
            electproxy    = electgrid.getStore().getProxy(),
            topgeogrid    = this.getTopgeogrid(),
            topgeoproxy   = topgeogrid.getStore().getProxy(),
            lengthgrid    = this.getLengthgrid(),
            lengthproxy   = lengthgrid.getStore().getProxy(),
            state         = Ext.getCmp('metrostatecombo').getValue(),
            work          = Ext.getCmp('metroworkscombo').getValue(),
            show_inactive = '';
        
        switch (newValue) {
            case true:
                show_inactive = '/1'
                break;
            default:
                show_inactive = ''
                break;
        }
        
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

        Ext.apply(weightproxy.api, {
            read: '/phnet.calidad/public/api/metrology/weightab/' + work + '/' + state + show_inactive
        });
        weightgrid.getStore().load();

        Ext.apply(pressureproxy.api, {
            read: '/phnet.calidad/public/api/metrology/pressuretab/' + work + '/' + state + show_inactive
        });
        pressuregrid.getStore().load();

        Ext.apply(electproxy.api, {
            read: '/phnet.calidad/public/api/metrology/electab/' + work + '/' + state + show_inactive
        });
        electgrid.getStore().load();

        Ext.apply(topgeoproxy.api, {
            read: '/phnet.calidad/public/api/metrology/topgeotab/' + work + '/' + state + show_inactive
        });
        topgeogrid.getStore().load();

        Ext.apply(lengthproxy.api, {
            read: '/phnet.calidad/public/api/metrology/lengthtab/' + work + '/' + state + show_inactive
        });
        lengthgrid.getStore().load();
    },

    loadMetrology: function (combo, newValue, oldValue, eOptsparams) {
        
        let weightgrid    = this.getWeightgrid(),
            weightproxy   = weightgrid.getStore().getProxy(),
            pressuregrid  = this.getPressuregrid(),
            pressureproxy = pressuregrid.getStore().getProxy(),
            electgrid     = this.getElectgrid(),
            electproxy    = electgrid.getStore().getProxy(),
            topgeogrid    = this.getTopgeogrid(),
            topgeoproxy   = topgeogrid.getStore().getProxy(),
            lengthgrid    = this.getLengthgrid(),
            lengthproxy   = lengthgrid.getStore().getProxy(),
            state         = Ext.getCmp('metrostatecombo').getValue(),
            actives       = Ext.getCmp('metro-show-inactives').getValue();
        
        switch (actives) {
            case true:
                show_inactive = '/1'
                break;
            default:
                show_inactive = ''
                break;
        }
        
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

        Ext.apply(weightproxy.api, {
            read: '/phnet.calidad/public/api/metrology/weightab/' + parseInt(newValue) + '/' + state + show_inactive
        });
        weightgrid.getStore().load();

        Ext.apply(pressureproxy.api, {
            read: '/phnet.calidad/public/api/metrology/pressuretab/' + parseInt(newValue) + '/' + state + show_inactive
        });
        pressuregrid.getStore().load();

        Ext.apply(electproxy.api, {
            read: '/phnet.calidad/public/api/metrology/electab/' + parseInt(newValue) + '/' + state + show_inactive
        });
        electgrid.getStore().load();

        Ext.apply(topgeoproxy.api, {
            read: '/phnet.calidad/public/api/metrology/topgeotab/' + parseInt(newValue) + '/' + state + show_inactive
        });
        topgeogrid.getStore().load();

        Ext.apply(lengthproxy.api, {
            read: '/phnet.calidad/public/api/metrology/lengthtab/' + parseInt(newValue) + '/' + state + show_inactive
        });
        lengthgrid.getStore().load();

        localStorage.setItem('work', newValue);
    },

    loadPlanning: function (combo, newValue, oldValue, eOptsparams) {
        
        let planprojectgrid  = this.getPlanningprojectgrid(),
            planprojectproxy = planprojectgrid.getStore().getProxy(),
            planubphgrid     = this.getPlanningubphgrid(),
            planubphproxy    = planubphgrid.getStore().getProxy(),
            year             = localStorage.getItem('year');

        Ext.apply(planprojectproxy.api, {
            read: '/phnet.calidad/public/api/metro/planproject/' + parseInt(newValue) + '/' + year
        });
        planprojectgrid.getStore().load();

        Ext.apply(planubphproxy.api, {
            read: '/phnet.calidad/public/api/metro/planubph/' + year
        });
        planubphgrid.getStore().load();

        localStorage.setItem('work', newValue);
    },

    loadYearPlanning: function (combo, newValue, oldValue, eOptsparams) {
        
        let projectplanningrid   = this.getPlanningprojectgrid(),
            projectplanningproxy = projectplanningrid.getStore().getProxy(),
            planubphgrid         = this.getPlanningubphgrid(),
            planubphproxy        = planubphgrid.getStore().getProxy(),
            work                 = localStorage.getItem('work'),
            year                 = newValue;
        
        Ext.apply(projectplanningproxy.api, {
            read: '/phnet.calidad/public/api/metro/planproject/' + work + '/' + year
        });
        projectplanningrid.getStore().load({
            callback: function(records, operation, success) {
                projectplanningrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(planubphproxy.api, {
            read: '/phnet.calidad/public/api/metro/planubph/' + year
        });
        planubphgrid.getStore().load({
            callback: function(records, operation, success) {
                planubphgrid.getSelectionModel().deselect(records, true);
            }
        });

        localStorage.setItem('year', newValue);
    },

    loadMetrostate: function (combo, newValue, oldValue, eOptsparams) {
        
        let weightgrid    = this.getWeightgrid(),
            weightproxy   = weightgrid.getStore().getProxy(),
            pressuregrid  = this.getPressuregrid(),
            pressureproxy = pressuregrid.getStore().getProxy(),
            electgrid     = this.getElectgrid(),
            electproxy    = electgrid.getStore().getProxy(),
            topgeogrid    = this.getTopgeogrid(),
            topgeoproxy   = topgeogrid.getStore().getProxy(),
            lengthgrid    = this.getLengthgrid(),
            lengthproxy   = lengthgrid.getStore().getProxy(),
            work          = Ext.getCmp('metroworkscombo').getValue(),
            actives       = Ext.getCmp('metro-show-inactives').getValue();
        
        switch (actives) {
            case true:
                show_inactive = '/1'
                break;
            default:
                show_inactive = ''
                break;
        }
        
        switch (newValue) {
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
        
        Ext.apply(weightproxy.api, {
            read: '/phnet.calidad/public/api/metrology/weightab/' + parseInt(work) + '/' + state + show_inactive
        });
        weightgrid.getStore().load();

        Ext.apply(pressureproxy.api, {
            read: '/phnet.calidad/public/api/metrology/pressuretab/' + parseInt(work) + '/' + state + show_inactive
        });
        pressuregrid.getStore().load();

        Ext.apply(electproxy.api, {
            read: '/phnet.calidad/public/api/metrology/electab/' + parseInt(work) + '/' + state + show_inactive
        });
        electgrid.getStore().load();

        Ext.apply(topgeoproxy.api, {
            read: '/phnet.calidad/public/api/metrology/topgeotab/' + parseInt(work) + '/' + state + show_inactive
        });
        topgeogrid.getStore().load();

        Ext.apply(lengthproxy.api, {
            read: '/phnet.calidad/public/api/metrology/lengthtab/' + parseInt(work) + '/' + state + show_inactive
        });
        lengthgrid.getStore().load();

        localStorage.setItem('metrostate', newValue);
    },
    
    addEquipment: function() {

        let equipmentab = Ext.getCmp('equipmentab'),
            activetab   = equipmentab.getActiveTab().itemId
            grid        = Ext.getCmp(activetab),
            count       = grid.getStore().count(),
            rec         = new PHNet.model.Metrology({
                number: count + 1,
                id: null,
                id_work: '',
                type: '',
                name: '',
                ctdad: 1,
                model: '',
                serie: '',
                precision: '',
                limit: '',
                last_check: '',
                term_check: '',
                plan_date: '',
                real_date: '',
                result_check: '',
                reparation: '',
                reparation_plan: '',
                location: '',
                owner: '',
                comment: ''
            });
        grid.getStore().insert(count, rec);
        grid.plugins[0].startEditByPosition({
            row: count,
            column: 3
        });
    },

    updMetrology: function (record) {
        
        let equipmentab = Ext.getCmp('equipmentab'),
            activetab   = equipmentab.getActiveTab().itemId,
            grid        = Ext.getCmp(activetab),
            id          = record.id,
            field       = record.field,
            rowIdx      = record.rowIdx,
            colIdx      = record.colIdx,
            oldvalue    = record.oldvalue,
            newvalue    = record.newvalue,
            work        = record.workname;
        
        if ((!localStorage.getItem('metrorowclone')) && (oldvalue == newvalue || (oldvalue == null && newvalue == ''))) { return; }
        
        if (id == '' || id == null) {
            // Add Tool Metrology
            Ext.Ajax.request({
                url: '/phnet.calidad/public/api/metrology/add',
                method: 'POST',
                params: {
                    work: work, 
                    field: field,
                    name: record.data.name,
                    ctdad: record.data.ctdad,
                    model: record.data.model,
                    serie: record.data.serie,
                    precision: record.data.precision,
                    limit: record.data.limit,
                    last_check: record.data.last_check,
                    term_check: record.data.term_check,
                    plan_date: record.data.plan_date,
                    real_date: record.data.real_date,
                    result_check: record.data.result_check,
                    reparation: record.data.reparation,
                    next_plan: record.data.next_plan,
                    location: record.data.location,
                    owner: record.data.owner,
                    comment: record.data.comment,
                    activetab: activetab
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
                        localStorage.removeItem('metrorowclone');
                        grid.getStore().load({
                            callback: function(records, operation, success) {
                                if (colIdx < 19) {
                                    let nextfield = colIdx + 1;
                                    grid.plugins[0].startEditByPosition({
                                        row: rowIdx,
                                        column: nextfield
                                    });
                                }
                            }
                        });
                    }
                },
                failure: function() {
                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operaci\xF3n, de continuar el problema consulte al Administrador del Sistema.',
                        buttons: Ext.MessageBox.OK,
                        icon: 'fas fa-exclamation-triangle fa-2x dlg-error'
                    });
                }
            });
        }
        else {
            // Update Tool Metrology
            Ext.Ajax.request({
                url: '/phnet.calidad/public/api/metrology/upd',
                method: 'POST',
                params: {
                    work: work,
                    id: id,
                    field: field, 
                    newvalue: newvalue,
                    activetab: activetab
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
                        if (colIdx < 18) {
                            grid.getStore().load({
                                callback: function(records, operation, success) {
                                    if (colIdx < 19) {
                                        let nextfield = colIdx + 1;
                                        grid.plugins[0].startEditByPosition({
                                            row: rowIdx,
                                            column: nextfield
                                        });
                                    }
                                }
                            });
                        }
                        else {
                            grid.getStore().load();
                        }
                    }
                },
                failure: function() {
                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operaci\xF3n, de continuar el problema consulte al Administrador del Sistema.',
                        buttons: Ext.MessageBox.OK,
                        icon: 'fas fa-exclamation-triangle fa-2x dlg-error'
                    });
                }
            });
        }
    },
    
    deleteMetrology: function(id) {
        
        let equipmentab = Ext.getCmp('equipmentab'),
            activetab   = equipmentab.getActiveTab().itemId
            grid        = Ext.getCmp(activetab);

        Ext.Msg.confirm("Eliminar Instrumento", "Este Instrumento ser\xE1 eliminado definitivamente. Confirma que desea realizar esta operaci\xF3n?", function(btnText) {
            
            if (btnText === "yes") {
                Ext.Ajax.request({ 
                    url: '/phnet.calidad/public/api/metrology/del',
                    method: 'POST',
                    waitTitle: 'Espere',
                    waitMsg: 'Eliminando Instrumento..',
                    params: {id: id},
                    success: function() {
                        grid.getStore().load();
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

    showContextMenu: function(view, record, node, rowIndex, e) {
        
        Ext.destroy(Ext.getCmp('equipmentcontextmenu')); 
        let contextMenu = Ext.create('PHNet.view.metrology.EquipmentContextMenu');
		
        contextMenu.setList(record);
        contextMenu.showAt(e.getX(), e.getY());
        e.preventDefault(); 
    },

    handleMetroRowClone: function () {
        let equipmentab = Ext.getCmp('equipmentab'),
            activetab   = equipmentab.getActiveTab().itemId
            grid        = Ext.getCmp(activetab),
            record      = grid.getSelectionModel().getSelection()[0],
            count       = grid.getStore().count(),
            rec         = new PHNet.model.Metrology({
                number: count + 1,
                id: null,
                id_work: record.data.id_work,
                type: record.data.type,
                name: record.data.name,
                ctdad: record.data.ctdad,
                model: record.data.model,
                serie: record.data.serie,
                precision: record.data.precision,
                limit: record.data.limit,
                last_check: record.data.last_check,
                term_check: record.data.term_check,
                plan_date: record.data.plan_date,
                real_date: record.data.real_date,
                result_check: record.data.result_check,
                reparation: record.data.reparation,
                reparation_plan: record.data.reparation_plan,
                location: record.data.location,
                owner: record.data.owner,
                comment: record.data.comment
            });
        
        grid.getStore().insert(count, rec);
        grid.plugins[0].startEditByPosition({
            row: count,
            column: 3
        });
        localStorage.setItem('metrorowclone', 'true');
    },

    handleMetroRowMove: function () {
        let equipmentab = Ext.getCmp('equipmentab'),
            activetab   = equipmentab.getActiveTab().itemId
            grid        = Ext.getCmp(activetab),
            record      = grid.getSelectionModel().getSelection()[0],
            form        = Ext.create('PHNet.view.metrology.MovetoprojectForm');
        
        Ext.getCmp('metromove-project').setValue(parseInt(record.data.id_work));
        form.show();
    },

    handleMetroHistory: function () {
        let equipmentab  = Ext.getCmp('equipmentab'),
            activetab    = equipmentab.getActiveTab().itemId
            grid         = Ext.getCmp(activetab),
            record       = grid.getSelectionModel().getSelection()[0],
            tool         = record.data.id,
            historyStore = this.getMetrohistoryStore();
        
        if (historyStore.isDestroyed) {
            Ext.create('PHNet.store.Metrohistory');
        };
                        
        let win = Ext.create('PHNet.view.metrology.HistoryWindow', {
                        title: 'Hist&oacute;rico de Operaciones | ' + record.data.name + ' ' + record.data.serie,
                    }),
            historygrid  = this.getHistorygrid(),
            historyproxy = historygrid.getStore().getProxy();
        
        Ext.apply(historyproxy.api, {
            read: '/phnet.calidad/public/api/metrology/history/' + tool
        });

        historygrid.getStore().load({
            callback: function(records, operation, success) {
                historygrid.getSelectionModel().deselect(records, true);
            }
        });

        win.show();
    },

    updMetroMove: function(button) {

        let equipmentab = Ext.getCmp('equipmentab'),
            activetab   = equipmentab.getActiveTab().itemId
            grid        = Ext.getCmp(activetab),
            record      = grid.getSelectionModel().getSelection()[0],
            project     = record.data.id_work,
            win         = button.up('window'),
            form        = win.down('form'),
            values      = form.getValues(),
            newproject  = values.project,
            newowner    = values.owner;

        if (form.isValid()) {

            if (project == newproject) {
                Ext.getCmp('metromove-error').setText('Elija un Proyecto diferente al actual.');
                return false;
            }
            else 
            {
                Ext.getCmp('metromove-btn').setDisabled(false);
                form.getForm().submit({
                    method: 'POST',
                    url: '/phnet.calidad/public/api/metrology/move',
                    params: {
                        id: record.data.id,
                        newproject: newproject,
                        newowner: newowner
                    },
                    waitTitle: 'Espere', //Titulo del mensaje de espera
                    waitMsg: 'Procesando datos...', //Mensaje de espera
                    success: function(form, action) {
                        let data = Ext.decode(action.response.responseText);
                        win.close();
                        grid.getStore().load({
                            callback: function(records, operation, success) {
                                grid.getSelectionModel().deselect(records, true);
                            }
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
        }
    },

    handleMetroActive: function (item) {
        let equipmentab = Ext.getCmp('equipmentab'),
            activetab   = equipmentab.getActiveTab().itemId,
            grid        = Ext.getCmp(activetab),
            record      = grid.getSelectionModel().getSelection()[0],
            active      = parseInt(record.data.active),
            newactive;
        
        switch (active) {
            case 0:
                newactive = 1;
                break;
            default:
                newactive = 0;
                break;
        }
        
        Ext.Ajax.request({ 
            url: '/phnet.calidad/public/api/metrology/activate',
            method: 'POST',
            params: {id: record.data.id, newactive: newactive},
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
    },
    
    handleMetroState: function (item) {
        let equipmentab = Ext.getCmp('equipmentab'),
            activetab   = equipmentab.getActiveTab().itemId,
            grid        = Ext.getCmp(activetab),
            record      = grid.getSelectionModel().getSelection()[0],
            itemstate   = item.id,
            state;
        
        switch (itemstate) {
            case 'metroStateNoDisp':
                state = 'No Disponible/No Apto';
                break;
            case 'metroStateSend':
                state = 'Entregado para calibrar';
                break;
            default:
                state = 'Disponible/Apto';
                break;
        }
        
        Ext.Ajax.request({ 
            url: '/phnet.calidad/public/api/metrology/optstate',
            method: 'POST',
            params: {id: record.data.id, state: state},
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
    },

    photoMetrology: function(record, animtarget) {
        
        let metrophoto = record.data.photo,
            win        = Ext.create('PHNet.view.metrology.EquiphotoWindow', {
                            title: record.data.name,
                            animateTarget: animtarget
                        });

        // Image template
        if (metrophoto == null || metrophoto == '') {
            imgTplMarkup = [
                '<img class="metro-imgview" src="/phnet.calidad/public/dist/img/metrology/nophoto.png">'
            ];
        }
        else {
            imgTplMarkup = [
                '<img class="metro-imgview" src="/phnet.calidad/public/dist/img/metrology/'+ metrophoto +'.jpg">'
            ];
            Ext.getCmp('metroviewbtndel').setDisabled(false);
        }
        let metroviewImgTpl = Ext.create('Ext.Template', imgTplMarkup);
        let imgSelected = Ext.getCmp('metroviewphoto');
        if (imgSelected) {
            imgSelected.update(metroviewImgTpl);
        }

        // Description template
        descTplMarkup = [
            '<h3>' + record.data.name + '</h3><h5>Modelo: ' + record.data.model + '</h5><h6>Especialidad: ' + record.data.type + '</h6>'
        ];
        let metroviewDescTpl = Ext.create('Ext.Template', descTplMarkup),
            descSelected     = Ext.getCmp('metroviewname');
        if (descSelected) {
            descSelected.update(metroviewDescTpl);
        }

        localStorage.setItem('metroviewImg', record.data.id);
        win.show();
    },
    
    metroImageViewUpdate: function(view, record, item, index, e) {
        
        let bookTplMarkup = [
            '<img src="/phnet.calidad/public/dist/img/metrology/'+ record.data.src +'.jpg">'
        ];
        let bookTpl = Ext.create('Ext.Template', bookTplMarkup);
        let imgSelected = Ext.getCmp('metroviewphoto');
        if (imgSelected) {
            imgSelected.update(bookTpl);
        }

        localStorage.setItem('metroviewImgSrc', record.data.src);
        Ext.getCmp('metroviewbtn').setDisabled(false);
    },

    setMetroImg: function() {

        let equipmentab = Ext.getCmp('equipmentab'),
            activetab   = equipmentab.getActiveTab().itemId,
            grid        = Ext.getCmp(activetab),
            id          = localStorage.getItem('metroviewImg'),
            photo       = localStorage.getItem('metroviewImgSrc');
        
        Ext.getCmp('metroviewbtn').setText('<i class="fas fa-spinner fa-pulse"></i> <font style="text-transform: none">Procesando...</font>');

        Ext.Ajax.request({ 
            url: '/phnet.calidad/public/api/metrology/setphoto',
            method: 'POST',
            params: {id: id, photo: photo},
            success: function() {
                Ext.getCmp('metroviewbtndel').setDisabled(false);
                grid.getStore().load({
                    callback: function(records, operation, success) {
                        grid.getSelectionModel().deselect(records, true);
                        Ext.getCmp('metroviewbtn').setText('Seleccionar Foto');
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

    delMetroImg: function() {

        let equipmentab = Ext.getCmp('equipmentab'),
            activetab   = equipmentab.getActiveTab().itemId,
            grid        = Ext.getCmp(activetab),
            id          = localStorage.getItem('metroviewImg');
        
        Ext.getCmp('metroviewbtndel').setText('<i class="fas fa-spinner fa-pulse"></i> <font style="text-transform: none">Procesando...</font>');

        Ext.Ajax.request({ 
            url: '/phnet.calidad/public/api/metrology/delphoto',
            method: 'POST',
            params: {id: id},
            success: function() {
                let bookTplMarkup = [
                    '<img src="/phnet.calidad/public/dist/img/metrology/nophoto.png">'
                ];
                let bookTpl = Ext.create('Ext.Template', bookTplMarkup);
                let imgSelected = Ext.getCmp('metroviewphoto');
                if (imgSelected) {
                    imgSelected.update(bookTpl);
                }
                Ext.getCmp('metroviewbtndel').setDisabled(true);
                $('.thumb-wrap').removeClass('x-item-selected');
                grid.getStore().load({
                    callback: function(records, operation, success) {
                        grid.getSelectionModel().deselect(records, true);
                        Ext.getCmp('metroviewbtndel').setText('Quitar Foto');
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

    metroExpCurrent: function() {
        
        let work  = this.getWorkscombo().getValue(),
            state = this.getMetrostatecombo().getValue();

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
        let formpdf = Ext.create('Ext.form.Panel', {items: [
                            { xtype: 'hiddenfield', name: 'work', value: work},
                            { xtype: 'hiddenfield', name: 'state', value: state}
                        ]});
        
        formpdf.getForm().doAction('standardsubmit',{
            url: '/phnet.calidad/public/api/metrology/pdf/current',
            standardSubmit: true,
            scope: this,
            method: 'GET',
            waitTitle: '<i class="fas fa-cog fa-spin text-white"></i>&nbsp;Creando PDF...',
            waitMsg: '<i class="fas fa-file-pdf icon-red icon-pdf-msg"></i>Por favor, espere mientras se genera el documento.&nbsp;&nbsp;',
            success: function(form, action) {
                formpdf.destroy();//or destroy();
            }
        });
        Ext.defer(function() {
            Ext.MessageBox.hide();
        }, 10000);
    },

    metroExpAll: function() {
        let state = this.getMetrostatecombo().getValue();
        
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
        let formpdf = Ext.create('Ext.form.Panel', {items: [
                            { xtype: 'hiddenfield', name: 'state', value: state}
                        ]});
        
        formpdf.getForm().doAction('standardsubmit',{
            url: '/phnet.calidad/public/api/metrology/pdf/all',
            standardSubmit: true,
            scope: this,
            method: 'GET',
            waitTitle: '<i class="fas fa-cog fa-spin text-white"></i>&nbsp;Creando PDF...',
            waitMsg: '<i class="fas fa-file-pdf icon-red icon-pdf-msg"></i>Por favor, espere mientras se genera el documento.&nbsp;&nbsp;',
            success: function(form, action) {
                formpdf.destroy();//or destroy();
            }
        });
        Ext.defer(function() {
            Ext.MessageBox.hide();
        }, 10000);
    },

    metroExpBook: function() {
        let state = this.getMetrostatecombo().getValue(),
            work  = parseInt(Ext.getCmp('metroworkscombo').getValue());
        
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
        let formpdf = Ext.create('Ext.form.Panel', {items: [
                            { xtype: 'hiddenfield', name: 'state', value: state},
                            { xtype: 'hiddenfield', name: 'work', value: work}
                        ]});
        
        formpdf.getForm().doAction('standardsubmit',{
            url: '/phnet.calidad/public/api/metrology/pdf/book',
            standardSubmit: true,
            scope: this,
            method: 'GET',
            waitTitle: '<i class="fas fa-cog fa-spin text-white"></i>&nbsp;Creando PDF...',
            waitMsg: '<i class="fas fa-file-pdf icon-red icon-pdf-msg"></i>Por favor, espere mientras se genera el documento.&nbsp;&nbsp;',
            success: function(form, action) {
                formpdf.destroy();//or destroy();
            }
        });
        Ext.defer(function() {
            Ext.MessageBox.hide();
        }, 10000);
    },

    metroSearchForm: function(){

        let metrosearch = Ext.create('PHNet.view.metrology.MetroSearch');
        metrosearch.show();
        Ext.getCmp('metrosearch_serial').focus(false, 300);
    },

    loadMetroSearch: function(field, e) {
        // e.HOME, e.END, e.PAGE_UP, e.PAGE_DOWN,
        // e.TAB, e.ESC, arrow keys: e.LEFT, e.RIGHT, e.UP, e.DOWN
        if (e.getKey() == e.ENTER) {
            let win    = this.getMetrosearch(),
                form   = win.down('form'),
                values = form.getValues(),
                serie  = values.searchtext;

            if (form.isValid()) {

                Ext.getCmp('metrosearch_serial').setVisible(false);
                Ext.getCmp('box-search-desc').setVisible(false);
                Ext.getCmp('box-search-msg').setVisible(false);
                Ext.getCmp('box-search-loading').setVisible(true);

                form.getForm().submit({
                    method: 'POST',
                    url: '/phnet.calidad/public/api/metrology/search',
                    params: {
                        serie: serie
                    },
                    success: function(form, action) {
                        let data = Ext.decode(action.response.responseText);
                        Ext.getCmp('metroworkscombo').setValue(parseInt(data.id_work));
                        
                        switch (data.type) {
                            case 'Longitud':
                                setactive = 'lengthtab'
                                break;
                            case 'Presión':
                                setactive = 'pressuretab'
                                break;
                            case 'Magnitudes Eléctricas':
                                setactive = 'electab'
                                break;
                            case 'Topografía y Geodesia':
                                setactive = 'topgeotab'
                                break;
                            default:
                                setactive = 'weightab'
                                break;
                        }
                        
                        let equipmentab = Ext.getCmp('equipmentab');
                        
                        if (equipmentab.setActiveTab(setactive)) {
                            win.close();
                        }
                    },
                    failure: function(form, action) {
                        Ext.getCmp('metrosearch_serial').setVisible(true);
                        Ext.getCmp('box-search-loading').setVisible(false);
                        Ext.getCmp('box-search-msg').setVisible(true);
                        Ext.getCmp('metrosearch_serial').focus(false, 300);
                    }
                });
            }
        }
    },

    printPlanning: function() {
        
        let planningtab = this.getPlanningtab(),
            activetab   = planningtab.getActiveTab().itemId,
            year        = localStorage.getItem('year');

        if (activetab == 'metroplanubphtab') {
            let formpdf = Ext.create('Ext.form.Panel', {items: [
                { xtype: 'hiddenfield', name: 'year', value: year }
            ]});

            formpdf.getForm().doAction('standardsubmit',{
                url: '/phnet.calidad/public/api/metro/planning/ubph/pdf',
                standardSubmit: true,
                scope: this,
                method: 'GET',
                waitTitle: '<i class="fas fa-cog fa-spin text-white"></i>&nbsp;Creando PDF...',
                waitMsg: '<i class="fas fa-file-pdf icon-red icon-pdf-msg"></i>Por favor, espere mientras se genera el documento.&nbsp;&nbsp;',
                success: function(form, action) {
                    formpdf.destroy(); //or destroy();
                }
            });
        }
        else {
            let project = Ext.getCmp('planningworkscombo').getValue(),
                formpdf = Ext.create('Ext.form.Panel', {items: [
                    { xtype: 'hiddenfield', name: 'project', value: project},
                    { xtype: 'hiddenfield', name: 'year', value: year}
                ]});

            formpdf.getForm().doAction('standardsubmit',{
                url: '/phnet.calidad/public/api/metro/planning/project/pdf',
                standardSubmit: true,
                scope: this,
                method: 'GET',
                waitTitle: '<i class="fas fa-cog fa-spin text-white"></i>&nbsp;Creando PDF...',
                waitMsg: '<i class="fas fa-file-pdf icon-red icon-pdf-msg"></i>Por favor, espere mientras se genera el documento.&nbsp;&nbsp;',
                success: function(form, action) {
                    formpdf.destroy(); //or destroy();
                }
            });
        }
        
        Ext.defer(function() {
            Ext.MessageBox.hide();
        }, 10000);
    },

    syncPlanningForm: function(){

        Ext.MessageBox.show({
            id: 'syncplanningbox',
            animateTarget: 'btn-metrosyncplanning',
            title: 'Sincronizar Plan de Calibración del Año Actual',
            msg: 'Esta operación realizará los cambios necesarios en las fechas de Calibración de todos los instrumentos registrados en el sistema. Por favor, confirme que desea realizar esta operación.',
            buttons: Ext.MessageBox.OKCANCEL,
            fn: this.setPlanningSync,
            icon: 'fas fa-exclamation-triangle fa-2x dlg-warning'
        });
    },

    setPlanningSync: function(btn){
        
        Ext.MessageBox.remove('syncplanningbox');
        
        if (btn == 'ok') {
            
            Ext.getCmp('btn-metrosyncplanning').setIconCls('fas fa-spinner fa-pulse icon-blue').setDisabled(true);

            Ext.Ajax.request({ 
                url: '/phnet.calidad/public/api/metrology/syncplanning/' + localStorage.getItem('userid'),
                method: 'GET',
                success: function() {
                    Ext.getCmp('btn-metrosyncplanning').setIconCls('fas fa-calendar-alt icon-blue').setDisabled(false);
                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Se ha Sincronizado el Plan de Calibración de la UBPH satisfactoriamente.',
                        buttons: Ext.MessageBox.OK,
                        icon: 'fas fa-exclamation-triangle fa-2x dlg-info'
                    });
                },
                failure: function() {
                    Ext.getCmp('btn-metrosyncplanning').setIconCls('fas fa-calendar-alt icon-blue').setDisabled(false);
                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operacion, de continuar el problema consulte al Administrador del Sistema.',
                        buttons: Ext.MessageBox.OK,
                        icon: 'fas fa-exclamation-triangle fa-2x dlg-error'
                    });
                }
            });
        }
        else {            
            return false;
        }
    }
})