<template>
  <v-row>
    <loader :is-visible="isLoading"></loader>

    <v-col lg="12" class="mt-3 mb-3">
      <h1>Users</h1>
      <p>Description</p>
      <user-modal
        v-bind:userIndex="editedIndex"
        v-bind:userEdit="editedItem"
        @created="handleCreate"
      ></user-modal>
    </v-col>

    <v-col lg="12" class="mt-3 mb-3">
      <template>
        <v-data-table
          :headers="headers"
          :items="users"
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
import User from "../components/User";
import Loader from "../components/Loader";

export default {
  mounted() {
    this.isLoading = true;
    window.axios
      .get("/api/user")
      .then((response) => {
        this.users = response.data;
      })
      .catch((error) => {
        console.error("There was an error!", error);
      }).finally(()=>{
        this.isLoading = false;
      })
  },
  components: {
    "user-modal": User,
    loader: Loader,
  },
  data: () => ({
    isLoading:false,
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
      { text: "Email", value: "email" },
      { text: "Is Admin", value: "is_admin" },
      { text: "Phone", value: "phone" },
      { text: "City", value: "city" },
      { text: "State", value: "state" },
      { text: "Street", value: "street" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    users: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      birth_date: null,
      email: "",
      phone: "",
      city: "",
      state: "",
      street: "",
      zip_code: "",
      password: "",
    },
    defaultItem: {
      name: "",
      birth_date: null,
      email: "",
      user_type: "",
      phone: "",
      city: "",
      state: "",
      street: "",
      zip_code: "",
      password: "",
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New User" : "Edit User";
    },
  },

  watch: {
    menu(val) {
      val && setTimeout(() => (this.$refs.picker.activePicker = "YEAR"));
    },
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
      this.users = [];
    },
    handleCreate(){
      this.editedIndex = -1;
    },

    editItem(item) {
      this.editedIndex = this.users.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;

      // aqui va
    },

    deleteItem(item) {
      this.editedIndex = this.users.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.users.splice(this.editedIndex, 1);
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
        Object.assign(this.users[this.editedIndex], this.editedItem);
        console.log("UPDATE");
      } else {
        this.users.push(this.editedItem.birth_date);
        console.log("ADD");
      }
      this.close();
    },
  },
};
</script>