define([
  "dojo/_base/declare",
  "dojo/Stateful",
  "dojo/Evented",
  "dojox/lang/functional/object",
  "dojo/_base/lang",
  "dojo/_base/array",
  "Quoin/Base"
], function(declare, Stateful, Evented, object, lang, array, Base) {

  return declare("Quoin.Model", [Stateful, Evented, Base], {
    constructor: function(data){
      this._setupGetters();
      this._setupSetters();
      this._setupLinks();
      // listen to all the attributes on this model and emit event whenever any one of them changes
      this.watch(function(attribute, oldValue, newValue){
        this.emit("change:"+attribute, {
          newValue: newValue
        });
        this.emit("change", {
          attribute: attribute,
          newValue: newValue
        });
      });
      this.watch("id", function(attribute, oldId, newId){
        if(this.collection && oldId && newId){
          this.collection.index[newId] = this.collection.index[oldId];
          delete this.collection.index[oldId];
          this.collection.emit("index-altered", {
            oldId: oldId,
            newId: newId
          });
        }
      });
    },
    _setupGetters: function(){
      // for each of our getters...
      object.forIn(this.getters, lang.hitch(this, function(value, key){
        // create a new getter in the correct syntax
        this["_"+key+"Getter"] = value;
      }));
    },
    _setupSetters: function(){
      // for each of our setters...
      object.forIn(this.setters, lang.hitch(this, function(value, key){
        // create a new setter in the correct syntax
        this["_"+key+"Setter"] = value;
      }));
    },
    _setupLinks: function(){
      object.forIn(this.link, lang.hitch(this, function(value, key){
        // for every property we should listenen on...
        array.forEach(value, lang.hitch(this, function(listenTo){
          // setup a new listener on that property...
          this.watch(listenTo, function(attribute, oldValue, newValue){
            // and emit a change event for our key when ever it changes...
            this.emit("change:"+key, {
              newValue: this.get(key)
            });
          });
        }));
      }));
    },
    update: function(){
      // Override to update a model in the persistance layer
    },
    sync: function(){
      // Override to syncronize a model with the persistance layer
    },
    create: function(){
      // override to create the model in the persistance layer
    },
    destroy: function(){
      //if this model is in a collection remove it from the collection
      if(this.get("collection")){
        var collection = this.get("collection");
        if(collection){
          collection.remove(this.get("id"));
        }
      }
    }
  });
});