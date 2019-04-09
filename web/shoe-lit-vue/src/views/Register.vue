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
                <v-toolbar-title>Register</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    v-model="username"
                    id="username"
                    prepend-icon="person"
                    label="Username"
                    type="text"
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
                  <v-text-field
                    v-model="password2"
                    id="password-repeat"
                    prepend-icon="lock"
                    label="Repeat Password"
                    type="password"
                    @keypress.enter="register"
                  />
                  <v-btn
                    color="success"
                    type="file"
                    @click="$refs.avatarUpload.click()"
                  >
                    Select Avatar
                  </v-btn>
                  <span v-if="avatar !== undefined && avatar.name !== undefined">
                    {{ avatar.name }}
                  </span>
                  <input
                    v-show="false"
                    ref="avatarUpload"
                    type="file"
                    @change="handleAvatarUpload"
                  >
                  <!-- @change="inputFileExcel" -->
                </v-form>
                <div style="width: 155px; margin: auto; font-size: 11px;">
                  Already have an account? <router-link to="/login">Login</router-link>
                </div>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click="register">Register</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      username : '',
      password : '',
      password2: '',
      avatar   : undefined,
      snackbar : {
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
    handleAvatarUpload() {
      if (this.$refs.avatarUpload !== undefined && this.$refs.avatarUpload.files.length > 0)
        this.avatar = this.$refs.avatarUpload.files[0];
    },

    register() {
      const data = new FormData();
      data.append('username', this.username);
      data.append('password', this.password);
      data.append('password2', this.password2);
      data.append('avatar', this.avatar);

      axios.post('/api/register', data, {headers: { 'Content-Type': 'multipart/form-data' }}).then((response) => {
        if (
          Reflect.has(response, 'data') &&
          Reflect.has(response.data, 'status')
        ) {
          if (response.data.status === 'success') {
            this.$router.push('/login');
          } else {
            this.snackbar.message = `Registration failed! ${response.data.reason}`;
            this.snackbar.visible = true;
          }
        }
      });
    }
  }
};
</script>
