var SiteConfig = {
  "environment": "local",
  "route_url": "https://sampleserver3.arcgisonline.com/arcgis/rest/services/Network/USA/NAServer/Route",
  "portal": "https://devext.arcgis.com/sharing",
  "billing": "https://billingdev.arcgis.com/sms/rest",
  "ecas": "https://castest.esri.com/cas",
  "ago": "devext.arcgis.com",
  "ago_maps": ".mapsdevext.arcgis.com",
  "destination": "http://local.arcgis.com:8000",
  "feedback_url": "http://resourcesdev.arcgis.com/apps/feedback/dev_feedback.php",
  "diecomm_guid": "a94107ee-d6da-438d-b30a-54db95894ef3",
  "diecomm_url": "https://qaapp02.xisecurenet.com/diecomm/Preloader/EN.ashx",
  "marketplace": "http://marketplacedevext.arcgis.com",
  "download_server": "https://downloadsdev.arcgis.com",
  "developers_api": "http://localhost:3000"
};

var hostPath = "";
var hostRegEx = /\w+\.(arcgis|esri)\.com/g;
var pathName = document.location.pathname;
var pathNamePartMatch = "";
if (hostRegEx.test(document.location.host)) {
  // --------------------------------------------------------------------
  // Look ahead RegEx match: foo(?=bar)
  // The pattern foo will only match if followed by a match of pattern bar.
  // Matches the url pattern after protocol and host (https://foo.bar.baz)
  // all the way until filename.htm or filename.html
  //
  // /[-_/\w\d]*/(?=(api-reference|sample-code|guide|forum|downloads)?(/[-_/\w\d]*)?([-\w_]+.html?|$))
  //
  // First look for this match against document.location.pathname, get the match result
  //
  // Should match:
  // /javascript/latest/
  // /javascript/latest/api-reference/
  // /javascript/4/api-reference/
  // /javascript/4/bar/baz/api-reference/
  // /javascript/3/api-reference/
  // /javascript/beta3/api-reference/
  // /javascript/4/api-reference/
  // /javascript/4/sample-code/
  // /javascript/4/guide/
  // /javascript/4/forums/
  // /javascript/4/sample-code/foo/bar/baz/
  // /javascript/4/guide/foo/bar/baz/
  // /javascript/4/forums/foo/bar/baz/
  // /javascript/4/forums/foo/bar/baz/
  // --------------------------------------------------------------------
  var pathNamePartRegEx = /\/[-_\/\w\d]*\/(?=(api-reference|sample-code|guide|forum|downloads)?(\/[-_\/\w\d]*)?([-\w_]+(.|\n)html?|$))/gim;
  if (pathNamePartRegEx.test(pathName)) {
    // --------------------------------------------------------------------
    // Matches /filename.htm or /filename.html
    // Any of the /folders/filename.htm or /folders/filename.html
    // Any of the /folders/foo/bar/baz/filename.htm
    // Any of the /folders/foo/bar/baz/filename.html
    //
    // /(api-reference|sample-code|guide|forum|downloads)?(/[-_/\w\d]*)?([-\w_]+.html?[\w#-]*|$)
    //
    // Use this second match with the match of the first to get the URL path
    // before the /assets
    //
    // Should match:
    // /index.html
    // /api-reference/index.html#all-modules-esri_basemap
    // /api-reference/index.html#all-modules-esri_basemap
    // /api-reference/index.html#all-modules-esri_basemap
    // /api-reference/index.html#all-modules-esri_basemap
    // /api-reference/index.html#all-modules-esri_basemap
    // /api-reference/index.html#all-modules-esri_basemap
    // /sample-code/index.html
    // /guide/index.html
    // /forums/index.html
    // /sample-code/foo/bar/baz/index.html
    // /guide/foo/bar/baz/index.html
    // /forums/foo/bar/baz/index.html
    // /forums/foo/bar/baz/index.htm
    // --------------------------------------------------------------------
    var pathNamePartEndRegEx = /\/(api-reference|sample-code|guide|forum|downloads)?(\/[-_\/\w\d]*)?([-\w_]+(.|\n)html?[\w#-]*|$)/gim;

    if (pathNamePartEndRegEx.test(pathName)) {
      var pathNamePartEndMatchArray = pathName.match(pathNamePartEndRegEx);
      if (pathNamePartEndMatchArray.length > 0) {
        var pathNamePart = pathName.replace(pathNamePartEndRegEx, "");
        hostPath = "//" + document.location.host + pathNamePart;
      }
    }
  }

}

var dojoConfig = {
  async: true,
  locale: 'en-us',
  useDeferredInstrumentation: true,
  packages: [
    {
      name: "SessionManager",
      location: hostPath + "/assets/js/loqi/SessionManager"
    }, {
      name: "Manager",
      location: hostPath + "/assets/js/manager"
    }, {
      name: "Notifications",
      location: hostPath + "/assets/js/loqi/Notifications"
    }, {
      name: "Quoin",
      location: hostPath + "/assets/js/loqi/Quoin"
    }, {
      name: "Config",
      location: hostPath + "/assets/js/loqi/Config"
    }, {
      name: "demos",
      location: hostPath + "/assets/js/demos"
    }, {
      name: "documentation",
      location: hostPath + "/assets/js/documentation"
    }, {
      name: "helpers",
      location: hostPath + "/assets/js/helpers"
    }, {
      name: "omnidemo",
      location: hostPath + "/assets/js/omnidemo"
    }, {
      name: "calcite-web",
      location: hostPath + "/assets/js/libs",
      main: "calcite-web"
    }
  ]
};
