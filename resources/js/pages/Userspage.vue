<template>
  <v-row>
    <v-col lg="12" class="mt-3 mb-3">
      <h1>Users</h1>
      <p>Description</p>
      <user-modal 
        v-bind:userIndex="editedIndex"
        v-bind:userEdit="editedItem"
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
          <!-- <template v-slot:top>
            <v-toolbar flat>
              <v-toolbar-title>Users Table</v-toolbar-title>
              <v-divider class="mx-4" inset vertical></v-divider>
              <v-spacer></v-spacer>
              <v-dialog v-model="dialog" max-width="800px">
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                    v-bind="attrs"
                    v-on="on"
                  >
                    Add User
                  </v-btn>
                </template>
                <v-card>
                  <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                  </v-card-title>

                  <v-card-text>
                    <v-container>
                      <v-row>
                        <v-col cols="12" sm="6" md="4">
                          <v-text-field
                            v-model="editedItem.name"
                            label="Name"
                            prepend-icon="mdi-account"
                          ></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                          <v-text-field
                            v-model="editedItem.email"
                            label="Email"
                            prepend-icon="email"
                          ></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                          <v-menu
                            ref="menu"
                            v-model="menu"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                          >
                            <template v-slot:activator="{ on, attrs }">
                              <v-text-field
                                v-model="editedItem.birth_date"
                                label="Birthday date"
                                prepend-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                              ></v-text-field>
                            </template>
                            <v-date-picker
                              ref="picker"
                              v-model="editedItem.birth_date"
                              :max="new Date().toISOString().substr(0, 10)"
                              min="1950-01-01"
                              @change="saveDate"
                            ></v-date-picker>
                          </v-menu>
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                          <v-text-field
                            v-model="editedItem.phone"
                            label="Phone"
                            prepend-icon="phone"
                          ></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                          <v-text-field
                            v-model="editedItem.city"
                            label="City"
                            prepend-icon="mdi-map-marker"
                          ></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                          <v-text-field
                            v-model="editedItem.state"
                            label="State"
                            prepend-icon="mdi-map-marker"
                          ></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                          <v-text-field
                            v-model="editedItem.street"
                            label="Street"
                            prepend-icon="domain"
                          ></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                          <v-text-field
                            v-model="editedItem.password"
                            label="Password"
                            type="password"
                            prepend-icon="lock"
                          ></v-text-field>
                        </v-col>
                      </v-row>
                    </v-container>
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

              <v-dialog v-model="dialogDelete" max-width="500px">
                <v-card>
                  <v-card-title class="headline"
                    >Are you sure you want to delete this item?</v-card-title
                  >
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="closeDelete"
                      >Cancel</v-btn
                    >
                    <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                      >OK</v-btn
                    >
                    <v-spacer></v-spacer>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-toolbar>
          </template>
           -->
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

export default {
  mounted() {
    axios
      .get("/api/user")
      .then((response) => {
        this.users = response.data;
      })
      .catch((error) => {
        console.error("There was an error!", error);
      });
  },
  components: {
    'user-modal': User,
  },
  data: () => ({
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