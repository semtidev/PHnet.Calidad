Ext.define('PHNet.controller.Satisfaction', {
    extend: 'Ext.app.Controller',
    models: ['Pollfeed', 'Pollhost', 'Pollequip', 'Pollbrigades', 'Pollpersonaltransp', 'Pollfreightransp', 'Pollcomment', 'Pollissue', 'Pollissuescombo', 'Extpolls'],
    stores: ['Pollfeed', 'Pollhost', 'Pollequip', 'Pollbrigades', 'Pollpersonaltransp', 'Pollfreightransp', 'Pollcomment', 'Pollissue', 'Pollissuescombo', 'Extpolls'],
    views: [
        'app.WorksCombo',
        'app.Monthcombo',
        'app.Yearcombo',
        'satisfaction.IntcustomersWindow',
        'satisfaction.IntcustomersTab',
        'satisfaction.PollfeedGrid',
        'satisfaction.PollhostGrid',
        'satisfaction.PollequipGrid',
        'satisfaction.PollbrigadesGrid',
        'satisfaction.PollpersonaltranspGrid',
        'satisfaction.PollfreightranspGrid',
        'satisfaction.PollcommentWindow',
        'satisfaction.PollcommentGrid',
        'satisfaction.PollissueGrid',
        'satisfaction.PollissuesCombo',
        'satisfaction.ExtcustomersWindow',
        'satisfaction.ExtcustomersTab',
        'satisfaction.ExtpollGrid',
        'satisfaction.ExtpollForm',
        'app.DepartmentsCombo',
        'app.SpecialitiesCombo'
    ],
    refs: [{
            ref: 'workscombo',
            selector: 'workscombo'
        },
        {
            ref: 'intcustomerstab',
            selector: 'intcustomerstab'
        },
        {
            ref: 'pollfeedgrid',
            selector: 'pollfeedgrid'
        },
        {
            ref: 'pollhostgrid',
            selector: 'pollhostgrid'
        },
        {
            ref: 'pollequipgrid',
            selector: 'pollequipgrid'
        },
        {
            ref: 'pollbrigadesgrid',
            selector: 'pollbrigadesgrid'
        },
        {
            ref: 'pollpersonaltranspgrid',
            selector: 'pollpersonaltranspgrid'
        },
        {
            ref: 'pollfreightranspgrid',
            selector: 'pollfreightranspgrid'
        },
        {
            ref: 'pollcommentwindow',
            selector: 'pollcommentwindow'
        },
        {
            ref: 'pollcommentgrid',
            selector: 'pollcommentgrid'
        },
        {
            ref: 'commentypewindow',
            selector: 'commentypewindow'
        },
        {
            ref: 'pollissuegrid',
            selector: 'pollissuegrid'
        },
        {
            ref: 'pollissuescombo',
            selector: 'pollissuescombo'
        },
        {
            ref: 'extcustomerswindow',
            selector: 'extcustomerswindow'
        },
        {
            ref: 'extcustomerstab',
            selector: 'extcustomerstab'
        },
        {
            ref: 'extpollgrid',
            selector: 'extpollgrid'
        },
        {
            ref: 'extpollform',
            selector: 'extpollform'
        }
    ],
    init: function() {

        this.control({
            'pollfeedgrid': {
                recordedit: this.updPoll,
                deleteclick: this.delPoll
            },
            'pollhostgrid': {
                recordedit: this.updPoll,
                deleteclick: this.delPoll
            },
            'pollequipgrid': {
                recordedit: this.updPoll,
                deleteclick: this.delPoll
            },
            'pollbrigadesgrid': {
                recordedit: this.updPoll,
                deleteclick: this.delPoll
            },
            'pollpersonaltranspgrid': {
                recordedit: this.updPoll,
                deleteclick: this.delPoll
            },
            'pollfreightranspgrid': {
                recordedit: this.updPoll,
                deleteclick: this.delPoll
            },
            'pollcommentgrid': {
                recordedit: this.updPollcomment,
                deleteclick: this.delPollcomment
            },
            'intcustomerstab button[action=add]': {
                click: this.addPoll
            },
            'intcustomerstab button[action=comments]': {
                click: this.commentsWindow
            },
            'commentypewindow button[action=comments]': {
                click: this.commentypeWindow
            },
            'intcustomerstab button[action=reload]': {
                click: this.reloadIntcustomers
            },
            'extcustomerstab button[action=reload]': {
                click: this.reloadExtcustomers
            },
            'intcustomerstab': {
                beforerender: this.loadIntcustomersTab,
                tabchange: this.loadIntcustomersTab
            },
            'intcustomerstab menu[lid=intpollExportMenu] menuitem[lid=intpollExpCurrent]': {
                click: this.intpollExpCurrent
            },
            'intcustomerstab menu[lid=intpollExportMenu] menuitem[lid=intpollExpAll]': {
                click: this.intpollExpAll
            },
            '#intcustomersworkscombo': {
                change: this.loadWorkIntcustomers
            },
            '#intcustomersmonthcombo': {
                change: this.loadMonthIntcustomers
            },
            '#intcustomersyearcombo': {
                change: this.loadYearIntcustomers
            },
            '#extcustomersworkscombo': {
                change: this.loadWorkExtcustomers
            },
            '#extcustomersmonthcombo': {
                change: this.loadMonthExtcustomers
            },
            '#extcustomersyearcombo': {
                change: this.loadYearExtcustomers
            },
            'extcustomerstab button[action=add]': {
                click: this.addPollForm
            },
            'extcustomerstab button[action=alldelete]': {
                click: this.alldeleteExtPoll
            },
            'extcustomerstab button[action=import]': {
                click: this.importPollForm
            },
            'importform button[action=import]': {
                click: this.importActivities
            },
            '#extpollform_department': {
                change: this.loadDptSpecialities
            },
            'extpollform': {
                store: this.updExtPoll
            },
            'extpollform button[action=store]': {
                click: this.updExtPoll
            },
            'extpollform button[action=storeclose]': {
                click: this.updExtPoll
            },
            'extpollgrid dataview': {
                itemdblclick: this.loadFormExtpoll
            },
            'extpollgrid': {
                deleteclick: this.delExtPoll
            },
            'extcustomerstab menu[lid=extpollExportMenu] menuitem[lid=extpollExpProject]': {
                click: this.extpollExpProject
            },
            'extcustomerstab menu[lid=extpollExportMenu] menuitem[lid=extpollExpCert]': {
                click: this.extpollExpCert
            },
            'extcustomerstab menu[lid=extpollExportMenu] menuitem[lid=extpollExpModel]': {
                click: this.extpollExpModel
            }
        });
    },

    loadIntcustomersTab: function(tabPanel) {

        let equipmentab = this.getIntcustomerstab(),
            activetab = equipmentab.getActiveTab().itemId;

        switch (activetab) {
            case 'intcfeedtab':
                service = 'Alimentaci&oacute;n';
                type = 'feed';
                break;
            case 'intchostab':
                service = 'Alojamiento';
                type = 'host';
                break;
            case 'intcequiptab':
                service = 'Equipos y Talleres';
                type = 'equip';
                break;
            case 'intcbrigadestab':
                service = 'Jefes de Brigadas';
                type = 'brigades';
                break;
            case 'intcpersonaltransptab':
                service = 'Transporte de Personal';
                type = 'personaltransp';
                break;
            case 'intcfreightransptab':
                service = 'Transporte de Carga';
                type = 'freightransp';
                break;
        }

        localStorage.setItem('polltype', type);
        localStorage.setItem('pollservice', service);
    },

    reloadIntcustomers: function() {

        let intcustomerstab = this.getIntcustomerstab(),
            activetab = intcustomerstab.getActiveTab().itemId,
            work = parseInt(localStorage.getItem('work')),
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year');

        if (activetab == 'intcfeedtab') {
            let intcustomerfeedgrid = this.getPollfeedgrid(),
                intcustomerfeedproxy = intcustomerfeedgrid.getStore().getProxy();
            Ext.apply(intcustomerfeedproxy.api, {
                read: '/phnet.calidad/public/api/poll/feed/' + work + '/' + month + '/' + year
            });
            intcustomerfeedgrid.getStore().load({
                callback: function(records, operation, success) {
                    intcustomerfeedgrid.getSelectionModel().deselect(records, true);
                }
            });
        } else if (activetab == 'intchostab') {
            let intcustomerhostgrid = this.getPollhostgrid(),
                intcustomerhostproxy = intcustomerhostgrid.getStore().getProxy();
            Ext.apply(intcustomerhostproxy.api, {
                read: '/phnet.calidad/public/api/poll/host/' + work + '/' + month + '/' + year
            });
            intcustomerhostgrid.getStore().load({
                callback: function(records, operation, success) {
                    intcustomerhostgrid.getSelectionModel().deselect(records, true);
                }
            });
        } else if (activetab == 'intcequiptab') {
            let intcustomerequipgrid = this.getPollequipgrid(),
                intcustomerequipproxy = intcustomerequipgrid.getStore().getProxy();
            Ext.apply(intcustomerequipproxy.api, {
                read: '/phnet.calidad/public/api/poll/equip/' + work + '/' + month + '/' + year
            });
            intcustomerequipgrid.getStore().load({
                callback: function(records, operation, success) {
                    intcustomerequipgrid.getSelectionModel().deselect(records, true);
                }
            });
        } else if (activetab == 'intcbrigadestab') {
            let intcustomerbrigadesgrid = this.getPollbrigadesgrid(),
                intcustomerbrigadesproxy = intcustomerbrigadesgrid.getStore().getProxy();
            Ext.apply(intcustomerbrigadesproxy.api, {
                read: '/phnet.calidad/public/api/poll/brigades/' + work + '/' + month + '/' + year
            });
            intcustomerbrigadesgrid.getStore().load({
                callback: function(records, operation, success) {
                    intcustomerbrigadesgrid.getSelectionModel().deselect(records, true);
                }
            });
        } else if (activetab == 'intcpersonaltransptab') {
            let intcustomerpersonaltranspgrid = this.getPollpersonaltranspgrid(),
                intcustomerpersonaltranspproxy = intcustomerpersonaltranspgrid.getStore().getProxy();
            Ext.apply(intcustomerpersonaltranspproxy.api, {
                read: '/phnet.calidad/public/api/poll/personaltransp/' + work + '/' + month + '/' + year
            });
            intcustomerpersonaltranspgrid.getStore().load({
                callback: function(records, operation, success) {
                    intcustomerpersonaltranspgrid.getSelectionModel().deselect(records, true);
                }
            });
        } else if (activetab == 'intcfreightransptab') {
            let intcustomerfreightranspgrid = this.getPollfreightranspgrid(),
                intcustomerfreightranspproxy = intcustomerfreightranspgrid.getStore().getProxy();
            Ext.apply(intcustomerfreightranspproxy.api, {
                read: '/phnet.calidad/public/api/poll/freightransp/' + work + '/' + month + '/' + year
            });
            intcustomerfreightranspgrid.getStore().load({
                callback: function(records, operation, success) {
                    intcustomerfreightranspgrid.getSelectionModel().deselect(records, true);
                }
            });
        }
    },

    reloadExtcustomers: function() {

        let work = parseInt(localStorage.getItem('work')),
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year'),
            extcustomergrid = this.getExtpollgrid(),
            extcustomerproxy = extcustomergrid.getStore().getProxy();

        Ext.apply(extcustomerproxy.api, {
            read: '/phnet.calidad/public/api/extpolls/' + work + '/' + month + '/' + year
        });
        extcustomergrid.getStore().load({
            callback: function(records, operation, success) {
                extcustomergrid.getSelectionModel().deselect(records, true);
            }
        });
    },

    loadWorkIntcustomers: function(combo, newValue, oldValue, eOptsparams) {

        let feedgrid = this.getPollfeedgrid(),
            feedproxy = feedgrid.getStore().getProxy(),
            hostgrid = this.getPollhostgrid(),
            hostproxy = hostgrid.getStore().getProxy(),
            equipgrid = this.getPollequipgrid(),
            equipproxy = equipgrid.getStore().getProxy(),
            brigadesgrid = this.getPollbrigadesgrid(),
            brigadesproxy = brigadesgrid.getStore().getProxy(),
            personaltranspgrid = this.getPollpersonaltranspgrid(),
            personaltranspproxy = personaltranspgrid.getStore().getProxy(),
            freightranspgrid = this.getPollfreightranspgrid(),
            freightranspproxy = freightranspgrid.getStore().getProxy(),
            work = newValue,
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year');

        Ext.apply(feedproxy.api, {
            read: '/phnet.calidad/public/api/poll/feed/' + work + '/' + month + '/' + year
        });
        feedgrid.getStore().load({
            callback: function(records, operation, success) {
                feedgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(hostproxy.api, {
            read: '/phnet.calidad/public/api/poll/host/' + work + '/' + month + '/' + year
        });
        hostgrid.getStore().load({
            callback: function(records, operation, success) {
                hostgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(equipproxy.api, {
            read: '/phnet.calidad/public/api/poll/equip/' + work + '/' + month + '/' + year
        });
        equipgrid.getStore().load({
            callback: function(records, operation, success) {
                equipgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(brigadesproxy.api, {
            read: '/phnet.calidad/public/api/poll/brigades/' + work + '/' + month + '/' + year
        });
        brigadesgrid.getStore().load({
            callback: function(records, operation, success) {
                brigadesgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(personaltranspproxy.api, {
            read: '/phnet.calidad/public/api/poll/personaltransp/' + work + '/' + month + '/' + year
        });
        personaltranspgrid.getStore().load({
            callback: function(records, operation, success) {
                personaltranspgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(freightranspproxy.api, {
            read: '/phnet.calidad/public/api/poll/freightransp/' + work + '/' + month + '/' + year
        });
        freightranspgrid.getStore().load({
            callback: function(records, operation, success) {
                freightranspgrid.getSelectionModel().deselect(records, true);
            }
        });

        localStorage.setItem('work', newValue);
    },

    loadWorkExtcustomers: function(combo, newValue, oldValue, eOptsparams) {

        let extcustomergrid = this.getExtpollgrid(),
            extcustomerproxy = extcustomergrid.getStore().getProxy(),
            work = newValue,
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year');

        Ext.apply(extcustomerproxy.api, {
            read: '/phnet.calidad/public/api/extpolls/' + work + '/' + month + '/' + year
        });
        extcustomergrid.getStore().load({
            callback: function(records, operation, success) {
                extcustomergrid.getSelectionModel().deselect(records, true);
            }
        });

        localStorage.setItem('work', newValue);
    },

    loadMonthIntcustomers: function(combo, newValue, oldValue, eOptsparams) {

        let feedgrid = this.getPollfeedgrid(),
            feedproxy = feedgrid.getStore().getProxy(),
            hostgrid = this.getPollhostgrid(),
            hostproxy = hostgrid.getStore().getProxy(),
            equipgrid = this.getPollequipgrid(),
            equipproxy = equipgrid.getStore().getProxy(),
            brigadesgrid = this.getPollbrigadesgrid(),
            brigadesproxy = brigadesgrid.getStore().getProxy(),
            personaltranspgrid = this.getPollpersonaltranspgrid(),
            personaltranspproxy = personaltranspgrid.getStore().getProxy(),
            freightranspgrid = this.getPollfreightranspgrid(),
            freightranspproxy = freightranspgrid.getStore().getProxy(),
            work = localStorage.getItem('work'),
            month = newValue,
            year = localStorage.getItem('year');

        Ext.apply(feedproxy.api, {
            read: '/phnet.calidad/public/api/poll/feed/' + work + '/' + month + '/' + year
        });
        feedgrid.getStore().load({
            callback: function(records, operation, success) {
                feedgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(hostproxy.api, {
            read: '/phnet.calidad/public/api/poll/host/' + work + '/' + month + '/' + year
        });
        hostgrid.getStore().load({
            callback: function(records, operation, success) {
                hostgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(equipproxy.api, {
            read: '/phnet.calidad/public/api/poll/equip/' + work + '/' + month + '/' + year
        });
        equipgrid.getStore().load({
            callback: function(records, operation, success) {
                equipgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(brigadesproxy.api, {
            read: '/phnet.calidad/public/api/poll/brigades/' + work + '/' + month + '/' + year
        });
        brigadesgrid.getStore().load({
            callback: function(records, operation, success) {
                brigadesgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(personaltranspproxy.api, {
            read: '/phnet.calidad/public/api/poll/personaltransp/' + work + '/' + month + '/' + year
        });
        personaltranspgrid.getStore().load({
            callback: function(records, operation, success) {
                personaltranspgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(freightranspproxy.api, {
            read: '/phnet.calidad/public/api/poll/freightransp/' + work + '/' + month + '/' + year
        });
        freightranspgrid.getStore().load({
            callback: function(records, operation, success) {
                freightranspgrid.getSelectionModel().deselect(records, true);
            }
        });

        localStorage.setItem('month', newValue);
    },

    loadMonthExtcustomers: function(combo, newValue, oldValue, eOptsparams) {

        let extcustomergrid = this.getExtpollgrid(),
            extcustomerproxy = extcustomergrid.getStore().getProxy(),
            work = localStorage.getItem('work'),
            month = newValue,
            year = localStorage.getItem('year');

        Ext.apply(extcustomerproxy.api, {
            read: '/phnet.calidad/public/api/extpolls/' + work + '/' + month + '/' + year
        });
        extcustomergrid.getStore().load({
            callback: function(records, operation, success) {
                extcustomergrid.getSelectionModel().deselect(records, true);
            }
        });

        localStorage.setItem('month', newValue);
    },

    loadYearIntcustomers: function(combo, newValue, oldValue, eOptsparams) {

        let feedgrid = this.getPollfeedgrid(),
            feedproxy = feedgrid.getStore().getProxy(),
            hostgrid = this.getPollhostgrid(),
            hostproxy = hostgrid.getStore().getProxy(),
            equipgrid = this.getPollequipgrid(),
            equipproxy = equipgrid.getStore().getProxy(),
            brigadesgrid = this.getPollbrigadesgrid(),
            brigadesproxy = brigadesgrid.getStore().getProxy(),
            personaltranspgrid = this.getPollpersonaltranspgrid(),
            personaltranspproxy = personaltranspgrid.getStore().getProxy(),
            freightranspgrid = this.getPollfreightranspgrid(),
            freightranspproxy = freightranspgrid.getStore().getProxy(),
            work = localStorage.getItem('work'),
            month = localStorage.getItem('month'),
            year = newValue;

        Ext.apply(feedproxy.api, {
            read: '/phnet.calidad/public/api/poll/feed/' + work + '/' + month + '/' + year
        });
        feedgrid.getStore().load({
            callback: function(records, operation, success) {
                feedgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(hostproxy.api, {
            read: '/phnet.calidad/public/api/poll/host/' + work + '/' + month + '/' + year
        });
        hostgrid.getStore().load({
            callback: function(records, operation, success) {
                hostgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(equipproxy.api, {
            read: '/phnet.calidad/public/api/poll/equip/' + work + '/' + month + '/' + year
        });
        equipgrid.getStore().load({
            callback: function(records, operation, success) {
                equipgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(brigadesproxy.api, {
            read: '/phnet.calidad/public/api/poll/brigades/' + work + '/' + month + '/' + year
        });
        brigadesgrid.getStore().load({
            callback: function(records, operation, success) {
                brigadesgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(personaltranspproxy.api, {
            read: '/phnet.calidad/public/api/poll/personaltransp/' + work + '/' + month + '/' + year
        });
        personaltranspgrid.getStore().load({
            callback: function(records, operation, success) {
                personaltranspgrid.getSelectionModel().deselect(records, true);
            }
        });

        Ext.apply(freightranspproxy.api, {
            read: '/phnet.calidad/public/api/poll/freightransp/' + work + '/' + month + '/' + year
        });
        freightranspgrid.getStore().load({
            callback: function(records, operation, success) {
                freightranspgrid.getSelectionModel().deselect(records, true);
            }
        });

        localStorage.setItem('year', newValue);
    },

    loadYearExtcustomers: function(combo, newValue, oldValue, eOptsparams) {

        let extcustomergrid = this.getExtpollgrid(),
            extcustomerproxy = extcustomergrid.getStore().getProxy(),
            work = localStorage.getItem('work'),
            month = localStorage.getItem('month'),
            year = newValue;

        Ext.apply(extcustomerproxy.api, {
            read: '/phnet.calidad/public/api/extpolls/' + work + '/' + month + '/' + year
        });
        extcustomergrid.getStore().load({
            callback: function(records, operation, success) {
                extcustomergrid.getSelectionModel().deselect(records, true);
            }
        });

        localStorage.setItem('year', newValue);
    },

    loadDptSpecialities: function(combo, newValue, oldValue, eOptsparams) {

        let specialitiescombo = Ext.getCmp('extpollform_speciality'),
            specialitiesproxy = specialitiescombo.getStore().getProxy(),
            department = newValue;

        Ext.apply(specialitiesproxy.api, {
            read: '/phnet.calidad/public/api/specialities/' + department
        });
        specialitiescombo.getStore().load({
            callback: function(records, operation, success) {
                let first = specialitiescombo.getStore().getAt(0).data.id;
                if (localStorage.getItem('speciality')) {
                    let select = specialitiescombo.getStore().findExact('id', parseInt(localStorage.getItem('speciality')));
                    if (select != -1) {
                        specialitiescombo.setValue(specialitiescombo.getStore().getAt(select).data.id);
                    } else {
                        specialitiescombo.setValue(first);
                    }
                } else {
                    specialitiescombo.setValue(first);
                }
            }
        });
        localStorage.setItem('department', department);
    },

    addPoll: function() {

        let intcustomerstab = this.getIntcustomerstab(),
            activetab = intcustomerstab.getActiveTab().itemId,
            grid = Ext.getCmp(activetab),
            count = grid.getStore().count(),
            lastpoll_number = 0,
            rec;

        if (count > 0) {
            count = count - 1;
            lastpoll_number = grid.getStore().getAt(count - 1).data.number;
        }

        let number = parseInt(lastpoll_number) + 1;

        if (activetab == 'intcequiptab') {
            rec = new PHNet.model.Pollequip({
                id: null,
                number: number,
                q1: 5,
                q2: 5,
                q3: 5,
                q4: 5,
                q5: 5,
                sum: 25,
                prom: 5
            });
        } else if (activetab == 'intcfeedtab') {
            rec = new PHNet.model.Pollfeed({
                id: null,
                number: number,
                q1: 5,
                q2: 5,
                q3: 5,
                q4: 5,
                q5: 5,
                q6: 5,
                sum: 30,
                prom: 5
            });
        } else {
            rec = new PHNet.model.Pollhost({
                id: null,
                number: number,
                q1: 5,
                q2: 5,
                q3: 5,
                q4: 5,
                q5: 5,
                q6: 5,
                q7: 5,
                q8: 5,
                sum: 40,
                prom: 5
            });
        }

        grid.getStore().insert(count, rec);
        grid.plugins[0].startEditByPosition({
            row: count,
            column: 2
        });
    },

    addPollForm: function() {

        let pollForm = Ext.create('PHNet.view.satisfaction.ExtpollForm');
        pollForm.show();
        Ext.getCmp('extpollform_activity').focus(false, 300);
    },

    importPollForm: function() {

        let pollForm = Ext.create('PHNet.view.satisfaction.ImportForm');
        pollForm.show();
    },

    importActivities: function(button) {

        let grid = this.getExtpollgrid(),
            win = button.up('window'),
            form = win.down('form'),
            values = form.getValues(),
            excel_doc = values.excel_doc,
            work = localStorage.getItem('work'),
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year');

        if (form.isValid()) {

            Ext.getCmp('importform-okbtn').setDisabled(true);
            Ext.getCmp('importform-cancelbtn').setDisabled(true);

            form.getForm().submit({
                method: 'POST',
                url: '/phnet.calidad/public/api/extpoll/activity/import',
                params: {
                    excel_doc: excel_doc,
                    work: work,
                    month: month,
                    year: year
                },
                waitTitle: 'Espere', //Titulo del mensaje de espera
                waitMsg: 'Importando...', //Mensaje de espera
                success: function(form, action) {
                    let data = Ext.decode(action.response.responseText);
                    console.log(data);
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
                    Ext.getCmp('importform-okbtn').setDisabled(false);
                    Ext.getCmp('importform-cancelbtn').setDisabled(false);
                }
            });
        }
    },

    loadFormExtpoll: function() {

        if (!localStorage.getItem('userrol')) {
            return false;
        } else {
            let grid = this.getExtpollgrid(),
                record = grid.getSelectionModel().getSelection()[0],
                id_poll = record.get('id');

            if (id_poll == null) {
                return false;
            } else {

                localStorage.setItem('speciality', record.get('id_speciality'));

                let editor = Ext.create('PHNet.view.satisfaction.ExtpollForm'),
                    form = editor.down('form');

                editor.setTitle('Modificar Actividad');
                editor.show();

                form.getForm().load({
                    url: '/phnet.calidad/public/api/extpoll/loadForm',
                    method: 'POST',
                    params: {
                        id_poll: id_poll
                    },
                    success: function(form, action) {
                        Ext.getCmp('extpollform_activity').focus();
                        Ext.getCmp('extpollform_activity').selectText();
                    },
                    failure: function(form, action) {
                        editor.close();
                        Ext.Msg.alert("Carga Fallida", "La carga de los parametros del Usuario no se ha realizado. Por favor, intentelo de nuevo, de mantenerse el problema contacte con el Administrador del Sistema. ");
                    }
                });
            }
        }
    },

    updExtPoll: function(button) {

        let grid = this.getExtpollgrid(),
            win = button.up('window'),
            form = win.down('form'),
            values = form.getValues(),
            id_activity = values.id_activity,
            activity = values.activity,
            department = values.department,
            speciality = values.speciality,
            actlevel = values.actlevel,
            id_poll = values.id_poll,
            p1 = values.p1,
            p2 = values.p2,
            p3 = values.p3,
            p4 = values.p4,
            p5 = values.p5,
            work = localStorage.getItem('work'),
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year');

        if (form.isValid()) {

            button.setText('Enviando...');
            Ext.getCmp('extpollform-okbutton').setDisabled(true);
            Ext.getCmp('extpollform-okclosebutton').setDisabled(true);
            Ext.getCmp('extpollform-cancelbtn').setDisabled(true);

            // UPDATE
            if (id_poll > 0) {
                form.getForm().submit({
                    method: 'POST',
                    url: '/phnet.calidad/public/api/extpoll/activity/upd',
                    params: {
                        id_poll: id_poll,
                        id_activity: id_activity,
                        activity: activity,
                        department: department,
                        speciality: speciality,
                        actlevel: actlevel,
                        p1: p1,
                        p2: p2,
                        p3: p3,
                        p4: p4,
                        p5: p5,
                        work: work,
                        month: month,
                        year: year
                    },
                    waitTitle: 'Espere', //Titulo del mensaje de espera
                    waitMsg: 'Procesando datos...', //Mensaje de espera
                    success: function(form, action) {
                        let data = Ext.decode(action.response.responseText);
                        win.close();
                        Ext.example.msgScs('Encuesta Actualizada Satisfactoriamente.');
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
                        if (button.getId() == 'extpollform-okclosebutton') {
                            button.setText('<i class="fas fa-check"></i>&nbsp;Aceptar y Cerrar');
                        } else {
                            button.setText('<i class="fas fa-check"></i>&nbsp;Aplicar');
                        }
                        Ext.getCmp('extpollform-okbutton').setDisabled(false);
                        Ext.getCmp('extpollform-okclosebutton').setDisabled(false);
                        Ext.getCmp('extpollform-cancelbtn').setDisabled(false);
                    }
                });
            }
            // CREATE
            else {
                form.getForm().submit({
                    method: 'POST',
                    url: '/phnet.calidad/public/api/extpoll/activity/add',
                    params: {
                        activity: activity,
                        department: department,
                        speciality: speciality,
                        actlevel: actlevel,
                        p1: p1,
                        p2: p2,
                        p3: p3,
                        p4: p4,
                        p5: p5,
                        work: work,
                        month: month,
                        year: year
                    },
                    waitTitle: 'Espere', //Titulo del mensaje de espera
                    waitMsg: 'Procesando datos...', //Mensaje de espera
                    success: function(form, action) {
                        let data = Ext.decode(action.response.responseText);
                        if (button.getId() == 'extpollform-okclosebutton') {
                            win.close();
                        } else {
                            if (button.getId() == 'extpollform-okclosebutton') {
                                win.close();
                            } else {
                                Ext.getCmp('extpollform_activity').focus();
                                Ext.getCmp('extpollform_level').reset();
                                Ext.getCmp('extpollform_activity').reset();
                                Ext.getCmp('extpollform-okbutton').setText('<i class="fas fa-check"></i>&nbsp;Aceptar');
                                Ext.getCmp('extpollform-okbutton').setDisabled(false);
                                Ext.getCmp('extpollform-okclosebutton').setDisabled(false);
                                Ext.getCmp('extpollform-cancelbtn').setDisabled(false);
                            }
                        }
                        Ext.example.msgScs('Encuesta Creada Satisfactoriamente. Continue si desea...');
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
                        if (button.getId() == 'extpollform-okclosebutton') {
                            button.setText('<i class="fas fa-check"></i>&nbsp;Aceptar y Cerrar');
                        } else {
                            button.setText('<i class="fas fa-check"></i>&nbsp;Aplicar');
                        }
                        Ext.getCmp('extpollform-okbutton').setDisabled(false);
                        Ext.getCmp('extpollform-okclosebutton').setDisabled(false);
                        Ext.getCmp('extpollform-cancelbtn').setDisabled(false);
                    }
                });
            }
        }
    },

    updPoll: function(record) {

        let intcustomerstab = this.getIntcustomerstab(),
            activetab = intcustomerstab.getActiveTab().itemId,
            grid = Ext.getCmp(activetab),
            id = record.data.id,
            field = record.field,
            rowIdx = record.rowIdx,
            colIdx = record.colIdx,
            oldvalue = record.oldvalue,
            newvalue = record.newvalue,
            number = record.number,
            work = localStorage.getItem('work'),
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year');

        if ((id != null && oldvalue == newvalue) || (newvalue == null || newvalue == '')) {
            return;
        }

        Ext.getCmp('btn_add_intcustomers').setDisabled(true);
        Ext.getCmp('btn_reload_intcustomers').setDisabled(true);
        Ext.getCmp('poll-issues-btn').setDisabled(true);
        Ext.getCmp('intpoll-btn-exp').setDisabled(true);
        Ext.getCmp('intcustomersmonthcombo').setDisabled(true);
        Ext.getCmp('intcustomersyearcombo').setDisabled(true);
        Ext.getCmp('intcustomersworkscombo').setDisabled(true);

        if (id == '' || id == null || id == 'null') {
            // Add Poll
            grid.el.mask('Procesando...', 'x-mask-loading');

            Ext.Ajax.request({
                url: '/phnet.calidad/public/api/poll/add',
                method: 'POST',
                params: {
                    activetab: activetab,
                    work: work,
                    month: month,
                    year: year,
                    field: field,
                    value: newvalue,
                    number: number
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
                    } else {
                        let nextfield = colIdx + 1;
                        grid.el.unmask();
                        grid.plugins[0].startEditByPosition({
                            row: rowIdx,
                            column: nextfield
                        });
                        grid.getSelectionModel().getSelection()[0].set('id', jsonData.poll.id);
                        /*grid.getStore().load({
                            callback: function(records, operation, success) {
                                let nextfield = colIdx + 1;
                                grid.plugins[0].startEditByPosition({
                                    row: rowIdx,
                                    column: nextfield
                                });
                            }
                        });*/
                    }

                    Ext.getCmp('btn_add_intcustomers').setDisabled(false);
                    Ext.getCmp('btn_reload_intcustomers').setDisabled(false);
                    Ext.getCmp('poll-issues-btn').setDisabled(false);
                    Ext.getCmp('intpoll-btn-exp').setDisabled(false);
                    Ext.getCmp('intcustomersmonthcombo').setDisabled(false);
                    Ext.getCmp('intcustomersyearcombo').setDisabled(false);
                    Ext.getCmp('intcustomersworkscombo').setDisabled(false);
                },
                failure: function() {
                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operaci\xF3n, de continuar el problema consulte al Administrador del Sistema.',
                        buttons: Ext.MessageBox.OK,
                        icon: 'fas fa-exclamation-triangle fa-2x dlg-error'
                    });

                    Ext.getCmp('btn_add_intcustomers').setDisabled(false);
                    Ext.getCmp('btn_reload_intcustomers').setDisabled(false);
                    Ext.getCmp('poll-issues-btn').setDisabled(false);
                    Ext.getCmp('intpoll-btn-exp').setDisabled(false);
                    Ext.getCmp('intcustomersmonthcombo').setDisabled(false);
                    Ext.getCmp('intcustomersyearcombo').setDisabled(false);
                    Ext.getCmp('intcustomersworkscombo').setDisabled(false);
                }
            });
        } else {
            // Update Poll
            grid.el.mask('Procesando...', 'x-mask-loading');

            Ext.Ajax.request({
                url: '/phnet.calidad/public/api/poll/upd',
                method: 'POST',
                params: {
                    id: id,
                    activetab: activetab,
                    field: field,
                    value: newvalue
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
                    } else {                        
                        if (colIdx < 18) {
                            if (activetab == 'intcequiptab') {
                                if (colIdx < 6) {
                                    grid.el.unmask();
                                    let nextfield = colIdx + 1;
                                    grid.plugins[0].startEditByPosition({
                                        row: rowIdx,
                                        column: nextfield
                                    });
                                } else {
                                    grid.getStore().load({
                                        callback: function(records, operation, success) {
                                            grid.el.unmask();
                                        }
                                    });
                                }
                            } else if (activetab == 'intcfeedtab') {
                                if (colIdx < 7) {
                                    grid.el.unmask();
                                    let nextfield = colIdx + 1;
                                    grid.plugins[0].startEditByPosition({
                                        row: rowIdx,
                                        column: nextfield
                                    });
                                }
                                else {
                                    grid.getStore().load({
                                        callback: function(records, operation, success) {
                                            grid.el.unmask();
                                        }
                                    });
                                }                                
                            } else if (activetab == 'intchostab') {
                                if (colIdx < 9) {
                                    grid.el.unmask();
                                    let nextfield = colIdx + 1;
                                    grid.plugins[0].startEditByPosition({
                                        row: rowIdx,
                                        column: nextfield
                                    });
                                }
                                else {
                                    grid.getStore().load({
                                        callback: function(records, operation, success) {
                                            grid.el.unmask();
                                        }
                                    });
                                }
                            }
                            else if (activetab == 'intcbrigadestab') {
                                if (colIdx < 7) {
                                    grid.el.unmask();
                                    let nextfield = colIdx + 1;
                                    grid.plugins[0].startEditByPosition({
                                        row: rowIdx,
                                        column: nextfield
                                    });
                                }
                                else {
                                    grid.getStore().load({
                                        callback: function(records, operation, success) {
                                            grid.el.unmask();
                                        }
                                    });
                                }                                
                            }
                            else if (activetab == 'intcpersonaltransptab') {
                                if (colIdx < 7) {
                                    grid.el.unmask();
                                    let nextfield = colIdx + 1;
                                    grid.plugins[0].startEditByPosition({
                                        row: rowIdx,
                                        column: nextfield
                                    });
                                }
                                else {
                                    grid.getStore().load({
                                        callback: function(records, operation, success) {
                                            grid.el.unmask();
                                        }
                                    });
                                }                                
                            }
                            else if (activetab == 'intcfreightransptab') {
                                if (colIdx < 7) {
                                    grid.el.unmask();
                                    let nextfield = colIdx + 1;
                                    grid.plugins[0].startEditByPosition({
                                        row: rowIdx,
                                        column: nextfield
                                    });
                                }
                                else {
                                    grid.getStore().load({
                                        callback: function(records, operation, success) {
                                            grid.el.unmask();
                                        }
                                    });
                                }                                
                            }
                        } else {
                            grid.getStore().load();
                        }
                    }

                    Ext.getCmp('btn_add_intcustomers').setDisabled(false);
                    Ext.getCmp('btn_reload_intcustomers').setDisabled(false);
                    Ext.getCmp('poll-issues-btn').setDisabled(false);
                    Ext.getCmp('intpoll-btn-exp').setDisabled(false);
                    Ext.getCmp('intcustomersmonthcombo').setDisabled(false);
                    Ext.getCmp('intcustomersyearcombo').setDisabled(false);
                    Ext.getCmp('intcustomersworkscombo').setDisabled(false);
                },
                failure: function() {
                    Ext.MessageBox.show({
                        title: 'Mensaje del Sistema',
                        msg: 'Ha ocurrido un error en el Sistema. Por favor, vuelva a intentar realizar la operaci\xF3n, de continuar el problema consulte al Administrador del Sistema.',
                        buttons: Ext.MessageBox.OK,
                        icon: 'fas fa-exclamation-triangle fa-2x dlg-error'
                    });

                    Ext.getCmp('btn_add_intcustomers').setDisabled(false);
                    Ext.getCmp('btn_reload_intcustomers').setDisabled(false);
                    Ext.getCmp('poll-issues-btn').setDisabled(false);
                    Ext.getCmp('intpoll-btn-exp').setDisabled(false);
                    Ext.getCmp('intcustomersmonthcombo').setDisabled(false);
                    Ext.getCmp('intcustomersyearcombo').setDisabled(false);
                    Ext.getCmp('intcustomersworkscombo').setDisabled(false);
                }
            });
        }
    },

    delPoll: function(id) {

        let equipmentab = Ext.getCmp('intcustomerstab'),
            activetab = equipmentab.getActiveTab().itemId
        grid = Ext.getCmp(activetab);

        Ext.Msg.confirm("Eliminar Encuesta", "Esta Encuesta ser\xE1 eliminada definitivamente. Confirma que desea realizar esta operaci\xF3n?", function(btnText) {

            if (btnText === "yes") {
                Ext.Ajax.request({
                    url: '/phnet.calidad/public/api/poll/del',
                    method: 'POST',
                    params: {
                        activetab: activetab,
                        id: id
                    },
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

    delExtPoll: function(id) {

        let equipmentab = Ext.getCmp('extcustomerstab'),
            activetab = equipmentab.getActiveTab().itemId,
            grid = Ext.getCmp(activetab);

        Ext.Msg.confirm("Eliminar Actividad", "Esta Actividad ser\xE1 eliminada de la encuesta. Confirma que desea realizar esta operaci\xF3n?", function(btnText) {

            if (btnText === "yes") {
                Ext.Ajax.request({
                    url: '/phnet.calidad/public/api/extpoll/activity/del',
                    method: 'POST',
                    params: {
                        id: id
                    },
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

    alldeleteExtPoll: function(button) {

        let grid = this.getExtpollgrid(),
            work = localStorage.getItem('work'),
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year');

        Ext.Msg.confirm("Eliminar Actividades", "Todas las Actividades ser\xE1n Eliminadas de la encuesta. Confirma que desea realizar esta operaci\xF3n?", function(btnText) {

            if (btnText === "yes") {
                Ext.Ajax.request({
                    url: '/phnet.calidad/public/api/extpoll/activities/alldel',
                    method: 'POST',
                    params: {
                        work: work,
                        month: month,
                        year: year
                    },
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

    commentsWindow: function() {

        let work = localStorage.getItem('work'),
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year'),
            type = localStorage.getItem('polltype'),
            service = localStorage.getItem('pollservice'),
            commentStore = this.getPollcommentStore();

        if (commentStore.isDestroyed) {
            Ext.create('PHNet.store.Pollcomment');
        }

        if (service != 'Alojamiento') {
            let win;
            if (service == 'Jefes de Brigadas') {
                win = Ext.create('PHNet.view.satisfaction.PollcommentWindow', {
                    title: 'Observaciones del Servicio a Brigadas constructoras'
                });
            }
            else {
                win = Ext.create('PHNet.view.satisfaction.PollcommentWindow', {
                    title: 'Observaciones del Servicio de ' + service
                })
            }
            let pollcommentgrid = this.getPollcommentgrid(),
                pollcommentproxy = pollcommentgrid.getStore().getProxy();

            Ext.apply(pollcommentproxy.api, {
                read: '/phnet.calidad/public/api/poll/comments/' + type + '/' + +work + '/' + month + '/' + year
            });

            pollcommentgrid.getStore().load({
                callback: function(records, operation, success) {
                    pollcommentgrid.getSelectionModel().deselect(records, true);
                }
            });

            win.show();
        } else {
            let win = Ext.create('PHNet.view.satisfaction.CommentTypeWindow');
            win.show();
        }
    },

    commentypeWindow: function(button) {

        let work = localStorage.getItem('work'),
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year'),
            win = button.up('window'),
            form = win.down('form'),
            values = form.getValues(),
            type = values.hostype,
            service = (type == 'host') ? 'Alojamiento' : 'Recreaci\xF3n',
            commentStore = this.getPollcommentStore();

        if (commentStore.isDestroyed) {
            Ext.create('PHNet.store.Pollcomment');
        }

        let newind = Ext.create('PHNet.view.satisfaction.PollcommentWindow', {
                title: 'Observaciones del Servicio de ' + service
            }),
            pollcommentgrid = this.getPollcommentgrid(),
            pollcommentproxy = pollcommentgrid.getStore().getProxy();

        Ext.apply(pollcommentproxy.api, {
            read: '/phnet.calidad/public/api/poll/comments/' + type + '/' + +work + '/' + month + '/' + year
        });

        pollcommentgrid.getStore().load({
            callback: function(records, operation, success) {
                pollcommentgrid.getSelectionModel().deselect(records, true);
            }
        });

        localStorage.setItem('pollhostype', type);
        win.close();
        newind.show();
    },

    updPollcomment: function(record) {

        let pollcommentgrid = this.getPollcommentgrid(),
            id = record.data.id,
            field = record.field,
            oldvalue = record.oldvalue,
            newvalue = record.newvalue,
            work = localStorage.getItem('work'),
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year'),
            type = (localStorage.getItem('polltype') == 'host') ? localStorage.getItem('pollhostype') : localStorage.getItem('polltype');

        if ((record.data.id != null && oldvalue == newvalue) || (newvalue == null || newvalue == '')) { return; }

        if (id == '' || id == null) {
            // Add Poll Issue
            Ext.Ajax.request({
                url: '/phnet.calidad/public/api/poll/comment/add',
                method: 'POST',
                params: {
                    type: type,
                    work: work,
                    month: month,
                    year: year,
                    field: field,
                    value: newvalue
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
                    } else {
                        pollcommentgrid.getStore().load({
                            callback: function(records, operation, success) {
                                pollcommentgrid.getSelectionModel().deselect(records, true);
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
        } else {
            // Update Poll Issue
            Ext.Ajax.request({
                url: '/phnet.calidad/public/api/poll/comment/upd',
                method: 'POST',
                params: {
                    id: id,
                    field: field,
                    value: newvalue
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
                    } else {
                        pollcommentgrid.getStore().load({
                            callback: function(records, operation, success) {
                                pollcommentgrid.getSelectionModel().deselect(records, true);
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
    },

    delPollcomment: function(id) {

        let pollcommentgrid = this.getPollcommentgrid();

        Ext.Ajax.request({
            url: '/phnet.calidad/public/api/poll/comment/del',
            method: 'POST',
            params: {
                id: id
            },
            success: function() {
                pollcommentgrid.getStore().load({
                    callback: function(records, operation, success) {
                        pollcommentgrid.getSelectionModel().deselect(records, true);
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

    loadPollIssuesDesc: function(combo, opts) {

        let comboproxy = combo.getStore().getProxy(),
            type = localStorage.getItem('polltype');

        Ext.apply(comboproxy.api, {
            read: '/phnet.calidad/public/api/poll/issues/' + type
        });
        combo.getStore().load({
            callback: function(records, operation, success) {
                combo.getSelectionModel().deselect(records, true);
            }
        });
    },

    intpollExpCurrent: function() {

        let work = this.getWorkscombo().getValue(),
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year');

        let formpdf = Ext.create('Ext.form.Panel', {
            items: [
                { xtype: 'hiddenfield', name: 'work', value: work },
                { xtype: 'hiddenfield', name: 'month', value: month },
                { xtype: 'hiddenfield', name: 'year', value: year }
            ]
        });

        formpdf.getForm().doAction('standardsubmit', {
            url: '/phnet.calidad/public/api/intpoll/pdf/current',
            standardSubmit: true,
            scope: this,
            method: 'GET',
            waitTitle: '<i class="fas fa-cog fa-spin text-white"></i>&nbsp;Creando PDF...',
            waitMsg: '<i class="fas fa-file-pdf icon-red icon-pdf-msg"></i>Por favor, espere mientras se genera el documento.&nbsp;&nbsp;',
            success: function(form, action) {
                formpdf.destroy(); //or destroy();
            }
        });
        Ext.defer(function() {
            Ext.MessageBox.hide();
        }, 10000);
    },

    intpollExpAll: function() {
        let month = localStorage.getItem('month'),
            year = localStorage.getItem('year');

        let formpdf = Ext.create('Ext.form.Panel', {
            items: [
                { xtype: 'hiddenfield', name: 'month', value: month },
                { xtype: 'hiddenfield', name: 'year', value: year }
            ]
        });

        formpdf.getForm().doAction('standardsubmit', {
            url: '/phnet.calidad/public/api/intpoll/pdf/all',
            standardSubmit: true,
            scope: this,
            method: 'GET',
            waitTitle: '<i class="fas fa-cog fa-spin text-white"></i>&nbsp;Creando PDF...',
            waitMsg: '<i class="fas fa-file-pdf icon-red icon-pdf-msg"></i>Por favor, espere mientras se genera el documento.&nbsp;&nbsp;',
            success: function(form, action) {
                formpdf.destroy(); //or destroy();
            }
        });
        Ext.defer(function() {
            Ext.MessageBox.hide();
        }, 10000);
    },

    extpollExpProject: function() {

        let work = this.getWorkscombo().getValue(),
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year');

        let formpdf = Ext.create('Ext.form.Panel', {
            items: [
                { xtype: 'hiddenfield', name: 'work', value: work },
                { xtype: 'hiddenfield', name: 'month', value: month },
                { xtype: 'hiddenfield', name: 'year', value: year }
            ]
        });

        formpdf.getForm().doAction('standardsubmit', {
            url: '/phnet.calidad/public/api/extpoll/pdf/analityc',
            standardSubmit: true,
            scope: this,
            method: 'GET',
            waitTitle: '&nbsp;<i class="fas fa-cog fa-spin text-white"></i>&nbsp;Creando PDF...',
            waitMsg: '<i class="fas fa-file-pdf icon-red icon-pdf-msg"></i>Por favor, espere mientras se genera el documento.&nbsp;&nbsp;',
            success: function(form, action) {
                formpdf.destroy(); //or destroy();
            }
        });
        Ext.defer(function() {
            Ext.MessageBox.hide();
        }, 10000);
    },

    extpollExpCert: function() {

        let work = this.getWorkscombo().getValue(),
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year');

        let formpdf = Ext.create('Ext.form.Panel', {
            items: [
                { xtype: 'hiddenfield', name: 'work', value: work },
                { xtype: 'hiddenfield', name: 'month', value: month },
                { xtype: 'hiddenfield', name: 'year', value: year }
            ]
        });

        formpdf.getForm().doAction('standardsubmit', {
            url: '/phnet.calidad/public/api/extpoll/pdf/certification',
            standardSubmit: true,
            scope: this,
            method: 'GET',
            waitTitle: '&nbsp;<i class="fas fa-cog fa-spin text-white"></i>&nbsp;Creando PDF...',
            waitMsg: '<i class="fas fa-file-pdf icon-red icon-pdf-msg"></i>Por favor, espere mientras se genera el documento.&nbsp;&nbsp;',
            success: function(form, action) {
                formpdf.destroy(); //or destroy();
            }
        });
        Ext.defer(function() {
            Ext.MessageBox.hide();
        }, 10000);
    },

    extpollExpModel: function() {

        let work = this.getWorkscombo().getValue(),
            month = localStorage.getItem('month'),
            year = localStorage.getItem('year');

        let formpdf = Ext.create('Ext.form.Panel', {
            items: [
                { xtype: 'hiddenfield', name: 'work', value: work },
                { xtype: 'hiddenfield', name: 'month', value: month },
                { xtype: 'hiddenfield', name: 'year', value: year }
            ]
        });

        formpdf.getForm().doAction('standardsubmit', {
            url: '/phnet.calidad/public/api/extpoll/pdf/pollmodel',
            standardSubmit: true,
            scope: this,
            method: 'GET',
            waitTitle: '&nbsp;<i class="fas fa-cog fa-spin text-white"></i>&nbsp;Creando PDF...',
            waitMsg: '<i class="fas fa-file-pdf icon-red icon-pdf-msg"></i>Por favor, espere mientras se genera el documento.&nbsp;&nbsp;',
            success: function(form, action) {
                formpdf.destroy(); //or destroy();
            }
        });
        Ext.defer(function() {
            Ext.MessageBox.hide();
        }, 10000);
    }
})