<template lang="">
    <div>
        <div class="row">
            <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                <select v-model="filtro_zona" @change="FiltroPorZona()">
                    <option disabled value="">Zona</option>
                    <option v-for="zona in zonas" ></option>
                </select>
            </div>
                <input type="text" v-model="busqueda" @change="filteredResources(busqueda)" class="form-control" placeholder="Buscar usuario.."> 
            
            
        </div>
        <div class="table table-striped">
            <div class="row">
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>estado pago</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>estado despacho</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>medio de pago</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>total pago</b></div>
            </div>
            <div class="row" v-for="pedido in pedidos" @click="modal(pedido)" data-toggle="modal" data-target="#myModal">
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{pedido.estado_pago}}</div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{pedido.estado_despacho}}</div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{pedido.medio_de_pago}}</div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">${{pedido.total_pago}}</div>
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
                <h4 class="modal-title">Editar pedido</h4>
            </div>
            <div class="modal-body">
                
                <!-- <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>nombre:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="pedido.nombre">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>cargo_por_producto:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="pedido.cargo_por_producto">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>pedido_minimo:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="pedido.pedido_minimo">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>se_cubre:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="pedido.se_cubre">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>dias_de_despacho:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input class="form-control" type="text" v-model="pedido.dias_de_despacho">
                    </div>
                </div>
                 -->



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
            zonas                   : [],
            busqueda                : '',
            filtro_zona             : '',
            id_pedido               : '',
            id_usuario              : '',
            id_conductor            : '',
            id_comuna_from_pedido   : '',
            nombre_comuna           : '',
            user_direccion          : '',
            user_zona               : '',
            user_cargo              : '',
            user_descuento          : '',
            user_celular            : '',
            user_email              : '',
            user_name               : '',
            estado_pago             : '',
            estado_despacho         : '',
            medio_de_pago           : '',
            total_pago              : '',
            detalle_productos       : '',
            horario_recepcion_inicio: '',
            horario_recepcion_final : '',
            fecha_recepcion         : '',
        }
    },
    created(){
        this.fetch()
    },
    computed: {
        filtroPorZona (){
            if(this.busqueda){
            return this.pedidos.filter((pedido)=>{
                if(pedido.zona.toLowerCase().includes(this.busqueda.toLowerCase())){
                    return pedido.zona;
                }else{
                    return pedido.zona.toLowerCase().startsWith(this.busqueda.toLowerCase());
                }
            })
            }else{
                return this.pedidos;
            }
        },
        filtroPorFecha (){
            if(this.busqueda){
            return this.pedidos.filter((pedido)=>{
                if(pedido.fecha.toLowerCase().includes(this.busqueda.toLowerCase())){
                    return pedido.fecha;
                }else{
                    return pedido.fecha.toLowerCase().startsWith(this.busqueda.toLowerCase());
                }
            })
            }else{
                return this.pedidos;
            }
        },
        filtroPorEstado (){
            if(this.busqueda){
            return this.pedidos.filter((pedido)=>{
                if(pedido.estado_despacho.toLowerCase().includes(this.busqueda.toLowerCase())){
                    return pedido.estado_despacho;
                }else{
                    return pedido.estado_despacho.toLowerCase().startsWith(this.busqueda.toLowerCase());
                }
            })
            }else{
                return this.pedidos;
            }
        },
    },
    methods: {
        fetch(){
            axios.get('./../api/pedidos').then(response=>{
                console.log(response.data);
                this.pedidos = response.data;
            })
        },
        buscar(busqueda){
            this.busqueda = busqueda
            // console.log(this.busqueda)
        },
        modal(pedido){
            this.pedido = pedido;
            // console.log(pedido);
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
                miniToastr.success(response.msg, 'pedido creada');
                this.fetch();
                },


            )
        },
        update(){
            axios.post('./../api/pedidos/'+this.pedido.id,{
                
                'nombre'            : this.pedido.nombre,
                'cargo_por_producto': this.pedido.cargo_por_producto,
                'pedido_minimo'     : this.pedido.pedido_minimo,
                'se_cubre'          : this.pedido.se_cubre,
                'dias_de_despacho'  : this.pedido.dias_de_despacho,
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