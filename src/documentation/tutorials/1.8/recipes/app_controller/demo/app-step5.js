define([
	"dojo/dom", 
	"dojo/dom-style", 
	"dojo/dom-class", 
	"dojo/dom-construct", 
	"dojo/dom-geometry", 
	"dojo/string", 
	"dojo/on", 
	"dojo/aspect", 
	"dojo/keys", 
	"dojo/_base/lang", 
	"dojo/_base/fx", 
	"dijit/registry", 
	"dojo/parser",
	"dijit/layout/ContentPane", 
	"dojox/data/FlickrRestStore", 
	"dojox/image/LightboxNano",
	"dojo/_base/window",
	"demo/module"
	], 
	function(dom, domStyle, domClass, domConstruct, domGeometry, string, on, aspect, keys, lang, baseFx, registry, parser, ContentPane, FlickrRestStore, LightboxNano, win) {

	var store = null,
		preloadDelay = 500,
		flickrQuery = dojo.config.flickrRequest || {},

		itemTemplate = '<img src="${thumbnail}"/>${title}',
		itemClass = 'item',
		itemsById = {},

		largeImageProperty = "media.l", // path to the large image url in the store item
		thumbnailImageProperty = "media.t", // path to the thumb url in the store item

		startup = function() {

			// create the data store
			var flickrStore = store = new FlickrRestStore();

			// build up and initialize the UI
			initUi();
		},

		initUi = function() {
			// summary: 
			// 		create and setup the UI with layout and widgets

			// create a single Lightbox instnace which will get reused
			lightbox = new LightboxNano({});

			// set up ENTER keyhandling for the search keyword input field
			on(dom.byId("searchTerms"), "keydown", function(evt){
				if(evt.keyCode == keys.ENTER){
					evt.preventDefault();
					doSearch();
				}
			});

			// set up click handling for the search button
			on(dom.byId("searchBtn"), "click", doSearch);			
		},
		doSearch = function() {
			// summary: 
			// 		inititate a search for the given keywords
			var terms = dom.byId("searchTerms").value;
			if(!terms.match(/\w+/)){
				return;
			}
			var listNode = createTab(terms);
			var results = store.fetch({
				query: lang.delegate(flickrQuery, {
					text: terms
				}), 
				count: 10,
				onItem: function(item){
					// first assign and record an id
					// render the items into the <ul> node
					var node = renderItem(item, listNode);
				}
			});
		},
		createTab = function (term, items) {
			// summary: 
			// 		Handle fetch results

			var contr = registry.byId("tabs"); 
			var listNode = domConstruct.create("ul", {
				"class": "demoImageList",
				"id": "panel" + contr.getChildren().length
			});

			// create the new tab panel for this search
			var panel = new ContentPane({
				title: term, 
				content: listNode,
				closable: true
			});
			contr.addChild(panel);
			// make this tab selected
			contr.selectChild(panel);

			// connect mouse click events to our event delegation method
			var hdl = on(listNode, "click", onListClick);
			return listNode;
		},
		renderItem = function(item, refNode, posn) {
			// summary: 
			// 		Create HTML string to represent the given item
			itemsById[item.id] = item;
			var props = lang.delegate(item, {
				thumbnail: lang.getObject(thumbnailImageProperty, false, item)
			});

			return domConstruct.create("li", {
				"class": itemClass,
				id: refNode.id + "_" + item.id,
				innerHTML: string.substitute(itemTemplate, props)
			}, refNode, posn);
		},
		onListClick = function (evt) {
			var node = evt.target, 
				containerNode = registry.byId("tabs").containerNode;

			for(var node = evt.target; (node && node !==containerNode); node = node.parentNode){
				if(domClass.contains(node, itemClass)) {
					showItemById(node.id.substring(node.id.indexOf("_") +1), node);
					break;
				}
			}
		},
		showImage = function (url, originNode){
			// summary: 
			// 		Show the full-size image indicated by the given url
			lightbox.show({ 
				href: url, origin: originNode 
			});
		},

		showItemById = function (id, originNode) {
			var item = itemsById[id];
			if(item) {
				showImage(lang.getObject(largeImageProperty, false, item), originNode);
			}
		};
	
	return {
		init: function() {

			// register callback for when dependencies have loaded
			startup();

		}
	};

});