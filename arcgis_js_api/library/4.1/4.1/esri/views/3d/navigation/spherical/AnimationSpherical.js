// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["../mixins/AnimationMixin","../../lib/glMatrix","../../support/mathUtils"],function(u,h,d){function v(e,a){var c=a[0]-e[0],b=a[1]-e[1],d=a[2]-e[2],l=a[3]-e[3];return c*c+b*b+d*d+l*l}function w(d,a){return Math.sqrt(v(d,a))}function x(e){this.interpolate=function(a,c,b){b=Math.min(9*b,0.3);d.slerpOrLerp(a.center,c.center,b,a.center,n);d.slerpOrLerp(a.eye,c.eye,b,a.eye,n);d.slerp(a.up,c.up,b);a.fov=d.lerp(a.fov,c.fov,b);a.padding=p.lerp(a.padding,c.padding,b,r);a.computeUpOnSphere()}}function y(e,
a,c){a=a||250;c=c||a;var b=0,h=0,l=0,s=0,q=function(b,g,f,m){var e=t.dist(b,g);if(0.1>e)return t.set(g,b),0;var h=Math.min(Math.sqrt(e*c),a);m=Math.min(m+c*f,h);f=Math.min(m/e*f,1);d.slerpOrLerp(b,g,f,b,n);return m};this.interpolate=function(k,g,f){b=q(k.eye,g.eye,f,b);h=q(k.center,g.center,f,h);s=q(k.padding,g.padding,f,s,{dist:w,lerp:function(a,b,c){return p.lerp(a,b,c,r)},set:function(a){k.padding=a}});l=e.easeInOutInterpLinear(c,a,k.fov,g.fov,f,l,{dist:function(a,b){return Math.abs(b-a)},lerp:d.lerp,
set:function(a){k.fov=a}});k.computeUpOnSphere()}}var t=h.vec3d,p=h.vec4d,r=p.create(),n=1E-4;return u.createSubclass({declaredClass:"esri.views.3d.navigation.spherical.AnimationSpherical",constructor:function(){this.interpolationTypes={linear:x,easeInOut:y}}})});