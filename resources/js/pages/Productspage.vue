<template>
  <v-row>
    <loader :is-visible="isLoading"></loader>
    <v-col lg="12" class="mt-3 mb-3">
      <h1>Products</h1>
      <p>Description</p>
      <product-modal
        v-bind:productIndex="editedIndex"
        v-bind:productEdit="editedItem"
        @created="handleCreate"
      ></product-modal>
    </v-col>

    <v-col lg="12" class="mt-3 mb-3">
      <template>
        <v-data-table
          :headers="headers"
          :items="products"
          sort-by="name"
          class="elevation-1"
        >
          <template v-slot:item.actions="{ item }">
            <v-icon small class="mr-2" @click="editItem(item)">
              mdi-pencil
            </v-icon>
            <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
          </template>
          <template v-slot:no-data>
            <v-btn color="primary" @click="initialize"> Reset </v-btn>
          </template>
        </v-data-table>
      </template>
    </v-col>
  </v-row>
</template>
    </v-col>
  </v-row>
</template> 

<script>
import Product from "../components/Product";
import Loader from "../components/Loader";

export default {
  mounted() {
    this.isLoading = true;

    window.axios
      .get("/api/product")
      .then((response) => {
        this.products = response.data;
      })
      .catch((error) => {
        console.error("There was an error!", error);
      })
      .finally(() => {
        this.isLoading = false;
      });
  },


  components: {
    "product-modal": Product,
    loader: Loader,
  },
  data: () => ({
    isLoading: false,
    dialog: false,
    dialogDelete: false,
    menu: false,
    headers: [
      {
        text: "Name",
        align: "start",
        sortable: false,
        value: "name",
      },
      { text: "Price", value: "price" },
      { text: "Stock", value: "stock" },
      { text: "Description", value: "description" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    products: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      description: "",
      url_image: "",
      price: 0.0,
      stock: 0,
    },
    defaultItem: {
      name: "",
      description: "",
      url_image: "",
      price: 0.0,
      stock: 0,
    },
  }),

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.products = [];
    },
    handleCreate() {
      this.editedIndex = -1;
    },

    editItem(item) {
      this.editedIndex = this.products.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;

      // aqui va
    },

    deleteItem(item) {
      this.editedIndex = this.products.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.products.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
  },
};
</script>