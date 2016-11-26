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

define(["require","../core/declare","../core/promiseUtils","dojo/_base/array","dojo/on","dojo/Deferred","dojo/promise/all","../layers/support/layerUtils","../geometry/support/scaleUtils","../geometry/Extent","../tasks/support/Query","../layers/GroupLayer","../core/Accessoire"],function(e,r,a,t,i,n,s,l,o,u,c,p,f){var d,h=r(f,{declaredClass:"esri.views.PopupManager",classMetadata:{properties:{map:{dependsOn:["view.map"],readOnly:!0}}},constructor:function(){this._featureLayersCache={}},destroy:function(){this._featureLayersCache={},this.view=null},_clickHandle:null,_featureLayersCache:null,enabled:!1,_enabledSetter:function(e){return this._clickHandle&&(e?this._clickHandle.resume():this._clickHandle.pause()),e},_mapGetter:function(){return this.get("view.map")||null},view:null,_viewSetter:function(e){return this._clickHandle&&(this._clickHandle.remove(),this._clickHandle=null),e&&(this._clickHandle=i.pausable(e,"click",this._clickHandler.bind(this)),this.enabled||this._clickHandle.pause()),e},getMapLayer:function(e){var r;if(e&&(r=e.findLayerById())){var a=r.id;if(this._featureLayersCache[a]){var t=a.lastIndexOf("_");t>-1&&(a=a.substring(0,t),r=this.map.findLayerById(a))}}return r},_showPopup:function(e){function r(){h.clear(),h.close()}function i(e){return d.allLayerViews.find(function(r){return r.layer===e})}function s(e){if(null==e)return!1;var r=i(e);return null==r?!1:e.loaded&&!r.suspended&&(e.popupEnabled&&e.popupTemplate||"esri.layers.GraphicsLayer"===e.declaredClass||r.getPopupData)}function l(e){var r=i(e);return r&&r.hasDraped}var f=this.map,d=this.view,h=d.popup,y=this,v=[],m="3d"===d.type;t.forEach(f.layers.toArray(),function(e){e.isInstanceOf(p)?t.forEach(e.layers.toArray(),function(e){!s(e)||m&&!l(e)||v.push(e)}):!s(e)||m&&!l(e)||v.push(e)}),d.graphics.length>0&&v.push(d.graphics);var g=null;if(e.graphic&&(e.graphic.popupTemplate||s(e.graphic.layer))&&(g=e.graphic),!v.length&&!g)return void r();var _=[],w=!!g;if(g){if(g.layer&&"esri.layers.SceneLayer"===g.layer.declaredClass){var L=d.whenLayerView(g.layer).then(function(e){var r=this._getOutFields(g.layer.popupTemplate);return e.whenGraphicAttributes(g,r)}.bind(this)),b=L.then(function(e){return[e]}).otherwise(function(){return[g]});_.unshift(b)}else if(g.getEffectivePopupTemplate()){var C=new n;_.unshift(C.resolve([g]))}}else{var x=y._calculateClickTolerance(v),M=e.mapPoint;if(!M)return void r();var T=1;d.state&&(T=d.state.resolution);var O=d.basemapTerrain;O&&O.overlayManager&&(T=O.overlayManager.overlayPixelSizeInMapUnits(M));var k=x*T;O&&!O.spatialReference.equals(d.spatialReference)&&(k*=o.getUnitValueForSR(O.spatialReference)/o.getUnitValueForSR(d.spatialReference));var D=M.clone().offset(-k,-k),E=M.clone().offset(k,k),I=new u(Math.min(D.x,E.x),Math.min(D.y,E.y),Math.max(D.x,E.x),Math.max(D.y,E.y),d.spatialReference),P=function(r){var t;if("esri.layers.ImageryLayer"===r.declaredClass){var n=new c;n.geometry=e.mapPoint;var s=i(r),l={};l.rasterAttributeTableFieldPrefix="Raster.",l.returnDomainValues=!0,l.layerView=s,t=r.queryVisibleRasters(n,l).then(function(e){return w=w||e.length>0,e})}else if("esri.layers.SceneLayer"===r.declaredClass);else if(y._featureLayersCache[r.id]||"function"==typeof r.queryFeatures&&(0===r.mode||1===r.mode)){var o=r.createQuery();o.geometry=I,t=r.queryFeatures(o).then(function(e){var r=e.features;return w=w||r.length>0,r})}else{if("esri.layers.MapImageLayer"===r.declaredClass)return s=i(r),s.getPopupData(I);var u,p=[];"esri.core.Collection<esri.Graphic>"===r.declaredClass?u=r:"esri.layers.GraphicsLayer"===r.declaredClass?u=r.graphics:(s=i(r),s&&(s.loadedGraphics||s._graphicsCollection)&&(u=s.loadedGraphics||s._graphicsCollection)),u&&(p=u.filter(function(e){return e&&e.popupTemplate&&e.visible&&I.intersects(e.geometry)}).toArray()),p.length>0&&(w=!0,t=a.resolve(p))}return t};_=t.map(v,P),_=t.filter(_,function(e){return null!=e});var F=function(e){return e.reduce(function(e,r){return e.concat(r.items?F(r.items):r)},[])};_=F(_)}var S=t.some(_,function(e){return!e.isFulfilled()});return S||w?void(_.length&&h.open({promises:_,location:e.mapPoint})):void r()},_getSubLayerFeatureLayers:function(r,a){var o=a||new n,u=[],c=r.length,p=Math.floor(this.view.extent.width/this.view.width),f=this.view.scale,h=!1,y=this;e:for(var v=0;c>v;v++){var m=r[v],g=m.dynamicLayerInfos||m.layerInfos;if(g){var _=null;m._params&&(m._params.layers||m._params.dynamicLayers)&&(_=m.visibleLayers),_=l._getVisibleLayers(g,_);for(var w=l._getLayersForScale(f,g),L=g.length,b=0;L>b;b++){var C=g[b],x=C.id,M=m.popupTemplates[x];if(!C.subLayerIds&&M&&M.popupTemplate&&t.indexOf(_,x)>-1&&t.indexOf(w,x)>-1){if(!d){h=!0;break e}var T=m.id+"_"+x,O=this._featureLayersCache[T];if(O&&O.loadError)continue;if(!O){var k=M.layerUrl;k||(k=C.source?this._getLayerUrl(m.url,"/dynamicLayer"):this._getLayerUrl(m.url,x)),O=new d(k,{id:T,drawMode:!1,mode:d.MODE_SELECTION,outFields:this._getOutFields(M.popupTemplate),resourceInfo:M.resourceInfo,source:C.source}),this._featureLayersCache[T]=O}O.setDefinitionExpression(m.layerDefinitions&&m.layerDefinitions[x]),O.setGDBVersion(m.gdbVersion),O.popupTemplate=M.popupTemplate,O.setMaxAllowableOffset(p),O.setUseMapTime(!!m.useMapTime),m.layerDrawingOptions&&m.layerDrawingOptions[x]&&m.layerDrawingOptions[x].renderer&&O.setRenderer(m.layerDrawingOptions[x].renderer),u.push(O)}}}}if(h){var D=new n;e(["../layers/FeatureLayer"],function(e){d=e,D.resolve()}),D.then(function(){y._getSubLayerFeatureLayers(r,o)})}else{var E=[];t.forEach(u,function(e){if(!e.loaded){var r=new n;i.once(e,"load, error",function(){r.resolve()}),E.push(r.promise)}}),E.length?s(E).then(function(){u=t.filter(u,function(e){return!e.loadError&&e.isVisibleAtScale(f)}),o.resolve(u)}):(u=t.filter(u,function(e){return e.isVisibleAtScale(f)}),o.resolve(u))}return o.promise},_getLayerUrl:function(e,r){var a,t=e.indexOf("?");return a=-1===t?e+"/"+r:e.substring(0,t)+"/"+r+e.substring(t)},_getOutFields:function(e){var r;return"esri.PopupTemplate"===e.declaredClass&&e.fieldInfos?(r=[],t.forEach(e.fieldInfos,function(e){var a=e.fieldName&&e.fieldName.toLowerCase();a&&"shape"!==a&&0!==a.indexOf("relationships/")&&r.push(e.fieldName)})):r=["*"],r},_calculateClickTolerance:function(e){var r=6;return t.forEach(e,function(e){var a=e.renderer;if(a)if("esri.renderer.SimpleRenderer"===a.declaredClass){var i=a.symbol;i&&i.xoffset&&(r=Math.max(r,Math.abs(i.xoffset))),i&&i.yoffset&&(r=Math.max(r,Math.abs(i.yoffset)))}else("esri.renderer.UniqueValueRenderer"===a.declaredClass||"esri.renderer.ClassBreaksRenderer"===a.declaredClass)&&t.forEach(a.infos,function(e){var a=e.symbol;a&&a.xoffset&&(r=Math.max(r,Math.abs(a.xoffset))),a&&a.yoffset&&(r=Math.max(r,Math.abs(a.yoffset)))})}),r},_clickHandler:function(e){function r(e){return i.allLayerViews.find(function(r){return r.layer===e})}function a(e){if(null==e)return!1;var a=r(e);return null==a?!1:e.loaded&&!a.suspended&&(e.popupEnabled&&e.popupTemplate||"esri.layers.GraphicsLayer"===e.declaredClass||a.getPopupData)}function t(e){var a=r(e);return a&&a.hasDraped}var i=this.view,n=i.popup,s=i.map,l=e.screenPoint,o=this;if(n&&i.ready){var u="3d"===i.type,c=s.allLayers.some(function(e){return e.isInstanceOf(p)?!1:!a(e)||u&&!t(e)?!1:!0});return null!=l?void this.view.hitTest(l.x,l.y).then(function(r){r.results.length>0?o._showPopup(r.results[0]):c&&o._showPopup(e)}):void o._showPopup(e)}}});return h});