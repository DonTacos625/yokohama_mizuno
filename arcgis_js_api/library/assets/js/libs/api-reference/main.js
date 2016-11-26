$(function (){
  // Default to the current location.
  var strLocation = window.location.href;
  var strHash = window.location.hash;
  var strPrevLocation = "";
  var strPrevHash = "";

  // --------------------------------------------------------------------
  // Match urls for API reference index page tab content
  // --------------------------------------------------------------------
  var allModulesURLRegEx = /#modules(-in)?/im;
  var allIndexURLRegEx = /#index(-[a-z])?/im;

  // This is how often we will be checkint for
  // changes on the location.
  var intIntervalTime = 100;

  // --------------------------------------------------------------------
  // Update the API reference index page active tab-section.
  // Expands the tab section based upon the URL hash when the page
  // location (hash) is updated and on page load.
  // --------------------------------------------------------------------
  function updateIndexPageTabSection(){
    var hash = document.location.hash;

    if (allModulesURLRegEx.test(hash)) {
      $('.tab-overview').removeClass("is-active");
      $('.tab-all-modules').addClass("is-active");
      $('.tab-all-index').removeClass("is-active");

      $('.tab-section-overview').removeClass("is-active");
      $('.tab-section-all-modules').addClass("is-active");
      $('.tab-section-all-index').removeClass("is-active");
    }
    else if (allIndexURLRegEx.test(hash)) {
      $('.tab-overview').removeClass("is-active");
      $('.tab-all-modules').removeClass("is-active");
      $('.tab-all-index').addClass("is-active");

      $('.tab-section-overview').removeClass("is-active");
      $('.tab-section-all-modules').removeClass("is-active");
      $('.tab-section-all-index').addClass("is-active");
    }
    else {
      $('.tab-overview').addClass("is-active");
      $('.tab-all-modules').removeClass("is-active");
      $('.tab-all-index').removeClass("is-active");

      $('.tab-section-overview').addClass("is-active");
      $('.tab-section-all-modules').removeClass("is-active");
      $('.tab-section-all-index').removeClass("is-active");
    }
  }

  $('.js-tab').click(function (tabClick){
    var href = tabClick.currentTarget.href;

    if (allModulesURLRegEx.test(href)) {
      window.location.hash = "#modules";
    }
    else if (allIndexURLRegEx.test(href)) {
      window.location.hash = "#index";
    }
    else {
      history.pushState("", document.title, window.location.pathname);
    }
  });

  // --------------------------------------------------------------------
  // This method removes the pound from the hash.
  // --------------------------------------------------------------------
  var fnCleanHash = function (strHash){
    return (
      strHash.substring(1, strHash.length)
    );
  };

  // --------------------------------------------------------------------
  // This will be the method that we use to check
  // changes in the window location.
  // --------------------------------------------------------------------
  var fnCheckLocation = function (){
    // Check to see if the location has changed.
    if (strLocation !== window.location.href) {

      // Store the new and previous locations.
      strPrevLocation = strLocation;
      strPrevHash = strHash;
      strLocation = window.location.href;
      strHash = window.location.hash;

      // The location has changed. Trigger a
      // change event on the location object,
      // passing in the current and previous
      // location values.
      $(window.location).trigger(
        "change",
        {
          currentHref: strLocation,
          currentHash: fnCleanHash(strHash),
          previousHref: strPrevLocation,
          previousHash: fnCleanHash(strPrevHash)
        }
      );
    }
  };

  // --------------------------------------------------------------------
  // Set an interval to check the location changes.
  // --------------------------------------------------------------------
  setInterval(fnCheckLocation, intIntervalTime);

  // --------------------------------------------------------------------
  // Listen to the change event that was wired up in the fnCheckLocation
  // function using the "trigger"
  // --------------------------------------------------------------------
  $(window.location).bind("change", function (){
    updateIndexPageTabSection();
  });
  // --------------------------------------------------------------------
  // Select the appropriate tab-section on the index page load due to the
  // appropriate page matching the url requested.
  // --------------------------------------------------------------------
  updateIndexPageTabSection();

});

