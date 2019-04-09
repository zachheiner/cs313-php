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
      <v-flex xs12>
        <v-layout
          align-center
          justify-center
          wrap
          row
        >
          <v-flex
            xs12
            sm10
            md8
          >
            <v-card>
              <v-toolbar
                card
                color="primary darken-1"
                dark
                flat
                dense
              >
                <v-toolbar-title>Post</v-toolbar-title>
              </v-toolbar>
              <v-container>
                <v-layout row wrap>
                  <v-flex xs12>
                    <v-btn
                      color="success"
                      type="file"
                      @click="$refs.photoUpload.click()"
                    >
                      Select Photo
                    </v-btn>
                    <span v-if="photo !== undefined && photo.name !== undefined">
                      {{ photo.name }}
                    </span>
                    <input
                      v-show="false"
                      ref="photoUpload"
                      type="file"
                      @change="handlePhotoUpload"
                    >
                  </v-flex>
                  <v-flex xs12>
                    <v-textarea
                      v-model="postText"
                      label="Post Text"
                      @keypress.enter="submitPost"
                    ></v-textarea>
                  </v-flex>
                </v-layout>
              </v-container>

              <v-toolbar
                card
                color="transparent"
                flat
                dense
              >
                <v-toolbar-title>Shoes</v-toolbar-title>
              </v-toolbar>

              <v-container>
                <v-layout row wrap>
                  <v-flex xs4>
                    <v-select
                      v-model="newShoeBrand"
                      label="Brand"
                      :items="brands"
                      item-text="name"
                      item-value="id"
                      @change="updateModels(newShoeBrand)"
                    ></v-select>
                  </v-flex>
                  <v-flex xs4>
                    <v-select
                      v-model="newShoeModel"
                      label="Model"
                      :disabled="newShoeBrand === '' || newShoeBrand === undefined"
                      :items="models"
                      item-text="name"
                      item-value="id"
                      @change="updateColorways(newShoeModel)"
                    ></v-select>
                  </v-flex>
                  <v-flex xs4>
                    <v-select
                      v-model="newShoeColorway"
                      label="Colorway"
                      :disabled="newShoeModel === '' || newShoeModel === undefined"
                      :items="colorways"
                      item-text="name"
                      item-value="id"
                    ></v-select>
                  </v-flex>
                  <template v-for="(shoe, index) in shoes">
                    <v-flex :key="`brand-${index}`" xs4>
                      {{ shoe.brand }}
                    </v-flex>
                    <v-flex :key="`model-${index}`" xs4>
                      {{ shoe.model }}
                    </v-flex>
                    <v-flex :key="`colorway-${index}`" xs4>
                      {{ shoe.colorway }}
                    </v-flex>
                  </template>
                  <div style="display: flex; flex: 1 1 auto;">
                    <v-btn color="secondary" @click="addShoe">
                      Add Shoe
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn color="primary darken-4" @click="submitPost">
                      Submit Post
                    </v-btn>
                  </div>
                </v-layout>
              </v-container>
            </v-card>
          </v-flex>
        </v-layout>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  name: 'NewPost',

  data() {
    return {
      brands   : [],
      models   : [],
      colorways: [],

      newShoeBrand   : '',
      newShoeModel   : '',
      newShoeColorway: '',

      postText: '',
      photo   : undefined,
      shoes   : []
    };
  },

  async mounted() {
    let response = await axios.get('/api/brand');
    if (response.data !== undefined && Array.isArray(response.data.brands))
      this.brands.splice(0, 0, ...response.data.brands);
  },

  methods: {

    async updateModels(brand) {
      const response = await axios.get(`/api/model/${brand}`);
      if (response.data !== undefined && Array.isArray(response.data.models))
        this.models.splice(0, this.models.length, ...response.data.models);
    },

    async updateColorways(model) {
      const response = await axios.get(`/api/colorway/${model}`);
      if (response.data !== undefined && Array.isArray(response.data.colorways))
        this.colorways.splice(0, this.colorways.length, ...response.data.colorways);
    },

    handlePhotoUpload() {
      if (this.$refs.photoUpload !== undefined && this.$refs.photoUpload.files.length > 0)
        this.photo = this.$refs.photoUpload.files[0];

      console.log(this.photo);
    },

    async addShoe() {
      if (this.newShoeBrand === undefined || this.newShoeBrand === '' || this.newShoeBrand === null)
        return console.error('Must select brand');

      if (this.newShoeModel === undefined || this.newShoeModel === '' || this.newShoeModel === null)
        return console.error('Must select brand');

      if (this.newShoeColorway === undefined || this.newShoeColorway === '' || this.newShoeColorway === null)
        return console.error('Must select brand');

      const response = await axios.post('/api/shoe', {
        brand   : this.newShoeBrand,
        model   : this.newShoeModel,
        colorway: this.newShoeColorway
      });

      if (response.data.status === 'fail')
        console.error('Failed to create shoe');
      // else
      //   console.log('Successfully created shoe');

      const shoe = response.data.shoe;

      if (this.shoes.find((s) => s.id === shoe.id) === undefined) {
        this.shoes.push({
          id      : shoe.id,
          brand   : this.brands.find((brand) => brand.id === this.newShoeBrand).name,
          model   : this.models.find((model) => model.id === this.newShoeModel).name,
          colorway: this.colorways.find((colorway) => colorway.id === this.newShoeColorway).name
        });
      }

      this.newShoeBrand = '';
      this.newShoeModel = '';
      this.newShoeColorway = '';

      return undefined;
    },

    async submitPost() {
      if (this.shoes.length <= 0)
        return console.error('Must add at least one shoe');

      if (this.photo === null || this.photo === undefined)
        return console.error('Must add a photo');

      const data = new FormData();
      data.append('postText', this.postText);
      data.append('shoes', JSON.stringify(this.shoes.reduce((acc, shoe) => {
        acc.push(shoe.id);

        return acc;
      }, [])));
      data.append('picture', this.photo);

      const response = await axios.post('/api/post', data, {headers: { 'Content-Type': 'multipart/form-data' }});

      if (response.data)
        console.log(response.data);

      return undefined;
    }
  }
};
</script>
