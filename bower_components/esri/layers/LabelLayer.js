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

define(["dojo/_base/array","../core/declare","dojo/_base/lang","dojox/gfx/_base","../core/lang","../geometry/Extent","../geometry/Point","../geometry/support/webMercatorUtils","../Graphic","../renderers/SimpleRenderer","../symbols/ShieldLabelSymbol","../symbols/TextSymbol","./GraphicsLayer","./labelLayerUtils/DynamicLabelClass","./labelLayerUtils/StaticLabelClass","./support/LabelClass"],function(e,t,r,i,n,a,s,o,l,h,b,f,c,L,v,m){function p(e){return"size"===e.type}var g=t(c,{declaredClass:"esri.layers.LabelLayer",constructor:function(e){this.id="labels",this.featureLayers=[],this._featureLayerInfos=[],this._preparedLabels=[],this._engineType="STATIC",this._mapEventHandlers=[],e&&(e.id&&(this.id=e.id),e.mode&&(this._engineType="DYNAMIC"===e.mode.toUpperCase()?"DYNAMIC":"STATIC"))},_setMap:function(e){var t=this.inherited(arguments);return this._map&&this._mapEventHandlers.push(this._map.on("extent-change",r.hitch(this,"refresh"))),this.refresh(),t},_unsetMap:function(){var e;for(e=0;e<this._mapEventHandlers.length;e++)this._mapEventHandlers[e].remove();this.refresh(),this.inherited(arguments)},setAlgorithmType:function(e){this._engineType=e&&"DYNAMIC"===e.toUpperCase()?"DYNAMIC":"STATIC",this.refresh()},addFeatureLayer:function(e,t,i,n){if(!this.getFeatureLayer(e.layerId)){var a=[];a.push(e.on("update-end",r.hitch(this,"refresh"))),a.push(e.on("suspend",r.hitch(this,"refresh"))),a.push(e.on("resume",r.hitch(this,"refresh"))),a.push(e.on("edits-complete",r.hitch(this,"refresh"))),a.push(e.on("labeling-info-change",r.hitch(this,"refresh"))),a.push(e.on("time-extent-change",r.hitch(this,"refresh"))),a.push(e.on("show-labels-change",r.hitch(this,"refresh"))),this._featureLayerInfos.push({FeatureLayer:e,LabelExpressionInfo:i,LabelingOptions:n,LabelRenderer:t,EventHandlers:a}),this.featureLayers.push(e),this.refresh()}},getFeatureLayer:function(e){var t,r;for(t=0;t<this.featureLayers.length;t++)if(r=this.featureLayers[t],void 0!==r&&r.id==e)return r;return null},removeFeatureLayer:function(t){var r,i,n;if(i=this.getFeatureLayer(t),void 0!==i&&(n=e.indexOf(this.featureLayers,i),n>-1)){for(this.featureLayers.splice(n,1),r=0;r<this._featureLayerInfos[n].EventHandlers.length;r++)this._featureLayerInfos[n].EventHandlers[r].remove();this._featureLayerInfos.splice(n,1),this.refresh()}},removeAllFeatureLayers:function(){var e;for(e=0;e<this.featureLayers.length;e++){for(var t=0;t<this._featureLayerInfos[e].EventHandlers.length;t++)this._featureLayerInfos[e].EventHandlers[t].remove();this.featureLayers=[],this._featureLayerInfos=[]}this.refresh()},getFeatureLayers:function(){return this.featureLayers},getFeatureLayerInfo:function(e){var t,r;for(t=0;t<this.featureLayers.length;t++)if(r=this.featureLayers[t],void 0!==r&&r.id==e)return this._featureLayerInfos[t];return null},refresh:function(e){var t,r,i,n,a,s,o,l,b=[],f="DYNAMIC"===this._engineType?new L:new v;if(this._map){for(f.setMap(this._map,this),this._preparedLabels=[],r=0;r<this.featureLayers.length;r++)if(i=this.featureLayers[r],i.visible&&i.labelsVisible&&i.visibleAtMapScale&&!i._suspended)if(n=this._featureLayerInfos[r],n.LabelRenderer){if(b=i.labelingInfo,b&&(l=b[0],l&&(s=l.getLabelExpression(),o=this._convertOptions(l))),a=n.LabelRenderer,n.LabelExpressionInfo&&(s=n.LabelExpressionInfo),n.LabelingOptions){if(o=this._convertOptions(null),void 0!==n.LabelingOptions.pointPriorities){var c=n.LabelingOptions.pointPriorities;"above-center"==c||"AboveCenter"==c||"esriServerPointLabelPlacementAboveCenter"==c?o.pointPriorities="AboveCenter":"above-left"==c||"AboveLeft"==c||"esriServerPointLabelPlacementAboveLeft"==c?o.pointPriorities="AboveLeft":"above-right"==c||"AboveRight"==c||"esriServerPointLabelPlacementAboveRight"==c?o.pointPriorities="AboveRight":"below-center"==c||"BelowCenter"==c||"esriServerPointLabelPlacementBelowCenter"==c?o.pointPriorities="BelowCenter":"below-left"==c||"BelowLeft"==c||"esriServerPointLabelPlacementBelowLeft"==c?o.pointPriorities="BelowLeft":"below-right"==c||"BelowRight"==c||"esriServerPointLabelPlacementBelowRight"==c?o.pointPriorities="BelowRight":"center-center"==c||"CenterCenter"==c||"esriServerPointLabelPlacementCenterCenter"==c?o.pointPriorities="CenterCenter":"center-left"==c||"CenterLeft"==c||"esriServerPointLabelPlacementCenterLeft"==c?o.pointPriorities="CenterLeft":"center-right"==c||"CenterRight"==c||"esriServerPointLabelPlacementCenterRight"==c?o.pointPriorities="CenterRight":o.pointPriorities="AboveRight"}void 0!==n.LabelingOptions.lineLabelPlacement&&(o.lineLabelPlacement=n.LabelingOptions.lineLabelPlacement),void 0!==n.LabelingOptions.lineLabelPosition&&(o.lineLabelPosition=n.LabelingOptions.lineLabelPosition),void 0!==n.LabelingOptions.labelRotation&&(o.labelRotation=n.LabelingOptions.labelRotation),void 0!==n.LabelingOptions.howManyLabels&&(o.howManyLabels=n.LabelingOptions.howManyLabels)}a instanceof m&&(s=a.getLabelExpression(),a=new h({symbol:a.symbol}),o=this._convertOptions(a)),this._addLabels(i,a,s,o)}else if(b=i.labelingInfo)for(t=b.length-1;t>=0;t--)l=b[t],l&&(a=new m(l instanceof m?l.toJSON():l),s=l.getLabelExpression(),o=this._convertOptions(l),this._addLabels(i,a,s,o));var p=f._process(this._preparedLabels);this.removeAll(),this.drawLabels(this._map,p)}},drawLabels:function(e,t){this._scale=(e.extent.xmax-e.extent.xmin)/e.width;var r;for(r=0;r<t.length;r++){var i=t[r],n=i.layer,a=i.x,o=i.y,h=i.text,b=i.angle,c=i.layer.labelSymbol;"polyline"==n.geometry.type&&i.layer.options.labelRotation?c.setAngle(b*(180/Math.PI)):c.setAngle(0),c.setText(h);var L=a,v=o;if(c instanceof f){var m=c.getHeight(),p=Math.sin(b);L-=.25*m*this._scale*p,v-=.33*m*this._scale}var g=new l(new s(L,v,e.extent.spatialReference));g.setSymbol(c),this.add(g)}},_addLabels:function(e,t,r,i){var n,a,s,l,h=t.minScale,b=t.maxScale;if(this._isWithinScaleRange(h,b)&&r&&""!==r){var f=this._map,c=!e.url&&!f.spatialReference.equals(e.spatialReference);for(n=0;n<e.graphics.length;n++)if(a=e.graphics[n],a.visible!==!1){if(s=a.geometry,c){if(!o.canProject(s,f))continue;s=o.project(s,f)}s&&m.evaluateWhere(t.where,a.attributes)&&this._isWithinScreenArea(s)&&(l=m.buildLabelText(r,a.attributes,e.fields,i),this._addLabel(l,t,e.renderer,a,i,s,f))}}},_isWithinScreenArea:function(e){var t;if(t="point"===e.type?new a(e.x,e.y,e.x,e.y,e.spatialReference):e.getExtent(),void 0===t)return!1;var r=this._intersects(this._map,t);return null===r||0===r.length?!1:!0},_isWithinScaleRange:function(e,t){var r=this._map.getScale();return e>0&&r>=e?!1:t>0&&t>=r?!1:!0},_getSizeInfo:function(t){return t?t.sizeInfo||e.filter(t.visualVariables,p)[0]:null},_addLabel:function(e,t,n,a,s,o,l){var h,c,L,v;if(e&&""!==r.trim(e)&&t){e=e.replace(/\s+/g," "),h=t.getSymbol(a),h instanceof f?(h=new f(h.toJSON()),h.setVerticalAlignment("baseline"),h.setHorizontalAlignment("center")):h=h instanceof b?new b(h.toJSON()):new f,h.setText(e),t.symbol=h;var m=this._getProportionalSize(t.sizeInfo,a.attributes);if(m&&(h instanceof f?h.setSize(m):h instanceof b&&(h.setWidth(m),h.setHeight(m))),L=0,v=0,n){c=n.getSymbol(a);var p,g=this._getSizeInfo(n);g&&(p=n.getSize(a,{sizeInfo:g,resolution:l.getResolutionInMeters()})),null!=p?L=v=p:c&&("simple-marker-symbol"==c.type?(L=c.size,v=c.size):"picture-marker-symbol"==c.type?(L=c.width,v=c.height):("simple-line-symbol"==c.type||"cartographic-line-symbol"==c.type)&&(L=c.width))}var u={};u.graphic=a,u.options=s,u.geometry=o,u.labelRenderer=t,u.labelSymbol=h,u.labelWidth=h.getWidth()/2,u.labelHeight=h.getHeight()/2,u.symbolWidth=i.normalizedLength(L)/2,u.symbolHeight=i.normalizedLength(v)/2,u.text=e,u.angle=h.angle,this._preparedLabels.push(u)}},_getProportionalSize:function(e,t){if(!e)return null;var r=n.substitute(t,"{"+e.field+"}",{first:!0});if(!e.minSize||!e.maxSize||!e.minDataValue||!e.maxDataValue||!r||e.maxDataValue-e.minDataValue<=0)return null;var i=(e.maxSize-e.minSize)/(e.maxDataValue-e.minDataValue),a=i*(r-e.minDataValue)+e.minSize;return a},_convertOptions:function(e){var t="shortDate",r=null,i="",n="AboveRight",a="PlaceAtCenter",s="Above",o=!0,l="OneLabel";return e&&(void 0!==e.format&&(t=e.format.dateFormat,r={places:e.format.places,digitSeparator:e.format.digitSeparator}),i=e.labelPlacement),n="above-center"==i||"esriServerPointLabelPlacementAboveCenter"==i?"AboveCenter":"above-left"==i||"esriServerPointLabelPlacementAboveLeft"==i?"AboveLeft":"above-right"==i||"esriServerPointLabelPlacementAboveRight"==i?"AboveRight":"below-center"==i||"esriServerPointLabelPlacementBelowCenter"==i?"BelowCenter":"below-left"==i||"esriServerPointLabelPlacementBelowLeft"==i?"BelowLeft":"below-right"==i||"esriServerPointLabelPlacementBelowRight"==i?"BelowRight":"center-center"==i||"esriServerPointLabelPlacementCenterCenter"==i?"CenterCenter":"center-left"==i||"esriServerPointLabelPlacementCenterLeft"==i?"CenterLeft":"center-right"==i||"esriServerPointLabelPlacementCenterRight"==i?"CenterRight":"AboveRight",a="above-start"==i||"below-start"==i||"center-start"==i?"PlaceAtStart":"above-end"==i||"below-end"==i||"center-end"==i?"PlaceAtEnd":"PlaceAtCenter",s="above-after"==i||"esriServerLinePlacementAboveAfter"==i||"above-along"==i||"esriServerLinePlacementAboveAlong"==i||"above-before"==i||"esriServerLinePlacementAboveBefore"==i||"above-start"==i||"esriServerLinePlacementAboveStart"==i||"above-end"==i||"esriServerLinePlacementAboveEnd"==i?"Above":"below-after"==i||"esriServerLinePlacementBelowAfter"==i||"below-along"==i||"esriServerLinePlacementBelowAlong"==i||"below-before"==i||"esriServerLinePlacementBelowBefore"==i||"below-start"==i||"esriServerLinePlacementBelowStart"==i||"below-end"==i||"esriServerLinePlacementBelowEnd"==i?"Below":"center-after"==i||"esriServerLinePlacementCenterAfter"==i||"center-along"==i||"esriServerLinePlacementCenterAlong"==i||"center-before"==i||"esriServerLinePlacementCenterBefore"==i||"center-start"==i||"esriServerLinePlacementCenterStart"==i||"center-end"==i||"esriServerLinePlacementCenterEnd"==i?"OnLine":"Above",("always-horizontal"==i||"esriServerPolygonPlacementAlwaysHorizontal"==i)&&(o=!1),{dateFormat:t,numberFormat:r,pointPriorities:n,lineLabelPlacement:a,lineLabelPosition:s,labelRotation:o,howManyLabels:l}}});return g});