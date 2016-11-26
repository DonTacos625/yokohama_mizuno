require([
  'documentation/jsonp',
  'dojo/query',
  'dojo/dom-construct',
  'dojo/date/locale',
  'dojo/dom-attr'
], function (jsonp, $, domConstruct, locale, domAttr) {
  function buildPost(post){
    var html = "";
    html += '<h4 class="leader-1 trailer-0"><a href="'+post.url+'">'+post.title+'</a></h4>';
    html += '<small>' + formatDate(post.date) + '</small>';
    html += '<p>' + post.excerpt + '</p>';
    return html;
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

  $('[data-blog-url]').forEach(function(blogSection){
    var blogRoll = $(blogSection)[0];
    var feedUrl = domAttr.get(blogRoll, 'data-blog-url');
    var limit = parseInt(domAttr.get(blogRoll, 'data-blog-posts')) || 10;
    jsonp(feedUrl, '?json=1', function(error, response){
      if(error) { return; }
      var posts = response.posts;
      for (var i = 0; i < Math.min(posts.length, limit); i++) {
        domConstruct.place(buildPost(posts[i]), blogRoll);
      }
    });
  });

});
