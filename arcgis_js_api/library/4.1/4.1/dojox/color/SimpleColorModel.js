//>>built
define(["dojo/_base/array","dojo/_base/declare","dojox/color"],function(g,d,e){return d("dojox.color.SimpleColorModel",null,{_startColor:null,_endColor:null,constructor:function(b,c){if(void 0!=c)this._startColor=b,this._endColor=c;else{var a=b.toHsl();a.s=100;a.l=85;this._startColor=e.fromHsl(a.h,a.s,a.l);this._startColor.a=b.a;a.l=15;this._endColor=e.fromHsl(a.h,a.s,a.l);this._endColor.a=b.a}},_getInterpoledValue:function(b,c,a){return b+(c-b)*a},getNormalizedValue:function(b){},getColor:function(b){var c=
this.getNormalizedValue(b),a=this._startColor.toHsl(),f=this._endColor.toHsl();b=this._getInterpoledValue(a.h,f.h,c);var d=this._getInterpoledValue(a.s,f.s,c),a=this._getInterpoledValue(a.l,f.l,c),c=this._getInterpoledValue(this._startColor.a,this._endColor.a,c);b=e.fromHsl(b,d,a);b.a=c;return b}})});