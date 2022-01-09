(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-64d7a9f5"],{"38e4":function(t,e,a){"use strict";a.r(e);var o=function(){var t,e=this,a=e.$createElement,o=e._self._c||a;return o("v-container",{attrs:{id:"alerts",fluid:"",tag:"section"}},[o("base-v-component",{attrs:{heading:"Alerts",link:"components/alerts"}}),o("v-row",[o("v-col",{attrs:{cols:"12",md:"6"}},[o("v-card",[o("v-card-text",[o("base-subheading",{attrs:{subheading:"Notification Style"}}),o("base-material-alert",{attrs:{color:"info",dark:""}},[e._v(" This is a plain notification. ")]),o("base-material-alert",{attrs:{color:"info",dark:"",dismissible:""}},[e._v(" This is a notification with close button. ")]),o("base-material-alert",{attrs:{color:"info",dark:"",dismissible:"",icon:"mdi-bell"}},[e._v(" This is a notification with close button and icon and have many lines. You can see that the icon and the close button are always vertically aligned. This is a beautiful notification. So you don't have to worry about the style. ")]),o("base-material-alert",{attrs:{color:"primary",dark:"",dismissible:"",icon:"mdi-bell"}},[e._v(" You can see that the icon and the close button are always vertically aligned. This is a beautiful notification. So you don't have to worry about the style. ")])],1)],1)],1),o("v-col",{attrs:{cols:"12",md:"6"}},[o("v-card",[o("v-card-text",[o("base-subheading",{attrs:{subheading:"Notification states"}}),e._l(e.colors,(function(t){return o("base-material-alert",{key:t,attrs:{color:t,dark:"",dismissible:""}},[o("span",{staticClass:"text-uppercase",domProps:{textContent:e._s(t)}}),e._v(' — This is a regular alert made with the color of "'+e._s(t)+'" ')])})),o("base-material-alert",{attrs:{color:"secondary",dark:"",dismissible:""}},[o("span",[e._v("PRIMARY")]),e._v(' — This is a regular alert made with the color "secondary" ')]),o("base-material-alert",{attrs:{color:"pink darken-1",dark:"",dismissible:""}},[o("span",[e._v("PINK DARKEN-1")]),e._v(' — This is a regular alert made with the color "pink darken-1" ')])],2)],1)],1),o("v-col",{attrs:{cols:"12"}},[o("v-card",[o("v-card-text",{staticClass:"text-center"},[o("base-subheading",{staticClass:"text-center",attrs:{subheading:"Snackbar Locations"}}),o("v-row",{staticClass:"mt-n12",attrs:{justify:"center"}},[o("v-col",{attrs:{cols:"10",lg:"8"}},[o("v-row",e._l(e.directions,(function(t){return o("v-col",{key:t,attrs:{cols:"4"}},[o("v-btn",{staticClass:"v-btn--block",attrs:{color:"secondary",default:""},on:{click:function(a){e.randomColor(),e.direction=t,e.snackbar=!0}}},[e._v(" "+e._s(t)+" ")])],1)})),1)],1)],1),o("base-subheading",{staticClass:"text-center",attrs:{subheading:"Dialogs"}}),o("v-row",{staticClass:"mt-n12",attrs:{justify:"center"}},[o("v-col",{attrs:{cols:"10",lg:"8"}},[o("v-row",[o("v-col",{attrs:{cols:"4"}},[o("v-btn",{attrs:{color:"secondary",default:"",rounded:""},on:{click:function(t){e.dialog=!0}}},[e._v(" Classic Dialog ")])],1),o("v-col",{attrs:{cols:"4"}},[o("v-btn",{attrs:{color:"info",default:"",rounded:""},on:{click:function(t){e.dialog2=!0}}},[e._v(" Notice Modal ")])],1),o("v-col",{attrs:{cols:"4"}},[o("v-btn",{attrs:{color:"pink darken-1",dark:"",default:"",rounded:""},on:{click:function(t){e.dialog3=!0}}},[e._v(" Small Alert Modal ")])],1)],1)],1)],1)],1)],1)],1)],1),o("base-material-snackbar",e._b({attrs:{type:e.color},model:{value:e.snackbar,callback:function(t){e.snackbar=t},expression:"snackbar"}},"base-material-snackbar",(t={},t[e.parsedDirection[0]]=!0,t[e.parsedDirection[1]]=!0,t),!1),[e._v(" Welcome to "),o("span",{staticClass:"font-weight-bold"},[e._v(" MATERIAL DASHBOARD ")]),e._v(" — a beautiful admin panel for every web developer. ")]),o("v-dialog",{attrs:{"max-width":"500"},model:{value:e.dialog,callback:function(t){e.dialog=t},expression:"dialog"}},[o("v-card",{staticClass:"text-center"},[o("v-card-title",[e._v(" Dialog Title "),o("v-spacer"),o("v-icon",{attrs:{"aria-label":"Close"},on:{click:function(t){e.dialog=!1}}},[e._v(" mdi-close ")])],1),o("v-card-text",[e._v(" Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. ")]),o("v-card-actions",[o("v-spacer"),o("v-btn",{attrs:{color:"error",text:""},on:{click:function(t){e.dialog=!1}}},[e._v(" Close ")])],1)],1)],1),o("v-dialog",{attrs:{"max-width":"500"},model:{value:e.dialog2,callback:function(t){e.dialog2=t},expression:"dialog2"}},[o("v-card",[o("v-card-title",[e._v(" How do you become an affiliate? "),o("v-spacer"),o("v-icon",{attrs:{"aria-label":"Close"},on:{click:function(t){e.dialog2=!1}}},[e._v(" mdi-close ")])],1),o("v-card-text",{staticClass:" text-center"},[o("v-row",[o("v-col",{attrs:{cols:"12",md:"8"}},[o("div",[o("div",[o("strong",[e._v("1. Register")])]),o("div",{staticClass:"grey--text"},[e._v(" The first step is to create an account at Creative Tim. You can choose a social network or go for the classic version, whatever works best for you. ")])])]),o("v-col",{staticClass:"hidden-sm-and-down",attrs:{md:"4"}},[o("v-sheet",[o("v-img",{attrs:{src:"https://demos.creative-tim.com/material-dashboard/assets/img/card-1.jpg",height:"100",width:"200"}})],1)],1),o("v-col",{attrs:{cols:"12",md:"8"}},[o("div",[o("div",[o("strong",[e._v("2. Apply")])]),o("div",{staticClass:"grey--text"},[e._v(" The first step is to create an account at "),o("a",{attrs:{href:"http://www.creative-tim.com/"}},[e._v("Creative Tim")]),e._v(". You can choose a social network or go for the classic version, whatever works best for you. ")])])]),o("v-col",{staticClass:"hidden-sm-and-down",attrs:{md:"4"}},[o("v-sheet",[o("v-img",{attrs:{src:"https://demos.creative-tim.com/material-dashboard/assets/img/card-2.jpg",height:"100",width:"200"}})],1)],1),o("v-col",{attrs:{cols:"12"}},[e._v(" If you have more questions, don't hesitate to contact us or send us a tweet @creativetim. We're here to help! ")])],1),o("v-btn",{staticClass:"mt-6",attrs:{color:"info",depressed:"",default:"",rounded:""},on:{click:function(t){e.dialog2=!1}}},[e._v(" Sounds good ")])],1)],1)],1),o("v-dialog",{attrs:{"max-width":"300"},model:{value:e.dialog3,callback:function(t){e.dialog3=t},expression:"dialog3"}},[o("v-card",[o("v-card-title",[e._v(" Are you sure? "),o("v-spacer"),o("v-icon",{attrs:{"aria-label":"Close"},on:{click:function(t){e.dialog3=!1}}},[e._v(" mdi-close ")])],1),o("v-card-text",{staticClass:"pb-6 pt-12 text-center"},[o("v-btn",{staticClass:"mr-3",attrs:{text:""},on:{click:function(t){e.dialog3=!1}}},[e._v(" Nevermind ")]),o("v-btn",{attrs:{color:"success",text:""},on:{click:function(t){e.dialog3=!1}}},[e._v(" Yes ")])],1)],1)],1)],1)},i=[],s=(a("ac1f"),a("1276"),{name:"DashboardNotifications",data:function(){return{color:"info",colors:["info","success","warning","error"],dialog:!1,dialog2:!1,dialog3:!1,direction:"top center",directions:["top left","top center","top right","bottom left","bottom center","bottom right"],snackbar:!1}},computed:{parsedDirection:function(){return this.direction.split(" ")}},methods:{randomColor:function(){this.color=this.colors[Math.floor(Math.random()*this.colors.length)]}}}),n=s,r=a("2877"),c=a("6544"),l=a.n(c),d=a("8336"),u=a("b0af"),v=a("99d9"),f=a("62ad"),h=a("a523"),m=a("169a"),b=a("132d"),g=a("adda"),p=a("0fd9"),k=a("8dd9"),w=a("2fa4"),_=Object(r["a"])(n,o,i,!1,null,null,null);e["default"]=_.exports;l()(_,{VBtn:d["a"],VCard:u["a"],VCardActions:v["a"],VCardText:v["c"],VCardTitle:v["d"],VCol:f["a"],VContainer:h["a"],VDialog:m["a"],VIcon:b["a"],VImg:g["a"],VRow:p["a"],VSheet:k["a"],VSpacer:w["a"]})},"480e":function(t,e,a){"use strict";a("7db0"),a("d3b7");var o=a("7560");e["a"]=o["a"].extend({name:"v-theme-provider",props:{root:Boolean},computed:{isDark:function(){return this.root?this.rootIsDark:o["a"].options.computed.isDark.call(this)}},render:function(){return this.$slots.default&&this.$slots.default.find((function(t){return!t.isComment&&" "!==t.text}))}})},a293:function(t,e,a){"use strict";var o=a("53ca"),i=(a("d3b7"),a("dd89"));function s(){return!0}function n(t,e,a){if(!t||!1===r(t,a))return!1;var s=Object(i["a"])(e);if("undefined"!==typeof ShadowRoot&&s instanceof ShadowRoot&&s.host===t.target)return!1;var n=("object"===Object(o["a"])(a.value)&&a.value.include||function(){return[]})();return n.push(e),!n.some((function(e){return e.contains(t.target)}))}function r(t,e){var a="object"===Object(o["a"])(e.value)&&e.value.closeConditional||s;return a(t)}function c(t,e,a,o){var i="function"===typeof a.value?a.value:a.value.handler;e._clickOutside.lastMousedownWasOutside&&n(t,e,a)&&setTimeout((function(){r(t,a)&&i&&i(t)}),0)}function l(t,e){var a=Object(i["a"])(t);e(document),"undefined"!==typeof ShadowRoot&&a instanceof ShadowRoot&&e(a)}var d={inserted:function(t,e,a){var o=function(o){return c(o,t,e,a)},i=function(a){t._clickOutside.lastMousedownWasOutside=n(a,t,e)};l(t,(function(t){t.addEventListener("click",o,!0),t.addEventListener("mousedown",i,!0)})),t._clickOutside||(t._clickOutside={lastMousedownWasOutside:!0}),t._clickOutside[a.context._uid]={onClick:o,onMousedown:i}},unbind:function(t,e,a){t._clickOutside&&(l(t,(function(e){var o;if(e&&null!=(o=t._clickOutside)&&o[a.context._uid]){var i=t._clickOutside[a.context._uid],s=i.onClick,n=i.onMousedown;e.removeEventListener("click",s,!0),e.removeEventListener("mousedown",n,!0)}})),delete t._clickOutside[a.context._uid])}};e["a"]=d},dd89:function(t,e,a){"use strict";function o(t){if("function"!==typeof t.getRootNode){while(t.parentNode)t=t.parentNode;return t!==document?null:document}var e=t.getRootNode();return e!==document&&e.getRootNode({composed:!0})!==document?null:e}a.d(e,"a",(function(){return o}))},e4d3:function(t,e,a){"use strict";var o=a("2b0e");e["a"]=o["a"].extend({name:"returnable",props:{returnValue:null},data:function(){return{isActive:!1,originalValue:null}},watch:{isActive:function(t){t?this.originalValue=this.returnValue:this.$emit("update:return-value",this.originalValue)}},methods:{save:function(t){var e=this;this.originalValue=t,setTimeout((function(){e.isActive=!1}))}}})}}]);
//# sourceMappingURL=chunk-64d7a9f5.fe90f94e.js.map