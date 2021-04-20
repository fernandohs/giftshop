<template>
  <v-row>
    <loader :is-visible="isLoading"></loader>
    <v-col lg="12" class="mt-3 mb-3">
      <h1>Categories of products</h1>
      <p>Description</p>
      <category-modal
        v-bind:categoryIndex="editedIndex"
        v-bind:categoryEdit="editedItem"
        @created="handleCreate"
      ></category-modal>
    </v-col>

    <v-col lg="12" class="mt-3 mb-3">
      <template>
        <v-data-table
          :headers="headers"
          :items="categories"
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
import Category from "../components/Category";
import Loader from "../components/Loader";

export default {
  mounted() {
    this.isLoading = true;
    
    window.axios
      .get("/api/category")
      .then((response) => {
        this.categories = response.data;
      })
      .catch((error) => {
        console.error("There was an error!", error);
      })
      .finally(() => {
        this.isLoading = false;
      });
  },
  components: {
    "category-modal": Category,
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
      { text: "Description", value: "description" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    categories: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      description: "",
    },
    defaultItem: {
      name: "",
      description: "",
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
      this.categories = [];
    },
    handleCreate() {
      this.editedIndex = -1;
    },

    editItem(item) {
      this.editedIndex = this.categories.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;

      // aqui va
    },

    deleteItem(item) {
      this.editedIndex = this.categories.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.categories.splice(this.editedIndex, 1);
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
    saveDate(date) {
      console.log(this.editedItem.birth_date);
      this.$refs.menu.save(date);
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.categories[this.editedIndex], this.editedItem);
        console.log("UPDATE");
      } else {
        this.categories.push(this.editedItem.birth_date);
        console.log("ADD");
      }
      this.close();
    },
  },
};
</script>