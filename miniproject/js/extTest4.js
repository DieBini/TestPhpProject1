/**
 * @example Paging Toolbar
 *
 * This example demonstrates loading data in pages dynamically from the server using a {@link Ext.toolbar.Paging Paging Toolbar}.
 * Note, that since there is no back end (data is loaded from a static file at `data/users.json`) each page will show the same data set.
 */
Ext.require('Ext.data.Model');
Ext.require('Ext.data.Store');
Ext.require('Ext.grid.Panel');
Ext.require('Ext.form.Panel');
Ext.require('Ext.toolbar.Paging');

Ext.define('User', {
    extend: 'Ext.data.Model',
    fields: ['id','name', 'author', 'descr','type' ]
});

Ext.onReady(function() {

	var itemsPerPage = 2;   // set the number of items you want per page

    var userStore = Ext.create('Ext.data.Store', {
        model: 'User',
        autoHeight: true,
        pageSize: itemsPerPage,
        proxy: {
            type: 'ajax',
            url : '/index/exttestgetlist',
            reader: {
                type: 'json',
                root: 'rows',
                totalProperty: 'total'
            }
        }
    });

    userStore.load({
        params: {
            // specify params for the first page load if using paging
            start: 0,          
            limit: 2

        }
    });
    
    var bd = Ext.getBody();
    /*
     * Here is where we create the Form
     */
    var gridForm = Ext.create('Ext.form.Panel', {
        id: 'company-form',
        url:'/index/exttestupdate',
        frame: true,
        /*bodyStyle: 'background:gray; padding:10px;',*/
        
        title: 'Company data',
        bodyPadding: 5,
        width: 1000,
        layout: 'column',    // Specifies that the items will now be arranged in columns
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'side'
        },
        dockedItems: [{
            xtype: 'pagingtoolbar',
            store: userStore,   // same store GridPanel is using
            dock: 'bottom',
            displayInfo: true
        }],
        items: [{
            columnWidth: 0.60,
            xtype: 'gridpanel',
            store: userStore,
            height: 400,
            title:'Company Data',


            columns: [
                {
                    id       :'ID',
                    text   : 'id',
                    width    : 20,
                    sortable : true,
                    dataIndex: 'id'
                },
                {
                    text   : 'Name',
                    width    : 75,
                    sortable : true,
                    dataIndex: 'name'
                },
                {
                    text   : 'Author',
                    width    : 75,
                    sortable : true,
                    dataIndex: 'author'
                },
                {
                    text   : 'Description',
                    width    : 200,
                    flex: 1,
                    dataIndex: 'descr'
                },
                {
                    text   : 'Type',
                    width    : 85,
                    sortable : true,
                    //renderer : Ext.util.Format.dateRenderer('m/d/Y'),
                    dataIndex: 'type'
                }
            ],
            listeners: {
                selectionchange: function(model, records) {
                    if (records[0]) {
                        var recorda = this.up('form').getForm().loadRecord(records[0]);
                    }
                }
            }
        }, {
            columnWidth: 0.4,
            margin: '0 0 0 10',
            xtype: 'fieldset',
            title:'Edit card',
            defaults: {
                width: 240,
                labelWidth: 90
            },
            defaultType: 'textfield',
            items: [{
                fieldLabel: 'Name',
                name: 'name'
            },{
                fieldLabel: 'Author',
                name: 'author'
            },{
                fieldLabel: 'Type',
                name: 'type'
            },{
            	xtype: 'hiddenfield',
                name: 'id'
            },{
                width : 60,
                text : 'Update',
                xtype : 'button',
                margin: '0 0 0 10',
                handler: function() {
                    var form = this.up('form').getForm();
                    form.submit({
                    	params: {
                            todo: 'update'
                        },
                        success: function(form, action) {
                           Ext.Msg.alert('Success', action.result.msg);
                           userStore.load({});
                        },
                       failure: function(form, action) {
                            Ext.Msg.alert('Failed', action.result.msg);
                        }
                    });
                }
                
            },{
                width : 60,
                text : 'Delete',
                xtype : 'button',
                margin: '0 0 0 10',
                handler: function() {
                    var form = this.up('form').getForm();
                    form.submit({
                    	params: {
                            todo: 'delete'
                        },
                        success: function(form, action) {
                           Ext.Msg.alert('Success', action.result.msg);
                           userStore.load({});
                        },
                       failure: function(form, action) {
                            Ext.Msg.alert('Failed', action.result.msg);
                        }
                    });
                }
            }]
        }],
        renderTo: bd
    });
    
    
    


	  
	  
    gridForm.child('gridpanel').getSelectionModel().select(0);

});
