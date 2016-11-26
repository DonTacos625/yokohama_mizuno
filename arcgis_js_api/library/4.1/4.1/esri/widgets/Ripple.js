// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["./Widget","./support/AnchorElementViewModel","dojo/dom-class","dojo/dom-style"],function(e,f,c,d){var b={base:"esri-ripple",visible:"esri-ripple--visible",rippleStart:"esri-ripple--start"};return e.createSubclass({properties:{viewModel:{type:f}},declaredClass:"esri.widgets.Ripple",baseClass:b.base,postCreate:function(){this.inherited(arguments);this.own(this.viewModel.watch("point",function(a){this._setDomClasses(a)}.bind(this)),this.viewModel.watch("screenPoint",function(a){this._positionDomNode(a)}.bind(this)))},
destroy:function(){this._clearTimeout()},_css:b,animationDelay:300,visible:!0,_setVisibleAttr:function(a){this._set("visible",a);this._visibleChange()},_clearTimeout:function(){this._resetTimeout&&clearTimeout(this._resetTimeout)},_setDomClasses:function(a){c.remove(this.domNode,b.rippleStart);this.domNode.offsetWidth=this.domNode.offsetWidth;a&&c.add(this.domNode,b.rippleStart)},_positionDomNode:function(a){a?(d.set(this.domNode,{left:a.x+"px",top:a.y+"px"}),this._setDomClasses(this.point),this._clearTimeout(),
this._resetTimeout=setTimeout(function(){this.viewModel.point=null;this._resetTimeout=0}.bind(this),this.animationDelay)):d.set(this.domNode,{left:"",top:""})},_visibleChange:function(){c.toggle(this.domNode,b.visible,this.visible)}})});