<template>
  <v-app id="inspire">
    <v-snackbar
      v-model="snackbar.visible"
      top
    >
      {{ snackbar.message }}
      <v-btn
        v-for="(button, index) in snackbar.buttons"
        :key="index"
        :color="button.color"
        @click="button.callback"
      >
        {{ button.label }}
      </v-btn>
    </v-snackbar>
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex
            xs12
            sm8
            md4
          >
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Login</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    v-model="username"
                    id="username"
                    prepend-icon="person"
                    label="Username"
                    type="text"
                    autofocus
                    @keypress.enter="login"
                  />
                  <v-text-field
                    v-model="password"
                    id="password"
                    prepend-icon="lock"
                    label="Password"
                    type="password"
                    @keypress.enter="login"
                  />
                </v-form>
                <div style="width: 95px; margin: auto; font-size: 11px;">
                  New here? <router-link to="/register">Register</router-link>
                </div>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <!-- <v-btn color="info" @click="$router.push('/register')">Register</v-btn> -->
                <v-btn color="primary" @click="login">Login</v-btn>
              </v-card-actions>
              <!-- <div style="width: 140px; margin: auto; padding-bottom: 30px; font-size: 11px;">
                New here? Why not <router-link to="/register">register?</router-link>
              </div> -->
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import axios from 'axios';
import { Auth } from '../router.js';

export default {
  data() {
    return {
      username: 'asdf',
      password: 'asdf',
      snackbar: {
        visible: false,
        message: '',
        buttons: [
          {
            color   : 'pink',
            label   : 'OK',
            callback: () => { this.snackbar.visible = false }
          }
        ]
      }
    };
  },

  methods: {
    login() {
      axios.post('/api/login', {
        username: this.username,
        password: this.password
      }).then((response) => {
        if (
          Reflect.has(response, 'data') &&
          Reflect.has(response.data, 'status')
        ) {
          if (response.data.status === 'success') {
            Auth.loggedIn = true;
            Auth.user = response.data.user;
            this.$router.push('/');
          } else {
            this.snackbar.message = `Login failed! ${response.data.reason}`;
            this.snackbar.visible = true;
          }
        }
      });
    }
  }
};
</script>
