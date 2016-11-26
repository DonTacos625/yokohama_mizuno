// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("../../../../core/Accessor ../../../../core/Evented ../../webgl-engine/lib/Camera ../../support/mathUtils ../../lib/glMatrix dojo/on".split(" "),function(k,l,m,h,n,g){var e=n.vec4d.create();return k.createSubclass([l],{declaredClass:"esri.views.3d.navigation.mixins.CamerasMixin",properties:{targetCamera:{get:function(){return this.cameras.target}},currentCamera:{get:function(){return this.cameras.current}},windowSize:{set:function(a){var b=a[0],c=a[1],d=!1,e=this.cameras.target.x-this.cameras.target.padding[3],
f=this.cameras.target.y-this.cameras.target.padding[2];if(this.cameras.target.width+e!==b||this.cameras.target.height+f!==c)this.cameras.target.width=b-e,this.cameras.target.height=c-f,this.targetChanged(),d=!0;e=this.cameras.current.x-this.cameras.current.padding[3];f=this.cameras.current.y-this.cameras.current.padding[2];if(this.cameras.current.width+e!==b||this.cameras.current.height+f!==c)this.cameras.current.width=b-e,this.cameras.current.height=c-f,this.currentChanged(),d=!0;d&&this.currentHasReachedTarget()&&
this.currentReachedTarget();this._set("windowSize",a)}},padding:{set:function(a){var b=!1,c=!1;e[0]=a.top;e[1]=a.right;e[2]=a.bottom;e[3]=a.left;h.vectorEquals(this.cameras.current.padding,e)||(this.cameras.current.padding=e,c=!0);h.vectorEquals(this.cameras.target.padding,e)||(this.cameras.target.padding=e,b=!0);b&&this.targetChanged();c&&this.currentChanged();this.currentHasReachedTarget()&&(b||c)&&this.currentReachedTarget()}}},initialize:function(){var a=this.getInitialCamera();this.cameras={current:a,
target:a.copy()}},currentHasReachedTarget:function(){return this.cameras.current.equals(this.cameras.target)},currentHasAlmostReachedTarget:function(){return this.cameras.current.almostEquals(this.cameras.target,5E-4/this.renderUnitInMeters)},setCamera:function(a,b){this.pan&&this.pan.continuous&&this.pan.continuous.stop();this.cameras.target.copyFrom(a);var c=!(b&&b.internalUpdate)||!this._targetCameraChangedByElevationUpdate,d=this.constrainTargetEyeByElevation(c),d=this.applyConstraints(this.cameras.target,
!0)||d;this.fixTargetUpVector();this.currentHasReachedTarget()?(this.targetChanged(),d&&c&&(this._targetCameraChangedByElevationUpdate=!0),this.currentReachedTarget()):(void 0!==b&&void 0!==b.animate&&!b.animate?this.targetAndCurrentChanged(!0):this.targetAnimatedChanged(),d&&c&&(this._targetCameraChangedByElevationUpdate=!0),this._autoUpdateTiltConstraint())},getTargetCamera:function(){console.warn("[Navigation.getTargetCamera()] deprecated; use .targetCamera instead");return this.targetCamera},
getCurrentCamera:function(){console.warn("[Navigation.getCurrentCamera()] deprecated; use .currentCamera instead");return this.currentCamera},_cameraFromEyeCenterUp:function(a,b,c){var d=this.cameras.target.copy();d.eye=a;d.center=b;d.up=c;return d},setCameraFromEyeAndCenter:function(a,b,c){this.setCamera(this._cameraFromEyeCenterUp(a,b,this.cameras.target.up),c)},setCameraFromEyeCenterAndUp:function(a,b,c,d){this.setCamera(this._cameraFromEyeCenterUp(a,b,c),d)},_cameraEvents:{},_prepareCameraEvent:function(a,
b){var c=this._cameraEvents[a];c||(c={camera:new m},this._cameraEvents[a]=c);c.camera.copyFrom(b);return c},emitWithCamera:function(a,b){g.emit(this,a,this._prepareCameraEvent(a,b))},targetChanged:function(a){this.inherited(arguments);this.cameras.target.markViewDirty();var b=this._prepareCameraEvent("targetViewChanged",this.cameras.target);b.interruptedAnimation=!!a;b.finishedAnimation=!1;g.emit(this,"targetViewChanged",b)},targetAnimatedChanged:function(a){this.targetChanged(a);this.animationStarted()},
targetAndCurrentChanged:function(a){this.targetChanged(a);this.setCurrentToTarget(!1,a)},currentChanged:function(){this.inherited(arguments);this.cameras.current.markViewDirty();this.emitWithCamera("currentViewChanged",this.cameras.current)},currentReachedTarget:function(a,b){this.currentChanged();if(!this.pan||!this.pan.continuous||!this.pan.continuous.active){var c=this._prepareCameraEvent("currentViewReachedTarget",this.cameras.current);c.finishedAnimation=!!a;c.interruptedAnimation=!!b;g.emit(this,
"currentViewReachedTarget",c)}},setCurrentToTarget:function(a,b){this.cameras.current.copyFrom(this.cameras.target);this.currentReachedTarget(a,b)}})});