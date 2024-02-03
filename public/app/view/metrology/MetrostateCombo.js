Ext.define('PHNet.view.metrology.MetrostateCombo', {
    extend: 'Ext.form.field.ComboBox',
    alias : 'widget.metrostatecombo',
    id: 'metrostatecombo',
    store: Ext.create('Ext.data.Store', {
            fields: ['name', 'icon'],
            data : [
                    {"name":"Todos los Instrumentos", "icon":"no-icon"},
                    {"name":"Disponibles/Aptos", "icon":"icon_black"},
                    {"name":"No Disponibles/No Aptos", "icon":"icon_land"},
                    {"name":"Entregados para calibrar", "icon":"icon_green"}
            ]
    }),
    allowBlank: false,
    editable: false,
    width: 230,
    fieldLabel: '<i class="fas fa-filter icon_darkblue"></i>',
    labelWidth: 30,
    labelAlign: 'right',
    displayField: 'name',
    valueField: 'name',
    queryMode: 'local',
    value: 'Todos los Instrumentos',
    listConfig: {
        getInnerTpl: function() {
            var tpl = '<div>'+
                      '<i class="fas fa-circle {icon}"></i>&nbsp;&nbsp;{name}'+
                      '</div>';
            return tpl;
        }
    }
});	