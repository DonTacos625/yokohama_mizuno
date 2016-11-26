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

define(["require","exports","../core/tsSupport/declareExtendsHelper","../core/tsSupport/decorateHelper","../core/lang","./Symbol3D","../core/accessorSupport/decorators"],function(e,r,o,t,s,n,p){var l=function(e){function r(r){e.call(this),this.type="line-symbol-3d"}return o(r,e),r.prototype.clone=function(){return new r({symbolLayers:s.clone(this.symbolLayers)})},t([p.property()],r.prototype,"type",void 0),t([p.shared(["Line","Path","Text"])],r.prototype,"_allowedLayerTypes",void 0),r=t([p.subclass("esri.symbols.LineSymbol3D")],r)}(p.declared(n));return l});