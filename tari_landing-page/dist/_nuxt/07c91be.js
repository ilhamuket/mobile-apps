(window.webpackJsonp=window.webpackJsonp||[]).push([[66],{422:function(t,e,r){"use strict";r(8),r(7),r(9),r(13),r(10),r(14);var o=r(2),n=(r(23),r(190),r(424),r(191)),l=r(423),c=r(79),d=r(6);function v(object,t){var e=Object.keys(object);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(object);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(object,t).enumerable}))),e.push.apply(e,r)}return e}function m(t){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?v(Object(source),!0).forEach((function(e){Object(o.a)(t,e,source[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(source)):v(Object(source)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(source,e))}))}return t}e.a=Object(d.a)(l.a,c.a,n.a).extend({name:"v-card",props:{flat:Boolean,hover:Boolean,img:String,link:Boolean,loaderHeight:{type:[Number,String],default:4},raised:Boolean},computed:{classes:function(){return m(m({"v-card":!0},c.a.options.computed.classes.call(this)),{},{"v-card--flat":this.flat,"v-card--hover":this.hover,"v-card--link":this.isClickable,"v-card--loading":this.loading,"v-card--disabled":this.disabled,"v-card--raised":this.raised},n.a.options.computed.classes.call(this))},styles:function(){var style=m({},n.a.options.computed.styles.call(this));return this.img&&(style.background='url("'.concat(this.img,'") center center / cover no-repeat')),style}},methods:{genProgress:function(){var t=l.a.options.methods.genProgress.call(this);return t?this.$createElement("div",{staticClass:"v-card__progress",key:"progress"},[t]):null}},render:function(t){var e=this.generateRouteLink(),r=e.tag,data=e.data;return data.style=this.styles,this.isClickable&&(data.attrs=data.attrs||{},data.attrs.tabindex=0),t(r,this.setBackgroundColor(this.color,data),[this.genProgress(),this.$slots.default])}})},423:function(t,e,r){"use strict";r(23);var o=r(1),n=r(426);e.a=o.a.extend().extend({name:"loadable",props:{loading:{type:[Boolean,String],default:!1},loaderHeight:{type:[Number,String],default:2}},methods:{genProgress:function(){return!1===this.loading?null:this.$slots.progress||this.$createElement(n.a,{props:{absolute:!0,color:!0===this.loading||""===this.loading?this.color||"primary":this.loading,height:this.loaderHeight,indeterminate:!0}})}}})},424:function(t,e,r){var content=r(425);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(19).default)("e23b7040",content,!0,{sourceMap:!1})},425:function(t,e,r){var o=r(18)(!1);o.push([t.i,"@import url(https://fonts.googleapis.com/css2?family=Spartan&display=swap);"]),o.push([t.i,"@import url(https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap);"]),o.push([t.i,'.theme--light.v-card{background-color:#fff;color:rgba(0,0,0,.87)}.theme--light.v-card>.v-card__subtitle,.theme--light.v-card>.v-card__text{color:rgba(0,0,0,.6)}.theme--dark.v-card{background-color:#1e1e1e;color:#fff}.theme--dark.v-card>.v-card__subtitle,.theme--dark.v-card>.v-card__text{color:hsla(0,0%,100%,.7)}.v-sheet.v-card{border-radius:.25rem}.v-sheet.v-card:not(.v-sheet--outlined){box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12)}.v-sheet.v-card.v-sheet--shaped{border-radius:48px .25rem}.v-card{border-width:thin;display:block;max-width:100%;outline:none;text-decoration:none;transition-property:box-shadow,opacity;word-wrap:break-word;position:relative;white-space:normal}.v-card>.v-card__progress+:not(.v-btn):not(.v-chip):not(.v-avatar),.v-card>:first-child:not(.v-btn):not(.v-chip):not(.v-avatar){border-top-left-radius:inherit;border-top-right-radius:inherit}.v-card>:last-child:not(.v-btn):not(.v-chip):not(.v-avatar){border-bottom-left-radius:inherit;border-bottom-right-radius:inherit}.v-card__progress{top:0;left:0;right:0;overflow:hidden}.v-card__subtitle+.v-card__text{padding-top:0}.v-card__subtitle,.v-card__text{font-size:16px;font-weight:400;line-height:1.375rem;letter-spacing:.0071428571em}.v-card__subtitle,.v-card__text,.v-card__title{padding:20px}.v-card__title{align-items:center;display:flex;flex-wrap:wrap;font-size:14px;font-weight:500;letter-spacing:.0125em;line-height:14px;word-break:break-all}.v-card__title+.v-card__subtitle,.v-card__title+.v-card__text{padding-top:0}.v-card__title+.v-card__subtitle{margin-top:-16px}.v-card__text{width:100%}.v-card__actions{align-items:center;display:flex;padding:20px}.v-card__actions>.v-btn.v-btn{padding:0 8px}.v-application--is-ltr .v-card__actions>.v-btn.v-btn+.v-btn{margin-left:8px}.v-application--is-ltr .v-card__actions>.v-btn.v-btn .v-icon--left{margin-left:4px}.v-application--is-ltr .v-card__actions>.v-btn.v-btn .v-icon--right{margin-right:4px}.v-application--is-rtl .v-card__actions>.v-btn.v-btn+.v-btn{margin-right:8px}.v-application--is-rtl .v-card__actions>.v-btn.v-btn .v-icon--left{margin-right:4px}.v-application--is-rtl .v-card__actions>.v-btn.v-btn .v-icon--right{margin-left:4px}.v-card--flat{box-shadow:0 0 0 0 rgba(0,0,0,.2),0 0 0 0 rgba(0,0,0,.14),0 0 0 0 rgba(0,0,0,.12)!important}.v-sheet.v-card--hover{cursor:pointer;transition:box-shadow .4s cubic-bezier(.25,.8,.25,1)}.v-sheet.v-card--hover:focus,.v-sheet.v-card--hover:hover{box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12)}.v-card--link,.v-card--link .v-chip{cursor:pointer}.v-card--link:focus:before{opacity:.08}.v-card--link:before{background:currentColor;bottom:0;content:"";left:0;opacity:0;pointer-events:none;position:absolute;right:0;top:0;transition:opacity .2s}.v-card--disabled{pointer-events:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.v-card--disabled>:not(.v-card__progress){opacity:.6;transition:inherit}.v-card--loading{overflow:hidden}.v-card--raised{box-shadow:0 5px 5px -3px rgba(0,0,0,.2),0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12)}',""]),t.exports=o},453:function(t,e,r){t.exports=r.p+"img/t1.51b60a5.jpg"},454:function(t,e,r){t.exports=r.p+"img/t2.d84df4e.jpg"},455:function(t,e,r){t.exports=r.p+"img/t3.ff65e62.jpg"},456:function(t,e,r){t.exports=r.p+"img/t4.085a523.jpg"},532:function(t,e,r){"use strict";r.r(e);var o={name:"Team",data:function(){return{}},methods:{}},n=r(52),l=r(61),c=r.n(l),d=r(422),v=r(412),m=r(420),h=r(274),f=r(414),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",[o("div",{staticClass:"team-component mini-spacer"},[o("v-container",[o("v-row",{attrs:{justify:"center"}},[o("v-col",{attrs:{cols:"12",sm:"10",md:"9",lg:"7"}},[o("div",{staticClass:"text-center"},[o("h2",{staticClass:"section-title font-weight-medium"},[t._v("\n              Experienced & Professional Team\n            ")]),t._v(" "),o("p",[t._v("\n              You can relay on our amazing features list and also our customer\n              services will be great experience for you without doubt and in\n              no-time\n            ")])])])],1),t._v(" "),o("v-row",{staticClass:"mt-13"},[o("v-col",{attrs:{cols:"12",md:"6",lg:"3"}},[o("v-card",{staticClass:"team-card overflow-hidden mb-15",attrs:{elevation:"0"}},[o("div",{staticClass:"social-overlay"},[o("v-img",{attrs:{src:r(453),alt:"team"}}),t._v(" "),o("div",{staticClass:"img-overlay"},[o("ul",[o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-facebook"})])]),t._v(" "),o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-twitter"})])]),t._v(" "),o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-instagram"})])]),t._v(" "),o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-youtube"})])])])])],1),t._v(" "),o("div",[o("h5",{staticClass:"team-title font-weight-medium font-18"},[t._v("\n                Michael Doe\n              ")]),t._v(" "),o("p",{staticClass:"team-subtitle"},[t._v("Property Specialist")])]),t._v(" "),o("p",[t._v("\n              You can relay on our amazing features list and also our customer\n              services will be great experience.\n            ")])])],1),t._v(" "),o("v-col",{attrs:{cols:"12",md:"6",lg:"3"}},[o("v-card",{staticClass:"team-card overflow-hidden mb-15",attrs:{elevation:"0"}},[o("div",{staticClass:"social-overlay"},[o("v-img",{attrs:{src:r(454),alt:"team"}}),t._v(" "),o("div",{staticClass:"img-overlay"},[o("ul",[o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-facebook"})])]),t._v(" "),o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-twitter"})])]),t._v(" "),o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-instagram"})])]),t._v(" "),o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-youtube"})])])])])],1),t._v(" "),o("div",[o("h5",{staticClass:"team-title font-weight-medium font-18"},[t._v("\n                Michael Doe\n              ")]),t._v(" "),o("p",{staticClass:"team-subtitle"},[t._v("Property Specialist")])]),t._v(" "),o("p",[t._v("\n              You can relay on our amazing features list and also our customer\n              services will be great experience.\n            ")])])],1),t._v(" "),o("v-col",{attrs:{cols:"12",md:"6",lg:"3"}},[o("v-card",{staticClass:"team-card overflow-hidden mb-15",attrs:{elevation:"0"}},[o("div",{staticClass:"social-overlay"},[o("v-img",{attrs:{src:r(455),alt:"team"}}),t._v(" "),o("div",{staticClass:"img-overlay"},[o("ul",[o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-facebook"})])]),t._v(" "),o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-twitter"})])]),t._v(" "),o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-instagram"})])]),t._v(" "),o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-youtube"})])])])])],1),t._v(" "),o("div",[o("h5",{staticClass:"team-title font-weight-medium font-18"},[t._v("\n                Michael Doe\n              ")]),t._v(" "),o("p",{staticClass:"team-subtitle"},[t._v("Property Specialist")])]),t._v(" "),o("p",[t._v("\n              You can relay on our amazing features list and also our customer\n              services will be great experience.\n            ")])])],1),t._v(" "),o("v-col",{attrs:{cols:"12",md:"6",lg:"3"}},[o("v-card",{staticClass:"team-card overflow-hidden mb-15",attrs:{elevation:"0"}},[o("div",{staticClass:"social-overlay"},[o("v-img",{attrs:{src:r(456),alt:"team"}}),t._v(" "),o("div",{staticClass:"img-overlay"},[o("ul",[o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-facebook"})])]),t._v(" "),o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-twitter"})])]),t._v(" "),o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-instagram"})])]),t._v(" "),o("li",[o("a",{attrs:{href:"#"}},[o("i",{staticClass:"mdi mdi-youtube"})])])])])],1),t._v(" "),o("div",[o("h5",{staticClass:"team-title font-weight-medium font-18"},[t._v("\n                Michael Doe\n              ")]),t._v(" "),o("p",{staticClass:"team-subtitle"},[t._v("Property Specialist")])]),t._v(" "),o("p",[t._v("\n              You can relay on our amazing features list and also our customer\n              services will be great experience.\n            ")])])],1)],1)],1)],1)])}),[],!1,null,null,null);e.default=component.exports;c()(component,{VCard:d.a,VCol:v.a,VContainer:m.a,VImg:h.a,VRow:f.a})}}]);