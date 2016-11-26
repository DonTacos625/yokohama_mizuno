// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("dojo/_base/array dojo/sniff ../Point ../ScreenPoint ../Polyline ../Polygon ../Multipoint ../Extent ./webMercatorUtils".split(" "),function(B,D,t,E,x,y,z,A,C){var F=function(){return 9>D("ie")?function(b,n,p,a,g,e,f,c,h){var d=[],l=Math.round,r,s=f.length,m,k,u,q,v,w;for(r=0;r<s;r++)if(m=f[r],q=c?c(m[0][0],m[0][1],h):m[0],1<(u=m.length)){v=l((q[0]-b)*p+g);w=l((n-q[1])*a+e);q=c?c(m[1][0],m[1][1],h):m[1];k=l((q[0]-b)*p+g);q=l((n-q[1])*a+e);d.push("M",v+","+w,"L",k+","+q);for(k=2;k<u;k++)q=c?
c(m[k][0],m[k][1],h):m[k],v=l((q[0]-b)*p+g),w=l((n-q[1])*a+e),d.push(v+","+w)}else v=l((q[0]-b)*p+g),w=l((n-q[1])*a+e),d.push("M",v+","+w);return d}:function(b,n,p,a,g,e,f,c,h){var d=[],l,r,s,m,k,u,q=Math.round;l=0;for(s=f?f.length:0;l<s;l++){k=f[l];d.push("M");r=0;for(m=k?k.length:0;r<m;r++)u=c?c(k[r][0],k[r][1],h):k[r],d.push(q((u[0]-b)*p+g)+","+q((n-u[1])*a+e))}return d}}();return{toScreenPoint:function(b,n,p,a,g){var e=b.spatialReference,f=a.spatialReference,c=a.x;a=a.y;e&&(f&&!e.equals(f)&&C.canProject(e,
f))&&(e=e.isWebMercator?t.lngLatToXY(c,a):t.xyToLngLat(c,a,!0),c=e[0],a=e[1]);c=(c-b.xmin)*(n/b.getWidth());a=(b.ymax-a)*(p/b.getHeight());g||(c=Math.round(c),a=Math.round(a));return new E(c,a)},toScreenGeometry:function(b,n,p,a){var g=b.xmin,e=b.ymax,f=n/b.getWidth(),c=p/b.getHeight(),h=B.forEach,d=Math.round;if(a instanceof t)return new t(d((a.x-g)*f),d((e-a.y)*c));if(a instanceof z){b=new z;var l=b.points;h(a.points,function(a,b){l[b]=[d((a[0]-g)*f),d((e-a[1])*c)]});return b}if(a instanceof A)return new A(d((a.xmin-
g)*f),d((e-a.ymin)*c),d((a.xmax-g)*f),d((e-a.ymax)*f));if(a instanceof x){b=new x;var r=b.paths,s;h(a.paths,function(a,b){s=r[b]=[];h(a,function(a,b){s[b]=[d((a[0]-g)*f),d((e-a[1])*c)]})});return b}if(a instanceof y){b=new y;var m=b.rings,k;h(a.rings,function(a,b){k=m[b]=[];h(a,function(a,b){k[b]=[d((a[0]-g)*f),d((e-a[1])*c)]})});return b}},_toScreenPath:function(b,n,p,a,g,e){var f=a instanceof x,c=b.spatialReference,h=a.spatialReference,d,l;c&&(h&&!c.equals(h)&&C.canProject(c,h))&&(c.isWebMercator?
d=t.lngLatToXY:(d=t.xyToLngLat,l=!0));return F(b.xmin,b.ymax,n/b.getWidth(),p/b.getHeight(),g,e,f?a.paths:a.rings,d,l)},toMapPoint:function(b,n,p,a){return new t(b.xmin+a.x/(n/b.getWidth()),b.ymax-a.y/(p/b.getHeight()),b.spatialReference)},toMapGeometry:function(b,n,p,a){var g=b.xmin,e=b.ymax,f=b.spatialReference,c=n/b.getWidth(),h=p/b.getHeight(),d=B.forEach;if(a instanceof t)return new t(g+a.x/c,e-a.y/h,f);if(a instanceof z){b=new z(f);var l=b.points;d(a.points,function(a,b){l[b]=[g+a[0]/c,e-a[1]/
h]});return b}if(a instanceof A)return new A(g+a.xmin/c,e-a.ymin/h,g+a.xmax/c,e-a.ymax/h,f);if(a instanceof x){b=new x(f);var r=b.paths,s;d(a.paths,function(a,b){s=r[b]=[];d(a,function(a,b){s[b]=[g+a[0]/c,e-a[1]/h]})});return b}if(a instanceof y){b=new y(f);var m=b.rings,k;d(a.rings,function(a,b){k=m[b]=[];d(a,function(a,b){k[b]=[g+a[0]/c,e-a[1]/h]})});return b}}}});