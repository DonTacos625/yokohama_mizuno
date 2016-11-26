define([
  "dojo/_base/declare",
  "dijit/_WidgetBase",
  "Quoin/Handlebars",
  "Quoin/HandlebarsTemplated",
  "Quoin/Model",
  "dojo/query",
  "dojo/_base/event",
  "dojo/_base/lang",
  "dojo/_base/array",
  "dojox/lang/functional/object",
  "dojo/on",
  "dojo/dom-style",
  "dojo/topic",
  "dojo/dom-construct",
  "dojo/NodeList-dom"
], function(declare, _WidgetBase, Handlebars, _HandlebarsTemplated, Model, $, event, lang, array, object, on, style, topic, domConstruct) {

  function safeReplace (string) {
    return string.replace(/</g, "&lt;").replace(/>/g, "&gt;");
  }

  Handlebars.registerHelper("get", function(obj, key){
    if(obj.model && obj.model.get(key)){
      var value = obj.model.get(key);
      return (typeof value === "string") ? safeReplace(value) : value;
    }
    return "";
  });

  Handlebars.registerHelper("log", function(value){
    console.log("Handlebars Log :", value);
  });

  Handlebars.registerHelper("node", function(value){
    return "data-dojo-attach-point="+value;
  });

  return declare("Quoin.View", [_WidgetBase, _HandlebarsTemplated], {
    _bindings: {},
    _watches: [],
    constructor: function(opts){
      if(!opts || !opts.model){
        this.model = new Model({});
      }
    },
    postCreate: function(){
      this._createEvents();
      this._createBindings();
      this.inherited(arguments);
    },
    destroy: function(){
      this._removeWatches();
      this.inherited(arguments);
    },
    use: function(model){
      // remove the old handlers for bindings
      this._removeWatches();

      // change the model
      this.model = model;

      // create new bindings
      if(model){
        this._createBindings();
        this._runBindings();
      }

      return this;
    },
    render: function(node, placement, rebuild){
      if(rebuild){
        this.destroyRendering();
        this._rendered = false; // fix Dojo 1.9.1
        this.buildRendering();
        this._createEvents();
        this._createBindings();
        this._runBindings();
      }
      domConstruct.place(this.domNode, node, placement);
      return this;
    },
    _createEvents: function(){
      object.forIn(this.events, lang.hitch(this, function(value, key){
        var components = key.split(" ");
        var eventName = components.splice(-1, 1)[0];
        var selector = components.join(" ");
        var element = $(selector, this.domNode);
        var callback = lang.hitch(this, function(e){
          event.stop(e);
          lang.hitch(this, this[value])(e);
        });

        if(element.length){
          this.own(on(element, eventName, callback));
        } else {
          this.own(on(this.domNode, selector+":"+eventName, callback));
        }
      }));
    },
    _runBindings: function(){
      object.forIn(this.bindings, lang.hitch(this, function(value, key){
        var callbackAction, selectorAction, callback, components;

        // if value is an object, assign components and callback
        if(lang.isObject(value)){
          callback = value.callback;
          components = value.element;
        }

        // if value is a function or we have a callback
        if(lang.isFunction(value) || callback){
          callbackAction = (callback) ? lang.hitch(this, callback||value) : lang.hitch(this, value);
          callbackAction(this.model.get(key));
        }

        // if value is a function or we have a string component
        if(lang.isString(value) || components) {
          var chunks = (components) ? components.split(" ") : value.split(" ");
          var attribute = chunks.splice(-1, 1)[0];
          var selector = chunks.join(" ");
          $(selector, this.domNode).attr(attribute, this.model.get(key));
        }
      }));
    },
    _removeWatches: function(){
      array.forEach(this._watches, function(handle){
        handle.unwatch();
      });
    },
    _createBindings: function(){
      object.forIn(this.bindings, lang.hitch(this, function(value, key){
        var callbackAction, selectorAction, callback, components;

        // if value is an object, assign components and callback
        if(lang.isObject(value)){
          callback = value.callback;
          components = value.element;
        }

        // if value is a function or we have a callback
        if(lang.isFunction(value) || callback){
          callbackAction = (callback) ? lang.hitch(this, callback) : lang.hitch(this, value);
        }

        // if value is a function or we have a string component
        if(lang.isString(value) || components) {
          var chunks = (components) ? components.split(" ") : value.split(" ");
          var attribute = chunks.splice(-1, 1)[0];
          var selector = chunks.join(" ");
          selectorAction = lang.hitch(this, function(newValue){
            $(selector, this.domNode).attr(attribute, newValue);
          });
        }

        var handle = this.model.watch(key, lang.hitch(this,function(prop, oldValue, newValue){
          if(selectorAction){
            selectorAction(newValue);
          }
          if(callbackAction){
            callbackAction(newValue);
          }
        }));

        this._watches.push(handle);
      }));
    },
    subscribe: function(name, callback){
      return this.own(topic.subscribe(name, lang.hitch(this, callback)));
    },
    publish: function(){
      var args = Array.prototype.slice.call(arguments);
      topic.publish.apply(this, args);
    }
  });
});
