// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("require exports ../core/tsSupport/declareExtendsHelper ../core/tsSupport/decorateHelper ../core/JSONSupport ../core/Collection ../core/collectionUtils ../core/accessorSupport/decorators ./Slide".split(" "),function(m,n,h,d,k,l,e,b,f){var c=l.ofType(f);return function(g){function a(a){g.call(this,a);this.slides=new c}h(a,g);Object.defineProperty(a.prototype,"slides",{set:function(a){this._set("slides",e.referenceSetter(a,this._get("slides"),c))},enumerable:!0,configurable:!0});a.prototype.clone=
function(){return new this.constructor({slides:this.slides.clone()})};a.prototype.toJSON=function(){return this.inherited(arguments)};a.sanitizeJSON=function(a){return{slides:void 0!==a.slides&&Array.isArray(a.slides)?a.slides.filter(function(a){return a&&!!a.viewpoint}).map(function(a){return f.sanitizeJSON(a)}):[]}};d([b.property({type:c,json:{writable:!0}}),b.cast(e.castForReferenceSetter)],a.prototype,"slides",null);return a=d([b.subclass("esri.webscene.Presentation")],a)}(b.declared(k))});