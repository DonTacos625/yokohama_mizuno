// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("../../core/Accessor ../../core/HandleRegistry ../../core/watchUtils ./Component dojo/_base/lang dojo/dom-class dojo/dom-construct dojo/dom-style".split(" "),function(q,r,m,g,h,k,e,l){var s={left:0,top:0,bottom:0,right:0},n={bottom:30,top:15,right:15,left:15};return q.createSubclass({properties:{container:{},height:{readOnly:!0,dependsOn:["view.height"]},padding:{},view:{},width:{readOnly:!0,dependsOn:["view.width"]}},declaredClass:"esri.views.ui.UI",constructor:function(){this._components=
[];this._handles=new r;this._initContainers()},getDefaults:function(){return h.mixin(this.inherited(arguments),{padding:n})},initialize:function(){this._handles.add(m.init(this,"view.padding, container",this._applyViewPadding.bind(this)),m.init(this,"padding",this._applyUIPadding.bind(this)))},destroy:function(){this.container=null;this._components.forEach(function(a){a.destroy()});this._components.length=0;this._handles.destroy()},_cornerNameToContainerLookup:null,_positionNameToContainerLookup:null,
_components:null,_handles:null,container:null,_containerSetter:function(a){var b=this._get("container");a!==b&&(a&&(k.add(a,"esri-ui"),this._attachContainers(a)),b&&(k.remove(b,"esri-ui"),l.set(b,{top:"",bottom:"",left:"",right:""}),e.empty(b)),this._set("container",a))},_heightGetter:function(){var a=this.get("view.height")||0;if(0===a)return a;var b=this._getViewPadding();return Math.max(a-(b.top+b.bottom),0)},_paddingSetter:function(a){"number"===typeof a?this._set("padding",{bottom:a,top:a,right:a,
left:a}):this._set("padding",h.mixin({},n,a))},view:null,_widthGetter:function(){var a=this.get("view.width")||0;if(0===a)return a;var b=this._getViewPadding();return Math.max(a-(b.left+b.right),0)},add:function(a,b){var c;if(Array.isArray(a))a.forEach(function(a){this.add(a,b)},this);else if(b&&"object"===typeof b&&(c=b.index,b=b.position),a&&(!b||this._isValidPosition(b))){if(!a.isInstanceOf||!a.isInstanceOf(g))a=new g({node:a});this._place({component:a,position:b,index:c});this._components.push(a)}},
remove:function(a){if(a){if(Array.isArray(a))return a.map(this.remove,this);if(a=this.find(a)){var b=this._components.indexOf(a);a.node.parentNode&&a.node.parentNode.removeChild(a.node);return this._components.splice(b,1)[0]}}},empty:function(a){if(Array.isArray(a))return a.map(function(a){return this.empty(a).reduce(function(a,b){return a.concat(b)})},this);a=a||"manual";if("manual"===a)return Array.prototype.slice.call(this._manualContainer.children).filter(function(a){return!k.contains(a,"esri-ui-corner")},
this).map(this.remove,this);if(this._isValidPosition(a))return Array.prototype.slice.call(this._cornerNameToContainerLookup[a].children).map(this.remove,this)},move:function(a,b){if(!b||this._isValidPosition(b)){var c=this.remove(a);c&&this.add(c,b)}},find:function(a){return!a?null:a.isInstanceOf&&a.isInstanceOf(g)?this._findByComponent(a):"string"===typeof a?this._findById(a):this._findByNode(a.domNode||a)},_getViewPadding:function(){return this.get("view.padding")||s},_attachContainers:function(a){e.place(this._innerContainer,
a);e.place(this._manualContainer,a)},_initContainers:function(){var a=e.create("div",{className:"esri-ui-inner-container esri-ui-corner-container"}),b=e.create("div",{className:"esri-ui-inner-container esri-ui-manual-container"}),c,d,p,f;c=e.create("div",{className:"esri-ui-top-left esri-ui-corner"},a);d=e.create("div",{className:"esri-ui-top-right esri-ui-corner"},a);p=e.create("div",{className:"esri-ui-bottom-left esri-ui-corner"},a);f=e.create("div",{className:"esri-ui-bottom-right esri-ui-corner"},
a);this._innerContainer=a;this._manualContainer=b;this._cornerNameToContainerLookup={"top-left":c,"top-right":d,"bottom-left":p,"bottom-right":f};this._positionNameToContainerLookup=h.mixin({manual:b},this._cornerNameToContainerLookup)},_isValidPosition:function(a){return!!this._positionNameToContainerLookup[a]},_place:function(a){var b=a.component,c=a.position||"manual";a=a.index;var d=this._positionNameToContainerLookup[c],c="bottom-right"===c,e,f;-1<a?(e=d.children,0===a?this._placeComponent(b,
d,c?"last":"first"):(f=a>=e.length)?this._placeComponent(b,d,c?"first":"last"):(a=c?e.length-1-a:a,a=e[a],this._placeComponent(b,a,c?"after":"before"))):this._placeComponent(b,d,c?"first":"last")},_placeComponent:function(a,b,c){a.widget?(a.widget.placeAt(b,c),a.widget.startup()):e.place(a.node,b,c)},_applyViewPadding:function(){var a=this.container;a&&l.set(a,this._toPxPosition(this._getViewPadding()))},_applyUIPadding:function(){this._innerContainer&&l.set(this._innerContainer,this._toPxPosition(this.padding))},
_toPxPosition:function(a){return{top:this._toPxUnit(a.top),left:this._toPxUnit(a.left),right:this._toPxUnit(a.right),bottom:this._toPxUnit(a.bottom)}},_toPxUnit:function(a){return 0===a?0:a+"px"},_findByComponent:function(a){var b=null,c;this._components.some(function(d){(c=d===a)&&(b=d);return c});return b},_findById:function(a){var b=null,c;this._components.some(function(d){(c=d.id===a)&&(b=d);return c});return b},_findByNode:function(a){var b=null,c;this._components.some(function(d){(c=d.node===
a)&&(b=d);return c});return b}})});