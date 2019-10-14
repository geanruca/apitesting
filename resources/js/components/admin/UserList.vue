<template lang="">
    <div>
        <div><input type="text" v-model="busqueda" @change="filteredResources(busqueda)" class="form-control" placeholder="Buscar usuario.."> </div>
        <div class="table table-striped">
            <div class="row">
                <div class="col-sm-1 col-xs-1 col-md-1 col-lg-1"><b>ID</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>Nombre</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>Teléfono</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>Zona</b></div>
                <!-- <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>Dirección</b></div> -->
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>Cargo</b></div>
            </div>
            <div class="row" v-for="user in filteredResources" @click="modal(user)" data-toggle="modal" data-target="#myModal">
                <div class="col-sm-1 col-xs-1 col-md-1 col-lg-1">{{user.id}}</div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{user.name}}</div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{user.celular}}</div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{user.zona}}</div>
                <!-- <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{user.direccion}}, {{user.comuna}}</div> -->

                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                    <span v-if="user.role_id==1">Administrador </span>
                    <span v-if="user.role_id==2">Moderador </span>
                    <span v-if="user.role_id==3">Conductor </span>
                    <span v-if="user.role_id==4">Cliente </span>
                </div>

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
                <h4 class="modal-title">Editar Usuario</h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>Nombre:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="user.name">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>Teléfono:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="user.celular">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>Zona:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="user.zona">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>Direccion:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="user.direccion">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>Comuna:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="user.comuna">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>Descuento personal al total:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="user.descuento">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>Notas:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="user.notas">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>Rol:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <select class="form-control" v-model="user.role_id">
                            <option value="1">ADMIN</option>
                            <option value="2">MODERADOR</option>
                            <option value="3">CONDUCTOR</option>
                            <option value="4">CLIENTE</option>
                        </select>
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
import miniToastr from 'mini-toastr';
miniToastr.init();

export default {
    mounted(){
        console.log('componente montado con éxito')
    },
    data(){
        return{
            users   : [],
            nombre  : '',
            role_id : '',
            user    : [],
            busqueda: '',
        }
    },
    created(){
        this.fetch()
    },
    computed: {
        filteredResources (){
            if(this.busqueda){
            return this.users.filter((user)=>{
                if(user.name.toLowerCase().includes(this.busqueda.toLowerCase())){
                    return user.name;
                }else{
                    return user.name.toLowerCase().startsWith(this.busqueda.toLowerCase());
                }
            })
            }else{
                return this.users;
            }
        }
    },
    
    methods: {
        fetch(){
            axios.get('./../api/usuarios').then(response=>{
                // console.log(response.data);
                this.users = response.data;
                // filteredResources(this.users);
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
                
                'name'     : this.user.name,
                'celular'  : this.user.celular,
                'zona'     : this.user.zona,
                'direccion': this.user.direccion,
                'comuna'   : this.user.comuna,
                'notas'    : this.user.notas,
                'descuento': this.user.descuento,
                'role_id'  : this.user.role_id,
                '_method'  : 'PATCH',
            }

            ).then(response=>{

                miniToastr.success(response.msg, 'Todo bien');
            }
            )
            .catch(error=>{
                if(error.response.status == 422){
                    miniToastr.error('No ingrese valores vacíos', 'Error');
                }else{
                    miniToastr.error(error, 'Error');
                }
                console.log(error)
                console.log(error.response.status)
            })
        }
    }
}
</script>
<style>
    div.row:nth-child(even) {
  background-color: #d3deff !important;
}
</style>