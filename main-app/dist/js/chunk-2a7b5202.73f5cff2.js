(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2a7b5202"],{"2a56":function(t,e,i){"use strict";i.r(e);var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-app")},o=[],s={created:function(){this.logout(),this.$vuetify.theme.dark=!1},methods:{logout:function(){var t=this;this.$store.dispatch("auth/logout").then((function(){localStorage.setItem("dark_theme","false"),t.$router.push("/login"),localStorage.removeItem("acces_token")})).catch((function(e){t.$router.push("/login")}))}}},n=s,r=i("2877"),u=i("6544"),l=i.n(u),c=i("7496"),p=Object(r["a"])(n,a,o,!1,null,null,null);e["default"]=p.exports;l()(p,{VApp:c["a"]})},7496:function(t,e,i){"use strict";var a=i("5530"),o=(i("df86"),i("7560")),s=i("58df");e["a"]=Object(s["a"])(o["a"]).extend({name:"v-app",props:{dark:{type:Boolean,default:void 0},id:{type:String,default:"app"},light:{type:Boolean,default:void 0}},computed:{isDark:function(){return this.$vuetify.theme.dark}},beforeCreate:function(){if(!this.$vuetify||this.$vuetify===this.$root)throw new Error("Vuetify is not properly initialized, see https://vuetifyjs.com/getting-started/quick-start#bootstrapping-the-vuetify-object")},render:function(t){var e=t("div",{staticClass:"v-application--wrap"},this.$slots.default);return t("div",{staticClass:"v-application",class:Object(a["a"])({"v-application--is-rtl":this.$vuetify.rtl,"v-application--is-ltr":!this.$vuetify.rtl},this.themeClasses),attrs:{"data-app":!0},domProps:{id:this.id}},[e])}})},df86:function(t,e,i){}}]);
//# sourceMappingURL=chunk-2a7b5202.73f5cff2.js.map