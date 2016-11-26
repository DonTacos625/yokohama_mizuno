// On document ready
window.onload = function (){
  // Initialize all calcite.js patterns
  if (window.calcite) {
    calcite.init();

    if (document.querySelector(".feedback .icon-ui-contact")) {
      var feedbackHref = document.querySelector(".feedback .icon-ui-contact");
      var replacedTitle = feedbackHref.href.replace("{REPLACE_TITLE}", encodeURIComponent(document.title));
      feedbackHref.href = replacedTitle.replace("{REPLACE_URL}", encodeURIComponent(document.location.href));
    }

    if (document.querySelector(".sample-code-livesample-container.sample-code-3d")) {
      var sampleIFrame = document.querySelector(".sample-code-livesample-container");
      var sampleWarning = document.querySelector(".sample-code-livesample-warning-panel");
      if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|Opera Mini|IEMobile/i.test(navigator.userAgent)) {
        calcite.addClass(sampleIFrame, "hide");
        calcite.toggleClass(sampleWarning, "hide");
        if (document.querySelector(".sample-code-links-container.action-bar")) {
          var sampleLinks = document.querySelector(".sample-code-links-container.action-bar");
          calcite.addClass(sampleLinks, "hide");
        }
      }
    }

    if (document.querySelector("#sample-code-search") || document.querySelector("#sample-code-search-drawer")) {
      var samplesSearchNode = document.querySelector("#sample-code-search");
      var samplesSearchDrawerNode = document.querySelector("#sample-code-search-drawer");
      var sampleContentContainerNode = document.querySelector(".sample-code-container .sample-content-container");
      var sampleSearchContentContainerNode = document.querySelector(".sample-code-container .sample-search-content-container");
      var sampleSearchTBodyNode = document.querySelector(".sample-code-container .sample-search-content-container tbody");
      var sampleSearchTableNode = document.querySelector(".sample-code-container .sample-search-content-container table");
      var sampleSearchNoResultsNode = document.querySelector(".sample-code-container .sample-search-content-container .sample-search-no-results");

      var locationHref = document.location.href;
      var sampleCodeBaseURLRegEx = /https?:\/\/([\da-zA-Z\.-]+\.([a-z\.]){2,6}|localhost):?[\/\w\.-]*(?=sample-code)/gm;
      var preURL = locationHref.match(sampleCodeBaseURLRegEx) ? locationHref.match(sampleCodeBaseURLRegEx)[0] : "";
      var sandboxURL = preURL + "sample-code/sandbox/sandbox.html?sample=";

      function samplesSearchEvent(event){
        var sampleSearchTerm = event.target.value;
        if (sampleSearchTerm) {
          sampleContentContainerNode.style.display = "none";
          sampleSearchContentContainerNode.style.display = "block";

          // --------------------------------------------------------------------
          // Search the lunr.js sample code index
          // --------------------------------------------------------------------
          var sampleSearchResults = sampleCodeSearchIndex.search(sampleSearchTerm);
          if (sampleSearchResults.length > 0) {

            var innerHTML = "";
            for (var sampleResult in sampleSearchResults) {
              var result = sampleCodeSearchData[sampleSearchResults[sampleResult].ref];
              var titleLink = "<a href='" + preURL + result.page_url + "'>" + result.title + "</a>";
              var sourceLink = "<div class=\"sample-code-action-bar inline-block\">";
              sourceLink += "<a class=\"btn btn-clear btn-small sample-code-action-bar-btn\" href='" + preURL + result.live_link + "'>View live</a>";
              if (result.sandbox) {
                sourceLink += "<a class=\"btn btn-small sample-code-action-bar-btn phone-trailer-1\" href='" + sandboxURL + result.sample_name + "'>Explore in sandbox</a>";
              }
              else {
                sourceLink += "<a class=\"btn btn-disabled btn-small sample-code-action-bar-btn phone-trailer-1\">Explore in sandbox</a>";
              }
              sourceLink += "</div>";
              innerHTML += "<tr><td>" + titleLink + "</td><td>" + sourceLink + "</td></tr>";
            }
            sampleSearchTBodyNode.innerHTML = innerHTML;
            sampleSearchNoResultsNode.style.display = "none";
            sampleSearchTableNode.style.display = "table";
          }
          else {
            sampleSearchTableNode.style.display = "none";
            sampleSearchNoResultsNode.style.display = "block";
          }
        }
        else {
          sampleContentContainerNode.style.display = "block";
          sampleSearchContentContainerNode.style.display = "none";
          sampleSearchNoResultsNode.style.display = "none";
        }
      }

      calcite.addEvent(samplesSearchNode, "keyup", samplesSearchEvent);
      calcite.addEvent(samplesSearchDrawerNode, "keyup", samplesSearchEvent);
    }

    if (document.querySelector("#api-ref-search") || document.querySelector("#api-ref-search-drawer")) {
          var apiRefSearchNode = document.querySelector("#api-ref-search");
          var apiRefSearchDrawerNode = document.querySelector("#api-ref-search-drawer");
          var apiRefContentContainerNode = document.querySelector(".api-ref-container .api-ref-content-container");
          var apiRefSearchContentContainerNode = document.querySelector(".api-ref-container .api-ref-search-content-container");
          var apiRefSearchTBodyNode = document.querySelector(".api-ref-container .api-ref-search-content-container tbody");
          var apiRefSearchTableNode = document.querySelector(".api-ref-container .api-ref-search-content-container table");
          var apiRefSearchNoResultsNode = document.querySelector(".api-ref-container .api-ref-search-content-container .api-ref-search-no-results");

          function apiRefSearchClickEvent(){
            apiRefContentContainerNode.style.display = "block";
            apiRefSearchContentContainerNode.style.display = "none";
          }

          function apiRefSearchEvent(event){
            var apiRefSearchTerm = event.target.value;
            if (apiRefSearchTerm) {
              apiRefContentContainerNode.style.display = "none";
              apiRefSearchContentContainerNode.style.display = "block";

              // --------------------------------------------------------------------
              // Search the lunr.js sample code index
              // --------------------------------------------------------------------
              var apiRefSearchResults = apiRefSearchIndex.search(apiRefSearchTerm);
              if (apiRefSearchResults.length > 0) {
                var searchResultsArray = apiRefSearchResults.map(function (item){
                  return apiRefSearchData[item.ref];
                });
                var sortedResults = searchResultsArray.sort(function(a, b) {
                  return b.rank - a.rank;
                });
                var innerHTML = "";
                sortedResults.forEach(function (result) {
                  innerHTML += "<tr><td>" + result.html + "</td><td>" + result.type + "</td><td>" + result.package + "/<a href='" + result.page_url + "'>" + result.class + "</a></td></tr>";
                });
                apiRefSearchTBodyNode.innerHTML = innerHTML;
                apiRefSearchNoResultsNode.style.display = "none";
                apiRefSearchTableNode.style.display = "table";
                $("div.api-ref-search-content-container table a").on( "click", { foo: "bar" }, apiRefSearchClickEvent );
              }
              else {
                apiRefSearchTableNode.style.display = "none";
                apiRefSearchNoResultsNode.style.display = "block";
              }
            }
            else {
              apiRefContentContainerNode.style.display = "block";
              apiRefSearchContentContainerNode.style.display = "none";
              apiRefSearchNoResultsNode.style.display = "none";
            }
          }

          calcite.addEvent(apiRefSearchNode, "keyup", apiRefSearchEvent);
          calcite.addEvent(apiRefSearchDrawerNode, "keyup", apiRefSearchEvent);
        }
    //end
  }
};

