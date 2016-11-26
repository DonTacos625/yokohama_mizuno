// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["require","exports","./PropertyOrigin","./utils","./extensions/serializableProperty"],function(v,g,p,m,s){function q(a,c,b,e){var h={};void 0!==b&&(null!==b||c.writeNull)&&c.write.call(a,b,h,e);return h}function t(a,c,b,e){a=a.store.originOf(c);return b.writeAlways||void 0===e||void 0===e.origin||a>=p.nameToId(e.origin)}function k(a,c,b){void 0===b&&(b=[]);if(-1!==b.indexOf(a))return b;b.push(a);a=c[a];if(!a||!a.writeWith)return b;a.writeWith.forEach(function(a){k(a,c,b)});return b}function u(a,
c,b){return k(a,c).some(function(a){return b[a]})}function r(a,c,b){var e=m.getProperties(a),h=e.metadatas,l={},g=[],n={},f;for(f in h){var d=s.originSpecificPropertyDefinition(h[f],b);if((n[f]=d)&&d.writable&&d.write)t(e,f,d,b)?(d=q(a,d,a.get(f),b),0<Object.keys(d).length&&(c=m.merge(c,d),l[f]=!0)):d.writeWith&&g.push(f)}g.filter(function(a){return u(a,n,l)}).forEach(function(e){var d=a.get(e),d=q(a,n[e],d,b);0<Object.keys(d).length&&(c=m.merge(c,d),l[e]=!0)});if(b&&b.writtenProperties)for(var k in l)b.writtenProperties.push({target:a,
propName:k,oldOrigin:p.idToReadableName(e.store.originOf(k)),newOrigin:b.origin});return c}g.write=r;Object.defineProperty(g,"__esModule",{value:!0});g.default=r});