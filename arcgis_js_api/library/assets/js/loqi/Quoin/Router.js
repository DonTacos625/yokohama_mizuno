define([
  "dojo/_base/declare",
  "dojo/_base/lang",
  "dojox/lang/functional/object",
  "dojo/Evented",
  "dojo/topic",
  "Quoin/History",
  "Quoin/Base"
], function(declare, lang, object, Evented, topic, History, Base){

  // Cached regular expressions for matching named param parts and splatted
  // parts of route strings.
  var optionalParam = /\((.*?)\)/g;
  var namedParam    = /(\(\?)?:\w+/g;
  var splatParam    = /\*\w+/g;
  var escapeRegExp  = /[\-{}\[\]+?.,\\\^$|#\s]/g;

  var Router = declare("Quoin.Router", [Evented, Base], {
    route: function(route, name, callback) {
      //if the route is not a regular expression turn it into one
      if (!(route instanceof RegExp)) {
        route = this._routeToRegExp(route);
      }

      // call History.route
      History.route(route, lang.hitch(this, function(fragment) {
        var args = this._extractParameters(route, fragment);
        var routeEvent = {
          name:name,
          args:args
        };
        if(callback){
          callback.apply(this, args);
        }
        this.emit('route:' + name, routeEvent);
        this.emit('route', routeEvent);
        History.emit('route', routeEvent);
      }));

      return this;
    },
    navigate: function(fragment, options) {
      History.navigate(fragment, options);
      return this;
    },
    _bindRoutes: function() {
      if (!this.routes) return;
      var route, routes = object.keys(this.routes);
      while ((route = routes.pop()) !== null) {
        this.route(route, this.routes[route]);
      }
    },
    _routeToRegExp: function(route) {
      route = route.replace(escapeRegExp, '\\$&')
                   .replace(optionalParam, '(?:$1)?')
                   .replace(namedParam, function(match, optional){
                     return optional ? match : '([^\/]+)';
                   })
                   .replace(splatParam, '(.*?)');
      return new RegExp('^' + route + '$');
    },
    _extractParameters: function(route, fragment) {
      return route.exec(fragment).slice(1);
    }
  });

  return new Router();
});
