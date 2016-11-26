define([], function () {
  var callbacks = 0;

  return function jsonp (url, params, callback, context) {
    window._BlogJs = window._BlogJs || {};
    var callbackId = 'c' + callbacks;

    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = url + params + '&callback=' + 'window._BlogJs.' + callbackId;
    script.id = callbackId;

    window._BlogJs[callbackId] = function (response) {
      if (window._BlogJs[callbackId] !== true) {
        var error;
        var responseType = Object.prototype.toString.call(response);

        if (!(responseType === '[object Object]' || responseType === '[object Array]')) {
          error = {
            error: {
              code: 500,
              message: 'Expected array or object as JSONP response'
            }
          };
          response = null;
        }

        if (!error && response.error) {
          error = response;
          response = null;
        }

        callback.call(context, error, response);
        window._BlogJs[callbackId] = true;
      }
    };

    callbacks++;
    document.getElementsByTagName("head")[0].appendChild(script);
  }
});