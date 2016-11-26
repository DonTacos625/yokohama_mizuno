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

define(["require","exports"],function(t,o){function s(t){return t&&t.dispose&&"function"==typeof t.dispose}var e=function(){},i=function(){function t(t,o){void 0===t&&(t=new e),this.cls=t,this.dispose=o,this._pool=[]}return t.prototype.acquire=function(){for(var t=[],o=0;o<arguments.length;o++)t[o-0]=arguments[o];var s;return this._pool.length?(s=this._pool.pop(),this.cls.call(s)):s=new this.cls,s},t.prototype.release=function(t){t&&(s(t)?t.dispose():this.dispose&&this.dispose.call(t),this._pool.push(t))},t}();return i});