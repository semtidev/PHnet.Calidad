Ext.define('PHNet.view.app.WorkAbbrCombo', {
    extend: 'Ext.form.field.ComboBox',
    alias : 'widget.worksabbrcombo',
    width: 260,
    sortRoot: 'id',
    store: Ext.create('PHNet.store.Workabbr'),
	displayField: 'abbr',
    valueField: 'abbr',
    editable: false
});