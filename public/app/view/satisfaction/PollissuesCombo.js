Ext.define('PHNet.view.satisfaction.PollissuesCombo', {
    extend: 'Ext.form.field.ComboBox',
    alias : 'widget.pollissuescombo',
    store: Ext.create('PHNet.store.Pollissuescombo'),
	displayField: 'description',
    valueField: 'description',
    editable: true
});