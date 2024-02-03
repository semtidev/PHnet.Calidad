var year = new Date().getFullYear();
Ext.define('PHNet.store.Yearcombo', {
    extend: 'Ext.data.Store',
    fields: ['year'],
    data : [
        {"year": year},
        {"year": year - 1},
        {"year": year - 2},
        {"year": year - 3},
        {"year": year - 4},
    ]
});