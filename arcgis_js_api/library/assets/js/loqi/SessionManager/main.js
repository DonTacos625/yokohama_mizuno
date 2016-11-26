define([
  "dojo/_base/declare",
  "dojo/_base/lang",
  "dojo/cookie",
  "dojo/topic",
  "dojo/query",
  "dojo/dom-construct",
  "Notifications",
  "esri/config",
  "esri/request",
  "esri/core/urlUtils"
], function(declare, lang, cookie, topic, $, domConstruct, NotificationManager, esriConfig, request, urlUtils){
  var validRedirects = /^(https?:\/\/(arcgis.com|esri.com|.+.arcgis.com|.+.esri.com)|\/)/;

    // referring to a non-existing EsriLeaflet object
  //if(esri && esri.id){
  //  esri.id._doPortalSignIn = function() {
  //    return false;
  //  };
  //}

  esriConfig.request.proxyUrl = "/proxy";
  esriConfig.request.corsEnabledServers.push(SiteConfig.billing);
  esriConfig.request.corsEnabledServers.push(SiteConfig.download_server);
  esriConfig.request.corsEnabledServers.push("https://geotriggerstg.arcgis.com");
  esriConfig.request.corsEnabledServers.push("https://geotriggerdev.arcgis.com");
  esriConfig.request.corsEnabledServers.push("https://geotrigger.arcgis.com");
  esriConfig.request.corsEnabledServers.push("https://portalette.geotrigger.arcgis.com");
  esriConfig.request.corsEnabledServers.push("https://portalettestg.geotrigger.arcgis.com");

  var Manager = declare([], {

    constructor: function(parameters) {
      lang.mixin(this, parameters);
    },

    _callbacks: [],

    ready:false,

    get_gravatar: function(email, size) {
      var MD5=function(s){function L(k,d){return(k<<d)|(k>>>(32-d))}function K(G,k){var I,d,F,H,x;F=(G&2147483648);H=(k&2147483648);I=(G&1073741824);d=(k&1073741824);x=(G&1073741823)+(k&1073741823);if(I&d){return(x^2147483648^F^H)}if(I|d){if(x&1073741824){return(x^3221225472^F^H)}else{return(x^1073741824^F^H)}}else{return(x^F^H)}}function r(d,F,k){return(d&F)|((~d)&k)}function q(d,F,k){return(d&k)|(F&(~k))}function p(d,F,k){return(d^F^k)}function n(d,F,k){return(F^(d|(~k)))}function u(G,F,aa,Z,k,H,I){G=K(G,K(K(r(F,aa,Z),k),I));return K(L(G,H),F)}function f(G,F,aa,Z,k,H,I){G=K(G,K(K(q(F,aa,Z),k),I));return K(L(G,H),F)}function D(G,F,aa,Z,k,H,I){G=K(G,K(K(p(F,aa,Z),k),I));return K(L(G,H),F)}function t(G,F,aa,Z,k,H,I){G=K(G,K(K(n(F,aa,Z),k),I));return K(L(G,H),F)}function e(G){var Z;var F=G.length;var x=F+8;var k=(x-(x%64))/64;var I=(k+1)*16;var aa=Array(I-1);var d=0;var H=0;while(H<F){Z=(H-(H%4))/4;d=(H%4)*8;aa[Z]=(aa[Z]|(G.charCodeAt(H)<<d));H++}Z=(H-(H%4))/4;d=(H%4)*8;aa[Z]=aa[Z]|(128<<d);aa[I-2]=F<<3;aa[I-1]=F>>>29;return aa}function B(x){var k="",F="",G,d;for(d=0;d<=3;d++){G=(x>>>(d*8))&255;F="0"+G.toString(16);k=k+F.substr(F.length-2,2)}return k}function J(k){k=k.replace(/rn/g,"n");var d="";for(var F=0;F<k.length;F++){var x=k.charCodeAt(F);if(x<128){d+=String.fromCharCode(x)}else{if((x>127)&&(x<2048)){d+=String.fromCharCode((x>>6)|192);d+=String.fromCharCode((x&63)|128)}else{d+=String.fromCharCode((x>>12)|224);d+=String.fromCharCode(((x>>6)&63)|128);d+=String.fromCharCode((x&63)|128)}}}return d}var C=Array();var P,h,E,v,g,Y,X,W,V;var S=7,Q=12,N=17,M=22;var A=5,z=9,y=14,w=20;var o=4,m=11,l=16,j=23;var U=6,T=10,R=15,O=21;s=J(s);C=e(s);Y=1732584193;X=4023233417;W=2562383102;V=271733878;for(P=0;P<C.length;P+=16){h=Y;E=X;v=W;g=V;Y=u(Y,X,W,V,C[P+0],S,3614090360);V=u(V,Y,X,W,C[P+1],Q,3905402710);W=u(W,V,Y,X,C[P+2],N,606105819);X=u(X,W,V,Y,C[P+3],M,3250441966);Y=u(Y,X,W,V,C[P+4],S,4118548399);V=u(V,Y,X,W,C[P+5],Q,1200080426);W=u(W,V,Y,X,C[P+6],N,2821735955);X=u(X,W,V,Y,C[P+7],M,4249261313);Y=u(Y,X,W,V,C[P+8],S,1770035416);V=u(V,Y,X,W,C[P+9],Q,2336552879);W=u(W,V,Y,X,C[P+10],N,4294925233);X=u(X,W,V,Y,C[P+11],M,2304563134);Y=u(Y,X,W,V,C[P+12],S,1804603682);V=u(V,Y,X,W,C[P+13],Q,4254626195);W=u(W,V,Y,X,C[P+14],N,2792965006);X=u(X,W,V,Y,C[P+15],M,1236535329);Y=f(Y,X,W,V,C[P+1],A,4129170786);V=f(V,Y,X,W,C[P+6],z,3225465664);W=f(W,V,Y,X,C[P+11],y,643717713);X=f(X,W,V,Y,C[P+0],w,3921069994);Y=f(Y,X,W,V,C[P+5],A,3593408605);V=f(V,Y,X,W,C[P+10],z,38016083);W=f(W,V,Y,X,C[P+15],y,3634488961);X=f(X,W,V,Y,C[P+4],w,3889429448);Y=f(Y,X,W,V,C[P+9],A,568446438);V=f(V,Y,X,W,C[P+14],z,3275163606);W=f(W,V,Y,X,C[P+3],y,4107603335);X=f(X,W,V,Y,C[P+8],w,1163531501);Y=f(Y,X,W,V,C[P+13],A,2850285829);V=f(V,Y,X,W,C[P+2],z,4243563512);W=f(W,V,Y,X,C[P+7],y,1735328473);X=f(X,W,V,Y,C[P+12],w,2368359562);Y=D(Y,X,W,V,C[P+5],o,4294588738);V=D(V,Y,X,W,C[P+8],m,2272392833);W=D(W,V,Y,X,C[P+11],l,1839030562);X=D(X,W,V,Y,C[P+14],j,4259657740);Y=D(Y,X,W,V,C[P+1],o,2763975236);V=D(V,Y,X,W,C[P+4],m,1272893353);W=D(W,V,Y,X,C[P+7],l,4139469664);X=D(X,W,V,Y,C[P+10],j,3200236656);Y=D(Y,X,W,V,C[P+13],o,681279174);V=D(V,Y,X,W,C[P+0],m,3936430074);W=D(W,V,Y,X,C[P+3],l,3572445317);X=D(X,W,V,Y,C[P+6],j,76029189);Y=D(Y,X,W,V,C[P+9],o,3654602809);V=D(V,Y,X,W,C[P+12],m,3873151461);W=D(W,V,Y,X,C[P+15],l,530742520);X=D(X,W,V,Y,C[P+2],j,3299628645);Y=t(Y,X,W,V,C[P+0],U,4096336452);V=t(V,Y,X,W,C[P+7],T,1126891415);W=t(W,V,Y,X,C[P+14],R,2878612391);X=t(X,W,V,Y,C[P+5],O,4237533241);Y=t(Y,X,W,V,C[P+12],U,1700485571);V=t(V,Y,X,W,C[P+3],T,2399980690);W=t(W,V,Y,X,C[P+10],R,4293915773);X=t(X,W,V,Y,C[P+1],O,2240044497);Y=t(Y,X,W,V,C[P+8],U,1873313359);V=t(V,Y,X,W,C[P+15],T,4264355552);W=t(W,V,Y,X,C[P+6],R,2734768916);X=t(X,W,V,Y,C[P+13],O,1309151649);Y=t(Y,X,W,V,C[P+4],U,4149444226);V=t(V,Y,X,W,C[P+11],T,3174756917);W=t(W,V,Y,X,C[P+2],R,718787259);X=t(X,W,V,Y,C[P+9],O,3951481745);Y=K(Y,h);X=K(X,E);W=K(W,v);V=K(V,g)}var i=B(Y)+B(X)+B(W)+B(V);return i.toLowerCase()};
      var size = size || 80;
      return '//www.gravatar.com/avatar/' + MD5(email) + '.jpg?s=' + size;
    },

    // redirect to a url with optional query params
    redirect: function (url, parameters) {
      if(!validRedirects.test(url)){
        url = 'http://developers.arcgis.com';
      }
      if (parameters) {
        parameters = dojo.objectToQuery(parameters);
      }
      window.location = url + (parameters ? ("?" + parameters) : "");
    },

    queue: function(func){
      if(this.ready){
        func();
      } else {
        this._callbacks.push(func);
      }
    },

    // will return a link to the users ArcGIS avatar, or a link to their gravatar, or a link to the default profile image.
    avatar: function(size){
      if(this.profile.thumbnail){
        return "https://" + SiteConfig.ago + "/sharing/rest/community/users/" + this.username() + "/info/" + this.profile.thumbnail + "?token=" + this.token();
      }
      return this.get_gravatar(this.profile.email, (size || 18)) + "&d=mm";
    },

    // is the user logged in?
    loggedIn: function(){
      return !!this.token();
    },

    displayName: function(){
      if(this.profile){
        return profile.fullName || this.username() || profile.email || "Your Account";
      }
      return this.username();
    },

    orgId: function(){
      if(this.organization){
        return this.organization.id;
      } else if(cookie("esri_auth")) {
        return JSON.parse(cookie("esri_auth")).accountId;
      }
      return undefined;
    },

    orgUrlKey: function(){
      if(this.organization){
        return this.organization.urlKey;
      } else if(cookie("esri_auth")) {
        return JSON.parse(cookie("esri_auth")).urlKey;
      }
      return undefined;
    },

    orgUrl: function(){
      if(this.organization){
        var ssl = (this.organization.allSSL) ? "https://" : "http://";
        return  ssl + this.orgUrlKey() + SiteConfig.ago_maps;
      }
      return undefined;
    },

    // get the token
    token: function(){
      if(cookie("esri_auth")){
        return JSON.parse(cookie("esri_auth")).token;
      }
      return false;
    },

    role: function(){
      var sessionData = JSON.parse(cookie("esri_auth"));

      if(sessionData){
        return (sessionData.role) ? sessionData.role.replace("org_", "").replace("account_", "") : false;
      }

      return false;
    },

    isAdmin: function(){
      return this.role() === "admin";
    },

    // get the username
    username: function(){
      if(this.profile){
        return this.profile.username;
      } else if(cookie("esri_auth")) {
        return JSON.parse(cookie("esri_auth")).email;
      }
      return undefined;
    },

    // get the userId
    userId: function(){
      return this.username();
    },

    // require a session to access this page... this will kick the user to the login page if they are not logged in.
    requireSession: function(){
      //when we require a login for a page
      if(!this.loggedIn()){
        this.redirect("/sign-in", {
          "redirect_uri":  window.encodeURIComponent(window.location.href)
        });
      }
    },

    // destory the users session and redirect them to the hompage
    logout: function(){
      redirect('https://www.arcgis.com/sharing/rest/oauth2/signout', {
        redirect_uri: SiteConfig.destination
      });
    },

    developerSubscription: function(){
      if(this.organization && this.organization.subscriptionInfo && (this.organization.subscriptionInfo.type === "Trial Developer" || this.organization.subscriptionInfo.type === "Developer")){
        return true;
      }
      return undefined;
    },

    developer: function(){
      return this.developerSubscription();
    },

    trial: function(){
      if(this.organization && this.organization.subscriptionInfo.type.match(/Trial/)){
        return true;
      }
      return undefined;
    },

    expired: function(){
      if(this.organization && this.organization.subscriptionInfo && this.organization.subscriptionInfo.state === "expired"){
        return true;
      }
      return undefined;
    },

    suspended: function(){
      if(this.organization && this.organization.subscriptionInfo && this.organization.subscriptionInfo.state === "suspended"){
        return true;
      }
      return undefined;
    },

    firstName: function(){
      // split name on space period or underscore (some gov/enterprise customers have wired naming structure)
      return this.profile.fullName.split(/ |\.|_/)[0];
    },

    // this gets called after signin is complete and checks if the user has a public account
    finishSignin: function(href) {
      var defaultRedirect = (this.isPublicAccount()) ? "/public-account/" : "/applications/";
      var query = urlUtils.urlToObject(window.location.href).query;
      var redirect = (query && query.redirect_uri) ? query.redirect_uri : defaultRedirect;
      this.redirect(redirect);
    },

    isPublicAccount: function(){
      if(!cookie("esri_auth")){
        return false;
      }
      return (JSON.parse(cookie("esri_auth")).role) ? false : true;
    }
  });

  //setup our new identity manager
  window.ArcGIS = window.ArcGIS || {};
  window.ArcGIS.Session = new Manager();

  // load the session if we have one
  var rawCookie = cookie("esri_auth");
  var sessionCookie = (rawCookie) ? JSON.parse(rawCookie) : undefined;

  // if we have a session...
  if(sessionCookie && !window.ArcGIS.shouldExpireSession) {

    // request org and user info
    request({
      url: SiteConfig.portal + "/rest/portals/self",
      content: {
        token: ArcGIS.Session.token(),
        f: "json"
      }
    }).then(function(selfResponse){
      // callback
      ArcGIS.Session.profile = selfResponse.user;
      ArcGIS.Session.organization = selfResponse;
      topic.publish("session:organization");
      // request info about the users subscription
      request({
        url : SiteConfig.billing + '/subscription',
        content : {
          token: ArcGIS.Session.token(),
          f : 'json'
        }
      }).then(function(subscriptionInfo){
        ArcGIS.Session.subscription = subscriptionInfo.subscription;
        ArcGIS.Session.ready = true;
        for (var i = ArcGIS.Session._callbacks.length - 1; i >= 0; i--) {
          ArcGIS.Session._callbacks[i]();
        }
        topic.publish("session:ready");
      }, function(error){
        ArcGIS.Session.logout();
        document.location.reload(true);
        // ArcGIS.Session.redirect("/sign-in", {
        //   "redirect_uri":  window.encodeURIComponent(window.location.href)
        // });
      });

    }, function(error){
      ArcGIS.Session.logout();
      document.location.reload(true);
      // ArcGIS.Session.redirect("/sign-in", {
      //   "redirect_uri":  window.encodeURIComponent(window.location.href)
      // });
    });

    // this add a series of checks against the state of the subscription. active|suspended|expired
    ArcGIS.Session.queue(function(){
      var isExpiredOrSuspended = ArcGIS.Session.expired() || ArcGIS.Session.suspended();
      var isAccountPage = $("#account-alerts").length;

      if (!isAccountPage || !isExpiredOrSuspended) {
        return;
      }

      var accountNotifications = new NotificationManager($("#account-notifications")[0]);

      var isExpiredDev = ArcGIS.Session.developer() && ArcGIS.Session.expired();
      var isSuspendedDev = ArcGIS.Session.developer() && ArcGIS.Session.suspended();
      var isInactiveOrg = !ArcGIS.Session.developer();

      // dev and expired. Send to plans page to renew
      if (isExpiredDev) {
        accountNotifications.error("It looks like your account has expired. You won't be able to create new applications or feature services until you <a href='\/account\/modify-plan\/'>renew your account<\/a>.");
      }

      // dev and suspended. Send to plans page or tell them to wait until the end of the month for more credits
      if (isSuspendedDev) {
        accountNotifications.error("Looks like you went over your credit limit for this month. You won't be able to create new applications or feature services. You can either <a href='\/account\/modify-plan\/'>upgrade to a larger plan<\/a> or wait until next month.");
      }

      // org and not active send to ago org page
      if (isInactiveOrg) {
        var msg = " <a href='" + ArcGIS.Session.orgUrl() + "/home/organization.html'>" + "Upgrade Subscription" + "</a>";
        accountNotifications.error("Your subscription has been suspended or has expired." + msg);
      }
    });

  }

  return window.ArcGIS.Session;
});
