(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-72666669"],{2038:function(t,e,s){"use strict";s.r(e);var a=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("v-main",[s("div",{staticClass:"d-flex flex-row flex-nowrap mt-6",class:t.drawer?"mr-2":"ml-4"},[s("div",{staticClass:"d-flex flex-column mt"},[s("span",{staticClass:"ml-7 font-spartan text-h3"},[t._v(t._s(t.$t(t.$route.name))+" "),s("v-icon",[t._v("mdi-chevron-right")])],1)]),s("div",{staticClass:"d-flex flex-column"},[s("v-breadcrumbs",{staticClass:"mr-2",attrs:{items:t.$route.meta.breadcumbs,divider:"/"},scopedSlots:t._u([{key:"divider",fn:function(){return[s("v-icon",[t._v("mdi-chevron-right")])]},proxy:!0}])})],1)]),s("router-view")],1)},i=[],r=s("5530"),n=s("2f62"),c={name:"DashboardCoreView",computed:Object(r["a"])(Object(r["a"])({},Object(n["c"])(["drawer"])),{},{cumputedStore:function(){return this.$store.state.auth.token}}),mounted:function(){},methods:Object(r["a"])({},Object(n["b"])({setDrawer:"SET_DRAWER"}))},d=c,o=(s("cd5e"),s("2877")),u=s("6544"),l=s.n(u),m=(s("a15b"),s("abd3"),s("ade3")),p=s("1c87"),b=s("58df"),h=Object(b["a"])(p["a"]).extend({name:"v-breadcrumbs-item",props:{activeClass:{type:String,default:"v-breadcrumbs__item--disabled"},ripple:{type:[Boolean,Object],default:!1}},computed:{classes:function(){return Object(m["a"])({"v-breadcrumbs__item":!0},this.activeClass,this.disabled)}},render:function(t){var e=this.generateRouteLink(),s=e.tag,a=e.data;return t("li",[t(s,Object(r["a"])(Object(r["a"])({},a),{},{attrs:Object(r["a"])(Object(r["a"])({},a.attrs),{},{"aria-current":this.isActive&&this.isLink?"page":void 0})}),this.$slots.default)])}}),f=s("80d2"),v=Object(f["j"])("v-breadcrumbs__divider","li"),g=s("7560"),x=Object(b["a"])(g["a"]).extend({name:"v-breadcrumbs",props:{divider:{type:String,default:"/"},items:{type:Array,default:function(){return[]}},large:Boolean},computed:{classes:function(){return Object(r["a"])({"v-breadcrumbs--large":this.large},this.themeClasses)}},methods:{genDivider:function(){return this.$createElement(v,this.$slots.divider?this.$slots.divider:this.divider)},genItems:function(){for(var t=[],e=!!this.$scopedSlots.item,s=[],a=0;a<this.items.length;a++){var i=this.items[a];s.push(i.text),e?t.push(this.$scopedSlots.item({item:i})):t.push(this.$createElement(h,{key:s.join("."),props:i},[i.text])),a<this.items.length-1&&t.push(this.genDivider())}return t}},render:function(t){var e=this.$slots.default||this.genItems();return t("ul",{staticClass:"v-breadcrumbs",class:this.classes},e)}}),j=s("132d"),O=(s("bd0c"),s("d10f")),_=O["a"].extend({name:"v-main",props:{tag:{type:String,default:"main"}},computed:{styles:function(){var t=this.$vuetify.application,e=t.bar,s=t.top,a=t.right,i=t.footer,r=t.insetFooter,n=t.bottom,c=t.left;return{paddingTop:"".concat(s+e,"px"),paddingRight:"".concat(a,"px"),paddingBottom:"".concat(i+r+n,"px"),paddingLeft:"".concat(c,"px")}}},render:function(t){var e={staticClass:"v-main",style:this.styles,ref:"main"};return t(this.tag,e,[t("div",{staticClass:"v-main__wrap"},this.$slots.default)])}}),$=Object(o["a"])(d,a,i,!1,null,"1374457d",null);e["default"]=$.exports;l()($,{VBreadcrumbs:x,VIcon:j["a"],VMain:_})},"9ade":function(t,e,s){},abd3:function(t,e,s){},bd0c:function(t,e,s){},cd5e:function(t,e,s){"use strict";s("9ade")}}]);
//# sourceMappingURL=chunk-72666669.4870abbc.js.map