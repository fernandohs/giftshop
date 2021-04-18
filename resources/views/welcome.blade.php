<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title>GiftShop</title>


    <meta charset="utf-8">
    <meta content="width=device-width,initial-scale=1,minimal-ui" name="viewport">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>

<body>
    <div class="content">
        <div id="app">
            <v-app>
                <v-main>
                    <v-container>
                        {{-- <v-btn color="primary" elevation="3" large>
                            <hola-mundo  message="Click"></hola-mundo>
                        </v-btn>
                        <form-text></form-text> --}}
                        <form-test label="lbl test"></form-test>
                    </v-container>

                </v-main>
            </v-app>

        </div>
    </div>

    {{-- <script src="https://unpkg.com/vue@next"></script> --}}
    {{-- <script src="https://unpkg.com/vue-router@4"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.js"></script>
    <script src="https://unpkg.com/vue-router@3.1.3/dist/vue-router.min.js"></script> --}}

    <script src="https://unpkg.com/vue"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script src="https://unpkg.com/vue-router"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
