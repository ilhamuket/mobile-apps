(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-0fc085ba"],{"0fd9":function(t,e,i){"use strict";var a=i("ade3"),s=i("5530"),n=(i("d3b7"),i("caad"),i("2532"),i("99af"),i("b64b"),i("ac1f"),i("5319"),i("4ec9"),i("3ca3"),i("ddb0"),i("159b"),i("4b85"),i("2b0e")),r=i("d9f7"),o=i("80d2"),l=["sm","md","lg","xl"],c=["start","end","center"];function u(t,e){return l.reduce((function(i,a){return i[t+Object(o["G"])(a)]=e(),i}),{})}var d=function(t){return[].concat(c,["baseline","stretch"]).includes(t)},h=u("align",(function(){return{type:String,default:null,validator:d}})),p=function(t){return[].concat(c,["space-between","space-around"]).includes(t)},v=u("justify",(function(){return{type:String,default:null,validator:p}})),f=function(t){return[].concat(c,["space-between","space-around","stretch"]).includes(t)},m=u("alignContent",(function(){return{type:String,default:null,validator:f}})),g={align:Object.keys(h),justify:Object.keys(v),alignContent:Object.keys(m)},b={align:"align",justify:"justify",alignContent:"align-content"};function y(t,e,i){var a=b[t];if(null!=i){if(e){var s=e.replace(t,"");a+="-".concat(s)}return a+="-".concat(i),a.toLowerCase()}}var C=new Map;e["a"]=n["a"].extend({name:"v-row",functional:!0,props:Object(s["a"])(Object(s["a"])(Object(s["a"])({tag:{type:String,default:"div"},dense:Boolean,noGutters:Boolean,align:{type:String,default:null,validator:d}},h),{},{justify:{type:String,default:null,validator:p}},v),{},{alignContent:{type:String,default:null,validator:f}},m),render:function(t,e){var i=e.props,s=e.data,n=e.children,o="";for(var l in i)o+=String(i[l]);var c=C.get(o);return c||function(){var t,e;for(e in c=[],g)g[e].forEach((function(t){var a=i[t],s=y(e,t,a);s&&c.push(s)}));c.push((t={"no-gutters":i.noGutters,"row--dense":i.dense},Object(a["a"])(t,"align-".concat(i.align),i.align),Object(a["a"])(t,"justify-".concat(i.justify),i.justify),Object(a["a"])(t,"align-content-".concat(i.alignContent),i.alignContent),t)),C.set(o,c)}(),t(i.tag,Object(r["a"])(s,{staticClass:"row",class:c}),n)}})},"2fa4":function(t,e,i){"use strict";i("20f6");var a=i("80d2");e["a"]=Object(a["j"])("spacer","div","v-spacer")},"51c9":function(t,e,i){"use strict";i.r(e);var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{attrs:{id:"settings-wrapper"}},[i("v-card",{staticClass:"py-2 px-4",staticStyle:{position:"fixed",top:"115px",right:"-35px","border-radius":"8px"},attrs:{id:"settings",color:"rgba(0, 0, 0, .3)",dark:"",flat:"",link:"","min-width":"100"}},[i("v-icon",{attrs:{color:"red",large:""}},[t._v(" mdi-account-settings ")])],1),i("v-menu",{attrs:{"close-on-content-click":!1,activator:"#settings",bottom:"","content-class":"v-settings",left:"","nudge-left":"8","offset-x":"",origin:"top right",transition:"scale-transition"},model:{value:t.menu,callback:function(e){t.menu=e},expression:"menu"}},[i("v-card",{staticClass:"text-center mb-0",attrs:{width:"300"}},[i("v-card-text",[i("strong",{staticClass:"mb-3 d-inline-block"},[t._v("Mobile Settings")]),i("v-divider",{staticClass:"my-4 secondary"}),i("v-row",{attrs:{align:"center","no-gutters":""}},[i("v-col",{attrs:{cols:"auto"}},[t._v(" Dark Mode ")]),i("v-spacer"),i("v-col",{attrs:{cols:"auto"}},[i("v-switch",{staticClass:"ma-0 pa-0",attrs:{color:"secondary","hide-details":""},model:{value:t.$vuetify.theme.dark,callback:function(e){t.$set(t.$vuetify.theme,"dark",e)},expression:"$vuetify.theme.dark"}})],1)],1),i("v-divider",{staticClass:"my-4 secondary"}),i("v-row",[i("v-col",{attrs:{cols:"12"}},[i("v-select",{attrs:{outlined:"",dense:"",items:t.lenguage,"item-text":"name","item-value":"name"},scopedSlots:t._u([{key:"selection",fn:function(e){return[t._t("item",(function(){return[i("v-chip",{staticStyle:{"text-transform":"uppercase"},attrs:{color:"transparent"}},[i("v-avatar",{attrs:{left:""}},[i("v-img",{attrs:{src:e.item.img}})],1),t._v(" "+t._s(e.item.display_name)+" ")],1)]}),null,e)]}},{key:"item",fn:function(e){return[t._t("item",(function(){return[i("v-chip",{staticClass:"text-uppercase",attrs:{color:"transparent"}},[i("v-avatar",{attrs:{left:""}},[i("v-img",{attrs:{src:e.item.img}})],1),t._v(" "+t._s(e.item.display_name)+" ")],1)]}),null,e)]}}],null,!0),model:{value:t.$i18n.locale,callback:function(e){t.$set(t.$i18n,"locale",e)},expression:"$i18n.locale"}})],1)],1)],1)],1)],1)],1)},s=[],n=i("5530"),r=i("a452"),o=i("2f62"),l={name:"DashboardCoreSettings",mixins:[r["a"]],data:function(){return{color:"#E91E63",colors:["#9C27b0","#00CAE3","#4CAF50","#ff9800","#E91E63","#FF5252"],image:"https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-1.jpg",images:["https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-1.jpg","https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-2.jpg","https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-3.jpg","https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-4.jpg"],menu:!1,saveImage:"",showImg:!0,lenguage:[{display_name:"English",name:"en",img:"https://media.istockphoto.com/vectors/flag-of-great-britain-vector-id497118178?s=612x612"},{display_name:"Indonesia",name:"id",img:"https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg"}]}},computed:Object(n["a"])({},Object(o["c"])(["barImage"])),watch:{color:function(t){this.$vuetify.theme.themes[this.isDark?"dark":"light"].primary=t},showImg:function(t){t?this.saveImage?(this.setBarImage(this.saveImage),this.saveImage=""):this.setBarImage(t):(this.saveImage=this.barImage,this.setBarImage(""))},image:function(t){this.setBarImage(t)}},methods:Object(n["a"])({},Object(o["b"])({setBarImage:"SET_BAR_IMAGE"}))},c=l,u=(i("b947"),i("2877")),d=i("6544"),h=i.n(d),p=i("8212"),v=i("b0af"),f=i("99d9"),m=i("cc20"),g=i("62ad"),b=i("ce7e"),y=i("132d"),C=i("adda"),w=i("e449"),j=i("0fd9"),k=i("b974"),S=i("2fa4"),V=i("b73d"),_=Object(u["a"])(c,a,s,!1,null,null,null);e["default"]=_.exports;h()(_,{VAvatar:p["a"],VCard:v["a"],VCardText:f["c"],VChip:m["a"],VCol:g["a"],VDivider:b["a"],VIcon:y["a"],VImg:C["a"],VMenu:w["a"],VRow:j["a"],VSelect:k["a"],VSpacer:S["a"],VSwitch:V["a"]})},5311:function(t,e,i){"use strict";var a=i("5607"),s=i("2b0e");e["a"]=s["a"].extend({name:"rippleable",directives:{ripple:a["a"]},props:{ripple:{type:[Boolean,Object],default:!0}},methods:{genRipple:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return this.ripple?(t.staticClass="v-input--selection-controls__ripple",t.directives=t.directives||[],t.directives.push({name:"ripple",value:{center:!0}}),this.$createElement("div",t)):null}}})},"58d3":function(t,e,i){},"9d01":function(t,e,i){},b73d:function(t,e,i){"use strict";var a=i("15fd"),s=i("5530"),n=(i("0481"),i("4069"),i("ec29"),i("9d01"),i("d3b7"),i("25f0"),i("4de4"),i("c37a")),r=i("5311"),o=i("8547"),l=i("58df");function c(t){t.preventDefault()}var u=Object(l["a"])(n["a"],r["a"],o["a"]).extend({name:"selectable",model:{prop:"inputValue",event:"change"},props:{id:String,inputValue:null,falseValue:null,trueValue:null,multiple:{type:Boolean,default:null},label:String},data:function(){return{hasColor:this.inputValue,lazyValue:this.inputValue}},computed:{computedColor:function(){if(this.isActive)return this.color?this.color:this.isDark&&!this.appIsDark?"white":"primary"},isMultiple:function(){return!0===this.multiple||null===this.multiple&&Array.isArray(this.internalValue)},isActive:function(){var t=this,e=this.value,i=this.internalValue;return this.isMultiple?!!Array.isArray(i)&&i.some((function(i){return t.valueComparator(i,e)})):void 0===this.trueValue||void 0===this.falseValue?e?this.valueComparator(e,i):Boolean(i):this.valueComparator(i,this.trueValue)},isDirty:function(){return this.isActive},rippleState:function(){return this.isDisabled||this.validationState?this.validationState:void 0}},watch:{inputValue:function(t){this.lazyValue=t,this.hasColor=t}},methods:{genLabel:function(){var t=n["a"].options.methods.genLabel.call(this);return t?(t.data.on={click:c},t):t},genInput:function(t,e){return this.$createElement("input",{attrs:Object.assign({"aria-checked":this.isActive.toString(),disabled:this.isDisabled,id:this.computedId,role:t,type:t},e),domProps:{value:this.value,checked:this.isActive},on:{blur:this.onBlur,change:this.onChange,focus:this.onFocus,keydown:this.onKeydown,click:c},ref:"input"})},onBlur:function(){this.isFocused=!1},onClick:function(t){this.onChange(),this.$emit("click",t)},onChange:function(){var t=this;if(this.isInteractive){var e=this.value,i=this.internalValue;if(this.isMultiple){Array.isArray(i)||(i=[]);var a=i.length;i=i.filter((function(i){return!t.valueComparator(i,e)})),i.length===a&&i.push(e)}else i=void 0!==this.trueValue&&void 0!==this.falseValue?this.valueComparator(i,this.trueValue)?this.falseValue:this.trueValue:e?this.valueComparator(i,e)?null:e:!i;this.validate(!0,i),this.internalValue=i,this.hasColor=i}},onFocus:function(){this.isFocused=!0},onKeydown:function(t){}}}),d=i("c3f0"),h=i("0789"),p=i("490a"),v=i("80d2"),f=["title"];e["a"]=u.extend({name:"v-switch",directives:{Touch:d["a"]},props:{inset:Boolean,loading:{type:[Boolean,String],default:!1},flat:{type:Boolean,default:!1}},computed:{classes:function(){return Object(s["a"])(Object(s["a"])({},n["a"].options.computed.classes.call(this)),{},{"v-input--selection-controls v-input--switch":!0,"v-input--switch--flat":this.flat,"v-input--switch--inset":this.inset})},attrs:function(){return{"aria-checked":String(this.isActive),"aria-disabled":String(this.isDisabled),role:"switch"}},validationState:function(){return this.hasError&&this.shouldValidate?"error":this.hasSuccess?"success":null!==this.hasColor?this.computedColor:void 0},switchData:function(){return this.setTextColor(this.loading?void 0:this.validationState,{class:this.themeClasses})}},methods:{genDefaultSlot:function(){return[this.genSwitch(),this.genLabel()]},genSwitch:function(){var t=this.attrs$,e=(t.title,Object(a["a"])(t,f));return this.$createElement("div",{staticClass:"v-input--selection-controls__input"},[this.genInput("checkbox",Object(s["a"])(Object(s["a"])({},this.attrs),e)),this.genRipple(this.setTextColor(this.validationState,{directives:[{name:"touch",value:{left:this.onSwipeLeft,right:this.onSwipeRight}}]})),this.$createElement("div",Object(s["a"])({staticClass:"v-input--switch__track"},this.switchData)),this.$createElement("div",Object(s["a"])({staticClass:"v-input--switch__thumb"},this.switchData),[this.genProgress()])])},genProgress:function(){return this.$createElement(h["c"],{},[!1===this.loading?null:this.$slots.progress||this.$createElement(p["a"],{props:{color:!0===this.loading||""===this.loading?this.color||"primary":this.loading,size:16,width:2,indeterminate:!0}})])},onSwipeLeft:function(){this.isActive&&this.onChange()},onSwipeRight:function(){this.isActive||this.onChange()},onKeydown:function(t){(t.keyCode===v["y"].left&&this.isActive||t.keyCode===v["y"].right&&!this.isActive)&&this.onChange()}}})},b947:function(t,e,i){"use strict";i("58d3")},ec29:function(t,e,i){}}]);
//# sourceMappingURL=chunk-0fc085ba.e7a0e069.js.map