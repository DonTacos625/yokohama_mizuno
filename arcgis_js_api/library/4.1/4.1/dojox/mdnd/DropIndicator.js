//>>built
define(["dojo/_base/kernel","dojo/_base/declare","dojo/dom-class","dojo/dom-construct","./AreaManager"],function(a,d,e,f,g){a=d("dojox.mdnd.DropIndicator",null,{node:null,constructor:function(){var b=document.createElement("div"),c=document.createElement("div");b.appendChild(c);e.add(b,"dropIndicator");this.node=b},place:function(b,c,a){a&&(this.node.style.height=a.h+"px");try{return c?b.insertBefore(this.node,c):b.appendChild(this.node),this.node}catch(d){return null}},remove:function(){this.node&&
(this.node.style.height="",this.node.parentNode&&this.node.parentNode.removeChild(this.node))},destroy:function(){this.node&&(this.node.parentNode&&this.node.parentNode.removeChild(this.node),f.destroy(this.node),delete this.node)}});g.areaManager()._dropIndicator=new a;return a});