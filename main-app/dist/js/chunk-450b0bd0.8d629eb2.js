(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-450b0bd0"],{"0590":function(t,e,a){"use strict";a("c342")},"059b":function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-app",[a("v-container",[a("v-row",{staticClass:"mt-12"},[a("v-col",{attrs:{cols:"12"}},[a("v-card",{staticClass:"mx-auto rounded-xl",attrs:{width:"500",outlined:""}},[a("v-list-item",{staticClass:"opacity-1",attrs:{"three-line":""}},[a("v-list-item-content",[a("div",{staticClass:"text-overline mb-4 text-center font-size-ather-roboto-mono text-custome-brand"},[t._v(" ENSIKLOTARI ")]),a("div",{staticClass:"d-flex flex-row justify-center"},[a("div",{staticClass:"d-flex flex-column"},[a("v-list-item-title",{staticClass:"text-h5 mb-1 text-center font-size-ather-roboto-mono"},[t._v(" Nama : "+t._s(t.users.nickName)+" ")]),a("v-list-item-subtitle",[t._v(" Email : "+t._s(t.users.email)+" ")])],1)]),a("div",{staticClass:"d-flex flex-row justify-center mt-2"},[a("div",{staticClass:"d-flex flex-column"},[a("p",{staticClass:"text-center font-size-ather-roboto-mono"},[t._v(" Hai, Silahkan Periksa Email Anda Untuk Mengverifikasi Akun Anda Terimakasih ")])])]),a("div",{staticClass:"d-flex flex-row justify-center mt-2"},[a("div",{staticClass:"d-flex flex-column"},[a("p",{staticClass:"text-center font-size-ather-roboto-mono"},[t._v(" Terima Kasih ")])])]),a("div",{staticClass:"d-flex flex-row justify-center"},[a("div",{staticClass:"d-flex flex-column"},[a("p",{staticClass:"text-center font-size-ather-roboto-mono"},[t._v(" ENSIKLOTARI ")])])]),a("div",{staticClass:"d-flex flex-row justify-center"},[a("div",{staticClass:"d-flex flex-column"},[a("p",{staticClass:"text-center font-size-ather-roboto-mono"},[t._v(" "+t._s(t._f("moment")(t.users.created_at,"MMMM Do YYYY"))+" ")])])])])],1),a("v-card-actions",{staticClass:"d-flex justify-center"},[a("v-btn",{attrs:{outlined:"",rounded:"",text:"",disabled:t.isDisable},on:{click:t.sendVerifications}},[t._v(" KIRIM VERIFIKASI ")])],1)],1)],1)],1)],1)],1)},n=[],s=a("bc3a"),r=a.n(s),o={data:function(){return{isDisable:!1,time:60,timer:null}},computed:{users:function(){var t=localStorage.getItem("ME"),e=JSON.parse(t);return e}},methods:{click:function(){var t=this;this.isDisable=!0,setInterval((function(){60===this.time&&clearInterval(this),this.time++}),1e3),setTimeout((function(){t.isDisable=!1}),6e4)},counter:function(){return this.time<60?this.time:this.time>0?this.time--:(clearInterval(this.timer),void console.log(this.time))},sendVerifications:function(){var t=this;r.a.defaults.headers.common.Authorization="Bearer "+localStorage.getItem("access_token"),r.a.defaults.baseURL="http://127.0.0.1:8000/v1/",this.isDisable=!0,r.a.get("auth/verifications/resend").then((function(e){if(e.data.meta.status){var a=t.$swal.mixin({toast:!0,position:"bottom-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:function(e){e.addEventListener("mouseenter",t.$swal.stopTimer),e.addEventListener("mouseleave",t.$swal.resumeTimer)},popup:"swal2-show",backdrop:"swal2-backdrop-show",icon:"swal2-icon-show"});a.fire({icon:"success",title:e.data.data}),t.timer||(t.timer=window.setInterval((function(){return this.time<60?this.time:this.time>0?this.time--:void clearInterval(this.timer)}),1e3))}setTimeout((function(){t.isDisable=!1}),6e4)}))}}},c=o,l=(a("0590"),a("2877")),u=a("6544"),d=a.n(u),f=a("7496"),v=a("8336"),p=a("b0af"),m=a("99d9"),h=a("62ad"),b=a("a523"),g=a("da13"),y=a("5d23"),C=a("0fd9"),x=Object(l["a"])(c,i,n,!1,null,"2f888b71",null);e["default"]=x.exports;d()(x,{VApp:f["a"],VBtn:v["a"],VCard:p["a"],VCardActions:m["a"],VCol:h["a"],VContainer:b["a"],VListItem:g["a"],VListItemContent:y["b"],VListItemSubtitle:y["c"],VListItemTitle:y["d"],VRow:C["a"]})},"0fd9":function(t,e,a){"use strict";var i=a("ade3"),n=a("5530"),s=(a("d3b7"),a("caad"),a("2532"),a("99af"),a("b64b"),a("ac1f"),a("5319"),a("4ec9"),a("3ca3"),a("ddb0"),a("159b"),a("4b85"),a("2b0e")),r=a("d9f7"),o=a("80d2"),c=["sm","md","lg","xl"],l=["start","end","center"];function u(t,e){return c.reduce((function(a,i){return a[t+Object(o["G"])(i)]=e(),a}),{})}var d=function(t){return[].concat(l,["baseline","stretch"]).includes(t)},f=u("align",(function(){return{type:String,default:null,validator:d}})),v=function(t){return[].concat(l,["space-between","space-around"]).includes(t)},p=u("justify",(function(){return{type:String,default:null,validator:v}})),m=function(t){return[].concat(l,["space-between","space-around","stretch"]).includes(t)},h=u("alignContent",(function(){return{type:String,default:null,validator:m}})),b={align:Object.keys(f),justify:Object.keys(p),alignContent:Object.keys(h)},g={align:"align",justify:"justify",alignContent:"align-content"};function y(t,e,a){var i=g[t];if(null!=a){if(e){var n=e.replace(t,"");i+="-".concat(n)}return i+="-".concat(a),i.toLowerCase()}}var C=new Map;e["a"]=s["a"].extend({name:"v-row",functional:!0,props:Object(n["a"])(Object(n["a"])(Object(n["a"])({tag:{type:String,default:"div"},dense:Boolean,noGutters:Boolean,align:{type:String,default:null,validator:d}},f),{},{justify:{type:String,default:null,validator:v}},p),{},{alignContent:{type:String,default:null,validator:m}},h),render:function(t,e){var a=e.props,n=e.data,s=e.children,o="";for(var c in a)o+=String(a[c]);var l=C.get(o);return l||function(){var t,e;for(e in l=[],b)b[e].forEach((function(t){var i=a[t],n=y(e,t,i);n&&l.push(n)}));l.push((t={"no-gutters":a.noGutters,"row--dense":a.dense},Object(i["a"])(t,"align-".concat(a.align),a.align),Object(i["a"])(t,"justify-".concat(a.justify),a.justify),Object(i["a"])(t,"align-content-".concat(a.alignContent),a.alignContent),t)),C.set(o,l)}(),t(a.tag,Object(r["a"])(n,{staticClass:"row",class:l}),s)}})},"20f6":function(t,e,a){},7496:function(t,e,a){"use strict";var i=a("5530"),n=(a("d9e2"),a("df86"),a("7560")),s=a("58df");e["a"]=Object(s["a"])(n["a"]).extend({name:"v-app",props:{dark:{type:Boolean,default:void 0},id:{type:String,default:"app"},light:{type:Boolean,default:void 0}},computed:{isDark:function(){return this.$vuetify.theme.dark}},beforeCreate:function(){if(!this.$vuetify||this.$vuetify===this.$root)throw new Error("Vuetify is not properly initialized, see https://vuetifyjs.com/getting-started/quick-start#bootstrapping-the-vuetify-object")},render:function(t){var e=t("div",{staticClass:"v-application--wrap"},this.$slots.default);return t("div",{staticClass:"v-application",class:Object(i["a"])({"v-application--is-rtl":this.$vuetify.rtl,"v-application--is-ltr":!this.$vuetify.rtl},this.themeClasses),attrs:{"data-app":!0},domProps:{id:this.id}},[e])}})},a523:function(t,e,a){"use strict";a("4de4"),a("d3b7"),a("b64b"),a("2ca0"),a("99af"),a("20f6"),a("4b85"),a("498a"),a("a15b");var i=a("2b0e");function n(t){return i["a"].extend({name:"v-".concat(t),functional:!0,props:{id:String,tag:{type:String,default:"div"}},render:function(e,a){var i=a.props,n=a.data,s=a.children;n.staticClass="".concat(t," ").concat(n.staticClass||"").trim();var r=n.attrs;if(r){n.attrs={};var o=Object.keys(r).filter((function(t){if("slot"===t)return!1;var e=r[t];return t.startsWith("data-")?(n.attrs[t]=e,!1):e||"string"===typeof e}));o.length&&(n.staticClass+=" ".concat(o.join(" ")))}return i.id&&(n.domProps=n.domProps||{},n.domProps.id=i.id),e(i.tag,n,s)}})}var s=a("d9f7");e["a"]=n("container").extend({name:"v-container",functional:!0,props:{id:String,tag:{type:String,default:"div"},fluid:{type:Boolean,default:!1}},render:function(t,e){var a,i=e.props,n=e.data,r=e.children,o=n.attrs;return o&&(n.attrs={},a=Object.keys(o).filter((function(t){if("slot"===t)return!1;var e=o[t];return t.startsWith("data-")?(n.attrs[t]=e,!1):e||"string"===typeof e}))),i.id&&(n.domProps=n.domProps||{},n.domProps.id=i.id),t(i.tag,Object(s["a"])(n,{staticClass:"container",class:Array({"container--fluid":i.fluid}).concat(a||[])}),r)}})},c342:function(t,e,a){},df86:function(t,e,a){}}]);
//# sourceMappingURL=chunk-450b0bd0.8d629eb2.js.map