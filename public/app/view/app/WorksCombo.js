Ext.define('PHNet.view.app.WorksCombo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.workscombo',
    width: 300,
    sortRoot: 'id',
    margin: '2 10 2 5',
    store: Ext.create('PHNet.store.Workscombo'),
    fieldLabel: '<i class="fas fa-hotel icon_darkblue"></i>',
    labelWidth: 30,
    labelAlign: 'right',
    displayField: 'name',
    valueField: 'id',
    emptyText: 'Elija el Proyecto',
    editable: false
        /*,
            listeners: {
                'render': function(combo, opt) {
                    if (!localStorage.getItem('work')){
                        combo.setValue(3);
                        //localStorage.setItem('work', combo.getValue());
                    }
                    else {
                        combo.setValue(parseInt(localStorage.getItem('work')));
                    }
                }
            }*/
});