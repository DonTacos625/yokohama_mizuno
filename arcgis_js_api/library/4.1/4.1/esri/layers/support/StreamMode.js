// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("../../core/declare dojo/_base/lang dojo/_base/array ../../geometry/SpatialReference ../../geometry/support/jsonUtils ../../tasks/support/Query ../../tasks/QueryTask ./RenderMode".split(" "),function(p,n,k,q,r,s,t,u){return p([u],{declaredClass:"esri.layers.support.StreamMode",constructor:function(a,b){this.featureLayer=a;this._featureMap={};this._setRefreshRate();this._drawBuffer={adds:[],updates:[]};this._timeoutId=null;this._flushDrawBuffer=n.hitch(this,this._flushDrawBuffer);this._featuresByTime=
{};this._lastEndTimeCheck=null;this._maxFeatureAge=0;a.purgeOptions&&(a.purgeOptions.age&&"number"===typeof a.purgeOptions.age)&&(this._maxFeatureAge=1E3*Math.ceil(60*a.purgeOptions.age));this._drawFeatures=n.hitch(this,this._drawFeatures);this._queryErrorHandler=n.hitch(this,this._queryErrorHandler)},startup:function(){},propertyChangeHandler:function(a){this._init&&(0===a?this._applyTimeFilter():3===a?this._redrawAllTracks():console.debug("StreamLayer: Stream Layer only supports changing map time or maximumTrackPoints. Layer id \x3d "+
this.featureLayer.id))},drawFeature:function(a){var b=this.featureLayer,c=b.objectIdField;this._timeoutId||(this._timeoutId=setTimeout(this._flushDrawBuffer,this._refreshRate));b._joinField&&this._getFeature(a.attributes[c])?this._drawBuffer.updates.push({oid:a.attributes[c],updates:a}):this._drawBuffer.adds.push(a)},resume:function(){this.propertyChangeHandler(0)},refresh:function(){var a=this.featureLayer;a&&(!a._relatedUrl&&!a._keepLatestUrl?(a._fireUpdateStart(),a.removeAll(),a._fireUpdateEnd()):
(a._fireUpdateStart(),a._refreshing=!0,a.disconnect(),a.removeAll(),a._relatedQueried=!1,a._keepLatestQueried=!1,a.connect()))},_drawFeatures:function(a){this._purgeRequests();var b=this.featureLayer;b._create(a.features||[]);b._fireUpdateEnd(null,null)},_applyTimeFilter:function(a){this.inherited(arguments);this._redrawAllTracks()},_removeFeatures:function(a){var b=this.featureLayer,c=b.objectIdField;a&&k.forEach(a,function(a){a=a.attributes[c];b._unSelectFeatureIIf(a,this);this._decRefCount(a);
this._removeFeatureIIf(a)},this)},_addFeatures:function(a){var b=this.featureLayer,c=b._endTimeField,f=b._startTimeField,d,h,e,g=[],l=[],m=[];d=b._trackManager;h=b.objectIdField;if(d)for(e in a=d.addFeatures(a),a)a.hasOwnProperty(e)&&(g.push(e),a[e].adds&&(l=l.concat(a[e].adds)),a[e].deletes&&(m=m.concat(a[e].deletes)));else l=a;k.forEach(l,function(a){var b=a.attributes[h],d;d=c&&a.attributes[c];!d&&this._maxFeatureAge&&(d=f&&a.attributes[f]?a.attributes[f]+this._maxFeatureAge:Date.now()+this._maxFeatureAge);
d&&(d=1E3*Math.ceil(d/1E3),this._featuresByTime[d]?this._featuresByTime[d].push(b):this._featuresByTime[d]=[b]);this._addFeatureIIf(b,a);this._incRefCount(b)},this);m.length&&this._removeFeatures(m);d&&d.refreshTracks(g)},_updateFeatures:function(a){var b=this.featureLayer,c,f,d=[];c=b._trackManager;f=b._trackIdField;k.forEach(a,function(a){var e=a.updates;a=this._getFeature(a.oid);var g;if(a){e.geometry&&a.setGeometry(e.geometry);e=e.attributes||{};for(g in e)e.hasOwnProperty(g)&&(a.attributes[g]=
e[g]);a.visible=this._checkFeatureTimeIntersects(a);c&&a.attributes[f]?d.push(a.attributes[f]):b._repaint(a,null,!0)}},this);d.length&&c.refreshTracks(d)},_redrawAllTracks:function(){var a=this.featureLayer._trackManager,b;if(a&&(b=a.trimTracks())&&0<b.length)this._removeFeatures(b),a.refreshTracks()},_flushDrawBuffer:function(){clearTimeout(this._timeoutId);var a=this._drawBuffer,b=a.adds.splice(0,a.adds.length),c=a.updates.splice(0,a.updates.length),a=this.featureLayer;if(!a)return!1;a.updating||
a._fireUpdateStart();this._addFeatures(b);this._updateFeatures(c);if((b=this._getExpiredFeatures())&&b.length)this._removeFeatures(b),a._trackManager&&a._trackManager.removeFeatures(b);a._purge();a._fireUpdateEnd();this._timeoutId=null},_clearDrawBuffer:function(){var a=this._timeoutId,b=this._drawBuffer,c=b.adds,b=b.updates;a&&clearTimeout(a);c.splice(0,c.length);b.splice(0,b.length);this._timeoutId=null},_clearTimeBin:function(){this._featuresByTime={};this._lastEndTimeCheck=1E3*Math.ceil(Date.now()/
1E3)},_clearFeatureMap:function(){this._featureMap={}},_setRefreshRate:function(a){a=a||0===a?a:200;0>a&&(a=200);this._refreshRate=a},_checkFeatureTimeIntersects:function(a){var b=this.featureLayer,c=b.getMap().timeExtent;return!c||!b.timeInfo||!b.timeInfo.startTimeField&&!b.timeInfo.endTimeField?!0:0<b._filterByTime([a],c.startTime,c.endTime).match.length},_getRequestId:function(a){return("_"+a.name+a.layerId+a._ulid).replace(/[^a-zA-Z0-9\_]+/g,"_")},_fetchArchive:function(a){var b=this.featureLayer,
c,f,d,h,e,g;b._fireUpdateStart();if(a&&this.map)a=new t(a),c=new s,f=this.map,d=b.getFilter()||{},h=d.where||"1\x3d1",e=d.geometry?r.fromJSON(d.geometry):null,d=d.outFields?d.outFields.split(","):["*"],c.geometry=e,c.where=h,c.outFields=d,c.returnGeometry=!0,c.outSpatialReference=new q(f.spatialReference.toJSON()),b._usePatch&&(g=this._getRequestId(b),this._cancelPendingRequest(null,g)),a.execute(c,this._drawFeatures,this._queryErrorHandler,g);else return this._fireUpdateEnd({error:"Archive data cannot be fetched if no feature service url is provided or if the layer is not added to a map"}),
!1},_queryErrorHandler:function(a){this._purgeRequests();var b=this.featureLayer;b._errorHandler(a);b._fireUpdateEnd(a)},_getExpiredFeatures:function(){var a,b,c,f=[],d=[];if(!this.featureLayer._endTimeField&&!this._maxFeatureAge)return d;a=1E3*Math.floor(this._lastEndTimeCheck/1E3);this._lastEndTimeCheck=b=1E3*Math.ceil(Date.now()/1E3);if(a&&a!==b)for(c=this._featuresByTime;a<=b;a+=1E3)c[a]&&(f=f.concat(c[a]),delete c[a]);k.forEach(f,function(a){(a=this._getFeature(a))&&d.push(a)},this);return d}})});