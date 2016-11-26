// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["../core/declare","./Renderer"],function(f,g){return f(g,{declaredClass:"esri.renderer.TemporalRenderer",constructor:function(a,d,c,b){this.observationRenderer=a;this.latestObservationRenderer=d;this.trackRenderer=c;this.observationAger=b},getSymbol:function(a){var d=a.getLayer(),c=this.getObservationRenderer(a),b=c&&c.getSymbol(a),e=this.observationAger;d.timeInfo&&(d._map.timeExtent&&c===this.observationRenderer&&e&&b)&&(b=e.getAgedSymbol(b,a));return b},getObservationRenderer:function(a){return 0===
a.getLayer()._getKind(a)?this.observationRenderer:this.latestObservationRenderer||this.observationRenderer},toJSON:function(){var a={type:"temporal"};a.observationRenderer=this.observationRenderer.toJSON();this.latestObservationRenderer&&(a.latestObservationRenderer=this.latestObservationRenderer.toJSON());this.trackRenderer&&(a.trackRenderer=this.trackRenderer.toJSON());this.observationAger&&(a.observationAger=this.observationAger.toJSON());return a}})});