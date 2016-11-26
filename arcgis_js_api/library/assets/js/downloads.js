require([
  'calcite-web'
], function (calcite) {
  var versions = calcite.nodeListToArray(document.querySelectorAll('.js-version'));

  function switchVersions (e) {

    // var i;
    var sdkVersion = calcite.eventTarget(e).getAttribute('data-sdk');

    var versionBreakdown = sdkVersion.split('-');
    var sdk = versionBreakdown[0];
    var version = versionBreakdown[versionBreakdown.length - 1];

    // // update the checkmarks
    var checkmarks = calcite.nodeListToArray(document.querySelectorAll('.js-version[data-sdk^=' + sdk + ']'));

    for (i = checkmarks.length - 1; i >= 0; i--) {
      calcite.removeClass(checkmarks[i], 'version-is-active');
    }

    // // update the text
    calcite.addClass(calcite.eventTarget(e), 'version-is-active');
    calcite.nodeListToArray(calcite.closest('dropdown', calcite.eventTarget(e)).querySelectorAll('.js-dropdown-toggle'))[0].innerText = 'Version ' + version;

    // toggle the versions
    var allVersions = calcite.nodeListToArray(document.querySelectorAll('.js-download[data-sdk^=' + sdk + ']'));
    var showVersions = calcite.nodeListToArray(document.querySelectorAll('.js-download[data-sdk="' + sdkVersion + '"]'));

    for (i = allVersions.length - 1; i >= 0; i--) {
      calcite.addClass(allVersions[i], 'hide');
    }

    for (i = showVersions.length - 1; i >= 0; i--) {
      calcite.removeClass(showVersions[i], 'hide');
    }

    calcite.preventDefault(e);
  }

  for (var i = versions.length - 1; i >= 0; i--) {
    calcite.addEvent(versions[i], calcite.click(), switchVersions);
  }
});
