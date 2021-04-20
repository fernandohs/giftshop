<template>
  <v-dialog v-model="dialog" max-width="800px">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
        Add Product
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="headline">{{ formTitle }}</span>
      </v-card-title>

      <v-card-text>
        <v-form ref="form" @submit.prevent="save">
          <v-container>
            <v-row>
              <v-col cols="12" sm="12" md="12">
                <v-text-field
                  v-model="product.name"
                  label="Name"
                  prepend-icon="mdi-shopping"
                  :rules="rules.name"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="6">
                <v-text-field
                  v-model="product.price"
                  label="Price"
                  prepend-icon="mdi-currency-usd"
                  :rules="rules.price"
                  type="number"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="6">
                <v-text-field
                  v-model="product.stock"
                  label="Stock"
                  prepend-icon="mdi-calculator"
                  type="number"
                  :rules="rules.stock"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="12" md="12">
                <v-textarea
                  filled
                  v-model="product.description"
                  label="Description of product"
                ></v-textarea>
              </v-col>

              <v-col cols="12" sm="12" md="12">
                <v-select
                  v-model="product.categories"
                  :items="categories"
                  item-text="name"
                  item-value="id"
                  label="Categories"
                  multiple
                  chips
                  hint="Categories of product"
                  persistent-hint
                ></v-select>
              </v-col>
              <v-col cols="12" sm="12" md="12">
                <v-row justify="center">
                  <v-img
                    :src="product.url_image"
                    lazy-src="https://via.placeholder.com/300.png"
                    max-width="500"
                    max-height="300"
                  >
                    <template v-slot:placeholder>
                      <v-row
                        class="fill-height ma-0"
                        align="center"
                        justify="center"
                      >
                        <v-progress-circular
                          indeterminate
                          color="grey lighten-5"
                        ></v-progress-circular>
                      </v-row>
                    </template>
                  </v-img>
                </v-row>
              </v-col>
              <v-col cols="12" sm="12" md="12">
                <v-text-field
                  v-model="product.url_image"
                  label="Url Image"
                  prepend-icon="mdi-file-image"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-form>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn fab color="error darken-1" @click="close">
          <v-icon dark> mdi-close </v-icon>
        </v-btn>
        <v-btn fab color="success darken-1" @click="save">
          <v-icon dark> mdi-floppy </v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    productIndex: { type: Number, default: -1 },
    productEdit: { type: Object, default: {} },
  },
  mounted() {
    // this.isLoading = true;
    window.axios
      .get("/api/category")
      .then((response) => {
        this.categories = response.data;
      })
      .catch((error) => {
        console.error("There was an error!", error);
      })
      .finally(() => {
        // this.isLoading = false;
      });
  },
  data: () => ({
    dialog: false,
    dialogDelete: false,
    categories: [],
    product: {
      name: "",
      description: "",
      categories: [],
    },
    defaultProduct: {
      name: "",
      description: "",
      categories: [],
    },
    rules: {
      name: [(v) => !!v || "Name is required"],
      price: [(v) => !!v || "Price is required"],
      stock: [(v) => !!v || "Stock is required"],
    },
  }),

  computed: {
    formTitle() {
      return this.productIndex === -1 ? "New Product" : "Edit Product";
    },
    isAddForm() {
      return this.productIndex === -1;
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
    productIndex(val) {
      if (val > -1) {
        this.dialog = true;
        this.product = this.productEdit;
      }
    },
  },

  methods: {
    validate() {
      return this.$refs.form.validate();
    },

    deleteItem(item) {
      this.editedIndex = this.products.indexOf(item);
      this.product = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.products.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      //this.$nextTick(() => {
      this.product = Object.assign({}, this.defaultProduct);
      this.$emit("created");
      //});
    },

    closeDelete() {
      // this.dialogDelete = false;
      // this.$nextTick(() => {
      //   this.user = Object.assign({}, this.defaultUser);
      //   this.userIndex = -2;
      // });
    },
    saveDate(date) {
      this.$refs.menu.save(date);
    },

    save() {
      console.log(this.product)
      if (!this.validate()) {
        return;
      }

      if (this.productIndex > -1) {
        window.axios
          .put(`/api/product/${this.product.id}`, this.product)
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            console.error("There was an error!", error);
          })
          .finally(() => {
            // this.isLoading = false;
          });
      } else {
        // this.isLoading = true;
        window.axios
          .post("/api/product", this.product)
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            console.error("There was an error!", error);
          })
          .finally(() => {
            // this.isLoading = false;
          });
      }
      //this.close();
    },
  },
};
</script>