// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("./AccessoirePromise ./Accessoire ./Error dojo/aspect dojo/_base/lang dojo/Deferred".split(" "),function(d,c,e,f,g,h){return d.createSubclass([c],{declaredClass:"esri.core.LoadableAccessoire","-chains-":g.mixin(c._meta.chains,{load:"after"}),classMetadata:{properties:{loaded:{readOnly:!0,dependsOn:["loadStatus"]},loadStatus:{},loadError:{}}},constructor:function(){var b=new h;this.addResolvingPromise(b.promise);f.around(this,"load",function(a){return function(){"not-loaded"===this.loadStatus&&
(this.loadStatus="loading",a.apply(this),b.resolve(),b=null);return this}});this.then(function(a){this.loadStatus="loaded"}.bind(this),function(a){this.loadStatus="failed";this.loadError=a}.bind(this))},loaded:null,_loadedGetter:function(){return"loaded"===this.loadStatus},loadError:null,loadStatus:"not-loaded",load:function(){},cancelLoad:function(){if(this.isFulfilled())return this;this.loadError=new e("load:cancelled","Cancelled");this._promiseProps.cancel(this.loadError);return this}})});