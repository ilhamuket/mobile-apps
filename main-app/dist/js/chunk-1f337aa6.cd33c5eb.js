(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-1f337aa6"],{"1d4d":function(t,e,i){"use strict";i("a9e3"),i("c96a"),i("d81d"),i("696f");var a=i("9d26"),n=i("a9ad"),o=i("16b7"),s=i("af2b"),r=i("5311"),l=i("7560"),c=i("80d2"),u=i("58df");e["a"]=Object(u["a"])(n["a"],o["a"],r["a"],s["a"],l["a"]).extend({name:"v-rating",props:{backgroundColor:{type:String,default:"accent"},color:{type:String,default:"primary"},clearable:Boolean,dense:Boolean,emptyIcon:{type:String,default:"$ratingEmpty"},fullIcon:{type:String,default:"$ratingFull"},halfIcon:{type:String,default:"$ratingHalf"},halfIncrements:Boolean,hover:Boolean,length:{type:[Number,String],default:5},readonly:Boolean,size:[Number,String],value:{type:Number,default:0},iconLabel:{type:String,default:"$vuetify.rating.ariaLabel.icon"}},data:function(){return{hoverIndex:-1,internalValue:this.value}},computed:{directives:function(){return this.readonly||!this.ripple?[]:[{name:"ripple",value:{circle:!0}}]},iconProps:function(){var t=this.$props,e=t.dark,i=t.large,a=t.light,n=t.medium,o=t.small,s=t.size,r=t.xLarge,l=t.xSmall;return{dark:e,large:i,light:a,medium:n,size:s,small:o,xLarge:r,xSmall:l}},isHovering:function(){return this.hover&&this.hoverIndex>=0}},watch:{internalValue:function(t){t!==this.value&&this.$emit("input",t)},value:function(t){this.internalValue=t}},methods:{createClickFn:function(t){var e=this;return function(i){if(!e.readonly){var a=e.genHoverIndex(i,t);e.clearable&&e.internalValue===a?e.internalValue=0:e.internalValue=a}}},createProps:function(t){var e={index:t,value:this.internalValue,click:this.createClickFn(t),isFilled:Math.floor(this.internalValue)>t,isHovered:Math.floor(this.hoverIndex)>t};return this.halfIncrements&&(e.isHalfHovered=!e.isHovered&&(this.hoverIndex-t)%1>0,e.isHalfFilled=!e.isFilled&&(this.internalValue-t)%1>0),e},genHoverIndex:function(t,e){var i=this.isHalfEvent(t);return this.halfIncrements&&this.$vuetify.rtl&&(i=!i),e+(i?.5:1)},getIconName:function(t){var e=this.isHovering?t.isHovered:t.isFilled,i=this.isHovering?t.isHalfHovered:t.isHalfFilled;return e?this.fullIcon:i?this.halfIcon:this.emptyIcon},getColor:function(t){if(this.isHovering){if(t.isHovered||t.isHalfHovered)return this.color}else if(t.isFilled||t.isHalfFilled)return this.color;return this.backgroundColor},isHalfEvent:function(t){if(this.halfIncrements){var e=t.target&&t.target.getBoundingClientRect();if(e&&t.pageX-e.left<e.width/2)return!0}return!1},onMouseEnter:function(t,e){var i=this;this.runDelay("open",(function(){i.hoverIndex=i.genHoverIndex(t,e)}))},onMouseLeave:function(){var t=this;this.runDelay("close",(function(){return t.hoverIndex=-1}))},genItem:function(t){var e=this,i=this.createProps(t);if(this.$scopedSlots.item)return this.$scopedSlots.item(i);var n={click:i.click};return this.hover&&(n.mouseenter=function(i){return e.onMouseEnter(i,t)},n.mouseleave=this.onMouseLeave,this.halfIncrements&&(n.mousemove=function(i){return e.onMouseEnter(i,t)})),this.$createElement(a["a"],this.setTextColor(this.getColor(i),{attrs:{"aria-label":this.$vuetify.lang.t(this.iconLabel,t+1,Number(this.length))},directives:this.directives,props:this.iconProps,on:n}),[this.getIconName(i)])}},render:function(t){var e=this,i=Object(c["g"])(Number(this.length)).map((function(t){return e.genItem(t)}));return t("div",{staticClass:"v-rating",class:{"v-rating--readonly":this.readonly,"v-rating--dense":this.dense}},i)}})},"1f09":function(t,e,i){},"20f6":function(t,e,i){},3129:function(t,e,i){"use strict";var a=i("3835"),n=i("5530"),o=(i("ac1f"),i("1276"),i("d81d"),i("a630"),i("3ca3"),i("5319"),i("1f09"),i("c995")),s=i("24b2"),r=i("7560"),l=i("58df"),c=i("80d2");e["a"]=Object(l["a"])(o["a"],s["a"],r["a"]).extend({name:"VSkeletonLoader",props:{boilerplate:Boolean,loading:Boolean,tile:Boolean,transition:String,type:String,types:{type:Object,default:function(){return{}}}},computed:{attrs:function(){return this.isLoading?this.boilerplate?{}:Object(n["a"])({"aria-busy":!0,"aria-live":"polite",role:"alert"},this.$attrs):this.$attrs},classes:function(){return Object(n["a"])(Object(n["a"])({"v-skeleton-loader--boilerplate":this.boilerplate,"v-skeleton-loader--is-loading":this.isLoading,"v-skeleton-loader--tile":this.tile},this.themeClasses),this.elevationClasses)},isLoading:function(){return!("default"in this.$scopedSlots)||this.loading},rootTypes:function(){return Object(n["a"])({actions:"button@2",article:"heading, paragraph",avatar:"avatar",button:"button",card:"image, card-heading","card-avatar":"image, list-item-avatar","card-heading":"heading",chip:"chip","date-picker":"list-item, card-heading, divider, date-picker-options, date-picker-days, actions","date-picker-options":"text, avatar@2","date-picker-days":"avatar@28",heading:"heading",image:"image","list-item":"text","list-item-avatar":"avatar, text","list-item-two-line":"sentences","list-item-avatar-two-line":"avatar, sentences","list-item-three-line":"paragraph","list-item-avatar-three-line":"avatar, paragraph",paragraph:"text@3",sentences:"text@2",table:"table-heading, table-thead, table-tbody, table-tfoot","table-heading":"heading, text","table-thead":"heading@6","table-tbody":"table-row-divider@6","table-row-divider":"table-row, divider","table-row":"table-cell@6","table-cell":"text","table-tfoot":"text@2, avatar@2",text:"text"},this.types)}},methods:{genBone:function(t,e){return this.$createElement("div",{staticClass:"v-skeleton-loader__".concat(t," v-skeleton-loader__bone")},e)},genBones:function(t){var e=this,i=t.split("@"),n=Object(a["a"])(i,2),o=n[0],s=n[1],r=function(){return e.genStructure(o)};return Array.from({length:s}).map(r)},genStructure:function(t){var e=[];t=t||this.type||"";var i=this.rootTypes[t]||"";if(t===i);else{if(t.indexOf(",")>-1)return this.mapBones(t);if(t.indexOf("@")>-1)return this.genBones(t);i.indexOf(",")>-1?e=this.mapBones(i):i.indexOf("@")>-1?e=this.genBones(i):i&&e.push(this.genStructure(i))}return[this.genBone(t,e)]},genSkeleton:function(){var t=[];return this.isLoading?t.push(this.genStructure()):t.push(Object(c["o"])(this)),this.transition?this.$createElement("transition",{props:{name:this.transition},on:{afterEnter:this.resetStyles,beforeEnter:this.onBeforeEnter,beforeLeave:this.onBeforeLeave,leaveCancelled:this.resetStyles}},t):t},mapBones:function(t){return t.replace(/\s/g,"").split(",").map(this.genStructure)},onBeforeEnter:function(t){this.resetStyles(t),this.isLoading&&(t._initialStyle={display:t.style.display,transition:t.style.transition},t.style.setProperty("transition","none","important"))},onBeforeLeave:function(t){t.style.setProperty("display","none","important")},resetStyles:function(t){t._initialStyle&&(t.style.display=t._initialStyle.display||"",t.style.transition=t._initialStyle.transition,delete t._initialStyle)}},render:function(t){return t("div",{staticClass:"v-skeleton-loader",attrs:this.attrs,on:this.$listeners,class:this.classes,style:this.isLoading?this.measurableStyles:void 0},[this.genSkeleton()])}})},"381c":function(t,e,i){},4663:function(t,e,i){},5311:function(t,e,i){"use strict";var a=i("5607"),n=i("2b0e");e["a"]=n["a"].extend({name:"rippleable",directives:{ripple:a["a"]},props:{ripple:{type:[Boolean,Object],default:!0}},methods:{genRipple:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return this.ripple?(t.staticClass="v-input--selection-controls__ripple",t.directives=t.directives||[],t.directives.push({name:"ripple",value:{center:!0}}),this.$createElement("div",t)):null}}})},"696f":function(t,e,i){},"841c":function(t,e,i){"use strict";var a=i("d784"),n=i("825a"),o=i("1d80"),s=i("129f"),r=i("577e"),l=i("14c3");a("search",(function(t,e,i){return[function(e){var i=o(this),a=void 0==e?void 0:e[t];return void 0!==a?a.call(e,i):new RegExp(e)[t](r(i))},function(t){var a=n(this),o=r(t),c=i(e,a,o);if(c.done)return c.value;var u=a.lastIndex;s(u,0)||(a.lastIndex=0);var d=l(a,o);return s(a.lastIndex,u)||(a.lastIndex=u),null===d?-1:d.index}]}))},"99be":function(t,e,i){"use strict";i("c23e")},aa95:function(t,e,i){"use strict";i("381c")},ac35:function(t,e,i){"use strict";i("bc53")},bc53:function(t,e,i){},c23e:function(t,e,i){},ce87:function(t,e,i){"use strict";var a=i("16b7"),n=i("f2e7"),o=i("58df"),s=i("d9bd");e["a"]=Object(o["a"])(a["a"],n["a"]).extend({name:"v-hover",props:{disabled:{type:Boolean,default:!1},value:{type:Boolean,default:void 0}},methods:{onMouseEnter:function(){this.runDelay("open")},onMouseLeave:function(){this.runDelay("close")}},render:function(){return this.$scopedSlots.default||void 0!==this.value?(this.$scopedSlots.default&&(t=this.$scopedSlots.default({hover:this.isActive})),Array.isArray(t)&&1===t.length&&(t=t[0]),t&&!Array.isArray(t)&&t.tag?(this.disabled||(t.data=t.data||{},this._g(t.data,{mouseenter:this.onMouseEnter,mouseleave:this.onMouseLeave})),t):(Object(s["c"])("v-hover should only contain a single element",this),t)):(Object(s["c"])("v-hover is missing a default scopedSlot or bound value",this),null);var t}})},e6d6:function(t,e,i){"use strict";i.r(e);var a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return t.$store.state.studio.isLoad?i("v-container",[i("loader",{attrs:{object:"#ff9633",color1:"#ffffff",color2:"#17fd3d",size:"5",speed:"2",bg:"#343a40",objectbg:"#999793",opacity:"80","disable-scrolling":"false",name:"dots"}}),i("v-skeleton-loader",t._b({attrs:{type:"card-avatar, article, actions"}},"v-skeleton-loader",t.attrs,!1))],1):i("v-container",[i("v-row",{staticClass:"relative ml-6",class:t.$vuetify.theme.dark?"customize-dark-scroll":"custumize-light-scroll"},[i("v-col",{staticClass:"overflow",attrs:{cols:"12",md:"12"}},[i("v-row",[i("v-col",{staticClass:"ml-5",attrs:{cols:"12",md:"4"}},[i("v-text-field",{attrs:{outlined:"",dense:"",label:t.$t("search"),placeholder:"Search","append-icon":"mdi-magnify"},on:{input:t.searchMethods},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}})],1)],1),t.is_loading?i("div",{staticClass:"d-flex justify-center"},[i("v-progress-circular",{staticClass:"d-flex justify-center",attrs:{indeterminate:"",color:"red"}})],1):t._e(),0===t.studio.length?i("span",{staticClass:"d-flex justify-center"},[t._v(" No Data Avalaible ")]):i("app-data-list-page",{attrs:{data:t.studio,user:t.user},on:{follow:t.followStudio,unFollow:t.executeUnfollowStudio,like:t.likeStudio,unLike:t.unLikeStudio}})],1)],1)],1)},n=[],o=(i("ac1f"),i("841c"),function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-container",[i("v-row",t._l(t.data,(function(e,a){return i("v-col",{key:a,attrs:{cols:"12",md:"4"}},[i("v-hover",{scopedSlots:t._u([{key:"default",fn:function(n){var o=n.hover;return[i("v-card",{class:{"on-hover":o},attrs:{elevation:o?12:2}},[e.img?i("v-img",{staticStyle:{"background-color":"grey"},attrs:{src:e.img.url,width:"400",height:"276",gradient:"to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"}},[i("v-container",[i("v-row",[i("v-col",{staticClass:"d-flex flex-row-reverse",attrs:{cols:"12"}},[t.computedIsLikeYou[a]?i("v-icon",{attrs:{color:"red"},on:{click:function(i){return t.unLike(e)}}},[t._v(" mdi-heart ")]):i("v-icon",{attrs:{color:"red"},on:{click:function(i){return t.like(e)}}},[t._v(" mdi-heart-outline ")]),i("v-icon",{staticClass:"mr-2",attrs:{color:"primary"}},[t._v(" mdi-share-variant ")])],1)],1),i("v-row",{staticClass:"cols_list_studio"},[i("v-col",{attrs:{cols:"12"}},[i("span",{staticClass:"font-spartan white--text"},[t._v(" "+t._s(e.name)+" ")]),i("br"),e.author?i("span",{staticClass:"font-spartan white--text"},[t._v(" Studio ")]):t._e(),i("v-rating",{attrs:{value:t.computedList[a],readonly:"","background-color":"grey",color:"orange",size:"20"}}),i("v-btn",{staticClass:"btn-expolore-studio",attrs:{small:"",width:"190",outlined:"",color:"primary"},on:{click:function(i){return t.clickPush(e.slug)}}},[t._v(" Explore ")]),t.computedIsFollowingYou[a]?i("v-btn",{staticClass:"btn-expolore-studio ml-1",attrs:{width:"100",small:"",color:"primary"},on:{click:function(i){return t.unFolow(e)}}},[i("v-tooltip",{attrs:{color:"primary",bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var a=e.on,n=e.attrs;return[i("v-icon",t._g(t._b({},"v-icon",n,!1),a),[t._v(" mdi-account-check ")])]}}],null,!0)},[i("span",{staticClass:"font-spartan-small"},[t._v(" Un Follow ")])])],1):i("v-btn",{staticClass:"btn-expolore-studio ml-1",attrs:{small:"",width:"100",outlined:"",color:"primary"},on:{click:function(i){return t.follow(e)}}},[t._v(" Follow ")])],1)],1)],1)],1):i("v-img",{staticStyle:{"background-color":"grey"},attrs:{src:"https://ecs7.tokopedia.net/img/cache/300/default_picture_user/default_toped-22.jpg",width:"400",height:"276",gradient:"to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"}},[i("v-container",[i("v-row",[i("v-col",{staticClass:"d-flex flex-row-reverse",attrs:{cols:"12"}},[t.computedIsLikeYou[a]?i("v-icon",{attrs:{color:"red"},on:{click:function(i){return t.unLike(e)}}},[t._v(" mdi-heart ")]):i("v-icon",{attrs:{color:"red"},on:{click:function(i){return t.like(e)}}},[t._v(" mdi-heart-outline ")]),i("v-icon",{staticClass:"mr-2",attrs:{color:"primary"}},[t._v(" mdi-share-variant ")])],1)],1),i("v-row",{staticClass:"cols_list_studio"},[i("v-col",{attrs:{cols:"12"}},[i("span",{staticClass:"font-spartan white--text"},[t._v(" "+t._s(e.name)+" ")]),i("br"),e.author?i("span",{staticClass:"font-spartan white--text"},[t._v(" Studio ")]):t._e(),i("v-rating",{attrs:{value:t.computedList[a],readonly:"","background-color":"grey",color:"orange",size:"20"}}),i("v-btn",{staticClass:"btn-expolore-studio",attrs:{small:"",width:"190",outlined:"",color:"primary"},on:{click:function(i){return t.clickPush(e.slug)}}},[t._v(" Explore ")]),t.computedIsFollowingYou[a]?i("v-btn",{staticClass:"btn-expolore-studio ml-1",attrs:{width:"100",small:"",color:"primary"},on:{click:function(i){return t.unFolow(e)}}},[i("v-tooltip",{attrs:{color:"primary",bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var a=e.on,n=e.attrs;return[i("v-icon",t._g(t._b({},"v-icon",n,!1),a),[t._v(" mdi-account-check ")])]}}],null,!0)},[i("span",{staticClass:"font-spartan-small"},[t._v(" Un Follow ")])])],1):i("v-btn",{staticClass:"btn-expolore-studio ml-1",attrs:{small:"",width:"100",outlined:"",color:"primary"},on:{click:function(i){return t.follow(e)}}},[t._v(" Follow ")])],1)],1)],1)],1)],1)]}}],null,!0)})],1)})),1)],1)}),s=[],r=(i("d81d"),i("4de4"),i("c740"),i("a434"),{props:{data:{type:Array,default:function(){return[]}},user:{type:Object,default:null}},computed:{computedList:function(){var t=[];for(var e in this.data)if(Object.hasOwnProperty.call(this.data,e)){var i=this.data[e],a=[];a=i.reviews;var n=a.map((function(t){return t.ratings}));if(0!==n.length){var o=n.filter((function(t){return t>0})).reduce((function(t,e){return t+e})),s=o/n.length;t.push(s)}}return t},computedIsFollowingYou:function(){var t=null,e=[],i=!1;if(this.data.length>0)for(var a in t=this.data.filter((function(t){return t.followers})),t)if(Object.hasOwnProperty.call(t,a)){var n=t[a],o=n.followers;if(void 0!==o&&(0===o.length&&(i=!1),o))for(var s in o)if(Object.hasOwnProperty.call(o,s)){var r=o[s];i=r.id===this.user.id}e.push(i)}return e},computedIsLikeYou:function(){var t=null,e=[],i=!1;if(this.data.length>0)for(var a in t=this.data.filter((function(t){return t.likes})),t)if(Object.hasOwnProperty.call(t,a)){var n=t[a],o=n.likes;if(0===o.length&&(i=!1),o)for(var s in o)if(Object.hasOwnProperty.call(o,s)){var r=o[s];i=r.id===this.user.id}e.push(i)}return e}},mounted:function(){},methods:{like:function(t){this.$emit("like",{item:t});var e=this.data.findIndex((function(e){return e.id===t.id}));-1!==e&&this.computedIsLikeYou.splice(e,1,!0)},unLike:function(t){this.$emit("unLike",{item:t});var e=this.data.findIndex((function(e){return e.id===t.id}));-1!==e&&this.computedIsLikeYou.splice(e,1,!1)},clickPush:function(t){this.$router.push("/".concat(t,"/home"))},clickSHow:function(t){t.show=!t.show},follow:function(t){this.$emit("follow",{item:t});var e=this.data.findIndex((function(e){return e.id===t.id}));-1!==e&&this.computedIsFollowingYou.splice(e,1,!0)},unFolow:function(t){this.$emit("unFollow",{item:t});var e=this.data.findIndex((function(e){return e.id===t.id}));-1!==e&&this.computedIsFollowingYou.splice(e,1,!1)}}}),l=r,c=(i("99be"),i("aa95"),i("2877")),u=i("6544"),d=i.n(u),h=i("8336"),f=i("b0af"),v=i("62ad"),p=i("a523"),m=i("ce87"),g=i("132d"),b=i("adda"),w=i("1d4d"),y=i("0fd9"),k=i("3a2f"),x=Object(c["a"])(l,o,s,!1,null,"1ea7bea7",null),S=x.exports;d()(x,{VBtn:h["a"],VCard:f["a"],VCol:v["a"],VContainer:p["a"],VHover:m["a"],VIcon:g["a"],VImg:b["a"],VRating:w["a"],VRow:y["a"],VTooltip:k["a"]});var _={components:{"app-data-list-page":S},data:function(){return{search:"",timer:null,isLoad:!0,attrs:{class:"mb-6",boilerplate:!0,elevation:2},is_loading:!1}},computed:{studio:function(){return this.$store.state.studio.data},user:function(){return this.$store.state.user.me}},mounted:function(){this.getDataStudio(),this.getMe()},methods:{getDataStudio:function(){var t=this;this.$store.dispatch("studio/getDataStudio",{search:this.search,entities:"author,img,followers,likes,reviews"}).then((function(e){if(t.is_loading=!1,0===t.studio.length){var i=t.$swal.mixin({toast:!0,position:"top-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:function(e){e.addEventListener("mouseenter",t.$swal.stopTimer),e.addEventListener("mouseleave",t.$swal.resumeTimer)},popup:"swal2-show",backdrop:"swal2-backdrop-show",icon:"swal2-icon-show"});i.fire({icon:"success",title:"Data Not Found"})}}))},getMe:function(){this.$store.dispatch("user/me")},followStudio:function(t){var e=this,i=t.item;this.$store.dispatch("studio/followStudio",{slug:i.slug}).then((function(t){t.data.meta.status&&e.$swal.fire({customClass:{},title:"You have Followed this studio.",width:600,padding:"3em",background:"#fff url(https://sweetalert2.github.io/images/trees.png)",backdrop:'\n  rgba(0,0,123,0.4)\n  url("https://sweetalert2.github.io/images/nyan-cat.gif")\n  left top\n  no-repeat\n'})}))},executeUnfollowStudio:function(t){var e=this,i=t.item;this.$store.dispatch("studio/unfollStudio",{slug:i.slug}).then((function(t){var i=t.data;if(i.meta.status){var a=e.$swal.mixin({toast:!0,position:"bottom-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:function(t){t.addEventListener("mouseenter",e.$swal.stopTimer),t.addEventListener("mouseleave",e.$swal.resumeTimer)},popup:"swal2-show",backdrop:"swal2-backdrop-show",icon:"swal2-icon-show"});a.fire({icon:"success",title:"You Unfollow this Studio"}),e.getDataStudioBySlug()}}))},likeStudio:function(t){var e=this,i=t.item;this.$store.dispatch("studio/likeStudio",{slug:i.slug}).then((function(t){var i=t.data;if(i.meta.status){var a=e.$swal.mixin({toast:!0,position:"bottom-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:function(t){t.addEventListener("mouseenter",e.$swal.stopTimer),t.addEventListener("mouseleave",e.$swal.resumeTimer)},popup:"swal2-show",backdrop:"swal2-backdrop-show",icon:"swal2-icon-show"});a.fire({icon:"success",title:"You like this Studio"})}}))},unLikeStudio:function(t){var e=this,i=t.item;this.$store.dispatch("studio/unLikeStudio",{slug:i.slug}).then((function(t){var i=t.data;if(i.meta.status){var a=e.$swal.mixin({toast:!0,position:"bottom-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:function(t){t.addEventListener("mouseenter",e.$swal.stopTimer),t.addEventListener("mouseleave",e.$swal.resumeTimer)},popup:"swal2-show",backdrop:"swal2-backdrop-show",icon:"swal2-icon-show"});a.fire({icon:"success",title:"You Unlike this Studio"})}}))},searchMethods:function(){var t=this;this.timer&&(clearTimeout(this.timer),this.timer=null),this.timer=setTimeout((function(){t.getDataStudio(),t.is_loading=!0}),700)}}},$=_,C=(i("f058"),i("ac35"),i("490a")),L=i("3129"),I=i("8654"),O=Object(c["a"])($,a,n,!1,null,"176cbbdf",null);e["default"]=O.exports;d()(O,{VCol:v["a"],VContainer:p["a"],VProgressCircular:C["a"],VRow:y["a"],VSkeletonLoader:L["a"],VTextField:I["a"]})},f058:function(t,e,i){"use strict";i("4663")}}]);
//# sourceMappingURL=chunk-1f337aa6.cd33c5eb.js.map