// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["require","dojo/_base/lang","dojox/gfx/_base","../../core/screenUtils"],function(u,q,p,f){var v=u.toUrl("../../symbols/patterns/"),w={left:"start",center:"middle",right:"end",justify:"start"},x={top:"text-before-edge",middle:"central",baseline:"alphabetic",bottom:"text-after-edge"},r=function(e){var a=null,c=e.style;if(e){var b=e.constructor;switch(e.type){case "simple-marker-symbol":c!==b.STYLE_CROSS&&c!==b.STYLE_X&&(a=e.color);break;case "simple-fill-symbol":c===b.STYLE_SOLID?a=e.color:
c!==b.STYLE_NULL&&(a=q.mixin({},p.defaultPattern,{src:v+c+".png",width:10,height:10}));break;case "picture-fill-symbol":a=q.mixin({},p.defaultPattern,{src:e.url,width:f.pt2px(e.width)*e.xscale,height:f.pt2px(e.height)*e.yscale,x:f.pt2px(e.xoffset),y:f.pt2px(e.yoffset)});break;case "text-symbol":a=e.color}}return a},t=function a(c){var b=null;if(c){var g=c.constructor,d=f.pt2px(c.width);switch(c.type){case "simple-fill-symbol":case "picture-fill-symbol":case "simple-marker-symbol":b=a(c.outline);break;
case "simple-line-symbol":c.style!==g.STYLE_NULL&&0!==d&&(b={color:c.color,style:s(c.style),width:d});break;case "cartographic-line-symbol":c.style!==g.STYLE_NULL&&0!==d&&(b={color:c.color,style:s(c.style),width:d,cap:c.cap,join:c.join===g.JOIN_MITER?f.pt2px(c.miterLimit):c.join});break;default:b=null}}return b},s=function(){var a={};return function(c){if(a[c])return a[c];var b=c.replace(/-/g,"");return a[c]=b}}();return{getFill:r,getStroke:t,getShapeDescriptors:function(a){if(!a)return{defaultShape:null,
fill:null,stroke:null};var c={fill:r(a),stroke:t(a)},b=a.constructor,g=b.defaultProps,d=null;switch(a.type){case "simple-marker-symbol":var n=a.style,g=0.5*f.pt2px(a.size||g.size),h=-g,l=+g,m=-g,k=+g;switch(n){case b.STYLE_CIRCLE:d={type:"circle",cx:0,cy:0,r:g};break;case b.STYLE_CROSS:d={type:"path",path:"M "+h+",0 L "+l+",0 M 0,"+m+" L 0,"+k+" E"};break;case b.STYLE_DIAMOND:d={type:"path",path:"M "+h+",0 L 0,"+m+" L "+l+",0 L 0,"+k+" L "+h+",0 Z"};break;case b.STYLE_SQUARE:d={type:"path",path:"M "+
h+","+k+" L "+h+","+m+" L "+l+","+m+" L "+l+","+k+" L "+h+","+k+" Z"};break;case b.STYLE_X:d={type:"path",path:"M "+h+","+k+" L "+l+","+m+" M "+h+","+m+" L "+l+","+k+" E"};break;case b.STYLE_PATH:d={type:"path",path:a.path||""}}break;case "simple-line-symbol":case "cartographic-line-symbol":d={type:"path",path:"M -15,0 L 15,0 E"};break;case "picture-fill-symbol":case "simple-fill-symbol":d={type:"path",path:"M -10,-10 L 10,0 L 10,10 L -10,10 L -10,-10 E"};break;case "picture-marker-symbol":d={type:"image",
x:-Math.round(f.pt2px(a.width)/2),y:-Math.round(f.pt2px(a.height)/2),width:f.pt2px(a.width),height:f.pt2px(a.height),src:a.source&&a.source.imageData?"data:"+a.source.contentType+";base64,"+a.source.imageData:a.url||""};break;case "text-symbol":b=a.font,n=f.pt2px(b.size),d={type:"text",text:a.text,x:0,y:0.25*p.normalizedLength(b?n:0),align:"middle",decoration:a.decoration||b&&b.decoration,rotated:a.rotated,kerning:a.kerning},c.font=b&&{size:n,style:b.style,variant:b.variant,decoration:b.decoration,
weight:b.weight,family:b.family}}c.defaultShape=d;return c},getSVGAlign:function(a){return a=(a=a.horizontalAlignment)&&w[a.toLowerCase()]||"middle"},getSVGBaseline:function(a){return(a=a.verticalAlignment)&&x[a.toLowerCase()]||"alphabetic"},getSVGBaselineShift:function(a){return"bottom"===a.verticalAlignment?"super":null}}});