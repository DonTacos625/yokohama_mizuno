// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("dojo/_base/lang dojo/Deferred ./ArcGISService ../support/Field ../support/Raster ../support/PixelBlock ../support/MosaicRule ../support/RasterFunction ../support/DimensionalDefinition ../../geometry/Extent ../../geometry/Point ../../geometry/SpatialReference ../../tasks/QueryTask ../../tasks/ImageServiceIdentifyTask ../../tasks/support/ImageServiceIdentifyParameters ../../request ../../Graphic ../../PopupTemplate ../../core/lang ../../core/Accessor ../../core/kebabDictionary ../../core/promiseUtils".split(" "),
function(l,u,x,v,y,z,r,A,B,p,C,D,E,F,G,q,H,w,g,s,t,I){t=t({S8:"s8",S16:"s16",S32:"s32",U8:"u8",U16:"u16",U32:"u32",F32:"f32",F64:"f64"});s=s.createSubclass({properties:{layer:{},mosaicRule:{get:function(){return this.layer.mosaicRule||null}},version:{value:0,dependsOn:"layer.bandIds layer.format layer.compressionQuality layer.compressionTolerance layer.interpolation layer.noData layer.noDataInterpretation layer.mosaicRule layer.renderingRule layer.adjustAspectRatio".split(" "),get:function(){return this._get("version")+
1}}},toJSON:function(){var a=this.layer;return{bandIds:a.bandIds?a.bandIds.join(","):null,format:a.format,compressionQuality:a.compressionQuality,compressionTolerance:a.compressionTolerance,interpolation:a.interpolation,noData:a.noData,noDataInterpretation:a.noDataInterpretation,mosaicRule:this.mosaicRule?JSON.stringify(this.mosaicRule.toJSON()):null,renderingRule:a.renderingRule?JSON.stringify(a.renderingRule.toJSON()):null,adjustAspectRatio:a.adjustAspectRatio}}});return x.createSubclass({declaredClass:"esri.layers.mixins.ArcGISImageService",
getDefaults:function(){return l.mixin(this.inherited(arguments),{exportImageServiceParameters:{layer:this}})},_raster:null,properties:{adjustAspectRatio:{},bandCount:{},bandIds:{},capabilities:{json:{read:function(a){return a&&a.split(",").map(function(a){return a.trim()})}}},compressionQuality:{},compressionTolerance:0.01,copyright:{json:{readFrom:["copyrightText"],read:function(a,b){return b.copyrightText}}},definitionExpression:{get:function(){return this.mosaicRule?this.mosaicRule.where:null},
set:function(a){var b=this.mosaicRule||new r;b.where=a;this._set("mosaicRule",b)},json:{readFrom:["definitionExpression","layerDefinition.definitionExpression"],read:function(a,b){return a||b.layerDefinition&&b.layerDefinition.definitionExpression||void 0}}},domainFields:{value:null,type:[v],dependsOn:["fields"],get:function(){return this.fields&&this.fields.filter(function(a){return null!=a.domain})||[]}},exportImageServiceParameters:{readOnly:!0,type:s},fields:{type:[v]},fullExtent:{type:p,json:{readFrom:["extent"],
read:function(a,b){return p.fromJSON(b.extent)}}},format:"lerc",hasRasterAttributeTable:{},hasMultidimensions:{},interpolation:{},mosaicRule:{value:null,json:{readFrom:["defaultMosaicMethod"],read:function(a,b){return r.fromJSON(b.mosaicRule||b)}}},multidimensionalInfo:null,noData:{},noDataInterpretation:{},objectIdField:{json:{readFrom:["fields"],read:function(a,b){!a&&b.fields&&b.fields.some(function(b){"esriFieldTypeOID"===b.type&&(a=b.name);return!!a});return a}}},pixelType:{value:null,json:{read:t.fromJSON}},
popupTemplate:{value:null,type:w,json:{readFrom:["popupInfo"],read:function(a,b){return b.popupInfo?w.fromJSON(b.popupInfo):null}}},queryTask:{readOnly:!0,dependsOn:["url"],get:function(){return new E({url:this.url})}},rasterAttributeTable:null,rasterAttributeTableFieldPrefix:"Raster.",rasterFields:{value:null,dependsOn:["fields","rasterAttributeTable","rasterAttributeTableFieldPrefix"],get:function(){var a=this.rasterAttributeTableFieldPrefix,b={name:"Raster.ItemPixelValue",alias:"Item Pixel Value",
domain:null,editable:!1,length:50,type:"string"},d=this.fields?g.clone(this.fields):[],c=d.length;d[c]={name:"Raster.ServicePixelValue",alias:"Service Pixel Value",domain:null,editable:!1,length:50,type:"string"};if(this.capabilities&&-1<this.capabilities.indexOf("Catalog")||this.fields&&0<this.fields.length)d[c+1]=b;if(g.isDefined(this.pixelFilter)&&("esriImageServiceDataTypeVector-UV"===this.serviceDataType||"esriImageServiceDataTypeVector-MagDir"===this.serviceDataType))d[c+2]={name:"Raster.Magnitude",
alias:"Magnitude",domain:null,editable:!1,type:"double"},d[c+3]={name:"Raster.Direction",alias:"Direction",domain:null,editable:!1,type:"double"};if((b=this.rasterAttributeTable&&this.rasterAttributeTable.fields||null)&&0<b.length)b=b.filter(function(a){return"esriFieldTypeOID"!==a.type&&"value"!==a.name.toLowerCase()}).map(function(b){var c=g.clone(b);c.name=a+b.name;return c}),d=d.concat(b);return d}},renderingRule:{json:{readFrom:["rasterFunctionInfos"],read:function(a,b){return A.fromJSON(b.renderingRule||
{rasterFunctionInfos:b.rasterFunctionInfos})}}},serviceDataType:{},spatialReference:{value:null,readOnly:!0,json:{readFrom:["extent"],read:function(a,b){return(a=b.extent&&b.extent.spatialReference)&&D.fromJSON(a)}}},url:{},version:{value:null,readOnly:!0,json:{readFrom:["currentVersion","fields","timeInfo"],read:function(a,b){(a=b.currentVersion)||(a=b.hasOwnProperty("fields")||b.hasOwnProperty("objectIdField")||b.hasOwnProperty("timeInfo")?10:9.3);return a}}}},fetchKeyProperties:function(){return q(this.parsedUrl.path+
"/keyProperties",{query:l.mixin({f:"json"}),responseType:"json",callbackParamName:"callback"}).then(function(a){return a.data})},getExportImageServiceParameters:function(a){var b=a.extent.clone().shiftCentralMeridian(),d=a.width;a=a.height;var c=b&&b.spatialReference,c=c&&(c.wkid||JSON.stringify(c.toJSON()));return l.mixin({bbox:b&&b.xmin+","+b.ymin+","+b.xmax+","+b.ymax,bboxSR:c,imageSR:c,size:d+","+a},this.exportImageServiceParameters.toJSON())},queryRasters:function(a){return this.queryTask.execute(a)},
queryVisibleRasters:function(a,b){this._visibleRasters=[];var d=!1,c=this.popupTemplate;c&&(c.fieldInfos&&0<c.fieldInfos.length)&&(d=1<c.fieldInfos.length||"raster.servicepixelvalue"!==c.fieldInfos[0].toLowerCase());!d&&this.rasterFields&&(d=this.rasterFields.some(function(a){return(a=a&&a.name?a.name.toLowerCase():null)&&"raster.servicepixelvalue"!==a&&(c.title&&-1<c.title.toLowerCase().indexOf(a)||c.content&&-1<c.content.toLowerCase().indexOf(a))}));var f=b.layerView,e=(f=f&&f.view&&f.view.state||
null)&&0.5*f.resolution,d=new G({geometry:a.geometry,returnCatalogItems:d,timeExtent:a.timeExtent,mosaicRule:this.mosaicRule||null,renderingRule:this.renderingRule||null,returnGeometry:f&&f.spatialReference.equals(this.spatialReference),outSpatialReference:f&&f.spatialReference.clone(),pixelSize:e&&new C(e,e,f.spatialReference)}),m=new u;(new F({url:this.url})).execute(d).then(function(a){m.resolve(this._processVisibleRastersResponse(a,b))}.bind(this),function(a){throw Error("Error querying for visible rasters");
});return m},_isScientificData:function(){return"esriImageServiceDataTypeVector-UV"===this.serviceDataType||"esriImageServiceDataTypeVector-MagDir"===this.serviceDataType||"esriImageServiceDataTypeScientific"===this.serviceDataType},_fetchService:function(){return I.resolve().then(function(){return this.resourceInfo||q(this.parsedUrl.path,{query:l.mixin({f:"json"},this.parsedUrl.query),responseType:"json",callbackParamName:"callback"})}.bind(this)).then(function(a){a.ssl&&(this.url=this.url.replace(/^http:/i,
"https:"));this.read(a.data,{origin:"service",url:this.parsedUrl});this._raster=new y({url:this.url})}.bind(this)).then(function(){if(10<this.version&&this.hasRasterAttributeTable)return q(this.parsedUrl.path+"/rasterAttributeTable",{query:{f:"json"},responseType:"json"}).then(function(a){(a=a.data)&&(a.features&&a.fields)&&this.read({rasterAttributeTable:a},{origin:"service",url:this.parsedUrl})}.bind(this))}.bind(this)).then(function(){if(10.3<=this.version&&this._isScientificData()&&this.hasMultidimensions)return q(this.parsedUrl.path+
"/multiDimensionalInfo",{query:{f:"json"},responseType:"json"}).then(function(a){if((a=a.data)&&a.multidimensionalInfo)this._updateMultidimensionalDefinition(a.multidimensionalInfo),this.multidimensionalInfo=a.multidimensionalInfo}.bind(this))}.bind(this))},_updateMultidimensionalDefinition:function(a){var b=a.variables[0].dimensions,d;a=[];for(d in b)if(b.hasOwnProperty(d)){var c=b[d],f=!0,e=c.extent,m=[e[0]];c.hasRanges&&!0===c.hasRanges?(f=!1,m=[c.values[0]]):"stdz"===c.name.toLowerCase()&&Math.abs(e[1])<=
Math.abs(e[0])&&(m=[e[1]]);a.push(new B({variableName:"",dimensionName:b[d].name,isSlice:f,values:m}))}if(0<a.length&&(this.mosaicRule=this.mosaicRule||new r,d=this.mosaicRule.multidimensionalDefinition,!d||d&&0>=d.length))this.mosaicRule.multidimensionalDefinition=a},_fetchImage:function(a){if(!g.isDefined(this._raster)||!g.isDefined(a.extent)||!g.isDefined(a.width)||!g.isDefined(a.height))return a=new u,a.reject(Error("Insufficient parameters for requesting an image. A valid extent, width and height values are required.")),
a.promise;a={imageServiceParameters:this.getExportImageServiceParameters(a),nBands:Math.min(this.bandCount,3),pixelType:this.pixelType};return this._raster.read(a)},_applyFilter:function(a){a=this._clonePixelData(a);this.pixelFilter&&this.pixelFilter(a);return a},_clonePixelData:function(a){if(null===a||void 0===a)return a;var b={};a.extent&&(b.extent=a.extent.clone());a=a.pixelBlock;if(null===a||void 0===a)return b;b.pixelBlock=a.clone();return b},_processVisibleRastersResponse:function(a,b){var d=
a.value,c,f,e=0,m;m=this.objectIdField;var h,n=a.catalogItems&&a.catalogItems.features&&a.catalogItems.features.length||0;if(n){var g=0,k,l;k=0;f=[n];c=[n];h=[n];for(e=0;e<n;e++)-1<a.properties.Values[e].toLowerCase().indexOf("nodata")&&k++;k=n-k;for(e=0;e<n;e++)l=-1<a.properties.Values[e].toLowerCase().indexOf("nodata")?k++:g++,f[l]=a.catalogItems.features[e],c[l]=a.properties.Values[e],h[l]=f[l].attributes[m]}this._visibleRasters=[];e=-1<d.toLowerCase().indexOf("nodata");d&&(!f&&!e)&&(f=[],h=new H(new p(this.fullExtent),
null,{ObjectId:0}),f.push(h));n=[];if(!f)return n;g=b&&b.returnDomainValues||!1;e=0;for(m=f.length;e<m;e++)h=f[e],h.popupTemplate=this.popupTemplate,h._layer=this,d&&(k=d,c&&c.length>=e&&(k=c[e],k=k.replace(/ /gi,", ")),h.attributes["Raster.ItemPixelValue"]=k,h.attributes["Raster.ServicePixelValue"]=d,this._updateFeatureWithMagDirValues(h,k),this._updateFeatureWithRasterAttributeTableValues(h,k)),g&&this._updateFeatureWithDomainValues(h),n.push(h);return n},_updateFeatureWithRasterAttributeTableValues:function(a,
b){var d=this.rasterAttributeTable&&this.rasterAttributeTable.features;if(d&&!(1>d.length)&&this.rasterAttributeTableFieldPrefix){var c=null;d.forEach(function(a){a&&a.attributes&&(c=a.attributes.hasOwnProperty("Value")&&a.attributes.Value==b?a:a.attributes.VALUE==b?a:null)});if(c){for(var f in c.attributes)c.attributes.hasOwnProperty(f);a.attributes=l.mixin(a.attributes,c.attributes)}}},_updateFeatureWithMagDirValues:function(a,b){if(this.pixelFilter&&!("esriImageServiceDataTypeVector-UV"!==this.serviceDataType&&
"esriImageServiceDataTypeVector-MagDir"!==this.serviceDataType)){var d=b.replace(" ","").split(","),c=new z({height:1,width:1,pixelType:"f32",pixels:[],statistics:[]});d.forEach(function(a){c.addData({pixels:[a],statistics:{minValue:a,maxValue:a,noDataValue:null}})});this.pixelFilter({pixelBlock:c,extent:new p(0,0,0,0,this.spatialReference)});a.attributes["Raster.Magnitude"]=c.pixels[0][0];a.attributes["Raster.Direction"]=c.pixels[1][0]}},_updateFeatureWithDomainValues:function(a){var b=this.domainFields;
g.isDefined(b)&&b.forEach(function(b){if(b){var c=a.attributes[b.name];g.isDefined(c)&&(c=this._findMatchingDomainValue(b.domain,c),g.isDefined(c)&&(a.attributes[b.name]=c))}},this)},_findMatchingDomainValue:function(a,b){var d=a&&a.codedValues;if(d){var c;d.some(function(a){return a.code===b?(c=a.name,!0):!1});return c}}})});