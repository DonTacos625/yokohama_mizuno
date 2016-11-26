define([
  "dojo/_base/declare",
  "dojo/_base/lang",
  "dojo/_base/array",
  "dojox/lang/functional/object",
  "dojo/topic"
], function(declare, lang, array, object, topic) {

  return declare("Quoin.Base", null, {
    _subscriptions: [],
    subscribe: function(name, callback){
      var handle = topic.subscribe(name, lang.hitch(this, callback));
      return handle;
    },
    publish: function(){
      var args = Array.prototype.slice.call(arguments);
      topic.publish.apply(this, args);
    },
    destroy:function(){
      array.forEach(this._subscriptions, lang.hitch(this, function(subscription, index){
        subscription.remove();
      }));
    }
  });

});
