//>>built
define(["dojo/_base/lang"],function(h){h=h.getObject("dojox.encoding.ascii85",!0);var l=function(b,f,e){var c,d,a,g=[0,0,0,0,0];for(c=0;c<f;c+=4){if(a=256*(256*(256*b[c]+b[c+1])+b[c+2])+b[c+3])for(d=0;5>d;g[d++]=a%85+33,a=Math.floor(a/85));else e.push("z");e.push(String.fromCharCode(g[4],g[3],g[2],g[1],g[0]))}};h.encode=function(b){var f=[],e=b.length%4,c=b.length-e;l(b,c,f);if(e){for(b=b.slice(c);4>b.length;)b.push(0);l(b,4,f);b=f.pop();"z"==b&&(b="!!!!!");f.push(b.substr(0,e+1))}return f.join("")};
h.decode=function(b){var f=b.length,e=[],c=[0,0,0,0,0],d,a,g,h,k;for(d=0;d<f;++d)if("z"==b.charAt(d))e.push(0,0,0,0);else{for(a=0;5>a;++a)c[a]=b.charCodeAt(d+a)-33;k=f-d;if(5>k){for(a=k;4>a;c[++a]=0);c[k]=85}a=85*(85*(85*(85*c[0]+c[1])+c[2])+c[3])+c[4];g=a&255;a>>>=8;h=a&255;a>>>=8;e.push(a>>>8,a&255,h,g);for(a=k;5>a;++a,e.pop());d+=4}return e};return h});