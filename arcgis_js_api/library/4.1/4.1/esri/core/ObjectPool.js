// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["require","exports"],function(d,e){var c=function(){};return function(){function b(a,b){void 0===a&&(a=new c);this.cls=a;this.dispose=b;this._pool=[]}b.prototype.acquire=function(){for(var a=0;a<arguments.length;a++);this._pool.length?(a=this._pool.pop(),this.cls.call(a)):a=new this.cls;return a};b.prototype.release=function(a){a&&(a&&a.dispose&&"function"===typeof a.dispose?a.dispose():this.dispose&&this.dispose.call(a),this._pool.push(a))};return b}()});