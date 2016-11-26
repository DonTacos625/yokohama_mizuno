// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["require","dojo/_base/lang","dojox/gfx/_base","../../../core/screenUtils"],function(v,w,s,f){var y=v.toUrl("esri/images/Legend/legend3dsymboldefault.png"),z=v.toUrl("esri/symbols/patterns/"),t=function(a){var d=null;if(a){var c=a.constructor,b=f.pt2px(a.width);switch(a.type){case "simple-fill-symbol":case "picture-fill-symbol":case "simple-marker-symbol":d=t(a.outline);break;case "simple-line-symbol":a.style!==c.STYLE_NULL&&0!==b&&(d={color:a.color,style:x(a.style),width:b});break;case "cartographic-line-symbol":a.style!==
c.STYLE_NULL&&0!==b&&(d={color:a.color,style:x(a.style),width:b,cap:a.cap,join:a.join===c.JOIN_MITER?f.pt2px(a.miterLimit):a.join});break;default:d=null}}return d},x=function(){var a={};return function(d){if(a[d])return a[d];var c=d.replace(/-/g,"");return a[d]=c}}(),A=function(a){return a.symbolLayers.map(function(a){var c=a&&a.type,b="Icon"===c,e=a&&a.resource,h=e&&e.primitive,e=e&&e.href;if(b||"Object"===c){if(e)return a=f.pt2px(a.size)||20,[{shape:{type:"image",width:a,height:a,src:b?e:y}}];h||
(h=b?"circle":"sphere");var b=[],c=0.5*(f.pt2px(a.size)||20),e=-c,k=+c,m=-c,l=+c;switch(h){case "circle":b.push({shape:{type:"circle",cx:0,cy:0,r:c},fill:g(a,0),stroke:p(a)});break;case "square":b.push({shape:{type:"path",path:"M "+e+","+l+" L "+e+","+m+" L "+k+","+m+" L "+k+","+l+" L "+e+","+l+" Z"},fill:g(a,0),stroke:p(a)});break;case "cross":b.push({shape:{type:"path",path:"M "+e+",0 L "+k+",0 E"},stroke:q(a)});b.push({shape:{type:"path",path:"M 0,"+m+" L 0,"+l+" E"},stroke:q(a)});break;case "x":b.push({shape:{type:"path",
path:"M "+e+","+l+" L "+k+","+m+" E"},stroke:q(a)});b.push({shape:{type:"path",path:"M "+e+","+m+" L "+k+","+l+" E"},stroke:q(a)});break;case "kite":b.push({shape:{type:"path",path:"M 0,"+m+" L "+k+",0 L 0,"+l+" L "+e+",0 L 0,"+e+" Z"},fill:g(a,0),stroke:p(a)});break;case "cone":h=g(a,0);e=g(a,-0.6);c=u(h,e);c.x1=-5;c.y1=0;c.x2=5;c.y2=0;b.push({shape:{type:"path",path:"M 0,-10 L -8,5 L -4,6.5 L 0,7 L 4,6.5 L 8,5 Z"},fill:c});break;case "cube":b.push({shape:{type:"path",path:"M -10,-7 L 0,-12 L 10,-7 L 0,-2 L -10,-7 Z"},
fill:g(a,0)});b.push({shape:{type:"path",path:"M -10,-7 L 0,-2 L 0,12 L -10,7 L -10,-7 Z"},fill:g(a,-0.3)});b.push({shape:{type:"path",path:"M 0,-2 L 10,-7 L 10,7 L 0,12 L 0,-2 Z"},fill:g(a,-0.5)});break;case "cylinder":h=g(a,0);e=g(a,-0.6);c=u(h,e);c.x1=-5;c.y1=0;c.x2=5;c.y2=0;b.push({shape:{type:"path",path:"M -8,-9 L -8,7 L -4,8.5 L 0,9 L 4,8.5 L 8,7 L 8,-9 Z"},fill:c});b.push({shape:{type:"ellipse",cx:0,cy:-9,rx:8,ry:2},fill:g(a,0)});break;case "diamond":b.push({shape:{type:"path",path:"M 0,-10 L 10,-1 L -1,1 L 0,-10 Z"},
fill:g(a,-0.3)});b.push({shape:{type:"path",path:"M 0,-10 L -1,1 L -8,-1 L 0,-10 Z"},fill:g(a,0)});b.push({shape:{type:"path",path:"M -1,1 L 0,10 L -8,-1 L -1,1 Z"},fill:g(a,-0.3)});b.push({shape:{type:"path",path:"M -1,0 L 0,10 L 10,-1 L -1,1 Z"},fill:g(a,-0.7)});break;case "sphere":h=g(a,0);e=g(a,-0.6);b.push({shape:{type:"circle",cx:0,cy:0,r:c},fill:u(h,e)});break;case "tetrahedron":b.push({shape:{type:"path",path:"M 0,-10 L 10,7 L 0,0 L 0,-10 Z"},fill:g(a,-0.3)}),b.push({shape:{type:"path",path:"M 0,-10 L 0,0 L -8,7 L 0,-10 Z"},
fill:g(a,0)}),b.push({shape:{type:"path",path:"M 10,7 L 0,0 L -8,7 L 10,7 Z"},fill:g(a,-0.6)})}return b}})},B=function(a){var d=a.symbolLayers;return d.map(function(a){var b=a.type,e=[];if("Fill"===b)e.push({shape:{type:"path",path:"M -10,-10 L 10,0 L 10,10 L -10,10 L -10,-10 E"},fill:g(a,0),stroke:p(a)});else if("Line"===b)a={stroke:r(a,0)},1===d.length&&(a.shape={type:"path",path:"M -10,-10 L 10,0 L 10,10 L -10,10 L -10,-10 E"}),e.push(a);else if("Extrude"===a.type){var b=r(a,-0.4),f=g(a,0);a=g(a,
-0.2);b.width=1;e.push({shape:{type:"path",path:"M -7,-5 L -2,0 L -2,7 L -7,3 L -7,-5Z"},fill:a,stroke:b});e.push({shape:{type:"path",path:"M -2,0 L -2,7 L 10,-3 L 10,-10 L -2,0 Z"},fill:a,stroke:b});e.push({shape:{type:"path",path:"M -7,-5 L -2,0 L 10,-10 L -2,-10 L -7,-5 Z"},fill:f,stroke:b})}return e})},r=function(a,d){if(!a.material)return{};for(var c=a.material.color.toRgb(),b="rgba(",e=0;3>e;e++)b+=Math.min(Math.max(c[e]+191.25*d,0),255)+",";b+=a.material.color.a+");";return{color:b,width:a.size?
f.pt2px(a.size):0.75}},g=function(a,d){if(!a.material){var c=Math.min(Math.max(255+191.25*d,0),255);return[c,c,c,100]}for(var c=a.material.color.toRgb(),b=0;3>b;b++)c[b]=Math.min(Math.max(c[b]+191.25*d,0),255);c.push(a.material.color.a);return c},q=function(a){return!a.outline?{color:"rgba(0,0,0,1)",width:1.5}:p(a)},p=function(a){var d=a.outline,c=a.material&&a.material.color,c=c&&c.toRgba().toString();if(!d)return"Fill"===a.type&&"255,255,255,1"===c?{color:"#bdc3c7",width:0.75}:null;a=f.pt2px(d.size)||
0;return{color:"rgba("+(null!=d.color?d.color.toRgba():"255,255,255,1")+")",width:a}},u=function(a,d){return{type:"linear",x1:0,y1:0,x2:4,y2:4,colors:[{color:a,offset:0},{color:d,offset:1}]}};return{getSwatch:function(a){if(!a)return null;var d=null;if(-1===a.type.indexOf("3d")){var d=null,c=a.style;if(a){var b=a.constructor;switch(a.type){case "simple-marker-symbol":c!==b.STYLE_CROSS&&c!==b.STYLE_X&&(d=a.color);break;case "simple-fill-symbol":c===b.STYLE_SOLID?d=a.color:c!==b.STYLE_NULL&&(d=w.mixin({},
s.defaultPattern,{src:z+c+".png",width:10,height:10}));break;case "picture-fill-symbol":d=w.mixin({},s.defaultPattern,{src:a.url,width:f.pt2px(a.width)*a.xscale,height:f.pt2px(a.height)*a.yscale,x:f.pt2px(a.xoffset),y:f.pt2px(a.yoffset)});break;case "text-symbol":d=a.color}}var d={fill:d,stroke:t(a)},b=a.constructor,e=b.defaultProps,c=null;switch(a.type){case "simple-marker-symbol":var h=a.style,e=0.5*f.pt2px(a.size||e.size),k=-e,m=+e,l=-e,n=+e;switch(h){case b.STYLE_CIRCLE:c={type:"circle",cx:0,
cy:0,r:e};break;case b.STYLE_CROSS:c={type:"path",path:"M "+k+",0 L "+m+",0 M 0,"+l+" L 0,"+n+" E"};break;case b.STYLE_DIAMOND:c={type:"path",path:"M "+k+",0 L 0,"+l+" L "+m+",0 L 0,"+n+" L "+k+",0 Z"};break;case b.STYLE_SQUARE:c={type:"path",path:"M "+k+","+n+" L "+k+","+l+" L "+m+","+l+" L "+m+","+n+" L "+k+","+n+" Z"};break;case b.STYLE_X:c={type:"path",path:"M "+k+","+n+" L "+m+","+l+" M "+k+","+l+" L "+m+","+n+" E"};break;case b.STYLE_PATH:c={type:"path",path:a.path||""}}break;case "simple-line-symbol":case "cartographic-line-symbol":c=
{type:"path",path:"M -15,0 L 15,0 E"};break;case "picture-fill-symbol":case "simple-fill-symbol":c={type:"path",path:"M -10,-10 L 10,0 L 10,10 L -10,10 L -10,-10 Z"};break;case "picture-marker-symbol":c={type:"image",x:-Math.round(f.pt2px(a.width)/2),y:-Math.round(f.pt2px(a.height)/2),width:f.pt2px(a.width),height:f.pt2px(a.height),src:a.source&&a.source.imageData?"data:"+a.source.contentType+";base64,"+a.source.imageData:a.url||""};break;case "text-symbol":b=a.font,h=f.pt2px(b.size),c={type:"text",
text:a.text,x:0,y:0.25*s.normalizedLength(b?h:0),align:"middle",decoration:a.decoration||b&&b.decoration,rotated:a.rotated,kerning:a.kerning},d.font=b&&{size:h,style:b.style,variant:b.variant,decoration:b.decoration,weight:b.weight,family:b.family}}c?(d.shape=c,d=[[d]]):d=null}else if(0===a.symbolLayers.length)d=null;else switch(d=null,a.type){case "point-symbol-3d":d=A(a);break;case "line-symbol-3d":c=a.symbolLayers.getItemAt(0);b=r(c,0);a=[];d=[a];"Line"===c.type?a.push({shape:{type:"path",path:"M -2,5 L 12,5 E"},
stroke:b}):(b=g(c,0),h=g(c,-0.2),c=r(c,-0.4),c.width=1,a.push({shape:{type:"path",path:"M 3,12 L 12,0 L 11,-2 L -4,5 L -1,5 L 1,7 L 3,10 L 3,12 Z"},fill:h,stroke:c}),a.push({shape:{type:"circle",cx:-2,cy:10,r:5},fill:b,stroke:c}));break;case "polygon-symbol-3d":case "mesh-symbol-3d":d=B(a)}return d},getSymbolSize:function(a){var d={width:0,height:0};if(a){var c=a.type;if(-1===c.indexOf("3d")){var b=a.constructor.defaultProps,e=t(a),e=e?e.width:0;"simple-marker-symbol"===c?(d.width=f.pt2px(a.size||
b.size)+e,d.height=f.pt2px(a.size||b.size)+e):"simple-fill-symbol"===c||"picture-fill-symbol"===c?(d.width=22+e,d.height=22+e):"picture-marker-symbol"===c?(d.width=f.pt2px(a.width||b.width),d.height=f.pt2px(a.height||b.height)):"text-symbol"===c&&(c=(c=a.font)?f.pt2px(c.size||b.size):0,d.width=c,d.height=c)}else if(b=a.symbolLayers.getItemAt(0),a=(a=p(b))?a.width:0,"point-symbol-3d"===c)d.width=(f.pt2px(b.size)||20)+a,d.height=(f.pt2px(b.size)||20)+a;else if("line-symbol-3d"===c&&"Line"===b.type)d.width=
0,d.height=a;else if(("polygon-symbol-3d"===c||"mesh-symbol-3d"===c)&&"Fill"===b.type)d.width=22+a,d.height=22+a}d.width=Math.min(d.width,125)||22;d.height=Math.min(d.height,125)||22;return d}}});