// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
require({cache:{"url:esri/widgets/Locate/templates/Locate.html":'\x3cdiv role\x3d"button" tabindex\x3d"0"\x3e\r\n  \x3cspan data-dojo-attach-point\x3d"_iconNode" aria-hidden\x3d"true" class\x3d"${_css.icon} ${_css.locate}" title\x3d"${_i18n.title}"\x3e\x3c/span\x3e\r\n  \x3cspan class\x3d"${_css.text}"\x3e${_i18n.title}\x3c/span\x3e\r\n\x3c/div\x3e\r\n'}});
define("./Locate/LocateViewModel ./support/viewModelWiring ./Widget ../core/watchUtils dijit/a11yclick dijit/_TemplatedMixin dojo/on dojo/dom-class dojo/i18n!./Locate/nls/Locate dojo/text!./Locate/templates/Locate.html".split(" "),function(e,a,f,g,h,k,l,c,m,n){var b={base:"esri-locate esri-widget-button",text:"esri-icon-font-fallback-text",icon:"esri-icon",locate:"esri-icon-locate",loading:"esri-rotating esri-icon-loading-indicator",disabled:"esri-disabled"};return f.createSubclass([k],{declaredClass:"esri.widgets.Locate",
baseClass:b.base,templateString:n,postCreate:function(){this.inherited(arguments);this.own(l(this.domNode,h,this.viewModel.locate),g.init(this.viewModel,"state",function(d){"feature-unsupported"===d&&(this.visible=!1);var a="locating"===d;c.toggle(this.domNode,b.disabled,"disabled"===d);c.toggle(this._iconNode,b.loading,a);c.toggle(this._iconNode,b.locate,!a)}.bind(this)));a.setUpEventDelegates(this,["locate","locate-error"])},_css:b,_i18n:m,properties:{geolocationOptions:{aliasOf:"viewModel.geolocationOptions"},
goToLocationEnabled:{aliasOf:"viewModel.goToLocationEnabled"},graphic:{aliasOf:"viewModel.graphic"},view:{aliasOf:"viewModel.view"},viewModel:{type:e}},locate:a.createMethodDelegate("locate")})});