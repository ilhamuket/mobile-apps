(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-64d7a9f5"],{"38e4":function(t,a,e){"use strict";e.r(a);var o=function(){var t,a=this,e=a.$createElement,o=a._self._c||e;return o("v-container",{attrs:{id:"alerts",fluid:"",tag:"section"}},[o("base-v-component",{attrs:{heading:"Alerts",link:"components/alerts"}}),o("v-row",[o("v-col",{attrs:{cols:"12",md:"6"}},[o("v-card",[o("v-card-text",[o("base-subheading",{attrs:{subheading:"Notification Style"}}),o("base-material-alert",{attrs:{color:"info",dark:""}},[a._v(" This is a plain notification. ")]),o("base-material-alert",{attrs:{color:"info",dark:"",dismissible:""}},[a._v(" This is a notification with close button. ")]),o("base-material-alert",{attrs:{color:"info",dark:"",dismissible:"",icon:"mdi-bell"}},[a._v(" This is a notification with close button and icon and have many lines. You can see that the icon and the close button are always vertically aligned. This is a beautiful notification. So you don't have to worry about the style. ")]),o("base-material-alert",{attrs:{color:"primary",dark:"",dismissible:"",icon:"mdi-bell"}},[a._v(" You can see that the icon and the close button are always vertically aligned. This is a beautiful notification. So you don't have to worry about the style. ")])],1)],1)],1),o("v-col",{attrs:{cols:"12",md:"6"}},[o("v-card",[o("v-card-text",[o("base-subheading",{attrs:{subheading:"Notification states"}}),a._l(a.colors,(function(t){return o("base-material-alert",{key:t,attrs:{color:t,dark:"",dismissible:""}},[o("span",{staticClass:"text-uppercase",domProps:{textContent:a._s(t)}}),a._v(' — This is a regular alert made with the color of "'+a._s(t)+'" ')])})),o("base-material-alert",{attrs:{color:"secondary",dark:"",dismissible:""}},[o("span",[a._v("PRIMARY")]),a._v(' — This is a regular alert made with the color "secondary" ')]),o("base-material-alert",{attrs:{color:"pink darken-1",dark:"",dismissible:""}},[o("span",[a._v("PINK DARKEN-1")]),a._v(' — This is a regular alert made with the color "pink darken-1" ')])],2)],1)],1),o("v-col",{attrs:{cols:"12"}},[o("v-card",[o("v-card-text",{staticClass:"text-center"},[o("base-subheading",{staticClass:"text-center",attrs:{subheading:"Snackbar Locations"}}),o("v-row",{staticClass:"mt-n12",attrs:{justify:"center"}},[o("v-col",{attrs:{cols:"10",lg:"8"}},[o("v-row",a._l(a.directions,(function(t){return o("v-col",{key:t,attrs:{cols:"4"}},[o("v-btn",{staticClass:"v-btn--block",attrs:{color:"secondary",default:""},on:{click:function(e){a.randomColor(),a.direction=t,a.snackbar=!0}}},[a._v(" "+a._s(t)+" ")])],1)})),1)],1)],1),o("base-subheading",{staticClass:"text-center",attrs:{subheading:"Dialogs"}}),o("v-row",{staticClass:"mt-n12",attrs:{justify:"center"}},[o("v-col",{attrs:{cols:"10",lg:"8"}},[o("v-row",[o("v-col",{attrs:{cols:"4"}},[o("v-btn",{attrs:{color:"secondary",default:"",rounded:""},on:{click:function(t){a.dialog=!0}}},[a._v(" Classic Dialog ")])],1),o("v-col",{attrs:{cols:"4"}},[o("v-btn",{attrs:{color:"info",default:"",rounded:""},on:{click:function(t){a.dialog2=!0}}},[a._v(" Notice Modal ")])],1),o("v-col",{attrs:{cols:"4"}},[o("v-btn",{attrs:{color:"pink darken-1",dark:"",default:"",rounded:""},on:{click:function(t){a.dialog3=!0}}},[a._v(" Small Alert Modal ")])],1)],1)],1)],1)],1)],1)],1)],1),o("base-material-snackbar",a._b({attrs:{type:a.color},model:{value:a.snackbar,callback:function(t){a.snackbar=t},expression:"snackbar"}},"base-material-snackbar",(t={},t[a.parsedDirection[0]]=!0,t[a.parsedDirection[1]]=!0,t),!1),[a._v(" Welcome to "),o("span",{staticClass:"font-weight-bold"},[a._v(" MATERIAL DASHBOARD ")]),a._v(" — a beautiful admin panel for every web developer. ")]),o("v-dialog",{attrs:{"max-width":"500"},model:{value:a.dialog,callback:function(t){a.dialog=t},expression:"dialog"}},[o("v-card",{staticClass:"text-center"},[o("v-card-title",[a._v(" Dialog Title "),o("v-spacer"),o("v-icon",{attrs:{"aria-label":"Close"},on:{click:function(t){a.dialog=!1}}},[a._v(" mdi-close ")])],1),o("v-card-text",[a._v(" Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. ")]),o("v-card-actions",[o("v-spacer"),o("v-btn",{attrs:{color:"error",text:""},on:{click:function(t){a.dialog=!1}}},[a._v(" Close ")])],1)],1)],1),o("v-dialog",{attrs:{"max-width":"500"},model:{value:a.dialog2,callback:function(t){a.dialog2=t},expression:"dialog2"}},[o("v-card",[o("v-card-title",[a._v(" How do you become an affiliate? "),o("v-spacer"),o("v-icon",{attrs:{"aria-label":"Close"},on:{click:function(t){a.dialog2=!1}}},[a._v(" mdi-close ")])],1),o("v-card-text",{staticClass:" text-center"},[o("v-row",[o("v-col",{attrs:{cols:"12",md:"8"}},[o("div",[o("div",[o("strong",[a._v("1. Register")])]),o("div",{staticClass:"grey--text"},[a._v(" The first step is to create an account at Creative Tim. You can choose a social network or go for the classic version, whatever works best for you. ")])])]),o("v-col",{staticClass:"hidden-sm-and-down",attrs:{md:"4"}},[o("v-sheet",[o("v-img",{attrs:{src:"https://demos.creative-tim.com/material-dashboard/assets/img/card-1.jpg",height:"100",width:"200"}})],1)],1),o("v-col",{attrs:{cols:"12",md:"8"}},[o("div",[o("div",[o("strong",[a._v("2. Apply")])]),o("div",{staticClass:"grey--text"},[a._v(" The first step is to create an account at "),o("a",{attrs:{href:"http://www.creative-tim.com/"}},[a._v("Creative Tim")]),a._v(". You can choose a social network or go for the classic version, whatever works best for you. ")])])]),o("v-col",{staticClass:"hidden-sm-and-down",attrs:{md:"4"}},[o("v-sheet",[o("v-img",{attrs:{src:"https://demos.creative-tim.com/material-dashboard/assets/img/card-2.jpg",height:"100",width:"200"}})],1)],1),o("v-col",{attrs:{cols:"12"}},[a._v(" If you have more questions, don't hesitate to contact us or send us a tweet @creativetim. We're here to help! ")])],1),o("v-btn",{staticClass:"mt-6",attrs:{color:"info",depressed:"",default:"",rounded:""},on:{click:function(t){a.dialog2=!1}}},[a._v(" Sounds good ")])],1)],1)],1),o("v-dialog",{attrs:{"max-width":"300"},model:{value:a.dialog3,callback:function(t){a.dialog3=t},expression:"dialog3"}},[o("v-card",[o("v-card-title",[a._v(" Are you sure? "),o("v-spacer"),o("v-icon",{attrs:{"aria-label":"Close"},on:{click:function(t){a.dialog3=!1}}},[a._v(" mdi-close ")])],1),o("v-card-text",{staticClass:"pb-6 pt-12 text-center"},[o("v-btn",{staticClass:"mr-3",attrs:{text:""},on:{click:function(t){a.dialog3=!1}}},[a._v(" Nevermind ")]),o("v-btn",{attrs:{color:"success",text:""},on:{click:function(t){a.dialog3=!1}}},[a._v(" Yes ")])],1)],1)],1)],1)},i=[],s=(e("ac1f"),e("1276"),{name:"DashboardNotifications",data:function(){return{color:"info",colors:["info","success","warning","error"],dialog:!1,dialog2:!1,dialog3:!1,direction:"top center",directions:["top left","top center","top right","bottom left","bottom center","bottom right"],snackbar:!1}},computed:{parsedDirection:function(){return this.direction.split(" ")}},methods:{randomColor:function(){this.color=this.colors[Math.floor(Math.random()*this.colors.length)]}}}),n=s,r=e("2877"),c=e("6544"),l=e.n(c),d=e("8336"),u=e("b0af"),v=e("99d9"),f=e("62ad"),h=e("a523"),m=e("169a"),b=e("132d"),g=e("adda"),p=e("0fd9"),k=e("8dd9"),w=e("2fa4"),_=Object(r["a"])(n,o,i,!1,null,null,null);a["default"]=_.exports;l()(_,{VBtn:d["a"],VCard:u["a"],VCardActions:v["a"],VCardText:v["c"],VCardTitle:v["d"],VCol:f["a"],VContainer:h["a"],VDialog:m["a"],VIcon:b["a"],VImg:g["a"],VRow:p["a"],VSheet:k["a"],VSpacer:w["a"]})},"480e":function(t,a,e){"use strict";e("7db0"),e("d3b7");var o=e("7560");a["a"]=o["a"].extend({name:"v-theme-provider",props:{root:Boolean},computed:{isDark:function(){return this.root?this.rootIsDark:o["a"].options.computed.isDark.call(this)}},render:function(){return this.$slots.default&&this.$slots.default.find((function(t){return!t.isComment&&" "!==t.text}))}})},a293:function(t,a,e){"use strict";var o=e("53ca"),i=(e("d3b7"),e("dd89"));function s(){return!0}function n(t,a,e){if(!t||!1===r(t,e))return!1;var s=Object(i["a"])(a);if("undefined"!==typeof ShadowRoot&&s instanceof ShadowRoot&&s.host===t.target)return!1;var n=("object"===Object(o["a"])(e.value)&&e.value.include||function(){return[]})();return n.push(a),!n.some((function(a){return a.contains(t.target)}))}function r(t,a){var e="object"===Object(o["a"])(a.value)&&a.value.closeConditional||s;return e(t)}function c(t,a,e){var o="function"===typeof e.value?e.value:e.value.handler;a._clickOutside.lastMousedownWasOutside&&n(t,a,e)&&setTimeout((function(){r(t,e)&&o&&o(t)}),0)}function l(t,a){var e=Object(i["a"])(t);a(document),"undefined"!==typeof ShadowRoot&&e instanceof ShadowRoot&&a(e)}var d={inserted:function(t,a){var e=function(e){return c(e,t,a)},o=function(e){t._clickOutside.lastMousedownWasOutside=n(e,t,a)};l(t,(function(t){t.addEventListener("click",e,!0),t.addEventListener("mousedown",o,!0)})),t._clickOutside={lastMousedownWasOutside:!0,onClick:e,onMousedown:o}},unbind:function(t){t._clickOutside&&(l(t,(function(a){a&&t._clickOutside&&(a.removeEventListener("click",t._clickOutside.onClick,!0),a.removeEventListener("mousedown",t._clickOutside.onMousedown,!0))})),delete t._clickOutside)}};a["a"]=d},dd89:function(t,a,e){"use strict";function o(t){if("function"!==typeof t.getRootNode){while(t.parentNode)t=t.parentNode;return t!==document?null:document}var a=t.getRootNode();return a!==document&&a.getRootNode({composed:!0})!==document?null:a}e.d(a,"a",(function(){return o}))},e4d3:function(t,a,e){"use strict";var o=e("2b0e");a["a"]=o["a"].extend({name:"returnable",props:{returnValue:null},data:function(){return{isActive:!1,originalValue:null}},watch:{isActive:function(t){t?this.originalValue=this.returnValue:this.$emit("update:return-value",this.originalValue)}},methods:{save:function(t){var a=this;this.originalValue=t,setTimeout((function(){a.isActive=!1}))}}})}}]);
//# sourceMappingURL=chunk-64d7a9f5.59694444.js.map