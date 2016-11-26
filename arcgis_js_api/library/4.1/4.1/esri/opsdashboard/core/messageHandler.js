// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("require exports ../../core/tsSupport/extendsHelper ../../core/tsSupport/decorateHelper ../../core/typescript dojo/json ../../core/Evented dojo/Deferred".split(" "),function(n,p,h,k,l,e,m,f){return new (function(g){function d(){g.apply(this,arguments);this._targetUrl="";this._loadingDeferred=null;this.isNative=this._redirectIdentityManager=!1}h(d,g);d.prototype.dojoConstructor=function(){var a=this;this._promises={};this.messageId=0;var b=document.referrer;b&&(b=b.split(/[\/?#]/),this._targetUrl=
b[0]+"//"+b[2]);this._loadingDeferred=new f;window.engine?(this.isNative=!0,window.engine._trigger=function(c,b){a._engineCallbacks(c,b)},window.engine.BindingsReady(),window.document.addEventListener("contextmenu",function(a){var b=new MouseEvent("click",{view:a.view,altKey:a.altKey,ctrlKey:a.ctrlKey,shiftKey:a.shiftKey,metaKey:a.metaKey,which:a.which,button:a.button,buttons:a.buttons,detail:a.detail,currentTarget:a.currentTarget,relatedTarget:a.relatedTarget,target:a.target,timeStamp:a.timeStamp,
clientX:a.clientX,clientY:a.clientY,screenX:a.screenX,screenY:a.screenY});a.target.dispatchEvent(b)})):(window.addEventListener("message",function(b){b.origin===a._targetUrl&&a._messageReceived(b.data)},!1),this._loadingDeferred.resolve());window.setInterval(function(){return a.checkPromises},3E4)};d.prototype._engineCallbacks=function(a,b){switch(a.toLowerCase()){case "_onready":this._loadingDeferred.resolve();break;case "receivemessages":this._messageReceived(b)}};d.prototype.checkPromises=function(){var a=
Date.now()-3E4,b=[],c;for(c in this._promises)this._promises[c].timestamp>a||(b.push(c),this._promises[c].promise.isFulfilled()||this._promises[c].promise.reject(Error("messageTimeout")));b.forEach(function(a){delete this._promises[a]},this)};d.prototype._messageReceived=function(a){a=e.parse(a);if(a.args)for(var b in a.args){var c=a.args[b];"string"===typeof c&&0===c.indexOf("{")&&(a.args[b]=e.parse(c))}if((b=void 0!==a.clientMessageId?this._promises[a.clientMessageId]:null)||!a.clientMessageId){if(b)return delete this._promises[a.clientMessageId],
b.promise.isFulfilled()?void 0:!a.args?b.promise.resolve():a.args.error?b.promise.reject({error:a.args.error}):a.args.cancelled?b.promise.reject({cancel:a.args.cancelled}):b.promise.resolve(a.args);a.functionName&&this.emit("message-received",a)}};d.prototype.__sendMessage=function(a){window.name&&(a.addinId=window.name);window.engine?window.engine.SendMessage.call(this,"sendMessage",null,e.stringify(a),window.location.hostname):window.parent.postMessage(e.stringify(a),this._targetUrl)};d.prototype._sendMessageWithReply=
function(a){var b=this;return this._loadingDeferred.then(function(){var c=new f;a.clientMessageId=b.messageId++;b._promises[a.clientMessageId]={promise:c,timestamp:Date.now()};b.__sendMessage(a);return c.promise})};d.prototype._sendMessage=function(a){var b=this;this._loadingDeferred.then(function(){b.__sendMessage(a)})};return d=k([l.subclass()],d)}(m))});