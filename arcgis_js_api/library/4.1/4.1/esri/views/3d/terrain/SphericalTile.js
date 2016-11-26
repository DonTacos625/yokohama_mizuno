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

define(["./TileBase","./TileGeometryFactory","../support/ObjectPool","../support/mathUtils","../support/earthUtils","../lib/glMatrix"],function(t,e,i,s,r,a){var o=a.vec3d,n=r.earthRadius,h=function(t,e,i,s){var r=n+i,a=Math.cos(t);s[0]=Math.cos(e)*a*r,s[1]=Math.sin(e)*a*r,s[2]=Math.sin(t)*r},p=function(e,i,s,r){t.call(this),this.tileUp=o.create(),this.obb=new Array(8),this._isWebMercator=!1;for(var a=0;8>a;a++)this.obb[a]=o.create();void 0!==e&&this.init(e,i,s,r)};return p.prototype=new t,p.prototype.constructor=p,p.prototype.init=function(e,i,r,a){t.prototype.init.call(this,e,i,r,a),this._isWebMercator=a.spatialReference.isWebMercator;var p=this.extentWGS84Rad[0],u=this.extentWGS84Rad[1],l=this.extentWGS84Rad[2],c=this.extentWGS84Rad[3],d=e[0],f=s.lerp(u,c,.5),v=s.lerp(p,l,.5),b=0===d?0:Math.min(Math.abs(u),Math.abs(c));this.edgeLen=(l-p)*Math.cos(b)*n,this.curvatureHeight=n-Math.sqrt(n*n-this.edgeLen*this.edgeLen/4),h(f,v,0,this.centerAtSeaLevel),o.set(this.centerAtSeaLevel,this.tileUp),o.normalize(this.tileUp),this._updateOBB(),this.updateRadiusAndCenter()},p.prototype.isVisible=function(t,e){if(!this.intersectsClippingArea)return!1;var i=this.lij[0];if(i>9)for(var s=this.obb,r=0;6>r;r++){for(var a=0;8>a&&!(t[r][0]*s[a][0]+t[r][1]*s[a][1]+t[r][2]*s[a][2]+t[r][3]<0);a++);if(8===a)return!1}else{var o=this.radius,n=this.center;if(t[0][0]*n[0]+t[0][1]*n[1]+t[0][2]*n[2]+t[0][3]>o)return!1;if(t[1][0]*n[0]+t[1][1]*n[1]+t[1][2]*n[2]+t[1][3]>o)return!1;if(t[2][0]*n[0]+t[2][1]*n[1]+t[2][2]*n[2]+t[2][3]>o)return!1;if(t[3][0]*n[0]+t[3][1]*n[1]+t[3][2]*n[2]+t[3][3]>o)return!1;if(t[4][0]*n[0]+t[4][1]*n[1]+t[4][2]*n[2]+t[4][3]>o)return!1;if(t[5][0]*n[0]+t[5][1]*n[1]+t[5][2]*n[2]+t[5][3]>o)return!1}return!0},p.prototype.computeElevationBounds=function(){t.prototype.computeElevationBounds.call(this),this._updateOBB()},p.prototype.updateRadiusAndCenter=function(){if(0===this.lij[0])o.set3(0,0,0,this.center),this.radius=n+this.elevationBounds[1];else{t.prototype.updateRadiusAndCenter.call(this);var e=Math.max(o.dist2(this.center,this.obb[0]),o.dist2(this.center,this.obb[1]));this.radius=Math.sqrt(e)}},p.prototype._numSubdivisionsAtLevel=[128,64,32,16,16,8,8,4],p.prototype.createGeometry=function(t,i,s){var r=this._isPole(this.lij[1],this.lij[0]);return t.needsUpdate=!1,e.createSphericalGlobeTile(t.numVertsPerRow,this.extent,this.extentWGS84Rad,this._isWebMercator,t.samplerData,i,r,s)},p.prototype._updateOBB=function(){var t,e=this.extentWGS84Rad,i=this.obb;for(t=0;2>t;t++){var s=this.elevationBounds[t],r=4*t;h(e[1],e[0],s,i[r++]),h(e[3],e[0],s,i[r++]),h(e[3],e[2],s,i[r++]),h(e[1],e[2],s,i[r++])}if(this._isWebMercator){var a=this._isPole(this.lij[1],this.lij[0]);2===a?(o.set3(0,0,n,i[1]),o.set3(0,0,n,i[2]),o.set3(0,0,n,i[5]),o.set3(0,0,n,i[6])):1===a&&(o.set3(0,0,-n,i[0]),o.set3(0,0,-n,i[3]),o.set3(0,0,-n,i[4]),o.set3(0,0,-n,i[7]))}},p.prototype._isPole=function(t,e){var i=0;return t===(1<<e)-1&&(i+=1),0===t&&(i+=2),i},i.on(p,400),p});