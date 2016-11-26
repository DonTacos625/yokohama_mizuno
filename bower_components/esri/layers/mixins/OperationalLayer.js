// COPYRIGHT © 2016 Esri
//
// All rights reserved under the copyright laws of the United States
// and applicable international laws, treaties, and conventions.
//
// This material is licensed for use under the Esri Master License
// Agreement (MLA), and is bound by the terms of that agreement.
// You may redistribute and use this code without modification,
// provided you adhere to the terms of the MLA and include this
// copyright notice.
//
// See use restrictions at http://www.esri.com/legal/pdfs/mla_e204_e300/english
//
// For additional information, contact:
// Environmental Systems Research Institute, Inc.
// Attn: Contracts and Legal Services Department
// 380 New York Street
// Redlands, California, USA 92373
// USA
//
// email: contracts@esri.com
//
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.

define(["require","exports","../../core/tsSupport/declareExtendsHelper","../../core/tsSupport/decorateHelper","../../core/accessorSupport/decorators","../../core/Accessor","../../core/MultiOriginJSONSupport","../../core/Error","../../core/accessorSupport/read"],function(e,r,t,i,a,o,p,y,n){function s(){return o}var c=function(e){function r(){e.apply(this,arguments)}return t(r,e),r.prototype.writeListMode=function(e,r){e&&(r.listMode=e)},r.prototype.writeOperationalLayerType=function(e,r){e&&(r.layerType=e)},r.prototype.readOpacity=function(e,r){return void 0!==r.opacity?r.opacity:r.drawingInfo&&void 0!==r.drawingInfo.transparency?1-r.drawingInfo.transparency/100:void 0},r.prototype.readVisible=function(e,r){return!!r.visibility},r.prototype.read=function(e,r){var t=this,i=arguments;return n.readLoadable(this,e,function(r){return t.inherited(i,[e,r])},r),this},r.prototype.write=function(e,r){if(r&&r.origin){var t=r.origin+"/"+(r.layerContainerType||"operational-layers"),i=d[t];if(i&&!i[this.operationalLayerType])return r.messages&&r.messages.push(new y("layer:unsupported","Layers ("+this.title+", "+this.id+") of type '"+this.declaredClass+"' are not supported in the context of '"+t+"'",{layer:this})),null;if(!this.url&&!l[this.operationalLayerType])return r.messages&&r.messages.push(new y("layer:unsupported","Layers ("+this.title+", "+this.id+") of type '"+this.declaredClass+"' require a url to a service to be written to a '"+r.origin+"'",{layer:this})),null}return this.inherited(arguments,[e,r])},i([a.property({json:{writable:!0,writeAlways:!0}})],r.prototype,"id",void 0),i([a.property()],r.prototype,"listMode",void 0),i([a.write("listMode")],r.prototype,"writeListMode",null),i([a.property({json:{writable:!0,writeAlways:!0}})],r.prototype,"title",void 0),i([a.property({json:{writable:!0,writeAlways:!0}})],r.prototype,"url",void 0),i([a.property({json:{writeTo:"layerType",writeAlways:!0}})],r.prototype,"operationalLayerType",void 0),i([a.write("operationalLayerType")],r.prototype,"writeOperationalLayerType",null),i([a.property({json:{writable:!0,writeAlways:!0}})],r.prototype,"opacity",void 0),i([a.read("opacity",["opacity","drawingInfo.transparency"])],r.prototype,"readOpacity",null),i([a.property({json:{writeTo:"visibility",writeAlways:!0}})],r.prototype,"visible",void 0),i([a.read("visible",["visibility"])],r.prototype,"readVisible",null),r=i([a.subclass("esri.layers.mixins.OperationalLayer")],r)}(a.declared(s(),p)),l={GroupLayer:!0,WebTiledLayer:!0,OpenStreetMap:!0,ArcGISFeatureLayer:!0},d={"web-scene/operational-layers":{ArcGISFeatureLayer:!0,ArcGISMapServiceLayer:!0,ArcGISSceneServiceLayer:!0,ArcGISTiledElevationServiceLayer:!0,ArcGISTiledImageServiceLayer:!0,ArcGISTiledMapServiceLayer:!0,GroupLayer:!0,IntegratedMeshLayer:!0,WebTiledLayer:!0},"web-scene/basemap":{ArcGISTiledElevationServiceLayer:!0,ArcGISTiledImageServiceLayer:!0,ArcGISTiledMapServiceLayer:!0,WebTiledLayer:!0,OpenStreetMap:!0},"web-scene/ground":{ArcGISTiledElevationServiceLayer:!0},"web-map/operational-layers":{ArcGISImageServiceLayer:!0,ArcGISImageServiceVectorLayer:!0,ArcGISMapServiceLayer:!0,ArcGISStreamLayer:!0,ArcGISTiledImageServiceLayer:!0,ArcGISTiledMapServiceLayer:!0,ArcGSFeatureLayer:!0,CSV:!0,GeoRSS:!0,KML:!0,VectorTileLayer:!0,WMS:!0,WebTiledLayer:!0},"web-map/basemap":{ArcGISImageServiceLayer:!0,ArcGISImageServiceVectorLayer:!0,ArcGISMapServiceLayer:!0,ArcGISTiledImageServiceLayer:!0,ArcGISTiledMapServiceLayer:!0,OpenStreetMap:!0,VectorTileLayer:!0,WMS:!0,WebTiledLayer:!0,bingLayer:!0}};return c});