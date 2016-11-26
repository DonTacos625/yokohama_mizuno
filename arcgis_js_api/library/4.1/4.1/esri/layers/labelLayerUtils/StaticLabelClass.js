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

define(["../../core/declare","../GraphicsLayer","../../geometry/Extent","../../geometry/Point","../../geometry/Polygon"],function(e,t,i,a,n){var s=e(t,{declaredClass:"esri.layers.labelLayerUtils.StaticLabel",constructor:function(){this._preparedLabels=[],this._placedLabels=[],this._extent=null,this._xmin=0,this._xmax=0,this._ymin=0,this._ymax=0,this._scale=1,this._LINE_STEP_CONST=1.5,this._POLYGON_X_STEP_CONST=1,this._POLYGON_Y_STEP_CONST=.75},setMap:function(e,t){this._labelLayer=t,this._map=e,this._xmin=e.extent.xmin,this._xmax=e.extent.xmax,this._ymin=e.extent.ymin,this._ymax=e.extent.ymax,this._scale=(this._xmax-this._xmin)/e.width},_process:function(e){var t,i,s,r,h,l,o,_,g,c,f;for(this._preparedLabels=e,this._placedLabels=[],t=this._preparedLabels.length-1;t>=0;t--){i=this._preparedLabels[t],o=i.labelWidth,_=i.labelHeight,g=i.options,c=g&&g.lineLabelPlacement?g.lineLabelPlacement:"PlaceAtCenter",f=g&&g.lineLabelPosition?g.lineLabelPosition:"Above",r=g&&g.labelRotation?g.labelRotation:!0,h=i.angle*(Math.PI/180),l=g&&g.howManyLabels?g.howManyLabels:"OneLabel";var m=[];if("point"===i.geometry.type)this._generatePointPositions(i.geometry.x,i.geometry.y,i.text,h,o,_,i.symbolWidth,i.symbolHeight,g,m);else if("multipoint"===i.geometry.type)for(s=0;s<i.geometry.points.length;s++)this._generatePointPositions(i.geometry.points[s][0],i.geometry.points[s][1],i.text,h,o,_,i.symbolWidth,i.symbolHeight,g,m);else if("polyline"===i.geometry.type)if("PlaceAtStart"===c)this._generateLinePositionsPlaceAtStart(i.geometry,!0,i.text,o,_,2*i.symbolHeight+_,c,f,r,m);else if("PlaceAtEnd"===c)this._generateLinePositionsPlaceAtEnd(i.geometry,!0,i.text,o,_,2*i.symbolHeight+_,c,f,r,m);else{var y=[],x=i.geometry.getExtent(),p=this._map.extent;if(x.getWidth()<o*this._scale&&x.getHeight()<o*this._scale)continue;if(.5*x.getWidth()<p.getWidth()&&.5*x.getHeight()<p.getHeight()){var P=.1*Math.min(this._map.width,this._map.height)*this._scale;this._generateLinePositionsPlaceAtCenter(i.geometry,!1,P,i.text,o,_,2*i.symbolHeight+_,c,f,r,y)}else{var u=this._LINE_STEP_CONST*Math.min(this._map.width,this._map.height)*this._scale;this._generateLinePositionsPlaceAtCenter(i.geometry,!0,u,i.text,o,_,2*i.symbolHeight+_,c,f,r,y)}this._postSorting(x,y,m)}else if("polygon"===i.geometry.type)for(s=0;s<i.geometry.rings.length;s++){var v=i.geometry.rings[s];if(n.prototype.isClockwise(v)){var b=this._calcRingExtent(v);b.xmax-b.xmin<4*o*this._scale&&b.ymax-b.ymin<4*_*this._scale||this._generatePolygonPositionsForManyLabels(v,i.geometry.spatialReference,i.text,h,o,_,m)}}for(s=0;s<m.length;s++){var d=m[s].x,L=m[s].y;void 0!==m[s].angle&&(h=m[s].angle);var M=this._findPlace(i,i.text,d,L,h,o,_);if("OneLabel"===l&&M&&this._labelLayer._isWithinScreenArea(new a(d,L,i.geometry.spatialReference)))break}}return this._placedLabels},_generatePointPositions:function(e,t,i,a,n,s,r,h,l,o){var _,g,c,f,m;switch(m=l&&l.pointPriorities?l.pointPriorities:"AboveRight",c=(r+n)*this._scale,f=(h+s)*this._scale,m.toLowerCase()){case"aboveleft":_=e-c,g=t+f;break;case"abovecenter":_=e,g=t+f;break;case"aboveright":_=e+c,g=t+f;break;case"centerleft":_=e-c,g=t;break;case"centercenter":_=e,g=t;break;case"centerright":_=e+c,g=t;break;case"belowleft":_=e-c,g=t-f;break;case"belowcenter":_=e,g=t-f;break;case"belowright":_=e+c,g=t-f;break;default:return}o.push({x:_,y:g})},_generateLinePositionsPlaceAtStart:function(e,t,i,a,n,s,r,h,l,o){var _,g,c,f,m,y,x,p,P,u=a*this._scale,v=this._LINE_STEP_CONST*Math.min(this._map.width,this._map.height)*this._scale;for(_=0;_<e.paths.length;_++){var b=e.paths[_],d=u,L=0;for(g=0;g<b.length-1;g++)c=b[g][0],f=b[g][1],m=b[g+1][0],y=b[g+1][1],x=m-c,p=y-f,P=Math.sqrt(x*x+p*p),L+P>d?(L=this._generatePositionsOnLine(e.spatialReference,t,d,v,L,c,f,m,y,i,a,n,s,h,l,o),d=v):L+=P}},_generateLinePositionsPlaceAtEnd:function(e,t,i,a,n,s,r,h,l,o){var _,g,c,f,m,y,x,p,P,u=a*this._scale,v=this._LINE_STEP_CONST*Math.min(this._map.width,this._map.height)*this._scale;for(_=0;_<e.paths.length;_++){var b=e.paths[_],d=u,L=0;for(g=b.length-2;g>=0;g--)c=b[g+1][0],f=b[g+1][1],m=b[g][0],y=b[g][1],x=m-c,p=y-f,P=Math.sqrt(x*x+p*p),L+P>d?(L=this._generatePositionsOnLine(e.spatialReference,t,d,v,L,c,f,m,y,i,a,n,s,h,l,o),d=v):L+=P}},_generateLinePositionsPlaceAtCenter:function(e,t,i,a,n,s,r,h,l,o,_){var g,c,f,m,y,x,p,P,u;for(g=0;g<e.paths.length;g++){var v=e.paths[g];if(!(v.length<2)){var b=0;for(c=0;c<v.length-1;c++)m=v[c][0],y=v[c][1],x=v[c+1][0],p=v[c+1][1],P=x-m,u=p-y,b+=Math.sqrt(P*P+u*u);var d=0;for(c=0;c<v.length-1;c++){m=v[c][0],y=v[c][1],x=v[c+1][0],p=v[c+1][1],P=x-m,u=p-y;var L=Math.sqrt(P*P+u*u);if(d+L>b/2)break;d+=L}c==v.length-1&&c--,m=v[c][0],y=v[c][1],x=v[c+1][0],p=v[c+1][1],P=x-m,u=p-y;var M=b/2-d,S=Math.atan2(u,P),O=m+M*Math.cos(S),w=y+M*Math.sin(S),N=this._angleAndShifts(m,y,x,p,r,l,o);_.push({x:O+N.shiftX,y:w+N.shiftY,angle:N.angle});var E=O,C=w;for(d=0,f=c;f<v.length-1;f++)f==c?(m=E,y=C):(m=v[f][0],y=v[f][1]),x=v[f+1][0],p=v[f+1][1],P=x-m,u=p-y,L=Math.sqrt(P*P+u*u),d+L>i?d=this._generatePositionsOnLine(e.spatialReference,t,i,i,d,m,y,x,p,a,n,s,r,l,o,_):d+=L;for(d=0,f=c;f>=0;f--)f==c?(m=E,y=C):(m=v[f+1][0],y=v[f+1][1]),x=v[f][0],p=v[f][1],P=x-m,u=p-y,L=Math.sqrt(P*P+u*u),d+L>i?d=this._generatePositionsOnLine(e.spatialReference,t,i,i,d,m,y,x,p,a,n,s,r,l,o,_):d+=L}}},_generatePositionsOnLine:function(e,t,a,n,s,r,h,l,o,_,g,c,f,m,y,x){for(var p=l-r,P=o-h,u=Math.atan2(P,p),v=r,b=h,d=v,L=b,M=a;;){var S=M-s;if(v+=S*Math.cos(u),b+=S*Math.sin(u),!this._belongs(v,b,r,h,l,o)){var O=l-d,w=o-L;return Math.sqrt(O*O+w*w)}var N=this._angleAndShifts(r,h,l,o,f,m,y),E=v+N.shiftX,C=b+N.shiftY;t?this._labelLayer._isWithinScreenArea(new i(E,C,E,C,e))&&x.push({x:E,y:C,angle:N.angle}):x.push({x:E,y:C,angle:N.angle}),d=v,L=b,s=0,M=n}},_postSorting:function(e,t,i){if(e&&t.length>0){for(var a=.5*(e.xmin+e.xmax),n=.5*(e.ymin+e.ymax),s=0,r=t[0].x,h=t[0].y,l=Math.sqrt((r-a)*(r-a)+(h-n)*(h-n)),o=t[0].angle,_=0;_<t.length;_++){var g=t[_].x,c=t[_].y,f=Math.sqrt((g-a)*(g-a)+(c-n)*(c-n));l>f&&(s=_,r=g,h=c,l=f,o=t[_].angle)}i.push({x:r,y:h,angle:o})}},_belongs:function(e,t,i,a,n,s){if(n==i&&s==a)return!1;if(n>i){if(e>n||i>e)return!1}else if(n>e||e>i)return!1;if(s>a){if(t>s||a>t)return!1}else if(s>t||t>a)return!1;return!0},_angleAndShifts:function(e,t,i,a,n,s,r){for(var h=i-e,l=a-t,o=Math.atan2(l,h);o>Math.PI/2;)o-=Math.PI;for(;o<-(Math.PI/2);)o+=Math.PI;var _=Math.sin(o),g=Math.cos(o),c=0,f=0;"Above"==s&&(c=n*_*this._scale,f=n*g*this._scale),"Below"==s&&(c=-n*_*this._scale,f=-n*g*this._scale);var m=[];return m.angle=r?-o:0,m.shiftX=-c,m.shiftY=f,m},_generatePolygonPositionsForManyLabels:function(e,t,a,n,s,r,h){var l,o,_=this._calcRingExtent(e);if(.75*(_.xmax-_.xmin)>this._map.width*this._scale||.75*(_.ymax-_.ymin)>this._map.height*this._scale){var g=this._findCentroidForRing(e);l=this._map.width*this._scale<_.xmax-_.xmin?this._POLYGON_X_STEP_CONST*this._map.width*this._scale:this._POLYGON_X_STEP_CONST*(_.xmax-_.xmin),o=this._map.height*this._scale<_.ymax-_.ymin?this._POLYGON_Y_STEP_CONST*this._map.height*this._scale:this._POLYGON_Y_STEP_CONST*(_.ymax-_.ymin);var c,f,m,y=g[0]-Math.round((g[0]-_.xmin)/l)*l,x=g[1]-Math.round((g[1]-_.ymin)/o)*o;for(c=!0,m=x;m<_.ymax;m+=o)if(c=!c,!(m<this._ymin||m>this._ymax)){var p=c?0:l/2;for(f=y+p;f<_.xmax;f+=l)this._labelLayer._isWithinScreenArea(new i(f,m,f,m,t))&&this._isPointWithinRing(a,e,f,m)&&h.push({x:f,y:m})}}else{g=this._findCentroidForRing(e);for(var P=0;10>P;P++){var u=(P%2?-1:1)*Math.floor(P/2),v=u*r*this._scale,b=g[0],d=g[1]+v;if(this._labelLayer._isWithinScreenArea(new i(b,d,b,d,t))&&this._isPointWithinRing(a,e,b,d))return void h.push({x:b,y:d})}}},_calcRingExtent:function(e){var t,a;for(a=new i,t=0;t<e.length-1;t++){var n=e[t][0],s=e[t][1];(void 0===a.xmin||n<a.xmin)&&(a.xmin=n),(void 0===a.ymin||s<a.ymin)&&(a.ymin=s),(void 0===a.xmax||n>a.xmax)&&(a.xmax=n),(void 0===a.ymax||s>a.ymax)&&(a.ymax=s)}return a},_isPointWithinPolygon:function(e,t,i,a){var n;for(n=0;n<t.rings.length;n++){var s=t.rings[n];if(this._isPointWithinRing(e,s,i,a))return!0}return!1},_isPointWithinRing:function(e,t,i,a){var n,s,r,h,l,o=[],_=t.length;for(n=0;_-1>n;n++)if(s=t[n][0],r=t[n][1],h=t[n+1][0],l=t[n+1][1],s!=h||r!=l){if(r==l){if(a!=r)continue;o.push(s)}if(s==h)l>r&&a>=r&&l>a&&o.push(s),r>l&&r>=a&&a>l&&o.push(s);else{var g=(h-s)/(l-r)*(a-r)+s;h>s&&g>=s&&h>g&&o.push(g),s>h&&s>=g&&g>h&&o.push(g)}}for(o.sort(function(e,t){return e-t}),n=0;n<o.length-1;n++)if(s=o[n],h=o[n+1],i>=s&&h>i)return n%2?!1:!0;return!1},_findCentroidForRing:function(e){for(var t=e.length,i=[0,0],a=0,n=e[0][0],s=e[0][1],r=1;t-1>r;r++){var h=e[r][0],l=e[r][1],o=e[r+1][0],_=e[r+1][1],g=(h-n)*(_-s)-(o-n)*(l-s);i[0]+=g*(n+h+o),i[1]+=g*(s+l+_),a+=g}return i[0]/=3*a,i[1]/=3*a,i},_findCentroidForFeature:function(e){for(var t=0,i=[0,0],a=0,n=0;n<e.rings.length;n++){var s=e.rings[n],r=s.length;a+=r;for(var h=s[0][0],l=s[0][1],o=1;r-1>o;o++){var _=s[o][0],g=s[o][1],c=s[o+1][0],f=s[o+1][1],m=(_-h)*(f-l)-(c-h)*(g-l);i[0]+=m*(h+_+c),i[1]+=m*(l+g+f),t+=m}}return i[0]/=3*t,i[1]/=3*t,i},_findPlace:function(e,t,a,s,r,h,l){if(isNaN(a)||isNaN(s))return!1;for(var o=0;o<this._placedLabels.length;o++){var _=this._placedLabels[o].angle,g=this._placedLabels[o].x,c=this._placedLabels[o].y,f=this._placedLabels[o].width*this._scale,m=this._placedLabels[o].height*this._scale,y=g-a,x=c-s;if(0===r&&0===_){if(this._findPlace2(-h*this._scale,-l*this._scale,h*this._scale,l*this._scale,y-f,x-m,y+f,x+m))return!1}else{var p=new i(-h*this._scale,-l*this._scale,h*this._scale,l*this._scale,null),P=0,u=1;0!==r&&(P=Math.sin(r),u=Math.cos(r));var v=y*u-x*P,b=y*P+x*u,d=_-r,L=Math.sin(d),M=Math.cos(d),S=-f*M- -m*L,O=-f*L+-m*M,w=+f*M- -m*L,N=+f*L+-m*M,E=v+S,C=b-O,A=v+w,R=b-N,T=v-S,W=b+O,I=v-w,k=b+N,Y=new n;if(Y.addRing([[E,C],[A,R],[T,W],[I,k],[E,C]]),p.intersects(Y))return!1}}for(;r>Math.PI/2;)r-=Math.PI;for(;r<-(Math.PI/2);)r+=Math.PI;var H={};return H.layer=e,H.text=t,H.angle=r,H.x=a,H.y=s,H.width=h,H.height=l,this._placedLabels.push(H),!0},_findPlace2:function(e,t,i,a,n,s,r,h){return(e>=n&&r>=e||i>=n&&r>=i||n>=e&&i>=r)&&(t>=s&&h>=t||a>=s&&h>=a||s>=t&&a>=h)?!0:!1}});return s});