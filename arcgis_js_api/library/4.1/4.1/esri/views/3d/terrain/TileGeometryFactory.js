// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("../webgl-engine/lib/Geometry ../webgl-engine/lib/GeometryData ../lib/glMatrix ../support/earthUtils ../support/mathUtils ./TerrainConst".split(" "),function(aa,ba,ca,da,J,G){function O(c,g,h,k,d){c<k[0]&&(k[0]=c);c>d[0]&&(d[0]=c);g<k[1]&&(k[1]=g);g>d[1]&&(d[1]=g);h<k[2]&&(k[2]=h);h>d[2]&&(d[2]=h)}function Q(c,g,h){for(var k=0;k<h.length;k++){var d=h[k];if(d){var b=d.safeWidth,w=d.width,s=d.pixelData,m=J.clamp(d.dy*(d.y1-g),0,b),d=J.clamp(d.dx*(c-d.x0),0,b),b=Math.floor(m),n=Math.floor(d),
z=b*w+n,a=z+w,x=s[z],w=s[a],z=s[z+1],s=s[a+1];if(x+w+z+s<0.5*G.ELEVATION_NODATA_VALUE)return m-=b,d-=n,c=x+(z-x)*d,c+(w+(s-w)*d-c)*m}}return null}function R(c){M||c*c+4*(c-1)>N&&(c=1<<Math.floor(J.log2(0.5*(-4+Math.sqrt(16+4*(4+N))))));return c}var S=da.earthRadius,H=ca.vec3d,ea=J.lerp,M=!1,fa=function(){var c=H.create(),g=H.create(),h=H.create(),k,d,b;this.init=function(w,s){d=w;b=s;H.subtract(h,g,c);k=0.5*H.length(c);H.lerp(g,h,0.5,c)};this.getCenter=function(){return c};this.getBSRadius=function(){return k};
this.getBBMin=function(){return g};this.getBBMax=function(){return h};this.getPosition=function(){return d};this.getIndices=function(){return b};this.getPrimitiveIndices=function(){};this.getChildren=function(){}},U=function(c,g,h,k){c*=S;for(var d=0;d<=g;d++)h[5*k]=0,h[5*k+1]=0,h[5*k+2]=c,k++},P=new function(){var c=Array(50),g=0,h={};this.get=function(d){var b=h[d];b||(b={ptr:0,data:Array(50)},h[d]=b);0<b.ptr?(k.vertexArrayHits++,d=b.data[--b.ptr],b.data[b.ptr]=null):(k.vertexArrayMisses++,d=new Float32Array(d));
if(0<g)return k.geometryHits++,b=c[--g],c[g]=null,b.getData().getVertexAttr().terrain.data=d,b;k.geometryMisses++;b={};b.terrain={size:5,data:d};d=new fa;return new aa(new ba([{type:"triangle",indices:{terrain:null},positionKey:"terrain"}],b),"tile",[d])};this.put=function(d){var b=d.getData(),k=b.getVertexAttr(),s=k.terrain.data,m=h[s.length];50>m.ptr&&(m.data[m.ptr++]=s);k.terrain.data=null;b.getFaces()[0].indices.terrain=null;50>g&&(c[g++]=d)};var k={geometryHits:0,geometryMisses:0,vertexArrayHits:0,
vertexArrayMisses:0};this.stats=k;this._pools={geometry:c,vertexArray:h}},V=[],W=Array(G.MAX_TILE_TESSELATION+1),X=Array(G.MAX_TILE_TESSELATION+1),Y=Array(G.MAX_TILE_TESSELATION+1),Z=Array(G.MAX_TILE_TESSELATION+1),N=65536,ga={values:null,numSurfaceIndices:0,numSkirtIndices:0},T=function(c,g,h){h||(c.values=g.values);c.numSurfaceIndices=g.numSurfaceIndices;c.numSkirtIndices=g.numSkirtIndices;return c},$=function(c,g,h,k,d){var b;b=ga;var w=h&2,s=g+(k?1024:0)+(w?2048:0),m=V[s];b||(b={});if(m)T(b,m);
else{var m=g-1,n=g-1,z=g*g,a=2*m+2*n,x=6*m*n,C=6*a,B=6*(2*m+n-1);k&&(x*=2,C*=2,B*=2);for(var a=M&&z+a>N?new Uint32Array(x+C):new Uint16Array(x+C),r=0,l=0,e=x,p,v,q,u,y=0,t=0;t<=n;t++){w&&(y=0===t?B:t===n?-B:0);for(var e=e+y,f=0;f<=m;f++)u=v=-1,0===t&&(v=z+f,f!==m&&(u=r+1)),f===m&&(v=z+m+t,t<n&&(u=r+m+1)),t===n&&(v=z+m+n+(m-f),0<f&&(u=r-1)),0===f&&0<t&&(v=z+2*m+n+(n-t),u=r-(m+1)),-1<v&&(q=0===f&&1===t?z:v+1,-1<u&&(p=r,k?(a[e+0]=p,a[e+1]=v,a[e+2]=v,a[e+3]=q,a[e+4]=q,a[e+5]=p,a[e+6]=q,a[e+7]=u,a[e+8]=
u,a[e+9]=p,a[e+10]=p,a[e+11]=q,e+=12):(a[e+0]=p,a[e+1]=v,a[e+2]=q,a[e+3]=q,a[e+4]=u,a[e+5]=p,e+=6))),++r,f<m&&t<n&&(p=t*(m+1)+f,v=p+1,q=v+(m+1),u=q-1,k?(a[l+0]=p,a[l+1]=v,a[l+2]=v,a[l+3]=q,a[l+4]=q,a[l+5]=p,a[l+6]=q,a[l+7]=u,a[l+8]=u,a[l+9]=p,a[l+10]=p,a[l+11]=q,l+=12):(a[l+0]=p,a[l+1]=v,a[l+2]=q,a[l+3]=q,a[l+4]=u,a[l+5]=p,l+=6));e-=y}b.values=a;b.numSurfaceIndices=x;b.numSkirtIndices=C;V[s]=T({},b)}w=c.getData();s=w.getVertexAttr();w.getFaces()[0].indices.terrain=b.values;c.getBoundingInfo(0).init(s.terrain,
b.values);d||(d={});d.geometry=c;d.numWithoutSkirtIndices=b.numSurfaceIndices+(h?6*(g-1)*(k?2:1):0);d.numVertsPerRow=g;return T(d,b,!0)};return{createPlanarGlobeTile:function(c,g,h,k,d,b,w){var s=g[0],m=g[1],n=g[2]-s;g=g[3]-m;var z=0.1*n;c=R(c);var a=c-1,x=c-1,C=c*c,B=P.get(5*(C+(2*a+2*x))),r=B.getData().getVertexAttr().terrain.data,l,e,p=0;l=B.getBoundingInfo(0);var v=l.getBBMin(),q=l.getBBMax();H.set3(1E7,1E7,1E7,v);H.set3(-1E7,-1E7,-1E7,q);for(e=0;e<=x;e++){var u=e/x,y=m+u*g;b&&(y<b[1]?(y=b[1],
u=(y-m)/g):y>b[3]&&(y=b[3],u=(y-m)/g));for(l=0;l<=a;l++){var t=l/a,f=s+t*n;b&&(f<b[0]?(f=b[0],t=(f-s)/n):f>b[2]&&(f=b[2],t=(f-s)/n));var E=h?Q(f,y,h)||0:0,f=f-k[0],I=y-k[1],E=E-k[2];O(f,I,E,v,q);r[5*p]=f;r[5*p+1]=I;r[5*p+2]=E;r[5*p+3]=t;r[5*p+4]=u;var D=-1;0===e&&(D=C+l);l===a&&(D=C+a+e);e===x&&(D=C+a+x+(a-l));0===l&&0<e&&(D=C+2*a+x+(x-e));-1<D&&(r[5*D]=f,r[5*D+1]=I,r[5*D+2]=E-z,r[5*D+3]=t,r[5*D+4]=u,O(f,I-z,E,v,q));++p}}return $(B,c,0,d,w)},createSphericalGlobeTile:function(c,g,h,k,d,b,w,s,m){var n=
h[0],z=h[1],a=h[2],x=h[3],C=Math.max(0.9,1-0.5*(a-n));c=R(c);h=c-1;var B=c-1,r=c*c,l=P.get(5*(r+(2*h+2*B))),e=l.getData().getVertexAttr().terrain.data,p=g[2]-g[0],v=g[3]-g[1],q=a-n,a=b[0],u=b[1];b=b[2];var y=l.getBoundingInfo(0),t=y.getBBMin(),y=y.getBBMax();H.set3(1E7,1E7,1E7,t);H.set3(-1E7,-1E7,-1E7,y);var f;for(f=0;f<=h;f++){var E=f/h,I=n+E*q;W[f]=Math.sin(I);X[f]=Math.cos(I);Y[f]=E;Z[f]=g[0]+E*p}for(n=p=0;n<=B;n++){q=n/B;f=ea(z,x,q);var I=Math.cos(f),D=Math.sin(f),G;k?(G=S/2*Math.log((1+D)/(1-
D)),q=(G-g[1])/v):G=180*f/Math.PI;for(f=0;f<=h;f++){var E=Y[f],K=W[f],L=X[f],F=S;d&&(F+=Q(Z[f],G,d)||0);var L=L*I*F,K=K*I*F,F=D*F,J=L-a,M=K-u,N=F-b;O(J,M,N,t,y);var A=5*p;e[A+0]=J;e[A+1]=M;e[A+2]=N;e[A+3]=E;e[A+4]=q;A=-1;0===n&&(A=r+f);f===h&&(A=r+h+n);n===B&&(A=r+h+B+(h-f));0===f&&0<n&&(A=r+2*h+B+(B-n));-1<A&&(L=L*C-a,K=K*C-u,F=F*C-b,O(L,K,F,t,y),A*=5,e[A+0]=L,e[A+1]=K,e[A+2]=F,e[A+3]=E,e[A+4]=q);++p}}k&&(g=!!(w&2),w&1&&U(-1,h,e,r),g&&U(1,h,e,r+h+B));return $(l,c,k?w:0,s,m)},releaseGeometry:P.put,
elevationSampler:Q,_geometryObjectPool:P,supportedNumVertsPerRow:R,setSupportsUintIndices:function(c){M=c}}});