// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define([],function(){function g(a,b){return-1===a.indexOf(b)}function h(a,b,c){return!a.some(b.bind(null,c))}return{findIndex:function(a,b,c){for(var d=a.length,f,e=0;e<d;e++)if(f=a[e],b.call(c,f,e,a))return e;return-1},find:function(a,b,c){for(var d=a.length,f,e=0;e<d;e++)if(f=a[e],b.call(c,f,e,a))return f},equals:function(a,b){if(!a&&!b)return!0;if(!a||!b||a.length!=b.length)return!1;for(var c=0;c<a.length;c++)if(a[c]!==b[c])return!1;return!0},difference:function(a,b,c){var d;c?(d=b.filter(h.bind(null,
a,c)),a=a.filter(h.bind(null,b,c))):(d=b.filter(g.bind(null,a)),a=a.filter(g.bind(null,b)));return{added:d,removed:a}},range:function(a,b){null==b&&(b=a,a=0);for(var c=Array(b-a),d=a;d<b;d++)c[d-a]=d;return c}}});