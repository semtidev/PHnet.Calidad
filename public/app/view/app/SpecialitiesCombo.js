Ext.define('PHNet.view.app.SpecialitiesCombo', {
    extend: 'Ext.form.field.ComboBox',
    alias : 'widget.specialitiescombo',
    width: 280,
    margin: '2 10 2 5',
    store: Ext.create('PHNet.store.Specialities'),
    //fieldLabel: '<i class="fas fa-hotel icon_darkblue"></i>',
    //labelWidth: 30,
    //labelAlign: 'right',
	displayField: 'name',
    valueField: 'id',
    editable: false,
    /*listeners: {
        'render': function(combo, opt) {
            var specialitiesproxy = combo.getStore().getProxy();
            if (!localStorage.getItem('department')){
                Ext.apply(specialitiesproxy.api, {
                    read: '/phnet.calidad/public/api/specialities/1'
                });
                combo.getStore().load();
            }
            else {
                Ext.apply(specialitiesproxy.api, {
                    read: '/phnet.calidad/public/api/specialities/' + localStorage.getItem('department')
                });
                combo.getStore().load({
                    callback: function(records, operation, success) {
                        var first = combo.getStore().getAt(0).data.id;
                        combo.setValue(first);
                    }
                });
            }
        }
    }*/
});