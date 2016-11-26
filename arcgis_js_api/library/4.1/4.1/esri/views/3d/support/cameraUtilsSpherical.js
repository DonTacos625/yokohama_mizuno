// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("../../../geometry/SpatialReference ../../../geometry/Extent ../../../geometry/support/webMercatorUtils ./mathUtils ./earthUtils ../lib/glMatrix ./cameraUtilsInternal".split(" "),function(v,F,G,l,A,B,H){function C(e,a,f){var m=d.create(),b=d.create();d.cross(e,D,q);0===d.dot(q,q)&&d.cross(e,E,q);h.identity(p);h.rotate(p,-l.deg2rad(a),e);h.rotate(p,-l.deg2rad(f),q);d.cross(q,e,b);d.normalize(b);h.multiplyVec3(p,b);d.normalize(e,m);h.multiplyVec3(p,d.negate(m));return{direction:m,up:b}}function y(e){var a=
e[1];e[1]=-e[2];e[2]=a}function z(e,a){var f=C(a,e.heading,e.tilt);e.up=f.up;return e}var J={headingTiltToDirectionUp:C,directionToHeadingTilt:function(e,a,f,m){var b=q,c=n;d.normalize(e,b);d.cross(b,D,n);0===d.dot(n,n)&&d.cross(b,E,n);d.cross(n,b,c);return H.directionToHeadingTilt(a,f,m,b,c)},eyeForCenterWithHeadingTilt:function(e,a,f,m){var b={eye:d.create(),tilt:m,heading:f},c=q;c[0]=e[0];c[1]=e[2];c[2]=-e[1];f=l.deg2rad(f);var g=l.deg2rad(m);m=Math.sin(f);f=Math.cos(f);var k=Math.sin(g),w=Math.cos(g),
t=d.length(c);if(1E-8>Math.abs(g))g=a+t;else var u=t/k,h=l.asin(a/u),g=u*Math.sin(Math.PI-g-h);var u=k*a,w=w*a,n=f*u,h=g-w,p=h*h,x=a*a*k*k,k=f*f*x,x=m*m*x,r=c[1]*h,s=k*(k+p-c[1]*c[1]);if(0>s)return d.scale(c,g/t,b.eye),b.tilt=0,b;var v=Math.sqrt(s),s=k+p,r=0<f?-v+r:v+r;if(1E-8>Math.abs(s))return 1E-8>t?(b.eye[0]=0,b.eye[1]=0,b.eye[2]=a):d.scale(c,g/t,b.eye),b.tilt=0,y(b.eye),z(b,e);b.eye[1]=r/s;a=b.eye[1]*b.eye[1];s=n*b.eye[1];n=1-a;r=Math.sqrt(n);a=k*a+x-2*s*r*h+n*p;if(1E-8>Math.abs(a))return d.scale(c,
g/t,b.eye),b.tilt=0,y(b.eye),z(b,e);b.eye[0]=(n*(g*c[0]-w*c[0])-u*r*(c[0]*b.eye[1]*f+c[2]*m))/a;b.eye[2]=(n*(g*c[2]-w*c[2])-u*r*(c[2]*b.eye[1]*f-c[0]*m))/a;d.scale(b.eye,g);y(b.eye);return z(b,e)},lookAtTiltToEyeTilt:function(e,a,f){e=d.length(e);e=Math.sqrt(a*a+e*e-2*a*e*Math.cos(Math.PI-f));a=l.asin(a/(e/Math.sin(f)));return l.rad2deg(f-a)},eyeTiltToLookAtTilt:function(e,a,f){f=l.deg2rad(f);e=d.length(e);return l.asin(a/(e/Math.sin(f)))+f},toExtent:function(e,a,f,d,b){var c,g=a.latitude;a=a.longitude;
c=A.getLonDeltaForDistance(a,g,f)/2;f=a-c;a+=c;c=l.deg2rad(g);g=A.earthRadius;c=(1+Math.sin(c))/(1-Math.sin(c));var k=c+1,h=Math.tan(d/g/2),k=k*h;c=1.5*Math.PI-2*Math.atan(0.5*(k+Math.sqrt(4*c+k*k)));d=c+d/g;g=function(a){var b=Math.PI/2;a=l.cyclical2PI.normalize(a,-b);a>b&&(a=Math.PI-a);return a};c=g(c);d=g(d);d<c&&(g=d,d=c,c=g);c=Math.max(l.rad2deg(c),-90);d=Math.min(l.rad2deg(d),90);a=I.monotonic(f,a);180<a-f&&(g=(a-f-180)/2,f+=g,a-=g);b?(b.xmin=f,b.ymin=c,b.xmax=a,b.ymax=d,b.spatialReference=
v.WGS84):b=new F(f,c,a,d,v.WGS84);e.spatialReference&&e.spatialReference.isWebMercator&&G.geographicToWebMercator(b,!1,b);return b}},d=B.vec3d,h=B.mat4d,D=d.createFrom(0,0,1),E=d.normalize(d.createFrom(1,1,1)),I=new l.Cyclical(-180,180),p=h.create(),q=d.create(),n=d.create();return J});