Ext.application({
    name: 'PHNet',
    appFolder: 'app',
    controllers: ['App', 'Metrology', 'Satisfaction'],
    launch: function() {

        var heightScreen = window.screen.availHeight,
            heightWindow = heightScreen - 280,
            widthScreen  = window.screen.availWidth,
            widthWindow  = widthScreen - 280;

        // Set LocalStorage month & year
        var month = new Date().getMonth() + 1;
        if (month < 10) { month = '0' + month; }
        localStorage.setItem('month', month);
        localStorage.setItem('year', new Date().getFullYear());
        
        // Clear Variables
        //localStorage.removeItem('metrotool_add');

        // Load Last App Screen
        
        if (localStorage.getItem('current_window')){
            $('body').addClass('bg-home');
            Ext.create(localStorage.getItem('current_window'), {
                width: widthWindow,
                height: heightWindow
            });
            $('.nav-icons li').removeClass('active');
            if (localStorage.getItem('current_window_id') == 'configwindow') {
                $('#lnk-config').addClass('active');
            }
            else if (localStorage.getItem('current_window_id') == 'equipmentwindow' || localStorage.getItem('current_window_id') == 'intcustomerswindow') {
                $('#dropdown-quality').addClass('focus');
            }
        }
        else{
            $('body').addClass('bg-home');
            $('#lnk-home').addClass('active');
        }
        
        // Open Windows

        $(document).on('click', '#lnk-home a', function() {
            if (localStorage.getItem('current_window_id')) {
               Ext.destroy(Ext.getCmp(localStorage.getItem('current_window_id'))); 
            }
            $('#dropdown-quality').removeClass('focus');
            $('#lnk-home').addClass('active');
            localStorage.removeItem('current_window');
            localStorage.removeItem('current_window_id');
            return;
        });

        $(document).on('click', '#lnk-config', function() {
            if (localStorage.getItem('current_window_id')) {
                Ext.destroy(Ext.getCmp(localStorage.getItem('current_window_id'))); 
            }
            Ext.create('PHNet.view.app.ConfigWindow', {
                width: widthWindow,
                height: heightWindow
            });
            $('.nav-icons li').removeClass('active');
            $('#dropdown-quality').removeClass('focus');
            $('#lnk-config').addClass('active');
            localStorage.setItem('current_window', 'PHNet.view.app.ConfigWindow');
            localStorage.setItem('current_window_id', 'configwindow');
            return;
        });

        $(document).on('click', '#lnk-equipments', function() {
            if (localStorage.getItem('current_window_id')) {
                Ext.destroy(Ext.getCmp(localStorage.getItem('current_window_id'))); 
            }
            Ext.create('PHNet.view.metrology.EquipmentWindow', {
                width: widthWindow,
                height: heightWindow
            });

            $('.nav-icons li').removeClass('active');
            $('#dropdown-quality').addClass('focus');

            $('.nav-icons li').removeClass('active');
            localStorage.setItem('current_window', 'PHNet.view.metrology.EquipmentWindow');
            localStorage.setItem('current_window_id', 'equipmentwindow');
            return;
        });

        $(document).on('click', '#lnk-planning', function() {
            if (localStorage.getItem('current_window_id')) {
                Ext.destroy(Ext.getCmp(localStorage.getItem('current_window_id'))); 
            }
            Ext.create('PHNet.view.metrology.PlanningWindow', {
                width: widthWindow,
                height: heightWindow
            });

            $('.nav-icons li').removeClass('active');
            $('#dropdown-quality').addClass('focus');

            $('.nav-icons li').removeClass('active');
            localStorage.setItem('current_window', 'PHNet.view.metrology.PlanningWindow');
            localStorage.setItem('current_window_id', 'planningwindow');
            return;
        });

        $(document).on('click', '#lnk-metroregister', function() {
            if (PHNet.view.metrology.MetrostateCombo.isComponent) {
                var state = Ext.getCmp('metrostatecombo').getValue();
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
            }
            else {
                var state = 'all';            
            }
            
            var formpdf = Ext.create('Ext.form.Panel', {items: [
                                { xtype: 'hiddenfield', name: 'state', value: state}
                            ]});
            
            formpdf.getForm().doAction('standardsubmit',{
                url: '/phnet.calidad/public/api/metrology/pdf/all',
                standardSubmit: true,
                scope: this,
                method: 'GET',
                waitTitle: '<i class="fas fa-cog fa-spin text-white"></i>&nbsp;Creando PDF...',
                waitMsg: '<i class="fas fa-file-pdf icon-red icon-pdf-msg"></i>Por favor, espere mientras se genera el documento.',
                success: function(form, action) {
                    formpdf.destroy();//or destroy();
                }
            });
            Ext.defer(function() {
                Ext.MessageBox.hide();
            }, 10000);
            return;
        });

        $(document).on('click', '#lnk-planningubph', function() {
            var year    = localStorage.getItem('year'),
                formpdf = Ext.create('Ext.form.Panel', {items: [
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
            
            Ext.defer(function() {
                Ext.MessageBox.hide();
            }, 10000);
            return;
        });

        $(document).on('click', '#lnk-intcustomers', function() {
            if (localStorage.getItem('current_window_id')) {
                Ext.destroy(Ext.getCmp(localStorage.getItem('current_window_id'))); 
            }
            Ext.create('PHNet.view.satisfaction.IntcustomersWindow', {
                width: widthWindow,
                height: heightWindow
            });

            $('.nav-icons li').removeClass('active');
            $('#dropdown-quality').addClass('focus');

            $('.nav-icons li').removeClass('active');
            localStorage.setItem('current_window', 'PHNet.view.satisfaction.IntcustomersWindow');
            localStorage.setItem('current_window_id', 'intcustomerswindow');
            return;
        });

        $(document).on('click', '#lnk-pdfintpoll', function() {
            var month = localStorage.getItem('month'),
                year  = localStorage.getItem('year');
            
            var formpdf = Ext.create('Ext.form.Panel', {items: [
                                { xtype: 'hiddenfield', name: 'month', value: month},
                                { xtype: 'hiddenfield', name: 'year', value: year}
                            ]});
            
            formpdf.getForm().doAction('standardsubmit',{
                url: '/phnet.calidad/public/api/intpoll/pdf/all',
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
        });

        $(document).on('click', '#lnk-extcustomers', function() {
            if (localStorage.getItem('current_window_id')) {
                Ext.destroy(Ext.getCmp(localStorage.getItem('current_window_id'))); 
            }
            Ext.create('PHNet.view.satisfaction.ExtcustomersWindow', {
                width: widthWindow,
                height: heightWindow
            });

            $('.nav-icons li').removeClass('active');
            $('#dropdown-quality').addClass('focus');

            $('.nav-icons li').removeClass('active');
            localStorage.setItem('current_window', 'PHNet.view.satisfaction.ExtcustomersWindow');
            localStorage.setItem('current_window_id', 'extcustomerswindow');
            return;
        });

        $(document).on('click', '#lnk-userprofile', function() {            
            var profile = Ext.create('PHNet.view.app.ProfileWindow'),
                form   = profile.down('form'),
                id_user = localStorage.getItem('userid');
            // Start change counter
            localStorage.setItem('profile_metroplan_change', '0');
            
            form.getForm().load({
                url: '/phnet.calidad/public/api/user/profile',
                method: 'POST',
                params: {
                    id_user: id_user
                },
                success: function(form, action) {
                    localStorage.setItem('profile_metroplan_change', '1');
                },
                failure: function(form, action) {
                    profile.close();
                    Ext.Msg.alert("Carga Fallida", "La carga de los parametros del Usuario no se ha realizado. Por favor, intentelo de nuevo, de mantenerse el problema contacte con el Administrador del Sistema. ");
                }
            });
            return;
        });

        $(document).on('click', '#lnk-userpassword', function() {            
            Ext.create('PHNet.view.app.ProfilePassword');
        });
        
        // Locked Screen
        if (!localStorage.getItem('sesionstatus')){
            localStorage.setItem('sesionstatus', 'active')
        }
        else {
            if (localStorage.getItem('sesionstatus') != 'active') {
                window.location = '/phnet.calidad/public/locked';
            }
        }
        if (auth) {
            last_activity = Date.now();
            $("html").mousemove(function( event ) {         
                last_activity = Date.now();
            });
            var task = {
                run: function(){
                    elapsed = (Date.now() - last_activity) / 1000;
                    if (elapsed > 300) {
                        window.location = '/phnet.calidad/public/locked';
                    }
                },
                interval: 600000 //600 second - 10 minutes
            }
            Ext.TaskManager.start(task);
        }
    },
    listeners: {
        specialkey: function(field, e){
            // e.HOME, e.END, e.PAGE_UP, e.PAGE_DOWN,
            // e.TAB, e.ESC, arrow keys: e.LEFT, e.RIGHT, e.UP, e.DOWN
            if (e.getKey() == e.ENTER) {
                alert('L Key');
            }
        }
    }
});