Ext.define('PHNet.view.metrology.MetrotypeCombo', {
    extend: 'Ext.form.field.ComboBox',
    alias : 'widget.metrotypecombo',
    store: Ext.create('PHNet.store.Metrotype'),
	displayField: 'name',
    valueField: 'name',
    editable: false
});