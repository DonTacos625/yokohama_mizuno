require([
  'dojo/query',
  'dojo/dom-construct',
  'dojo/date/locale',
  'dojo/dom-attr',
  'esri/config',
  'esri/request'
], function ($, domConstruct, locale, domAttr, esriConfig, esriRequest) {

  //not sure the best place for this, I tried putting it in Loqi/SessionManager/main.js but it didn't seem to work
  esriConfig.request.corsEnabledServers.push('webappsproxy.esri.com');

  function buildPost (post) {
    var block = document.createElement('div');
    block.className = 'flexible-block-group-item flexible-block-group-item-white';
    var link = post.resources.html.ref;

    block.innerHTML = ([
      '<div class="flexible-block-group-item-header">',
        '<small>' + formatDate(post.published) + '</small>',
      '</div>',
      '<div class="flexible-block-group-item-content">',
        '<h4 class="leader-half">',
        '<a href="' + link + '">',
        post.subject + '</a>',
        '</h4>',
        '<p>' + codeSnippet(post)  + '</p>',
      '</div>',
      '<div class="flexible-block-group-item-footer">',
        '<a href="' + link + '">Continue reading <span class="icon-ui-right icon-ui-small"></span></a>',
      '</div>',
    ]).join('\n');

    return block;
  }

  function formatDate (date) {
    var formattedDate = '';
    // incoming:  2016-01-14T13:27:45.370+0000
    // converted: 2016-01-14T13:27:45.370+00:00
    // https://www.w3.org/TR/NOTE-datetime
    if (date) {
      var iso_date = date.slice(0, -2) + ":" + date.slice(-2);
      formattedDate = locale.format(new Date(iso_date), {selector: "date", formatLength: "long"});
    }
    return formattedDate;
  }

  function codeSnippet (post) {
    var content = post.content.text.replace(/(<([^>]+)>)/ig,"");
    return truncateDescription (content, 100);
  }

  function truncateDescription (s, maxLength) {
    //borrowed from Sanjib's script
    s = s.replace(/[\n]/g, ' ')
    s = s.substr(0, maxLength);
    // Re-trim in case we are in middle of a word
    s = s.substr(0, Math.min(s.length, s.lastIndexOf(" ")));

    return s
  }

  function getFeed (url) {
   return  esriRequest(url, { responseType: "json" });
  }

  function filterPosts (posts) {
    // only show content that has enough information to be useful in the card, I came across
    // an example with empty strings for the values
    var filteredPosts = [];
    for (var i = 0; i < posts.length; i++) {
      var post = posts[i];
      if (post.subject.length && post.resources.html.ref.length && post.content.text.length) {
        filteredPosts.push(post);
      }
    }
    return filteredPosts;
  }

  $('[data-geonet-feed-url]').forEach(function (feedSection) {
    var geonetRoll = $(feedSection)[0];
    var feedUrl = domAttr.get(geonetRoll, 'data-geonet-feed-url');
    var limit = parseInt(domAttr.get(geonetRoll, 'data-post-limit'), 10) || 10;
    getFeed(feedUrl).then(function (response) {
      var posts = filterPosts(response.data.list);
      for (var i = 0; i < Math.min(posts.length, limit); i++) {
        domConstruct.place(buildPost(posts[i]), geonetRoll);
      }
    });
  });
});
