// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["../../core/kebabDictionary","../../core/JSONSupporter","./CodedValueDomain","./RangeDomain"],function(d,e,f,g){var c=d({esriFieldTypeSmallInteger:"small-integer",esriFieldTypeInteger:"integer",esriFieldTypeSingle:"single",esriFieldTypeDouble:"double",esriFieldTypeLong:"long",esriFieldTypeString:"string",esriFieldTypeDate:"date",esriFieldTypeOID:"oid",esriFieldTypeGeometry:"geometry",esriFieldTypeBlob:"blob",esriFieldTypeRaster:"raster",esriFieldTypeGUID:"guid",esriFieldTypeGlobalID:"global-id",
esriFieldTypeXML:"xml"}),a=e.createSubclass({declaredClass:"esri.layers.support.Field",alias:null,domain:null,_domainReader:function(b,c){var a=b&&b.type;return"range"===a?new g(b):"codedValue"===a?new f(b):null},editable:!1,length:-1,name:null,nullable:!0,type:null,_typeReader:c.fromJSON,clone:function(){return a.fromJSON(this.toJSON())},toJSON:function(){return{alias:this.alias,domain:this.domain&&this.domain.toJSON(),editable:this.editable,length:this.length,name:this.name,nullable:this.nullable,
type:c.toJSON(this.type)}}});return a});