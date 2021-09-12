import Vue from 'vue'
import Router from 'vue-router'
import auth from '../store/module/auth'
// import t from '../i18n'
import i18n from '@/i18n'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      component: () => import('@/views/dashboard/Index'),
      children: [
        // Dashboard
        {
          name: 'dashboard',
          path: '',
          component: () => import('@/views/dashboard/main/Dashboard'),
          meta: {
            requiresAuth: true,
          },
        },
        // Pages
        {
          name: 'User Profile',
          path: 'pages/user',
          component: () => import('@/views/dashboard/pages/UserProfile'),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: 'Notifications',
          path: 'components/notifications',
          component: () => import('@/views/dashboard/component/Notifications'),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: 'Icons',
          path: 'components/icons',
          component: () => import('@/views/dashboard/component/Icons'),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: 'Typography',
          path: 'components/typography',
          component: () => import('@/views/dashboard/component/Typography'),
          meta: {
            requiresAuth: true,
          },
        },
        // Tables
        {
          name: 'Regular Tables',
          path: 'tables/regular-tables',
          component: () => import('@/views/dashboard/tables/RegularTables'),
          meta: {
            requiresAuth: true,
          },
        },
        // Maps
        {
          name: 'Google Maps',
          path: 'maps/google-maps',
          component: () => import('@/views/dashboard/maps/GoogleMaps'),
          meta: {
            requiresAuth: true,
          },
        },
        // Upgrade
        {
          name: 'Upgrade',
          path: 'upgrade',
          component: () => import('@/views/dashboard/Upgrade'),
        },
        // Tablle Clas
        {
          name: 'index_class',
          path: '/class',
          component: () =>
            import('@/views/dashboard/admin/studio/classes/index'),
          meta: {
            requiresAuth: true,
          },
        },
        // SuvClass
        {
          name: 'subject',
          path: '/sub-class',
          component: () =>
            import('@/views/dashboard/admin/studio/sub_class/index'),
          meta: {
            requiresAuth: true,
          },
        },
        // Vidio
        {
          name: 'vidio_name',
          path: '/vidio',
          component: () => import('@/views/dashboard/admin/studio/vidio/index'),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: 'sub_class_create',
          path: '/create/sub-class',
          component: () =>
            import('@/views/dashboard/admin/studio/sub_class/create.vue'),
          meta: {
            requiresAuth: true,
          },
        },
        // Studio
        {
          name: 'Studio',
          path: '/studio',
          component: () => import('@/views/dashboard/pages/studio'),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: 'Detail Studio',
          path: '/:slug/:folder',
          component: () =>
            import('@/views/dashboard/pages/studio/detailStudio'),
          meta: {
            requiresAuth: true,
          },
          beforeEnter (to, _, next) {
            if (
              ['home', 'class', 'reviews', 'spam', 'trash'].includes(
                to.params.folder,
              )
            ) {
              next()
            } else next({ name: 'studio' })
          },
        },
        // Teacher Studio
        {
          name: 'instrucktur',
          path: '/instructor',
          component: () =>
            import('@/views/dashboard/admin/studio/teachers/index'),
          meta: {
            requiresAuth: true,
          },
        },
      ],
    },
    {
      name: 'Login',
      path: '/login',
      component: () => import('@/auth/login'),
      meta: {
        requiresVisitor: true,
      },
    },
    {
      name: 'Register',
      path: '/register',
      component: () => import('@/auth/register/index'),
      meta: {
        requiresVisitor: true,
      },
    },
    {
      name: 'Verifications',
      path: '/verification',
      component: () => import('@/auth/verifikasi/verification'),
      meta: {
        requiresAuth: true,
      },
    },
    {
      name: 'Logout',
      path: '/logout',
      component: () => import('@/auth/logout'),
      meta: {
        requiresAuth: true,
      },
    },
  ],
})

router.beforeEach((to, from, next) => {
  document.title = `${i18n.t(to.name)} - ${process.env.VUE_APP_TITLE}`

  if (to.matched.some(record => record.meta.requiresAuth)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (localStorage.getItem('access_token') === null) {
      // console.log(, 'from')

      next({
        path: '/login',
        query: { redirect: to.fullPath },
      })
    } else {
      next()
      const Me = localStorage.getItem('ME')
      const users = JSON.parse(Me)

      if (users.isVerified === 1) {
        if (to.name === 'WaitingEmail') {
          next({ path: '/' })
        } else if (to.name === 'Verifications') {
          next({ path: '/' })
        }
      } else {
        next({})
      }
    }

    // console.log(to.fullPath, 'normal')

    if (to.matched.some(record => record.meta.requiresAdmin)) {
      if (auth.state.token) {
        const Me = localStorage.getItem('ME')
        const users = JSON.parse(Me)
        if (users !== null) {
          if (
            users.role.some(x => x.name === 'admin' || 'superadministrator')
          ) {
            next()
          } else {
            next({
              path: '/',
            })
          }
        }
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
  } else if (to.matched.some(record => record.meta.requiresVisitor)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (localStorage.getItem('access_token')) {
      next({
        path: '/',
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
