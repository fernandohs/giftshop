<template>
  <v-navigation-drawer v-model="drawer" app>
    <v-list dense>
      <v-list-item link exact :to="{ name: 'home' }">
        <v-list-item-action>
          <v-icon>mdi-home</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Home</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item link exact :to="{ name: 'users' }">
        <v-list-item-action>
          <v-icon>mdi-account</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Users</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item link exact :to="{ name: 'about' }">
        <v-list-item-action>
          <v-icon>mdi-information</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>About</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item link exact :to="{ name: 'contact' }">
        <v-list-item-action>
          <v-icon>mdi-email</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Contact</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item link exact :to="{ name: 'categories' }">
        <v-list-item-action>
          <v-icon>mdi-shopping</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Categories</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item link exact :to="{ name: 'products' }">
        <v-list-item-action>
          <v-icon>mdi-shopping</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Products</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item link exact :to="{ name: 'sales' }">
        <v-list-item-action>
          <v-icon>mdi-basket</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>Sales</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  data() {
    return {
      drawer: true,
    };
  },
};
</script>
