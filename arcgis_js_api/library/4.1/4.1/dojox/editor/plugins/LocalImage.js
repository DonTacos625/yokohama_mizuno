//>>built
define("dojo dijit dijit/registry dijit/_base/popup dijit/_editor/_Plugin dijit/_editor/plugins/LinkDialog dijit/TooltipDialog dijit/form/_TextBoxMixin dijit/form/Button dijit/form/ValidationTextBox dijit/form/DropDownButton dojo/_base/connect dojo/_base/declare dojo/_base/sniff dojox/form/FileUploader dojo/i18n!dojox/editor/plugins/nls/LocalImage".split(" "),function(d,f,g,q,h,r,l,s,x,t,u,y,z,m,v,c){var p=d.declare("dojox.editor.plugins.LocalImage",r.ImgLinkDialog,{uploadable:!1,uploadUrl:"",baseImageUrl:"",
fileMask:"*.jpg;*.jpeg;*.gif;*.png;*.bmp",urlRegExp:"",htmlFieldName:"uploadedfile",_isLocalFile:!1,_messages:"",_cssPrefix:"dijitEditorEilDialog",_closable:!0,linkDialogTemplate:"\x3cdiv style\x3d'border-bottom: 1px solid black; padding-bottom: 2pt; margin-bottom: 4pt;'\x3e\x3c/div\x3e\x3cdiv class\x3d'dijitEditorEilDialogDescription'\x3e${prePopuTextUrl}${prePopuTextBrowse}\x3c/div\x3e\x3ctable role\x3d'presentation'\x3e\x3ctr\x3e\x3ctd colspan\x3d'2'\x3e\x3clabel for\x3d'${id}_urlInput' title\x3d'${prePopuTextUrl}${prePopuTextBrowse}'\x3e${url}\x3c/label\x3e\x3c/td\x3e\x3c/tr\x3e\x3ctr\x3e\x3ctd class\x3d'dijitEditorEilDialogField'\x3e\x3cinput dojoType\x3d'dijit.form.ValidationTextBox' class\x3d'dijitEditorEilDialogField'regExp\x3d'${urlRegExp}' title\x3d'${prePopuTextUrl}${prePopuTextBrowse}'  selectOnClick\x3d'true' required\x3d'true' id\x3d'${id}_urlInput' name\x3d'urlInput' intermediateChanges\x3d'true' invalidMessage\x3d'${invalidMessage}' prePopuText\x3d'\x26lt;${prePopuTextUrl}${prePopuTextBrowse}\x26gt'\x3e\x3c/td\x3e\x3ctd\x3e\x3cdiv id\x3d'${id}_browse' style\x3d'display:${uploadable}'\x3e${browse}\x3c/div\x3e\x3c/td\x3e\x3c/tr\x3e\x3ctr\x3e\x3ctd colspan\x3d'2'\x3e\x3clabel for\x3d'${id}_textInput'\x3e${text}\x3c/label\x3e\x3c/td\x3e\x3c/tr\x3e\x3ctr\x3e\x3ctd\x3e\x3cinput dojoType\x3d'dijit.form.TextBox' required\x3d'false' id\x3d'${id}_textInput' name\x3d'textInput' intermediateChanges\x3d'true' selectOnClick\x3d'true' class\x3d'dijitEditorEilDialogField'\x3e\x3c/td\x3e\x3ctd\x3e\x3c/td\x3e\x3c/tr\x3e\x3ctr\x3e\x3ctd\x3e\x3c/td\x3e\x3ctd\x3e\x3c/td\x3e\x3c/tr\x3e\x3ctr\x3e\x3ctd colspan\x3d'2'\x3e\x3cbutton dojoType\x3d'dijit.form.Button' id\x3d'${id}_setButton'\x3e${set}\x3c/button\x3e\x3c/td\x3e\x3c/tr\x3e\x3c/table\x3e",
_initButton:function(){var a=this;this._messages=c;this.tag="img";var b=this.dropDown=new l({title:c[this.command+"Title"],onOpen:function(){a._initialFileUploader();a._onOpenDialog();l.prototype.onOpen.apply(this,arguments);setTimeout(function(){s.selectInputText(a._urlInput.textbox);a._urlInput.isLoadComplete=!0},0)},onClose:function(){d.disconnect(a.blurHandler);a.blurHandler=null;this.onHide()},onCancel:function(){setTimeout(d.hitch(a,"_onCloseDialog"),0)}}),e=this.getLabel(this.command),w=this.iconClassPrefix+
" "+this.iconClassPrefix+this.command.charAt(0).toUpperCase()+this.command.substr(1),e=d.mixin({label:e,showLabel:!1,iconClass:w,dropDown:this.dropDown,tabIndex:"-1"},this.params||{});m("ie")||(e.closeDropDown=function(b){a._closable&&this._opened&&(q.close(this.dropDown),b&&this.focus(),this._opened=!1,this.state="");setTimeout(function(){a._closable=!0},10)});this.button=new u(e);var e=this.fileMask.split(";"),k="";d.forEach(e,function(a){a=a.replace(/\./,"\\.").replace(/\*/g,".*");k+="|"+a+"|"+
a.toUpperCase()});c.urlRegExp=this.urlRegExp=k.substring(1);this.uploadable||(c.prePopuTextBrowse=".");c.id=g.getUniqueId(this.editor.id);c.uploadable=this.uploadable?"inline":"none";this._uniqueId=c.id;this._setContent("\x3cdiv class\x3d'"+this._cssPrefix+"Title'\x3e"+b.title+"\x3c/div\x3e"+d.string.substitute(this.linkDialogTemplate,c));b.startup();b=this._urlInput=g.byId(this._uniqueId+"_urlInput");this._textInput=g.byId(this._uniqueId+"_textInput");this._setButton=g.byId(this._uniqueId+"_setButton");
if(b){var n=t.prototype,b=d.mixin(b,{isLoadComplete:!1,isValid:function(a){return this.isLoadComplete?n.isValid.apply(this,arguments):0<this.get("value").length},reset:function(){this.isLoadComplete=!1;n.reset.apply(this,arguments)}});this.connect(b,"onKeyDown","_cancelFileUpload");this.connect(b,"onChange","_checkAndFixInput")}this._setButton&&this.connect(this._setButton,"onClick","_checkAndSetValue");this._connectTagEvents()},_initialFileUploader:function(){var a=null,b=this,c=b._uniqueId+"_browse",
d=b._urlInput;b.uploadable&&!b._fileUploader&&(a=b._fileUploader=new v({force:"html",uploadUrl:b.uploadUrl,htmlFieldName:b.htmlFieldName,uploadOnChange:!1,selectMultipleFiles:!1,showProgress:!0},c),a.reset=function(){b._isLocalFile=!1;a._resetHTML()},b.connect(a,"onClick",function(){d.validate(!1);m("ie")||(b._closable=!1)}),b.connect(a,"onChange",function(a){b._isLocalFile=!0;d.set("value",a[0].name);d.focus()}),b.connect(a,"onComplete",function(a){var c=b.baseImageUrl,c=c&&"/"==c.charAt(c.length-
1)?c:c+"/";d.set("value",c+a[0].file);b._isLocalFile=!1;b._setDialogStatus(!0);b.setValue(b.dropDown.get("value"))}),b.connect(a,"onError",function(a){console.log("Error occurred when uploading image file!");b._setDialogStatus(!0)}))},_checkAndFixInput:function(){this._setButton.set("disabled",!this._isValid())},_isValid:function(){return this._urlInput.isValid()},_cancelFileUpload:function(){this._fileUploader.reset();this._isLocalFile=!1},_checkAndSetValue:function(){this._fileUploader&&this._isLocalFile?
(this._setDialogStatus(!1),this._fileUploader.upload()):this.setValue(this.dropDown.get("value"))},_setDialogStatus:function(a){this._urlInput.set("disabled",!a);this._textInput.set("disabled",!a);this._setButton.set("disabled",!a)},destroy:function(){this.inherited(arguments);this._fileUploader&&(this._fileUploader.destroy(),delete this._fileUploader)}});f=function(a){return new p({command:"insertImage",uploadable:"uploadable"in a?a.uploadable:!1,uploadUrl:"uploadable"in a&&"uploadUrl"in a?a.uploadUrl:
"",htmlFieldName:"uploadable"in a&&"htmlFieldName"in a?a.htmlFieldName:"uploadedfile",baseImageUrl:"uploadable"in a&&"baseImageUrl"in a?a.baseImageUrl:"",fileMask:"fileMask"in a?a.fileMask:"*.jpg;*.jpeg;*.gif;*.png;*.bmp"})};h.registry.LocalImage=f;h.registry.localImage=f;h.registry.localimage=f;return p});