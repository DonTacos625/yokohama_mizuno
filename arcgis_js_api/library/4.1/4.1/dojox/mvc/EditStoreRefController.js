//>>built
define("dojo/_base/declare dojo/_base/lang dojo/when ./getPlainValue ./EditModelRefController ./StoreRefController".split(" "),function(h,f,k,l,m,n){return h("dojox.mvc.EditStoreRefController",[n,m],{getPlainValueOptions:null,_removals:[],_resultsWatchHandle:null,_refSourceModelProp:"sourceModel",queryStore:function(a,b){if((this.store||{}).query){this._resultsWatchHandle&&this._resultsWatchHandle.unwatch();this._removals=[];var g=this,c=this.inherited(arguments),d=k(c,function(a){if(!g._beingDestroyed)return f.isArray(a)&&
(g._resultsWatchHandle=a.watchElements(function(a,b,c){[].push.apply(g._removals,b)})),a});d.then&&(d=f.delegate(d));for(var e in c)isNaN(e)&&(c.hasOwnProperty(e)&&f.isFunction(c[e]))&&(d[e]=c[e]);return d}},getStore:function(a,b){this._resultsWatchHandle&&this._resultsWatchHandle.unwatch();return this.inherited(arguments)},commit:function(){if(this._removals){for(var a=0;a<this._removals.length;a++)this.store.remove(this.store.getIdentity(this._removals[a]));this._removals=[]}var b=l(this.get(this._refEditModelProp),
this.getPlainValueOptions);if(f.isArray(b))for(a=0;a<b.length;a++)this.store.put(b[a]);else this.store.put(b);this.inherited(arguments)},reset:function(){this.inherited(arguments);this._removals=[]},destroy:function(){this._resultsWatchHandle&&this._resultsWatchHandle.unwatch();this.inherited(arguments)}})});