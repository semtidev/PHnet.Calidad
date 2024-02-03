Ext.define('PHNet.model.Extpolls', {
	extend: 'Ext.data.Model',
	fields: ['id', 'number', 'id_work', 'id_activity', 'month', 'year', {name: 'p1', type: 'float'}, {name: 'p2', type: 'float'}, {name: 'p3', type: 'float'}, {name: 'p4', type: 'float'}, {name: 'p5', type: 'float'}, {name: 'sum', type: 'float'}, {name: 'prom', type: 'float'}, 'description', 'act_level', 'id_speciality', 'speciality', 'department', 'work_prom', 'work_eval']
});