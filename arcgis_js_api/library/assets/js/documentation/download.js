require([
  'SessionManager',
  'esri/request',
  'dojo/query',
  'esri/core/urlUtils',
  'dojo/_base/event',
  'dojo/NodeList-manipulate'
], function (SessionManager, request, $, urlUtils, event) {

  function downloadFile(url) {
    $('body').append('<iframe src="' + url + '" style="display:none;"></iframe>');
  }

  function getDownloadLink(filename, folder){
    return esri.request({
      url: SiteConfig.download_server + '/dms/rest/download/secured/' + filename,
      content: {
        token: SessionManager.token(),
        folder: folder
      }
    }).then(function(response){
      if(response.code === 200){
        return response.url;
      }
    }, function(error){});
  }

  function initiateDownload (filename, folder) {
    if(SessionManager.loggedIn()){
      var accountType = (SessionManager.organization && SessionManager.organization.subscriptionInfo) ? SessionManager.organization.subscriptionInfo.type : 'Public';
      getDownloadLink(filename, folder).then(downloadFile);
      ga('send', 'event', 'SDK Downloads', 'File Download', filename);
      ga('send', 'event', 'SDK Downloads', 'Account Type', accountType);
    } else {
      SessionManager.redirect('/sign-in', {
        redirect_uri: window.location.href.replace(window.location.search, "") + '?filename=' + filename + "&folder=" + folder
      });
    }
  }

  function autoStartDownload (argument) {
    var query = urlUtils.urlToObject(window.location.href).query;
    if (query && query.filename && query.folder) {
      initiateDownload(query.filename, query.folder);
      history.replaceState({}, '', location.pathname)
    }
  }

  $('.download-link').on('click', function (e){
    event.stop(e);
    var el = $(this);
    var filename = el.attr('data-filename')[0];
    var folder = el.attr('data-folder')[0];
    initiateDownload(filename, folder);
  });

  autoStartDownload();
});
