//>>built
define("dojo/_base/lang dojo/dom-attr dojo/dom-class dijit/form/Button dijit/form/DropDownButton dijit/form/ComboButton dojo/i18n dojo/i18n!dijit/nls/loading dojo/_base/declare".split(" "),function(c,d,f,k,l,m,g,n,h){return h("dojox.form._BusyButtonMixin",null,{isBusy:!1,isCancelled:!1,busyLabel:"",timeout:null,useIcon:!0,postMixInProperties:function(){this.inherited(arguments);this.busyLabel||(this.busyLabel=g.getLocalization("dijit","loading",this.lang).loadingState)},postCreate:function(){this.inherited(arguments);
this._label=this.containerNode.innerHTML;this._initTimeout=this.timeout;this.isBusy&&this.makeBusy()},makeBusy:function(){this.isBusy=!0;this.isCancelled=!1;this._disableHandle&&this._disableHandle.remove();this._disableHandle=this.defer(function(){this.set("disabled",!0)});this.setLabel(this.busyLabel,this.timeout)},cancel:function(){this.isCancelled=!0;this._disableHandle&&this._disableHandle.remove();this.set("disabled",!1);this.isBusy=!1;this.setLabel(this._label);this._timeout&&clearTimeout(this._timeout);
this.timeout=this._initTimeout},resetTimeout:function(a){this._timeout&&clearTimeout(this._timeout);a?this._timeout=setTimeout(c.hitch(this,function(){this.cancel()}),a):(void 0==a||0===a)&&this.cancel()},setLabel:function(a,e){for(this.label=a;this.containerNode.firstChild;)this.containerNode.removeChild(this.containerNode.firstChild);this.containerNode.appendChild(document.createTextNode(this.label));!1==this.showLabel&&!d.get(this.domNode,"title")&&(this.titleNode.title=c.trim(this.containerNode.innerText||
this.containerNode.textContent||""));e?this.resetTimeout(e):this.timeout=null;if(this.useIcon&&this.isBusy){var b=new Image;b.src=this._blankGif;d.set(b,"id",this.id+"_icon");f.add(b,"dojoxBusyButtonIcon");this.containerNode.appendChild(b)}},_onClick:function(a){this.isBusy||(this.inherited(arguments),this.isCancelled||this.makeBusy())}})});