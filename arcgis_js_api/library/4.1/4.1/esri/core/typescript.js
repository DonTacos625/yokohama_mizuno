// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["./declare","dojo/_base/lang"],function(m,n){var l={declareDefinition:function(a,b){var e=[],g=Object.getPrototypeOf(a.prototype),f;if(g!==Object.prototype){var h=g.constructor;f=h.prototype;e.push(h)}b&&(e=e.concat(b));for(var h={},k=Object.getOwnPropertyNames(a.prototype),d=0;d<k.length;d++){var c=k[d];if("constructor"!==c){var l=c;"dojoConstructor"===c&&(l="constructor");if(!f||a.prototype[c]!==f[c])h[l]=a.prototype[c]}}k=Object.getOwnPropertyNames(a);g=Object.getOwnPropertyNames(g.constructor);
f={};for(d=0;d<k.length;d++)c=k[d],-1===g.indexOf(c)&&(f[c]=a[c]);return{bases:e,instanceMembers:h,classMembers:f}},subclass:function(a){return function(b){b=l.declareDefinition(b,a);return n.mixin(m(b.bases,b.instanceMembers),b.classMembers)}},shared:function(a){return function(b,e){b[e]=a}}};return l});