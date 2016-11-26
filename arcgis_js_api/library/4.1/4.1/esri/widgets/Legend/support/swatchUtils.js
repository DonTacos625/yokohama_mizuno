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

define(["require","dojo/_base/lang","dojox/gfx/_base","../../../core/screenUtils"],function(e,t,a,r){var p="cartographic-line-symbol",i="picture-fill-symbol",s="picture-marker-symbol",h="simple-fill-symbol",l="simple-line-symbol",o="simple-marker-symbol",c="text-symbol",n="point-symbol-3d",L="line-symbol-3d",u="polygon-symbol-3d",y="mesh-symbol-3d",f=e.toUrl("esri/images/Legend/legend3dsymboldefault.png"),d=e.toUrl("esri/symbols/patterns/"),b={size:22,maxSize:125},m=function(e){if(!e)return null;var t=null;return t=-1===e.type.indexOf("3d")?x(e):w(e)},x=function(e){var t={fill:g(e),stroke:k(e)},n=e.constructor,L=n.defaultProps,u=null;switch(e.type){case o:var y=e.style,f=r.pt2px(e.size||L.size),d=.5*f,b=-d,m=+d,x=-d,M=+d;switch(y){case n.STYLE_CIRCLE:u={type:"circle",cx:0,cy:0,r:d};break;case n.STYLE_CROSS:u={type:"path",path:"M "+b+",0 L "+m+",0 M 0,"+x+" L 0,"+M+" E"};break;case n.STYLE_DIAMOND:u={type:"path",path:"M "+b+",0 L 0,"+x+" L "+m+",0 L 0,"+M+" L "+b+",0 Z"};break;case n.STYLE_SQUARE:u={type:"path",path:"M "+b+","+M+" L "+b+","+x+" L "+m+","+x+" L "+m+","+M+" L "+b+","+M+" Z"};break;case n.STYLE_X:u={type:"path",path:"M "+b+","+M+" L "+m+","+x+" M "+b+","+x+" L "+m+","+M+" E"};break;case n.STYLE_PATH:u={type:"path",path:e.path||""}}break;case l:case p:u={type:"path",path:"M -15,0 L 15,0 E"};break;case i:case h:u={type:"path",path:"M -10,-10 L 10,0 L 10,10 L -10,10 L -10,-10 Z"};break;case s:u={type:"image",x:-Math.round(r.pt2px(e.width)/2),y:-Math.round(r.pt2px(e.height)/2),width:r.pt2px(e.width),height:r.pt2px(e.height),src:e.source&&e.source.imageData?"data:"+e.source.contentType+";base64,"+e.source.imageData:e.url||""};break;case c:var w=e.font,v=r.pt2px(w.size);u={type:"text",text:e.text,x:0,y:.25*a.normalizedLength(w?v:0),align:"middle",decoration:e.decoration||w&&w.decoration,rotated:e.rotated,kerning:e.kerning},t.font=w&&{size:v,style:w.style,variant:w.variant,decoration:w.decoration,weight:w.weight,family:w.family}}return u?(t.shape=u,[[t]]):null},g=function(e){var p=null,s=e.style;if(e){var l=e.constructor;switch(e.type){case o:s!==l.STYLE_CROSS&&s!==l.STYLE_X&&(p=e.color);break;case h:s===l.STYLE_SOLID?p=e.color:s!==l.STYLE_NULL&&(p=t.mixin({},a.defaultPattern,{src:d+s+".png",width:10,height:10}));break;case i:p=t.mixin({},a.defaultPattern,{src:e.url,width:r.pt2px(e.width)*e.xscale,height:r.pt2px(e.height)*e.yscale,x:r.pt2px(e.xoffset),y:r.pt2px(e.yoffset)});break;case c:p=e.color}}return p},k=function(e){var t=null;if(e){var a=e.constructor,s=r.pt2px(e.width);switch(e.type){case h:case i:case o:t=k(e.outline);break;case l:e.style!==a.STYLE_NULL&&0!==s&&(t={color:e.color,style:M(e.style),width:s});break;case p:e.style!==a.STYLE_NULL&&0!==s&&(t={color:e.color,style:M(e.style),width:s,cap:e.cap,join:e.join===a.JOIN_MITER?r.pt2px(e.miterLimit):e.join});break;default:t=null}}return t},M=function(){var e={};return function(t){if(e[t])return e[t];var a=t.replace(/-/g,"");return e[t]=a,a}}(),w=function(e){if(0===e.symbolLayers.length)return null;var t=null;switch(e.type){case n:t=v(e);break;case L:t=z(e);break;case u:case y:t=E(e)}return t},v=function(e){var t,a=e.symbolLayers;return t=a.map(function(e){var t=e&&e.type,a="Icon"===t,p="Object"===t,i=e&&e.resource,s=i&&i.primitive,h=i&&i.href;if(a||p){if(h){var l=r.pt2px(e.size)||20;return[{shape:{type:"image",width:l,height:l,src:a?h:f}}]}return s||(s=a?"circle":"sphere"),S(e,s)}})},z=function(e){var t=e.symbolLayers.getItemAt(0),a=Z(t,0),r=[],p=[r];if("Line"===t.type)r.push({shape:{type:"path",path:"M -2,5 L 12,5 E"},stroke:a});else{var i=T(t,0),s=T(t,-.2),h=Z(t,-.4);h.width=1,r.push({shape:{type:"path",path:"M 3,12 L 12,0 L 11,-2 L -4,5 L -1,5 L 1,7 L 3,10 L 3,12 Z"},fill:s,stroke:h}),r.push({shape:{type:"circle",cx:-2,cy:10,r:5},fill:i,stroke:h})}return p},E=function(e){var t,a=e.symbolLayers;return t=a.map(function(e){var t=e.type,r=[];if("Fill"===t)r.push({shape:{type:"path",path:"M -10,-10 L 10,0 L 10,10 L -10,10 L -10,-10 E"},fill:T(e,0),stroke:Y(e)});else if("Line"===t){var p={stroke:Z(e,0)};1===a.length&&(p.shape={type:"path",path:"M -10,-10 L 10,0 L 10,10 L -10,10 L -10,-10 E"}),r.push(p)}else if("Extrude"===e.type){var i=Z(e,-.4),s=T(e,0),h=T(e,-.2);i.width=1,r.push({shape:{type:"path",path:"M -7,-5 L -2,0 L -2,7 L -7,3 L -7,-5Z"},fill:h,stroke:i}),r.push({shape:{type:"path",path:"M -2,0 L -2,7 L 10,-3 L 10,-10 L -2,0 Z"},fill:h,stroke:i}),r.push({shape:{type:"path",path:"M -7,-5 L -2,0 L 10,-10 L -2,-10 L -7,-5 Z"},fill:s,stroke:i})}return r})},S=function(e,t){var a=[],p=r.pt2px(e.size)||20,i=.5*p,s=-i,h=+i,l=-i,o=+i;switch(t){case"circle":a.push({shape:{type:"circle",cx:0,cy:0,r:i},fill:T(e,0),stroke:Y(e)});break;case"square":a.push({shape:{type:"path",path:"M "+s+","+o+" L "+s+","+l+" L "+h+","+l+" L "+h+","+o+" L "+s+","+o+" Z"},fill:T(e,0),stroke:Y(e)});break;case"cross":a.push({shape:{type:"path",path:"M "+s+",0 L "+h+",0 E"},stroke:_(e)}),a.push({shape:{type:"path",path:"M 0,"+l+" L 0,"+o+" E"},stroke:_(e)});break;case"x":a.push({shape:{type:"path",path:"M "+s+","+o+" L "+h+","+l+" E"},stroke:_(e)}),a.push({shape:{type:"path",path:"M "+s+","+l+" L "+h+","+o+" E"},stroke:_(e)});break;case"kite":a.push({shape:{type:"path",path:"M 0,"+l+" L "+h+",0 L 0,"+o+" L "+s+",0 L 0,"+s+" Z"},fill:T(e,0),stroke:Y(e)});break;case"cone":var c=T(e,0),n=T(e,-.6),L=R(c,n);L.x1=-5,L.y1=0,L.x2=5,L.y2=0,a.push({shape:{type:"path",path:"M 0,-10 L -8,5 L -4,6.5 L 0,7 L 4,6.5 L 8,5 Z"},fill:L});break;case"cube":a.push({shape:{type:"path",path:"M -10,-7 L 0,-12 L 10,-7 L 0,-2 L -10,-7 Z"},fill:T(e,0)}),a.push({shape:{type:"path",path:"M -10,-7 L 0,-2 L 0,12 L -10,7 L -10,-7 Z"},fill:T(e,-.3)}),a.push({shape:{type:"path",path:"M 0,-2 L 10,-7 L 10,7 L 0,12 L 0,-2 Z"},fill:T(e,-.5)});break;case"cylinder":c=T(e,0),n=T(e,-.6),L=R(c,n),L.x1=-5,L.y1=0,L.x2=5,L.y2=0,a.push({shape:{type:"path",path:"M -8,-9 L -8,7 L -4,8.5 L 0,9 L 4,8.5 L 8,7 L 8,-9 Z"},fill:L}),a.push({shape:{type:"ellipse",cx:0,cy:-9,rx:8,ry:2},fill:T(e,0)});break;case"diamond":a.push({shape:{type:"path",path:"M 0,-10 L 10,-1 L -1,1 L 0,-10 Z"},fill:T(e,-.3)}),a.push({shape:{type:"path",path:"M 0,-10 L -1,1 L -8,-1 L 0,-10 Z"},fill:T(e,0)}),a.push({shape:{type:"path",path:"M -1,1 L 0,10 L -8,-1 L -1,1 Z"},fill:T(e,-.3)}),a.push({shape:{type:"path",path:"M -1,0 L 0,10 L 10,-1 L -1,1 Z"},fill:T(e,-.7)});break;case"sphere":c=T(e,0),n=T(e,-.6),a.push({shape:{type:"circle",cx:0,cy:0,r:i},fill:R(c,n)});break;case"tetrahedron":a.push({shape:{type:"path",path:"M 0,-10 L 10,7 L 0,0 L 0,-10 Z"},fill:T(e,-.3)}),a.push({shape:{type:"path",path:"M 0,-10 L 0,0 L -8,7 L 0,-10 Z"},fill:T(e,0)}),a.push({shape:{type:"path",path:"M 10,7 L 0,0 L -8,7 L 10,7 Z"},fill:T(e,-.6)})}return a},Z=function(e,t){if(!e.material)return{};for(var a=e.material.color.toRgb(),p="rgba(",i=0;3>i;i++)p+=I(a[i],t)+",";return p+=e.material.color.a+");",{color:p,width:e.size?r.pt2px(e.size):.75}},T=function(e,t){if(!e.material){var a=255,r=I(a,t);return[r,r,r,100]}for(var p=e.material.color.toRgb(),i=0;3>i;i++)p[i]=I(p[i],t);return p.push(e.material.color.a),p},_=function(e){return e.outline?Y(e):{color:"rgba(0,0,0,1)",width:1.5}},Y=function(e){var t=e.outline,a=e.material&&e.material.color,p=a&&a.toRgba().toString();if(!t)return"Fill"===e.type&&"255,255,255,1"===p?{color:"#bdc3c7",width:.75}:null;var i=r.pt2px(t.size)||0,s=null!=t.color?t.color.toRgba():"255,255,255,1";return{color:"rgba("+s+")",width:i}},R=function(e,t){return{type:"linear",x1:0,y1:0,x2:4,y2:4,colors:[{color:e,offset:0},{color:t,offset:1}]}},I=function(e,t){var a=.75;return Math.min(Math.max(e+255*t*a,0),255)},O=function(e){var t={width:0,height:0};if(e){var a=e.type;if(-1===a.indexOf("3d")){var p=e.constructor.defaultProps,l=k(e),f=l?l.width:0;if(a===o)t.width=r.pt2px(e.size||p.size)+f,t.height=r.pt2px(e.size||p.size)+f;else if(a===h||a===i)t.width=b.size+f,t.height=b.size+f;else if(a===s)t.width=r.pt2px(e.width||p.width),t.height=r.pt2px(e.height||p.height);else if(a===c){var d=e.font,m=d?r.pt2px(d.size||p.size):0;t.width=m,t.height=m}}else{var x=e.symbolLayers.getItemAt(0),g=Y(x),M=g?g.width:0;a===n?(t.width=(r.pt2px(x.size)||20)+M,t.height=(r.pt2px(x.size)||20)+M):a===L&&"Line"===x.type?(t.width=0,t.height=M):a!==u&&a!==y||"Fill"!==x.type||(t.width=b.size+M,t.height=b.size+M)}}return t.width=Math.min(t.width,b.maxSize)||b.size,t.height=Math.min(t.height,b.maxSize)||b.size,t};return{getSwatch:m,getSymbolSize:O}});