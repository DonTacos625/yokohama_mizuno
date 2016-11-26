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

define(["require","../core/declare","dojo/_base/lang","dojo/_base/array","../Color","../core/lang","../symbols/SimpleMarkerSymbol","../symbols/PictureMarkerSymbol","../symbols/SimpleLineSymbol","../symbols/support/jsonUtils","./Renderer","./ClassBreaksRenderer"],function(e,r,t,i,n,L,a,s,o,l,d,M){var u={STYLE_WIND_BARBS:"wind_speed",STYLE_SINGLE_ARROW:"single_arrow",STYLE_CLASSIFIED_ARROW:"classified_arrow",STYLE_BEAUFORT_KN:"beaufort_kn",STYLE_BEAUFORT_METER:"beaufort_m",STYLE_BEAUFORT_MILE:"beaufort_mi",STYLE_BEAUFORT_FEET:"beaufort_ft",STYLE_BEAUFORT_KM:"beaufort_km",STYLE_OCEAN_CURRENT_M:"ocean_current_m",STYLE_OCEAN_CURRENT_KN:"ocean_current_kn",STYLE_SCALAR:"simple_scalar"},_={FLOW_FROM:"flow_from",FLOW_TO:"flow_to"},f=r(d,{declaredClass:"esri.renderer.VectorFieldRenderer",iconFolderPath:"../symbols/patterns/",constructor:function(e){L.isDefined(e)||(e={}),e.attributeField=e.attributeField||"Magnitude",e.rotationInfo=e.rotationInfo||this._getRotationInfo(e),r.safeMixin(this,e),this.style=this.style||f.STYLE_SINGLE_ARROW,this.singleArrowSymbol&&(this.singleArrowSymbol=this.singleArrowSymbol.declaredClass?this.singleArrowSymbol:l.fromJSON(this.singleArrowSymbol)),this.renderer=new M({defaultSymbol:this._getDefaultSymbol(),attributeField:e.attributeField}),this._updateRenderer(this.style),this.flowRepresentation=this.flowRepresentation||this.FLOW_FROM},getSymbol:function(e){return this.renderer&&this.renderer.getSymbol(e)},setVisualVariables:function(e){return e=i.filter(e,function(e){return"size"===e.type?L.isDefined(this._updateSizeInfo(e)):void 0},this),this.inherited(arguments),this},setSizeInfo:function(e){return this._updateSizeInfo(e),this.inherited(arguments),this},setProportionalSymbolInfo:function(e){return this.setSizeInfo(e),this},setColorInfo:function(e){return this},_updateRenderer:function(e){return L.isDefined(this.renderer)?e===f.STYLE_SINGLE_ARROW?this._createSingleArrowRenderer():e===f.STYLE_BEAUFORT_KN?this._createBeaufortKnotsRenderer():e===f.STYLE_BEAUFORT_METER?this._createBeaufortMeterRenderer():e===f.STYLE_BEAUFORT_FEET?this._createBeaufortFeetRenderer():e===f.STYLE_BEAUFORT_MILE?this._createBeaufortMilesRenderer():e===f.STYLE_BEAUFORT_KM?this._createBeaufortKilometersRenderer():e===f.STYLE_OCEAN_CURRENT_M?this._createCurrentMeterRenderer():e===f.STYLE_OCEAN_CURRENT_KN?this._createCurrentKnotsRenderer():e===f.STYLE_SCALAR?this._createSimpleScalarRenderer():e===f.STYLE_WIND_BARBS?this._createWindBarbsRenderer():this._createClassifiedArrowRenderer():new Error("Invalid Renderer!")},_updateSizeInfo:function(e){return e&&L.isDefined(e.minSize)&&L.isDefined(e.maxSize)&&L.isDefined(e.minDataValue)&&L.isDefined(e.maxDataValue)?(this.style===f.STYLE_WIND_BARBS&&(e.minSize=e.maxSize),e.field=e.field||"Magnitude",e.type="size",e):null},_createClassifiedArrowRenderer:function(){this.renderer.defaultSymbol=this._getDefaultSymbol(new n([56,168,0]));var e=[0,1e-6,3.5,7,10.5,14];if(L.isDefined(this.minDataValue)&&L.isDefined(this.maxDataValue)){var r=(this.maxDataValue-this.minDataValue)/5;e=[];var t,i;for(i=this.minDataValue,t=0;6>t;t++)e[t]=i,i+=r}var a=[[56,168,0],[139,309,0],[255,255,0],[255,128,0],[255,0,0]];this._addBreaks(e,a)},_createSingleArrowRenderer:function(){this.renderer.defaultSymbol=this.singleArrowSymbol||this._getDefaultSymbol()},_createBeaufortMeterRenderer:function(){this.renderer.defaultSymbol=this._getDefaultSymbol(new n([214,47,39]));var e=[0,.2,1.8,3.3,5.4,8.5,11,14.1,17.2,20.8,24.4,28.6,32.7],r=[[69,117,181],[101,137,184],[132,158,186],[162,180,189],[192,204,190],[222,227,191],[255,255,191],[255,220,161],[250,185,132],[245,152,105],[237,117,81],[232,21,21]];this._addBreaks(e,r)},_createBeaufortKnotsRenderer:function(){this.renderer.defaultSymbol=this._getDefaultSymbol(new n([214,47,39]));var e=[0,1,3,6,10,16,21,27,33,40,47,55,63],r=[[40,146,199],[89,162,186],[129,179,171],[160,194,155],[191,212,138],[218,230,119],[250,250,100],[252,213,83],[252,179,102],[250,141,52],[247,110,42],[240,71,29]];this._addBreaks(e,r)},_createBeaufortFeetRenderer:function(){var e=3.28084,r=[0,.2,1.8,3.3,5.4,8.5,11,14.1,17.2,20.8,24.4,28.6,32.7];i.forEach(r,function(t,i){r[i]*=e}),this.renderer.defaultSymbol=this._getDefaultSymbol(new n([214,47,39]));var t=[[69,117,181],[101,137,184],[132,158,186],[162,180,189],[192,204,190],[222,227,191],[255,255,191],[255,220,161],[250,185,132],[245,152,105],[237,117,81],[232,21,21]];this._addBreaks(r,t)},_createBeaufortMilesRenderer:function(){var e=2.23694,r=[0,.2,1.8,3.3,5.4,8.5,11,14.1,17.2,20.8,24.4,28.6,32.7];i.forEach(r,function(t,i){r[i]*=e}),this.renderer.defaultSymbol=this._getDefaultSymbol(new n([214,47,39]));var t=[[69,117,181],[101,137,184],[132,158,186],[162,180,189],[192,204,190],[222,227,191],[255,255,191],[255,220,161],[250,185,132],[245,152,105],[237,117,81],[232,21,21]];this._addBreaks(r,t)},_createBeaufortKilometersRenderer:function(){var e=3.6,r=[0,.2,1.8,3.3,5.4,8.5,11,14.1,17.2,20.8,24.4,28.6,32.7];i.forEach(r,function(t,i){r[i]*=e}),this.renderer.defaultSymbol=this._getDefaultSymbol(new n([214,47,39]));var t=[[69,117,181],[101,137,184],[132,158,186],[162,180,189],[192,204,190],[222,227,191],[255,255,191],[255,220,161],[250,185,132],[245,152,105],[237,117,81],[232,21,21]];this._addBreaks(r,t)},_createCurrentMeterRenderer:function(){this.renderer.defaultSymbol=this._getDefaultSymbol(new n([177,177,177]));var e=[0,.5,1,1.5,2],r=[[78,26,153],[179,27,26],[202,128,26],[177,177,177]];this._addBreaks(e,r)},_createCurrentKnotsRenderer:function(){this.renderer.defaultSymbol=this._getDefaultSymbol(new n([177,177,177]));var e=[0,.25,.5,1,1.5,2,2.5,3,3.5,4],r=[[0,0,0],[0,37,100],[78,26,153],[151,0,100],[179,27,26],[177,78,26],[202,128,26],[177,179,52],[177,177,177]];this._addBreaks(e,r)},_createSimpleScalarRenderer:function(){this.renderer.defaultSymbol=new s({url:e.toUrl(this.iconFolderPath+"scalar.png"),height:20,width:20,type:"picture-marker-symbol",angle:0})},_createWindBarbsRenderer:function(){var r,t,i=[];for(r=0;150>=r;r+=5)i.push(r);t=["M20 20 M5 20 A15 15 0 1 0 35 20 A15 15 0 1 0 5 20 M20 20 M10 20 A10 10 0 1 0 30 20 A10 10 0 1 0 10 20","M25 0 L25 40 M25 35 L17.5 37.5","M25 0 L25 40 L10 45 L25 40","M25 0 L25 40 L10 45 L25 40 M25 35 L17.5 37.5","M25 0 L25 40 L10 45 L25 40 M25 35 L10 40","M25 0 L25 40 L10 45 L25 40 M25 35 L10 40 L25 35 M25 30 L17.5 32.5","M25 0 L25 40 L10 45 L25 40 M25 35 L10 40 L25 35 M25 30 L10 35","M25 0 L25 40 L10 45 L25 40 M25 35 L10 40 L25 35 M25 30 L10 35 L25 30 M25 25 L17.5 27.5","M25 0 L25 40 L10 45 L25 40 M25 35 L10 40 L25 35 M25 30 L10 35 L25 30 M25 25 L10 30","M25 0 L25 40 L10 45 L25 40 M25 35 L10 40 L25 35 M25 30 L10 35 L25 30 M25 25 L10 30 L25 25 M25 20 L17.5 22.5","M25 0 L25 40 L10 40 L25 35","M25 0 L25 40 L10 40 L25 35 M25 30 L17.5 32.5","M25 0 L25 40 L10 40 L25 35 M25 30 L10 35","M25 0 L25 40 L10 40 L25 35 M25 30 L10 35 L25 30 M25 25 L17.5 27.5","M25 0 L25 40 L10 40 L25 35 M25 30 L10 35 L25 30 M25 25 L10 30","M25 0 L25 40 L10 40 L25 35 M25 30 L10 35 L25 30 M25 25 L10 30 L25 25 M25 20 L17.5 22.5","M25 0 L25 40 L10 40 L25 35 M25 30 L10 35 L25 30 M25 25 L10 30 L25 25 M25 20 L10 25","M25 0 L25 40 L10 40 L25 35 M25 30 L10 35 L25 30 M25 25 L10 30 L25 25 M25 20 L10 25 L25 20 M25 15 L17.5 17.5","M25 0 L25 40 L10 40 L25 35 M25 30 L10 35 L25 30 M25 25 L10 30 L25 25 M25 20 L10 25 L25 20 M25 15 L10 20","M25 0 L25 40 L10 40 L25 35 M25 30 L10 35 L25 30 M25 25 L10 30 L25 25 M25 20 L10 25 L25 20 M25 15 L10 20 L25 15 M25 10 L17.5 12.5","M25 0 L25 40 L10 40 L25 35 L10 35 L25 30","M25 0 L25 40 L10 40 L25 35 L10 35 L25 30 M25 25 L17.5 27.5","M25 0 L25 40 L10 40 L25 35 L10 35 L25 30 M25 25 L10 30","M25 0 L25 40 L10 40 L25 35 L10 35 L25 30 M25 25 L10 30 M25 25 M25 20 L17.5 22.5","M25 0 L25 40 L10 40 L25 35 L10 35 L25 30 M25 25 L10 30 M25 25 M25 20 L10 25","M25 0 L25 40 L10 40 L25 35 L10 35 L25 30 M25 25 L10 30 M25 25 M25 20 L10 25 M25 20 M25 15 L17.5 17.5","M25 0 L25 40 L10 40 L25 35 L10 35 L25 30 M25 25 L10 30 M25 25 M25 20 L10 25 M25 20 M25 15 L10 20","M25 0 L25 40 L10 40 L25 35 L10 35 L25 30 M25 25 L10 30 M25 25 M25 20 L10 25 M25 20 M25 15 L10 20 M25 15 M25 10 L17.5 12.5","M25 0 L25 40 L10 40 L25 35 L10 35 L25 30 M25 25 L10 30 M25 25 M25 20 L10 25 M25 20 M25 15 L10 20 M25 15 M25 10 L10 15","M25 0 L25 40 L10 40 L25 35 L10 35 L25 30 M25 25 L10 30 M25 25 M25 20 L10 25 M25 20 M25 15 L10 20 M25 15 M25 10 L10 15 M25 10 M25 5 L17.5 7.5"];var L=new s({url:e.toUrl(this.iconFolderPath+"windbarb.png"),height:20,width:20,type:"picture-marker-symbol",angle:0});for(this.renderer.defaultSymbol=L,r=0;r<i.length-1;r++)0===r?this.renderer.addBreak({minValue:i[r],maxValue:i[r+1],symbol:L}):this.renderer.addBreak({minValue:i[r],maxValue:i[r+1],symbol:(new a).setPath(t[r]).setOutline((new o).setWidth(1.5)).setSize(20).setColor(new n([0,0,0,255]))})},_getDefaultSymbol:function(e){return(new a).setPath("M14,32 14,18 9,23 16,3 22,23 17,18 17,32 z").setOutline((new o).setWidth(0)).setSize(20).setColor(e||new n([0,92,230]))},_getRotationInfo:function(e){var r=e&&e.flowRepresentation||f.FLOW_FROM,t=e&&e.rotationField||"Direction",i=f.FLOW_FROM;return{field:function(e){var n=e.attributes[t];return r===i?n:n+180},type:"geographic"}},_addBreaks:function(e,r){if(!L.isDefined(this.renderer))return new Error("Invalid Renderer!");if(!e||!r||!e.length||!r.length||e.length<r.length)return new Error("AddBreaks: Input arguments break values and colors not valid");var t;for(t=0;t<r.length;t++)this.renderer.addBreak({minValue:e[t],maxValue:e[t+1],symbol:this._getDefaultSymbol(new n(r[t]))})},toJSON:function(){var e=t.mixin(this.inherited(arguments),{type:"vectorField",style:this.style,attributeField:this.attributeField,flowRepresentation:this.flowRepresentation});return this.renderer&&this.renderer.defaultSymbol&&this.style===f.STYLE_SINGLE_ARROW&&(e.singleArrowSymbol=this.renderer.defaultSymbol.toJSON()),L.fixJson(e)}});return t.mixin(f,u,_),f});