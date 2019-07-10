
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/* import fontawesome */
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserPlus } from '@fortawesome/free-solid-svg-icons'
import { faUsers } from '@fortawesome/free-solid-svg-icons'
import { faPlus } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faUserPlus);
library.add(faUsers);
library.add(faPlus);
Vue.component('font-awesome-icon', FontAwesomeIcon);

/* import datepicker */
import datePicker from 'vue-bootstrap-datetimepicker';
import 'bootstrap/dist/css/bootstrap.css';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

Vue.use(datePicker);
Vue.component('date-picker', datePicker);

import Multiselect from 'vue-multiselect';

Vue.component('multiselect', Multiselect)

import { GChart } from 'vue-google-charts';

Vue.use(GChart);
Vue.component('GChart', GChart);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('create-button', require('./components/buttons/createButton.vue').default);
Vue.component('show-button', require('./components/buttons/showButton.vue').default);

Vue.component('member-index-component', require('./components/member/MemberIndexComponent.vue').default);
Vue.component('member-profile-component', require('./components/member/MemberProfileComponent.vue').default);
Vue.component('member-create-form', require('./components/member/forms/MemberCreateForm.vue').default);

Vue.component('record-index-component', require('./components/record/RecordIndexComponent.vue').default);
Vue.component('record-profile-component', require('./components/record/RecordProfileComponent.vue').default);
Vue.component('record-create-form', require('./components/record/forms/RecordCreateForm.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.config.productionTip = false

const app = new Vue({
    el: '#app'
});

$.extend(true, jQuery.fn.datetimepicker.defaults, {
    icons: {
      time: 'far fa-clock',
      date: 'far fa-calendar',
      up: 'fas fa-arrow-up',
      down: 'fas fa-arrow-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right',
      today: 'fas fa-calendar-check',
      clear: 'far fa-trash-alt',
      close: 'far fa-times-circle'
    }
});
