(window.webpackJsonp=window.webpackJsonp||[]).push([[62],{421:function(t,e,r){"use strict";r.d(e,"a",(function(){return n})),r.d(e,"b",(function(){return l})),r.d(e,"c",(function(){return v})),r.d(e,"d",(function(){return h}));var o=r(422),c=r(0),n=Object(c.f)("v-card__actions"),l=Object(c.f)("v-card__subtitle"),v=Object(c.f)("v-card__text"),h=Object(c.f)("v-card__title");o.a},422:function(t,e,r){"use strict";r(8),r(7),r(9),r(13),r(10),r(14);var o=r(2),c=(r(23),r(190),r(424),r(191)),n=r(423),l=r(79),v=r(6);function h(object,t){var e=Object.keys(object);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(object);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(object,t).enumerable}))),e.push.apply(e,r)}return e}function d(t){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?h(Object(source),!0).forEach((function(e){Object(o.a)(t,e,source[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(source)):h(Object(source)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(source,e))}))}return t}e.a=Object(v.a)(n.a,l.a,c.a).extend({name:"v-card",props:{flat:Boolean,hover:Boolean,img:String,link:Boolean,loaderHeight:{type:[Number,String],default:4},raised:Boolean},computed:{classes:function(){return d(d({"v-card":!0},l.a.options.computed.classes.call(this)),{},{"v-card--flat":this.flat,"v-card--hover":this.hover,"v-card--link":this.isClickable,"v-card--loading":this.loading,"v-card--disabled":this.disabled,"v-card--raised":this.raised},c.a.options.computed.classes.call(this))},styles:function(){var style=d({},c.a.options.computed.styles.call(this));return this.img&&(style.background='url("'.concat(this.img,'") center center / cover no-repeat')),style}},methods:{genProgress:function(){var t=n.a.options.methods.genProgress.call(this);return t?this.$createElement("div",{staticClass:"v-card__progress",key:"progress"},[t]):null}},render:function(t){var e=this.generateRouteLink(),r=e.tag,data=e.data;return data.style=this.styles,this.isClickable&&(data.attrs=data.attrs||{},data.attrs.tabindex=0),t(r,this.setBackgroundColor(this.color,data),[this.genProgress(),this.$slots.default])}})},423:function(t,e,r){"use strict";r(23);var o=r(1),c=r(426);e.a=o.a.extend().extend({name:"loadable",props:{loading:{type:[Boolean,String],default:!1},loaderHeight:{type:[Number,String],default:2}},methods:{genProgress:function(){return!1===this.loading?null:this.$slots.progress||this.$createElement(c.a,{props:{absolute:!0,color:!0===this.loading||""===this.loading?this.color||"primary":this.loading,height:this.loaderHeight,indeterminate:!0}})}}})},424:function(t,e,r){var content=r(425);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(19).default)("e23b7040",content,!0,{sourceMap:!1})},425:function(t,e,r){var o=r(18)(!1);o.push([t.i,"@import url(https://fonts.googleapis.com/css2?family=Spartan&display=swap);"]),o.push([t.i,"@import url(https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap);"]),o.push([t.i,'.theme--light.v-card{background-color:#fff;color:rgba(0,0,0,.87)}.theme--light.v-card>.v-card__subtitle,.theme--light.v-card>.v-card__text{color:rgba(0,0,0,.6)}.theme--dark.v-card{background-color:#1e1e1e;color:#fff}.theme--dark.v-card>.v-card__subtitle,.theme--dark.v-card>.v-card__text{color:hsla(0,0%,100%,.7)}.v-sheet.v-card{border-radius:.25rem}.v-sheet.v-card:not(.v-sheet--outlined){box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12)}.v-sheet.v-card.v-sheet--shaped{border-radius:48px .25rem}.v-card{border-width:thin;display:block;max-width:100%;outline:none;text-decoration:none;transition-property:box-shadow,opacity;word-wrap:break-word;position:relative;white-space:normal}.v-card>.v-card__progress+:not(.v-btn):not(.v-chip):not(.v-avatar),.v-card>:first-child:not(.v-btn):not(.v-chip):not(.v-avatar){border-top-left-radius:inherit;border-top-right-radius:inherit}.v-card>:last-child:not(.v-btn):not(.v-chip):not(.v-avatar){border-bottom-left-radius:inherit;border-bottom-right-radius:inherit}.v-card__progress{top:0;left:0;right:0;overflow:hidden}.v-card__subtitle+.v-card__text{padding-top:0}.v-card__subtitle,.v-card__text{font-size:16px;font-weight:400;line-height:1.375rem;letter-spacing:.0071428571em}.v-card__subtitle,.v-card__text,.v-card__title{padding:20px}.v-card__title{align-items:center;display:flex;flex-wrap:wrap;font-size:14px;font-weight:500;letter-spacing:.0125em;line-height:14px;word-break:break-all}.v-card__title+.v-card__subtitle,.v-card__title+.v-card__text{padding-top:0}.v-card__title+.v-card__subtitle{margin-top:-16px}.v-card__text{width:100%}.v-card__actions{align-items:center;display:flex;padding:20px}.v-card__actions>.v-btn.v-btn{padding:0 8px}.v-application--is-ltr .v-card__actions>.v-btn.v-btn+.v-btn{margin-left:8px}.v-application--is-ltr .v-card__actions>.v-btn.v-btn .v-icon--left{margin-left:4px}.v-application--is-ltr .v-card__actions>.v-btn.v-btn .v-icon--right{margin-right:4px}.v-application--is-rtl .v-card__actions>.v-btn.v-btn+.v-btn{margin-right:8px}.v-application--is-rtl .v-card__actions>.v-btn.v-btn .v-icon--left{margin-right:4px}.v-application--is-rtl .v-card__actions>.v-btn.v-btn .v-icon--right{margin-left:4px}.v-card--flat{box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12)!important}.v-sheet.v-card--hover{cursor:pointer;transition:box-shadow .4s cubic-bezier(.25,.8,.25,1)}.v-sheet.v-card--hover:focus,.v-sheet.v-card--hover:hover{box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12)}.v-card--link,.v-card--link .v-chip{cursor:pointer}.v-card--link:focus:before{opacity:.08}.v-card--link:before{background:currentColor;bottom:0;content:"";left:0;opacity:0;pointer-events:none;position:absolute;right:0;top:0;transition:opacity .2s}.v-card--disabled{pointer-events:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.v-card--disabled>:not(.v-card__progress){opacity:.6;transition:inherit}.v-card--loading{overflow:hidden}.v-card--raised{box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12)}',""]),t.exports=o},429:function(t,e,r){var content=r(430);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(19).default)("197fcea4",content,!0,{sourceMap:!1})},430:function(t,e,r){var o=r(18)(!1);o.push([t.i,"@import url(https://fonts.googleapis.com/css2?family=Spartan&display=swap);"]),o.push([t.i,"@import url(https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap);"]),o.push([t.i,'.v-chip:not(.v-chip--outlined).accent,.v-chip:not(.v-chip--outlined).error,.v-chip:not(.v-chip--outlined).info,.v-chip:not(.v-chip--outlined).primary,.v-chip:not(.v-chip--outlined).secondary,.v-chip:not(.v-chip--outlined).success,.v-chip:not(.v-chip--outlined).warning{color:#fff}.theme--light.v-chip{border-color:rgba(0,0,0,.12);color:rgba(0,0,0,.87)}.theme--light.v-chip:not(.v-chip--active){background:#e0e0e0}.theme--light.v-chip:hover:before{opacity:.04}.theme--light.v-chip--active:before,.theme--light.v-chip--active:hover:before,.theme--light.v-chip:focus:before{opacity:.12}.theme--light.v-chip--active:focus:before{opacity:.16}.theme--dark.v-chip{border-color:hsla(0,0%,100%,.12);color:#fff}.theme--dark.v-chip:not(.v-chip--active){background:#555}.theme--dark.v-chip:hover:before{opacity:.08}.theme--dark.v-chip--active:before,.theme--dark.v-chip--active:hover:before,.theme--dark.v-chip:focus:before{opacity:.24}.theme--dark.v-chip--active:focus:before{opacity:.32}.v-chip{align-items:center;cursor:default;display:inline-flex;line-height:20px;max-width:100%;outline:none;overflow:hidden;padding:0 12px;position:relative;text-decoration:none;transition-duration:.28s;transition-property:box-shadow,opacity;transition-timing-function:cubic-bezier(.4,0,.2,1);vertical-align:middle;white-space:nowrap}.v-chip:before{background-color:currentColor;bottom:0;border-radius:inherit;content:"";left:0;opacity:0;position:absolute;pointer-events:none;right:0;top:0}.v-chip .v-avatar{height:24px!important;min-width:24px!important;width:24px!important}.v-chip .v-icon{font-size:24px}.v-application--is-ltr .v-chip .v-avatar--left,.v-application--is-ltr .v-chip .v-icon--left{margin-left:-6px;margin-right:6px}.v-application--is-ltr .v-chip .v-avatar--right,.v-application--is-ltr .v-chip .v-icon--right,.v-application--is-rtl .v-chip .v-avatar--left,.v-application--is-rtl .v-chip .v-icon--left{margin-left:6px;margin-right:-6px}.v-application--is-rtl .v-chip .v-avatar--right,.v-application--is-rtl .v-chip .v-icon--right{margin-left:-6px;margin-right:6px}.v-chip:not(.v-chip--no-color) .v-icon{color:inherit}.v-chip .v-chip__close.v-icon{font-size:18px;max-height:18px;max-width:18px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.v-application--is-ltr .v-chip .v-chip__close.v-icon.v-icon--right{margin-right:-4px}.v-application--is-rtl .v-chip .v-chip__close.v-icon.v-icon--right{margin-left:-4px}.v-chip .v-chip__close.v-icon:active,.v-chip .v-chip__close.v-icon:focus,.v-chip .v-chip__close.v-icon:hover{opacity:.72}.v-chip .v-chip__content{align-items:center;display:inline-flex;height:100%;max-width:100%}.v-chip--active .v-icon{color:inherit}.v-chip--link:before{transition:opacity .3s cubic-bezier(.25,.8,.5,1)}.v-chip--link:focus:before{opacity:.32}.v-chip--clickable{cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.v-chip--clickable:active{box-shadow:0 3px 1px -2px rgba(0,0,0,.2),0 2px 2px 0 rgba(0,0,0,.14),0 1px 5px 0 rgba(0,0,0,.12)}.v-chip--disabled{opacity:.4;pointer-events:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.v-chip__filter{max-width:24px}.v-chip__filter.v-icon{color:inherit}.v-chip__filter.expand-x-transition-enter,.v-chip__filter.expand-x-transition-leave-active{margin:0}.v-chip--pill .v-chip__filter{margin-right:0 16px 0 0}.v-chip--pill .v-avatar{height:32px!important;width:32px!important}.v-application--is-ltr .v-chip--pill .v-avatar--left{margin-left:-12px}.v-application--is-ltr .v-chip--pill .v-avatar--right,.v-application--is-rtl .v-chip--pill .v-avatar--left{margin-right:-12px}.v-application--is-rtl .v-chip--pill .v-avatar--right{margin-left:-12px}.v-chip--label{border-radius:8px!important}.v-chip.v-chip--outlined{border-width:thin;border-style:solid}.v-chip.v-chip--outlined.v-chip--active:before{opacity:.08}.v-chip.v-chip--outlined .v-icon{color:inherit}.v-chip.v-chip--outlined.v-chip.v-chip{background-color:transparent!important}.v-chip.v-chip--selected{background:transparent}.v-chip.v-chip--selected:after{opacity:.28}.v-chip.v-size--x-small{border-radius:8px;font-size:10px;height:16px}.v-chip.v-size--x-small .v-icon{font-size:10px;height:10px;width:10px}.v-chip.v-size--small{border-radius:11px;font-size:12px;height:22px}.v-chip.v-size--small .v-icon{font-size:12px;height:12px;width:12px}.v-chip.v-size--default{border-radius:16px;font-size:14px;height:32px}.v-chip.v-size--default .v-icon{font-size:14px;height:14px;width:14px}.v-chip.v-size--large{border-radius:27px;font-size:16px;height:54px}.v-chip.v-size--large .v-icon{font-size:16px;height:16px;width:16px}.v-chip.v-size--x-large{border-radius:33px;font-size:18px;height:66px}.v-chip.v-size--x-large .v-icon{font-size:18px;height:18px;width:18px}',""]),t.exports=o},432:function(t,e,r){"use strict";r(8),r(7),r(13),r(10),r(14);var o=r(20),c=r(2),n=(r(9),r(429),r(6)),l=r(192),v=r(100),h=r(35),d=r(123),f=r(31),m=r(40),x=r(79),_=r(122),y=r(5);function w(object,t){var e=Object.keys(object);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(object);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(object,t).enumerable}))),e.push.apply(e,r)}return e}function C(t){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?w(Object(source),!0).forEach((function(e){Object(c.a)(t,e,source[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(source)):w(Object(source)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(source,e))}))}return t}e.a=Object(n.a)(h.a,_.a,x.a,f.a,Object(d.a)("chipGroup"),Object(m.b)("inputValue")).extend({name:"v-chip",props:{active:{type:Boolean,default:!0},activeClass:{type:String,default:function(){return this.chipGroup?this.chipGroup.activeClass:""}},close:Boolean,closeIcon:{type:String,default:"$delete"},closeLabel:{type:String,default:"$vuetify.close"},disabled:Boolean,draggable:Boolean,filter:Boolean,filterIcon:{type:String,default:"$complete"},label:Boolean,link:Boolean,outlined:Boolean,pill:Boolean,tag:{type:String,default:"span"},textColor:String,value:null},data:function(){return{proxyClass:"v-chip--active"}},computed:{classes:function(){return C(C(C(C({"v-chip":!0},x.a.options.computed.classes.call(this)),{},{"v-chip--clickable":this.isClickable,"v-chip--disabled":this.disabled,"v-chip--draggable":this.draggable,"v-chip--label":this.label,"v-chip--link":this.isLink,"v-chip--no-color":!this.color,"v-chip--outlined":this.outlined,"v-chip--pill":this.pill,"v-chip--removable":this.hasClose},this.themeClasses),this.sizeableClasses),this.groupClasses)},hasClose:function(){return Boolean(this.close)},isClickable:function(){return Boolean(x.a.options.computed.isClickable.call(this)||this.chipGroup)}},created:function(){var t=this;[["outline","outlined"],["selected","input-value"],["value","active"],["@input","@active.sync"]].forEach((function(e){var r=Object(o.a)(e,2),c=r[0],n=r[1];t.$attrs.hasOwnProperty(c)&&Object(y.a)(c,n,t)}))},methods:{click:function(t){this.$emit("click",t),this.chipGroup&&this.toggle()},genFilter:function(){var t=[];return this.isActive&&t.push(this.$createElement(v.a,{staticClass:"v-chip__filter",props:{left:!0}},this.filterIcon)),this.$createElement(l.b,t)},genClose:function(){var t=this;return this.$createElement(v.a,{staticClass:"v-chip__close",props:{right:!0,size:18},attrs:{"aria-label":this.$vuetify.lang.t(this.closeLabel)},on:{click:function(e){e.stopPropagation(),e.preventDefault(),t.$emit("click:close"),t.$emit("update:active",!1)}}},this.closeIcon)},genContent:function(){return this.$createElement("span",{staticClass:"v-chip__content"},[this.filter&&this.genFilter(),this.$slots.default,this.hasClose&&this.genClose()])}},render:function(t){var e=[this.genContent()],r=this.generateRouteLink(),o=r.tag,data=r.data;data.attrs=C(C({},data.attrs),{},{draggable:this.draggable?"true":void 0,tabindex:this.chipGroup&&!this.disabled?0:data.attrs.tabindex}),data.directives.push({name:"show",value:this.active}),data=this.setBackgroundColor(this.color,data);var c=this.textColor||this.outlined&&this.color;return t(o,this.setTextColor(c,data),e)}})},446:function(t,e,r){t.exports=r.p+"img/img1.ddfb05c.jpg"},447:function(t,e,r){t.exports=r.p+"img/img2.e55fee0.jpg"},448:function(t,e,r){t.exports=r.p+"img/img3.3e794f9.jpg"},449:function(t,e,r){t.exports=r.p+"img/img4.fc7922a.jpg"},527:function(t,e,r){"use strict";r.r(e);var o={name:"Feature2",data:function(){return{}},methods:{}},c=r(52),n=r(61),l=r.n(n),v=r(194),h=r(422),d=r(421),f=r(432),m=r(412),x=r(420),_=r(414),component=Object(c.a)(o,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",[o("div",{staticClass:"feature2-component mini-spacer bg-extra-light"},[o("v-container",[o("v-row",{attrs:{justify:"center"}},[o("v-col",{attrs:{cols:"12",md:"10",lg:"7"}},[o("div",{staticClass:"text-center"},[o("v-chip",{attrs:{small:"",color:"primary","text-color":"white"}},[t._v("\n              Feature 2\n            ")]),t._v(" "),o("h2",{staticClass:"section-title font-weight-medium"},[t._v("\n              Memiliki Instructor yang unggul\n            ")])],1)])],1),t._v(" "),o("v-row",{staticClass:"feature2-spacer",attrs:{justify:"center"}},[o("v-col",{staticClass:"mb-15",attrs:{cols:"12",lg:"6"}},[o("v-card",{attrs:{elevation:"0"}},[o("v-row",[o("v-col",{staticClass:"py-0",attrs:{cols:"12",md:"8"}},[o("v-card-text",[o("div",{staticClass:"d-flex align-center"},[o("v-row",[o("v-col",{attrs:{cols:"12",md:"4"}},[o("img",{staticClass:"img-fluid rounded",attrs:{src:r(446),alt:"feature2"}})]),t._v(" "),o("v-col",{staticClass:"px-md-0 d-flex align-center",attrs:{cols:"12",md:"8"}},[o("h4",{staticClass:"font-weight-medium font-18"},[t._v("\n                          Epul J - Dancer\n                        ")])])],1)],1)])],1),t._v(" "),o("v-col",{staticClass:"py-0",attrs:{cols:"12",md:"4"}},[o("v-btn",{staticClass:"linking feature2-action-btn",attrs:{block:"",depressed:"",color:"info"}},[t._v("\n                  Lihat "),o("i",{staticClass:"mdi mdi-arrow-right"})])],1)],1)],1)],1),t._v(" "),o("v-col",{staticClass:"mb-15",attrs:{cols:"12",lg:"6"}},[o("v-card",{attrs:{elevation:"0"}},[o("v-row",[o("v-col",{staticClass:"py-0",attrs:{cols:"12",md:"8"}},[o("v-card-text",[o("div",{staticClass:"d-flex align-center"},[o("v-row",[o("v-col",{attrs:{cols:"12",md:"4"}},[o("img",{staticClass:"img-fluid rounded",attrs:{src:r(447),alt:"feature2"}})]),t._v(" "),o("v-col",{staticClass:"px-md-0 d-flex align-center",attrs:{cols:"12",md:"8"}},[o("h4",{staticClass:"font-weight-medium font-18"},[t._v("\n                          Epul J - Dancer\n                        ")])])],1)],1)])],1),t._v(" "),o("v-col",{staticClass:"py-0",attrs:{cols:"12",md:"4"}},[o("v-btn",{staticClass:"linking feature2-action-btn",attrs:{block:"",depressed:"",color:"info"}},[t._v("\n                  Lihat "),o("i",{staticClass:"mdi mdi-arrow-right"})])],1)],1)],1)],1),t._v(" "),o("v-col",{staticClass:"mb-15",attrs:{cols:"12",lg:"6"}},[o("v-card",{attrs:{elevation:"0"}},[o("v-row",[o("v-col",{staticClass:"py-0",attrs:{cols:"12",md:"8"}},[o("v-card-text",[o("div",{staticClass:"d-flex align-center"},[o("v-row",[o("v-col",{attrs:{cols:"12",md:"4"}},[o("img",{staticClass:"img-fluid rounded",attrs:{src:r(448),alt:"feature2"}})]),t._v(" "),o("v-col",{staticClass:"px-md-0 d-flex align-center",attrs:{cols:"12",md:"8"}},[o("h4",{staticClass:"font-weight-medium font-18"},[t._v("\n                         Epul J - Dancer\n                        ")])])],1)],1)])],1),t._v(" "),o("v-col",{staticClass:"py-0",attrs:{cols:"12",md:"4"}},[o("v-btn",{staticClass:"linking feature2-action-btn",attrs:{block:"",depressed:"",color:"info"}},[t._v("\n                  Lihat "),o("i",{staticClass:"mdi mdi-arrow-right"})])],1)],1)],1)],1),t._v(" "),o("v-col",{staticClass:"mb-15",attrs:{cols:"12",lg:"6"}},[o("v-card",{attrs:{elevation:"0"}},[o("v-row",[o("v-col",{staticClass:"py-0",attrs:{cols:"12",md:"8"}},[o("v-card-text",[o("div",{staticClass:"d-flex align-center"},[o("v-row",[o("v-col",{attrs:{cols:"12",md:"4"}},[o("img",{staticClass:"img-fluid rounded",attrs:{src:r(449),alt:"feature2"}})]),t._v(" "),o("v-col",{staticClass:"px-md-0 d-flex align-center",attrs:{cols:"12",md:"8"}},[o("h4",{staticClass:"font-weight-medium font-18"},[t._v("\n                         Epul J - Dancer\n                        ")])])],1)],1)])],1),t._v(" "),o("v-col",{staticClass:"py-0",attrs:{cols:"12",md:"4"}},[o("v-btn",{staticClass:"linking feature2-action-btn",attrs:{block:"",depressed:"",color:"info"}},[t._v("\n                  Lihat "),o("i",{staticClass:"mdi mdi-arrow-right"})])],1)],1)],1)],1)],1)],1)],1)])}),[],!1,null,null,null);e.default=component.exports;l()(component,{VBtn:v.a,VCard:h.a,VCardText:d.c,VChip:f.a,VCol:m.a,VContainer:x.a,VRow:_.a})}}]);