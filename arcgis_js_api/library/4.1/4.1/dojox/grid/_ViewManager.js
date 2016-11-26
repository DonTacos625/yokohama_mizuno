//>>built
define(["dojo/_base/declare","dojo/_base/sniff","dojo/dom-class"],function(n,g,p){return n("dojox.grid._ViewManager",null,{constructor:function(a){this.grid=a},defaultWidth:200,views:[],resize:function(){this.onEach("resize")},render:function(){this.onEach("render")},addView:function(a){a.idx=this.views.length;this.views.push(a)},destroyViews:function(){for(var a=0,b;b=this.views[a];a++)b.destroy();this.views=[]},getContentNodes:function(){for(var a=[],b=0,d;d=this.views[b];b++)a.push(d.contentNode);
return a},forEach:function(a){for(var b=0,d;d=this.views[b];b++)a(d,b)},onEach:function(a,b){b=b||[];for(var d=0,c;c=this.views[d];d++)a in c&&c[a].apply(c,b)},normalizeHeaderNodeHeight:function(){for(var a=[],b=0,d;d=this.views[b];b++)d.headerContentNode.firstChild&&a.push(d.headerContentNode);this.normalizeRowNodeHeights(a)},normalizeRowNodeHeights:function(a){var b=0,d=[];if(this.grid.rowHeight)b=this.grid.rowHeight;else{if(1>=a.length)return;for(var c=0,e;e=a[c];c++)p.contains(e,"dojoxGridNonNormalizedCell")||
(d[c]=e.firstChild.offsetHeight,b=Math.max(b,d[c]));b=0<=b?b:0;(g("mozilla")||8<g("ie"))&&b&&b++}for(c=0;e=a[c];c++)d[c]!=b&&(e.firstChild.style.height=b+"px")},resetHeaderNodeHeight:function(){for(var a=0,b;b=this.views[a];a++)if(b=b.headerContentNode.firstChild)b.style.height=""},renormalizeRow:function(a){for(var b=[],d=0,c,e;(c=this.views[d])&&(e=c.getRowNode(a));d++)e.firstChild.style.height="",b.push(e);this.normalizeRowNodeHeights(b)},getViewWidth:function(a){return this.views[a].getWidth()||
this.defaultWidth},measureHeader:function(){this.resetHeaderNodeHeight();this.forEach(function(a){a.headerContentNode.style.height=""});var a=0;this.forEach(function(b){a=Math.max(b.headerNode.offsetHeight,a)});return a},measureContent:function(){var a=0;this.forEach(function(b){a=Math.max(b.domNode.offsetHeight,a)});return a},findClient:function(a){a=this.grid.elasticView||-1;if(0>a)for(var b=1,d;d=this.views[b];b++)if(d.viewWidth){for(b=1;d=this.views[b];b++)if(!d.viewWidth){a=b;break}break}0>a&&
(a=Math.floor(this.views.length/2));return a},arrange:function(a,b){var d,c,e,f=this.views.length,q=this,l=0>=b?f:this.findClient(),m=function(a,b){var c=a.domNode.style,d=a.headerNode.style;q.grid.isLeftToRight()?(c.left=b+"px",d.left=b+"px"):(c.right=b+"px",4>g("ff")?d.right=b+a.getScrollbarWidth()+"px":d.right=b+"px",!g("webkit")&&"auto"!=d.width&&(d.width=parseInt(d.width,10)-a.getScrollbarWidth()+"px"));c.top="0px";d.top=0};for(d=0;(c=this.views[d])&&d<l;d++)e=this.getViewWidth(d),c.setSize(e,
0),m(c,a),e=c.headerContentNode&&c.headerContentNode.firstChild?c.getColumnsWidth()+c.getScrollbarWidth():c.domNode.offsetWidth,a+=e;d++;for(var h=b,k=f-1;(c=this.views[k])&&d<=k;k--)e=this.getViewWidth(k),c.setSize(e,0),e=c.domNode.offsetWidth,h-=e,m(c,h);l<f&&(c=this.views[l],e=Math.max(1,h-a),c.setSize(e+"px",0),m(c,a));return a},renderRow:function(a,b,d){for(var c=[],e=0,f,g;(f=this.views[e])&&(g=b[e]);e++)f=f.renderRow(a),g.appendChild(f),c.push(f);d||this.normalizeRowNodeHeights(c)},rowRemoved:function(a){this.onEach("rowRemoved",
[a])},updateRow:function(a,b){for(var d=0,c;c=this.views[d];d++)c.updateRow(a);b||this.renormalizeRow(a)},updateRowStyles:function(a){this.onEach("updateRowStyles",[a])},setScrollTop:function(a){for(var b=a,d=0,c;c=this.views[d];d++)b=c.setScrollTop(a),g("ie")&&(c.headerNode&&c.scrollboxNode)&&(c.headerNode.scrollLeft=c.scrollboxNode.scrollLeft);return b},getFirstScrollingView:function(){for(var a=0,b;b=this.views[a];a++)if(b.hasHScrollbar()||b.hasVScrollbar())return b;return null}})});