// COPYRIGHT © 2016 Esri
//
// All rights reserved under the copyright laws of the United States
// and applicable international laws, treaties, and conventions.
//
// This material is licensed for use under the Esri Master License
// Agreement (MLA), and is bound by the terms of that agreement.
// You may redistribute and use this code without modification,
// provided you adhere to the terms of the MLA and include this
// copyright notice.
//
// See use restrictions at http://www.esri.com/legal/pdfs/mla_e204_e300/english
//
// For additional information, contact:
// Environmental Systems Research Institute, Inc.
// Attn: Contracts and Legal Services Department
// 380 New York Street
// Redlands, California, USA 92373
// USA
//
// email: contracts@esri.com
//
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.

define(["../../../core/declare","../../../request","../../../config","../../../core/urlUtils","./PromiseLightweight","./AsyncQuotaRoundRobinQueue","../webgl-engine/lib/Util"],function(e,r,a,i,n,t,l){var o=l.assert,s=!1,u={QUEUED:1,DOWNLOADING:2,CANCELLED:4},d=e(null,{constructor:function(e){this.alreadyLoading={},this.loadQueue=new t(c,this._doneLoadingCallback,this,e),this._urlInfo={hasSameOrigin:{},canUseXhr:{}}},destroy:function(){for(var e in this.alreadyLoading){for(var r=this.alreadyLoading[e],a=0;a<r.clientPromises.length;a++){var i=r.clientPromises[a];i.isRejected()||i.reject(r.url.url,null,r.docType,r.clientMetadata[a])}this._cancelTask(r)}this.loadQueue.clear(),this.loadQueue=null,this.alreadyLoading=null},request:function(e,r,a,i,t){s&&console.log("request "+e),i=i||{};var l=new n.Promise;l.requestURL=e;var o=this.alreadyLoading[e];return o?(o.clientPromises.push(l),o.clientMetadata.push(i.metadata)):(o={url:{url:null,normalized:null,normalizedWithToken:null,hasSameOrigin:!1,canUseXhr:!1},docType:r,clientType:a,status:u.QUEUED,clientMetadata:[i.metadata],clientPromises:[l],downloadObj:null,_cancelledInQueue:!1},this._prepareUrl(o,e,t),this.alreadyLoading[e]=o,i.notQueueable?c(o,this._doneLoadingCallback.bind(this)):this.loadQueue.push(o)),l},isRequested:function(e){return void 0!==this.alreadyLoading[e]},cancel:function(e){var r=e.requestURL;s&&console.log("cancel "+r);var a=this.alreadyLoading[r];a&&this._removeRequestPromiseFromTask(a,e)},getRequestedURLs:function(e){var r={};for(var a in this.alreadyLoading)this.alreadyLoading[a].clientType===e&&(r[a]=!0);return r},cancelBulk:function(e,r){var a,i=l.getFirstObjectValue(e);if(i instanceof n.Promise)for(a in e)this.cancel(e[a]);else{var t=[];for(a in e){var o=this.alreadyLoading[a];o&&(this._cancelTask(o),t.push(o))}t.length>0&&this.loadQueue.removeTasks(t,r)}},hasPendingDownloads:function(){return!l.objectEmpty(this.alreadyLoading)},_prepareUrl:function(e,r,a){if(e.url.url=r,e.url.isData=i.isDataProtocol(r),e.url.isData||"image"!==e.docType)return e.url.normalized=r,void(!e.url.isData&&a&&(e.url.normalizedWithToken=a(r)));r=i.normalize(r),e.url.normalized=r;var n=i.getOrigin(r);a&&(e.url.normalizedWithToken=a(r));var t=this._urlInfo.hasSameOrigin[n];if(void 0!==t?e.url.hasSameOrigin=t:(e.url.hasSameOrigin=i.hasSameOrigin(n,window.location.href),this._urlInfo.hasSameOrigin[n]=e.url.hasSameOrigin),!e.url.hasSameOrigin){var l=this._urlInfo.canUseXhr[n];void 0!==l?e.url.canUseXhr=l:(e.url.canUseXhr=i.canUseXhr(n),this._urlInfo.canUseXhr[n]=e.url.canUseXhr)}},_removeRequestPromiseFromTask:function(e,r){var a=e.clientPromises.length;if(a>1){var i=e.clientPromises.indexOf(r);o(i>-1,"request to be cancelled is already cancelled or invalid"),e.clientPromises[i]=e.clientPromises[a-1],e.clientPromises.pop(),e.clientMetadata[i]=e.clientMetadata[a-1],e.clientMetadata.pop()}else o(e.clientPromises[0]===r,"request to be cancelled is already cancelled or invalid"),this._cancelTask(e)},_cancelTask:function(e){if(e.status===u.DOWNLOADING){if(this.loadQueue.workerCancelled(e),"image"===e.docType){var r=e.downloadObj;r.removeAttribute("onload"),r.removeAttribute("onerror"),r.removeAttribute("src")}else e.status=u.CANCELLED,e.downloadObj.cancel();e.downloadObj=null}e.status=u.CANCELLED,e.clientPromise=void 0,e.metadata=void 0,delete this.alreadyLoading[e.url.url]},_doneLoadingCallback:function(e,r){var a;if(o(e.status===u.DOWNLOADING),delete this.alreadyLoading[e.url.url],r)for(a=0;a<e.clientPromises.length;a++)e.clientPromises[a].isRejected()||e.clientPromises[a].reject(e.url.url,r,e.docType,e.clientMetadata[a]);else for(s&&console.log("done "+e.url.url),a=0;a<e.clientPromises.length;a++)e.clientPromises[a].done(e.url.url,e.result,e.docType,e.clientMetadata[a])}}),c=function(e,i){if(e.status===u.CANCELLED)return!1;if("image"===e.docType){var n=new Image;n.onload=function(){e.status!==u.CANCELLED&&(e.result=n,n.removeAttribute("onload"),n.removeAttribute("onerror"),i(e))},n.onerror=function(){e.status!==u.CANCELLED&&(n.removeAttribute("onload"),n.removeAttribute("onerror"),i(e,{status:404}))},e.url.isData?n.src=e.url.normalized:e.url.hasSameOrigin||e.url.canUseXhr?(e.url.hasSameOrigin||(n.crossOrigin="anonymous"),n.src=e.url.normalizedWithToken||e.url.normalized):e.url.normalizedWithToken||!a.request.proxyUrl?n.src=e.url.normalizedWithToken:n.src=a.request.proxyUrl+"?"+e.url.normalized,e.downloadObj=n}else{var t=r(e.url.normalizedWithToken||e.url.normalized,{responseType:"binary"===e.docType?"array-buffer":"json",failOk:!0});t.then(function(r){e.duration=l.performance.now()-e.startTime,e.size=0,e.result=r.data,i(e)},function(r){e.status!==u.CANCELLED&&i(e,r)}),e.downloadObj=t}return e.status=u.DOWNLOADING,!0};return d.TaskStatus=u,d});