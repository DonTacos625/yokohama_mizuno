// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["../core/declare","dojo/_base/lang","../core/lang","../core/screenUtils","./LineSymbol"],function(h,e,f,k,l){var g={color:[0,0,0,1],style:"solid",width:0.75},b=h(l,{declaredClass:"esri.symbols.SimpleLineSymbol",properties:{type:"simple-line-symbol",style:{value:"solid",json:{read:function(a,c){return f.valueOf(this._jsonStyles,a)||void 0},write:function(a,c){c.style=this._jsonStyles[a]}}}},_jsonStyles:{solid:"esriSLSSolid",dash:"esriSLSDash",dot:"esriSLSDot","dash-dot":"esriSLSDashDot","long-dash-dot-dot":"esriSLSDashDotDot",
none:"esriSLSNull","inside-frame":"esriSLSInsideFrame","short-dash":"esriSLSShortDash","short-dot":"esriSLSShortDot","short-dash-dot":"esriSLSShortDashDot","short-dash-dot-dot":"esriSLSShortDashDotDot","long-dash":"esriSLSLongDash","long-dash-dot":"esriSLSLongDashDot"},getDefaults:function(){return e.mixin(this.inherited(arguments),g)},normalizeCtorArgs:function(a,c,b){if(a&&"string"!==typeof a)return a;var d={};null!=a&&(d.style=a);null!=c&&(d.color=c);null!=b&&(d.width=k.toPt(b));return d},clone:function(){return new b({color:f.clone(this.color),
style:this.style,width:this.width})}});e.mixin(b,{STYLE_SOLID:"solid",STYLE_DASH:"dash",STYLE_DOT:"dot",STYLE_DASHDOT:"dash-dot",STYLE_DASHDOTDOT:"long-dash-dot-dot",STYLE_NULL:"none",STYLE_SHORTDASH:"short-dash",STYLE_SHORTDOT:"short-dot",STYLE_SHORTDASHDOT:"short-dash-dot",STYLE_SHORTDASHDOTDOT:"short-dash-dot-dot",STYLE_LONGDASH:"long-dash",STYLE_LONGDASHDOT:"long-dash-dot"});b.defaultProps=g;return b});