// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
define(["require","exports"],function(g,h){function f(a){var c=2;return a.replace(/\n/g,function(){var b;b=c++;b=1E3>b?("  "+b).slice(-3):""+b;return"\n"+b+":"})}return function(){function a(c,b,a,d){this.glName=void 0;this.defines=d;this.gl=a;this.type=c;this.source=b}a.prototype.init=function(){void 0===this.glName&&(this.glName=this.gl.createShader(this.type),this.loadShader())};a.prototype.loadShader=function(){var c=this.source,b=this.defines,a=this.gl;if(void 0!==b){for(var d="",e=0;e<b.length;e++)d+=
"#define "+b[e]+"\n";c=d+c}a.shaderSource(this.glName,c);a.compileShader(this.glName);a.getShaderParameter(this.glName,a.COMPILE_STATUS)||(console.error(a.getShaderInfoLog(this.glName)),console.error(f(c)))};a.prototype.changeDefines=function(a){if(JSON.stringify(this.defines)===JSON.stringify(a))return!1;this.defines=a;void 0!==this.glName&&this.loadShader();return!0};a.prototype.getGLName=function(){this.init();return this.glName};return a}()});