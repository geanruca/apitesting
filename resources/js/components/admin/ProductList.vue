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
                    Buscar imagen... <input type="file" id="img1" name="img1"  v-on:change="onImageChange">
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
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>Nombre</b></div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3"><b>Descripcion</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>Precio</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>Imagen</b></div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2"><b>Acciones</b></div>
            </div>
            <div class="row" v-for="producto in productos" >
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{producto.nombre}}</div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">{{producto.descripcion}}</div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">{{producto.precio_inicial}}</div>
                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                    <img height='40' width='40' v-bind:src="producto.path1">
                </div>
                <div class="col-sm-3 col-xs-3 col-md-3 col-lg-3">
                    <a @click="eliminar(producto)" class="btn btn-xs btn-danger"> Eliminar </a>  
                    <a @click="modal(producto)" data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-primary"> Modificar </a>
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
                        <input type="text" v-model="producto.nombre">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>Descripción:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input type="text" v-model="producto.descripcion">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>Precio:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input type="text" v-model="producto.precio_inicial">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <b>Imagen:</b>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <img height='40' width='40' v-bind:src="producto.path1" class="responsive">
                    </div>
                    <div class="col-sm-6 col-xs-6 col-md-6 col-lg-6">
                        <span class="btn btn-success btn-file">
                            Cambiar imagen... <input  type="file" v-on:change="onImageChange">
                        </span> 
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
            productos     : [],
            producto      : [],
            id            : '',
            nombre        : '',
            descripcion   : '',
            precio_inicial: '',
            img1          : '',
            path1         : '',
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
        // props: {
        //     value: Object,
        // },
        create(){
            // e.preventDefault();
            let settings = { headers: { 'cache-control'   : 'no-cache',
                'content-type'    : 'multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW',
                'Accept'          : 'application/json' } };
            // let imageURL = URL.createObjectURL(imageFile);
            // this.$emit('input', { formData, imageURL })
            var formData = new FormData();
            formData.append('img1',this.img1);
            formData.append('nombre',this.nombre);
            formData.append('descripcion',this.descripcion);
            formData.append('precio_inicial',this.precio_inicial);
            axios.post('./../api/productos', formData)
            
            .then(response=>{

                this.fetch();
                }
            )
        },
        onImageChange(e){
                console.log(e.target.files[0]);
                this.img1 = e.target.files[0];
                // miniToastr.success('Imagen cambiada', 'title');
            },
        modal(producto){
            this.producto = producto;
            console.log(producto);
        },
        update(){
            // this.producto.img1=
            // console.log(this.producto.img1);
            // console.log(this.producto.id);
            var formData2 = new FormData();
            formData2.append('img1',this.img1);
            formData2.append('nombre',this.producto.nombre);
            formData2.append('descripcion',this.producto.descripcion);
            formData2.append('precio_inicial',this.producto.precio_inicial);
            formData2.append('_method', 'PATCH');
            axios.post('./../api/productos/'+this.producto.id, formData2)
            .then(response=>{
                
                miniToastr.success(response.msg, 'Actualizado')
            }, this.fetch()
            )
        },
        eliminar(producto){
            console.log(producto);
            console.log(producto.id);
            if(confirm('Seguro que quiere eliminar el producto?')){
                axios.delete('./../api/productos/'+producto.id,{
                    'id'        : producto.id,
                    '_method'       : 'DELETE',
                }
    
                ).then(
                    this.productos.splice(this.productos.indexOf(producto), 1)
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
.responsive {
  width: 100%;
  max-width: 150px;
  height: auto;
}
</style>