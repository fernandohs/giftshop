<template>
  <v-dialog v-model="dialog" max-width="800px">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
        Alone Add User
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
              <v-col cols="12" sm="6" md="4">
                <v-text-field
                  v-model="user.name"
                  label="Name"
                  prepend-icon="mdi-account"
                  :rules="rules.name"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field
                  v-model="user.email"
                  label="Email"
                  prepend-icon="email"
                  :rules="rules.email"
                  required
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
                      v-model="user.birth_date"
                      label="Birthday date"
                      prepend-icon="mdi-calendar"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                      :rules="rules.birth_date"
                      required
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    ref="picker"
                    v-model="user.birth_date"
                    :max="new Date().toISOString().substr(0, 10)"
                    min="1950-01-01"
                    @change="saveDate"
                  ></v-date-picker>
                </v-menu>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field
                  v-model="user.phone"
                  label="Phone"
                  prepend-icon="phone"
                  :rules="rules.phone"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field
                  v-model="user.city"
                  label="City"
                  prepend-icon="mdi-map-marker"
                  :rules="rules.city"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field
                  v-model="user.state"
                  label="State"
                  prepend-icon="mdi-map-marker"
                  :rules="rules.state"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field
                  v-model="user.street"
                  label="Street"
                  prepend-icon="domain"
                  :rules="rules.street"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field
                  v-model="user.zip_code"
                  label="ZipCode"
                  prepend-icon="domain"
                  :rules="rules.zip_code"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field
                  v-model="user.password"
                  label="Password"
                  type="password"
                  prepend-icon="lock"
                  :rules="isAddForm ? rules.password : []"
                  :required="isAddForm"
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-switch
                  v-model="user.is_admin"
                  :label="`Is Admin: ${user.is_admin.toString()}`"
                ></v-switch>
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
    userIndex: { type: Number, default: -1 },
    userEdit: { type: Object, default: {} },
  },

  data: () => ({
    dialog: false,
    dialogDelete: false,
    menu: false,
    userId: -2,
    user: {
      name: "",
      birth_date: null,
      email: "",
      is_admin: false,
      phone: "",
      city: "",
      state: "",
      street: "",
      zip_code: "",
      password: "",
    },
    defaultUser: {
      name: "",
      birth_date: null,
      email: "",
      is_admin: false,
      phone: "",
      city: "",
      state: "",
      street: "",
      zip_code: "",
      password: "",
    },
    rules: {
      name: [(v) => !!v || "Name is required"],
      zip_code: [(v) => !!v || "Zip Code is required"],
      password: [(v) => !!v || "Password is required"],
      birth_date: [(v) => !!v || "BirthDate is required"],
      email: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
      phone: [(v) => !!v || "Phone is required"],
      city: [(v) => !!v || "City is required"],
      state: [(v) => !!v || "State is required"],
      street: [(v) => !!v || "Street is required"],
    },
  }),

  computed: {
    formTitle() {
      return this.userIndex === -1 ? "New User" : "Edit User";
    },
    isAddForm() {
      return this.userIndex === -1;
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
    userIndex(val) {
      if (val > -1) {
        this.dialog = true;
        this.user = this.userEdit;
      }
    },
  },

  methods: {
    validate() {
      return this.$refs.form.validate();
    },
    editItem(item) {
      this.editedIndex = this.users.indexOf(item);
      this.user = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.users.indexOf(item);
      this.user = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.users.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      //this.$nextTick(() => {
      this.user = Object.assign({}, this.defaultUser);
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

      if (this.userIndex > -1) {
        // Object.assign(this.users[this.editedIndex], this.user);
        window.axios
          .put(`/api/user/${this.user.id}`, this.user)
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
          .post("/api/user", this.user)
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