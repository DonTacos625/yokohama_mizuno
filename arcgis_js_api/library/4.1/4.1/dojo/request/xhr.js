//>>built
define(["../errors/RequestError","./watch","./handlers","./util","../has"],function(p,x,q,f,c){function y(a,b){var d=a.xhr;a.status=a.xhr.status;try{a.text=d.responseText}catch(c){}"xml"===a.options.handleAs&&(a.data=d.responseXML);if(!b)try{q(a)}catch(e){b=e}var g;if(b)this.reject(b);else{try{q(a)}catch(h){g=h}f.checkStatus(d.status)?g?this.reject(g):this.resolve(a):(b=g?new p("Unable to load "+a.url+" status: "+d.status+" and an error in handleAs: transformation of response",a):new p("Unable to load "+
a.url+" status: "+d.status,a),this.reject(b))}}function z(a){return this.xhr.getResponseHeader(a)}function l(a,b,d){var u=c("native-formdata")&&b&&b.data&&b.data instanceof FormData,e=f.parseArgs(a,f.deepCreate(A,b),u);a=e.url;b=e.options;var g,h=f.deferred(e,r,s,v,y,function(){g&&g()}),k=e.xhr=l._create();if(!k)return h.cancel(new p("XHR was not created")),d?h:h.promise;e.getHeader=z;t&&(g=t(k,h,e));var q=b.data,B=!b.sync,C=b.method;try{k.open(C,a,B,b.user||void 0,b.password||void 0);b.withCredentials&&
(k.withCredentials=b.withCredentials);c("native-response-type")&&b.handleAs in w&&(k.responseType=w[b.handleAs]);var m=b.headers;a=u?!1:"application/x-www-form-urlencoded";if(m)for(var n in m)"content-type"===n.toLowerCase()?a=m[n]:m[n]&&k.setRequestHeader(n,m[n]);a&&!1!==a&&k.setRequestHeader("Content-Type",a);(!m||!("X-Requested-With"in m))&&k.setRequestHeader("X-Requested-With","XMLHttpRequest");f.notify&&f.notify.emit("send",e,h.promise.cancel);k.send(q)}catch(D){h.reject(D)}x(h);k=null;return d?
h:h.promise}c.add("native-xhr",function(){return"undefined"!==typeof XMLHttpRequest});c.add("dojo-force-activex-xhr",function(){return c("activex")&&"file:"===window.location.protocol});c.add("native-xhr2",function(){if(c("native-xhr")&&!c("dojo-force-activex-xhr")){var a=new XMLHttpRequest;return"undefined"!==typeof a.addEventListener&&("undefined"===typeof opera||"undefined"!==typeof a.upload)}});c.add("native-formdata",function(){return"undefined"!==typeof FormData});c.add("native-response-type",
function(){return c("native-xhr")&&"undefined"!==typeof(new XMLHttpRequest).responseType});c.add("native-xhr2-blob",function(){if(c("native-response-type")){var a=new XMLHttpRequest;a.open("GET","/",!0);a.responseType="blob";var b=a.responseType;a.abort();return"blob"===b}});var w={blob:c("native-xhr2-blob")?"blob":"arraybuffer",document:"document",arraybuffer:"arraybuffer"},s,v,t,r;c("native-xhr2")?(s=function(a){return!this.isFulfilled()},r=function(a,b){b.xhr.abort()},t=function(a,b,d){function c(a){b.handleResponse(d)}
function e(a){a=new p("Unable to load "+d.url+" status: "+a.target.status,d);b.handleResponse(d,a)}function g(a){a.lengthComputable?(d.loaded=a.loaded,d.total=a.total,b.progress(d)):3===d.xhr.readyState&&(d.loaded="loaded"in a?a.loaded:a.position,b.progress(d))}a.addEventListener("load",c,!1);a.addEventListener("error",e,!1);a.addEventListener("progress",g,!1);return function(){a.removeEventListener("load",c,!1);a.removeEventListener("error",e,!1);a.removeEventListener("progress",g,!1);a=null}}):
(s=function(a){return a.xhr.readyState},v=function(a){return 4===a.xhr.readyState},r=function(a,b){var c=b.xhr,f=typeof c.abort;("function"===f||"object"===f||"unknown"===f)&&c.abort()});var A={data:null,query:null,sync:!1,method:"GET"};l._create=function(){throw Error("XMLHTTP not available");};if(c("native-xhr")&&!c("dojo-force-activex-xhr"))l._create=function(){return new XMLHttpRequest};else if(c("activex"))try{new ActiveXObject("Msxml2.XMLHTTP"),l._create=function(){return new ActiveXObject("Msxml2.XMLHTTP")}}catch(E){try{new ActiveXObject("Microsoft.XMLHTTP"),
l._create=function(){return new ActiveXObject("Microsoft.XMLHTTP")}}catch(F){}}f.addCommonMethods(l);return l});