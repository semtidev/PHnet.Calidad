Ext.define('PHNet.view.metrology.MetroImageView', {
    extend: 'Ext.view.View',
    alias : 'widget.metroimageview',
    id: 'widget.metroimageview',
    requires: ['Ext.data.Store'],
    mixins: {
        dragSelector: 'Ext.ux.DataView.DragSelector',
        draggable   : 'Ext.ux.DataView.Draggable'
    },
    
    tpl: [
        '<tpl for=".">',
            '<div id="metroview-thumb-{src}" class="thumb-wrap">',
                '<div class="thumb">',
                    (!Ext.isIE6? '<img src="dist/img/metrology/{src}.jpg" width="100" height="70" />' : 
                    '<div stynamele="width:100px;height:70px;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'dist/img/metrology/{src}.jpg\')"></div>'),
                '</div>',
                '<span>{src}</span>',
            '</div>',
        '</tpl>'
    ],
    
    itemSelector: 'div.thumb-wrap',
    multiSelect: false,
    singleSelect: true,
    cls: 'x-image-view',
    autoScroll: true,
    
    initComponent: function() {
        this.store = Ext.create('Ext.data.Store', {
                        autoLoad: true,
                        fields: ['src'],
                        proxy: {
                            type: 'ajax',
                            url : 'dist/img/metrology/photos.json',
                            reader: {
                                type: 'json',
                                root: ''
                            }
                        }
                    });
        
        this.mixins.dragSelector.init(this);
        this.mixins.draggable.init(this, {
            ddConfig: {
                ddGroup: 'organizerDD'
            },
            ghostTpl: [
                '<tpl for=".">',
                    '<img src="dist/img/metrology/{src}.jpg" width="100" height="70" />',
                    '<tpl if="xindex % 6 == 0"><br /></tpl>',
                '</tpl>',
                '<div class="count">',
                    '{[values.length]} images selected',
                '<div>'
            ]
        });
        
        this.callParent();
    }
});