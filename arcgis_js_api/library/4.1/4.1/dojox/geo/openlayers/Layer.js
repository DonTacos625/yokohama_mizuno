//>>built
define(["dojo/_base/declare","dojo/_base/lang","dojo/_base/array","dojo/_base/sniff","./Feature"],function(f,d,e,g,h){return f("dojox.geo.openlayers.Layer",null,{constructor:function(a,b){var c=b?b.olLayer:null;c||(c=d.delegate(new OpenLayers.Layer(a,b)));this.olLayer=c;this._features=null;this.olLayer.events.register("moveend",this,d.hitch(this,this.moveTo))},renderFeature:function(a){a.render()},getDojoMap:function(){return this.dojoMap},addFeature:function(a){d.isArray(a)?e.forEach(a,function(a){this.addFeature(a)},
this):(null==this._features&&(this._features=[]),this._features.push(a),a._setLayer(this))},removeFeature:function(a){var b=this._features;if(null!=b)if(a instanceof Array)a=a.slice(0),e.forEach(a,function(a){this.removeFeature(a)},this);else{var c=e.indexOf(b,a);-1!=c&&b.splice(c,1);a._setLayer(null);a.remove()}},removeFeatureAt:function(a){var b=this._features,c=b[a];c&&(b.splice(a,1),c._setLayer(null),c.remove())},getFeatures:function(){return this._features},getFeatureAt:function(a){return null==
this._features?void 0:this._features[a]},getFeatureCount:function(){return null==this._features?0:this._features.length},clear:function(){var a=this.getFeatures();this.removeFeature(a)},moveTo:function(a){a.zoomChanged&&null!=this._features&&e.forEach(this._features,function(a){this.renderFeature(a)},this)},redraw:function(){g.isIE?setTimeout(d.hitch(this,function(){this.olLayer.redraw()},0)):this.olLayer.redraw()},added:function(){}})});