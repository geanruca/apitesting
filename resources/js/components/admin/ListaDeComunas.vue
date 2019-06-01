<template lang="">
    <div>
        <div class="table table-striped">
            <div class="row">
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>nombre</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>cargo por producto</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>se cubre</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>dias de despacho</b></div>
            </div>
            <div class="row" v-for="comuna in comunas">
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{comuna.nombre}}</div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{comuna.cargo_por_producto}}</div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                    <span v-if="comuna.se_cubre==1"> Sí </span>
                    <span v-else> No </span>
                </div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{comuna.dias_de_despacho}}</div>
                 <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                    <a @click="eliminar(comuna)" class="btn btn-xs btn-danger"> Eliminar </a>  
                    <a @click="modal(comuna)" data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-primary"> Modificar </a>
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
                <h4 class="modal-title">Editar Comuna</h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>nombre:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="comuna.nombre">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>cargo_por_producto:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="comuna.cargo_por_producto">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>pedido_minimo:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="comuna.pedido_minimo">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>se_cubre:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="comuna.se_cubre">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>dias_de_despacho:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="comuna.dias_de_despacho">
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
            comunas           : [],
            nombre            : '',
            rol               : '',
            comuna            : [],
            busqueda          : '',
            nombre            : '',
            cargo_por_producto: '',
            pedido_minimo     : '',
            se_cubre          : '',
            dias_de_despacho  : '',
        }
    },
    created(){
        this.fetch()
    },
    methods: {
        fetch(){
            axios.get('./../api/comunas').then(response=>{
                // console.log(response.data);
                this.comunas = response.data;
            })
        },
        buscar(busqueda){
            this.busqueda = busqueda
            // console.log(this.busqueda)
        },
        modal(comuna){
            this.comuna = comuna;
            // console.log(comuna);
        },
        create(){
            // e.preventDefault();
            let settings = { headers: { 'cache-control'   : 'no-cache',
                'content-type'    : 'multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW',
                'Accept'          : 'application/json' } };
            // let imageURL = URL.createObjectURL(imageFile);
            // this.$emit('input', { formData, imageURL })
            var formData = new FormData();
            formData.append('nombre',this.nombre);
            formData.append('cargo_por_producto',this.cargo_por_producto);
            formData.append('pedido_minimo',this.pedido_minimo);
            formData.append('se_cubre',this.se_cubre);
            formData.append('dias_de_despacho',this.dias_de_despacho);
            axios.post('./../api/productos', formData)
            
            .then(response=>{
                this.nombre             = '';
                this.cargo_por_producto = '';
                this.pedido_minimo      = '';
                this.se_cubre           = '';
                this.dias_de_despacho   = '';
                miniToastr.success(response.msg, 'Comuna creada');
                this.fetch();
                },


            )
        },
        update(){
            axios.post('./../api/comunas/'+this.comuna.id,{
                
                'nombre'            : this.comuna.nombre,
                'cargo_por_producto': this.comuna.cargo_por_producto,
                'pedido_minimo'     : this.comuna.pedido_minimo,
                'se_cubre'          : this.comuna.se_cubre,
                'dias_de_despacho'  : this.comuna.dias_de_despacho,
                '_method'           : 'PATCH',
            }

            ).then(response=>{
                
                miniToastr.info(response.msg, 'Actualizado');
                this.fetch();
            }
            
            ).catch(error=>{
                if(error.response.status == 422){
                    miniToastr.error('No ingrese valores vacíos', 'Error');
                }else{
                    miniToastr.error(error, 'Error');
                }
                console.log(error)
                console.log(error.response.status)
            })
        },
        eliminar(comuna){
            // console.log(comuna);
            // console.log(comuna.id);
            if(confirm('Seguro que quiere eliminar el comuna?')){
                axios.delete('./../api/comunas/'+comuna.id,{
                    'id'        : comuna.id,
                    '_method'       : 'DELETE',
                }
    
                ).then(
                    this.comunas.splice(this.comunas.indexOf(comuna), 1),
                    // miniToastr.error(response.msg, 'Eliminado')
                ).catch((error)=>{
                    if(error.response.status == 500){
                        miniToastr.error('No puede eliminar un producto con pedidos asignados', 'Error');
                    }else{
                        miniToastr.error(error, 'Error');
                    }
                }
                )
            }
        },
    }
}
</script>
<style>
    div.row:nth-child(even) {
  background-color: #d3deff !important;
}
</style>