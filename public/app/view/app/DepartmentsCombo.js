Ext.define('PHNet.view.app.DepartmentsCombo', {
    extend: 'Ext.form.field.ComboBox',
    alias : 'widget.departmentscombo',
    width: 280,
    margin: '2 10 2 5',
    store: 'Departments',
	displayField: 'name',
    valueField: 'id',
    editable: false,
    /*listeners: {
        'render': function(combo, opt) {
            if (localStorage.getItem('department')){
                combo.setValue(parseInt(localStorage.getItem('department')));
            }
            else {
                first = combo.getStore().getAt(0).data.id;
                combo.setValue(first);
            }
        }
    }*/
});