define([
  "dojo/_base/declare",
  "dojo/_base/lang",
  "Quoin/View",
  "Quoin/Handlebars",
  "dojo/_base/array",
  "dojo/dom-style",
  "dojo/dom-construct",
  "dojo/query",
  "dojo/NodeList-traverse",
  "dojo/NodeList-dom",
  "dojo/NodeList-data"
], function(declare, lang, View, Handlebars, array, style, domConstruct, $) {

  Handlebars.registerHelper("list-container", function(){
    return "<div data-dojo-attach-point='listContainer'></div>";
  });

  return declare("Quoin.ListView", [View], {
    //modelId:viewId
    index: {},
    //viewId:view
    views: {},
    //number of visible views
    activeItems: function(){
      return $(this.listContainer).children(":not(._quoin-filtered)").length;
    },
    filter: function(query, options){
      var items = this.collection.query(query, options);

      $(this.listContainer).children().style("display","none").addClass("_quoin-filtered");

      // for each item in the results remove hide
      items.forEach(lang.hitch(this, function(item, index){
        var view = this.viewForModel(item.get("id"));
        $(view.domNode).style("display","block").removeClass("_quoin-filtered");
      }));
    },
    addItem: function(item, options){
      var view;
      var position = options.index || 0;
      var itemId = item.get("id");

      if(this.views[itemId]){
        view = this.views[itemId];
      } else {
        view = new this.view({
          model: item
        });
        this.views[view.get("id")] = view;
        this.index[item.get("id")] = view.get("id");
      }

      view.placeAt(this.listContainer, position);
    },
    removeItem: function(id){
      var viewId = this.index[id];
      var modelId = this.views[viewId].model.get("id");
      this.views[viewId].destroy();
      delete this.views[viewId];
      delete this.index[modelId];
    },
    renderCollection: function(){
      this.collection.query(function(){
        return true;
      }, {
        sort: [{attribute:this.sortAttribute, descending: this.sortDescending}]
      }).forEach(function(item, index){
        this.addItem(item, {index: index});
      }, this);
    },
    postCreate: function(){
      this.inherited(arguments);
      this.renderCollection();
    },
    viewForModel: function(id){
      var viewId = this.index[id];
      return this.views[viewId];
    },
    constructor: function(opts){
      this.collection = opts.collection;
      this.view = opts.view;
      this.sortAttribute = opts.sortAttribute || "id";
      this.sortDescending = opts.sortDescending || true;
      this.collection.on("item:added", lang.hitch(this, function(e){
        this.addItem(e.additions[0], {
          index: e.index
        });
      }));
      this.collection.on("item:removed", lang.hitch(this, function(e){
        this.removeItem(e.removals[0].get("id"));
      }));
      this.collection.on("index-altered", lang.hitch(this, function(e){
        this.index[e.newId] = this.index[e.oldId];
        delete this.index[e.oldId];
        var viewId = this.index[e.newId];
        var targetView = this.viewForModel(e.newId);
        var viewPos = dojo.query(".application").indexOf(dojo.query(viewId)[0]);
        targetView.destroyRendering();
        targetView.buildRendering();
        targetView._createEvents();
        domConstruct.place(targetView.domNode, this.listContainer, viewPos);
      }));
    }
  });

});
