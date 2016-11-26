// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define([],function(){return{makeTracingContext:function(c){var d={},f=null,g=null,h=null,k=0,e=function(b,a){var d=b+"Original";c[d]=c[b];c[b]=function(){var b=c[d].apply(c,arguments);a(b,arguments);return b}};e("createTexture",function(b,a){void 0===b||null===b||(b._traceObjId=k++,d[b._traceObjId]={type:"texture",ref:b})});e("deleteTexture",function(b,a){void 0!==a[0]._traceObjId&&delete d[a[0]._traceObjId]});e("bindTexture",function(b,a){null!==a[1]&&(f=a[1]._traceObjId)});var l=function(b){switch(b){case c.ALPHA:return 1;
case c.RGB:return 3;case c.LUMINANCE:return 1;case c.LUMINANCE_ALPHA:return 2}return 4};e("texImage2D",function(b,a,c){null!==f&&(a[5]instanceof HTMLImageElement&&null!==f?(b=a[5],d[f].calcSize=b.width*b.height*l(c)):a[5]instanceof HTMLCanvasElement&&null!==f?(b=a[5],d[f].calcSize=b.width*b.height*l(c)):9<=a.length?d[f].calcSize=a[3]*a[4]*l(a[2]):console.log("texMem tracing: overload not yet implemented!"))});e("generateMipmap",function(b,a){null!==f&&(d[f].isMipmapped=!0)});e("createRenderbuffer",
function(b,a){void 0===b||null===b||(b._traceObjId=k++,d[b._traceObjId]={type:"renderBuffer",ref:b})});e("bindRenderbuffer",function(b,a){null!==a[1]&&(g=a[1]._traceObjId)});e("renderbufferStorage",function(b,a){null!==g&&(d[g].calcSize=2*a[2]*a[3])});e("deleteRenderbuffer",function(b,a){void 0!==a[0]._traceObjId&&delete d[a[0]._traceObjId]});e("createBuffer",function(b,a){void 0===b||null===b||(b._traceObjId=k++,d[b._traceObjId]={type:"VBO",ref:b})});e("bindBuffer",function(b,a){null!==a[1]&&(h=
a[1]._traceObjId)});e("bufferData",function(b,a){null!==h&&(d[h].calcSize=c.getBufferParameter(c.ARRAY_BUFFER,c.BUFFER_SIZE))});e("deleteBuffer",function(b,a){void 0!==a[0]._traceObjId&&delete d[a[0]._traceObjId]});var m=function(b){var a=0,c;for(c in d)d[c].type===b&&void 0!==d[c].calcSize&&(a+=d[c].calcSize,d[c].isMipmapped&&(a+=0.3333*d[c].calcSize));return a/1E6};c.getUsedTextureMemory=function(){return m("texture")};c.getUsedTextureMemoryStats=function(){var b={},a;for(a in d)if("texture"===
d[a].type){var c=d[a].ref._debugTracingType||"untagged",e=0;void 0!==d[a].calcSize&&(e=d[a].calcSize,d[a].isMipmapped&&(e+=0.3333*d[a].calcSize));b[c]=void 0===b[c]?e/1E6:b[c]+e/1E6}return b};c.getUsedRenderbufferMemory=function(){return m("renderBuffer")};c.getUsedVBOMemory=function(){return m("VBO")};c._isTracingEnabled=!0;return c}}});