//>>built
define("dojo/_base/declare dojo/dom-style dojo/_base/kernel dojo/_base/lang dojo/on ../_Plugin ../../form/ToggleButton".split(" "),function(c,h,k,f,l,a,g){var b=c("dijit._editor.plugins.ToggleDir",a,{useDefaultCommand:!1,command:"toggleDir",buttonClass:g,_initButton:function(){function a(e){b.set("checked",e&&e!==c,!1)}this.inherited(arguments);var b=this.button,d=this.editor.isLeftToRight();this.own(this.button.on("change",f.hitch(this,function(a){this.editor.set("textDir",d^a?"ltr":"rtl")})));var c=
d?"ltr":"rtl";a(this.editor.get("textDir"));this.editor.watch("textDir",function(b,c,d){a(d)})},updateState:function(){this.button.set("disabled",this.get("disabled"))}});a.registry.toggleDir=function(){return new b({command:"toggleDir"})};return b});