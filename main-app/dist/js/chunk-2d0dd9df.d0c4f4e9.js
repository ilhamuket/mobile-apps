(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0dd9df"],{"81c3":function(e,t,s){"use strict";s.r(t);var o=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div")},a=[],n=s("bc3a"),i=s.n(n),r={created:function(){this.verify()},methods:{verify:function(){var e=this;i.a.defaults.headers.common.Authorization="Bearer "+localStorage.getItem("access_token"),i.a.defaults.baseURL="http://127.0.0.1:8000/v1/",i.a.get("auth/verifications").then((function(t){if(console.log(t),t.data.meta.status){var s=e.$swal.mixin({toast:!0,position:"bottom-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:function(t){t.addEventListener("mouseenter",e.$swal.stopTimer),t.addEventListener("mouseleave",e.$swal.resumeTimer)},popup:"swal2-show",backdrop:"swal2-backdrop-show",icon:"swal2-icon-show"});s.fire({icon:"success",title:t.data.meta.message}),e.$router.push("/")}else{e.$router.push("/error");var o=e.$swal.mixin({toast:!0,position:"bottom-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:function(t){t.addEventListener("mouseenter",e.$swal.stopTimer),t.addEventListener("mouseleave",e.$swal.resumeTimer)},popup:"swal2-show",backdrop:"swal2-backdrop-show",icon:"swal2-icon-show"});o.fire({icon:"success",title:"Diem"})}}))}}},c=r,u=s("2877"),d=Object(u["a"])(c,o,a,!1,null,null,null);t["default"]=d.exports}}]);
//# sourceMappingURL=chunk-2d0dd9df.d0c4f4e9.js.map