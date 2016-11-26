// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("dojo/_base/array dojo/_base/lang dojo/Deferred ../../config ../Polyline ../Polygon ./webMercatorUtils ./jsonUtils".split(" "),function(g,m,H,I,r,A,z,J){function v(a,e){return Math.ceil((a-e)/(2*e))}function B(a,e){var c=a.paths||a.rings,f,b,d=c.length,n;for(f=0;f<d;f++){n=c[f].length;for(b=0;b<n;b++){var w=a.getPoint(f,b);a.setPoint(f,b,w.clone().offset(e,0))}}return a}function x(a,e){if(!(a instanceof r||a instanceof A))throw console.error("_straightLineDensify: the input geometry is neither polyline nor polygon"),
Error("_straightLineDensify: the input geometry is neither polyline nor polygon");var c=a instanceof r,f=[],b;g.forEach(c?a.paths:a.rings,function(a){f.push(b=[]);b.push([a[0][0],a[0][1]]);var n,c,p,h,k,l,g,m,r,q,s,t;for(k=0;k<a.length-1;k++){n=a[k][0];c=a[k][1];p=a[k+1][0];h=a[k+1][1];g=Math.sqrt((p-n)*(p-n)+(h-c)*(h-c));m=(h-c)/g;r=(p-n)/g;q=g/e;if(1<q){for(l=1;l<=q-1;l++)t=l*e,s=r*t+n,t=m*t+c,b.push([s,t]);l=(g+Math.floor(q-1)*e)/2;s=r*l+n;t=m*l+c;b.push([s,t])}b.push([p,h])}});return c?new r({paths:f,
spatialReference:a.spatialReference}):new A({rings:f,spatialReference:a.spatialReference})}function C(a,e,c){e&&(a=x(a,1E6),a=z.webMercatorToGeographic(a,!0));c&&(a=B(a,c));return a}function D(a,e,c){var f=a.x||a[0],b;f>e?(b=v(f,e),a.x?a=a.clone().offset(b*-2*e,0):a[0]=f+b*-2*e):f<c&&(b=v(f,c),a.x?a=a.clone().offset(b*-2*c,0):a[0]=f+b*-2*c);return a}function E(a,e){var c=-1;g.forEach(e.cutIndexes,function(f,b){var d=e.geometries[b];g.forEach(d.rings||d.paths,function(a,f){g.some(a,function(b){if(!(180>
b[0])){b=0;var c,e=a.length,l;for(c=0;c<e;c++)l=a[c][0],b=l>b?l:b;b=Number(b.toFixed(9));b=-360*v(b,180);e=a.length;for(c=0;c<e;c++)l=d.getPoint(f,c),d.setPoint(f,c,l.clone().offset(b,0))}return!0})});f===c?d.rings?g.forEach(d.rings,function(b){a[f]=a[f].addRing(b)}):g.forEach(d.paths,function(b){a[f]=a[f].addPath(b)}):(c=f,a[f]=d)});return a}function y(a,e,c,f){var b=new H;b.then(c,f);e=e||I.geometryService;var d=[],n=[],w,p,h,k,l,m,u,x,q=0;g.forEach(a,function(a){if(a)if(w||(w=a.spatialReference,
p=w._getInfo(),k=(h=w.isWebMercator)?2.0037508342788905E7:180,l=h?-2.0037508342788905E7:-180,m=h?102100:4326,u=new r({paths:[[[k,l],[k,k]]],spatialReference:{wkid:m}}),x=new r({paths:[[[l,l],[l,k]]],spatialReference:{wkid:m}})),p){var b=J.fromJSON(a.toJSON()),c=a.extent;"point"===a.type?d.push(D(b,k,l)):"multipoint"===a.type?(b.points=g.map(b.points,function(a){return D(a,k,l)}),d.push(b)):"extent"===a.type?(b=c.clone()._normalize(null,null,p),d.push(b.rings?new A(b):b)):c?(a=v(c.xmin,l)*2*k,b=0===
a?b:B(b,a),c=c.clone().offset(a,0),c.intersects(u)&&c.xmax!==k?(q=c.xmax>q?c.xmax:q,b=C(b,h),n.push(b),d.push("cut")):c.intersects(x)&&c.xmin!==l?(q=c.xmax*2*k>q?c.xmax*2*k:q,b=C(b,h,360),n.push(b),d.push("cut")):d.push(b)):d.push(b)}else d.push(a);else d.push(a)});c=new r;f=v(q,k);for(var s=-90,t=f;0<f;){var y=-180+360*f;c.addPath([[y,s],[y,-1*s]]);s*=-1;f--}0<n.length&&0<t?e?e.cut(n,c,function(c){n=E(n,c);var f=[];g.forEach(d,function(b,c){if("cut"===b){var e=n.shift();a[c].rings&&1<a[c].rings.length&&
e.rings.length>=a[c].rings.length?(d[c]="simplify",f.push(e)):d[c]=!0===h?z.geographicToWebMercator(e):e}});0<f.length?e.simplify(f,function(a){g.forEach(d,function(b,c){"simplify"===b&&(d[c]=!0===h?z.geographicToWebMercator(a.shift()):a.shift())});b.resolve(d)},function(a){b.reject(a)}):b.resolve(d)},function(a){b.reject(a)}):b.reject(Error("esri.geometry.normalizeCentralMeridian: 'geometryService' argument is missing.")):(g.forEach(d,function(a,b){if("cut"===a){var c=n.shift();d[b]=!0===h?z.geographicToWebMercator(c):
c}}),b.resolve(d));return b.promise}function u(a,e,c,f){var b=!1,d;m.isObject(a)&&a&&(m.isArray(a)?a.length&&((d=a[0]&&a[0].declaredClass)&&-1!==d.indexOf("Graphic")?(a=g.map(a,function(a){return a.geometry}),b=a.length?!0:!1):d&&-1!==d.indexOf("esri.geometry.")&&(b=!0)):(d=a.declaredClass)&&-1!==d.indexOf("FeatureSet")?(a=g.map(a.features||[],function(a){return a.geometry}),b=a.length?!0:!1):d&&-1!==d.indexOf("esri.geometry.")&&(b=!0));b&&e.push({index:c,property:f,value:a})}function F(a,e){var c=
[];g.forEach(e,function(f){var b=f.i,d=a[b];f=f.p;var e;if(m.isObject(d)&&d)if(f)if("*"===f[0])for(e in d)d.hasOwnProperty(e)&&u(d[e],c,b,e);else g.forEach(f,function(a){u(m.getObject(a,!1,d),c,b,a)});else u(d,c,b)});return c}function G(a,e){var c=0,f={};g.forEach(e,function(b){var d=b.index,e=b.property,g=b.value,p=g.length||1,h=a.slice(c,c+p);m.isArray(g)||(h=h[0]);c+=p;delete b.value;e?(f[d]=f[d]||{},f[d][e]=h):f[d]=h});return f}return{normalizeCentralMeridian:y,_foldCutResults:E,_prepareGeometryForCut:C,
_offsetMagnitude:v,_pointNormalization:D,_updatePolyGeometry:B,_straightLineDensify:x,_createWrappers:function(a){var e=m.isObject(a)?a.prototype:m.getObject(a+".prototype");g.forEach(e.__msigns,function(a){var f=e[a.n];e[a.n]=function(){var b=this,d=[],e;for(e=0;e<a.c;e++)d[e]=arguments[e];var m={};d.push(m);var p,h=[],k;b.normalization&&!b._isTable&&(p=F(d,a.a),g.forEach(p,function(a){h=h.concat(a.value)}),h.length&&(k=y(h)));return k?k.then(function(a){m.assembly=G(a,p);return f.apply(b,d)}):f.apply(b,
d)}})},_disassemble:F,_addToBucket:u,_reassemble:G}});