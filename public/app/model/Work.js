Ext.define('PHNet.model.Work',{
	extend: 'Ext.data.Model',
	fields: [{name: 'id', type: 'integer'}, 'name', 'abbr', 'metrology', 'planning', 'intcustomerpoll', 'extcustomerpoll']
});