(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-f13a95be"],{"00cb":function(t,e,a){"use strict";a("ea8e")},"0fd9":function(t,e,a){"use strict";var n=a("ade3"),i=a("5530"),r=(a("caad"),a("2532"),a("99af"),a("b64b"),a("ac1f"),a("5319"),a("4ec9"),a("d3b7"),a("3ca3"),a("ddb0"),a("159b"),a("4b85"),a("2b0e")),s=a("d9f7"),o=a("80d2"),l=["sm","md","lg","xl"],c=["start","end","center"];function u(t,e){return l.reduce((function(a,n){return a[t+Object(o["F"])(n)]=e(),a}),{})}var d=function(t){return[].concat(c,["baseline","stretch"]).includes(t)},f=u("align",(function(){return{type:String,default:null,validator:d}})),p=function(t){return[].concat(c,["space-between","space-around"]).includes(t)},h=u("justify",(function(){return{type:String,default:null,validator:p}})),v=function(t){return[].concat(c,["space-between","space-around","stretch"]).includes(t)},m=u("alignContent",(function(){return{type:String,default:null,validator:v}})),b={align:Object.keys(f),justify:Object.keys(h),alignContent:Object.keys(m)},g={align:"align",justify:"justify",alignContent:"align-content"};function y(t,e,a){var n=g[t];if(null!=a){if(e){var i=e.replace(t,"");n+="-".concat(i)}return n+="-".concat(a),n.toLowerCase()}}var w=new Map;e["a"]=r["a"].extend({name:"v-row",functional:!0,props:Object(i["a"])(Object(i["a"])(Object(i["a"])({tag:{type:String,default:"div"},dense:Boolean,noGutters:Boolean,align:{type:String,default:null,validator:d}},f),{},{justify:{type:String,default:null,validator:p}},h),{},{alignContent:{type:String,default:null,validator:v}},m),render:function(t,e){var a=e.props,i=e.data,r=e.children,o="";for(var l in a)o+=String(a[l]);var c=w.get(o);return c||function(){var t,e;for(e in c=[],b)b[e].forEach((function(t){var n=a[t],i=y(e,t,n);i&&c.push(i)}));c.push((t={"no-gutters":a.noGutters,"row--dense":a.dense},Object(n["a"])(t,"align-".concat(a.align),a.align),Object(n["a"])(t,"justify-".concat(a.justify),a.justify),Object(n["a"])(t,"align-content-".concat(a.alignContent),a.alignContent),t)),w.set(o,c)}(),t(a.tag,Object(s["a"])(i,{staticClass:"row",class:c}),r)}})},"178c":function(t,e,a){"use strict";a.r(e);var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-app",[a("v-container",{attrs:{fluid:""}},[a("v-row",{staticClass:"d-flex flex-row-reverse justify-space-around",attrs:{dense:""}},[a("v-col",{staticClass:"d-flex flex-column bg-img",attrs:{cols:"12",md:"8"}},[a("v-row",[a("v-col",[a("v-img",{staticClass:"mr-2",attrs:{width:"1000",src:t.imgUrl}})],1)],1)],1),a("v-col",{staticClass:"d-flex flex-column dense",attrs:{cols:"12",md:"4"}},[a("v-col",{staticClass:"bg-auth",attrs:{cols:"12"}},[a("v-card-title",{staticClass:"font-spartan",attrs:{"title-tag":"h2"}},[t._v(" Welcome to EnsikloTari! 👋 ")]),a("v-card-text",{staticClass:"mb-2 font-subtitle"},[t._v(" Please sign-Up to your account and start the adventure ")]),a("v-card-text",{attrs:{color:"transparent"}},[a("validation-observer",{ref:"observer",scopedSlots:t._u([{key:"default",fn:function(e){var n=e.invalid;return[a("v-form",{on:{submit:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:(e.preventDefault(),t.register.apply(null,arguments))}}},[a("validation-provider",{attrs:{name:"UserName",rules:"required|max:20"},scopedSlots:t._u([{key:"default",fn:function(e){var n=e.errors;return[a("v-text-field",{attrs:{label:"UserName",placeholder:"UserName",outlined:"","error-messages":n,dense:"","prepend-icon":"mdi-account-box"},model:{value:t.username,callback:function(e){t.username=e},expression:"username"}})]}}],null,!0)}),a("validation-provider",{attrs:{name:"phoneNumber",rules:{required:!0,digits:12}},scopedSlots:t._u([{key:"default",fn:function(e){var n=e.errors;return[a("v-text-field",{attrs:{label:"Phone Number",placeholder:"Phone Number",outlined:"","error-messages":n,type:"text",dense:"","prepend-icon":"mdi-cellphone-settings"},model:{value:t.phoneNumber,callback:function(e){t.phoneNumber=e},expression:"phoneNumber"}})]}}],null,!0)}),a("validation-provider",{attrs:{name:"email",rules:"required|email"},scopedSlots:t._u([{key:"default",fn:function(e){var n=e.errors;return[a("v-text-field",{attrs:{label:"E-mail",placeholder:"E-mail","error-messages":n,outlined:"",dense:"","prepend-icon":"mdi-at"},model:{value:t.email,callback:function(e){t.email=e},expression:"email"}})]}}],null,!0)}),a("validation-provider",{attrs:{name:"Password",rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var n=e.errors;return[a("v-text-field",{attrs:{label:"Password",placeholder:"Password",outlined:"","error-messages":n,dense:"","prepend-icon":"mdi-lock","append-icon":t.show?"mdi-eye-off":"mdi-eye",type:t.show?"text":"password"},on:{"click:append":function(e){t.show=!t.show}},model:{value:t.password,callback:function(e){t.password=e},expression:"password"}})]}}],null,!0)}),a("validation-provider",{attrs:{name:"Password",rules:"required"},scopedSlots:t._u([{key:"default",fn:function(e){var n=e.errors;return[a("v-text-field",{attrs:{label:"Confirm Password",placeholder:"Confirm Password",outlined:"",rules:[t.rules.required,t.passwordMatch],dense:"","error-messages":n,required:"","prepend-icon":"mdi-lock","append-icon":t.show?"mdi-eye-off":"mdi-eye",type:t.show?"text":"password"},on:{"click:append":function(e){t.show=!t.show}},model:{value:t.confirmPassword,callback:function(e){t.confirmPassword=e},expression:"confirmPassword"}})]}}],null,!0)}),a("div",{staticClass:"d-flex flex-row justify-center ml-8 mt-4"},[a("div",{staticClass:"d-flex flex-coloumn"},[a("v-btn",{attrs:{color:"pallet1",width:"370",type:"submit",disabled:n}},[t._v(" Sign-Up ")])],1)]),a("div",{staticClass:"text-center font-spartan mt-6"},[a("span",{staticClass:"font-spartan"},[t._v("Sudah Punya Akun ? ")]),a("a",{staticClass:"color-a",on:{click:t.signIn}},[a("span",[t._v(" Masuk")])])]),a("div",{staticClass:"d-flex flex-row justify-center mt-2"},[a("div",{staticClass:"d-flex flex-column"},[a("v-chip",{attrs:{color:"transparent","text-color":"red"}},[a("h4",[t._v(" Lupa Password ")])])],1)])],1)]}}])})],1)],1)],1)],1)],1)],1)},i=[],r=a("5530"),s=a("4c93"),o=a("7bb1");Object(o["d"])("eager"),Object(o["c"])("digits",Object(r["a"])(Object(r["a"])({},s["a"]),{},{message:"{_field_} needs to be {length} digits. ({_value_})"})),Object(o["c"])("required",Object(r["a"])(Object(r["a"])({},s["g"]),{},{message:"{_field_} can not be empty"})),Object(o["c"])("max",Object(r["a"])(Object(r["a"])({},s["c"]),{},{message:"{_field_} may not be greater than {length} characters"})),Object(o["c"])("regex",Object(r["a"])(Object(r["a"])({},s["f"]),{},{message:"{_field_} {_value_} does not match {regex}"})),Object(o["c"])("email",Object(r["a"])(Object(r["a"])({},s["b"]),{},{message:"Email must be valid"}));var l={components:{ValidationProvider:o["b"],ValidationObserver:o["a"]},data:function(){return{show:!1,username:"",phoneNumber:"",email:"",password:"",confirmPassword:"",rules:{required:function(t){return!!t||"Required."},min:function(t){return t&&t.length>=8||"Min 8 characters"}}}},computed:{imgUrl:function(){return this.sideImg=a("91ec"),this.sideImg},randomString:function(t){for(var e="",a="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",n=a.length,i=0;i<t;i++)e+=a.charAt(Math.floor(Math.random()*n));return e},passwordMatch:function(){var t=this;return function(){return t.password===t.confirmPassword||"Password must match"}}},mounted:function(){},methods:{register:function(){var t=this;this.$store.dispatch("auth/register",{email:this.email,firstName:this.username+"_",lastName:"##USERSENSIKLO_",password:this.password,nickName:this.username,noHp:this.phoneNumber}).then((function(e){if(!0===e.data.meta.status)t.$store.dispatch("user/me").then((function(e){0===e.data.data.isVerified?t.$router.push("/waiting-email"):t.$router.push("/")}));else{t.isWrong=!0,t.alert=!0;var a=t.$swal.mixin({toast:!0,position:"top-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:function(e){e.addEventListener("mouseenter",t.$swal.stopTimer),e.addEventListener("mouseleave",t.$swal.resumeTimer)},popup:"swal2-show",backdrop:"swal2-backdrop-show",icon:"swal2-icon-show"});a.fire({icon:"error",title:"Password atau Email Anda salah"})}}))},signIn:function(){this.$router.push("/login")}}},c=l,u=(a("00cb"),a("2877")),d=a("6544"),f=a.n(d),p=a("7496"),h=a("8336"),v=a("99d9"),m=a("cc20"),b=a("62ad"),g=a("a523"),y=a("4bd4"),w=a("adda"),j=a("0fd9"),C=a("8654"),O=Object(u["a"])(c,n,i,!1,null,null,null);e["default"]=O.exports;f()(O,{VApp:p["a"],VBtn:h["a"],VCardText:v["c"],VCardTitle:v["d"],VChip:m["a"],VCol:b["a"],VContainer:g["a"],VForm:y["a"],VImg:w["a"],VRow:j["a"],VTextField:C["a"]})},"20f6":function(t,e,a){},2909:function(t,e,a){"use strict";a.d(e,"a",(function(){return l}));var n=a("6b75");function i(t){if(Array.isArray(t))return Object(n["a"])(t)}a("a4d3"),a("e01a"),a("d3b7"),a("d28b"),a("3ca3"),a("ddb0"),a("a630");function r(t){if("undefined"!==typeof Symbol&&null!=t[Symbol.iterator]||null!=t["@@iterator"])return Array.from(t)}var s=a("06c5");function o(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}function l(t){return i(t)||r(t)||Object(s["a"])(t)||o()}},"4bd4":function(t,e,a){"use strict";var n=a("5530"),i=(a("caad"),a("2532"),a("07ac"),a("4de4"),a("159b"),a("7db0"),a("58df")),r=a("7e2b"),s=a("3206");e["a"]=Object(i["a"])(r["a"],Object(s["b"])("form")).extend({name:"v-form",provide:function(){return{form:this}},inheritAttrs:!1,props:{disabled:Boolean,lazyValidation:Boolean,readonly:Boolean,value:Boolean},data:function(){return{inputs:[],watchers:[],errorBag:{}}},watch:{errorBag:{handler:function(t){var e=Object.values(t).includes(!0);this.$emit("input",!e)},deep:!0,immediate:!0}},methods:{watchInput:function(t){var e=this,a=function(t){return t.$watch("hasError",(function(a){e.$set(e.errorBag,t._uid,a)}),{immediate:!0})},n={_uid:t._uid,valid:function(){},shouldValidate:function(){}};return this.lazyValidation?n.shouldValidate=t.$watch("shouldValidate",(function(i){i&&(e.errorBag.hasOwnProperty(t._uid)||(n.valid=a(t)))})):n.valid=a(t),n},validate:function(){return 0===this.inputs.filter((function(t){return!t.validate(!0)})).length},reset:function(){this.inputs.forEach((function(t){return t.reset()})),this.resetErrorBag()},resetErrorBag:function(){var t=this;this.lazyValidation&&setTimeout((function(){t.errorBag={}}),0)},resetValidation:function(){this.inputs.forEach((function(t){return t.resetValidation()})),this.resetErrorBag()},register:function(t){this.inputs.push(t),this.watchers.push(this.watchInput(t))},unregister:function(t){var e=this.inputs.find((function(e){return e._uid===t._uid}));if(e){var a=this.watchers.find((function(t){return t._uid===e._uid}));a&&(a.valid(),a.shouldValidate()),this.watchers=this.watchers.filter((function(t){return t._uid!==e._uid})),this.inputs=this.inputs.filter((function(t){return t._uid!==e._uid})),this.$delete(this.errorBag,e._uid)}}},render:function(t){var e=this;return t("form",{staticClass:"v-form",attrs:Object(n["a"])({novalidate:!0},this.attrs$),on:{submit:function(t){return e.$emit("submit",t)}}},this.$slots.default)}})},7496:function(t,e,a){"use strict";var n=a("5530"),i=(a("df86"),a("7560")),r=a("58df");e["a"]=Object(r["a"])(i["a"]).extend({name:"v-app",props:{dark:{type:Boolean,default:void 0},id:{type:String,default:"app"},light:{type:Boolean,default:void 0}},computed:{isDark:function(){return this.$vuetify.theme.dark}},beforeCreate:function(){if(!this.$vuetify||this.$vuetify===this.$root)throw new Error("Vuetify is not properly initialized, see https://vuetifyjs.com/getting-started/quick-start#bootstrapping-the-vuetify-object")},render:function(t){var e=t("div",{staticClass:"v-application--wrap"},this.$slots.default);return t("div",{staticClass:"v-application",class:Object(n["a"])({"v-application--is-rtl":this.$vuetify.rtl,"v-application--is-ltr":!this.$vuetify.rtl},this.themeClasses),attrs:{"data-app":!0},domProps:{id:this.id}},[e])}})},"8adc":function(t,e,a){},"91ec":function(t,e,a){t.exports=a.p+"img/asset-web-sp-6.21d7af91.png"},a523:function(t,e,a){"use strict";a("4de4"),a("b64b"),a("2ca0"),a("99af"),a("20f6"),a("4b85"),a("498a"),a("a15b");var n=a("2b0e");function i(t){return n["a"].extend({name:"v-".concat(t),functional:!0,props:{id:String,tag:{type:String,default:"div"}},render:function(e,a){var n=a.props,i=a.data,r=a.children;i.staticClass="".concat(t," ").concat(i.staticClass||"").trim();var s=i.attrs;if(s){i.attrs={};var o=Object.keys(s).filter((function(t){if("slot"===t)return!1;var e=s[t];return t.startsWith("data-")?(i.attrs[t]=e,!1):e||"string"===typeof e}));o.length&&(i.staticClass+=" ".concat(o.join(" ")))}return n.id&&(i.domProps=i.domProps||{},i.domProps.id=n.id),e(n.tag,i,r)}})}var r=a("d9f7");e["a"]=i("container").extend({name:"v-container",functional:!0,props:{id:String,tag:{type:String,default:"div"},fluid:{type:Boolean,default:!1}},render:function(t,e){var a,n=e.props,i=e.data,s=e.children,o=i.attrs;return o&&(i.attrs={},a=Object.keys(o).filter((function(t){if("slot"===t)return!1;var e=o[t];return t.startsWith("data-")?(i.attrs[t]=e,!1):e||"string"===typeof e}))),n.id&&(i.domProps=i.domProps||{},i.domProps.id=n.id),t(n.tag,Object(r["a"])(i,{staticClass:"container",class:Array({"container--fluid":n.fluid}).concat(a||[])}),s)}})},cc20:function(t,e,a){"use strict";var n=a("3835"),i=a("5530"),r=(a("4de4"),a("8adc"),a("58df")),s=a("0789"),o=a("9d26"),l=a("a9ad"),c=a("4e82"),u=a("7560"),d=a("f2e7"),f=a("1c87"),p=a("af2b"),h=a("d9bd");e["a"]=Object(r["a"])(l["a"],p["a"],f["a"],u["a"],Object(c["a"])("chipGroup"),Object(d["b"])("inputValue")).extend({name:"v-chip",props:{active:{type:Boolean,default:!0},activeClass:{type:String,default:function(){return this.chipGroup?this.chipGroup.activeClass:""}},close:Boolean,closeIcon:{type:String,default:"$delete"},closeLabel:{type:String,default:"$vuetify.close"},disabled:Boolean,draggable:Boolean,filter:Boolean,filterIcon:{type:String,default:"$complete"},label:Boolean,link:Boolean,outlined:Boolean,pill:Boolean,tag:{type:String,default:"span"},textColor:String,value:null},data:function(){return{proxyClass:"v-chip--active"}},computed:{classes:function(){return Object(i["a"])(Object(i["a"])(Object(i["a"])(Object(i["a"])({"v-chip":!0},f["a"].options.computed.classes.call(this)),{},{"v-chip--clickable":this.isClickable,"v-chip--disabled":this.disabled,"v-chip--draggable":this.draggable,"v-chip--label":this.label,"v-chip--link":this.isLink,"v-chip--no-color":!this.color,"v-chip--outlined":this.outlined,"v-chip--pill":this.pill,"v-chip--removable":this.hasClose},this.themeClasses),this.sizeableClasses),this.groupClasses)},hasClose:function(){return Boolean(this.close)},isClickable:function(){return Boolean(f["a"].options.computed.isClickable.call(this)||this.chipGroup)}},created:function(){var t=this,e=[["outline","outlined"],["selected","input-value"],["value","active"],["@input","@active.sync"]];e.forEach((function(e){var a=Object(n["a"])(e,2),i=a[0],r=a[1];t.$attrs.hasOwnProperty(i)&&Object(h["a"])(i,r,t)}))},methods:{click:function(t){this.$emit("click",t),this.chipGroup&&this.toggle()},genFilter:function(){var t=[];return this.isActive&&t.push(this.$createElement(o["a"],{staticClass:"v-chip__filter",props:{left:!0}},this.filterIcon)),this.$createElement(s["b"],t)},genClose:function(){var t=this;return this.$createElement(o["a"],{staticClass:"v-chip__close",props:{right:!0,size:18},attrs:{"aria-label":this.$vuetify.lang.t(this.closeLabel)},on:{click:function(e){e.stopPropagation(),e.preventDefault(),t.$emit("click:close"),t.$emit("update:active",!1)}}},this.closeIcon)},genContent:function(){return this.$createElement("span",{staticClass:"v-chip__content"},[this.filter&&this.genFilter(),this.$slots.default,this.hasClose&&this.genClose()])}},render:function(t){var e=[this.genContent()],a=this.generateRouteLink(),n=a.tag,r=a.data;r.attrs=Object(i["a"])(Object(i["a"])({},r.attrs),{},{draggable:this.draggable?"true":void 0,tabindex:this.chipGroup&&!this.disabled?0:r.attrs.tabindex}),r.directives.push({name:"show",value:this.active}),r=this.setBackgroundColor(this.color,r);var s=this.textColor||this.outlined&&this.color;return t(n,this.setTextColor(s,r),e)}})},df86:function(t,e,a){},ea8e:function(t,e,a){}}]);
//# sourceMappingURL=chunk-f13a95be.ddd57030.js.map