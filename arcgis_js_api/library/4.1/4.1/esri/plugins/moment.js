// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["require","exports","dojo/_base/kernel","moment/moment"],function(k,b,h,e){var f={ar:1,"ar-ma":1,"ar-sa":1,"ar-tn":1,cs:1,da:1,de:1,"de-at":1,el:1,"en-au":1,"en-ca":1,"en-gb":1,"en-ie":1,"en-nz":1,es:1,"es-do":1,et:1,fi:1,fr:1,"fr-ca":1,"fr-ch":1,he:1,hr:1,it:1,ja:1,ko:1,lt:1,lv:1,nb:1,nl:1,pl:1,pt:1,"pt-br":1,ro:1,ru:1,sr:1,"sr-cyrl":1,sv:1,th:1,tr:1,vi:1,"zh-cn":1,"zh-tw":1};b.load=function(a,b,g){a=h.locale;"zh-hk"===a&&(a="zh-tw");var c=a in f;if(!c){var d=a.split("-");1<d.length&&d[0]in
f&&(a=d[0],c=!0)}c?b(["moment/locale/"+a],function(){g(e)}):g(e)}});