// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["require","exports","./externalRenderers/ExternalRendererStore","./support/projectionUtils","./webgl-engine/lib/gl-matrix"],function(w,b,t,h,u){function l(a,d){m.add(a,d)}function n(a,d){m.remove(a,d)}function p(a){a._stage.setNeedsRender()}function q(a,d,b,c,g,f,k){c=c||a.spatialReference;return h.bufferToBuffer(d,c,b,g,a.renderCoordsHelper.spatialReference,f,k)?g:null}function r(a,b,e,c,g,f,k){f=f||a.spatialReference;return h.bufferToBuffer(b,a.renderCoordsHelper.spatialReference,e,c,f,
g,k)?c:null}function s(a,b,e,c){c||(c=v.create());e=e||a.spatialReference;return h.computeLinearTransformation(e,b,c,a.renderCoordsHelper.spatialReference)?c:null}var v=u.mat4d,m=new t;b.add=l;b.remove=n;b.requestRender=p;b.toRenderCoordinates=q;b.fromRenderCoordinates=r;b.renderCoordinateTransformAt=s;b.bind=function(a){return{add:l.bind(this,a),remove:n.bind(this,a),requestRender:p.bind(this,a),toRenderCoordinates:q.bind(this,a),fromRenderCoordinates:r.bind(this,a),renderCoordinateTransformAt:s.bind(this,
a)}}});