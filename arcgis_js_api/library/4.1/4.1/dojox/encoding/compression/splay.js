//>>built
define(["dojo/_base/lang","../bits"],function(f,g){var e=f.getObject("dojox.encoding.compression",!0);e.Splay=function(a){this.up=Array(2*a+1);this.left=Array(a);this.right=Array(a);this.reset()};f.extend(e.Splay,{reset:function(){for(var a=1;a<this.up.length;this.up[a]=Math.floor((a-1)/2),++a);for(a=0;a<this.left.length;this.left[a]=2*a+1,this.right[a]=2*a+2,++a);},splay:function(a){a+=this.left.length;do{var b=this.up[a];if(b){var d=this.up[b],c=this.left[d];b==c?(c=this.right[d],this.right[d]=
a):this.left[d]=a;this[a==this.left[b]?"left":"right"][b]=c;this.up[a]=d;this.up[c]=b;a=d}else a=b}while(a)},encode:function(a,b){var d=[],c=a+this.left.length;do d.push(this.right[this.up[c]]==c),c=this.up[c];while(c);this.splay(a);for(c=d.length;d.length;)b.putBits(d.pop()?1:0,1);return c},decode:function(a){var b=0;do b=this[a.getBits(1)?"right":"left"][b];while(b<this.left.length);b-=this.left.length;this.splay(b);return b}});return e.Splay});