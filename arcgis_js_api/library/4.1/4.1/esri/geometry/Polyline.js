// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("dojo/_base/lang ../core/lang ./SpatialReference ./Geometry ./Point ./Extent ./support/zmUtils".split(" "),function(M,N,O,P,f,J,h){var n=P.createSubclass({declaredClass:"esri.geometry.Polyline",type:"polyline",getDefaults:function(a){return{paths:[]}},normalizeCtorArgs:function(a,b){var c=null,e,d,g=null;a&&!Array.isArray(a)?(c=a.paths?a.paths:null,b||(a.spatialReference?b=a.spatialReference:a.paths||(b=a)),e=a.hasZ,d=a.hasM):c=a;c=c||[];b=b||O.WGS84;c.length&&(c[0]&&null!=c[0][0]&&"number"==
typeof c[0][0])&&(c=[c]);if(g=c[0]&&c[0][0])void 0===e&&void 0===d?(e=2<g.length,d=!1):void 0===e?e=!d&&3<g.length:void 0===d&&(d=!e&&3<g.length);return{paths:c,spatialReference:b,hasZ:e,hasM:d}},_path:0,properties:{cache:{dependsOn:["hasM","hasZ","paths"]},extent:{dependsOn:["cache"],readOnly:!0,get:function(){function a(a){return function(b,c){return void 0===b?c:void 0===c?b:a(b,c)}}var b=this.paths,c=b.length;if(!c||!b[0].length)return null;var e,d,g,f,m,h,p,B,C,q,r,n,D=h=b[0][0][0],E=p=b[0][0][1],
F,G,k=a(Math.min),l=a(Math.max),s=this.spatialReference,H=[],t,u,v,w,x,y,z,A,I=this.hasZ,K=this.hasM,L=I?3:2;for(q=0;q<c;q++){e=b[q];t=u=e[0]&&e[0][0];v=w=e[0]&&e[0][1];n=e.length;z=A=x=y=void 0;for(r=0;r<n;r++)d=e[r],g=d[0],f=d[1],D=k(D,g),E=k(E,f),h=l(h,g),p=l(p,f),t=k(t,g),v=k(v,f),u=l(u,g),w=l(w,f),I&&2<d.length&&(m=d[2],F=k(F,m),B=l(B,m),x=k(x,m),y=l(y,m)),K&&d.length>L&&(d=d[L],G=k(G,m),C=l(C,m),z=k(z,d),A=l(A,d));H.push(new J({xmin:t,ymin:v,zmin:x,mmin:z,xmax:u,ymax:w,zmax:y,mmax:A,spatialReference:s?
s.clone():null}))}b=new J({xmin:D,ymin:E,xmax:h,ymax:p,spatialReference:s?s.toJSON():null});I&&(b.zmin=F,b.zmax=B);K&&(b.mmin=G,b.mmax=C);b._partwise=1<H.length?H:null;return b}},paths:null},addPath:function(a){this.clearCache();this._path=this.paths.length;this.paths[this._path]=[];a.forEach(this._addPoint,this);return this},clone:function(){var a=new n;a.spatialReference=this.spatialReference;a.paths=M.clone(this.paths);a.hasZ=this.hasZ;a.hasM=this.hasM;return a},getPoint:function(a,b){if(this._validateInputs(a,
b)){var c=this.paths[a][b],e=this.hasZ,d=this.hasM;return e&&d?new f(c[0],c[1],c[2],c[3],this.spatialReference):e?new f(c[0],c[1],c[2],void 0,this.spatialReference):d?new f(c[0],c[1],void 0,c[2],this.spatialReference):new f(c[0],c[1],this.spatialReference)}},insertPoint:function(a,b,c){if(this._validateInputs(a)&&N.isDefined(b)&&0<=b&&b<=this.paths[a].length)return this.clearCache(),h.updateSupportFromPoint(this,c),Array.isArray(c)||(c=c.toArray()),this.paths[a].splice(b,0,c),this},removePath:function(a){if(this._validateInputs(a,
null)){this.clearCache();a=this.paths.splice(a,1)[0];var b,c=a.length,e=this.spatialReference;for(b=0;b<c;b++)a[b]=new f(a[b],e);return a}},removePoint:function(a,b){if(this._validateInputs(a,b))return this.clearCache(),new f(this.paths[a].splice(b,1)[0],this.spatialReference)},setPoint:function(a,b,c){if(this._validateInputs(a,b))return this.clearCache(),h.updateSupportFromPoint(this,c),Array.isArray(c)||(c=c.toArray()),this.paths[a][b]=c,this},toJSON:function(){var a=this.spatialReference,a={paths:this.paths,
spatialReference:a&&a.toJSON()};this.hasZ&&(a.hasZ=!0);this.hasM&&(a.hasM=!0);return a},_initPathPointsToArray:function(a){for(var b=0;b<a.paths.length;b++)a.paths[b]=a.paths[b].map(function(b){h.updateSupportFromPoint(a,b,!0);Array.isArray(b)||(a.spatialReference||(a.spatialReference=b.spatialReference),b=b.toArray());return b});return a},_addPoint:function(a){Array.isArray(a)?this.paths[this._path].push(a):this.paths[this._path].push(a.toArray());h.updateSupportFromPoint(this,a)},_insertPoints:function(a,
b){this.clearCache();this._path=b;this.paths[this._path]||(this.paths[this._path]=[]);a.forEach(this._addPoint,this)},_validateInputs:function(a,b){return null!==a&&void 0!==a&&(0>a||a>=this.paths.length)||null!==b&&void 0!==a&&(0>b||b>=this.paths[a].length)?!1:!0}});return n});