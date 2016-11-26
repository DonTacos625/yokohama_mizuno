// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["../../core/Accessor"],function(c){return c.createSubclass({properties:{state:{dependsOn:["view.ready"],readOnly:!0},canZoomIn:{dependsOn:["view.ready","view.scale"],readOnly:!0},canZoomOut:{dependsOn:["view.ready","view.scale"],readOnly:!0},view:{}},declaredClass:"esri.widgets.Zoom.ZoomViewModel",constructor:function(){this.zoomIn=this.zoomIn.bind(this);this.zoomOut=this.zoomOut.bind(this)},state:"disabled",_stateGetter:function(){return this.get("view.ready")?"ready":"disabled"},view:null,
_canZoomInGetter:function(){if("2d"!==this.get("view.type"))return!0;var a=this.get("view.scale"),b=this.get("view.constraints.effectiveMaxScale");return 0===b||a>b},_canZoomOutGetter:function(){if("2d"!==this.get("view.type"))return!0;var a=this.get("view.scale"),b=this.get("view.constraints.effectiveMinScale");return 0===b||a<b},zoomIn:function(){this.canZoomIn&&this._zoomToFactor(0.5)},zoomOut:function(){this.canZoomOut&&this._zoomToFactor(2)},_zoomToFactor:function(a){"ready"===this.state&&this.view.goTo({scale:this.get("view.scale")*
a})}})});