//>>built
define("dojox/atom/io/model",["dojo/_base/kernel","dojo/_base/declare","dojo/_base/lang","dojo/date/stamp","dojox/xml/parser"],function(m,h,l,k,g){var d={};m.setObject("dojox.atom.io.model",d);d._Constants={ATOM_URI:"http://www.w3.org/2005/Atom",ATOM_NS:"http://www.w3.org/2005/Atom",PURL_NS:"http://purl.org/atom/app#",APP_NS:"http://www.w3.org/2007/app"};d._actions={link:function(a,b){null===a.links&&(a.links=[]);var c=new d.Link;c.buildFromDom(b);a.links.push(c)},author:function(a,b){null===a.authors&&
(a.authors=[]);var c=new d.Person("author");c.buildFromDom(b);a.authors.push(c)},contributor:function(a,b){null===a.contributors&&(a.contributors=[]);var c=new d.Person("contributor");c.buildFromDom(b);a.contributors.push(c)},category:function(a,b){null===a.categories&&(a.categories=[]);var c=new d.Category;c.buildFromDom(b);a.categories.push(c)},icon:function(a,b){a.icon=g.textContent(b)},id:function(a,b){a.id=g.textContent(b)},rights:function(a,b){a.rights=g.textContent(b)},subtitle:function(a,
b){var c=new d.Content("subtitle");c.buildFromDom(b);a.subtitle=c},title:function(a,b){var c=new d.Content("title");c.buildFromDom(b);a.title=c},updated:function(a,b){a.updated=d.util.createDate(b)},issued:function(a,b){a.issued=d.util.createDate(b)},modified:function(a,b){a.modified=d.util.createDate(b)},published:function(a,b){a.published=d.util.createDate(b)},entry:function(a,b){null===a.entries&&(a.entries=[]);var c=a.createEntry?a.createEntry():new d.Entry;c.buildFromDom(b);a.entries.push(c)},
content:function(a,b){var c=new d.Content("content");c.buildFromDom(b);a.content=c},summary:function(a,b){var c=new d.Content("summary");c.buildFromDom(b);a.summary=c},name:function(a,b){a.name=g.textContent(b)},email:function(a,b){a.email=g.textContent(b)},uri:function(a,b){a.uri=g.textContent(b)},generator:function(a,b){a.generator=new d.Generator;a.generator.buildFromDom(b)}};d.util={createDate:function(a){return(a=g.textContent(a))?k.fromISOString(l.trim(a)):null},escapeHtml:function(a){return a.replace(/&/gm,
"\x26amp;").replace(/</gm,"\x26lt;").replace(/>/gm,"\x26gt;").replace(/"/gm,"\x26quot;").replace(/'/gm,"\x26#39;")},unEscapeHtml:function(a){return a.replace(/&lt;/gm,"\x3c").replace(/&gt;/gm,"\x3e").replace(/&quot;/gm,'"').replace(/&#39;/gm,"'").replace(/&amp;/gm,"\x26")},getNodename:function(a){var b=null;null!==a&&(b=a.localName?a.localName:a.nodeName,null!==b&&(a=b.indexOf(":"),-1!==a&&(b=b.substring(a+1,b.length))));return b}};d.Node=h(null,{constructor:function(a,b,c,e,d){this.name_space=a;
this.name=b;this.attributes=[];c&&(this.attributes=c);this.content=[];this.rawNodes=[];this.textContent=null;e&&this.content.push(e);this.shortNs=d;this.nodeType=this._objName="Node"},buildFromDom:function(a){this._saveAttributes(a);this.name_space=a.namespaceURI;this.shortNs=a.prefix;this.name=d.util.getNodename(a);for(var b=0;b<a.childNodes.length;b++){var c=a.childNodes[b];if("#text"!=d.util.getNodename(c)){this.rawNodes.push(c);var e=new d.Node;e.buildFromDom(c,!0);this.content.push(e)}else this.content.push(c.nodeValue)}this.textContent=
g.textContent(a)},_saveAttributes:function(a){this.attributes||(this.attributes=[]);var b;b=a.attributes;b=null===b?!1:0!==b.length;if(b&&this._getAttributeNames&&(b=this._getAttributeNames(a))&&0<b.length)for(var c in b){var d=a.getAttribute(b[c]);d&&(this.attributes[b[c]]=d)}},addAttribute:function(a,b){this.attributes[a]=b},getAttribute:function(a){return this.attributes[a]},_getAttributeNames:function(a){for(var b=[],c=0;c<a.attributes.length;c++)b.push(a.attributes[c].nodeName);return b},toString:function(){var a=
[],b,c=(this.shortNs?this.shortNs+":":"")+this.name;if("#cdata-section"==this.name)a.push("\x3c![CDATA["),a.push(this.textContent),a.push("]]\x3e");else{a.push("\x3c");a.push(c);this.name_space&&a.push(" xmlns\x3d'"+this.name_space+"'");if(this.attributes)for(b in this.attributes)a.push(" "+b+"\x3d'"+this.attributes[b]+"'");if(this.content){a.push("\x3e");for(b in this.content)a.push(this.content[b]);a.push("\x3c/"+c+"\x3e\n")}else a.push("/\x3e\n")}return a.join("")},addContent:function(a){this.content.push(a)}});
d.AtomItem=h(d.Node,{constructor:function(a){this.ATOM_URI=d._Constants.ATOM_URI;this.entries=this.extensions=this.content=this.issued=this.modified=this.updated=this.published=this.subtitle=this.title=this.icon=this.id=this.logo=this.xmlBase=this.rights=this.contributors=this.categories=this.authors=this.links=null;this.name_spaces={};this.nodeType=this._objName="AtomItem"},_getAttributeNames:function(){return null},_accepts:{},accept:function(a){return Boolean(this._accepts[a])},_postBuild:function(){},
buildFromDom:function(a){var b,c,e;for(b=0;b<a.attributes.length;b++)c=a.attributes.item(b),e=d.util.getNodename(c),"xmlns"==c.prefix&&c.prefix!=e&&this.addNamespace(c.nodeValue,e);c=a.childNodes;for(b=0;b<c.length;b++)if(1==c[b].nodeType&&(e=d.util.getNodename(c[b]))){if(c[b].namespaceURI!=d._Constants.ATOM_NS&&"#text"!=e){this.extensions||(this.extensions=[]);var f=new d.Node;f.buildFromDom(c[b]);this.extensions.push(f)}this.accept(e.toLowerCase())&&(e=d._actions[e])&&e(this,c[b])}this._saveAttributes(a);
this._postBuild&&this._postBuild()},addNamespace:function(a,b){a&&b&&(this.name_spaces[b]=a)},addAuthor:function(a,b,c){this.authors||(this.authors=[]);this.authors.push(new d.Person("author",a,b,c))},addContributor:function(a,b,c){this.contributors||(this.contributors=[]);this.contributors.push(new d.Person("contributor",a,b,c))},addLink:function(a,b,c,e,f){this.links||(this.links=[]);this.links.push(new d.Link(a,b,c,e,f))},removeLink:function(a,b){if(this.links&&l.isArray(this.links)){for(var c=
0,d=0;d<this.links.length;d++)if((!a||this.links[d].href===a)&&(!b||this.links[d].rel===b))this.links.splice(d,1),c++;return c}},removeBasicLinks:function(){if(this.links){for(var a=0,b=0;b<this.links.length;b++)this.links[b].rel||(this.links.splice(b,1),a++,b--);return a}},addCategory:function(a,b,c){this.categories||(this.categories=[]);this.categories.push(new d.Category(a,b,c))},getCategories:function(a){if(!a)return this.categories;var b=[],c;for(c in this.categories)this.categories[c].scheme===
a&&b.push(this.categories[c]);return b},removeCategories:function(a,b){if(this.categories){for(var c=0,d=0;d<this.categories.length;d++)if((!a||this.categories[d].scheme===a)&&(!b||this.categories[d].term===b))this.categories.splice(d,1),c++,d--;return c}},setTitle:function(a,b){a&&(this.title=new d.Content("title"),this.title.value=a,b&&(this.title.type=b))},addExtension:function(a,b,c,e,f){this.extensions||(this.extensions=[]);this.extensions.push(new d.Node(a,b,c,e,f||"ns"+this.extensions.length))},
getExtensions:function(a,b){var c=[];if(!this.extensions)return c;for(var d in this.extensions)(this.extensions[d].name_space===a||this.extensions[d].shortNs===a)&&(!b||this.extensions[d].name===b)&&c.push(this.extensions[d]);return c},removeExtensions:function(a,b){if(this.extensions)for(var c=0;c<this.extensions.length;c++)if((this.extensions[c].name_space==a||this.extensions[c].shortNs===a)&&this.extensions[c].name===b)this.extensions.splice(c,1),c--},destroy:function(){this.entries=this.extensions=
this.content=this.issued=this.modified=this.updated=this.published=this.subtitle=this.title=this.icon=this.id=this.logo=this.xmlBase=this.rights=this.contributors=this.categories=this.authors=this.links=null}});d.Category=h(d.Node,{constructor:function(a,b,c){this.scheme=a;this.term=b;this.label=c;this.nodeType=this._objName="Category"},_postBuild:function(){},_getAttributeNames:function(){return["label","scheme","term"]},toString:function(){var a=[];a.push("\x3ccategory ");this.label&&a.push(' label\x3d"'+
this.label+'" ');this.scheme&&a.push(' scheme\x3d"'+this.scheme+'" ');this.term&&a.push(' term\x3d"'+this.term+'" ');a.push("/\x3e\n");return a.join("")},buildFromDom:function(a){this._saveAttributes(a);this.label=this.attributes.label;this.scheme=this.attributes.scheme;this.term=this.attributes.term;this._postBuild&&this._postBuild()}});d.Content=h(d.Node,{constructor:function(a,b,c,d,f){this.tagName=a;this.value=b;this.src=c;this.type=d;this.xmlLang=f;this.HTML="html";this.TEXT="text";this.XHTML=
"xhtml";this.XML="xml";this._useTextContent="true";this.nodeType="Content"},_getAttributeNames:function(){return["type","src"]},_postBuild:function(){},buildFromDom:function(a){var b=a.getAttribute("type");b?(b.toLowerCase(),b=this.XML):b="text";if(b===this.XML){if(a.firstChild){this.value="";for(b=0;b<a.childNodes.length;b++){var c=a.childNodes[b];c&&(this.value+=g.innerXML(c))}}}else this.value=a.innerHTML?a.innerHTML:g.textContent(a);this._saveAttributes(a);this.attributes&&(this.type=this.attributes.type,
this.scheme=this.attributes.scheme,this.term=this.attributes.term);this.type||(this.type="text");a=this.type.toLowerCase();if("html"===a||"text/html"===a||"xhtml"===a||"text/xhtml"===a)this.value=this.value?d.util.unEscapeHtml(this.value):"";this._postBuild&&this._postBuild()},toString:function(){var a=[];a.push("\x3c"+this.tagName+" ");this.type||(this.type="text");this.type&&a.push(' type\x3d"'+this.type+'" ');this.xmlLang&&a.push(' xml:lang\x3d"'+this.xmlLang+'" ');this.xmlBase&&a.push(' xml:base\x3d"'+
this.xmlBase+'" ');this.type.toLowerCase()==this.HTML?a.push("\x3e"+d.util.escapeHtml(this.value)+"\x3c/"+this.tagName+"\x3e\n"):a.push("\x3e"+this.value+"\x3c/"+this.tagName+"\x3e\n");return a.join("")}});d.Link=h(d.Node,{constructor:function(a,b,c,d,f){this.href=a;this.hrefLang=c;this.rel=b;this.title=d;this.type=f;this.nodeType="Link"},_getAttributeNames:function(){return["href","jrefLang","rel","title","type"]},_postBuild:function(){},buildFromDom:function(a){this._saveAttributes(a);this.href=
this.attributes.href;this.hrefLang=this.attributes.hreflang;this.rel=this.attributes.rel;this.title=this.attributes.title;this.type=this.attributes.type;this._postBuild&&this._postBuild()},toString:function(){var a=[];a.push("\x3clink ");this.href&&a.push(' href\x3d"'+this.href+'" ');this.hrefLang&&a.push(' hrefLang\x3d"'+this.hrefLang+'" ');this.rel&&a.push(' rel\x3d"'+this.rel+'" ');this.title&&a.push(' title\x3d"'+this.title+'" ');this.type&&a.push(' type \x3d "'+this.type+'" ');a.push("/\x3e\n");
return a.join("")}});d.Person=h(d.Node,{constructor:function(a,b,c,d){this.author="author";this.contributor="contributor";a||(a=this.author);this.personType=a;this.name=b||"";this.email=c||"";this.uri=d||"";this.nodeType=this._objName="Person"},_getAttributeNames:function(){return null},_postBuild:function(){},accept:function(a){return Boolean(this._accepts[a])},buildFromDom:function(a){for(var b=a.childNodes,c=0;c<b.length;c++){var e=d.util.getNodename(b[c]);if(e){if(b[c].namespaceURI!=d._Constants.ATOM_NS&&
"#text"!=e){this.extensions||(this.extensions=[]);var f=new d.Node;f.buildFromDom(b[c]);this.extensions.push(f)}this.accept(e.toLowerCase())&&(e=d._actions[e])&&e(this,b[c])}}this._saveAttributes(a);this._postBuild&&this._postBuild()},_accepts:{name:!0,uri:!0,email:!0},toString:function(){var a=[];a.push("\x3c"+this.personType+"\x3e\n");this.name&&a.push("\t\x3cname\x3e"+this.name+"\x3c/name\x3e\n");this.email&&a.push("\t\x3cemail\x3e"+this.email+"\x3c/email\x3e\n");this.uri&&a.push("\t\x3curi\x3e"+
this.uri+"\x3c/uri\x3e\n");a.push("\x3c/"+this.personType+"\x3e\n");return a.join("")}});d.Generator=h(d.Node,{constructor:function(a,b,c){this.uri=a;this.version=b;this.value=c},_postBuild:function(){},buildFromDom:function(a){this.value=g.textContent(a);this._saveAttributes(a);this.uri=this.attributes.uri;this.version=this.attributes.version;this._postBuild&&this._postBuild()},toString:function(){var a=[];a.push("\x3cgenerator ");this.uri&&a.push(' uri\x3d"'+this.uri+'" ');this.version&&a.push(' version\x3d"'+
this.version+'" ');a.push("\x3e"+this.value+"\x3c/generator\x3e\n");return a.join("")}});d.Entry=h(d.AtomItem,{constructor:function(a){this.id=a;this._objName="Entry";this.feedUrl=null},_getAttributeNames:function(){return null},_accepts:{author:!0,content:!0,category:!0,contributor:!0,created:!0,id:!0,link:!0,published:!0,rights:!0,summary:!0,title:!0,updated:!0,xmlbase:!0,issued:!0,modified:!0},toString:function(a){var b=[],c;a?(b.push("\x3c?xml version\x3d'1.0' encoding\x3d'UTF-8'?\x3e"),b.push("\x3centry xmlns\x3d'"+
d._Constants.ATOM_URI+"'")):b.push("\x3centry");this.xmlBase&&b.push(' xml:base\x3d"'+this.xmlBase+'" ');for(c in this.name_spaces)b.push(" xmlns:"+c+'\x3d"'+this.name_spaces[c]+'"');b.push("\x3e\n");b.push("\x3cid\x3e"+(this.id?this.id:"")+"\x3c/id\x3e\n");this.issued&&!this.published&&(this.published=this.issued);this.published&&b.push("\x3cpublished\x3e"+k.toISOString(this.published)+"\x3c/published\x3e\n");this.created&&b.push("\x3ccreated\x3e"+k.toISOString(this.created)+"\x3c/created\x3e\n");
this.issued&&b.push("\x3cissued\x3e"+k.toISOString(this.issued)+"\x3c/issued\x3e\n");this.modified&&b.push("\x3cmodified\x3e"+k.toISOString(this.modified)+"\x3c/modified\x3e\n");this.modified&&!this.updated&&(this.updated=this.modified);this.updated&&b.push("\x3cupdated\x3e"+k.toISOString(this.updated)+"\x3c/updated\x3e\n");this.rights&&b.push("\x3crights\x3e"+this.rights+"\x3c/rights\x3e\n");this.title&&b.push(this.title.toString());this.summary&&b.push(this.summary.toString());a=[this.authors,this.categories,
this.links,this.contributors,this.extensions];for(var e in a)if(a[e])for(var f in a[e])b.push(a[e][f]);this.content&&b.push(this.content.toString());b.push("\x3c/entry\x3e\n");return b.join("")},getEditHref:function(){if(null===this.links||0===this.links.length)return null;for(var a in this.links)if(this.links[a].rel&&"edit"==this.links[a].rel)return this.links[a].href;return null},setEditHref:function(a){null===this.links&&(this.links=[]);for(var b in this.links)if(this.links[b].rel&&"edit"==this.links[b].rel){this.links[b].href=
a;return}this.addLink(a,"edit")}});d.Feed=h(d.AtomItem,{_accepts:{author:!0,content:!0,category:!0,contributor:!0,created:!0,id:!0,link:!0,published:!0,rights:!0,summary:!0,title:!0,updated:!0,xmlbase:!0,entry:!0,logo:!0,issued:!0,modified:!0,icon:!0,subtitle:!0},addEntry:function(a){if(!a.id)throw Error("The entry object must be assigned an ID attribute.");this.entries||(this.entries=[]);a.feedUrl=this.getSelfHref();this.entries.push(a)},getFirstEntry:function(){return!this.entries||0===this.entries.length?
null:this.entries[0]},getEntry:function(a){if(!this.entries)return null;for(var b in this.entries)if(this.entries[b].id==a)return this.entries[b];return null},removeEntry:function(a){if(this.entries){for(var b=0,c=0;c<this.entries.length;c++)this.entries[c]===a&&(this.entries.splice(c,1),b++);return b}},setEntries:function(a){for(var b in a)this.addEntry(a[b])},toString:function(){var a=[],b;a.push('\x3c?xml version\x3d"1.0" encoding\x3d"utf-8"?\x3e\n');a.push('\x3cfeed xmlns\x3d"'+d._Constants.ATOM_URI+
'"');this.xmlBase&&a.push(' xml:base\x3d"'+this.xmlBase+'"');for(b in this.name_spaces)a.push(" xmlns:"+b+'\x3d"'+this.name_spaces[b]+'"');a.push("\x3e\n");a.push("\x3cid\x3e"+(this.id?this.id:"")+"\x3c/id\x3e\n");this.title&&a.push(this.title);this.copyright&&!this.rights&&(this.rights=this.copyright);this.rights&&a.push("\x3crights\x3e"+this.rights+"\x3c/rights\x3e\n");this.issued&&a.push("\x3cissued\x3e"+k.toISOString(this.issued)+"\x3c/issued\x3e\n");this.modified&&a.push("\x3cmodified\x3e"+k.toISOString(this.modified)+
"\x3c/modified\x3e\n");this.modified&&!this.updated&&(this.updated=this.modified);this.updated&&a.push("\x3cupdated\x3e"+k.toISOString(this.updated)+"\x3c/updated\x3e\n");this.published&&a.push("\x3cpublished\x3e"+k.toISOString(this.published)+"\x3c/published\x3e\n");this.icon&&a.push("\x3cicon\x3e"+this.icon+"\x3c/icon\x3e\n");this.language&&a.push("\x3clanguage\x3e"+this.language+"\x3c/language\x3e\n");this.logo&&a.push("\x3clogo\x3e"+this.logo+"\x3c/logo\x3e\n");this.subtitle&&a.push(this.subtitle.toString());
this.tagline&&a.push(this.tagline.toString());var c=[this.alternateLinks,this.authors,this.categories,this.contributors,this.otherLinks,this.extensions,this.entries];for(b in c)if(c[b])for(var e in c[b])a.push(c[b][e]);a.push("\x3c/feed\x3e");return a.join("")},createEntry:function(){var a=new d.Entry;a.feedUrl=this.getSelfHref();return a},getSelfHref:function(){if(null===this.links||0===this.links.length)return null;for(var a in this.links)if(this.links[a].rel&&"self"==this.links[a].rel)return this.links[a].href;
return null}});d.Service=h(d.AtomItem,{constructor:function(a){this.href=a},buildFromDom:function(a){this.workspaces=[];if("service"==a.tagName&&!(a.namespaceURI!=d._Constants.PURL_NS&&a.namespaceURI!=d._Constants.APP_NS)){var b=a.namespaceURI;this.name_space=a.namespaceURI;var c;if("undefined"!=typeof a.getElementsByTagNameNS)c=a.getElementsByTagNameNS(b,"workspace");else{c=[];var e=a.getElementsByTagName("workspace");for(a=0;a<e.length;a++)e[a].namespaceURI==b&&c.push(e[a])}if(c&&0<c.length)for(a=
b=0;a<c.length;a++){var e="undefined"===typeof c.item?c[a]:c.item(a),f=new d.Workspace;f.buildFromDom(e);this.workspaces[b++]=f}}},getCollection:function(a){for(var b=0;b<this.workspaces.length;b++)for(var c=this.workspaces[b].collections,d=0;d<c.length;d++)if(c[d].href==a)return c;return null}});d.Workspace=h(d.AtomItem,{constructor:function(a){this.title=a;this.collections=[]},buildFromDom:function(a){var b=d.util.getNodename(a);if("workspace"==b){a=a.childNodes;for(var c=0,e=0;e<a.length;e++){var f=
a[e];1===f.nodeType&&(b=d.util.getNodename(f),f.namespaceURI==d._Constants.PURL_NS||f.namespaceURI==d._Constants.APP_NS?"collection"===b&&(b=new d.Collection,b.buildFromDom(f),this.collections[c++]=b):f.namespaceURI===d._Constants.ATOM_NS&&"title"===b&&(this.title=g.textContent(f)))}}}});d.Collection=h(d.AtomItem,{constructor:function(a,b){this.href=a;this.title=b;this.attributes=[];this.features=[];this.children=[];this.id=this.memberType=null},buildFromDom:function(a){this.href=a.getAttribute("href");
a=a.childNodes;for(var b=0;b<a.length;b++){var c=a[b];if(1===c.nodeType){var e=d.util.getNodename(c);c.namespaceURI==d._Constants.PURL_NS||c.namespaceURI==d._Constants.APP_NS?"member-type"===e?this.memberType=g.textContent(c):"feature"==e?c.getAttribute("id")&&this.features.push(c.getAttribute("id")):(e=new d.Node,e.buildFromDom(c),this.children.push(e)):c.namespaceURI===d._Constants.ATOM_NS&&("id"===e?this.id=g.textContent(c):"title"===e&&(this.title=g.textContent(c)))}}}});return d});
//# sourceMappingURL=model.js.map