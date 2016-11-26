//>>built
define(["./_base"],function(m){m=m.bezierutils={};m.tAtLength=function(a,b){var c=0,d=6==a.length,l=0,h=0,q=d?r:v,n=function(g,k){for(var e=0,f=0;f<g.length-2;f+=2)e+=p(g[f],g[f+1],g[f+2],g[f+3]);f=d?p(a[0],a[1],a[4],a[5]):p(a[0],a[1],a[6],a[7]);e-f>k||l+e>b+k?(++h,e=q(g,0.5),n(e[0],k),Math.abs(l-b)<=k||n(e[1],k)):(l+=e,c+=1/(1<<h))};b&&n(a,0.5);return c};var u=m.computeLength=function(a){for(var b=6==a.length,c=0,d=0;d<a.length-2;d+=2)c+=p(a[d],a[d+1],a[d+2],a[d+3]);d=b?p(a[0],a[1],a[4],a[5]):p(a[0],
a[1],a[6],a[7]);0.1<c-d&&(a=b?r(a,0.5):t(a,0.5),c=u(a[0],b),c+=u(a[1],b));return c},p=m.distance=function(a,b,c,d){return Math.sqrt((c-a)*(c-a)+(d-b)*(d-b))},r=function(a,b){var c=1-b,d=c*c,l=b*b,h=a[0],q=a[1],n=a[2],g=a[3],k=a[4],e=a[5],f=d*h+2*c*b*n+l*k,d=d*q+2*c*b*g+l*e;return[[h,q,c*h+b*n,c*q+b*g,f,d],[f,d,c*n+b*k,c*g+b*e,k,e]]},t=function(a,b){var c=1-b,d=c*c,l=d*c,h=b*b,q=h*b,n=a[0],g=a[1],k=a[2],e=a[3],f=a[4],m=a[5],p=a[6],s=a[7],r=l*n+3*d*b*k+3*c*h*f+q*p,l=l*g+3*d*b*e+3*c*h*m+q*s;return[[n,
g,c*n+b*k,c*g+b*e,d*n+2*c*b*k+h*f,d*g+2*c*b*e+h*m,r,l],[r,l,d*k+2*c*b*f+h*p,d*e+2*c*b*m+h*s,c*f+b*p,c*m+b*s,p,s]]},v=m.splitBezierAtT=function(a,b){return 6==a.length?r(a,b):t(a,b)};return m});