// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("require dojo/_base/lang dojo/Deferred ../request ../renderers/support/jsonUtils ./QueryTask ./Task ./support/StatisticDefinition ./support/Query".split(" "),function(h,e,k,l,m,n,p,g,q){return p.createSubclass({declaredClass:"esri.tasks.GenerateRendererTask",constructor:function(){this._handler=e.hitch(this,this._handler);this._handleExecuteResponse=this._handleExecuteResponse.bind(this)},normalizeCtorArgs:function(a,d){if(e.isObject(a)&&("esri.layers.FeatureLayer"===a.declaredClass||"esri.layers.CSVLayer"===
a.declaredClass)){var b=a,c=e.mixin({featureLayer:b},d);"string"===typeof b.url&&"esri.layers.CSVLayer"!==b.declaredClass&&(c.url=b.url);return c}return this.inherited(arguments)},properties:{checkValueRange:{value:null},gdbVersion:{value:null,type:String},source:{value:null},parsedUrl:{get:function(){var a=this._parseUrl(this.url);a.path+="/generateRenderer";return a}}},execute:function(a){var d;if(this._features=a.features||this._getCollectionFeatures()){d=new k;var b=this._features;h(["./support/generateRenderer"],
function(c){var f;"esri.tasks.support.ClassBreaksDefinition"===a.classificationDefinition.declaredClass?f=c.createClassBreaksRenderer({features:b,definition:a.classificationDefinition}):"esri.tasks.support.UniqueValueDefinition"===a.classificationDefinition.declaredClass&&(f=c.createUniqueValueRenderer({features:b,definition:a.classificationDefinition}));f?d.resolve(this._handleExecuteResponse(f)):d.reject()});return d.promise}var c=e.mixin(a.toJSON(),{f:"json"});this._field="esri.tasks.support.ClassBreaksDefinition"===
a.classificationDefinition.declaredClass?a.classificationDefinition.classificationField:a.classificationDefinition.attributeField;this.source&&(c.layer=JSON.stringify({source:this.source}));this.gdbVersion&&(c.gdbVersion=this.gdbVersion);return l(this.parsedUrl.path,{query:c,callbackParamName:"callback"}).then(this._handleExecuteResponse)},_handleExecuteResponse:function(a){a=a.data;var d;d="esri.renderer.ClassBreaksRenderer"===a.declaredClass||"esri.renderer.UniqueValueRenderer"===a.declaredClass?
a:m.fromJSON(a);if(!this.checkValueRange)return this._processRenderer(d);a=new n(this.url);var b=new g({statisticType:"min",onStatisticField:this._field}),c=new g({statisticType:"max",onStatisticField:this._field}),b=new q({outStatistics:[b,c]});return a.execute(b).then(e.hitch(this,function(a){a=a.features[0].attributes;for(var b in a)if(0===b.toLowerCase().indexOf("min"))var c=a[b];else var e=a[b];return this._processRenderer(d,c,e)}))},_processRenderer:function(a,d,b){"esri.renderer.ClassBreaksRenderer"===
a.declaredClass?a.classBreakInfos.forEach(function(c,e){0===e&&(void 0!==d&&null!==d)&&(c.minValue=d);e===a.classBreakInfos.length-1&&(void 0!==b&&null!==b)&&(c.maxValue=b)}):a.uniqueValueInfos.forEach(function(c,e){0===e&&(void 0!==d&&null!==d)&&(c.value=d);e===a.uniqueValueInfos.length-1&&(void 0!==b&&null!==b)&&(c.value=b)});return a},_getCollectionFeatures:function(){var a=this.featureLayer;return a&&a.hasMemorySource&&a.graphics}})});