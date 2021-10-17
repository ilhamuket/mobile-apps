import Vue from "vue"
import Router from "vue-router"
import auth from "../store/module/auth"
import user from "../store/module/user/index"
import i18n from "@/i18n"

Vue.use(Router)

const router = new Router({
  mode: "history",
  base: process.env.BASE_URL,
  routes: [
    {
      path: "/",
      component: () => import("@/views/dashboard/Index"),
      children: [
        // Dashboard
        {
          name: "Dashboard",
          path: "",
          component: () => import("@/views/dashboard/Dashboard"),
          meta: {
            breadcumbs: [
              {
                text: "Studio",
                disabled: false,
                to: "/studio",
              },
              {
                text: "Classes",
                disabled: false,
                to: "/classes",
              },
            ],
            requiresAuth: true,
          },
        },
        // Pages
        {
          name: "User Profile",
          path: "pages/user",
          component: () => import("@/views/dashboard/pages/users/index"),
          meta: {
            breadcumbs: [
              {
                text: "Dashboard",
                disabled: false,
                to: "/",
              },
              {
                text: "Profile",
                disabled: false,
              },
            ],
            requiresAuth: true,
          },
        },
        {
          name: "Notifications",
          path: "components/notifications",
          component: () => import("@/views/dashboard/component/Notifications"),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: "Icons",
          path: "components/icons",
          component: () => import("@/views/dashboard/component/Icons"),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: "Typography",
          path: "components/typography",
          component: () => import("@/views/dashboard/component/Typography"),
          meta: {
            requiresAuth: true,
          },
        },
        // Tables
        {
          name: "Regular Tables",
          path: "tables/regular-tables",
          component: () => import("@/views/dashboard/tables/RegularTables"),
          meta: {
            requiresAuth: true,
          },
        },
        // Maps
        {
          name: "Google Maps",
          path: "maps/google-maps",
          component: () => import("@/views/dashboard/maps/GoogleMaps"),
          meta: {
            requiresAuth: true,
          },
        },
        // Upgrade
        {
          name: "Upgrade",
          path: "upgrade",
          component: () => import("@/views/dashboard/Upgrade"),
        },
        // Studio
        {
          name: "Studio",
          path: "/studio",
          component: () => import("@/views/dashboard/pages/studio"),
          meta: {
            breadcumbs: [
              {
                text: "Studio",
                disabled: false,
              },
              {
                text: "Dashboard",
                disabled: false,
                to: "/",
              },
            ],
            requiresAuth: true,
          },
        },
        {
          name: "DETAIL STUDIO",
          path: "/:slug/:folder",
          component: () =>
            import("@/views/dashboard/pages/studio/detailStudio"),
          meta: {
            breadcumbs: [
              {
                text: "Profile Studio",
                disabled: false,
              },
              {
                text: "Studio",
                disabled: false,
                to: "/studio",
              },
            ],
            requiresAuth: true,
          },
          beforeEnter (to, _, next) {
            if (["home", "class", "reviews"].includes(to.params.folder)) {
              next()
            } else next({ name: "Error" })
          },
        },
        // Classes
        {
          name: "classes",
          path: "/classes",
          component: () => import("@/views/dashboard/pages/classes/index"),
          meta: {
            breadcumbs: [
              {
                text: "DashBoard",
                disabled: false,
                to: "/",
              },
              {
                text: "Studio",
                disabled: false,
                to: "/",
              },
            ],
            requiresAuth: true,
          },
        },
        {
          name: "detail",
          path: "/classes/detail/:studio_slug/:slug",
          component: () =>
            import("@/views/dashboard/pages/classes/detailClasses.vue"),
          meta: {
            breadcumbs: [
              {
                text: "DashBoard",
                disabled: false,
                to: "/",
              },
              {
                text: "Studio",
                disabled: false,
                to: "/",
              },
            ],
            requiresAuth: true,
          },
        },
        {
          name: "detail_classes",
          path: "/detail/class/live/:studio_slug/:class_slug",
          component: () =>
            import("@/views/dashboard/pages/classes/detailClassZoom.vue"),
          meta: {
            breadcumbs: [
              {
                text: "DashBoard",
                disabled: false,
                to: "/",
              },

              {
                text: "Classes",
                to: "/classes",
              },
            ],
            requiresAuth: true,
          },
        },
        // Category
        {
          name: "category",
          path: "/category",
          component: () => import("@/views/dashboard/pages/category/index"),
          meta: {
            breadcumbs: [
              {
                text: "Dashboard",
                to: "/",
              },
            ],
            requiresAuth: true,
          },
        },
        {
          name: "detail_category",
          path: "/category/detail/:studio_slug/:name",
          component: () =>
            import("@/views/dashboard/pages/category/detailCategory"),
          meta: {
            breadcumbs: [
              {
                text: "Dashboard",
                to: "/",
              },
            ],
            requiresAuth: true,
          },
        },
        {
          name: "cart",
          path: "cart",
          component: () => import("@/views/dashboard/pages/cart/index"),
          meta: {
            breadcumbs: [
              {
                text: "Dashboard",
                to: "/",
              },
            ],
            requiresAuth: true,
          },
        },
        // cLASS vIDIO
        {
          name: "ensiklo_vidio",
          path: "/class-vidio",
          component: () => import("@/views/dashboard/pages/ensikloVidio/index"),
          meta: {
            breadcumbs: [
              {
                text: "Dashboard",
                to: "/",
              },
            ],
            requiresAuth: true,
          },
        },
        {
          name: "Error",
          path: "/error",
          component: () => import("@/views/dashboard/ensikloerrors/error"),
          meta: {
            requiresAuth: true,
          },
        },
        // {
        //   name: 'Page Not Found',
        //   path: '*',
        //   component: () => import('@/views/dashboard/ensikloerrors/error'),
        //   meta: {
        //     requiresAuth: true,
        //   },
        // },
      ],
    },
    {
      name: "Login",
      path: "/login",
      component: () => import("@/auth/login"),
      meta: {
        requiresVisitor: true,
      },
    },
    {
      name: "auth-register",
      path: "/register",
      component: () => import("@/auth/register"),
      meta: {
        requiresVisitor: true,
      },
    },
    {
      name: "WaitingEmail",
      path: "/waiting-email",
      component: () => import("@/auth/waitingEmail"),
      meta: {
        requiresAuth: true,
        // requiresVerifications: true,
      },
    },
    {
      name: "Verifications",
      path: "/verification",
      component: () => import("@/auth/verifyEmail"),
      meta: {
        requiresAuth: true,
        // requiresVerifications: true,
      },
    },

    {
      name: "Logout",
      path: "/logout",
      component: () => import("@/auth/logout"),
      meta: {
        requiresAuth: true,
      },
    },
  ],
})

router.beforeEach((to, from, next) => {
  document.title = `${i18n.t(to.name)}  - ${process.env.VUE_APP_TITLE}`

  if (to.matched.some(record => record.meta.requiresAuth)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (
      localStorage.getItem("access_token") === null ||
      localStorage.getItem("access_token") === ""
    ) {
      // console.log(, 'from')

      next({
        query: { redirect: to.fullPath },
        path: "/login",
      })
    } else {
      // console.log('Dari ', from.name, 'Ke ', to.name)
      next()
      const Me = localStorage.getItem("ME")
      const users = JSON.parse(Me)
      if (users.isVerified === 1) {
        if (to.name === "WaitingEmail") {
          next({ path: "/error" })
        } else if (to.name === "Verifications") {
          next({ path: "/error" })
        }
      } else {
        next({
          query: { redirect: to.fullPath },
        })
      }
    }

    // console.log(to.fullPath, 'normal')

    if (to.matched.some(record => record.meta.requiresAdmin)) {
      if (auth.state.token) {
        const Me = localStorage.getItem("ME")
        const users = JSON.parse(Me)
        if (users !== null) {
          if (
            users.role.some(x => x.name === "admin" || "superadministrator")
          ) {
            next()
          } else {
            next({
              path: "/",
            })
          }
        }
      }
    }
  } else if (to.matched.some(record => record.meta.requiresVisitor)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (localStorage.getItem("access_token")) {
      next({
        path: "/",
        query: { redirect: to.fullPath },
      })
    } else {
      next()
    }
  }
  // else {
  //   next() // make sure to always call next()!
  // }

  if (to.matched.some(record => record.meta.requiresVerifications)) {
    // const Me = localStorage.getItem('ME')
    // const users = JSON.parse(Me)
    if (user.state.me !== null) {
      // console.log(user.state.me.isVerified)
      if (user.state.me.isVerified === 0) {
        next()
      } else {
        next({ path: "/", query: { redirect: to.fullPath } })
      }
    }

    // if (to.matched.some(record => record.meta.requiresTeachers)) {
    //   if (auth.state.token) {
    //     const Me = localStorage.getItem('ME')
    //     const users = JSON.parse(Me)
    //     if (users !== null) {
    //       if (users.roles.some(x => x.name === 'teacher')) {
    //         next()
    //       } else {
    //         next({
    //           path: '/',
    //         })
    //       }
    //     }
    //   }
    // }

    // if (to.matched.some(record => record.meta.requiresStudent)) {
    //   if (auth.state.token) {
    //     const Me = localStorage.getItem('ME')
    //     const users = JSON.parse(Me)
    //     if (users !== null) {
    //       if (users.roles.some(x => x.name === 'student')) {
    //         next()
    //       } else {
    //         next({
    //           path: '/',
    //         })
    //       }
    //     }
    //   }
    // }
  }
})

export default router
