/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { ready, isNumeric } = require('jquery');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$().ready(function(){

    formValidator($('#pizzaCreateForm'));
    formValidator($('#pizzaEditForm'));

    function formValidator(form){
        form.submit(function(event){
            let errors = false;
            $('#error-nome').hide();
            $('#error-descrizione').hide();
            $('#error-prezzo').hide();

            // Campo nome
                if($('#nome').val().length === 0){
                    $('#error-nome').show('slow').text('Il campo nome è obbligatorio').fadeOut(4000);
                    $('#nome').addClass('is-invalid');
                    errors = true;
                }
                else if($('#nome').val().length < 3){
                    $('#error-nome').show('slow').text('Il campo nome deve avere minimo 3 caratteri').fadeOut(4000);
                    $('#nome').addClass('is-invalid');
                    errors = true;
                }
                else if($('#nome').val().length > 50){
                    $('#error-nome').show('slow').text('Il campo nome può avere massimo 50 caratteri').fadeOut(4000);
                    $('#nome').addClass('is-invalid');
                    errors = true;
                }else{
                    $('#nome').removeClass('is-invalid')
                }
            //

            // Campo descrizione
                if($('#descrizione').val().length === 0){
                    $('#error-descrizione').show('slow').text('Il campo descrizione è obbligatorio').fadeOut(4000);
                    $('#descrizione').addClass('is-invalid');
                    errors = true;
                }
                else if($('#descrizione').val().length < 5){
                    $('#error-descrizione').show('slow').text('Il campo descrizione deve avere minimo 5 caratteri').fadeOut(4000);
                    $('#descrizione').addClass('is-invalid');
                    errors = true;
                }else{
                    $('#descrizione').removeClass('is-invalid')
                }
            //

            // Campo prezzo
                if($('#prezzo').val().length === 0){
                    $('#error-prezzo').show('slow').text('Il campo prezzo è obbligatorio').fadeOut(4000);
                    $('#prezzo').addClass('is-invalid');
                    errors = true;
                }
                else if($('#prezzo').val() >= 100){
                    $('#error-prezzo').show('slow').text("Il campo prezzo deve essere inferiore a 100€").fadeOut(4000);
                    $('#prezzo').addClass('is-invalid');
                    errors = true;
                }
                else if(isNaN($('#prezzo').val())){
                    $('#error-prezzo').show('slow').text('Il campo prezzo deve contenere solo numeri').fadeOut(4000);
                    $('#prezzo').addClass('is-invalid');
                    errors = true;
                }else{
                    $('#prezzo').removeClass('is-invalid')
                }
            //

            if(errors === true){
                event.preventDefault();
            }

        });

    }

});
