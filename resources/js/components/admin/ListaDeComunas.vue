<template lang="">
    <div>
        <div class="table table-striped">
            <div class="row">
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>nombre</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>cargo por producto</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>pedido minimo</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>se cubre</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>dias de despacho</b></div>
            </div>
            <div class="row" v-for="comuna in comunas" @click="modal(comuna)" data-toggle="modal" data-target="#myModal">
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{comuna.nombre}}</div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{comuna.cargo_por_producto}}</div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{comuna.pedido_minimo}}</div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                    <span v-if="comuna.se_cubre==1"> Sí </span>
                    <span v-else> No </span>
                </div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{comuna.dias_de_despacho}}</div>
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
export default {
    mounted(){
        console.log('componente montado con éxito')
    },
    data(){
        return{
            comunas   : [],
            nombre  : '',
            rol     : '',
            comuna    : [],
            busqueda: '',
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
            console.log(this.busqueda)
        },
        modal(comuna){
            this.comuna = comuna;
            console.log(comuna);
        },
        update(){
            axios.post('./../api/usuarios/'+this.comuna.id,{
                
                'nombre'            : this.comuna.nombre,
                'cargo_por_producto': this.comuna.cargo_por_producto,
                'pedido_minimo'     : this.comuna.pedido_minimo,
                'se_cubre'          : this.comuna.se_cubre,
                'dias_de_despacho'  : this.comuna.dias_de_despacho,
                '_method'           : 'PATCH',
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