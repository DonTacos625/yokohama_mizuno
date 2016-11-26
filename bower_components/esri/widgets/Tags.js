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

define(["dojo/_base/array","../core/declare","dojo/_base/lang","dojo/dom","dojo/dom-attr","dojo/dom-class","dojo/dom-construct","dojo/dom-style","dojo/html","dojo/keys","dojo/on","dojo/query","dojo/sniff","dojo/string","dstore/Memory","dijit/focus","dijit/form/TextBox","dijit/registry","dijit/Tooltip","dijit/_OnDijitClickMixin","dijit/_TemplatedMixin","./Widget","dgrid/OnDemandGrid","dgrid/Selection","dgrid/Keyboard","../core/lang","dojo/i18n!./Tags/nls/Tags","dojo/NodeList-traverse","dojo/NodeList-manipulate"],function(t,i,e,s,h,r,o,a,d,n,_,c,l,u,g,f,C,S,p,E,T,L,m,y,I,v,O){return L.createSubclass([E,T],{declaredClass:"esri.widgets.Tags",templateString:'<div class="${baseClass}"></div>',baseClass:"esri-tags",constructor:function(t){this._idProperty="tag",this._tags=[],this._selRows=[],this._CHOICE_ALL_SELECTOR=this._CSS_STYLES.CLASS_SELECTOR+this._CSS_STYLES.CHOICE+this._CSS_STYLES.ALL_SELECTOR,this._CHOICE_FOCUS=this._CSS_STYLES.CLASS_SELECTOR+this._CSS_STYLES.SEARCH_CHOICE_FOCUS,this._CHOICE_FOCUS_ALL=this._CHOICE_FOCUS+this._CSS_STYLES.ALL_SELECTOR},postMixInProperties:function(){this.inherited(arguments);var t=(new Date).getTime();this._tagsId="userTags-"+t,this._gridId="grid-"+t,this._filterId="filter-"+t,this.i18n=O},postCreate:function(){this._attachmentNode=o.create("div",{id:this._tagsId,className:"grid_1"},this.domNode),this._createContainerNode(),this._createTagList(),this._createDropDownList(),this._createInput();var t=[{field:this._idProperty}],s=[{property:this._idProperty,ascending:!0}];this._store=new g({idProperty:this._idProperty,data:[]});var h=i([m,y,I]);this._grid=new h({collection:this._store,showHeader:!1,noDataMessage:this.i18n.noTagsFound,selectionMode:"extended",allowSelectAll:!0,cellNavigation:!1,columns:t,sort:s,renderRow:this._renderItem},this._dropDownList),this._grid.startup(),r.add(this._grid.domNode,"grid-height-limiter");var a;this.own(this._inputTextBox.watch("value",e.hitch(this,function(t,i,e){a&&(clearTimeout(a),a=null),this._grid.refresh()}))),this.own(this._grid.on(".dgrid-row:click",e.hitch(this,function(t){var i="";this._shiftKeyPressed||this._metaKeyPressed?t.shiftKey||t.metaKey||t.ctrlKey||(i=this._selRows[0],this._createTags(i),this._store.remove(i),this._grid.refresh(),this._resetInputTextBox()):(i=this._grid.row(t).data.tag,this._createTags(i),this._store.remove(i),this._grid.refresh(),this._resetInputTextBox())}))),this.own(this._grid.on("dgrid-deselect",e.hitch(this,function(t){this._selRows=[];for(var i in this._grid.selection)this._grid.selection.hasOwnProperty(i)&&this._selRows.push(i)}))),this.own(this._grid.on("dgrid-select",e.hitch(this,function(t){this._selRows=[];for(var i in this._grid.selection)this._grid.selection.hasOwnProperty(i)&&this._selRows.push(i)}))),this.own(_(this.domNode,"keydown",e.hitch(this,this._keydownHandler))),this.own(_(this.domNode,"keyup",e.hitch(this,this._keyupHandler))),window.onkeydown=e.hitch(this,function(t){(t.shiftKey||t.ctrlKey||224===t.keyCode)&&(this._metaKeyPressed=!0)}),this.own(_(document,"onkeydown",e.hitch(this,function(t){this._shiftKeyPressed=!0,this._metaKeyPressed=!0})))},_attachmentNode:"",_autocompleteList:"",_grid:"",_store:"",_idProperty:"",_gridId:"",_filterId:"",_placeHolder:"",_noDataMsg:"",_inputTextBox:"",_gridHasFocus:!1,_metaKeyPressed:!1,_shiftKeyPressed:!1,_CSS_STYLES:{CLASS_SELECTOR:".",ALL_SELECTOR:">",MULTI:"select2-container select2-container-multi",CHOICES:"select2-choices",CHOICE:"select2-search-choice",SEARCH_CHOICE_FOCUS:"select2-search-choice-focus",SEARCH_FIELD:"select2-search-field",CLOSE_ICON:"select2-search-choice-close"},_selRows:[],_CHOICE_SELECTOR:"",_CHOICE_FOCUS:"",_CHOICE_FOCUS_ALL:"",properties:{value:{set:function(t){this._setTagValues(t)},get:function(){return this._getTagValues()}},knownTags:{set:function(t){var i,e=[],s=this._tags;for(i=0;i<t.length;i++)s.indexOf(t[i])<0&&e.push(t[i]);this._store=new g({idProperty:this._idProperty,data:e}),this._grid.set("collection",this._store),this._grid.refresh()}},required:!1,maxWidth:{value:"auto",cast:function(t){return t?t:"auto"}},minWidth:{value:"auto",cast:function(t){return t?t:"auto"}},matchParam:{value:"first",cast:function(t){return t?t:"first"}}},isValid:function(){return!this.required||v.isDefined(this._tags)&&this._tags.length>0},validate:function(){this._created&&!this.isValid()?(h.set(this.domNode,"aria-invalid","true"),this._displayMessage(this.i18n.required)):(h.set(this.domNode,"aria-invalid","false"),this._clearMessage())},reset:function(){this.clearTags()},focus:function(){f.focus(this.domNode),this._inputTextBox.focus()},prepopulate:function(t){t.forEach(e.hitch(this,function(t,i){this._createTags(t),this._store.remove(t)}))},clearTags:function(){var t,i=c(this._CSS_STYLES.CLASS_SELECTOR+this._CSS_STYLES.CHOICE,s.byId(this.id)),h=!1;i.length>0&&(h=!0,i.forEach(e.hitch(this,function(i,e){try{t=c(this._CHOICE_ALL_SELECTOR,s.byId(this.id))[0].title,this._store.add({tag:t})}catch(h){}o.destroy(i)})),this._tags=[],this._set("value",""))},addStyledTags:function(t,i){r.add(s.byId(i),this._CSS_STYLES.MULTI);var e=o.create("ul",null,s.byId(i));r.add(e,this._CSS_STYLES.CHOICES),a.set(e,"border","none"),t.forEach(function(t,i){var s=o.create("li",null,e);a.set(s,"padding","3px 5px 3px 5px"),r.add(s,"select2-search-resultSet");var h=o.create("div",{title:t},s);d.set(h,t)})},_setTagValues:function(t){var i;"string"==typeof t?i=t.split(","):t&&Array.isArray(t)&&(i=t),this.clearTags(),this.prepopulate(i?this._getUniqueTags(i):[])},_getTagValues:function(){return this._tags?this._tags.join(","):""},_clearMessage:function(){this._displayMessage(null)},_displayMessage:function(t){var i=s.byId(this._tagsId);t&&this.focused?p.show(t,i):p.hide(i)},_resetInputTextBox:function(){this._inputTextBox.set("value","")},_isEmpty:function(t){return 0===t.trim().length},_navigate:function(t,i,e,s){t.length>0&&1>i?("right"===s?this._hightlightTag(t.next()):this._hightlightTag(t.prev()),this._unhighlightTag(t)):1>i&&this._hightlightTag(e)},_contains:function(t,i){return t.indexOf(i)>=0},_hightlightTag:function(t){t.addClass(this._CSS_STYLES.SEARCH_CHOICE_FOCUS)},_unhighlightTag:function(t){t.removeClass(this._CSS_STYLES.SEARCH_CHOICE_FOCUS)},_removeTag:function(t){t&&-1!==this._tags.indexOf(t)&&(this._tags.splice(this._tags.indexOf(t),1),this._set("value",this._tags.join(",")))},_hideGrid:function(){s.byId(this._gridId)&&a.set(s.byId(this._gridId),"display","none"),this._gridHasFocus=!1},_showGrid:function(){a.set(s.byId(this._gridId),"display","block");var t=a.get(s.byId(this._attachmentNode),"width");a.set(s.byId(this._gridId),"width",t+"px")},_setFocusOnFirstRow:function(t,i){return c(".dgrid-content .dgrid-cell",this._grid.domNode)[i]||c(".dgrid-content .dgrid-row",this._grid.domNode)[i]},_createTags:function(t){c(this._CHOICE_FOCUS,s.byId(this.id)).removeClass("select2-search-choice-focus");var i=o.create("li",null,this._autocompleteList);r.add(i,this._CSS_STYLES.CHOICE);var h=o.create("div",{title:t},i);d.set(h,this._htmlEncode(t));var a=o.create("a",{href:"#"},h);r.add(a,this._CSS_STYLES.CLOSE_ICON),_(a,"click",e.hitch(this,function(t){var i=t.target.parentElement.innerText||t.target.parentElement.textContent;try{this._store.add({tag:i})}catch(e){}this._grid.refresh(),this._removeTag(i),o.destroy(t.target.parentNode.parentNode),t.preventDefault()}));var n=S.byId(this._filterId);o.place(n.domNode,this._autocompleteList,"last"),this._hideGrid(),this._tags.push(t),this._set("value",this._tags.join(","))},_renderItem:function(t){return o.create("div",{innerHTML:t.tag})},_createContainerNode:function(){this._containerNode=o.create("div",null,this._attachmentNode),r.add(this._containerNode,this._CSS_STYLES.MULTI),a.set(this._containerNode,{maxWidth:this.maxWidth,minWidth:this.minWidth})},_createTagList:function(){this._autocompleteList=o.create("ul",null,this._containerNode),r.add(this._autocompleteList,this._CSS_STYLES.CHOICES)},_createInput:function(){var t=o.create("li",null,this._autocompleteList,"last");r.add(t,this._CSS_STYLES.SEARCH_FIELD),this._inputTextBox=new C({id:this._filterId,placeHolder:this.i18n.addTags,intermediateChanges:!0,trim:!0,style:{border:"none"}},t),r.add(this._inputTextBox,"input-text-box"),a.set(this._inputTextBox,"width",this.minWidth),(l("ie")>8||l("trident")>4)&&r.add(this._inputTextBox.domNode,"ie-style"),this.own(f.watch("curNode",e.hitch(this,this._blurHandler)))},_createDropDownList:function(){this._dropDownList=o.create("div",{id:this._gridId},this._containerNode),r.add(this._dropDownList,"drop-down-list"),a.set(this._dropDownList,"width",this.minWidth)},_getUniqueTags:function(t){var i,s=[];return t.forEach(e.hitch(this,function(t){i=this._stripHTML(t),v.isDefined(i)&&i.length>0&&s.push(i)})),s.filter(e.hitch(this,function(t,i){return s.indexOf(t)===i}))},_stripHTML:function(t){return t&&t.replace(/<(?:.|\s)*?>/g,"")},_htmlEncode:function(t){return t?u.escape(t):t},_keyupHandler:function(t){var i=this._inputTextBox?this._inputTextBox.get("value").length:0;i>0?this._applyFilter():this._removeFilter()},_keydownHandler:function(t){this._clearMessage();var i,h,r,d,_,l=c(this._CHOICE_FOCUS,s.byId(this.id)),g=c(this._CSS_STYLES.CLASS_SELECTOR+this._CSS_STYLES.CHOICE,s.byId(this.id)).last();switch(void 0!==f.curNode.value&&(_=f.curNode.value.length),t.keyCode){case n.RIGHT_ARROW:this._navigate(l,_,g,"right"),this._hideGrid();break;case n.LEFT_ARROW:this._navigate(l,_,g,"left"),this._hideGrid();break;case n.DOWN_ARROW:t.preventDefault(),this._unhighlightTag(l),"none"===a.get(this._gridId,"display")&&this._showGrid(),this._gridHasFocus||(this._grid.focus(this._setFocusOnFirstRow(this._grid,0)),this._gridHasFocus=!0);break;case n.UP_ARROW:break;case n.BACKSPACE:var C;if(0===_&&0===c(this._CHOICE_FOCUS_ALL).length&&void 0!==c(this._CHOICE_ALL_SELECTOR)[c(this._CHOICE_ALL_SELECTOR).length-1]&&(C=c(this._CHOICE_ALL_SELECTOR)[c(this._CHOICE_ALL_SELECTOR).length-1].title,c("li",this._attachmentNode).length>0&&(o.destroy(g[0]),void 0!==C)))try{this._store.add({tag:C})}catch(S){}if(c(this._CHOICE_FOCUS_ALL).length>0&&(C=c(this._CHOICE_FOCUS_ALL).text(),o.destroy(l[0]),void 0!==C))try{this._store.add({tag:C})}catch(S){}this._grid.refresh(),0===_&&this._hideGrid(),this._removeTag(C),this.validate();break;case n.CTRL:this._metaKeyPressed=!0;break;case n.META:this._metaKeyPressed=!0;break;case n.SHIFT:this._shiftKeyPressed=!0;break;case n.ENTER:if(_>0)i=this._stripHTML(f.curNode.value),h=i.split(","),r=[],h.forEach(function(t,i){-1===r.indexOf(t)&&r.push(u.trim(t))}),r.forEach(e.hitch(this,function(t,i){this._isEmpty(t)||this._contains(this._tags,t)||this._createTags(t)}));else{for(d=0;d<this._selRows.length;d++)this._createTags(this._selRows[d]),this._store.remove(this._selRows[d]);this._shiftKeyPressed=!1,this._metaKeyPressed=!1}this._resetInputTextBox(),t.preventDefault(),f.focus(s.byId(this._filterId));break;case n.TAB:if(f.curNode.id!==this._filterId||0!==_){if(_>0)i=this._stripHTML(f.curNode.value),h=i.split(","),r=[],h.forEach(function(t,i){-1===r.indexOf(t)&&r.push(u.trim(t))}),r.forEach(e.hitch(this,function(t,i){this._isEmpty(t)||this._contains(this._tags,t)||this._createTags(t)}));else{for(d=0;d<this._selRows.length;d++)this._createTags(this._selRows[d]),this._store.remove(this._selRows[d]);this._shiftKeyPressed=!1,this._metaKeyPressed=!1}this._resetInputTextBox(),t.preventDefault(),f.focus(s.byId(this._filterId))}break;case n.ESCAPE:this._hideGrid();break;default:_>-1&&("none"===a.get(s.byId(this._gridId),"display")&&this._showGrid(),this._unhighlightTag(l)),this._metaKeyPressed=!1}},_applyFilter:function(){var t,i=new this._store.Filter,e=this._inputTextBox?this._inputTextBox.get("value")+"":"",s=new RegExp("^"+e.toLowerCase(),"i"),h=new RegExp(e.toLowerCase(),"i");t="first"===this.matchParam?i.match(this._idProperty,s):i.match(this._idProperty,h),this._grid.set("collection",this._store.filter(t)),this._grid.refresh()},_removeFilter:function(){this._grid.set("collection",this._store),this._grid.refresh()},_blurHandler:function(t,i,s){if(!this.focused){var h=this._stripHTML(this._inputTextBox.value);if(h.length>0){var r=[],o=h.split(",");o.forEach(function(t,i){-1===r.indexOf(t)&&r.push(u.trim(t))}),r.forEach(e.hitch(this,function(t,i){this._isEmpty(t)||this._contains(this._tags,t)||this._createTags(t)})),this._resetInputTextBox(),this._hideGrid()}else this._hideGrid()}this.validate()}})});