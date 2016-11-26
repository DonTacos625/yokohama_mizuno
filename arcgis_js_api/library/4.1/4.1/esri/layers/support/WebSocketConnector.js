// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define("dojo/_base/lang dojo/io-query dojo/Deferred ../../core/Accessoire ../../core/Evented ../../core/AccessoirePromise".split(" "),function(d,g,h,f,k,l){var c={STATUS_CONNECTED:0,STATUS_DISCONNECTED:1,STATUS_CONNECTING:2,STATUS_RECONNECTING:3,STATUS_DISCONNECTING:4};f=f.createSubclass([k,l],{declareSubclass:"esri.layers.support.WebSocketConnector",classMetadata:{properties:{currentSocketUrl:{},connectionInfo:{dependsOn:["socketUrls","queryParams"],readOnly:!0},status:{readOnly:!0}}},constructor:function(a){this.watch("maxReconnectAttempts",
function(a){a<this._reconnectAttempts&&this.disconnect()}.bind(this))},normalizeCtorArgs:function(a){a=a||{};"string"===typeof a?a={socketUrls:[a]}:Array.isArray(a)&&(a={socketUrls:a});return a},getDefaults:function(a){var b=this.inherited(arguments);return d.mixin(b||{},{socketUrls:[]})},initialize:function(){var a=null;this.socketUrls.length||(a=Error("No urls passed to WebSocketConnector. No live connection possible"));"WebSocket"in window||(a=Error("The browser does not support Web Sockets. No live connection possible"));
if(a){var b=new h;this.addResolvingPromise(b.promise);b.reject(a)}},_reconnectAttempts:0,_reconnectTimeoutId:null,_socket:null,_connectionInfoGetter:function(){return{socketUrls:this.socketUrls,queryParams:this.queryParams}},_maxReconnectAttemptsSetter:function(a){return a||10},currentSocketUrl:null,socketUrls:null,_status:c.STATUS_DISCONNECTED,_statusGetter:function(){return this._status},connect:function(){if(this._socket&&this._status!==c.STATUS_DISCONNECTED&&this._status!==c.STATUS_RECONNECTING)console.log("Already connected. No need to do anything");
else{var a=this._makeCurrentUrl();this._status===c.STATUS_RECONNECTING&&this.emit("attempt-reconnect",{url:a,count:this._reconnectAttempts});a=new WebSocket(a);this._status===c.STATUS_DISCONNECTED&&(this._status=c.STATUS_CONNECTING,this.notifyChange("status"));a.onopen=d.hitch(this,this._handleSocketOpen);a.onclose=d.hitch(this,this._handleSocketClose);a.onmessage=d.hitch(this,this._handleSocketMessage);this._socket=a}},disconnect:function(){this._status=c.STATUS_DISCONNECTED;this.notifyChange("status");
clearTimeout(this._reconnectTimeoutId);this._socket&&this._socket.close();this.emit("disconnect",{willReconnect:!1,message:"Connection closed from client"})},send:function(a){"object"===typeof a&&(a=JSON.stringify(a));this._socket.send(a)},_attemptReconnect:function(){var a;this._reconnectTimeoutId&&(clearTimeout(this._reconnectTimeoutId),this._reconnectTimeoutId=null);if(this._status!==c.STATUS_RECONNECTING&&this.layerSource&&this.connectionInfo.queryParams&&this.connectionInfo.queryParams.token&&
1===this._reconnectAttempts)return this._status=c.STATUS_RECONNECTING,this.notifyChange("status"),this.layerSource.getWebSocketToken().then(function(a){this._attemptReconnect()}.bind(this),function(a){this._status=c.STATUS_DISCONNECTED;this.notifyChange("status");this.emit("disconnect",{error:Error("Could not get websocket token from service"),willReconnect:!1})}.bind(this)),null;this._socket=null;this._status=c.STATUS_RECONNECTING;this.notifyChange("status");a=this._randomIntFromInterval(0,1E3);
a=1E3*this._reconnectAttempts+a;this._reconnectTimeoutId=setTimeout(function(){this.connect()}.bind(this),a)},_makeCurrentUrl:function(){var a=this.connectionInfo.queryParams,b=this.connectionInfo.socketUrls,c;1===b.length||!this.currentSocketUrl?b=b[0]:(c=b.indexOf(this.currentSocketUrl),c=c>=b.length-1?0:c+1,b=b[c]);this.currentSocketUrl=b;a&&(b+="?"+g.objectToQuery(a));return b},_handleSocketOpen:function(){this._status=c.STATUS_CONNECTED;this.notifyChange("status");this._reconnectAttempts=0;this.emit("connect")},
_handleSocketClose:function(a){var b,e=!0,d=this._status===c.STATUS_CONNECTED,f=null;if(d||this._status===c.STATUS_RECONNECTING||this._status===c.STATUS_CONNECTING){if(a.code)if(b="Connection failed: ",1001===a.code)b+=a.reason||"Service is going away.",e=!1;else if(4400===a.code)b+=a.reason||"Invalid url parameters. Check filter properties.",e=!1;else if(4404===a.code)b+="Service not found",e=!1;else if(4401===a.code||4403===a.code)b+="Not authorized",e=!1;e&&(this._reconnectAttempts+=1,this._reconnectAttempts>
this.maxReconnectAttempts&&(b="Maximum reconnect attempts exceeded",e=!1,d=!0));this._status=c.STATUS_DISCONNECTED;this.notifyChange("status");d&&(b&&(f=Error(b)),this.emit("disconnect",{error:f,willReconnect:e}));e?this._attemptReconnect():this._socket=null}else this._socket=null},_handleSocketMessage:function(a){this.emit("message",a.data)},_randomIntFromInterval:function(a,b){return Math.floor(Math.random()*(b-a+1)+a)}});d.mixin(f,c);return f});