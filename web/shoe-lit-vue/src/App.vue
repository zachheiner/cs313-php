<template>
  <v-app>
    <template v-if="displayToolbar()">
      <v-navigation-drawer
        v-model="drawer"
        fixed
        app
        disable-resize-watcher
        disable-route-watcher
      >
        <v-toolbar
          color="primary"
          extended
          extension-height="50"
          dark
        >
          <v-layout
            align-center
            justify-center
            row
            fill-height
          >
            <div style="font-size: 30px; margin-top: 50px;">
              Shoe-Lit
            </div>
          </v-layout>
        </v-toolbar>
        <v-list dense>
          <v-list-tile
            v-for="(item, index) in menu"
            :key="index"
            @click="clickLink(item)"
          >
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{ item.label }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>

      </v-navigation-drawer>
      <v-toolbar
        color="primary"
        dark
        fixed
        app
      >
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <v-toolbar-title>{{ $router.currentRoute.meta.toolbarTitle || 'Shoe-Lit' }}</v-toolbar-title>
      </v-toolbar>
    </template>
    <v-content>
      <router-view />
    </v-content>
  </v-app>
</template>

<script>
import axios from 'axios';
import { Auth } from './router.js';

export default {
  name: 'App',
  data() {
    return {
      drawer: false,
      menu  : [
        {
          icon : 'contact_mail',
          route: '/',
          label: 'View Posts'
        },
        {
          icon : 'contact_mail',
          route: '/new-post',
          label: 'New Post'
        },
        {
          icon : 'contact_mail',
          route: '/builder',
          label: 'Shoe Builder'
        },
        {
          icon : 'home',
          route: '/login',
          label: 'Logout',
          click: async () => {
            await axios.post('/api/logout');

            Auth.loggedIn = false;
          }
        }
      ],
      loading: true
    };
  },

  mounted() {
    // console.log(this.$router.currentRoute);
    setTimeout(() => { this.loading = false; console.log(this.$router.currentRoute) }, 300);
  },

  methods: {
    displayToolbar() {
      if (this.$router.currentRoute.name === null)
        return false;

      if (!Reflect.has(this.$router.currentRoute.meta, 'toolbar'))
        return true;

      if (this.$router.currentRoute.meta.toolbar === true)
        return true;

      return false;
    },

    async clickLink(route) {
      this.drawer = false;

      if (typeof route.click === 'function')
        await route.click();

      this.$router.push(route.route);
    }
  }
};
</script>
