require([
  'SessionManager',
  'dojo/query',
  'dojo/topic',
  'calcite-web',
  'esri/config',
  'documentation/download',
  'dojo/NodeList-dom',
  'dojo/NodeList-manipulate',
  'dojo/NodeList-traverse',
  'dojo/_base/event',
  'dojo/domReady!'
], function(SessionManager, $, topic, calcite, esriConfig) {
  // activate calcite components
  calcite.init();
  window.calcite = calcite;

  // set esri proxy URL
  esriConfig.request.proxyUrl = "/proxy";

  // console polyfill
  if (!window.console) {
    (function() {
      var FNOP = function () {};
      var names = [
        "log", "debug", "info", "warn", "error",
        "assert", "dir", "dirxml", "group", "groupEnd", "time",
        "timeEnd", "count", "trace", "profile", "profileEnd"
      ];

      window.console = {};

      for (var i = 0; i < names.length; i++) {
        window.console[names[i]] = FNOP;
      }
    }());
  }

  function loggedInBehavior() {
    if (SessionManager.loggedIn()){
      $('body').addClass('logged-in');

      var loc = window.location;
      var basePath = loc.origin;
      var isSignUpPage = matchInArray(loc.pathname, ['sign-up', 'developer-beta', 'developer-trial']);
      var isAccountPage = matchInArray(loc.pathname, ['applications', 'usage', 'hosted-data']);
      var isPublicAccount = SessionManager.isPublicAccount();

      if (isPublicAccount && (isSignUpPage || isAccountPage)) {
        window.location = basePath + "/downloads/";
      } else if (!isPublicAccount && isSignUpPage) {
        window.location = basePath + "/applications/";
      }
    }
  }

  // initializes syntax highlighting if hljs is present
  function checkForSyntaxHighlighting() {
    if (window.hljs && Array.prototype.forEach) {
      hljs.initHighlighting();
    }
  }

  // sets up authentication (login/logout) menu
  function setupAuthenticationMenu() {
    topic.subscribe("session:organization", function(){

      $("[data-user-avatar]").forEach(function(element){
        var size = $(element).attr("data-user-avatar")[0];
        element.src = SessionManager.avatar(size);
      });

      $("[data-first-name]").text(SessionManager.firstName());
      $("[data-full-name]").text(SessionManager.profile.fullName);
      $("[data-username]").text(SessionManager.username());
      $("[data-profile-link]").attr("href", SessionManager.developerSubscription() ? "/account/profile" : (SessionManager.orgUrl() + "/home/user.html"));
    });

    // show correct auth nav based on auth status
    if ( SessionManager.loggedIn() ) {
      if ( !!('ontouchstart' in window) ) {
        // disable first link that toggles dropdown menu on touch devices
        $('#logged-in-navigation a').first().on('click', function(e){
          e.preventDefault();
        });
      }
    }

    // bind logout
    var signOutLink = SiteConfig.portal + '/rest/oauth2/signout?redirect_uri=' + SiteConfig.destination;
    $(".js-log-out").attr('href', signOutLink);
  }

  // Make a prettier shift+drag zoomer
  function prettifyShiftDragZoom() {
    var outline    = new esri.symbol.SimpleLineSymbol('solid', new dojo.Color([0,122,194]), 2),
        zoomSymbol = new esri.symbol.SimpleFillSymbol('solid', outline, new dojo.Color([185,224,247,0.5]));

    esri.config.defaults.map.zoomSymbol = zoomSymbol.toJson();
  }

  // Inter-site drop-down menu
  $('body').on('click', function(e){
    var arrow   = $('#down-arrow'),
        logoWrap = $('.logo-wrap');

    if (e.target == arrow[0] && siteNav[0].className !== 'visible'){
      logoWrap.addClass('expanded');
    } else {
      logoWrap.removeClass('expanded');
    }
  });

  function showAccountSettings(){
    if(SessionManager.loggedIn() && SessionManager.developerSubscription()){
      $(".js-account-settings").removeClass("hide");
    }
  }

  function matchInArray (str, arr) {
    for (var i = 0; i < arr.length; i++) {
      if (str.match(arr[i])) {
        return true;
      }
    }
    return false;
  }

  loggedInBehavior();
  checkForSyntaxHighlighting();
  setupAuthenticationMenu();

  if(!SessionManager.organization){
    topic.subscribe('session:organization', function() {
      showAccountSettings();
    });
  }
});
