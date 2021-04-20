<template>
  <v-dialog v-model="dialog" max-width="800px">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
        Add Category
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
                  v-model="category.name"
                  label="Name"
                  prepend-icon="mdi-account"
                  :rules="rules.name"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="12" md="12">
                <v-textarea
                  filled
                  v-model="category.description"
                  label="Description of category"
                ></v-textarea>
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
    categoryIndex: { type: Number, default: -1 },
    categoryEdit: { type: Object, default: {} },
  },

  data: () => ({
    dialog: false,
    dialogDelete: false,
    category: {
      name: "",
      description: "",
    },
    defaultCategory: {
      name: "",
      description: "",
    },
    rules: {
      name: [(v) => !!v || "Name is required"],
    },
  }),

  computed: {
    formTitle() {
      return this.categoryIndex === -1 ? "New Category" : "Edit Category";
    },
    isAddForm() {
      return this.categoryIndex === -1;
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
    categoryIndex(val) {
      if (val > -1) {
        this.dialog = true;
        this.category = this.categoryEdit;
      }
    },
  },

  methods: {
    validate() {
      return this.$refs.form.validate();
    },

    deleteItem(item) {
      this.editedIndex = this.categories.indexOf(item);
      this.category = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.categories.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      //this.$nextTick(() => {
      this.category = Object.assign({}, this.defaultCategory);
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
      if (!this.validate()) {
        return;
      }

      if (this.categoryIndex > -1) {
        window.axios
          .put(`/api/category/${this.category.id}`, this.category)
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
          .post("/api/category", this.category)
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