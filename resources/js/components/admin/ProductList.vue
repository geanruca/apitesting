<template lang="">
    <div>

        <div class="row">
            <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">nombre</div>
            <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6"> <input class="form-control" type='text' v-model="nombre"></div>
        </div>
        <div class="row">
            <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">descripcion</div>
            <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6"> <input class="form-control" type='text' v-model="descripcion"></div>
        </div>
        <div class="row">
            <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">precio inicial</div>
            <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6"> <input class="form-control" type='text' v-model="precio_inicial"></div>
        </div>
        <div class="row">
            <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">Imagen</div>
            <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                <span class="btn btn-success btn-file">
                    Buscar imagen... <input type="file">
                </span> 
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6 col-sm-push-3 col-xs-push-3 col-md-push-3 col-lg-push-3" @click="create()"><button type="submit" class="btn btn-xs btn-primary form-control">Crear nuevo</button></div>
        </div>

        <br>
        <br>
        
        <div class="table table-striped">
            <div class="row">
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Nombre</b></div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Descripcion</b></div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Precio</b></div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Imagen</b></div>
            </div>
            <div class="row" v-for="producto in productos" @click="modal(producto)" data-toggle="modal" data-target="#myModal">
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">{{producto.nombre}}</div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">{{producto.descripcion}}</div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">{{producto.precio_inicial}}</div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">---</div>
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
                        <input type="text" v-model="producto.nombre">
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
            productos     : [],
            producto      : [],
            id            : '',
            nombre        : '',
            descripcion   : '',
            precio_inicial: '',
            img1          : '',
        }
    },
    created(){
        this.fetch()
    },
    methods: {
        fetch(){
            axios.get('./../api/productos').then(response=>{
                console.log(response.data);
                this.productos = response.data;
            })
        },
        modal(producto){
            this.producto = producto;
            console.log(producto);
        },
        update(){
            axios.post('./../api/productos/'+this.producto.id,{
                
                'nombre'   : this.producto.nombre,
                '_method': 'PATCH',
            }

            ).then(
                this.fetch(),
            )
        },
        create(){
            axios.post('./../api/productos',{
                
               
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