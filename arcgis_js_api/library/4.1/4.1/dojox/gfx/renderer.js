//>>built
define(["./_base","dojo/_base/lang","dojo/_base/sniff","dojo/_base/window","dojo/_base/config"],function(m,n,f,k,c){var g=null;f.add("vml",function(b,c,d){d.innerHTML='\x3cv:shape adj\x3d"1"/\x3e';b="adj"in d.firstChild;d.innerHTML="";return b});return{load:function(b,p,d){function l(){p(["dojox/gfx/"+a],function(b){m.renderer=a;g=b;d(b)})}if(g&&"force"!=b)d(g);else{var a=c.forceGfxRenderer;b=!a&&(n.isString(c.gfxRenderer)?c.gfxRenderer:"svg,vml,canvas,silverlight").split(",");for(var h,e;!a&&b.length;)switch(b.shift()){case "svg":"SVGAngle"in
k.global&&(a="svg");break;case "vml":f("vml")&&(a="vml");break;case "silverlight":try{f("ie")?(h=new ActiveXObject("AgControl.AgControl"))&&h.IsVersionSupported("1.0")&&(e=!0):navigator.plugins["Silverlight Plug-In"]&&(e=!0)}catch(q){e=!1}finally{h=null}e&&(a="silverlight");break;case "canvas":k.global.CanvasRenderingContext2D&&(a="canvas")}"canvas"===a&&!1!==c.canvasEvents&&(a="canvasWithEvents");c.isDebug&&console.log("gfx renderer \x3d "+a);"svg"==a&&"undefined"!=typeof window.svgweb?window.svgweb.addOnLoad(l):
l()}}}});