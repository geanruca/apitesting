<template lang="pug">
    <div>
        <div class="table table-striped">
            <div class="row">
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Nombre</b></div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Teléfono</b></div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Zona</b></div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Comuna</b></div>
            </div>
            <div class="row" v-for="user in users">
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">{{user.name}}</div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">{{user.celular}}</div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">{{user.zona}}</div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">{{user.comuna}}</div>
            </div>

               
        </div>
    </div>
</template>
<script>
export default {
    mounted(){
        console.log('componente montado con éxito')
    },
    data(){
        return{
            users : [],
            nombre: '',
            rol: '',
        }
    },
    created(){
        this.fetch()
    },
    methods: {
        fetch(){
            axios.get('./../api/usuarios').then(response=>{
                console.log(response.data);
                this.users = response.data;
            })
        }
    },
}
</script>
<style>
    div.row:nth-child(even) {
  background-color: #d3deff !important;
}
</style>