<template>
  <v-container
    fluid
    grid-list-xl
  >
    <v-layout
      align-center
      justify-center
      row
      wrap
    >
      <v-flex
        v-for="(post, index) in posts"
        :key="index"
        xs12>
        <v-layout
          align-center
          justify-center
          row>
          <v-flex
            xs12
            sm10
            md8
          >
            <v-card>
              <v-img :src="post.postImage"></v-img>
              <v-card-title primary-title>
                <v-layout row wrap>
                  <v-flex xs12>
                    <h3 class="headline mb-0">
                      <v-avatar size="70" color="grey lighten-4">
                        <img :src="post.avatar" alt="avatar">
                      </v-avatar>
                      {{ post.username }}
                    </h3>
                  </v-flex>
                  <v-flex xs12>
                    {{ post.postText }}
                  </v-flex>

                  <v-toolbar
                    card
                    color="transparent"
                    flat
                    dense
                  >
                    <v-toolbar-title>Shoes</v-toolbar-title>
                  </v-toolbar>

                  <v-flex
                    v-for="shoe in post.shoes"
                    :key="shoe.id"
                    xs12
                  >
                    <v-layout row wrap>
                      <v-flex xs4>{{ shoe.brand }}</v-flex>
                      <v-flex xs4>{{ shoe.model }}</v-flex>
                      <v-flex xs4>{{ shoe.colorway }}</v-flex>
                    </v-layout>
                  </v-flex>
                </v-layout>
              </v-card-title>
            </v-card>
          </v-flex>
        </v-layout>
      </v-flex>
    </v-layout>
    <v-btn
      color="green"
      dark
      fixed
      bottom
      right
      fab
      @click="$router.push('/new-post')"
    >
      <v-icon>add</v-icon>
    </v-btn>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Home',

  data() {
    return {
      posts: []
    };
  },

  async mounted() {
    let response = await axios.get('/api/post');
    if (response.data !== undefined && Array.isArray(response.data.posts))
      this.posts.splice(0, 0, ...response.data.posts);
  }
};
</script>
