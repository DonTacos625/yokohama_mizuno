// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["require","exports","dojo/has","./PerformanceTimer","./gl-matrix"],function(n,w,x,v,s){var c=s.vec3d,e=s.mat4d,p=e.create(),t=c.create(),u=c.create(),h=0;n=function(){function a(f,b,g,a,l,k,d){void 0===d&&(d=!1);this.dir=c.create();this.normalDir=null;this.minResult=new q;this.maxResult=new q;this.invertedM=e.create();this.mode="intersect";this.performanceInfo={queryDuration:0,numObjectsTested:0};this.intersectObject=this.intersectObject.bind(this);h&&(this.timer=new v(1));this.init(f,b,g,
a,l,k,d)}a.prototype.init=function(f,b,g,a,e,k,d){b&&g&&c.subtract(g,b,this.dir);this.minResult.init(b,g);this.maxResult.init(b,g);this.numObjectsTested=0;this.point=a;this.camera=e;this.isSelection=d;this.layers=f;this.p0=b;this.p1=g;this.hudResults=[];null==k&&(k=1E-5);this.tolerance=k;if(this.layers){h&&this.timer.start();for(f=0;f<this.layers.length;++f)if(b=this.layers[f],g=b.getSpatialQueryAccelerator?b.getSpatialQueryAccelerator():void 0)g.forEachAlongRay(this.p0,this.dir,this.intersectObject);
else{b=b.getObjects();g=0;for(a=b.length;g<a;++g)this.intersectObject(b[g])}h&&(this.timer.stop(),this.performanceInfo.queryDuration=this.timer.getLast(),this.performanceInfo.numObjectsTested=this.numObjectsTested)}};a.prototype.getDirection=function(){this.normalDir||(this.normalDir=c.create(),c.normalize(this.dir,this.normalDir));return this.normalDir};a.prototype.intersectObject=function(f){var b=this;this.numObjectsTested++;for(var a=f.getId(),c=f.getGeometryRecords(),l=f.getObjectTransformation(),
k,d=0;d<c.length;d++){var m=c[d].geometry,h=c[d].materials;k=m.getId();e.set(l,p);e.multiply(p,c[d].transformation);e.inverse(p,this.invertedM);e.multiplyVec3(this.invertedM,this.p0,t);e.multiplyVec3(this.invertedM,this.p1,u);for(var r=0,n=m.numGroups;r<n;++r)h[r].intersect(m,r,p,this.point,this.p0,this.p1,t,u,this.camera,this.tolerance,function(c,d,e,h,l){if(0<=c)if(l)l=new q,l.set(f,a,c,d,h,f.getCenter(),k,e),b.hudResults.push(l);else{if(null==b.minResult.priority||h>=b.minResult.priority)(null==
b.minResult.dist||c<b.minResult.dist)&&b.minResult.set(f,a,c,d,h,null,k,e);if(null==b.maxResult.priority||h>=b.maxResult.priority)(null==b.maxResult.dist||c>b.maxResult.dist)&&b.maxResult.set(f,a,c,d,h,null,k,e)}},this.isSelection)}};a.prototype.getMinResult=function(){return this.minResult};a.prototype.getMaxResult=function(){return this.maxResult};a.prototype.getHudResults=function(){return this.hudResults};a.DEFAULT_TOLERANCE=1E-5;a.Result=typeof q;return a}();var q=function(){function a(a,b){this.normal=
c.create();this.init(a,b)}a.prototype.getIntersectionPoint=function(a){if(null==this.dist)return!1;c.lerp(this.p0,this.p1,this.dist,a);return!0};a.prototype.set=function(a,b,g,e,h,k,d,m){this.dist=g;c.set(e,this.normal);this.object=a;this.name=b;this.priority=h;this.center=k;this.geometryId=d;this.triangleNr=m};a.prototype.setIntersector=function(a){this.intersector=a};a.prototype.init=function(a,b){this.priority=this.name=this.object=this.dist=void 0;this.triangleNr=this.geometryId=this.center=null;
this.intersector="stage";this.p0=a;this.p1=b};return a}();return n});