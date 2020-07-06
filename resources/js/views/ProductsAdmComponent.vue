<template>
<main class="main">
<div class="products">
	<div class="container">
		<h2>Products</h2>
		<div class="col-md-9">
			<div class="card-header">
                <br>
                <button type="button"  @click="openModal('product','register')" class="btn btn-primary btn-lg">
                    <i class="icon-plus"></i>&nbsp;New
                </button>
            </div>
			<div class="content-top1">
				<div v-for="product in arrayProducts" :key="product.id" class="col-md-4 col-md4">
					<div class="col-md1 simpleCart_shelfItem">
						
						<router-link :to="{name:'single', params:{id: product.id}}">
							<img class="img-responsive" src="images/pr1.jpg" alt="" />
						</router-link>
							
						
						<h3><a v-text="product.name" href="single.html"></a></h3>
						<div class="price">
								<h5 v-text="product.price" class="item_price">$</h5>
								<a href="#" @click="openModal('product','update', product)" class="item_edit">Edit</a>
								<br>
                                <a href="#" @click="deleteUser(product.id)" class="item_delete">Delete</a>
								<div class="clearfix"> </div>
						</div>
					</div>
				</div>	
				<div class="clearfix"> </div>
			</div>
		</div>	
		<div class="col-md-3 product-bottom">
        <div class="clearfix"> </div>
		</div>
	</div>
</div>
<!--Inicio del modal agregar/update-->
 <div class="modal fade"  tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="titleModal"></h4>
                    <button type="button" class="close" @click="closeModal()" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Name</label>
                            <div class="col-md-9">
                                <input type="text" v-model="name" class="form-control" placeholder="Name">
                            </div>
                        </div>
						<div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Slug</label>
                            <div class="col-md-9">
                                <input type="text" v-model="slug" class="form-control" placeholder="Slug">
                            </div>
                        </div>
						<div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Description</label>
                            <div class="col-md-9">
                                <input type="text" v-model="description" class="form-control" placeholder="Description">
                            </div>
                        </div>
						<div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Price</label>
                            <div class="col-md-9">
                                <input type="number" v-model="price" class="form-control" placeholder="">
                            </div>
                        </div>
						<div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Status</label>
                            <div class="col-md-9">
                                <input type="number" v-model="status" class="form-control" placeholder="0/1">
                            </div>
                        </div>
                        <div v-show="error" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in msgError" :key="error" v-text="error">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="closeModal()">Close</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registerProduct()">Save</button>
                     <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="updateProduct()">Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
</main>
<!--//content-->
</template>

<script>
const Swal = require('sweetalert2');
    export default {
		data(){
			return {
				id              :   0,
				name			:	'',
				slug			:	'',
				price			:   0,
				description		:	'',
				status			:	1,
				arrayProducts	:	[],
				modal               : 0,
                titleModal         : "",
                tipoAccion          : 0,
                error               : 0,
                msgError            :[],
                pagination          : {
                    'total'             : 0, 
                    'current_page'      : 0,
                    'per_page'          : 0,
                    'last_page'         : 0,
                    'from'              : 0,
                    'to'                : 0
                },
                offset              : 9,
                buscar              :""
            
			}
		},
		computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
		methods : {
			listProducts(page, buscar){
                let me = this;
                const url = '/api/products?page='+page+'&buscar='+buscar;   
                axios.get(url)
                .then(function (response) {
                    // handle success
					//console.log("yes paps");
					//console.log(response);
                    //me.arrayProducts = response.data;
                    var respuesta= response.data;
                    me.arrayProducts = respuesta.products.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },
            cambiarPagina(page, buscar){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listProducts(page, buscar);
            },
            registerProduct(){
                
                if (this.validateProduct()) {
                    return;
                }

                let me = this;

                axios.post('/api/product/register',{
                    'name'              : me.name,
                    'slug'              : me.slug,
					'price'          	: me.price,
					'description'		: me.description,
					'status'			: me.status          
                }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.closeModal();
                    me.listProducts(1, "");
                }).catch(function (error) {
                    // handle error
                    console.log("aqui");
                    console.log(error);
                })
            },
            updateProduct(){

                if (this.validateProduct()) {
                    return;
                }

                let me = this;

                axios.put('/api/product/update',{
                    
					'id'             	: me.id,
					'name'				: me.name,
                    'slug'              : me.slug,
					'price'          	: me.price,
					'description'		: me.description,
					'status'			: me.status  
             
                }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.closeModal();
                    me.listProducts(1, "");
                }).catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            deleteUser(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Are you sure to delete this product?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/api/product/delete',{
                            'id': id,
                        }).then(function (response) {
                            // handle success   
                            me.listProducts(1, "");
                            swalWithBootstrapButtons.fire(
                                'Removed',
                                'The product has been successfully removed.',
                                'success'
                            )
                        }).catch(function (error) {
                            // handle error
                            console.log(error);
                        })

                       
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        //al cancelar
                    }
                    })
            },
            validateProduct(){
                this.error=0;
                this.msgError=[];
                if (!this.name) this.msgError.push("The name cannot be empty.");
                if (!this.price) this.msgError.push("The price cannot be empty.");
                if (!this.status) this.msgError.push("The status cannot be empty.");
                if(this.msgError.length) this.error = 1;
                return this.error;
            },
            closeModal(){
                this.modal              = 0;
                this.titleModal         = "";
                this.name               = "";
                this.slug               = "";
                this.tipoAccion         = 0;
                this.id                 = 0;
                this.price           	= 0;
				this.description        = "";
				this.status				= 1;
                this.error       		= 0;
            },
            openModal(model, accion, data=[]){
                switch (model) {
                    case "product":
                        {
                            switch (accion) {
                                case "register":
                                    {
                                        this.modal              = 1;
                                        this.titleModal        	= "Register Product";
                                        this.name             	= "";
                                        this.slug              	= "";
                                        this.description        = "";
										this.price		        = 0;
										this.status				= 1;
                                        this.tipoAccion         = 1;
                                    }
                                    break;
                                case "update":
                                    {
                                        this.modal              = 1;
                                        this.titleModal         = "Update Product";
                                        this.name               = data['name'];
                                        this.slug               = data['slug'];
                                        this.price              = data['price'];
                                        this.tipoAccion         = 2;
										this.id                 = data['id'];
										this.description		= data['description'],
										this.status				= data['status'] 
                                    }
                                    break;
                                default:
                                    break;
                            }
                        }
                        break;      
                    default:
                        break;
                }
            }
		},
        mounted() {
            this.listProducts(1, this.buscar);
        }
    }
</script>


<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>