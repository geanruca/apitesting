
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import miniToastr from 'mini-toastr';
require('./bootstrap');
window.Vue = require('vue');
window.axios = require('axios');
var Vue = require('vue');
//Vue.use(require('vue-resource'));


const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
//Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    
};
axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


import UserList from './components/admin/UserList.vue';
import ProductList from './components/admin/ProductList.vue';
import ImageInput from './components/admin/ImageInput.vue';
import ListaDeComunas from './components/admin/ListaDeComunas.vue';
import ListaDePedidos from './components/admin/ListaDePedidos.vue';
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('user-list', require('./components/admin/UserList.vue').default);
Vue.component('image-input', require('./components/admin/ImageInput.vue').default);
Vue.component('product-list', require('./components/admin/ProductList.vue').default);
Vue.component('lista-de-comunas', require('./components/admin/ListaDeComunas.vue').default);
Vue.component('lista-de-pedidos', require('./components/admin/ListaDePedidos.vue').default);

/**resources\js\components\admin\UserList.vue
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components:{
        // ImageInput
    },
    // template: '<product-list></product-list>'
});

var ctx = document.getElementById('myChart').getContext('2d');
    
    var Enero           = 0;
    var Febrero         = 0;
    var Marzo           = 0;
    var Abril           = 0;
    var Mayo            = 0;
    var Junio           = 0;
    var Julio           = 0;
    var Agosto          = 0;
    var Septiembre      = 0;
    var Octubre         = 0;
    var Noviembre       = 0;
    var Diciembre       = 0;
    var MontoEnero      = 0;
    var MontoFebrero    = 0;
    var MontoMarzo      = 0;
    var MontoAbril      = 0;
    var MontoMayo       = 0;
    var MontoJunio      = 0;
    var MontoJulio      = 0;
    var MontoAgosto     = 0;
    var MontoSeptiembre = 0;
    var MontoOctubre    = 0;
    var MontoNoviembre  = 0;
    var MontoDiciembre  = 0;

    
    axios.get('./../api/graficos').then(response=>{
        console.log(response.data.Junio)
        Enero           = response.data.Enero;
        Febrero         = response.data.Febrero;
        Marzo           = response.data.Marzo;
        Abril           = response.data.Abril;
        Mayo            = response.data.Mayo;
        Junio           = response.data.Junio;
        Julio           = response.data.Julio;
        Agosto          = response.data.Agosto;
        Septiembre      = response.data.Septiembre;
        Octubre         = response.data.Octubre;
        Noviembre       = response.data.Noviembre;
        Diciembre       = response.data.Diciembre;
        MontoEnero      = response.data.MontoEnero;
        MontoFebrero    = response.data.MontoFebrero;
        MontoMarzo      = response.data.MontoMarzo;
        MontoAbril      = response.data.MontoAbril;
        MontoMayo       = response.data.MontoMayo;
        MontoJunio      = response.data.MontoJunio;
        MontoJulio      = response.data.MontoJulio;
        MontoAgosto     = response.data.MontoAgosto;
        MontoSeptiembre = response.data.MontoSeptiembre;
        MontoOctubre    = response.data.MontoOctubre;
        MontoNoviembre  = response.data.MontoNoviembre;
        MontoDiciembre  = response.data.MontoDiciembre;
                })
    .then(
        
    )
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        datasets: [{
            label: '# de ventas por mes',
            // label2: '# of Votes',
            data: [Enero, Febrero, Marzo, Abril, Mayo, Junio,Julio, Agosto, Septiembre, Octubre, Noviembre, Diciembre],
            // data2: [MontoEnero, MontoFebrero, MontoMarzo, MontoAbril, MontoMayo, MontoJunio,MontoJulio, MontoAgosto, MontoSeptiembre, MontoOctubre, MontoNoviembre, MontoDiciembre],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
