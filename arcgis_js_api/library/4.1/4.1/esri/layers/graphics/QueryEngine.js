// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("dojo/_base/declare dojo/_base/lang dojo/Deferred ../../core/promiseUtils ../../core/Error ../../geometry/support/graphicsUtils".split(" "),function(f,g,h,e,k,l){return f(null,{constructor:function(a){g.mixin(this,a)},features:null,objectIdField:null,queryFeatures:function(a){if(this.features)if(a)if(this._isSupportedQuery(a)){var b=this._createFilters(a);a=b.length?this._executeQuery(a,b):this._rejectQuery("Invalid query")}else a=this._rejectQuery("Unsupported query");else a=this._returnAllFeatures();
else a=this._rejectQuery("Engine not initialized");return a},queryObjectIds:function(a){return this.objectIdField?this.queryFeatures(a).then(this._getObjectIds.bind(this)):this._rejectQuery("Unsupported query")},queryFeatureCount:function(a){return this.queryFeatures(a).then(function(a){return a.length}.bind(this))},queryExtent:function(a){return this.queryFeatures(a).then(function(a){return{count:a.length,extent:this._getExtent(a)}}.bind(this))},_returnAllFeatures:function(){return e.resolve(this.features.toArray())},
_executeQuery:function(a,b){var c=new h,d;d=this.features.filter(function(c){return b.every(function(b){return b.call(this,c,a)},this)},this);c.resolve(d.toArray());return c.promise},_isSupportedQuery:function(a){return null!=a.distance||null!=a.geometryPrecision||a.groupByFieldsForStatistics&&a.groupByFieldsForStatistics.length||null!=a.maxAllowableOffset||a.multipatchOption||null!=a.num||a.orderByFields&&a.orderByFields.length||a.outFields&&a.outFields.length||a.outSpatialReference||a.outStatistics&&
a.outStatistics.length||a.pixelSize||a.quantizationParameters||a.relationParam||a.returnDistinctValues||null!=a.start||a.text||a.timeExtent||a.where||a.objectIds&&a.objectIds.length&&!this.objectIdField?!1:!0},_createFilters:function(a){var b=[];a.objectIds&&a.objectIds.length&&b.push(this._createObjectIdFilter());a.geometry&&("extent"===a.geometry.type&&"intersects"===a.spatialRelationship)&&b.push(this._createExtentFilter());return b},_createExtentFilter:function(){return function(a,b){var c=a.geometry,
d=b.geometry;return c&&d.intersects(c)}},_createObjectIdFilter:function(){return function(a,b){var c=a.attributes;return-1<b.objectIds.indexOf(c&&c[this.objectIdField])}},_rejectQuery:function(a){return e.reject(new k("QueryEngine",a))},_getObjectIds:function(a){var b=this.objectIdField,c=[];a.forEach(function(a){a=(a=a.attributes)&&a[b];null!=a&&c.push(a)});return c},_getExtent:function(a){return a.length?l.graphicsExtent(a):null}})});