define([
  "dojo/_base/declare",
  "dijit/_TemplatedMixin",
  "dojo/_base/lang",
  "Quoin/Handlebars"
], function(declare, _TemplatedMixin, lang, Handlebars){
  return declare("Quoin.HandlebarsTemplated", _TemplatedMixin, {
    // this prevents _Templated from storing the template as a domNode to clone()
    // which helps in templates not requiring substitution, but we'll assume we always need to
    _skipNodeCache: true,

    _stringRepl: function(template) {
      var rendering = Handlebars.compile(template);
      return lang.trim(rendering(this)); // trim whitespace
    }
  });
});