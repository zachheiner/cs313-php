import Vue from 'vue';
import Router from 'vue-router';
import Home from './views/Home.vue';

Vue.use(Router);

// route level code-splitting
// this generates a separate chunk (about.[hash].js) for this route
// which is lazy-loaded when the route is visited.

const router = new Router({
  routes: [
    {
      path     : '*',
      name     : '404',
      component: () => import(/* webpackChunkName: "404" */ './views/404.vue'),
      meta     : { requiresAuth: true, toolbarTitle: '404' }
    },
    {
      path     : '/',
      name     : 'home',
      component: Home,
      meta     : { requiresAuth: true, toolbarTitle: 'Posts' }
    },
    {
      path     : '/new-post',
      name     : 'new-post',
      component: () => import(/* webpackChunkName: "new-post" */ './views/NewPost.vue')
      // meta     : { requiresAuth: true, toolbarTitle: 'New Post' }
    },
    {
      path     : '/builder',
      name     : 'builder',
      component: () => import(/* webpackChunkName: "builder" */ './views/Builder.vue'),
      meta     : { requiresAuth: true, toolbarTitle: 'Shoe Builder' }
    },
    {
      path     : '/login',
      name     : 'login',
      component: () => import(/* webpackChunkName: "login" */ './views/Login.vue'),
      meta     : { toolbar: false }
    },
    {
      path     : '/register',
      name     : 'register',
      component: () => import(/* webpackChunkName: "register" */ './views/Register.vue'),
      meta     : { toolbar: false }
    }
  ]
});

const Auth = {
  loggedIn: false,
  user    : null
};

// Handle the routing between pages to have authentication, and reroute to the login page
router.beforeEach((to, from, next) => {
  // Redirect to the home page if you're logged in and trying to visit the login page
  if (to.name === 'login' && Auth.loggedIn)
    next({ path: '/' });
  // Redirect to the login page if you're not logged in
  else if (to.matched.some((record) => record.meta.requiresAuth) && !Auth.loggedIn)
    next({ path: '/login' });
  else
    next();
});

export { Auth };
export default router;
