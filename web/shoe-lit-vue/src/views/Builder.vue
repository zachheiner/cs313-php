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
                <v-toolbar-title>New Brand</v-toolbar-title>
              </v-toolbar>
              <v-container>
                <v-layout row wrap>
                  <v-flex xs12>
                    <v-text-field
                      v-model="newBrandName"
                      label="Brand Name"
                      @keypress.enter="submitBrand"
                    ></v-text-field>
                  </v-flex>
                  <div style="display: flex; flex: 1 1 auto;">
                    <v-spacer></v-spacer>
                    <v-btn
                      color="primary darken-4"
                      @click="submitBrand"
                    >
                      Submit
                    </v-btn>
                  </div>
                </v-layout>
              </v-container>
            </v-card>
          </v-flex>

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
                <v-toolbar-title>New Model</v-toolbar-title>
              </v-toolbar>
              <v-container>
                <v-layout row wrap>
                  <v-flex xs6>
                    <v-select
                      v-model="newModelBrand"
                      label="Brand Name"
                      :items="brands"
                      item-text="name"
                      item-value="id"
                    ></v-select>
                  </v-flex>
                  <v-flex xs6>
                    <v-text-field
                      v-model="newModelName"
                      label="Model Name"
                      @keypress.enter="submitModel"
                    ></v-text-field>
                  </v-flex>
                  <div style="display: flex; flex: 1 1 auto;">
                    <v-spacer></v-spacer>
                    <v-btn
                      color="primary darken-4"
                      @click="submitModel"
                    >
                      Submit
                    </v-btn>
                  </div>
                </v-layout>
              </v-container>
            </v-card>
          </v-flex>

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
                <v-toolbar-title>New Colorway</v-toolbar-title>
              </v-toolbar>
              <v-container>
                <v-layout row wrap>
                  <v-flex xs4>
                    <v-select
                      v-model="newColorwayBrand"
                      label="Brand"
                      :items="brands"
                      item-text="name"
                      item-value="id"
                      @change="updateModels(newColorwayBrand)"
                    ></v-select>
                  </v-flex>
                  <v-flex xs4>
                    <v-select
                      v-model="newColorwayModel"
                      :disabled="newColorwayBrand === '' || newColorwayBrand === undefined"
                      label="Model"
                      :items="models"
                      item-text="name"
                      item-value="id"
                    ></v-select>
                  </v-flex>
                  <v-flex xs4>
                    <v-text-field
                      v-model="newColorwayName"
                      label="Colorway Name"
                      @keypress.enter="submitColorway"
                    ></v-text-field>
                  </v-flex>
                  <div style="display: flex; flex: 1 1 auto;">
                    <v-spacer></v-spacer>
                    <v-btn
                      color="primary darken-4"
                      @click="submitColorway"
                    >
                      Submit
                    </v-btn>
                  </div>
                </v-layout>
              </v-container>
            </v-card>
          </v-flex>

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
                <v-toolbar-title>New Shoe</v-toolbar-title>
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
                  <div style="display: flex; flex: 1 1 auto;">
                    <v-spacer></v-spacer>
                    <v-btn
                      color="primary darken-4"
                      @click="submitShoe"
                    >
                      Submit
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
  name: 'Builder',

  data() {
    return {
      brands   : [],
      models   : [],
      colorways: [],

      newBrandName: '',

      newModelBrand: '',
      newModelName : '',

      newColorwayBrand: '',
      newColorwayModel: '',
      newColorwayName : '',

      newShoeBrand   : '',
      newShoeModel   : '',
      newShoeColorway: ''
    };
  },

  async mounted() {
    let response = await axios.get('/api/brand');
    if (response.data !== undefined && Array.isArray(response.data.brands))
      this.brands.splice(0, 0, ...response.data.brands);

    // response = await axios.get('/api/model');
    // if (response.data !== undefined && Array.isArray(response.data.models))
    //   this.models.splice(0, 0, ...response.data.models);

    // response = await axios.get('/api/colorway');
    // if (response.data !== undefined && Array.isArray(response.data.colorways))
    //   this.colorways.splice(0, 0, ...response.data.colorways);
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

    async submitBrand() {
      if (this.newBrandName.trim() === '')
        return console.error('Must add brand name');

      const response = await axios.post('/api/brand', {name: this.newBrandName});

      if (response.data.status === 'fail') {
        console.error('Failed to create brand on the server side');
      } else {
        this.brands.push({
          id  : response.data.brand.id,
          name: this.newBrandName
        });

        this.newBrandName = '';
      }

      return undefined;
    },

    async submitModel() {
      if (this.newModelBrand === undefined || this.newModelBrand === '' || this.newModelBrand === null)
        return console.error('Must select brand');

      if (this.newModelName.trim() === '')
        return console.error('Must add model name');

      const response = await axios.post('/api/model', {
        name : this.newModelName,
        brand: this.newModelBrand
      });

      if (response.data.status === 'fail') {
        console.error('Failed to create model');
      } else {
        this.models.push({
          id  : response.data.model.id,
          name: this.newModelName
        });

        this.newModelName = '';
      }

      return undefined;
    },

    async submitColorway() {
      if (this.newColorwayModel === undefined || this.newColorwayModel === '' || this.newColorwayModel === null)
        return console.error('Must select model');

      if (this.newColorwayName.trim() === '')
        return console.error('Must add colorway name');

      const response = await axios.post('/api/colorway', {
        name : this.newColorwayName,
        model: this.newColorwayModel
      });

      if (response.data.status === 'fail') {
        console.error('Failed to create colorway');
      } else {
        this.colorways.push({
          id  : response.data.colorway.id,
          name: this.newColorwayName
        });

        this.newColorwayName = '';
      }

      return undefined;
    },

    async submitShoe() {
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
      else
        console.log('Successfully created colorway');

      return undefined;
    }
  }
};
</script>
