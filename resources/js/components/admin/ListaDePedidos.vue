<template lang="">
    <div>
        <!-- <tr>

            <div class="col-sm-5 col-xs-5 col-md-5 col-lg-5">
                <select class="form-control" :value="filtro_zona" @change="filtrar_zonas()">
                    <option disabled value="">Zona</option>
                    <option v-for="zona in zonas" >{{zona}}</option>
                </select>
            </div>

            <div class="col-sm-5 col-xs-5 col-md-5 col-lg-5">
                <select class="form-control" v-model="filtro_estado">
                    <option disabled value="">Estado de despacho</option>
                    <option v-for="estado in estados_de_despacho" >{{estado}}</option>
                </select>
            </div>

        </tr> -->

        <tr>
            <div class="col-sm-push-3 col-xs-push-3 col-md-push-2 col-lg-push-2 col-sm-5 col-xs-5 col-md-5 col-lg-5">
                <span> <b>Fecha:</b> </span>
            </div>
            <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                <input class="form-control" type="text" v-model="busqueda" @change="filteredResources(busqueda)"  placeholder="Buscar.."> 
            </div>
        </tr>


            
            
        <div class="table table-striped">
            <div class="row">
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Cliente</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>Pagado/
                    Entregado</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>Zona</b></div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Recepción</b></div>
                <div class="col-sm-1 col-xs-1 col-md-1 col-lg-1"><b>Pago</b></div>
            </div>
            <div class="row" v-for="pedido in filteredResources"  @click="modal(pedido)" data-toggle="modal" data-target="#myModal">
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">{{pedido.user_name}}</div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                    <span style="color: green;" v-if="pedido.estado_pago=='PAGADO'">Pagado:<i class="fa fa-check"></i> </span>
                    <span style="color: red;" v-else>Pagado:<i class="fa fa-times" aria-hidden="true"></i> </span> 
                    <span style="color: green;" v-if="pedido.estado_despacho=='ENTREGADO'">Entregado:<i class="fa fa-check"></i></span>
                    <span style="color: red;" v-else>Entregado:<i class="fa fa-times" aria-hidden="true"></i></span>
                </div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{pedido.user_zona}}</div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">{{pedido.fecha_recepcion}}</div>
                <div class="col-sm-1 col-xs-1 col-md-1 col-lg-1">${{pedido.total_pago}}
                    <span style="color: orange;" v-if="pedido.medio_de_pago=='REDCOMPRA'"><i class="far fa-credit-card"></i></span>
                    <span style="color: green;" v-else><i class="fas fa-money-bill-wave"></i></span>
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
                <h4 class="modal-title">Editar pedido <b>{{pedido.id_pedido}}</b></h4>
            </div>
            <div class="modal-body">
                
                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>nombre:</b></span></div><div class="col-xs-7 col-sm-7 col-md-7 col-lg-7"><input class="form-control" type="text" v-model="pedido.user_name"></div></div>
                <!-- <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>id_comuna_from_pedido</b></span></div><div class="col-xs-7 col-sm-7 col-md-7 col-lg-7"><input class="form-control" type="text" v-model="pedido.id_comuna_from_pedido"></div></div> -->
                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>Comuna:</b></span></div><div class="col-xs-7 col-sm-7 col-md-7 col-lg-7"><input class="form-control" type="text" v-model="pedido.nombre_comuna"></div></div>
                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>Dirección:</b></span></div><div class="col-xs-7 col-sm-7 col-md-7 col-lg-7"><input class="form-control" type="text" v-model="pedido.user_direccion"></div></div>
                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>Zona:</b></span></div><div class="col-xs-7 col-sm-7 col-md-7 col-lg-7"><input class="form-control" type="text" v-model="pedido.user_zona"></div></div>
                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>Descuento:</b></span></div><div class="col-xs-7 col-sm-7 col-md-7 col-lg-7"><input class="form-control" type="text" v-model="pedido.user_descuento"></div></div>
                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>Celular:</b></span></div><div class="col-xs-7 col-sm-7 col-md-7 col-lg-7"><input class="form-control" type="text" v-model="pedido.user_celular"></div></div>
                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>Email: </b></span></div><div class="col-xs-7 col-sm-7 col-md-7 col-lg-7"><input class="form-control" type="text" v-model="pedido.user_email"></div></div>

                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>PAGADO</b></span></div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                        <select class="form-control" v-model="pedido.estado_pago">
                            <option value="PAGADO">SI</option>
                            <option value="NOPAGADO">NO</option>
                        </select>
                    </div>
                </div>

                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>ENTREGADO</b></span></div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                        <select class="form-control" v-model="pedido.estado_despacho">
                            <!-- <option disabled value="">Entregado:</option> -->
                            <option value="ENTREGADO">SI</option>
                            <option value="NOENTREGADO">NO</option>
                        </select>
                    </div>
                </div>

                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>Medio de pago</b></span></div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                        <select class="form-control" v-model="pedido.medio_de_pago">
                            <!-- <option disabled value="">Entregado:</option> -->
                            <option value="REDCOMPRA">REDCOMPRA</option>
                            <option value="EFECTIVO">EFECTIVO</option>
                        </select>
                    </div>
                </div>



                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>total_pago</b></span></div><div class="col-xs-7 col-sm-7 col-md-7 col-lg-7"><input class="form-control" type="text" v-model="pedido.total_pago"></div></div>
                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>detalle_productos</b></span></div><div class="col-xs-7 col-sm-7 col-md-7 col-lg-7"><textarea class="form-control" type="text" v-model="pedido.detalle_productos"></textarea></div></div>
                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>recepcion inicio</b></span></div><div class="col-xs-7 col-sm-7 col-md-7 col-lg-7"><input class="form-control" type="text" v-model="pedido.horario_recepcion_inicio"></div></div>
                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>recepcion final</b></span></div><div class="col-xs-7 col-sm-7 col-md-7 col-lg-7"><input class="form-control" type="text" v-model="pedido.horario_recepcion_final"></div></div>
                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>fecha_recepcion</b></span></div><div class="col-xs-7 col-sm-7 col-md-7 col-lg-7"><input class="form-control" type="text" v-model="pedido.fecha_recepcion"></div></div>
                <div class="row"><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span><b>notas</b></span></div><div class="col-xs-7 col-sm-7 col-md-7 col-lg-7"><textarea class="form-control" type="text" v-model="pedido.notas"></textarea></div></div>
                



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
            pedidos                 : [],
            pedido                  : [],
            zonas                   : [],
            estados_de_despacho     : [],
            busqueda                : [],
            filtro_zona             : '',
            filtro_estado           : '',
        }
    },
    created(){
        this.fetch()
        // var date = new Date().toLocaleString("en-US",{timeZone: "America/Santiago"});
        // date = Date.parse(date)
        // date = new Date(date).toLocaleDateString()
        var tzoffset = (new Date()).getTimezoneOffset() * 60000; //offset in milliseconds
        var date = (new Date(Date.now() - tzoffset)).toISOString().slice(0, -1).split('T')[0];
        // .toISOString()
        
        this.busqueda = date
        // console.log(date);
    },
    computed: {
        filteredResources(){
            // fecha
            if(this.busqueda){
                return this.pedidos.filter((pedido)=>{
                    if(pedido.fecha_recepcion.includes(this.busqueda)){
                         return this.pedido
                    }
                })
            }else{
                return this.pedidos
            }
        },
        
    },
    methods: {
        fetch(){
            axios.get('./../api/vista_de_pedidos').then(response=>{
                // console.log(response.data.pedidos);
                // console.log(response.data.zonas);
                // console.log(response.data.estados_de_despacho);
                this.pedidos = response.data.pedidos;
                this.zonas = response.data.zonas;
                this.estados_de_despacho = response.data.estados_de_despacho;
            })
        },
        refill(){
            axios.get('./../api/vista_de_pedidos').then(response=>{
                this.pedidos = response.data.pedidos;
            })
        },
        filtrar_zonas(){
            this.refill();
            console.log(this.filtro_zona)
            for (let i = 0; i < this.pedidos.length; i++) {
                if(this.pedidos[i].user_zona =! this.filtro_zona){
                    this.pedidos.splice(this.pedidos.indexOf(pedidos[i]), 1)
                }
            }
            
        },
        modal(pedido){
            this.pedido = pedido;
            // console.log(pedido);
        },
        update(){
            axios.post('./../api/pedidos/'+this.pedido.id_pedido,{
                
                'cargo_por_producto'      : this.pedido.cargo_por_producto,
                'pedido_minimo'           : this.pedido.pedido_minimo,
                'se_cubre'                : this.pedido.se_cubre,
                'dias_de_despacho'        : this.pedido.dias_de_despacho,
                'id_pedido'               : this.pedido.id_pedido, 
                'id_usuario'              : this.pedido.id_usuario, 
                'id_conductor'            : this.pedido.id_conductor, 
                'id_comuna'               : this.pedido.id_comuna_from_pedido, 
                'nombre_comuna'           : this.pedido.nombre_comuna, 
                'user_direccion'          : this.pedido.user_direccion, 
                'user_zona'               : this.pedido.user_zona, 
                'user_descuento'          : this.pedido.user_descuento, 
                'user_celular'            : this.pedido.user_celular, 
                'user_email'              : this.pedido.user_email, 
                'user_name'               : this.pedido.user_name, 
                'estado_pago'             : this.pedido.estado_pago, 
                'estado_despacho'         : this.pedido.estado_despacho, 
                'medio_de_pago'           : this.pedido.medio_de_pago, 
                'total_pago'              : this.pedido.total_pago, 
                'detalle_productos'       : this.pedido.detalle_productos, 
                'horario_recepcion_inicio': this.pedido.horario_recepcion_inicio, 
                'horario_recepcion_final' : this.pedido.horario_recepcion_final, 
                'fecha_recepcion'         : this.pedido.fecha_recepcion, 
                'notas'                   : this.pedido.notas, 

                '_method'                 : 'PATCH',
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
        eliminar(pedido){
            // console.log(pedido);
            // console.log(pedido.id);
            if(confirm('Seguro que quiere eliminar el pedido?')){
                axios.delete('./../api/pedidos/'+pedido.id,{
                    'id'        : pedido.id,
                    '_method'       : 'DELETE',
                }
    
                ).then(
                    this.pedidos.splice(this.pedidos.indexOf(pedido), 1),
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