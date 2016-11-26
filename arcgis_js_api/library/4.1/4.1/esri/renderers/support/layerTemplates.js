// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("require exports dojo/_base/lang ../Renderer ../UniqueValueRenderer ../../symbols/WebStyleSymbol ../../symbols/support/jsonUtils ../../core/promiseUtils ../../symbols/support/symbolUtils".split(" "),function(u,e,h,k,l,m,n,p,q){function g(a){return"uniqueValue"===a.type&&(void 0!==a.styleUrl||void 0!==a.styleName)}function r(a,b){var d=k.fromJSON(a);d.sizeInfo&&(b.sizeInfo=d.sizeInfo);d.colorInfo&&(b.colorInfo=d.colorInfo);d.visualVariables&&(b.visualVariables=d.visualVariables);return b}function s(a,
b){var d=a.clone;b=h.clone(b);var c={toJSON:function(){return b},clone:function(){return c.apply(d.apply(this))},apply:function(a){a.toJSON=c.toJSON;a.clone=c.clone;return a}};return c.apply(a)}function t(a,b){return q.fetchStyle(a,b).then(function(d){var c=new l({defaultSymbol:a.defaultSymbol?n.fromJSON(a.defaultSymbol,b):void 0,field:a.field1});d.data.items.forEach(function(f){var e=new m({styleUrl:a.styleUrl||void 0,styleName:a.styleName||void 0,portal:a.styleName?b.portal:void 0,name:f.name});
c.addUniqueValueInfo(f.name,e);!c.defaultSymbol&&f.name===d.data.defaultItem&&(c.defaultSymbol=e)});c.defaultSymbol||(c.defaultSymbol=c.uniqueValueInfos[0].symbol);return r(a,s(c,a))})}e.createRenderer=function(a,b){return g(a)&&(a.styleUrl||a.styleName)?t(a,b):p.resolve(null)};e.isByReferenceRendererJSON=function(a){return g(a)}});