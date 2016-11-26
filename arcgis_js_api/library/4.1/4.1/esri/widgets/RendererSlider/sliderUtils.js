// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("../../renderers/support/utils ../../core/numberUtils dojo/i18n!./nls/RendererSlider dojo/_base/array dojo/_base/lang dojo/dom-style dojo/string dijit/Tooltip dojox/gfx".split(" "),function(B,w,x,n,u,e,y,z,A){return{histogramXAvgPadding:18,labelTopOffset:3,generateTransparentBackground:function(a,b,c,d){a=a.createRect({width:b,height:c}).setFill(d?this.getTransparentFill():null);a.moveToBack();return a},getTransparentFill:function(){return{type:"pattern",x:0,y:0,width:16,height:16,src:"data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgaGVpZ2h0PSIxNiIgd2lkdGg9IjE2Ij48cGF0aCBkPSJNMCAwIEw4IDAgTDggOCBMMCA4IFoiIGZpbGw9IiNjY2MiIC8+PHBhdGggZD0iTTAgMCBMOCAwIEw4IDggTDAgOCBaIiBmaWxsPSIjZmZmIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLDgpIiAvPjxwYXRoIGQ9Ik0wIDAgTDggMCBMOCA4IEwwIDggWiIgZmlsbD0iI2NjYyIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoOCw4KSIgLz48cGF0aCBkPSJNMCAwIEw4IDAgTDggOCBMMCA4IFoiIGZpbGw9IiNmZmYiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDgsMCkiIC8+PC9zdmc+"}},
generateHistogramSurface:function(a,b,c,d){a=A.createSurface(a,b,c);e.set(a.rawNode,{overflow:"visible",display:"inline-block",left:d+"px"});a.rawNode.setAttribute("class","esri-histogram-surface");return a},generateCountTooltips:function(a,b){var c=[],d;d=n.map(a.bins,function(b){return"object"===typeof b?b.count:b});d.reverse();n.forEach(d,u.hitch(this,function(a,d){c.push(new z({connectId:[b.children[d].rawNode],label:y.substitute(x.count,{count:a})}))}));return c},generateHistogram:function(a,
b,c,d,k){var h=a.createGroup(),l,m,g,f;h.rawNode.setAttribute("class","esri-histogram-group");l=n.map(b.bins,function(b){return"object"===typeof b?b.count:b});l.reverse();m=a.getDimensions().height/l.length;n.forEach(l,u.hitch(this,function(b,a){g=0<b?(c-this.histogramXAvgPadding)*(b/Math.max.apply(Math,l)):0;f=h.createRect({width:g,height:m}).setFill("#aaa").setTransform(A.matrix.translate(0,m*a));f.rawNode.setAttribute("class","esri-histogram-bar");f.rawNode.setAttribute("shape-rendering","crispEdges")}));
e.set(a.rawNode,{display:"inline-block",left:d+"px"});k||h.setTransform({dx:c,dy:0,xx:-1,xy:0,yx:0,yy:1});return h},generateAvgLine:function(a,b,c,d,k,h,l){var m=a.rawNode.getAttribute("width"),g=a.rawNode.getAttribute("height");c=Math.round(c);var f;f=a.createLine({x1:k?0:12,y1:c,x2:k?m-this.histogramXAvgPadding+4:m,y2:c}).setStroke({color:"#667"}).moveToBack();f.rawNode.setAttribute("shape-rendering","crispEdges");a=a.createImage({x:k?m-this.histogramXAvgPadding+6:0,y:c-8,width:12,height:14,src:require.toUrl("esri/widgets/RendererSlider/images/xAvg.png")});
h||(b=l?w.format(parseFloat(b.toFixed(2))).toString()+"%":w.format(parseFloat(b.toFixed(2>d?2:d))).toString());b=new z({connectId:[a.rawNode],label:y.substitute(x.statsAvg,{avg:b})});c>g||0>c?(e.set(f.rawNode,"display","none"),e.set(a.rawNode,"display","none")):(e.set(f.rawNode,"display","block"),e.set(a.rawNode,"display","block"));return{avgHandleLine:f,avgHandleImage:a,avgHandleTooltip:b}},getCombinedPrecision:function(a,b){var c=this.getPrecision(a),d=this.getPrecision(b);return-10<a&&10>a&&-10<
b&&10>b&&2>c&&2>d?2:c>d?c:d},getPrecision:function(a){if(isNaN(a))return 0;for(var b=1;Math.round(a*b)/b!==a;)b*=10;a=Math.round(Math.log(b)/Math.LN10);return 20<a?20:a},_resetLabelPositions:function(a){n.forEach(a,function(b){b&&b.labelNode&&(e.set(b.labelNode,"top","3px"),b.labelNode._autoPositioned=!1)})},_autoPositionHandleLabels:function(a){var b=[];if(0!==a.length&&(this._resetLabelPositions(a),n.forEach(a,function(a,d){a&&a.labelNode&&b.push({index:d,handle:a,label:a.labelNode,rect:a.labelNode.getBoundingClientRect()})}),
0!==b.length))switch(b.length){case 1:break;case 2:this._autoPositionTwoHandles(a,b);break;case 3:this._autoPositionThreeHandles(a,b);break;default:this._autoPositionManyHandles(a,b)}},_autoPositionTwoHandles:function(a,b){var c,d;this.collisionCheck(b[0].rect,b[1].rect)&&(c=b[0].rect.top-b[1].rect.top,d=(b[0].rect.height-c)/2,c=this.labelTopOffset+d,d=this.labelTopOffset-d,e.set(b[0].label,"top",c+"px"),e.set(b[1].label,"top",d+"px"),b[0].label._autoPositioned=!0,b[1].label._autoPositioned=!0)},
_autoPositionThreeHandles:function(a,b){var c,d,k,h,l,m,g;n.forEach(b,u.hitch(this,function(a,f){if((g=b[f-1])&&g.rect&&this.collisionCheck(a.rect,g.rect))a.label._autoPositioned&&!g.label._autoPositioned?(c=g.rect.top-a.rect.top,k=a.rect.height,h=k-c+this.labelTopOffset,e.set(g.label,"top",h+"px"),g.label._autoPositioned=!0):(!a.label._autoPositioned&&g.label._autoPositioned?(c=g.rect.top-a.rect.top,k=a.rect.height,h=-1*(k-c)+Number(g.label.style.top.replace("px","")),e.set(a.label,"top",h+"px")):
(c=g.rect.top-a.rect.top,d=(a.rect.height-c)/2,l=this.labelTopOffset-d,m=this.labelTopOffset+d,e.set(g.label,"top",m+"px"),e.set(a.label,"top",l+"px"),g.label._autoPositioned=!0),a.label._autoPositioned=!0)}));if(b[2].handle&&10>b[2].handle.style.top.replace("px","")){var f=b[2].label,p=b[1].label,q=b[0].label,v=f.getBoundingClientRect(),s=p.getBoundingClientRect(),t=q.getBoundingClientRect(),r;f._autoPositioned&&p._autoPositioned&&q._autoPositioned?(v=Number(f.style.top.replace("px",""))+8,s=Number(p.style.top.replace("px",
""))+8,t=Number(q.style.top.replace("px",""))+8,e.set(f,"top",v+"px"),e.set(p,"top",s+"px"),e.set(q,"top",t+"px")):(f._autoPositioned&&(r=Number(f.style.top.replace("px",""))+4,e.set(f,"top",r+"px")),p._autoPositioned&&s.top-v.top<s.height&&(r=Number(p.style.top.replace("px",""))+4,e.set(p,"top",r+"px")),t.top-s.top<t.height&&(r=Number(q.style.top.replace("px",""))+4,e.set(q,"top",r+"px")))}},_autoPositionManyHandles:function(){},collisionCheck:function(a,b){return!(a.right<b.left||a.left>b.right||
a.bottom<b.top||a.top>b.bottom)}}});