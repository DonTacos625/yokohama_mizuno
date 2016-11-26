// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["../../../../core/declare","./ElevationInfo","../../webgl-engine/Stage","../../support/aaBoundingBox","../../lib/glMatrix"],function(q,n,d,k,p){var r=p.vec3d,s=p.mat4d,m=q(null,{constructor:function(a,c,b,f,e,t,d,g){this.graphics3DSymbolLayer=a;this.uniqueMaterials=f;this.uniqueGeometries=b;this.uniqueTextures=e;this.stageObject=c;this.elevationAligner=t;this.elevationInfo=new l(d);this.stageLayer=this.stage=null;this._shown=!1;this._visibilityFlags={};this.visibilityMode=null!=g?g:m.VisibilityModes.HIDE_FACERANGE},
initialize:function(a,c){this.stageLayer=a;this.stage=c;var b;if(this.uniqueMaterials)for(b=0;b<this.uniqueMaterials.length;b++)c.add(d.ModelContentType.MATERIAL,this.uniqueMaterials[b]);if(this.uniqueGeometries)for(b=0;b<this.uniqueGeometries.length;b++)c.add(d.ModelContentType.GEOMETRY,this.uniqueGeometries[b]);if(this.uniqueTextures)for(b=0;b<this.uniqueTextures.length;b++)c.add(d.ModelContentType.TEXTURE,this.uniqueTextures[b]);c.add(d.ModelContentType.OBJECT,this.stageObject)},isDraped:function(){return!1},
areVisibilityFlagsSet:function(a,c){for(var b=!0,f=Object.keys(this._visibilityFlags),e=0;e<f.length;e++){var d=f[e];if(d!==c){if(d===a)return this._visibilityFlags[d];b=b&&this._visibilityFlags[d]}}return b},setVisibilityFlag:function(a,c){this._visibilityFlags[a]=c;return this._calcAndSetVisibility()},_calcAndSetVisibility:function(){if(null!=this.stage){var a=this.areVisibilityFlagsSet();return this._shown!=a?((this._shown=a)?this.stageLayer.hasObject(this.stageObject)?this.stageObject.unhideAllFaceRange():
this.stageLayer.addObject(this.stageObject):this.visibilityMode===m.VisibilityModes.HIDE_FACERANGE?this.stageObject.hideAllFaceRanges():this.stageLayer.removeObject(this.stageObject),!0):!1}},destroy:function(){if(this.stageLayer){var a,c=this.stage;if(this.uniqueMaterials)for(a=0;a<this.uniqueMaterials.length;a++)c.remove(d.ModelContentType.MATERIAL,this.uniqueMaterials[a].getId());if(this.uniqueGeometries)for(a=0;a<this.uniqueGeometries.length;a++)c.remove(d.ModelContentType.GEOMETRY,this.uniqueGeometries[a].getId());
if(this.uniqueTextures)for(a=0;a<this.uniqueTextures.length;a++)c.remove(d.ModelContentType.TEXTURE,this.uniqueTextures[a].getId())}c.remove(d.ModelContentType.OBJECT,this.stageObject.getId());this.stageLayer.hasObject(this.stageObject)&&this.stageLayer.removeObject(this.stageObject);this._shown=!1;this.stage=this.stageLayer=null},mustAlignToTerrain:function(){return this.elevationInfo.mode!==n.MODES.ABSOLUTE_HEIGHT},alignWithElevation:function(a,c){this.elevationAligner&&this.elevationAligner(this,
a,c)},setDrawOrder:function(){},getBSRadius:function(){return this.stageObject.getBSRadius()},getCenterObjectSpace:function(){return this.stageObject.getCenter(!0)},getBoundingBoxObjectSpace:function(a){var c=this.stageObject;a||(a=k.create());k.setMin(a,c.getBBMin(!0));k.setMax(a,c.getBBMax(!0));return a},getProjectedBoundingBox:function(a,c){var b=this.getBoundingBoxObjectSpace(c),f=[[0,1,2],[3,1,2],[0,4,2],[3,4,2],[0,1,5],[3,1,5],[0,4,5],[3,4,5]],e;for(e=0;e<f.length;e++){var d=f[e];g[0]=b[d[0]];
g[1]=b[d[1]];g[2]=b[d[2]];s.multiplyVec3(this.stageObject.objectTransformation,g);h[3*e+0]=g[0];h[3*e+1]=g[1];h[3*e+2]=g[2]}if(a(h,0,8)){k.set(b,k.NEGATIVE_INFINITY);for(e=0;e<h.length;e+=3)for(f=0;3>f;f++)b[f]=Math.min(b[f],h[e+f]),b[f+3]=Math.max(b[f+3],h[e+f]);return b}return null},getScreenSize:function(){throw Error("Not implemented for this symbol layer/graphic type");}});m.VisibilityModes={REMOVE_OBJECT:0,HIDE_FACERANGE:1};var h=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],g=r.create(),
l=function(a){n.call(this,a);this.centerPointInElevationSR=null};l.prototype=new n;l.prototype.constructor=l;return m});