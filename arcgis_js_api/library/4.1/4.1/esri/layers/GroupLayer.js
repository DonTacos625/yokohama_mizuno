// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("require exports ../core/tsSupport/declareExtendsHelper ../core/tsSupport/decorateHelper ./Layer ../core/MultiOriginJSONSupport ./mixins/PortalLayer ./mixins/OperationalLayer ../support/LayersMixin ../core/accessorSupport/utils ../core/accessorSupport/decorators".split(" "),function(q,r,g,e,h,k,l,m,n,p,c){return function(f){function a(b){f.call(this);this._visibilityHandles={};this.fullExtent=void 0;this.operationalLayerType="GroupLayer";this.spatialReference=void 0;this._visibilityWatcher=
this._visibilityWatcher.bind(this)}g(a,f);a.prototype.initialize=function(){this._enforceVisibility(this.visibilityMode,this.visible);this.watch("visible",this._visibleWatcher.bind(this),!0)};a.prototype._writeLayers=function(b,a,c){var d=[];if(!b)return d;b.forEach(function(b){b.write&&(b=b.write(null,c))&&b.layerType&&d.push(b)});a.layers=d};Object.defineProperty(a.prototype,"visibilityMode",{set:function(b){this._get("visibilityMode")!==b&&this._enforceVisibility(b,this.visible);this._set("visibilityMode",
b)},enumerable:!0,configurable:!0});a.prototype.load=function(){this.addResolvingPromise(this.loadFromPortal({supportedTypes:["Feature Service","Feature Collection","Scene Service"]}));return this};a.prototype.layerAdded=function(b,a){b.visible&&"exclusive"===this.visibilityMode?this._turnOffOtherLayers(b):"inherited"===this.visibilityMode&&(b.visible=this.visible);this._visibilityHandles[b.uid]=b.watch("visible",this._visibilityWatcher,!0)};a.prototype.layerRemoved=function(b,a){var c=this._visibilityHandles[b.uid];
c&&(c.remove(),delete this._visibilityHandles[b.uid]);this._enforceVisibility(this.visibilityMode,this.visible)};a.prototype._turnOffOtherLayers=function(b){this.layers.forEach(function(a){a!==b&&(a.visible=!1)})};a.prototype._enforceVisibility=function(b,a){if(p.getProperties(this).initialized){var c=this.layers,d=c.find(function(a){return a.visible});switch(b){case "exclusive":c.length&&!d&&(d=c.getItemAt(0),d.visible=!0);this._turnOffOtherLayers(d);break;case "inherited":c.forEach(function(b){b.visible=
a})}}};a.prototype._visibleWatcher=function(a){"inherited"===this.visibilityMode&&this.layers.forEach(function(c){c.visible=a})};a.prototype._visibilityWatcher=function(a,c,e,d){switch(this.visibilityMode){case "exclusive":a?this._turnOffOtherLayers(d):this._isAnyLayerVisible()||(d.visible=!0);break;case "inherited":d.visible=this.visible}};a.prototype._isAnyLayerVisible=function(){return this.layers.some(function(a){return a.visible})};e([c.shared({"2d":"../views/layers/GroupLayerVue","3d":"../views/layers/GroupLayerView"})],
a.prototype,"viewModulePaths",void 0);e([c.property()],a.prototype,"fullExtent",void 0);e([c.property({json:{readable:!1,writeAlways:!0}})],a.prototype,"layers",void 0);e([c.write("layers")],a.prototype,"_writeLayers",null);e([c.property()],a.prototype,"operationalLayerType",void 0);e([c.property({json:{writable:!1}})],a.prototype,"portalItem",void 0);e([c.property()],a.prototype,"spatialReference",void 0);e([c.property({json:{readable:!1,writable:!1}})],a.prototype,"url",void 0);e([c.property({value:"independent",
json:{writable:!0}})],a.prototype,"visibilityMode",null);return a=e([c.subclass("esri.layers.GroupLayer")],a)}(c.declared(h,n,k,m,l))});