// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("dojo/_base/lang dojo/dom dojo/dom-construct dojo/dom-class ../Graphic ../core/Accessor ../core/Collection ../core/CollectionFlattener ../core/Evented ../core/HandleRegistry ../core/Promise ../core/watchUtils ../core/promiseUtils ../core/Scheduler ../geometry/SpatialReference ../geometry/Extent ./BreakpointsOwner ./DOMContainer ./LayerViewManager ./BasemapView ./GroundView ./PopupManager ./ui/DefaultUI ./support/DefaultsFromMap ../widgets/Popup".split(" "),function(k,e,c,f,l,m,g,n,p,q,r,d,
s,t,u,v,w,x,y,z,A,B,C,h,D){return m.createSubclass([r,x,p,w],{declaredClass:"esri.views.View",properties:{allLayerViews:{readOnly:!0},basemapView:{},container:{},animation:{},resizing:{},interacting:{},graphics:{type:g.ofType(l)},groundView:{},defaultsFromMap:h,initialExtent:{readOnly:!0,type:v,dependsOn:["defaultsFromMap.extent"]},initialExtentRequired:{},layerViews:{type:g},map:{},popup:{type:D},ready:{readOnly:!0,dependsOn:"map spatialReference surface width height suspended initialExtentRequired initialExtent defaultsFromMap.isDone map.loaded".split(" ")},
root:{},spatialReference:{type:u,dependsOn:["defaultsFromMap.spatialReference"]},stationary:{dependsOn:["animation","interacting","resizing"]},surface:{},type:{},ui:{type:C},updating:{},padding:{},width:{},height:{},suspended:{}},constructor:function(a){this._viewHandles=new q;this._viewHandles.add(this.watch("ready",function(a,E){this._currentSpatialReference=a?this.spatialReference:null;this.notifyChange("spatialReference");!a&&E&&this.layerViewManager.empty()}.bind(this)));this.allLayerViews=new n({root:this,
rootCollectionNames:["basemapView.baseLayerViews","groundView.layerViews","layerViews","basemapView.referenceLayerViews"],getChildrenFunction:function(a){return a.layerViews}});this.defaultsFromMap=new h({view:this})},getDefaults:function(){return k.mixin(this.inherited(arguments),{layerViews:[],graphics:[],padding:{left:0,top:0,right:0,bottom:0},popup:{},ui:{}})},initialize:function(){var a=this.validate().then(function(){this._isValid=!0;this.notifyChange("ready");return d.whenOnce(this,"ready")}.bind(this));
this.addResolvingPromise(a);this.basemapView=new z({view:this});this.groundView=new A({view:this});this.layerViewManager=new y({view:this});this._resetInitialViewPropertiesFromContent()},destroy:function(){this.basemapView.destroy();this.groundView.destroy();this.destroyLayerViews();this.ui.destroy();this.popup&&this.popup.destroy();this.defaultsFromMap.destroy();this.defaultsFromMap=null;this._viewHandles.destroy();this.container=this.map=null},destroyLayerViews:function(){this.layerViewManager.destroy()},
_viewHandles:null,_isValid:!1,_readyCycleForced:!1,_userSpatialReference:null,_currentSpatialReference:null,activeTool:"navigation",animation:null,basemapView:null,groundView:null,container:null,_containerSetter:function(a){a=e.byId(a);var b=this._get("container");b!==a&&(b&&(f.remove(b,"esri-view"),this.popupManager.destroy(),this.popupManager=null,c.destroy(this.root),this.root=null),a?(f.add(a,"esri-view"),this.root=c.create("div",{className:"esri-view-root"},a,"first"),this.surface=c.create("div",
{className:"esri-view-surface"},this.root),e.setSelectable(this.surface,!1),this._forceReadyCycle(),this.popupManager=new B({enabled:!0,view:this})):this.surface=null,this._set("container",a))},graphics:null,_graphicsSetter:function(a){this._graphicsView&&(this._graphicsView.graphics=a);this._set("graphics",a)},interacting:!1,_interactingSetter:function(a){var b=this.surface;b&&b.setAttribute("data-interacting",a);this._set("interacting",a)},layerViews:null,map:null,_mapSetter:function(a){var b=this._get("map");
a!==b&&(a&&a.load&&a.load(),this._forceReadyCycle(),this._resetInitialViewPropertiesFromContent(),this._set("map",a))},padding:null,_popupSetter:function(a){var b=this._get("popup");if(a===b)return b;this._viewHandles.remove("view-popup");b&&b.destroy();a&&(a.viewModel.view=this,a._started||a.startup(),this._viewHandles.add([d.init(this,"root",function(b,d){var c=a.domNode;e.isDescendant(c.parentNode,d)&&c.parentNode.removeChild(c);b&&!c.parentNode&&a.placeAt(b)})],"view-popup"));this._set("popup",
a)},_readyGetter:function(){return!(!this._isValid||this._readyCycleForced||!this.map||!(null!=this.surface&&0!==this.width&&0!==this.height&&this.spatialReference&&(!this.map.load||this.map.loaded)&&(this._currentSpatialReference||!this.initialExtentRequired||this.initialExtent||this.defaultsFromMap&&this.defaultsFromMap.isDone)&&this.isSpatialReferenceSupported(this.spatialReference)))},spatialReference:null,_spatialReferenceGetter:function(){return this._userSpatialReference||this._currentSpatialReference||
this.getDefaultSpatialReference()||null},_spatialReferenceSetter:function(a){this._userSpatialReference=a;this._set("spatialReference",a)},stationary:!0,_stationaryGetter:function(){return!this.animation&&!this.interacting&&!this.resizing},surface:null,type:null,_uiSetter:function(a){var b=this._get("ui");a!==b&&(this._viewHandles.remove("ui"),b&&b.destroy(),a&&(a.view=this,this._viewHandles.add([d.init(this,"root",function(b){a.container=b?c.create("div",null,b):null})],"ui")),this._set("ui",a))},
updating:!1,initialExtentRequired:!0,initialExtent:null,_initialExtentGetter:function(){return this.defaultsFromMap&&this.defaultsFromMap.extent},whenLayerView:function(a){return this.layerViewManager.whenLayerView(a)},addHandler:function(a){this.gestureManager&&this.gestureManager.addHandler(a);return this},removeHandler:function(a){this.gestureManager&&this.gestureManager.removeHandler(a);return this},pageToContent:function(a,b,c){var d=this.padding;c=this.pageToContainer(a,b,c);d&&(c[0]-=d.left,
c[1]-=d.top);return c},getDefaultSpatialReference:function(){return this.get("defaultsFromMap.spatialReference")},validate:function(){return s.resolve()},isSpatialReferenceSupported:function(){return!0},_resetInitialViewPropertiesFromContent:function(){if(this.defaultsFromMap){var a=this.defaultsFromMap.start.bind(this.defaultsFromMap);this.defaultsFromMap.reset();this._currentSpatialReference=null;this.notifyChange("spatialReference");this._viewHandles.remove("defaultsFromMap");this._viewHandles.add([d.watch(this,
"spatialReference",a),d.watch(this,"initialExtentRequired",a),t.schedule(a)],"defaultsFromMap")}},_forceReadyCycle:function(){this.ready&&(this._readyCycleForced=!0,this.notifyChange("ready"),d.whenFalseOnce(this,"ready",function(){this._readyCycleForced=!1;this.notifyChange("ready")}.bind(this)))}})});