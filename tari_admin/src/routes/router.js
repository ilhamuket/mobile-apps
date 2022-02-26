import Vue from 'vue'
import Router from 'vue-router'
import auth from '../store/modules/auth'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      component: () => import('@/views/dashboard/Index'),
      meta: {
        requiresAuth: true,
      },
      children: [
        // Dashboard
        {
          name: 'Dashboard',
          path: '',
          component: () => import('@/views/dashboard/Dashboard'),
          meta: {
            requiresAuth: true,
          },
        },
        // Pages Null
        {
          name: 'User Profile',
          path: 'user/settings',
          component: () => import('@/views/dashboard/profile/UserProfile'),
          meta: {
            requiresAuth: true,
            requiresAdmin: true,
          },
        },
        {
          name: 'myaccount',
          path: '/user/myaccount',
          component: () => import('@/views/dashboard/profile/MyAccount'),
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
          meta: {
            requiresAuth: true,
          },
        },
        // My Pages
        {
          name: 'dashboard_',
          path: '/dashboard',
          component: () => import('@/views/pages/dashboard/Index'),
          meta: {
            requiresAuth: true,
          },
        },
        // Categories
        {
          name: 'category',
          path: '/category',
          component: () => import('@/views/pages/classes/category/Index'),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: 'class',
          path: '/class',
          component: () => import('@/views/pages/classes/index'),
          meta: {
            requiresAuth: true,
          },
        },
        // User
        {
          name: 'user',
          path: '/user',
          component: () => import('@/views/pages/user/index'),
          meta: {
            requiresAuth: true,
          },
        },
        // Studio
        {
          name: 'studio',
          path: '/studio',
          component: () => import('@/views/pages/studio/index'),
          meta: {
            requiresAuth: true,
          },
        },
        // Article
        {
          name: 'journal',
          path: '/journal',
          component: () => import('@/views/pages/article/index'),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: 'journal.create',
          path: '/journal/create',
          component: () => import('@/views/pages/article/create'),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: 'journal.show',
          path: '/journal/:id/show',
          component: () => import('@/views/pages/article/showArticle'),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: 'journal.update',
          path: '/journal/:id/edit',
          component: () => import('@/views/pages/article/updateArticle'),
          meta: {
            requiresAuth: true,
          },
        },

        // Point Of Views Users
        {
          name: 'journal_page',
          path: '/u/journal',
          component: () => import('@/views/pages/pagesUsers/article/index'),
          meta: {
            requiresAuth: true,
          },
        },
        {
          name: 'Transaction',
          path: '/transaction',
          component: () => import('@/views/pages/transaction/index'),
          meta: {
            requiresAuth: true,
          },
        },
      ],
    },
    {
      name: 'Login',
      path: '/login',
      component: () => import('@/views/auth/Login'),
      meta: {
        requiresVisitor: true,
      },
    },
    {
      name: 'Sign-Up',
      path: '/sign-up',
      component: () => import('@/views/auth/signUp'),
      meta: {
        requiresVisitor: true,
      },
    },
    {
      name: 'Logout',
      path: '/logout',
      component: () => import('@/views/auth/Logout'),
      meta: {
        requiresAuth: true,
      },
    },
    // {
    //   path: '/landingpage',
    //   component: () => import('@/views/landingpage/index'),
    //   meta: {
    //     requiresVisitor: true,
    //   },
    //   children: [
    //     {
    //       path: '',
    //       component: () => import('@/views/landingpage/landingPage'),
    //       meta: {
    //         requiresVisitor: true,
    //       },
    //     },
    //   ],
    // },
  ],
})

router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (
      localStorage.getItem('access_token') === null ||
      localStorage.getItem('access_token') === ''
    ) {
      // console.log(, 'from')

      next({
        path: '/login',
        query: { redirect: to.fullPath },
      })
    } else {
      next({})
    }

    // console.log(to.fullPath, 'normal')

    if (to.matched.some((record) => record.meta.requiresAdmin)) {
      if (auth.state.token) {
        const Me = localStorage.getItem('ME')
        const users = JSON.parse(Me)
        if (users !== null) {
          if (
            users.role.some((x) => x.name === 'admin' || 'superadministrator')
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
  } else if (to.matched.some((record) => record.meta.requiresVisitor)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (localStorage.getItem('access_token')) {
      console.log(localStorage.getItem('access_item'))
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
