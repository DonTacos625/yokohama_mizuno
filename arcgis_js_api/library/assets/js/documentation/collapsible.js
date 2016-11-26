require([
  "dojo/query",
  "dojo/NodeList-data",
  "dojo/NodeList-dom",
  "dojo/NodeList-traverse",
  "dojo/NodeList-fx"
], function($){

  $("[data-collapsed='false'] ul").style("display", "block");
  $("[data-collapsed='true'] ul").style("display", "none");

/*
  if(!$("[data-collapsed='false']").length) {
    $("[data-collapsed] ul").first().style("display", "block");
    $("[data-collapsed]").first().attr("data-collapsed", "false");
  }
*/

  $("div[data-collapsed] header").on("click", function(e){
    var outer = $(this).parent();
    var list = outer.children("ul");
    var collapsed = outer.attr("data-collapsed")[0];
    if(collapsed === "true"){
      list.wipeIn({auto:true});
      outer.attr("data-collapsed", "false");
    } else {
      list.wipeOut({auto:true});
      outer.attr("data-collapsed", "true");
    }
  });

});