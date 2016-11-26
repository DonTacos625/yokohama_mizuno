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

define(["require","exports","./gl-matrix","./Util","dojo/has","./PerformanceTimer"],function(e,t,r,i,n,o){function s(e,t,r){e[0]=Math.min(e[0],t[0]-r),e[1]=Math.min(e[1],t[1]-r),e[2]=Math.min(e[2],t[2]-r)}function a(e,t,r){e[0]=Math.max(e[0],t[0]+r),e[1]=Math.max(e[1],t[1]+r),e[2]=Math.max(e[2],t[2]+r)}function h(e,t,r){return r=r||e,r[0]=e[0]+t,r[1]=e[1]+t,r[2]=e[2]+t,r}function u(e,t){var r=e.indexOf(t);return-1!==r?(e.splice(r,1),t):null}var c=r.vec3d,d=n("dojo-debug-messages"),l=function(){function e(e,t,r){this._maximumObjectsPerNode=10,this._maximumDepth=20,this._autoResize=!0,this._outsiders=[],r&&(void 0!==r.maximumObjectsPerNode&&(this._maximumObjectsPerNode=r.maximumObjectsPerNode),void 0!==r.maximumDepth&&(this._maximumDepth=r.maximumDepth),void 0!==r.autoResize&&(this._autoResize=r.autoResize)),isNaN(e[0])||isNaN(e[1])||isNaN(e[2])||isNaN(t)?this._root=new f(null,c.createFrom(0,0,0),.5):this._root=new f(null,e,t/2)}return Object.defineProperty(e.prototype,"center",{get:function(){return this._root.center},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"size",{get:function(){return 2*this._root.halfSize},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"root",{get:function(){return this._root.node},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"outsiders",{get:function(){return this._outsiders.slice()},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"maximumObjectsPerNode",{get:function(){return this._maximumObjectsPerNode},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"maximumDepth",{get:function(){return this._maximumDepth},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"autoResize",{get:function(){return this._autoResize},enumerable:!0,configurable:!0}),e.prototype.add=function(e){var t=this._objectOrObjectsArray(e);this._grow(t);for(var r=f.acquire(),i=0;i<t.length;i++){var n=t[i];r.init(this._root),0===n.getBSRadius()||isNaN(n.getBSRadius())||!this._autoResize&&!this._fitsInsideTree(this._boundingSphereFromObject(n,b))?this._outsiders.push(n):this._add(n,r)}f.release(r)},e.prototype.remove=function(e,t){for(var r=this._objectOrObjectsArray(e),i=f.acquire(),n=!0,o=0;o<r.length;o++){var s=r[o],a=this._boundingSphereFromObject(t||s,b);0===a.radius||isNaN(a.radius)||!this._autoResize&&!this._fitsInsideTree(a)?n=null!=u(this._outsiders,s):(i.init(this._root),n=this._remove(s,a,i))}return f.release(i),this._shrink(),n},e.prototype.update=function(e,t){this.remove(e,t),this.add(e)},e.prototype.forEachAlongRay=function(e,t,r){this._forEachTest(function(r){return h(r.center,2*-r.halfSize,v),h(r.center,2*r.halfSize,g),i.rayBoxTest(e,t,v,g)},r)},e.prototype.forEachInBoundingBox=function(e,t,r){this._forEachTest(function(r){for(var i=2*r.halfSize,n=0;3>n;n++)if(r.center[n]+i<e[n]||r.center[n]-i>t[n])return!1;return!0},r)},e.prototype.forEachNode=function(e){this._forEachNode(this._root,function(t){return e(t.node,t.center,2*t.halfSize)})},e.prototype._forEachTest=function(e,t){this._outsiders.forEach(t),this._forEachNode(this._root,function(r){if(e(r)){var i=r.node;return i.terminals.forEach(t),null!==i.residents&&i.residents.forEach(t),!0}return!1})},e.prototype._forEachNode=function(e,t){for(var r=f.acquire().init(e),i=[r];0!==i.length;){if(r=i.pop(),t(r)&&!r.isLeaf())for(var n=0;n<r.node.children.length;n++){var o=r.node.children[n];o&&i.push(f.acquire().init(r).advance(n))}f.release(r)}},e.prototype._objectOrObjectsArray=function(e){return Array.isArray(e)||(m[0]=e,e=m),e},e.prototype._remove=function(e,t,r){y.length=0;var i,n,o=r.advanceTo(t,function(e,t){y.push(e.node,t)});if(o?(i=null!=u(r.node.terminals,e),n=0===r.node.terminals.length):(i=null!=u(r.node.residents,e),n=0===r.node.residents.length),n)for(var s=y.length-2;s>=0;s-=2){var a=y[s],h=y[s+1];if(!this._purge(a,h))break}return i},e.prototype._nodeIsEmpty=function(e){if(0!==e.terminals.length)return!1;if(null!==e.residents)return 0===e.residents.length;for(var t=0;t<e.children.length;t++)if(e.children[t])return!1;return!0},e.prototype._purge=function(e,t){return t>=0&&(e.children[t]=null),this._nodeIsEmpty(e)?(null===e.residents&&(e.residents=[]),!0):!1},e.prototype._add=function(e,t){var r=t.advanceTo(this._boundingSphereFromObject(e,b));r?t.node.terminals.push(e):(t.node.residents.push(e),t.node.residents.length>this._maximumObjectsPerNode&&t.depth<this._maximumDepth&&this._split(t))},e.prototype._split=function(e){var t=e.node.residents;e.node.residents=null;for(var r=0;r<t.length;r++){var i=f.acquire().init(e);this._add(t[r],i),f.release(i)}},e.prototype._grow=function(e){if(0!==e.length&&this._autoResize){var t=this._boundingSphereFromObjects(e,this._boundingSphereFromObject,x);if(!isNaN(t.radius)&&0!==t.radius&&!this._fitsInsideTree(t)){var r,i;if(d&&(r=new o(1),r.start()),this._nodeIsEmpty(this._root.node))c.set(t.center,this._root.center),this._root.halfSize=1.25*t.radius,i="grow-empty";else{var n=f.acquire();this._rootBoundsForRootAsSubNode(t,n),this._placingRootViolatesMaxDepth(n)?(this._rebuildTree(t,n),i="rebuild"):(this._growRootAsSubNode(n),i="sub-node"),f.release(n)}if(d){var s=r.stop();console.info("Octree grown in "+Math.round(s)+" ms (strategy: "+i+")")}}}},e.prototype._rebuildTree=function(e,t){var r=this;c.set(t.center,S.center),S.radius=t.halfSize;var i=this._boundingSphereFromObjects([e,S],function(e){return e},N),n=f.acquire().init(this._root);this._root.initFrom(null,i.center,1.25*i.radius),this._forEachNode(n,function(e){return r.add(e.node.terminals),null!==e.node.residents&&r.add(e.node.residents),!0}),f.release(n)},e.prototype._placingRootViolatesMaxDepth=function(e){var t=0;this._forEachNode(this._root,function(e){return t=Math.max(t,e.depth),!0});var r=t+Math.log(e.halfSize/this._root.halfSize)*Math.LOG2E;return r>this._maximumDepth},e.prototype._rootBoundsForRootAsSubNode=function(e,t){for(var r=e.radius,i=e.center,n=-(1/0),o=this._root.center,s=this._root.halfSize,a=0;3>a;a++){var h=o[a]-s-(i[a]-r),u=i[a]+r-(o[a]+s),c=Math.max(0,Math.ceil(h/(2*s))),d=Math.max(0,Math.ceil(u/(2*s)))+1,l=Math.pow(2,Math.ceil(Math.log(c+d)*Math.LOG2E));n=Math.max(n,l),O[a].min=c,O[a].max=d}for(var a=0;3>a;a++){var c=O[a].min,d=O[a].max,f=(n-(c+d))/2;c+=Math.ceil(f),d+=Math.floor(f);var p=o[a]-s-c*s*2;_[a]=p+(d+c)*s}return t.initFrom(null,_,n*s,0)},e.prototype._growRootAsSubNode=function(e){var t=this._root.node;c.set(this._root.center,x.center),x.radius=this._root.halfSize,this._root.init(e),e.advanceTo(x,null,!0),e.node.children=t.children,e.node.residents=t.residents,e.node.terminals=t.terminals},e.prototype._shrink=function(){if(this._autoResize)for(;;){var e=this._findShrinkIndex();if(-1===e)break;this._root.advance(e),this._root.depth=0}},e.prototype._findShrinkIndex=function(){if(0!==this._root.node.terminals.length||this._root.isLeaf())return-1;for(var e=null,t=this._root.node.children,r=0,i=0;i<t.length&&null==e;)r=i++,e=t[r];for(;i<t.length;)if(t[i++])return-1;return r},e.prototype._fitsInsideTree=function(e){var t=this._root.center,r=this._root.halfSize,i=e.center,n=e.radius;return r>=n&&i[0]>=t[0]-r&&i[0]<=t[0]+r&&i[1]>=t[1]-r&&i[1]<=t[1]+r&&i[2]>=t[2]-r&&i[2]<=t[2]+r},e.prototype._boundingSphereFromObject=function(e,t){return c.set(e.getCenter(),t.center),t.radius=e.getBSRadius(),t},e.prototype._boundingSphereFromObjects=function(e,t,r){if(1===e.length){var i=t(e[0],x);c.set(i.center,r.center),r.radius=i.radius}else{v[0]=1/0,v[1]=1/0,v[2]=1/0,g[0]=-(1/0),g[1]=-(1/0),g[2]=-(1/0);for(var n=0;n<e.length;n++){var i=t(e[n],x);s(v,i.center,i.radius),a(g,i.center,i.radius)}c.scale(c.add(v,g,r.center),.5),r.radius=Math.max(g[0]-v[0],g[1]-v[1],g[2]-v[2])/2}return r},e}(),f=function(){function e(e,t,r,i){void 0===r&&(r=0),void 0===i&&(i=0),this.center=c.create(),this.initFrom(e,t,r,0)}return e.prototype.init=function(e){return this.initFrom(e.node,e.center,e.halfSize,e.depth)},e.prototype.initFrom=function(t,r,i,n){return void 0===t&&(t=null),void 0===i&&(i=this.halfSize),void 0===n&&(n=this.depth),this.node=t||e.createEmptyNode(),r&&c.set(r,this.center),this.halfSize=i,this.depth=n,this},e.prototype.advance=function(t){var r=this.node.children[t];r||(r=e.createEmptyNode(),this.node.children[t]=r),this.node=r,this.halfSize/=2,this.depth++;var i=p[t];return this.center[0]+=i[0]*this.halfSize,this.center[1]+=i[1]*this.halfSize,this.center[2]+=i[2]*this.halfSize,this},e.prototype.advanceTo=function(e,t,r){for(void 0===r&&(r=!1);;){if(this.isTerminalFor(e))return t&&t(this,-1),!0;if(this.isLeaf()&&!r)return t&&t(this,-1),!1;this.isLeaf()&&(this.node.residents=null);var i=this._childIndex(e);t&&t(this,i),this.advance(i)}},e.prototype.isLeaf=function(){return null!=this.node.residents},e.prototype.isTerminalFor=function(e){return e.radius>this.halfSize/2},e.prototype._childIndex=function(e){for(var t=e.center,r=this.center,i=0,n=0;3>n;n++)r[n]<t[n]&&(i|=1<<n);return i},e.createEmptyNode=function(){return{children:[null,null,null,null,null,null,null,null],terminals:new Array,residents:new Array}},e.acquire=function(){if(0===this._pool.length)return new e;var t=this._pool[this._pool.length-1];return this._pool.length--,t},e.release=function(e){this._pool.push(e)},e._pool=[],e}(),p=[[-1,-1,-1],[1,-1,-1],[-1,1,-1],[1,1,-1],[-1,-1,1],[1,-1,1],[-1,1,1],[1,1,1]],m=[null],_=c.create(),v=c.create(),g=c.create(),y=[],b={center:c.create(),radius:0},x={center:c.create(),radius:0},S={center:c.create(),radius:0},N={center:c.create(),radius:0},O=[{min:0,max:0},{min:0,max:0},{min:0,max:0}];return l});