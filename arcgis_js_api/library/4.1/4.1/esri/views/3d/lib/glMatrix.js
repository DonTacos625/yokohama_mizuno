// COPYRIGHT © 2016 Esri
//
// All rights reserved under the copyright laws of the United States
// and applicable international laws, treaties, and conventions.
//
// This material is licensed for use under the Esri Master License
// Agreement (MLA), and is bound by the terms of that agreement.
// You may redistribute and use this code without modification,
// provided you adhere to the terms of the MLA and include this
// copyright notice.
//
// See use restrictions at http://www.esri.com/legal/pdfs/mla_e204_e300/english
//
// For additional information, contact:
// Environmental Systems Research Institute, Inc.
// Attn: Contracts and Legal Services Department
// 380 New York Street
// Redlands, California, USA 92373
// USA
//
// email: contracts@esri.com
//
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.

/*
* Copyright (c) 2012 Brandon Jones, Colin MacKenzie IV
*
* This software is provided 'as-is', without any express or implied
* warranty. In no event will the authors be held liable for any damages
* arising from the use of this software.
*
* Permission is granted to anyone to use this software for any purpose,
* including commercial applications, and to alter it and redistribute it
* freely, subject to the following restrictions:
*
* 1. The origin of this software must not be misrepresented; you must not
* claim that you wrote the original software. If you use this software
* in a product, an acknowledgment in the product documentation would be
* appreciated but is not required.
*
* 2. Altered source versions must be plainly marked as such, and must not
* be misrepresented as being the original software.
*
* 3. This notice may not be removed or altered from any source
* distribution.
*/

define([],function(){var t={};return function(t,r){r(t,!0),r(t,!1)}(t,function(t,r){"use strict";var n={};!function(){if("undefined"!=typeof Float32Array){var t=new Float32Array(1),r=new Int32Array(t.buffer);n.invsqrt=function(n){var e=.5*n;t[0]=n;var u=1.5;r[0]=1597463007-(r[0]>>1);var a=t[0];return a*(u-e*a*a)}}else n.invsqrt=function(t){return 1/Math.sqrt(t)}}();var e=Array;"undefined"!=typeof Float32Array&&(e=r?Float32Array:Array);var u={};u.create=function(t){var r=new e(3);return t?(r[0]=t[0],r[1]=t[1],r[2]=t[2]):r[0]=r[1]=r[2]=0,r},u.createFrom=function(t,r,n){var u=new e(3);return u[0]=t,u[1]=r,u[2]=n,u},u.set=function(t,r){return r[0]=t[0],r[1]=t[1],r[2]=t[2],r},u.set3=function(t,r,n,e){return e[0]=t,e[1]=r,e[2]=n,e},u.add=function(t,r,n){return n&&t!==n?(n[0]=t[0]+r[0],n[1]=t[1]+r[1],n[2]=t[2]+r[2],n):(t[0]+=r[0],t[1]+=r[1],t[2]+=r[2],t)},u.subtract=function(t,r,n){return n&&t!==n?(n[0]=t[0]-r[0],n[1]=t[1]-r[1],n[2]=t[2]-r[2],n):(t[0]-=r[0],t[1]-=r[1],t[2]-=r[2],t)},u.multiply=function(t,r,n){return n&&t!==n?(n[0]=t[0]*r[0],n[1]=t[1]*r[1],n[2]=t[2]*r[2],n):(t[0]*=r[0],t[1]*=r[1],t[2]*=r[2],t)},u.max=function(t,r,n){return n[0]=Math.max(t[0],r[0]),n[1]=Math.max(t[1],r[1]),n[2]=Math.max(t[2],r[2]),n},u.min=function(t,r,n){return n[0]=Math.min(t[0],r[0]),n[1]=Math.min(t[1],r[1]),n[2]=Math.min(t[2],r[2]),n},u.negate=function(t,r){return r||(r=t),r[0]=-t[0],r[1]=-t[1],r[2]=-t[2],r},u.scale=function(t,r,n){return n&&t!==n?(n[0]=t[0]*r,n[1]=t[1]*r,n[2]=t[2]*r,n):(t[0]*=r,t[1]*=r,t[2]*=r,t)},u.normalize=function(t,r){r||(r=t);var n=t[0],e=t[1],u=t[2],a=Math.sqrt(n*n+e*e+u*u);return a?1===a?(r[0]=n,r[1]=e,r[2]=u,r):(a=1/a,r[0]=n*a,r[1]=e*a,r[2]=u*a,r):(r[0]=0,r[1]=0,r[2]=0,r)},u.cross=function(t,r,n){n||(n=t);var e=t[0],u=t[1],a=t[2],i=r[0],o=r[1],c=r[2];return n[0]=u*c-a*o,n[1]=a*i-e*c,n[2]=e*o-u*i,n},u.length=function(t){var r=t[0],n=t[1],e=t[2];return Math.sqrt(r*r+n*n+e*e)},u.length2=function(t){var r=t[0],n=t[1],e=t[2];return r*r+n*n+e*e},u.dot=function(t,r){return t[0]*r[0]+t[1]*r[1]+t[2]*r[2]},u.direction=function(t,r,n){n||(n=t);var e=t[0]-r[0],u=t[1]-r[1],a=t[2]-r[2],i=Math.sqrt(e*e+u*u+a*a);return i?(i=1/i,n[0]=e*i,n[1]=u*i,n[2]=a*i,n):(n[0]=0,n[1]=0,n[2]=0,n)},u.lerp=function(t,r,n,e){return e||(e=t),e[0]=t[0]+n*(r[0]-t[0]),e[1]=t[1]+n*(r[1]-t[1]),e[2]=t[2]+n*(r[2]-t[2]),e},u.dist=function(t,r){var n=r[0]-t[0],e=r[1]-t[1],u=r[2]-t[2];return Math.sqrt(n*n+e*e+u*u)},u.dist2=function(t,r){var n=r[0]-t[0],e=r[1]-t[1],u=r[2]-t[2];return n*n+e*e+u*u};var a=null,i=new e(4);u.unproject=function(t,r,n,e,u){u||(u=t),a||(a=m.create());var o=a,c=i;return c[0]=2*(t[0]-e[0])/e[2]-1,c[1]=2*(t[1]-e[1])/e[3]-1,c[2]=2*t[2]-1,c[3]=1,m.multiply(n,r,o),m.inverse(o)?(m.multiplyVec4(o,c),0===c[3]?null:(u[0]=c[0]/c[3],u[1]=c[1]/c[3],u[2]=c[2]/c[3],u)):null};var o=u.createFrom(1,0,0),c=u.createFrom(0,1,0),f=u.createFrom(0,0,1);u.rotationTo=function(t,r,n){n||(n=M.create());var e=u.dot(t,r),a=u.create();if(e>=1)M.set(h,n);else if(1e-6-1>e)u.cross(o,t,a),a.length<1e-6&&u.cross(c,t,a),a.length<1e-6&&u.cross(f,t,a),u.normalize(a),M.fromAxisAngle(a,Math.PI,n);else{var i=Math.sqrt(2*(1+e)),s=1/i;u.cross(t,r,a),n[0]=a[0]*s,n[1]=a[1]*s,n[2]=a[2]*s,n[3]=.5*i,M.normalize(n)}return n[3]>1?n[3]=1:n[3]<-1&&(n[3]=-1),n};var s=u.create(),v=u.create();u.project=function(t,r,n,e){e||(e=t),u.direction(r,n,s),u.subtract(t,r,v);var a=u.dot(s,v);u.scale(s,a,e),u.add(e,r,e)},u.str=function(t){return"["+t[0]+", "+t[1]+", "+t[2]+"]"};var l={};l.create=function(t){var r=new e(9);return t?(r[0]=t[0],r[1]=t[1],r[2]=t[2],r[3]=t[3],r[4]=t[4],r[5]=t[5],r[6]=t[6],r[7]=t[7],r[8]=t[8]):r[0]=r[1]=r[2]=r[3]=r[4]=r[5]=r[6]=r[7]=r[8]=0,r},l.createFrom=function(t,r,n,u,a,i,o,c,f){var s=new e(9);return s[0]=t,s[1]=r,s[2]=n,s[3]=u,s[4]=a,s[5]=i,s[6]=o,s[7]=c,s[8]=f,s},l.determinant=function(t){var r=t[0],n=t[1],e=t[2],u=t[3],a=t[4],i=t[5],o=t[6],c=t[7],f=t[8];return r*(f*a-i*c)+n*(-f*u+i*o)+e*(c*u-a*o)},l.inverse=function(t,r){var n,e=t[0],u=t[1],a=t[2],i=t[3],o=t[4],c=t[5],f=t[6],s=t[7],v=t[8],m=v*o-c*s,M=-v*i+c*f,h=s*i-o*f,d=e*m+u*M+a*h;return d?(n=1/d,r||(r=l.create()),r[0]=m*n,r[1]=(-v*u+a*s)*n,r[2]=(c*u-a*o)*n,r[3]=M*n,r[4]=(v*e-a*f)*n,r[5]=(-c*e+a*i)*n,r[6]=h*n,r[7]=(-s*e+u*f)*n,r[8]=(o*e-u*i)*n,r):null},l.multiply=function(t,r,n){n||(n=t);var e=t[0],u=t[1],a=t[2],i=t[3],o=t[4],c=t[5],f=t[6],s=t[7],v=t[8],l=r[0],m=r[1],M=r[2],h=r[3],d=r[4],g=r[5],y=r[6],p=r[7],q=r[8];return n[0]=l*e+m*i+M*f,n[1]=l*u+m*o+M*s,n[2]=l*a+m*c+M*v,n[3]=h*e+d*i+g*f,n[4]=h*u+d*o+g*s,n[5]=h*a+d*c+g*v,n[6]=y*e+p*i+q*f,n[7]=y*u+p*o+q*s,n[8]=y*a+p*c+q*v,n},l.multiplyVec2=function(t,r,n){n||(n=r);var e=r[0],u=r[1];return n[0]=e*t[0]+u*t[3]+t[6],n[1]=e*t[1]+u*t[4]+t[7],n},l.multiplyVec3=function(t,r,n){n||(n=r);var e=r[0],u=r[1],a=r[2];return n[0]=e*t[0]+u*t[3]+a*t[6],n[1]=e*t[1]+u*t[4]+a*t[7],n[2]=e*t[2]+u*t[5]+a*t[8],n},l.set=function(t,r){return r[0]=t[0],r[1]=t[1],r[2]=t[2],r[3]=t[3],r[4]=t[4],r[5]=t[5],r[6]=t[6],r[7]=t[7],r[8]=t[8],r},l.identity=function(t){return t||(t=l.create()),t[0]=1,t[1]=0,t[2]=0,t[3]=0,t[4]=1,t[5]=0,t[6]=0,t[7]=0,t[8]=1,t},l.transpose=function(t,r){if(!r||t===r){var n=t[1],e=t[2],u=t[5];return t[1]=t[3],t[2]=t[6],t[3]=n,t[5]=t[7],t[6]=e,t[7]=u,t}return r[0]=t[0],r[1]=t[3],r[2]=t[6],r[3]=t[1],r[4]=t[4],r[5]=t[7],r[6]=t[2],r[7]=t[5],r[8]=t[8],r},l.toMat4=function(t,r){return r||(r=m.create()),r[15]=1,r[14]=0,r[13]=0,r[12]=0,r[11]=0,r[10]=t[8],r[9]=t[7],r[8]=t[6],r[7]=0,r[6]=t[5],r[5]=t[4],r[4]=t[3],r[3]=0,r[2]=t[2],r[1]=t[1],r[0]=t[0],r},l.str=function(t){return"["+t[0]+", "+t[1]+", "+t[2]+", "+t[3]+", "+t[4]+", "+t[5]+", "+t[6]+", "+t[7]+", "+t[8]+"]"};var m={};m.create=function(t){var r=new e(16);return 4===arguments.length?(r[0]=arguments[0],r[1]=arguments[1],r[2]=arguments[2],r[3]=arguments[3],r[4]=arguments[4],r[5]=arguments[5],r[6]=arguments[6],r[7]=arguments[7],r[8]=arguments[8],r[9]=arguments[9],r[10]=arguments[10],r[11]=arguments[11],r[12]=arguments[12],r[13]=arguments[13],r[14]=arguments[14],r[15]=arguments[15]):t&&(r[0]=t[0],r[1]=t[1],r[2]=t[2],r[3]=t[3],r[4]=t[4],r[5]=t[5],r[6]=t[6],r[7]=t[7],r[8]=t[8],r[9]=t[9],r[10]=t[10],r[11]=t[11],r[12]=t[12],r[13]=t[13],r[14]=t[14],r[15]=t[15]),r},m.createFrom=function(t,r,n,u,a,i,o,c,f,s,v,l,m,M,h,d){var g=new e(16);return g[0]=t,g[1]=r,g[2]=n,g[3]=u,g[4]=a,g[5]=i,g[6]=o,g[7]=c,g[8]=f,g[9]=s,g[10]=v,g[11]=l,g[12]=m,g[13]=M,g[14]=h,g[15]=d,g},m.createFromMatrixRowMajor=function(t){var r=new e(16);return r[0]=t[0],r[4]=t[1],r[8]=t[2],r[12]=t[3],r[1]=t[4],r[5]=t[5],r[9]=t[6],r[13]=t[7],r[2]=t[8],r[6]=t[9],r[10]=t[10],r[14]=t[11],r[3]=t[12],r[7]=t[13],r[11]=t[14],r[15]=t[15],r},m.createFromMatrix=function(t){var r=new e(16);return r[0]=t[0],r[1]=t[1],r[2]=t[2],r[3]=t[3],r[4]=t[4],r[5]=t[5],r[6]=t[6],r[7]=t[7],r[8]=t[8],r[9]=t[9],r[10]=t[10],r[11]=t[11],r[12]=t[12],r[13]=t[13],r[14]=t[14],r[15]=t[15],r},m.set=function(t,r){return r[0]=t[0],r[1]=t[1],r[2]=t[2],r[3]=t[3],r[4]=t[4],r[5]=t[5],r[6]=t[6],r[7]=t[7],r[8]=t[8],r[9]=t[9],r[10]=t[10],r[11]=t[11],r[12]=t[12],r[13]=t[13],r[14]=t[14],r[15]=t[15],r},m.setRowMajor=function(t,r){return r[0]=t[0],r[4]=t[1],r[8]=t[2],r[12]=t[3],r[1]=t[4],r[5]=t[5],r[9]=t[6],r[13]=t[7],r[2]=t[8],r[6]=t[9],r[10]=t[10],r[14]=t[11],r[3]=t[12],r[7]=t[13],r[11]=t[14],r[15]=t[15],r},m.identity=function(t){return t||(t=m.create()),t[0]=1,t[1]=0,t[2]=0,t[3]=0,t[4]=0,t[5]=1,t[6]=0,t[7]=0,t[8]=0,t[9]=0,t[10]=1,t[11]=0,t[12]=0,t[13]=0,t[14]=0,t[15]=1,t},m.transpose=function(t,r){if(!r||t===r){var n=t[1],e=t[2],u=t[3],a=t[6],i=t[7],o=t[11];return t[1]=t[4],t[2]=t[8],t[3]=t[12],t[4]=n,t[6]=t[9],t[7]=t[13],t[8]=e,t[9]=a,t[11]=t[14],t[12]=u,t[13]=i,t[14]=o,t}return r[0]=t[0],r[1]=t[4],r[2]=t[8],r[3]=t[12],r[4]=t[1],r[5]=t[5],r[6]=t[9],r[7]=t[13],r[8]=t[2],r[9]=t[6],r[10]=t[10],r[11]=t[14],r[12]=t[3],r[13]=t[7],r[14]=t[11],r[15]=t[15],r},m.determinant=function(t){var r=t[0],n=t[1],e=t[2],u=t[3],a=t[4],i=t[5],o=t[6],c=t[7],f=t[8],s=t[9],v=t[10],l=t[11],m=t[12],M=t[13],h=t[14],d=t[15];return m*s*o*u-f*M*o*u-m*i*v*u+a*M*v*u+f*i*h*u-a*s*h*u-m*s*e*c+f*M*e*c+m*n*v*c-r*M*v*c-f*n*h*c+r*s*h*c+m*i*e*l-a*M*e*l-m*n*o*l+r*M*o*l+a*n*h*l-r*i*h*l-f*i*e*d+a*s*e*d+f*n*o*d-r*s*o*d-a*n*v*d+r*i*v*d},m.inverse=function(t,r){r||(r=t);var n,e=t[0],u=t[1],a=t[2],i=t[3],o=t[4],c=t[5],f=t[6],s=t[7],v=t[8],l=t[9],m=t[10],M=t[11],h=t[12],d=t[13],g=t[14],y=t[15],p=e*c-u*o,q=e*f-a*o,w=e*s-i*o,x=u*f-a*c,F=u*s-i*c,A=a*s-i*f,b=v*d-l*h,R=v*g-m*h,V=v*y-M*h,j=l*g-m*d,z=l*y-M*d,I=m*y-M*g,N=p*I-q*z+w*j+x*V-F*R+A*b;return N?(n=1/N,r[0]=(c*I-f*z+s*j)*n,r[1]=(-u*I+a*z-i*j)*n,r[2]=(d*A-g*F+y*x)*n,r[3]=(-l*A+m*F-M*x)*n,r[4]=(-o*I+f*V-s*R)*n,r[5]=(e*I-a*V+i*R)*n,r[6]=(-h*A+g*w-y*q)*n,r[7]=(v*A-m*w+M*q)*n,r[8]=(o*z-c*V+s*b)*n,r[9]=(-e*z+u*V-i*b)*n,r[10]=(h*F-d*w+y*p)*n,r[11]=(-v*F+l*w-M*p)*n,r[12]=(-o*j+c*R-f*b)*n,r[13]=(e*j-u*R+a*b)*n,r[14]=(-h*x+d*q-g*p)*n,r[15]=(v*x-l*q+m*p)*n,r):null},m.toRotationMat=function(t,r){return r||(r=m.create()),r[0]=t[0],r[1]=t[1],r[2]=t[2],r[3]=t[3],r[4]=t[4],r[5]=t[5],r[6]=t[6],r[7]=t[7],r[8]=t[8],r[9]=t[9],r[10]=t[10],r[11]=t[11],r[12]=0,r[13]=0,r[14]=0,r[15]=1,r},m.toMat3=function(t,r){return r||(r=l.create()),r[0]=t[0],r[1]=t[1],r[2]=t[2],r[3]=t[4],r[4]=t[5],r[5]=t[6],r[6]=t[8],r[7]=t[9],r[8]=t[10],r},m.toInverseMat3=function(t,r){var n,e=t[0],u=t[1],a=t[2],i=t[4],o=t[5],c=t[6],f=t[8],s=t[9],v=t[10],m=v*o-c*s,M=-v*i+c*f,h=s*i-o*f,d=e*m+u*M+a*h;return d?(n=1/d,r||(r=l.create()),r[0]=m*n,r[1]=(-v*u+a*s)*n,r[2]=(c*u-a*o)*n,r[3]=M*n,r[4]=(v*e-a*f)*n,r[5]=(-c*e+a*i)*n,r[6]=h*n,r[7]=(-s*e+u*f)*n,r[8]=(o*e-u*i)*n,r):null},m.multiply=function(t,r,n){n||(n=t);var e=t[0],u=t[1],a=t[2],i=t[3],o=t[4],c=t[5],f=t[6],s=t[7],v=t[8],l=t[9],m=t[10],M=t[11],h=t[12],d=t[13],g=t[14],y=t[15],p=r[0],q=r[1],w=r[2],x=r[3],F=r[4],A=r[5],b=r[6],R=r[7],V=r[8],j=r[9],z=r[10],I=r[11],N=r[12],P=r[13],T=r[14],_=r[15];return n[0]=p*e+q*o+w*v+x*h,n[1]=p*u+q*c+w*l+x*d,n[2]=p*a+q*f+w*m+x*g,n[3]=p*i+q*s+w*M+x*y,n[4]=F*e+A*o+b*v+R*h,n[5]=F*u+A*c+b*l+R*d,n[6]=F*a+A*f+b*m+R*g,n[7]=F*i+A*s+b*M+R*y,n[8]=V*e+j*o+z*v+I*h,n[9]=V*u+j*c+z*l+I*d,n[10]=V*a+j*f+z*m+I*g,n[11]=V*i+j*s+z*M+I*y,n[12]=N*e+P*o+T*v+_*h,n[13]=N*u+P*c+T*l+_*d,n[14]=N*a+P*f+T*m+_*g,n[15]=N*i+P*s+T*M+_*y,n},m.multiplyVec3=function(t,r,n){n||(n=r);var e=r[0],u=r[1],a=r[2];return n[0]=t[0]*e+t[4]*u+t[8]*a+t[12],n[1]=t[1]*e+t[5]*u+t[9]*a+t[13],n[2]=t[2]*e+t[6]*u+t[10]*a+t[14],n},m.multiplyVec4=function(t,r,n){n||(n=r);var e=r[0],u=r[1],a=r[2],i=r[3];return n[0]=t[0]*e+t[4]*u+t[8]*a+t[12]*i,n[1]=t[1]*e+t[5]*u+t[9]*a+t[13]*i,n[2]=t[2]*e+t[6]*u+t[10]*a+t[14]*i,n[3]=t[3]*e+t[7]*u+t[11]*a+t[15]*i,n},m.translate=function(t,r,n){var e,u,a,i,o,c,f,s,v,l,m,M,h=r[0],d=r[1],g=r[2];return n&&t!==n?(e=t[0],u=t[1],a=t[2],i=t[3],o=t[4],c=t[5],f=t[6],s=t[7],v=t[8],l=t[9],m=t[10],M=t[11],n[0]=e,n[1]=u,n[2]=a,n[3]=i,n[4]=o,n[5]=c,n[6]=f,n[7]=s,n[8]=v,n[9]=l,n[10]=m,n[11]=M,n[12]=e*h+o*d+v*g+t[12],n[13]=u*h+c*d+l*g+t[13],n[14]=a*h+f*d+m*g+t[14],n[15]=i*h+s*d+M*g+t[15],n):(t[12]=t[0]*h+t[4]*d+t[8]*g+t[12],t[13]=t[1]*h+t[5]*d+t[9]*g+t[13],t[14]=t[2]*h+t[6]*d+t[10]*g+t[14],t[15]=t[3]*h+t[7]*d+t[11]*g+t[15],t)},m.scale=function(t,r,n){var e=r[0],u=r[1],a=r[2];return n&&t!==n?(n[0]=t[0]*e,n[1]=t[1]*e,n[2]=t[2]*e,n[3]=t[3]*e,n[4]=t[4]*u,n[5]=t[5]*u,n[6]=t[6]*u,n[7]=t[7]*u,n[8]=t[8]*a,n[9]=t[9]*a,n[10]=t[10]*a,n[11]=t[11]*a,n[12]=t[12],n[13]=t[13],n[14]=t[14],n[15]=t[15],n):(t[0]*=e,t[1]*=e,t[2]*=e,t[3]*=e,t[4]*=u,t[5]*=u,t[6]*=u,t[7]*=u,t[8]*=a,t[9]*=a,t[10]*=a,t[11]*=a,t)},m.maxScale=function(t){var r=Math.sqrt(t[0]*t[0]+t[4]*t[4]+t[8]*t[8]),n=Math.sqrt(t[1]*t[1]+t[5]*t[5]+t[9]*t[9]),e=Math.sqrt(t[2]*t[2]+t[6]*t[6]+t[10]*t[10]);return Math.max(Math.max(r,n),e)},m.rotate=function(t,r,n,e){var u,a,i,o,c,f,s,v,l,m,M,h,d,g,y,p,q,w,x,F,A,b,R,V,j=n[0],z=n[1],I=n[2],N=Math.sqrt(j*j+z*z+I*I);return N?(1!==N&&(N=1/N,j*=N,z*=N,I*=N),u=Math.sin(r),a=Math.cos(r),i=1-a,o=t[0],c=t[1],f=t[2],s=t[3],v=t[4],l=t[5],m=t[6],M=t[7],h=t[8],d=t[9],g=t[10],y=t[11],p=j*j*i+a,q=z*j*i+I*u,w=I*j*i-z*u,x=j*z*i-I*u,F=z*z*i+a,A=I*z*i+j*u,b=j*I*i+z*u,R=z*I*i-j*u,V=I*I*i+a,e?t!==e&&(e[12]=t[12],e[13]=t[13],e[14]=t[14],e[15]=t[15]):e=t,e[0]=o*p+v*q+h*w,e[1]=c*p+l*q+d*w,e[2]=f*p+m*q+g*w,e[3]=s*p+M*q+y*w,e[4]=o*x+v*F+h*A,e[5]=c*x+l*F+d*A,e[6]=f*x+m*F+g*A,e[7]=s*x+M*F+y*A,e[8]=o*b+v*R+h*V,e[9]=c*b+l*R+d*V,e[10]=f*b+m*R+g*V,e[11]=s*b+M*R+y*V,e):null},m.rotateX=function(t,r,n){var e=Math.sin(r),u=Math.cos(r),a=t[4],i=t[5],o=t[6],c=t[7],f=t[8],s=t[9],v=t[10],l=t[11];return n?t!==n&&(n[0]=t[0],n[1]=t[1],n[2]=t[2],n[3]=t[3],n[12]=t[12],n[13]=t[13],n[14]=t[14],n[15]=t[15]):n=t,n[4]=a*u+f*e,n[5]=i*u+s*e,n[6]=o*u+v*e,n[7]=c*u+l*e,n[8]=a*-e+f*u,n[9]=i*-e+s*u,n[10]=o*-e+v*u,n[11]=c*-e+l*u,n},m.rotateY=function(t,r,n){var e=Math.sin(r),u=Math.cos(r),a=t[0],i=t[1],o=t[2],c=t[3],f=t[8],s=t[9],v=t[10],l=t[11];return n?t!==n&&(n[4]=t[4],n[5]=t[5],n[6]=t[6],n[7]=t[7],n[12]=t[12],n[13]=t[13],n[14]=t[14],n[15]=t[15]):n=t,n[0]=a*u+f*-e,n[1]=i*u+s*-e,n[2]=o*u+v*-e,n[3]=c*u+l*-e,n[8]=a*e+f*u,n[9]=i*e+s*u,n[10]=o*e+v*u,n[11]=c*e+l*u,n},m.rotateZ=function(t,r,n){var e=Math.sin(r),u=Math.cos(r),a=t[0],i=t[1],o=t[2],c=t[3],f=t[4],s=t[5],v=t[6],l=t[7];return n?t!==n&&(n[8]=t[8],n[9]=t[9],n[10]=t[10],n[11]=t[11],n[12]=t[12],n[13]=t[13],n[14]=t[14],n[15]=t[15]):n=t,n[0]=a*u+f*e,n[1]=i*u+s*e,n[2]=o*u+v*e,n[3]=c*u+l*e,n[4]=a*-e+f*u,n[5]=i*-e+s*u,n[6]=o*-e+v*u,n[7]=c*-e+l*u,n},m.frustum=function(t,r,n,e,u,a,i){i||(i=m.create());var o=r-t,c=e-n,f=a-u;return i[0]=2*u/o,i[1]=0,i[2]=0,i[3]=0,i[4]=0,i[5]=2*u/c,i[6]=0,i[7]=0,i[8]=(r+t)/o,i[9]=(e+n)/c,i[10]=-(a+u)/f,i[11]=-1,i[12]=0,i[13]=0,i[14]=-(a*u*2)/f,i[15]=0,i},m.perspective=function(t,r,n,e,u){var a=n*Math.tan(t*Math.PI/360),i=a*r;return m.frustum(-i,i,-a,a,n,e,u)},m.ortho=function(t,r,n,e,u,a,i){i||(i=m.create());var o=r-t,c=e-n,f=a-u;return i[0]=2/o,i[1]=0,i[2]=0,i[3]=0,i[4]=0,i[5]=2/c,i[6]=0,i[7]=0,i[8]=0,i[9]=0,i[10]=-2/f,i[11]=0,i[12]=-(t+r)/o,i[13]=-(e+n)/c,i[14]=-(a+u)/f,i[15]=1,i},m.lookAt=function(t,r,n,e){e||(e=m.create());var u,a,i,o,c,f,s,v,l,M,h=t[0],d=t[1],g=t[2],y=n[0],p=n[1],q=n[2],w=r[0],x=r[1],F=r[2];return h===w&&d===x&&g===F?m.identity(e):(s=h-w,v=d-x,l=g-F,M=1/Math.sqrt(s*s+v*v+l*l),s*=M,v*=M,l*=M,u=p*l-q*v,a=q*s-y*l,i=y*v-p*s,M=Math.sqrt(u*u+a*a+i*i),M?(M=1/M,u*=M,a*=M,i*=M):(u=0,a=0,i=0),o=v*i-l*a,c=l*u-s*i,f=s*a-v*u,M=Math.sqrt(o*o+c*c+f*f),M?(M=1/M,o*=M,c*=M,f*=M):(o=0,c=0,f=0),e[0]=u,e[1]=o,e[2]=s,e[3]=0,e[4]=a,e[5]=c,e[6]=v,e[7]=0,e[8]=i,e[9]=f,e[10]=l,e[11]=0,e[12]=-(u*h+a*d+i*g),e[13]=-(o*h+c*d+f*g),e[14]=-(s*h+v*d+l*g),e[15]=1,e)},m.fromRotationTranslation=function(t,r,n){n||(n=m.create());var e=t[0],u=t[1],a=t[2],i=t[3],o=e+e,c=u+u,f=a+a,s=e*o,v=e*c,l=e*f,M=u*c,h=u*f,d=a*f,g=i*o,y=i*c,p=i*f;return n[0]=1-(M+d),n[1]=v+p,n[2]=l-y,n[3]=0,n[4]=v-p,n[5]=1-(s+d),n[6]=h+g,n[7]=0,n[8]=l+y,n[9]=h-g,n[10]=1-(s+M),n[11]=0,n[12]=r[0],n[13]=r[1],n[14]=r[2],n[15]=1,n},m.str=function(t){return"["+t[0]+", "+t[1]+", "+t[2]+", "+t[3]+", "+t[4]+", "+t[5]+", "+t[6]+", "+t[7]+", "+t[8]+", "+t[9]+", "+t[10]+", "+t[11]+", "+t[12]+", "+t[13]+", "+t[14]+", "+t[15]+"]"};var M={};M.create=function(t){var r=new e(4);return t?(r[0]=t[0],r[1]=t[1],r[2]=t[2],r[3]=t[3]):r[0]=r[1]=r[2]=r[3]=0,r},M.createFrom=function(t,r,n,u){var a=new e(4);return a[0]=t,a[1]=r,a[2]=n,a[3]=u,a},M.set=function(t,r){return r[0]=t[0],r[1]=t[1],r[2]=t[2],r[3]=t[3],r},M.identity=function(t){return t||(t=M.create()),t[0]=0,t[1]=0,t[2]=0,t[3]=1,t};var h=M.identity();M.calculateW=function(t,r){var n=t[0],e=t[1],u=t[2];return r&&t!==r?(r[0]=n,r[1]=e,r[2]=u,r[3]=-Math.sqrt(Math.abs(1-n*n-e*e-u*u)),r):(t[3]=-Math.sqrt(Math.abs(1-n*n-e*e-u*u)),t)},M.dot=function(t,r){return t[0]*r[0]+t[1]*r[1]+t[2]*r[2]+t[3]*r[3]},M.inverse=function(t,r){var n=t[0],e=t[1],u=t[2],a=t[3],i=n*n+e*e+u*u+a*a,o=i?1/i:0;return r&&t!==r?(r[0]=-t[0]*o,r[1]=-t[1]*o,r[2]=-t[2]*o,r[3]=t[3]*o,r):(t[0]*=-o,t[1]*=-o,t[2]*=-o,t[3]*=o,t)},M.conjugate=function(t,r){return r&&t!==r?(r[0]=-t[0],r[1]=-t[1],r[2]=-t[2],r[3]=t[3],r):(t[0]*=-1,t[1]*=-1,t[2]*=-1,t)},M.length=function(t){var r=t[0],n=t[1],e=t[2],u=t[3];return Math.sqrt(r*r+n*n+e*e+u*u)},M.normalize=function(t,r){r||(r=t);var n=t[0],e=t[1],u=t[2],a=t[3],i=Math.sqrt(n*n+e*e+u*u+a*a);return 0===i?(r[0]=0,r[1]=0,r[2]=0,r[3]=0,r):(i=1/i,r[0]=n*i,r[1]=e*i,r[2]=u*i,r[3]=a*i,r)},M.add=function(t,r,n){return n&&t!==n?(n[0]=t[0]+r[0],n[1]=t[1]+r[1],n[2]=t[2]+r[2],n[3]=t[3]+r[3],n):(t[0]+=r[0],t[1]+=r[1],t[2]+=r[2],t[3]+=r[3],t)},M.multiply=function(t,r,n){n||(n=t);var e=t[0],u=t[1],a=t[2],i=t[3],o=r[0],c=r[1],f=r[2],s=r[3];return n[0]=e*s+i*o+u*f-a*c,n[1]=u*s+i*c+a*o-e*f,n[2]=a*s+i*f+e*c-u*o,n[3]=i*s-e*o-u*c-a*f,n},M.multiplyVec3=function(t,r,n){n||(n=r);var e=r[0],u=r[1],a=r[2],i=t[0],o=t[1],c=t[2],f=t[3],s=f*e+o*a-c*u,v=f*u+c*e-i*a,l=f*a+i*u-o*e,m=-i*e-o*u-c*a;return n[0]=s*f+m*-i+v*-c-l*-o,n[1]=v*f+m*-o+l*-i-s*-c,n[2]=l*f+m*-c+s*-o-v*-i,n},M.scale=function(t,r,n){return n&&t!==n?(n[0]=t[0]*r,n[1]=t[1]*r,n[2]=t[2]*r,n[3]=t[3]*r,n):(t[0]*=r,t[1]*=r,t[2]*=r,t[3]*=r,t)},M.toMat3=function(t,r){r||(r=l.create());var n=t[0],e=t[1],u=t[2],a=t[3],i=n+n,o=e+e,c=u+u,f=n*i,s=n*o,v=n*c,m=e*o,M=e*c,h=u*c,d=a*i,g=a*o,y=a*c;return r[0]=1-(m+h),r[1]=s+y,r[2]=v-g,r[3]=s-y,r[4]=1-(f+h),r[5]=M+d,r[6]=v+g,r[7]=M-d,r[8]=1-(f+m),r},M.toMat4=function(t,r){r||(r=m.create());var n=t[0],e=t[1],u=t[2],a=t[3],i=n+n,o=e+e,c=u+u,f=n*i,s=n*o,v=n*c,l=e*o,M=e*c,h=u*c,d=a*i,g=a*o,y=a*c;return r[0]=1-(l+h),r[1]=s+y,r[2]=v-g,r[3]=0,r[4]=s-y,r[5]=1-(f+h),r[6]=M+d,r[7]=0,r[8]=v+g,r[9]=M-d,r[10]=1-(f+l),r[11]=0,r[12]=0,r[13]=0,r[14]=0,r[15]=1,r},M.slerp=function(t,r,n,e){e||(e=t);var u,a,i,o,c=t[0]*r[0]+t[1]*r[1]+t[2]*r[2]+t[3]*r[3];return Math.abs(c)>=1?(e!==t&&(e[0]=t[0],e[1]=t[1],e[2]=t[2],e[3]=t[3]),e):(u=Math.acos(c),a=Math.sqrt(1-c*c),Math.abs(a)<.001?(e[0]=.5*t[0]+.5*r[0],e[1]=.5*t[1]+.5*r[1],e[2]=.5*t[2]+.5*r[2],e[3]=.5*t[3]+.5*r[3],e):(i=Math.sin((1-n)*u)/a,o=Math.sin(n*u)/a,e[0]=t[0]*i+r[0]*o,e[1]=t[1]*i+r[1]*o,e[2]=t[2]*i+r[2]*o,e[3]=t[3]*i+r[3]*o,e))},M.fromRotationMatrix=function(t,r){r||(r=M.create());var n,e=t[0]+t[4]+t[8];if(e>0)n=Math.sqrt(e+1),r[3]=.5*n,n=.5/n,r[0]=(t[7]-t[5])*n,r[1]=(t[2]-t[6])*n,r[2]=(t[3]-t[1])*n;else{var u=M.fromRotationMatrix.s_iNext=M.fromRotationMatrix.s_iNext||[1,2,0],a=0;t[4]>t[0]&&(a=1),t[8]>t[3*a+a]&&(a=2);var i=u[a],o=u[i];n=Math.sqrt(t[3*a+a]-t[3*i+i]-t[3*o+o]+1),r[a]=.5*n,n=.5/n,r[3]=(t[3*o+i]-t[3*i+o])*n,r[i]=(t[3*i+a]+t[3*a+i])*n,r[o]=(t[3*o+a]+t[3*a+o])*n}return r},l.toQuat4=M.fromRotationMatrix,function(){var t=l.create();M.fromAxes=function(r,n,e,u){return t[0]=n[0],t[3]=n[1],t[6]=n[2],t[1]=e[0],t[4]=e[1],t[7]=e[2],t[2]=r[0],t[5]=r[1],t[8]=r[2],M.fromRotationMatrix(t,u)}}(),M.identity=function(t){return t||(t=M.create()),t[0]=0,t[1]=0,t[2]=0,t[3]=1,t},M.fromAngleAxis=function(t,r,n){n||(n=M.create());var e=.5*t,u=Math.sin(e);return n[3]=Math.cos(e),n[0]=u*r[0],n[1]=u*r[1],n[2]=u*r[2],n},M.toAngleAxis=function(t,r){r||(r=t);var e=t[0]*t[0]+t[1]*t[1]+t[2]*t[2];if(e>0){r[3]=2*Math.acos(t[3]);var u=n.invsqrt(e);r[0]=t[0]*u,r[1]=t[1]*u,r[2]=t[2]*u}else r[3]=0,r[0]=1,r[1]=0,r[2]=0;return r},M.str=function(t){return"["+t[0]+", "+t[1]+", "+t[2]+", "+t[3]+"]"};var d={};d.create=function(t){var r=new e(2);return t?(r[0]=t[0],r[1]=t[1]):(r[0]=0,r[1]=0),r},d.createFrom=function(t,r){var n=new e(2);return n[0]=t,n[1]=r,n},d.add=function(t,r,n){return n||(n=r),n[0]=t[0]+r[0],n[1]=t[1]+r[1],n},d.subtract=function(t,r,n){return n||(n=r),n[0]=t[0]-r[0],n[1]=t[1]-r[1],n},d.multiply=function(t,r,n){return n||(n=r),n[0]=t[0]*r[0],n[1]=t[1]*r[1],n},d.divide=function(t,r,n){return n||(n=r),n[0]=t[0]/r[0],n[1]=t[1]/r[1],n},d.scale=function(t,r,n){return n||(n=t),n[0]=t[0]*r,n[1]=t[1]*r,n},d.dist=function(t,r){var n=r[0]-t[0],e=r[1]-t[1];return Math.sqrt(n*n+e*e)},d.dist2=function(t,r){var n=r[0]-t[0],e=r[1]-t[1];return n*n+e*e},d.set=function(t,r){return r[0]=t[0],r[1]=t[1],r},d.set2=function(t,r,n){return n[0]=t,n[1]=r,n},d.negate=function(t,r){return r||(r=t),r[0]=-t[0],r[1]=-t[1],r},d.normalize=function(t,r){r||(r=t);var n=t[0]*t[0]+t[1]*t[1];return n>0?(n=Math.sqrt(n),r[0]=t[0]/n,r[1]=t[1]/n):r[0]=r[1]=0,r},d.cross=function(t,r,n){var e=t[0]*r[1]-t[1]*r[0];return n?(n[0]=n[1]=0,n[2]=e,n):e},d.length=function(t){var r=t[0],n=t[1];return Math.sqrt(r*r+n*n)},d.dot=function(t,r){return t[0]*r[0]+t[1]*r[1]},d.direction=function(t,r,n){n||(n=t);var e=t[0]-r[0],u=t[1]-r[1],a=e*e+u*u;return a?(a=1/Math.sqrt(a),n[0]=e*a,n[1]=u*a,n):(n[0]=0,n[1]=0,n[2]=0,n)},d.lerp=function(t,r,n,e){return e||(e=t),e[0]=t[0]+n*(r[0]-t[0]),e[1]=t[1]+n*(r[1]-t[1]),e},d.str=function(t){return"["+t[0]+", "+t[1]+"]"};var g={};g.create=function(t){var r=new e(4);return t?(r[0]=t[0],r[1]=t[1],r[2]=t[2],r[3]=t[3]):r[0]=r[1]=r[2]=r[3]=0,r},g.createFrom=function(t,r,n,u){var a=new e(4);return a[0]=t,a[1]=r,a[2]=n,a[3]=u,a},g.set=function(t,r){return r[0]=t[0],r[1]=t[1],r[2]=t[2],r[3]=t[3],r},g.identity=function(t){return t||(t=g.create()),t[0]=1,t[1]=0,t[2]=0,t[3]=1,t},g.transpose=function(t,r){if(!r||t===r){var n=t[1];return t[1]=t[2],t[2]=n,t}return r[0]=t[0],r[1]=t[2],r[2]=t[1],r[3]=t[3],r},g.determinant=function(t){return t[0]*t[3]-t[2]*t[1]},g.inverse=function(t,r){r||(r=t);var n=t[0],e=t[1],u=t[2],a=t[3],i=n*a-u*e;return i?(i=1/i,r[0]=a*i,r[1]=-e*i,r[2]=-u*i,r[3]=n*i,r):null},g.multiply=function(t,r,n){n||(n=t);var e=t[0],u=t[1],a=t[2],i=t[3];return n[0]=e*r[0]+u*r[2],n[1]=e*r[1]+u*r[3],n[2]=a*r[0]+i*r[2],n[3]=a*r[1]+i*r[3],n},g.rotate=function(t,r,n){n||(n=t);var e=t[0],u=t[1],a=t[2],i=t[3],o=Math.sin(r),c=Math.cos(r);return n[0]=e*c+u*o,n[1]=e*-o+u*c,n[2]=a*c+i*o,n[3]=a*-o+i*c,n},g.multiplyVec2=function(t,r,n){n||(n=r);var e=r[0],u=r[1];return n[0]=e*t[0]+u*t[1],n[1]=e*t[2]+u*t[3],n},g.scale=function(t,r,n){n||(n=t);var e=t[0],u=t[1],a=t[2],i=t[3],o=r[0],c=r[1];return n[0]=e*o,n[1]=u*c,n[2]=a*o,n[3]=i*c,n},g.str=function(t){return"["+t[0]+", "+t[1]+", "+t[2]+", "+t[3]+"]"};var y={};y.create=function(t){var r=new e(4);return t?(r[0]=t[0],r[1]=t[1],r[2]=t[2],r[3]=t[3]):(r[0]=0,r[1]=0,r[2]=0,r[3]=0),r},y.createFrom=function(t,r,n,u){var a=new e(4);return a[0]=t,a[1]=r,a[2]=n,a[3]=u,a},y.add=function(t,r,n){return n||(n=r),n[0]=t[0]+r[0],n[1]=t[1]+r[1],n[2]=t[2]+r[2],n[3]=t[3]+r[3],n},y.subtract=function(t,r,n){return n||(n=r),n[0]=t[0]-r[0],n[1]=t[1]-r[1],n[2]=t[2]-r[2],n[3]=t[3]-r[3],n},y.multiply=function(t,r,n){return n||(n=r),n[0]=t[0]*r[0],n[1]=t[1]*r[1],n[2]=t[2]*r[2],n[3]=t[3]*r[3],n},y.divide=function(t,r,n){return n||(n=r),n[0]=t[0]/r[0],n[1]=t[1]/r[1],n[2]=t[2]/r[2],n[3]=t[3]/r[3],n},y.scale=function(t,r,n){return n||(n=t),n[0]=t[0]*r,n[1]=t[1]*r,n[2]=t[2]*r,n[3]=t[3]*r,n},y.dot=function(t,r){return t[0]*r[0]+t[1]*r[1]+t[2]*r[2]+t[3]*r[3]},y.set=function(t,r){return r[0]=t[0],r[1]=t[1],r[2]=t[2],r[3]=t[3],r},y.set4=function(t,r,n,e,u){return u[0]=t,u[1]=r,u[2]=n,u[3]=e,u},y.negate=function(t,r){return r||(r=t),r[0]=-t[0],r[1]=-t[1],r[2]=-t[2],r[3]=-t[3],r},y.lerp=function(t,r,n,e){return e||(e=t),e[0]=t[0]+n*(r[0]-t[0]),e[1]=t[1]+n*(r[1]-t[1]),e[2]=t[2]+n*(r[2]-t[2]),e[3]=t[3]+n*(r[3]-t[3]),e},y.str=function(t){return"["+t[0]+", "+t[1]+", "+t[2]+", "+t[3]+"]"};var p=r?"":"d";t["glMath"+p]=n,t["vec2"+p]=d,t["vec3"+p]=u,t["vec4"+p]=y,t["mat2"+p]=g,t["mat3"+p]=l,t["mat4"+p]=m,t["quat4"+p]=M}),t});