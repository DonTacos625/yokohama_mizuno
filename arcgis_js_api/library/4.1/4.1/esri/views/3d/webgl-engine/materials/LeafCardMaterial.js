// All material copyright ESRI, All Rights Reserved, unless otherwise specified.
// See http://js.arcgis.com/4.1/esri/copyright.txt for details.
//>>built
require({cache:{"url:esri/views/3d/webgl-engine/materials/LeafCardMaterial.xml":'\x3c?xml version\x3d"1.0" encoding\x3d"UTF-8"?\x3e\r\n\r\n\x3csnippets\x3e\r\n\r\n\x3csnippet name\x3d"vertexShaderLeafCard"\x3e\r\n\t\x3c![CDATA[\r\n\tuniform mat4 proj;\r\n\tuniform mat4 view;\r\n\tuniform mat4 model;\r\n\tuniform mat4 modelNormal;\r\n\tattribute vec3 $position;\r\n\tattribute vec4 $normal;\r\n\tattribute vec4 $uv0;\r\n\tvarying vec2 vtc;\r\n\tvarying vec3 vnormal;\r\n\tvarying float ambientLeaf;\r\n\r\n\tuniform float trafoScale;\r\n\tvarying vec3 vpos;\r\n\r\n\t// TODO optimize?\r\n\tvec2 rotate(vec2 pos, float angle) {\r\n\t\tfloat c \x3d cos(angle);\r\n\t\tfloat s \x3d sin(angle);\r\n\t\treturn vec2(c * pos.x - s * pos.y, s * pos.x + c * pos.y);\r\n\t}\r\n\r\n\tvoid main(void) {\r\n\r\n\t\tvpos \x3d (model * vec4($position, 1.0)).xyz;\r\n\r\n\t\tvec3 pos \x3d (view * model * vec4($position, 1.0)).xyz;\r\n\t\tvec2 uv01 \x3d floor($uv0.xy);\r\n\t\tvec2 uv \x3d $uv0.xy - uv01;\r\n\r\n   \t\tvec2 up \x3d rotate(vec2(1,0), $uv0.z);\r\n   \t\tvec3 xDir \x3d  vec3(up.x,up.y,0.0);\r\n   \t\tvec3 yDir \x3d  vec3(-up.y,up.x,0.0);\r\n\r\n\t\tpos +\x3d xDir * (uv01.x - .5) * $uv0.w *trafoScale;\r\n\t\tpos +\x3d yDir * (uv01.y - .5) * $uv0.w *trafoScale;;\r\n\t\tvec4 pos4 \x3d proj * vec4(pos, 1.0);\r\n\t\tgl_Position \x3d pos4;\r\n\t\tvtc \x3d uv;\r\n\t\tambientLeaf \x3d normal.w;\r\n\t\tvnormal \x3d normalize((modelNormal * vec4($normal.xyz, 1.0)).xyz);\r\n\t}\r\n]]\x3e\r\n\x3c/snippet\x3e\r\n\r\n\x3csnippet name\x3d"fragmentShaderLeafCard"\x3e\r\n\x3c![CDATA[\r\n\tprecision mediump float;\r\n\r\n\tuniform vec3 camPos;\r\n\r\n\tuniform vec4 lightAmbient;\r\n\tuniform vec4 lightDiffuse;\r\n\tuniform vec4 lightSpecular;\r\n\tuniform vec3 lightDirection;\r\n\r\n\tuniform vec3 ambient;\r\n\tuniform vec3 diffuse;\r\n\tuniform vec3 specular;\r\n\tuniform float shininess;\r\n\r\n\tuniform sampler2D tex;\r\n\tvarying vec2 vtc;\r\n\tvarying vec3 vnormal;\r\n\tvarying float ambientLeaf;\r\n\r\n\tvarying vec3 vpos;\r\n\r\n\tvoid main() {\r\n\t\tvec4 texColor \x3d texture2D(tex, vtc);\r\n\t\tif (texColor.a \x3c .33) discard;\r\n\r\n\t\tvec3 a \x3d ambient * lightAmbient.rgb * lightAmbient.w;\r\n\t\tvec3 d \x3d diffuse * lightDiffuse.rgb * lightDiffuse.w * clamp(dot(vnormal, lightDirection), .0, 1.0);\r\n\r\n\t\tvec3 reflDir \x3d normalize(reflect(vpos - camPos, vnormal));\r\n\t\tfloat specDot \x3d max(dot(reflDir, lightDirection), .001);\r\n\t\tvec3 s \x3d specular * lightSpecular.rgb * lightSpecular.w * pow(specDot, shininess);\r\n\r\n\t\tgl_FragColor \x3d vec4(ambientLeaf * texColor.rgb * (a + d) + s, texColor.a);\r\n\r\n\t\t//gl_FragColor \x3d vec4(ambient,1.0);\r\n\r\n\t}\r\n]]\x3e\x3c/snippet\x3e\r\n\r\n\r\n\x3csnippet name\x3d"vertexShaderLeafCardDepth"\x3e\x3c![CDATA[\r\n   \tuniform mat4 proj;\r\n   \tuniform mat4 view;\r\n   \tuniform mat4 model;\r\n   \tuniform vec2 nearFar;\r\n\r\n   \tattribute vec3 $position;\r\n   \tattribute vec4 $uv0;\r\n\r\n   \tuniform float trafoScale;\r\n\r\n   \tvarying vec2 vtc;\r\n   \tvarying float depth;\r\n\r\n   \t// TODO optimize?\r\n   \tvec2 rotate(vec2 pos, float angle) {\r\n   \t\tfloat c \x3d cos(angle);\r\n   \t\tfloat s \x3d sin(angle);\r\n   \t\treturn vec2(c * pos.x - s * pos.y, s * pos.x + c * pos.y);\r\n   \t}\r\n\r\n   \tvoid main(void) {\r\n   \t\tvec3 pos \x3d (view * model * vec4($position, 1.0)).xyz;\r\n   \t\tvec2 uv01 \x3d floor($uv0.xy);\r\n   \t\tvec2 uv \x3d $uv0.xy - uv01;\r\n\r\n   \t\tvec2 up \x3d rotate(vec2(1,0), $uv0.z);\r\n   \t\tvec3 xDir \x3d  vec3(up.x,up.y,0.0);\r\n   \t\tvec3 yDir \x3d  vec3(-up.y,up.x,0.0);\r\n\r\n   \t\tpos +\x3d xDir * (uv01.x - .5) * $uv0.w*trafoScale;\r\n   \t\tpos +\x3d yDir * (uv01.y - .5) * $uv0.w*trafoScale;\r\n   \t\tvec4 pos4 \x3d proj * vec4(pos, 1.0);\r\n   \t\tgl_Position \x3d pos4;\r\n   \t\tvtc \x3d uv;\r\n\r\n   \t\tdepth \x3d (-pos.z - nearFar[0]) / (nearFar[1] - nearFar[0]);\r\n\r\n   \t}\r\n ]]\x3e\x3c/snippet\x3e\r\n\r\n\x3c/snippets\x3e'}});
define("dojo/text!./LeafCardMaterial.xml ./internal/MaterialUtil ../lib/Util ../lib/gl-matrix ../lib/RenderSlot ../../../webgl/Program ../lib/DefaultVertexAttributeLocations ../../../webgl/Util".split(" "),function(O,A,P,u,L,H,I,Q){function C(){J=(9301*J+49297)%233280;return J/233280}var a=u.vec3,G=u.mat4,K=u.mat4d;u=function(D,g,p,t,e,m){A.basicMaterialConstructor(this,m);var r=[{name:"position",count:3,type:5126,offset:0,stride:44,normalized:!1},{name:"normal",count:4,type:5126,offset:12,stride:44,
normalized:!1},{name:"uv0",count:4,type:5126,offset:28,stride:44,normalized:!1}],M=Q.getStride(r)/4;this.getAmbient=function(){return g};this.getDiffuse=function(){return p};this.getSpecular=function(){return t};this.getShininess=function(){return e};this.dispose=function(){};this.getTextureId=function(){return D};this.getOutputAmount=function(d){var s=0,a;for(a=0;a<d/6;a++)0===a%1&&(s+=6);d=s;for(a=s=0;a<d/6;a++)0===a%1&&(s+=6);return s*M};this.getVertexBufferLayout=function(){return r};this.reduce=
function(d,a){for(var D=d.position,f=d.normal,c=d.uv0,b=[],n=[],e=[],m=0,g=0;g<D.length/6;g++)if(0===g%a)for(var r=0;6>r;r++)b[m]=D[6*g+r],n[m]=f[6*g+r],e[m]=c[6*g+r],m++;return{position:b,normal:n,uv0:e}};this.fillInterleaved=function(d,s,D,f,c,b){f=A.fill;var n=this.reduce(d.faces.indices,1),n=this.reduce(n,1),e=this.getOutputAmount(d.faces.indices.position.length);P.assert(e===n.position.length*M);var g=n.position,m=n.normal,r=n.uv0,n=d.vertexAttr.position.data,p=d.vertexAttr.normal.data,y=d.vertexAttr.uv0.data,
w=a.create();d=g.length/6;for(var e=b,z=a.createFrom(-Number.MAX_VALUE,-Number.MAX_VALUE,-Number.MAX_VALUE),v=a.createFrom(Number.MAX_VALUE,Number.MAX_VALUE,Number.MAX_VALUE),t=0;t<d;++t){for(var h=a.create(),q=a.create(),k=[100,100,-100,-100],x=a.create(),l=0;6>l;++l){var B=6*t+l,u=3*g[B],F=3*m[B],B=2*r[B];h[0]+=n[u+0];h[1]+=n[u+1];h[2]+=n[u+2];q[0]+=p[F+0];q[1]+=p[F+1];q[2]+=p[F+2];F=y[B+0];B=y[B+1];k[0]=Math.min(k[0],F);k[1]=Math.min(k[1],B);k[2]=Math.max(k[2],F);k[3]=Math.max(k[3],B);0===l&&a.set3(n[u+
0],n[u+1],n[u+2],x)}h[0]/=6;h[1]/=6;h[2]/=6;q[0]/=6;q[1]/=6;q[2]/=6;h[0]+=0.1*(2*C()-1);h[1]+=0.1*(2*C()-1);h[2]+=0.1*(2*C()-1);void 0!==s&&(K.multiplyVec3(s,x,x),K.multiplyVec3(s,h,h),K.multiplyVec3(D,q,q));a.add(h,w,w);a.max(z,h,z);a.min(v,h,v);k[0]+=0.01;k[1]+=0.01;k[2]-=0.01;k[3]-=0.01;for(l=0;4>l;l++)k[l]=Math.min(k[l],0.99999);l=2*C()*Math.PI;x=1.41*a.dist(x,h);b+=f(h,0,c,b,void 0,3);b+=f(q,0,c,b,void 0,3);c[b++]=0;c[b++]=k[0];c[b++]=k[1];c[b++]=l;c[b++]=x;b+=f(h,0,c,b,void 0,3);b+=f(q,0,c,
b,void 0,3);c[b++]=0;c[b++]=k[2]+1;c[b++]=k[1];c[b++]=l;c[b++]=x;b+=f(h,0,c,b,void 0,3);b+=f(q,0,c,b,void 0,3);c[b++]=0;c[b++]=k[2]+1;c[b++]=k[3]+1;c[b++]=l;c[b++]=x;b+=f(h,0,c,b,void 0,3);b+=f(q,0,c,b,void 0,3);c[b++]=0;c[b++]=k[2]+1;c[b++]=k[3]+1;c[b++]=l;c[b++]=x;b+=f(h,0,c,b,void 0,3);b+=f(q,0,c,b,void 0,3);c[b++]=0;c[b++]=k[0];c[b++]=k[3]+1;c[b++]=l;c[b++]=x;b+=f(h,0,c,b,void 0,3);b+=f(q,0,c,b,void 0,3);c[b++]=0;c[b++]=k[0];c[b++]=k[1];c[b++]=l;c[b++]=x}w[0]/=d;w[1]/=d;w[2]/=d;s=a.create();a.add(z,
v,s);a.scale(s,0.5,s);b=a.create();a.subtract(z,v,b);b[0]=Math.abs(b[0])/2;b[1]=Math.abs(b[1])/2;b[2]=Math.abs(b[2])/2;g=a.create(w);g[1]-=(z[1]-v[1])/3;z=a.create();v=a.create();n=a.create();m=[a.create(),a.create(),a.create(),a.create()];w=[0,0,0,0];r=G.create();for(t=0;t<d;++t){a.set3(c[e],c[e+1],c[e+2],n);a.subtract(n,g,z);a.normalize(z,z);v=a.subtract(n,s,v);a.normalize(v,v);y=Math.abs(a.dot(v,[1,0,0]));l=Math.abs(a.dot(v,[0,1,0]));p=Math.abs(a.dot(v,[0,0,1]));y=y*Math.abs(s[0]-n[0])/b[0];y+=
l*Math.abs(s[1]-n[1])/b[1];y+=p*Math.abs(s[2]-n[2])/b[2];for(l=0;4>l;l++)G.identity(r),G.rotate(r,0.8*(2*C()-1),[0,1,0],r),G.rotate(r,0.8*(2*C()-1),[1,0,0],r),G.multiplyVec3(r,z,m[l]),w[l]=0.5+0.5*y-0.2*(2*C()-1);p=0.8+0.3*(2*C()-1);for(l=0;6>l;++l){var E;switch(l){case 0:E=0;break;case 1:E=1;break;case 2:E=2;break;case 3:E=2;break;case 4:E=3;break;case 5:E=0}e+=3;e+=f(m[E],0,c,e,D,3);c[e++]=w[E];e+=3;c[e++]*=p}}};this.intersect=function(){};this.getGLMaterials=function(){return{color:R,depthShadowMap:S,
normal:void 0,depth:N,highlight:void 0}};this.getAllTextureIds=function(){return[D]}};var R=function(a,g,p){A.basicGLMaterialConstructor(this,a);var t=L.TRANSPARENT_MATERIAL,e=g.get("leafCard");A.singleTextureGLMaterialConstructor(this,p,{textureId:a.getTextureId()});this.beginSlot=function(a){return t===a};this.getProgram=function(){return e};var m=a.getAmbient(),r=a.getDiffuse(),u=a.getSpecular(),d=a.getShininess();this.bind=function(a,g){a.bindProgram(e);this.bindTexture(a,e);e.setUniform3fv("ambient",
m);e.setUniform3fv("diffuse",r);e.setUniform3fv("specular",u);e.setUniform1f("shininess",d);e.setUniform1f("trafoScale",1)};this.release=function(a){};this.bindView=function(a,d){A.bindView(d.origin,d.view,e);A.bindCamPos(d.origin,d.viewInvTransp,e)};this.bindInstance=function(a,d){e.setUniformMatrix4fv("model",d.transformation);e.setUniformMatrix4fv("modelNormal",d.transformationNormal);var f=d.transformation,c=Math.sqrt(f[0]*f[0]+f[4]*f[4]+f[8]*f[8]),b=Math.sqrt(f[1]*f[1]+f[5]*f[5]+f[9]*f[9]),f=
Math.sqrt(f[2]*f[2]+f[6]*f[6]+f[10]*f[10]);e.setUniform1f("trafoScale",(c+b+f)/3)};this.getDrawMode=function(a){return a.gl.TRIANGLES}},N=function(a,g,p,t){A.basicGLMaterialConstructor(this,a);var e=L.TRANSPARENT_MATERIAL,m=null==t?g.get("leafCardDepth"):g.get("leafCardDepthShadowMap");A.singleTextureGLMaterialConstructor(this,p,{textureId:a.getTextureId()});this.beginSlot=function(a){return e===a};this.getProgram=function(){return m};this.bind=function(a,e){a.bindProgram(m);this.bindTexture(a,m);
m.setUniform2fv("nearFar",e.nearFar)};this.release=function(a){};this.bindView=function(a,e){A.bindView(e.origin,e.view,m)};this.bindInstance=function(a,e){m.setUniformMatrix4fv("model",e.transformation);var d=e.transformation,g=Math.sqrt(d[0]*d[0]+d[4]*d[4]+d[8]*d[8]),p=Math.sqrt(d[1]*d[1]+d[5]*d[5]+d[9]*d[9]),d=Math.sqrt(d[2]*d[2]+d[6]*d[6]+d[10]*d[10]);m.setUniform1f("trafoScale",(g+p+d)/3)};this.getDrawMode=function(a){return a.gl.TRIANGLES}},S=function(a,g,p){N.call(this,a,g,p,!0)};u.loadShaders=
function(a,g,p,t){a._parse(O);var e=new H(t,a.vertexShaderLeafCard,a.fragmentShaderLeafCard,I.Default3D),m=g.get("fsDepthTextured");g=g.get("fsDepthTexturedShadowMap");m=new H(t,a.vertexShaderLeafCardDepth,m.source,I.Default3D,m.defines);a=new H(t,a.vertexShaderLeafCardDepth,g.source,I.Default3D,g.defines);p.add("leafCard",e);p.add("leafCardDepth",m);p.add("leafCardDepthShadowMap",a)};var J=1234;return u});