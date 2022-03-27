import Vue from "vue"
import Router from "vue-router"
import auth from "../store/module/auth"
// import t from '../i18n'
import i18n from "@/i18n"
// import store from "../store/store"

Vue.use(Router)

const router = new Router({
  mode: "history",
  base: process.env.BASE_URL,
  routes: [
    {
      path: "/",
      redirect: "/dashboard/home",
      component: () => import("@/views/dashboard/Index"),
      children: [
        // Dashboard
        {
          name: "dashboard",
          path: "/dashboard/:params",
          component: () => import("@/views/dashboard/pages/profile/index"),
          meta: {
            breadcumbs: [
              {
                text: "Dashboard",
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
            if (
              [
                "home",
                "profile",
                "socmed",
                "discussion",
                "reviews",
                "bank-account",
              ].includes(to.params.params)
            ) {
              next()
            } else next({ name: "index_class" })
          },
        },
        // Class Vidio
        {
          name: "class_vidio",
          path: "/class-vidio",
          component: () =>
            import("@/views/dashboard/admin/studio/classVidio/index.vue"),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: "Notifications",
          path: "/components/notifications",
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
        // article
        {
          name: "article",
          path: "/article",
          component: () => import("@/views/dashboard/admin/studio/article"),
          meta: {
            requiresAuth: true,
          },
        },

        {
          name: "create_article",
          path: "/create-article",
          component: () =>
            import("@/views/dashboard/admin/studio/article/create"),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: "show_article",
          path: "/show/:id/article",
          component: () =>
            import("@/views/dashboard/admin/studio/article/show"),
          meta: {
            requiresAuth: true,
            breadcumbs: [
              {
                text: "Article",
                to: "/article",
              },
            ],
          },
        },

        // Tablle Cla
        {
          name: "index_class",
          path: "/class",
          component: () =>
            import("@/views/dashboard/admin/studio/classes/index"),
          meta: {
            breadcumbs: [
              {
                text: "Dashboard",
                disabled: false,
                to: "/",
              },
              {
                text: "Instructor",
                disabled: false,
                to: "/instructor",
              },
            ],
            requiresAuth: true,
          },
        },
        // SuvClass
        {
          name: "subject",
          path: "/sub-class",
          component: () =>
            import("@/views/dashboard/admin/studio/sub_class/index"),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: "student_has",
          path: "/student",
          component: () =>
            import("@/views/dashboard/admin/studio/hasStudent/index"),
          meta: {
            requiresAuth: true,
            breadcumbs: [
              {
                text: "Dashboard",
                to: "/",
              },
            ],
          },
        },
        {
          name: "student",
          path: "/class/:slug/keyword/:keyword/student",
          component: () =>
            import("@/views/dashboard/admin/studio/student/index"),
          meta: {
            breadcumbs: [
              {
                text: "Class",
                to: "/class",
              },
              {
                text: localStorage.getItem("class_name"),
              },
            ],
            requiresAuth: true,
          },
        },
        // Vidio
        {
          name: "vidio_name",
          path: "/vidio",
          component: () => import("@/views/dashboard/admin/studio/vidio/index"),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: "sub_class_create",
          path: "/create/sub-class",
          component: () =>
            import("@/views/dashboard/admin/studio/sub_class/create.vue"),
          meta: {
            requiresAuth: true,
          },
        },
        // Studio
        {
          name: "Studio",
          path: "/studio",
          component: () => import("@/views/dashboard/pages/studio"),
          meta: {
            requiresAuth: true,
          },
        },

        {
          name: "Detail Studio",
          path: "/:slug/:folder",
          component: () =>
            import("@/views/dashboard/pages/studio/detailStudio"),
          meta: {
            requiresAuth: true,
          },
          beforeEnter (to, _, next) {
            if (
              ["home", "class", "reviews", "spam", "trash"].includes(
                to.params.folder,
              )
            ) {
              next()
            } else next({ name: "studio" })
          },
        },
        // Teacher Studio
        {
          name: "instrucktur",
          path: "/instructor",
          component: () =>
            import("@/views/dashboard/admin/studio/teachers/index"),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: "vidio-instructor",
          path: "/instructor/vidio-profile/:slug",
          component: () =>
            import("@/views/dashboard/admin/studio/teachers/vidioProfile/"),
          meta: {
            requiresAuth: true,
            breadcumbs: [
              {
                text: "Instructor",
                disabled: false,
                to: "/",
              },
              {
                text: localStorage.getItem("instructor"),
              },
            ],
          },
        },
        // Categoories
        {
          name: "category",
          path: "category",
          component: () =>
            import("@/views/dashboard/admin/studio/categories/index"),
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
          name: "cart_live",
          path: "/cart-live",
          component: () => import("@/views/dashboard/cart/index"),
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
      ],
    },

    {
      name: "Register",
      path: "/register",
      component: () => import("@/auth/registerStudio/index"),
      meta: {
        requiresVisitor: true,
      },
    },
    {
      name: "Login",
      path: "/login",
      component: () => import("@/auth/login"),
      meta: {
        requiresVisitor: true,
      },
    },

    // {
    //   name: "Register",
    //   path: "/daftar",
    //   component: () => import("@/auth/registerStudio/index"),
    // },
    {
      name: "Verifications",
      path: "/verification",
      component: () => import("@/auth/verifikasi/verification"),
      meta: {
        requiresAuth: true,
      },
    },
    {
      name: "WaitingEmail",
      path: "/waiting-email",
      component: () => import("@/auth/verifikasi/waitingEmail.vue"),
      meta: {
        requiresAuth: true,
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
  document.title = `${i18n.t(to.name)} - ${process.env.VUE_APP_TITLE}`

  if (to.matched.some((record) => record.meta.requiresAuth)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (
      localStorage.getItem("access_token") === null ||
      localStorage.getItem("access_token") === ""
    ) {
      next({
        path: "/login",
        query: { redirect: to.fullPath },
      })
    } else {
      // console.log('Dari ', from.name, 'Ke ', to.name)
      next()
    }

    // console.log(to.fullPath, 'normal')

    if (to.matched.some((record) => record.meta.requiresAdmin)) {
      if (auth.state.token) {
        const Me = localStorage.getItem("ME")
        const users = JSON.parse(Me)
        if (users !== null) {
          if (
            users.role.some((x) => x.name === "admin" || "superadministrator")
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
  } else if (to.matched.some((record) => record.meta.requiresVisitor)) {
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
  } else {
    next() // make sure to always call next()!
  }
})

export default router
