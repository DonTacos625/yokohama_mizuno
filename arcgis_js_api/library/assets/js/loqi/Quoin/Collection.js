define([
  "dojo/_base/declare",
  "dojo/_base/lang",
  "dojox/mvc/StatefulArray",
  "dojo/store/Memory",
  "dojo/Evented",
  "Quoin/Base"
], function(declare, lang, StatefulArray, Memory, Evented, Base){

  return declare("Quoin.Collection", [Memory, Evented, Base], {
    constructor: function(options, data){
      this.model = options.model;
      this.data = new StatefulArray(data || []);
      this.data.watchElements(lang.hitch(this, function(index, removals, adds){
        if(removals.length){
          this.emit("item:removed", {
            index: index,
            removals: removals
          });
        }
        if(adds.length){
          this.emit("item:added", {
            index: index,
            additions: adds
          });
        }
      }));
    },
    forEach: function(callback, context){
      for (var i = 0; i < this.data.length; i++) {
        var model = this.data[i];
        callback.apply((context || this), [model, i, this]);
      }
    },
    create: function(data, options){
      var newModel = new this.model(data);
      this.add(newModel, options);
      return newModel.create(data);
    },
    add: function(model){
      model.set("collection", this);
      this.inherited(arguments);
    },
    remove: function(id){
      this.get(id).set("collection", null);
      this.inherited(arguments);
    },
    fetch: function(){
      // override to fetch objects from the server and add them to the collection
    },
    destroy: function(id){
      // destroy an item on the server and remove it from the collection
      var model = this.get(id);

      //remove from collection
      this.remove(id);

      //destory on server
      model.destroy();
    }
  });

});