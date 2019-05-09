<template lang="">
    <div>
        <input type='text' v-model="busqueda" @change="buscar(busqueda)" placeholder="Buscar..">
        <div class="table table-striped">
            <div class="row">
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Nombre</b></div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Teléfono</b></div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Zona</b></div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Comuna</b></div>
            </div>
            <div class="row" v-for="user in users" @click="modal(user)" data-toggle="modal" data-target="#myModal">
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">{{user.name}}</div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">{{user.celular}}</div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">{{user.zona}}</div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">{{user.direccion}}, {{user.comuna}}</div>
            </div>
        </div>
        <!-- Trigger the modal with a button -->

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>Nombre:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input type="text" v-model="user.name">
                    </div>
                </div>



            </div> <!-- Fin del modal body-->
            <div class="modal-footer">
            <button type="button" @click="update()" class="btn btn-info btn-lg" data-dismiss="modal">Guardar</button>
            </div>
            </div>

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
            users   : [],
            nombre  : '',
            rol     : '',
            user    : [],
            busqueda: '',
        }
    },
    created(){
        this.fetch()
    },
    methods: {
        fetch(){
            axios.get('./../api/usuarios').then(response=>{
                // console.log(response.data);
                this.users = response.data;
            })
        },
        buscar(busqueda){
            this.busqueda = busqueda
            console.log(this.busqueda)
        },
        modal(user){
            this.user = user;
            console.log(user);
        },
        update(){
            axios.post('./../api/usuarios/'+this.user.id,{
                
                'name'   : this.user.name,
                '_method': 'PATCH',
            }

            ).then(
            
            )
        }
    }
}
</script>
<style>
    div.row:nth-child(even) {
  background-color: #d3deff !important;
}
</style>