// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("dojo/_base/lang ../../core/Accessor ../../core/lang ../../core/urlUtils ../../core/promiseUtils ../../request ../../geometry/Extent ../../geometry/SpatialReference ./PixelBlock ./rasterFormats/LercCodec ./rasterFormats/JpgPlus ./rasterFormats/Png ./rasterFormats/Raw".split(" "),function(m,q,r,s,g,t,u,v,w,x,n,p,l){return q.createSubclass({declaredClass:"esri.layers.support.Raster",validPixelTypes:"u1 u2 u4 u8 u16 u32 s8 s16 s32 f32".split(" "),validFormats:"lerc jpeg jpg jpgpng png png8 png24 png32 bip bsq".split(" "),
classMetadata:{properties:{parsedUrl:{readOnly:!0,dependsOn:["url"]},url:{}}},_parsedUrlGetter:function(){return this.url?s.urlToObject(this.url):null},url:null,read:function(a){if(!a.imageServiceParameters||!a.nBands)return g.reject(Error("Insufficient parameters to read data"));var b=r.clone(a.imageServiceParameters),c=a.nBands,d=a.pixelType||"f32";-1>=this.validPixelTypes.indexOf(d.toUpperCase())&&(b.pixelType="f32");b.format=b.format||"lerc";-1>=this.validFormats.indexOf(b.format.toLowerCase())&&
(b.format="lerc");this._prepareGetImageParameters(b);return t(this.parsedUrl.path+"/exportImage",{responseType:"array-buffer",query:m.mixin(b,{f:"image"})}).then(function(a){a=a.data;if(!this._isDataValid(a))return a=Error(String.fromCharCode.apply(null,new Uint8Array(a))),g.reject(a);var f=b.format.toUpperCase();"BSQ"!==f&&"BIP"!==f&&(f=this._getFormat(a));try{return-1<this.validFormats.indexOf(f.toLowerCase())?{pixelData:{pixelBlock:this._decodePixelBlock(a,{width:b.width,height:b.height,planes:c,
pixelType:d,noDataValue:b.noData,format:f}),extent:b.extent},params:b}:g.reject(Error("Cannot decode the pixelBlock. Unsupported Format: "+f))}catch(k){return g.reject(k)}}.bind(this))},_prepareGetImageParameters:function(a){if(a.size&&a.bbox){var b=a.size.split(",");a.width=parseFloat(b[0]);a.height=parseFloat(b[1]);a.extent||(b=a.bbox.split(","),a.extent=new u(parseFloat(b[0]),parseFloat(b[1]),parseFloat(b[2]),parseFloat(b[3]),new v(a.bboxSR)))}else{if(!a.width||Math.floor(a.width)!==a.width||!a.height||
Math.floor(a.height)!==a.height)throw Error("Incorrect Image Dimensions");if(!a.extent||"esri.geometry.Extent"!==a.extent.declaredClass)throw Error("Incorrect extent");var b=a.extent,c=b.spatialReference.wkid||JSON.stringify(b.spatialReference.toJSON());delete a._ts;m.mixin(a,{bbox:b.xmin+","+b.ymin+","+b.xmax+","+b.ymax,imageSR:c,bboxSR:c,size:a.width+","+a.height},a.disableClientCaching?{_ts:Date.now()}:{})}},_adjustExtent:function(a,b,c){var d=a.ymax-a.ymin,e=a.xmax-a.xmin;c>=b?a.ymax=a.ymin+e*
b/c:(e=d*c/b,a.xmax=a.xmin+e);return a},_getFormat:function(a){a=new Uint8Array(a,0,10);var b="";255===a[0]&&216===a[1]?b="JPEG":137===a[0]&&80===a[1]&&78===a[2]&&71===a[3]?b="PNG":67===a[0]&&110===a[1]&&116===a[2]&&90===a[3]&&73===a[4]&&109===a[5]&&97===a[6]&&103===a[7]&&101===a[8]&&32===a[9]?b="LERC":-1<String.fromCharCode.apply(null,a).toLowerCase().indexOf("error")&&(b="ERROR");return b},_isDataValid:function(a){a=new Uint8Array(a,0,10);return-1<String.fromCharCode.apply(null,a).toLowerCase().indexOf("error")?
!1:!0},_calculateBandStatistics:function(a){var b=Infinity,c=-Infinity,d=a.length,e,f=0;for(e=0;e<d;e++)f=a[e],b=f<b?f:b,c=f>c?f:c;return{minValue:b,maxValue:c}},_verifyResult:function(a,b){return!a||a.height!==b.height||a.width!==b.width?!1:!0},_getPixelTypeAndNoData:function(a){var b=a.noDataValue;a=a.pixelType;var c;"u1"===a||"u2"===a||"u4"===a||"u8"===a?(a="u8",b=Math.pow(2,8)-1,c=Uint8Array):"u16"===a?(b=b||Math.pow(2,16)-1,c=Uint16Array):"u32"===a?(b=b||Math.pow(2,32)-1,c=Uint32Array):"s8"===
a?(b=b||0-Math.pow(2,7),c=Int8Array):"s16"===a?(b=b||0-Math.pow(2,15),c=Int16Array):"s32"===a?(b=b||0-Math.pow(2,31),c=Int32Array):c=Float32Array;return{pixelType:a,pixelDataType:c,noDataValue:b}},_decodePixelBlock:function(a,b){if(!a||!b)throw Error("Cannot decode the pixelBlock. Invalid parameters provided for decoding.");if(!b.height||Math.floor(b.height)!==b.height)throw Error("Cannot decode the pixelBlock. Height is not provided.");if(!b.width||Math.floor(b.width)!==b.width)throw Error("Cannot decode the pixelBlock. Width is not provided.");
var c=this._decodeLerc;switch(b.format.toUpperCase()){case "JPEG":c=this._decodeJpeg;break;case "PNG":c=this._decodePng;break;case "BSQ":c=this._decodeBsq;break;case "BIP":c=this._decodeBip}var c=c.bind(this),c=c(a,b),d=c.statistics||[],e,f;if(0>=d.length)for(e=0;e<c.pixels.length;e++)f=c.pixels[e],d.push(this._calculateBandStatistics(f));return new w({width:b.width,height:b.height,pixels:c.pixels,pixelType:b.pixelType,mask:c.mask,statistics:d})},_decodeJpeg:function(a,b){if(!n)throw Error("The jpeg decoder module is not loaded.");
var c=(new n).decode(a);if(!this._verifyResult(c,b))throw Error("Error in decoding the image. The decoded image dimensions are incorrect.");b.width=c.width;b.height=c.height;b.pixelType="U8";return c},_decodePng:function(a,b){if(!p)throw Error("The png decoder module is not loaded.");var c=new Uint8Array(a),d=new p(c),c=new Uint8Array(4*b.width*b.height);d.copyToImageData(c,d.decodePixels());for(var e=d=0,f,e=new Uint8Array(b.width*b.height),d=0;d<b.width*b.height;d++)e[d]=c[4*d+3];for(var k={pixels:[],
mask:e},d=0;3>d;d++){f=new Uint8Array(b.width*b.height);for(e=0;e<b.width*b.height;e++)f[e]=c[4*e+d];k.pixels.push(f)}b.pixelType="U8";return k},_decodeBsq:function(a,b){if(!l)throw Error("The bsq decoder module is not loaded.");var c=this._getPixelTypeAndNoData(b);return l.decodeBSQ(a,{bandCount:b.planes,width:b.width,height:b.height,pixelType:c.pixelDataType,noDataValue:c.noDataValue})},_decodeBip:function(a,b){if(!l)throw Error("The bsq decoder module is not loaded.");var c=this._getPixelTypeAndNoData(b);
return l.decodeBIP(a,{bandCount:b.planes,width:b.width,height:b.height,pixelType:c.pixelDataType,noDataValue:c.noDataValue})},_decodeLerc:function(a,b){var c=this._getPixelTypeAndNoData(b);b.pixelType=c.pixelType;for(var d=0,e,f=0,k=a.byteLength-10,g={pixels:[],statistics:[]};f<k;){var h=x.decode(a,{inputOffset:f,encodedMaskData:e,returnMask:0===d?!0:!1,returnEncodedMask:0===d?!0:!1,returnFileInfo:!0,pixelType:c.pixelDataType,noDataValue:c.noDataValue}),f=h.fileInfo.eofOffset;0===d&&(e=h.encodedMaskData,
g.mask=h.maskData);d++;if(!this._verifyResult(h,b))throw Error("Error in decoding the image. The decoded image dimensions are incorrect.");g.pixels.push(h.pixelData);g.statistics.push({minValue:h.minValue,maxValue:h.maxValue,noDataValue:h.noDataValue})}return g}})});