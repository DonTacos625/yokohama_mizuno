require([
  'documentation/jsonp',
  'dojo/query',
  'dojo/dom-construct',
  'dojo/date/locale',
  'dojo/dom-attr'
], function (jsonp, $, domConstruct, locale, domAttr) {

  function buildPost (post, blockPanelClass) {
    var block = document.createElement('div');
    block.className = 'block trailer-1';

    if ( ! blockPanelClass) { // should be one of the established panel modifiers, such as panel-white, etc.
      blockPanelClass = 'panel';
    }
    block.innerHTML = ([
      '<div class="' + blockPanelClass + '">',
      '<small>' + formatDate(post.date) + '</small>',
      '<h4 class="leader-half">',
      '<a href="' + post.url + '">',
      post.title + '</a>',
      '</h4>',
      '<p>' + post.excerpt + '</p>',
      '</div>'
    ]).join('\n');

    return block;
  }

  function formatDate (date) {
    var formattedDate = '';
    // incoming:  2016-01-14 13:27:45
    // converted: 2016-01-14T13:27:45
    // https://www.w3.org/TR/NOTE-datetime
    if (date) {
      var iso_date = date.slice(0, 10) + "T" + date.slice(11);
      formattedDate = locale.format(new Date(iso_date), {selector: "date", formatLength: "long"});
    }
    return formattedDate;
  }

  $('[data-blog-feed-url]').forEach(function (blogSection) {
    var blogRoll = $(blogSection)[0];
    var feedUrl = domAttr.get(blogRoll, 'data-blog-feed-url');
    var blockPanelClass = domAttr.get(blogRoll, 'data-block-panel-class');
    var limit = parseInt(domAttr.get(blogRoll, 'data-post-limit'), 10) || 10;
    jsonp(feedUrl, '?json=1', function(error, response){
      if(error) { return; }
      var posts = response.posts;
      for (var i = 0; i < Math.min(posts.length, limit); i++) {
        domConstruct.place(buildPost(posts[i], blockPanelClass), blogRoll);
      }
    });
  });
});
