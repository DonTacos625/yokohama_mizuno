define([
  "dojo/_base/declare",
  "dojo/_base/lang",
  "dojo/_base/event",
  "dojo/query",
  "dojo/dom-construct",
  "dojo/on",
  "dojo/NodeList-manipulate"
], function(declare, lang, event, $, domConstruct, on) {
  return declare([], {

    _container: null,

    constructor: function(domOrId){
      this._container = domOrId;
    },

    clear: function(){
      $(".alert", $(this._container)[0]).remove();
    },

    create: function(message, type, timeout, closeable){
      closeable = (closeable === false) ? false : closeable;

      var el = domConstruct.create("div", {
        "class": "alert is-active trailer-half "+type,
        "innerHTML": message
      }, $(this._container)[0]);

      if(closeable) {
        var close = domConstruct.create("a", {
          "class": "icon-close"
        }, el);

        var handler = on.once(close, "click", lang.hitch(this, function(e){
          domConstruct.destroy(el);
        }));
      }

      if(timeout){
        setTimeout(lang.hitch(this, function(){
          if(handler){
            handler.remove();
          }
          domConstruct.destroy(el);
        }), timeout);
      }
    },

    success: function(message, timeout) {
      timeout = timeout || 0;
      this.create(message, "alert-green", timeout, true);
    },

    error: function(message, timeout) {
      timeout = timeout || 0;
      this.create(message, "alert-red", timeout, true);
    },

    info: function(message, timeout) {
      timeout = timeout || 0;
      this.create(message, "", timeout, true);
    }
  });
});
