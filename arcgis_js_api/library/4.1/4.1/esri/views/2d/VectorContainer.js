// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["../../core/declare","dojo/_base/array","./engine/DisplayObject"],function(d,c,e){return d(e,{constructor:function(a){this.children=[]},type:"vector-container",addChild:function(a){return this.addChildAt(a,this.children.length)},addChildAt:function(a,b){if(this.contains(a))return a;b=Math.min(this.get("numChildren"),b);this.children.splice(b,0,a);a.set({parent:this,view:this.view});this.requestDraw();return a},removeChild:function(a){if(!this.children)return a;var b=c.indexOf(this.children,
a);-1<b&&(a=this.children.splice(b,1)[0],a.set({parent:null,view:null}),this.requestDraw());return a},contains:function(a){return-1<this.getChildIndex(a)},getChildIndex:function(a){return c.indexOf(this.children,a)},destroy:function(){},requestVectorUpdate:function(a){this.requestUpdate()},requestVectorDraw:function(a){this.requestDraw()}})});