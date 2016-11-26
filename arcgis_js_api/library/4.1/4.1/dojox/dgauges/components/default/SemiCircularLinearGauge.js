//>>built
define("dojo/_base/lang dojo/_base/declare dojo/_base/Color ../utils ../../CircularGauge ../../LinearScaler ../../CircularScale ../../CircularValueIndicator ../../TextIndicator ../DefaultPropertiesMixin".split(" "),function(f,l,k,a,m,n,p,q,r,s){return l("dojox.dgauges.components.default.SemiCircularLinearGauge",[m,s],{_radius:88,_width:200,_height:123,borderColor:"#C9DFF2",fillColor:"#FCFCFF",indicatorColor:"#F01E28",constructor:function(){this.borderColor=new k(this.borderColor);this.fillColor=new k(this.fillColor);
this.indicatorColor=new k(this.indicatorColor);this.addElement("background",f.hitch(this,this.drawBackground));var e=new n,c=new p;c.set("scaler",e);this.addElement("scale",c);e=new q;c.addIndicator("indicator",e);this.addElement("foreground",f.hitch(this,this.drawForeground));this.addElement("indicatorTextBorder",f.hitch(this,this.drawTextBorder),"leading");var d=new r;d.set("indicator",e);d.set("x",100);d.set("y",115);this.addElement("indicatorText",d);a.genericCircularGauge(c,e,this._width/2,0.76*
this._height,this._radius,166,14,null,null,"inside")},drawBackground:function(e){var c=this._width,d=this._height,b=0,h=3,g=a.createGradient([0,a.brightness(this.borderColor,-20),0.1,a.brightness(this.borderColor,-40)]);e.createRect({x:0,y:0,width:c,height:d,r:h}).setFill(f.mixin({type:"linear",x1:0,y1:0,x2:c,y2:d},g)).setStroke({color:"#A5A5A5",width:0.2});g=a.createGradient([0,a.brightness(this.borderColor,70),1,a.brightness(this.borderColor,-50)]);b=4;e.createRect({x:b,y:b,width:c-2*b,height:d-
2*b,r:2}).setFill(f.mixin({type:"linear",x1:0,y1:0,x2:c,y2:d},g));b=6;h=1;g=a.createGradient([0,a.brightness(this.borderColor,60),1,a.brightness(this.borderColor,-40)]);e.createRect({x:b,y:b,width:c-2*b,height:d-2*b,r:h}).setFill(f.mixin({type:"linear",x1:0,y1:0,x2:c,y2:d},g));b=7;h=0;g=a.createGradient([0,a.brightness(this.borderColor,70),1,a.brightness(this.borderColor,-40)]);e.createRect({x:b,y:b,width:c-2*b,height:d-2*b,r:h}).setFill(f.mixin({type:"linear",x1:c,y1:0,x2:0,y2:d},g));b=5;h=0;g=a.createGradient([0,
[255,255,255,220],0.8,a.brightness(this.fillColor,-5),1,a.brightness(this.fillColor,-30)]);e.createRect({x:b,y:b,width:c-2*b,height:d-2*b,r:h}).setFill(f.mixin({type:"radial",cx:c/2,cy:d/2,r:d},g)).setStroke({color:a.brightness(this.fillColor,-40),width:0.4})},drawForeground:function(e){var c=0.07*this._radius,d=a.createGradient([0,this.borderColor,1,a.brightness(this.borderColor,-20)]);e.createEllipse({cx:this._width/2,cy:0.76*this._height,rx:c,ry:c}).setFill(f.mixin({type:"radial",cx:this._width/
2-5,cy:0.76*this._height-5,r:c},d)).setStroke({color:a.brightness(this.fillColor,-50),width:0.4})},drawTextBorder:function(e){return e.createRect({x:this._width/2-12,y:this._height-20,width:24,height:14}).setStroke({color:a.brightness(this.fillColor,-20),width:0.3})}})});