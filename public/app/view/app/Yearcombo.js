Ext.define('PHNet.view.app.Yearcombo', {
    extend: 'Ext.form.ComboBox',
    alias: 'widget.yearcombo',
    width: 100,
    fieldLabel: '<i class="fas fa-calendar-alt icon_darkblue"></i>',
    labelWidth: 30,
    labelAlign: 'right',
    margin: '2 10 2 5',
    store: Ext.create('PHNet.store.Yearcombo'),
    queryMode: 'local',
    editable: false,
    displayField: 'year',
    valueField: 'year',
    value: localStorage.getItem('year')
});