// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define([],function(){var a=function(a,e,p,m){function q(a,c){var d,f,b,e;c=null==c?1E-6:c;b=a;for(f=0;8>f;f++){e=((k*b+h)*b+g)*b-a;if(Math.abs(e)<c)return b;d=(3*k*b+2*h)*b+g;if(1E-6>Math.abs(d))break;b-=e/d}d=0;f=1;b=a;if(b<d)return d;if(b>f)return f;for(;d<f;){e=((k*b+h)*b+g)*b;if(Math.abs(e-a)<c)break;a>e?d=b:f=b;b=0.5*(f-d)+d}return b}var g=3*a,h=3*(p-a)-g,k=1-g-h,l=3*e,n=3*(m-e)-l,r=1-l-n;return function(a,c){var d=q(a,c);return((r*d+n)*d+l)*d}},m=/^cubic-bezier\((.*)\)/;a.parse=function(c){var e=
a[c]||null;if(!e&&(c=m.exec(c)))c=c[1].split(",").map(function(a){return parseFloat(a.trim())}),4===c.length&&!c.some(function(a){return isNaN(a)})&&(e=a.apply(a,c));return e};a.ease=a(0.25,0.1,0.25,1);a.linear=a(0,0,1,1);a.easeIn=a["ease-in"]=a(0.42,0,1,1);a.easeOut=a["ease-out"]=a(0,0,0.58,1);a.easeInOut=a["ease-in-out"]=a(0.42,0,0.58,1);return a});