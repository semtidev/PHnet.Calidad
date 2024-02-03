Ext.define('PHNet.model.Metrology',{
	extend: 'Ext.data.Model',
	fields: ['id', 'number', 'id_work', 'workname', 'photo', 'type', 'id_state', 'name', 'ctdad', 'demand', 'model', 'serie', 'precision', 'limit', {name: 'last_check'}, 'term_check', {name: 'plan_date' /*, type: 'date', dateFormat: 'c'*/}, {name: 'real_date' /*, type: 'date', dateFormat: 'c'*/}, 'result_check', 'reparation', {name: 'next_plan' /*, type: 'date', dateFormat: 'c'*/}, 'location', 'owner', 'comment', 'updated_at', 'history', 'active']
});