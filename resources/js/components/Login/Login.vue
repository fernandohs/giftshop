<template>
  <v-app id="inspire">
    <v-main>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md6>
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Authentication</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <v-form ref="form" @submit.prevent="login">
                  <v-text-field
                    v-model="form.email"
                    prepend-icon="email"
                    name="email"
                    label="Email"
                    type="email"
                    :rules="rules.email"
                    required
                  ></v-text-field>
                  <v-text-field
                    v-model="form.password"
                    id="password"
                    prepend-icon="lock"
                    name="password"
                    label="Password"
                    type="password"
                    :rules="rules.password"
                    required
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn @click="login" color="success">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    authenticated: false,
    form: {
      email: "",
      password: "",
    },
    rules: {
      password: [(v) => !!v || "Password is required"],
      email: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
    },
  }),
  name: "Login",
  props: {
    source: String,
  },
  methods: {
    validate() {
      return this.$refs.form.validate();
    },
    login() {
      if (!this.validate()) {
        return;
      }

      window.axios.get("/sanctum/csrf-cookie").then((response) => {
        window.axios
          .post("/api/login", {
            email: this.form.email,
            password: this.form.password,
          })
          .then((res) => {
            const { access_token } = res.data.data;
            localStorage.setItem("access_token", access_token.split("|")[1]);
            console.log("LOGGED");
          })
          .catch((error) => {
            this.errorMessage = error.message;
            console.error("There was an error!", error);
          });
      });
    },
  },
};
</script>

<style></style>
