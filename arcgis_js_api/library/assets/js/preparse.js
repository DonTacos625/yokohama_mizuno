(function() {
  /*
  Generic cookie handling functions adated from https://developer.mozilla.org/en-US/docs/Web/API/document.cookie#A_little_framework.3A_a_complete_cookies_reader.2Fwriter_with_full_unicode_support
   */
  function getCookie(key) {
    return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(key).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
  }

  function hasCookie(key) {
    return (new RegExp("(?:^|;\\s*)" + encodeURIComponent(key).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=")).test(document.cookie);
  }

  function deleteCookie(key) {
    document.cookie = encodeURIComponent(key) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT;domain=.arcgis.com;";
    document.cookie = encodeURIComponent(key) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT;domain="+ document.domain +";";
    return true;
  }

  // returns the session json object or false
  function getSession() {
    return hasCookie("esri_auth") ? JSON.parse(getCookie("esri_auth")) : false;
  }

  // destorys a session by removing the cookie
  function destroySession() {
    deleteCookie("esri_auth");
  }

  // normalize role names
  function getRole() {
    var role = getSession().role;
    if(role){
      return 'user-role-' + role.replace("account_", "").replace("role_", "");
    } else {
      return "user-public-account";
    }
  }

  window.ArcGIS = window.ArcGIS || {};
  window.ArcGIS.shouldExpireSession = false;

  // if there is no "customBaseUrl" we should destroy the cookie
  //this happened for the change with shared auth with arcgis.com
  // which requires "customBaseUrl"
  if(getSession() && !getSession().customBaseUrl) {
    window.ArcGIS.shouldExpireSession = true;
    destroySession();
  }

  // we should also destory the cookie if ago_maps does not match the custom
  // base url since that means that the org this user belongs to exists on
  // a different environment
  if (getSession() && getSession().role && SiteConfig.ago_maps.indexOf(getSession().customBaseUrl) === -1) {
    window.ArcGIS.shouldExpireSession = true;
    destroySession();
  }

  // if the user is signed in, we should not expire the session and this is the sign in page
  if(getSession() && !window.ArcGIS.shouldExpireSession && window.location.href.match("sign-in")){
    window.location = (getSession().role) ? '/applications/' : '/public-account/';
  }

  // is we are logged in set some body classes to reduce the evil Flash Of Unstyled Content
  if(getSession() && !window.ArcGIS.shouldExpireSession) {
    document.documentElement.className += " logged-in " + getRole();
  } else {
    document.documentElement.className += " logged-out";
  }
})();
