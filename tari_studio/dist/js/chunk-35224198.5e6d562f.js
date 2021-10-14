(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-35224198"],{"0fd9":function(t,a,e){"use strict";var o=e("ade3"),r=e("5530"),i=(e("caad"),e("2532"),e("99af"),e("b64b"),e("ac1f"),e("5319"),e("4ec9"),e("d3b7"),e("3ca3"),e("ddb0"),e("159b"),e("4b85"),e("2b0e")),n=e("d9f7"),s=e("80d2"),c=["sm","md","lg","xl"],l=["start","end","center"];function d(t,a){return c.reduce((function(e,o){return e[t+Object(s["G"])(o)]=a(),e}),{})}var u=function(t){return[].concat(l,["baseline","stretch"]).includes(t)},v=d("align",(function(){return{type:String,default:null,validator:u}})),f=function(t){return[].concat(l,["space-between","space-around"]).includes(t)},b=d("justify",(function(){return{type:String,default:null,validator:f}})),h=function(t){return[].concat(l,["space-between","space-around","stretch"]).includes(t)},g=d("alignContent",(function(){return{type:String,default:null,validator:h}})),m={align:Object.keys(v),justify:Object.keys(b),alignContent:Object.keys(g)},p={align:"align",justify:"justify",alignContent:"align-content"};function y(t,a,e){var o=p[t];if(null!=e){if(a){var r=a.replace(t,"");o+="-".concat(r)}return o+="-".concat(e),o.toLowerCase()}}var w=new Map;a["a"]=i["a"].extend({name:"v-row",functional:!0,props:Object(r["a"])(Object(r["a"])(Object(r["a"])({tag:{type:String,default:"div"},dense:Boolean,noGutters:Boolean,align:{type:String,default:null,validator:u}},v),{},{justify:{type:String,default:null,validator:f}},b),{},{alignContent:{type:String,default:null,validator:h}},g),render:function(t,a){var e=a.props,r=a.data,i=a.children,s="";for(var c in e)s+=String(e[c]);var l=w.get(s);return l||function(){var t,a;for(a in l=[],m)m[a].forEach((function(t){var o=e[t],r=y(a,t,o);r&&l.push(r)}));l.push((t={"no-gutters":e.noGutters,"row--dense":e.dense},Object(o["a"])(t,"align-".concat(e.align),e.align),Object(o["a"])(t,"justify-".concat(e.justify),e.justify),Object(o["a"])(t,"align-content-".concat(e.alignContent),e.alignContent),t)),w.set(s,l)}(),t(e.tag,Object(n["a"])(r,{staticClass:"row",class:l}),i)}})},"38e4":function(t,a,e){"use strict";e.r(a);var o=function(){var t,a=this,e=a.$createElement,o=a._self._c||e;return o("v-container",{attrs:{id:"alerts",fluid:"",tag:"section"}},[o("base-v-component",{attrs:{heading:"Alerts",link:"components/alerts"}}),o("v-row",[o("v-col",{attrs:{cols:"12",md:"6"}},[o("v-card",[o("v-card-text",[o("base-subheading",{attrs:{subheading:"Notification Style"}}),o("base-material-alert",{attrs:{color:"info",dark:""}},[a._v(" This is a plain notification. ")]),o("base-material-alert",{attrs:{color:"info",dark:"",dismissible:""}},[a._v(" This is a notification with close button. ")]),o("base-material-alert",{attrs:{color:"info",dark:"",dismissible:"",icon:"mdi-bell"}},[a._v(" This is a notification with close button and icon and have many lines. You can see that the icon and the close button are always vertically aligned. This is a beautiful notification. So you don't have to worry about the style. ")]),o("base-material-alert",{attrs:{color:"primary",dark:"",dismissible:"",icon:"mdi-bell"}},[a._v(" You can see that the icon and the close button are always vertically aligned. This is a beautiful notification. So you don't have to worry about the style. ")])],1)],1)],1),o("v-col",{attrs:{cols:"12",md:"6"}},[o("v-card",[o("v-card-text",[o("base-subheading",{attrs:{subheading:"Notification states"}}),a._l(a.colors,(function(t){return o("base-material-alert",{key:t,attrs:{color:t,dark:"",dismissible:""}},[o("span",{staticClass:"text-uppercase",domProps:{textContent:a._s(t)}}),a._v(' — This is a regular alert made with the color of "'+a._s(t)+'" ')])})),o("base-material-alert",{attrs:{color:"secondary",dark:"",dismissible:""}},[o("span",[a._v("PRIMARY")]),a._v(' — This is a regular alert made with the color "secondary" ')]),o("base-material-alert",{attrs:{color:"pink darken-1",dark:"",dismissible:""}},[o("span",[a._v("PINK DARKEN-1")]),a._v(' — This is a regular alert made with the color "pink darken-1" ')])],2)],1)],1),o("v-col",{attrs:{cols:"12"}},[o("v-card",[o("v-card-text",{staticClass:"text-center"},[o("base-subheading",{staticClass:"text-center",attrs:{subheading:"Snackbar Locations"}}),o("v-row",{staticClass:"mt-n12",attrs:{justify:"center"}},[o("v-col",{attrs:{cols:"10",lg:"8"}},[o("v-row",a._l(a.directions,(function(t){return o("v-col",{key:t,attrs:{cols:"4"}},[o("v-btn",{staticClass:"v-btn--block",attrs:{color:"secondary",default:""},on:{click:function(e){a.randomColor(),a.direction=t,a.snackbar=!0}}},[a._v(" "+a._s(t)+" ")])],1)})),1)],1)],1),o("base-subheading",{staticClass:"text-center",attrs:{subheading:"Dialogs"}}),o("v-row",{staticClass:"mt-n12",attrs:{justify:"center"}},[o("v-col",{attrs:{cols:"10",lg:"8"}},[o("v-row",[o("v-col",{attrs:{cols:"4"}},[o("v-btn",{attrs:{color:"secondary",default:"",rounded:""},on:{click:function(t){a.dialog=!0}}},[a._v(" Classic Dialog ")])],1),o("v-col",{attrs:{cols:"4"}},[o("v-btn",{attrs:{color:"info",default:"",rounded:""},on:{click:function(t){a.dialog2=!0}}},[a._v(" Notice Modal ")])],1),o("v-col",{attrs:{cols:"4"}},[o("v-btn",{attrs:{color:"pink darken-1",dark:"",default:"",rounded:""},on:{click:function(t){a.dialog3=!0}}},[a._v(" Small Alert Modal ")])],1)],1)],1)],1)],1)],1)],1)],1),o("base-material-snackbar",a._b({attrs:{type:a.color},model:{value:a.snackbar,callback:function(t){a.snackbar=t},expression:"snackbar"}},"base-material-snackbar",(t={},t[a.parsedDirection[0]]=!0,t[a.parsedDirection[1]]=!0,t),!1),[a._v(" Welcome to "),o("span",{staticClass:"font-weight-bold"},[a._v(" MATERIAL DASHBOARD ")]),a._v(" — a beautiful admin panel for every web developer. ")]),o("v-dialog",{attrs:{"max-width":"500"},model:{value:a.dialog,callback:function(t){a.dialog=t},expression:"dialog"}},[o("v-card",{staticClass:"text-center"},[o("v-card-title",[a._v(" Dialog Title "),o("v-spacer"),o("v-icon",{attrs:{"aria-label":"Close"},on:{click:function(t){a.dialog=!1}}},[a._v(" mdi-close ")])],1),o("v-card-text",[a._v(" Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. ")]),o("v-card-actions",[o("v-spacer"),o("v-btn",{attrs:{color:"error",text:""},on:{click:function(t){a.dialog=!1}}},[a._v(" Close ")])],1)],1)],1),o("v-dialog",{attrs:{"max-width":"500"},model:{value:a.dialog2,callback:function(t){a.dialog2=t},expression:"dialog2"}},[o("v-card",[o("v-card-title",[a._v(" How do you become an affiliate? "),o("v-spacer"),o("v-icon",{attrs:{"aria-label":"Close"},on:{click:function(t){a.dialog2=!1}}},[a._v(" mdi-close ")])],1),o("v-card-text",{staticClass:" text-center"},[o("v-row",[o("v-col",{attrs:{cols:"12",md:"8"}},[o("div",[o("div",[o("strong",[a._v("1. Register")])]),o("div",{staticClass:"grey--text"},[a._v(" The first step is to create an account at Creative Tim. You can choose a social network or go for the classic version, whatever works best for you. ")])])]),o("v-col",{staticClass:"hidden-sm-and-down",attrs:{md:"4"}},[o("v-sheet",[o("v-img",{attrs:{src:"https://demos.creative-tim.com/material-dashboard/assets/img/card-1.jpg",height:"100",width:"200"}})],1)],1),o("v-col",{attrs:{cols:"12",md:"8"}},[o("div",[o("div",[o("strong",[a._v("2. Apply")])]),o("div",{staticClass:"grey--text"},[a._v(" The first step is to create an account at "),o("a",{attrs:{href:"http://www.creative-tim.com/"}},[a._v("Creative Tim")]),a._v(". You can choose a social network or go for the classic version, whatever works best for you. ")])])]),o("v-col",{staticClass:"hidden-sm-and-down",attrs:{md:"4"}},[o("v-sheet",[o("v-img",{attrs:{src:"https://demos.creative-tim.com/material-dashboard/assets/img/card-2.jpg",height:"100",width:"200"}})],1)],1),o("v-col",{attrs:{cols:"12"}},[a._v(" If you have more questions, don't hesitate to contact us or send us a tweet @creativetim. We're here to help! ")])],1),o("v-btn",{staticClass:"mt-6",attrs:{color:"info",depressed:"",default:"",rounded:""},on:{click:function(t){a.dialog2=!1}}},[a._v(" Sounds good ")])],1)],1)],1),o("v-dialog",{attrs:{"max-width":"300"},model:{value:a.dialog3,callback:function(t){a.dialog3=t},expression:"dialog3"}},[o("v-card",[o("v-card-title",[a._v(" Are you sure? "),o("v-spacer"),o("v-icon",{attrs:{"aria-label":"Close"},on:{click:function(t){a.dialog3=!1}}},[a._v(" mdi-close ")])],1),o("v-card-text",{staticClass:"pb-6 pt-12 text-center"},[o("v-btn",{staticClass:"mr-3",attrs:{text:""},on:{click:function(t){a.dialog3=!1}}},[a._v(" Nevermind ")]),o("v-btn",{attrs:{color:"success",text:""},on:{click:function(t){a.dialog3=!1}}},[a._v(" Yes ")])],1)],1)],1)],1)},r=[],i=(e("ac1f"),e("1276"),{name:"DashboardNotifications",data:function(){return{color:"info",colors:["info","success","warning","error"],dialog:!1,dialog2:!1,dialog3:!1,direction:"top center",directions:["top left","top center","top right","bottom left","bottom center","bottom right"],snackbar:!1}},computed:{parsedDirection:function(){return this.direction.split(" ")}},methods:{randomColor:function(){this.color=this.colors[Math.floor(Math.random()*this.colors.length)]}}}),n=i,s=e("2877"),c=e("6544"),l=e.n(c),d=e("8336"),u=e("b0af"),v=e("99d9"),f=e("62ad"),b=e("a523"),h=e("169a"),g=e("132d"),m=e("adda"),p=e("0fd9"),y=e("8dd9"),w=e("2fa4"),k=Object(s["a"])(n,o,r,!1,null,null,null);a["default"]=k.exports;l()(k,{VBtn:d["a"],VCard:u["a"],VCardActions:v["a"],VCardText:v["c"],VCardTitle:v["d"],VCol:f["a"],VContainer:b["a"],VDialog:h["a"],VIcon:g["a"],VImg:m["a"],VRow:p["a"],VSheet:y["a"],VSpacer:w["a"]})},a523:function(t,a,e){"use strict";e("4de4"),e("b64b"),e("2ca0"),e("99af"),e("20f6"),e("4b85"),e("498a"),e("a15b");var o=e("2b0e");function r(t){return o["a"].extend({name:"v-".concat(t),functional:!0,props:{id:String,tag:{type:String,default:"div"}},render:function(a,e){var o=e.props,r=e.data,i=e.children;r.staticClass="".concat(t," ").concat(r.staticClass||"").trim();var n=r.attrs;if(n){r.attrs={};var s=Object.keys(n).filter((function(t){if("slot"===t)return!1;var a=n[t];return t.startsWith("data-")?(r.attrs[t]=a,!1):a||"string"===typeof a}));s.length&&(r.staticClass+=" ".concat(s.join(" ")))}return o.id&&(r.domProps=r.domProps||{},r.domProps.id=o.id),a(o.tag,r,i)}})}var i=e("d9f7");a["a"]=r("container").extend({name:"v-container",functional:!0,props:{id:String,tag:{type:String,default:"div"},fluid:{type:Boolean,default:!1}},render:function(t,a){var e,o=a.props,r=a.data,n=a.children,s=r.attrs;return s&&(r.attrs={},e=Object.keys(s).filter((function(t){if("slot"===t)return!1;var a=s[t];return t.startsWith("data-")?(r.attrs[t]=a,!1):a||"string"===typeof a}))),o.id&&(r.domProps=r.domProps||{},r.domProps.id=o.id),t(o.tag,Object(i["a"])(r,{staticClass:"container",class:Array({"container--fluid":o.fluid}).concat(e||[])}),n)}})}}]);
//# sourceMappingURL=chunk-35224198.5e6d562f.js.map