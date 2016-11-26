// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("require exports ../core/tsSupport/extendsHelper ../core/tsSupport/decorateHelper ../core/typescript dojo/json dojo/Deferred ../renderers/support/jsonUtils ./core/messageHandler ./core/MessageReceiver ./core/errorMessages ../layers/support/Field ../tasks/support/FeatureSet".split(" "),function(t,u,m,h,k,n,f,p,d,q,g,r,s){return function(l){function c(a){l.call(this);this.geometryType=this.types=this.fields=this.typeIdFieldName=this.displayFieldName=this.objectIdFieldName=this.mapWidgetId=this.name=
this.id=null;this.isBroken=this.supportsSelection=!1;this.advancedQueryCapabilities=this._renderer=this._popupInfo=null}m(c,l);c.prototype.dojoConstructor=function(a){this.fields||(this.fields=[]);for(a=0;a<this.fields.length;a++){var b=this.fields[a];"string"===typeof b&&(b=n.parse(b));this.fields[a]=new r(b)}};c.prototype._findField=function(a){if(!a||!Array.isArray(this.fields))return null;for(var b=0;b<this.fields.length;b++)if(this.fields[b].name===a)return this.fields[b];return null};c.prototype._findType=
function(a){if(!a||!Array.isArray(this.types))return null;for(var b=0;b<this.types.length;b++)if(this.types[b].id===a)return this.types[b];return null};c.prototype._getCodedValueFromCodedDomain=function(a,b){if(!b||"codedValue"!==b.type)return null;for(var c=0;c<b.codedValues.length;c++)if(b.codedValues[c].code===a)return b.codedValues[c];return null};c.prototype.executeQuery=function(a){var b=this;return d._sendMessageWithReply({functionName:"executeQuery",args:{dataSourceId:this.id,query:a}}).then(function(a){b.isBroken=
!1;return new s(a.featureSet)}).otherwise(function(a){b.isBroken=!0;throw a;})};c.prototype.getAssociatedSelectionDataSourceId=function(){return d._sendMessageWithReply({functionName:"getAssociatedSelectionDataSource",args:{dataSourceId:this.id}}).then(function(a){return a.dataSourceId})};c.prototype.selectFeaturesByObjectIds=function(a){if(!Array.isArray(a))throw Error(g.invalidObjectIdArray);if(!this.supportsSelection)throw Error(g.selectionNotSupported);d._sendMessage({functionName:"selectFeaturesByIds",
args:{dataSourceId:this.id,objectIds:a}})};c.prototype.selectFeatures=function(a){if(!this.supportsSelection)throw Error(g.selectionNotSupported);d._sendMessage({functionName:"selectFeatures",args:{dataSourceId:this.id,geometry:a}})};c.prototype.clearSelection=function(){this.supportsSelection&&d._sendMessage({functionName:"clearSelection",args:{dataSourceId:this.id}})};c.prototype.getPopupInfo=function(){var a=this;return this._popupInfo?(new f).resolve(this._popupInfo):d._sendMessageWithReply({functionName:"getPopupInfo",
args:{dataSourceId:this.id}}).then(function(b){a._popupInfo=b.popupInfo;return a._popupInfo})};c.prototype.getRenderer=function(){var a=this;return this._renderer?(new f).resolve(this._renderer):d._sendMessageWithReply({functionName:"getRenderer",args:{dataSourceId:this.id}}).then(function(b){if(!b.renderer)return null;a._renderer=p.fromJSON(b.renderer);return a._renderer})};c.prototype.getAdvancedQueryCapabilities=function(){var a=this;return this.advancedQueryCapabilities?(new f).resolve(this.advancedQueryCapabilities):
d.isNative?d._sendMessageWithReply({functionName:"getAdvancedQueryCapabilities",args:{dataSourceId:this.id}}).then(function(b){if(!b.advancedQueryCapabilities)return null;a.advancedQueryCapabilities=b.advancedQueryCapabilities;return a.advancedQueryCapabilities}):(new f).resolve(null)};c.prototype.getTypeFromFeature=function(a){return!this.typeIdFieldName?null:this._findType(a.attributes[this.typeIdFieldName])};c.prototype.getValueFromFeature=function(a,b){var c=this._findField(b);if(!b||!c)return null;
var d=a.attributes[b];if(!d&&(d=a.attributes[b.toUpperCase()],!d))return null;if(this.typeIdFieldName===b){var e=this._findType(d);if(e)return e.name}if((e=this.getTypeFromFeature(a))&&Array.isArray(e.domains))if(e=this._getCodedValueFromCodedDomain(d,e.domains[b]))return e.name;return(e=this._getCodedValueFromCodedDomain(d,c.domain))?e.name:d};h([k.shared("esri.opsdashboard.DataSourceProxy")],c.prototype,"declaredClass",void 0);return c=h([k.subclass()],c)}(q)});