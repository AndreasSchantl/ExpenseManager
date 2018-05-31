
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.directive('focus', {
    // When the bound element is inserted into the DOM...
    inserted: function (el) {
        // Focus the element
        el.focus()
    }
});


Vue.component('description-counter', require('./components/DescriptionCounter.vue'));

const app = new Vue({
    el: '#app',
    data: {
        desc: ''
    },
    methods: {
        trim: function() {
            if(this.desc.length > 70)
                this.desc = this.desc.substr(0, 70);
        }
    }
});

$('#delete').on('show.bs.modal', function (event) {
    console.log('Triggered');
    let button = $(event.relatedTarget);
    let name = button.data('name');
    let action = button.data('action');

    let modal = $(this);
    $('#del-name').html(name);
    $('#remove-form').attr('action', action)
});
