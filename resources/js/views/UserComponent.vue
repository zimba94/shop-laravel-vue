<template>
    <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Users</a></li>
    </ol>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <br>
                <button type="button"  @click="openModal('user','register')" class="btn btn-primary btn-lg">
                    <i class="icon-plus"></i>&nbsp;New
                </button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Options</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in arrayUser" :key="user.id">
                            <td>
                                <button type="button" @click="openModal('user','update', user)" class="btn btn-warning btn-sm">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                    <button type="button" class="btn btn-danger btn-sm" @click="deleteUser(user.id)">
                                        <i class="icon-trash"></i>
                                    </button>
                            </td>
                            <td v-text="user.name"></td>
                            <td v-text="user.email"></td>
                        </tr>
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar)">Ant</a>
                        </li>
                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar)" v-text="page"></a>
                        </li>
                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar)">Sig</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
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
                            <label class="col-md-3 form-control-label" for="email-input">Email</label>
                            <div class="col-md-9">
                                <input type="email" v-model="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Password (*)</label>
                            <div class="col-md-9">
                                <input type="password" v-model="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Confirm Password (*)</label>
                            <div class="col-md-9">
                                <input type="password" v-model="password2" class="form-control" placeholder="Password">
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
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registerUser()">Save</button>
                     <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="updateUser()">Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->

</main>
</template>

<script>
const Swal = require('sweetalert2');
    export default {
        data(){
            return {
                id                  : 0,
                name                :"",
                email               :'',
                password            :'',
                password2           :'',
                idrol               : 0,
                arrayUser           :[],
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
                offset              : 5,
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
        methods:{
            listUser(page, buscar){
                let me = this;
                const url = '/api/users?page='+page+'&buscar='+buscar;   
                axios.get(url)
                .then(function (response) {
                    // handle success
                    //console.log(response);
                    //me.arrayUser = response.data;
                    var respuesta= response.data;
                    me.arrayUser = respuesta.users.data;
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
                me.listUser(page, buscar);
            },
            registerUser(){
                
                if (this.validateUser()) {
                    return;
                }

                let me = this;

                axios.post('/api/user/register',{
                    'name'              : me.name,
                    'email'             : me.email,
                    'password'          : me.password          
                }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.closeModal();
                    me.listUser(1, "");
                }).catch(function (error) {
                    // handle error
                    console.log("aqui");
                    console.log(error);
                })
            },
            updateUser(){

                if (this.validateUser()) {
                    return;
                }

                let me = this;

                axios.put('/api/user/update',{
                    
                    'id'             : me.id,
                    'name'           : me.name,
                    'email'          : me.email,
                    'password'       : me.password,
             
                }).then(function (response) {
                    // handle success
                    //console.log(response);
                    me.closeModal();
                    me.listUser(1, "");
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
                    title: 'Are you sure to delete this user?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/api/user/delete',{
                            'id': id,
                        }).then(function (response) {
                            // handle success   
                            me.listUser(1, "");
                            swalWithBootstrapButtons.fire(
                                'Removed',
                                'The user has been successfully removed.',
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
            validateUser(){
                this.error=0;
                this.msgError=[];
                if (!this.name) this.msgError.push("The name cannot be empty.");
                if (!this.email) this.msgError.push("The email cannot be empty.");
                if (!this.password) this.msgError.push("The password cannot be empty.");
                if (!this.password2) this.msgError.push("The password confirm cannot be empty..");
                if (this.password != this.password2) this.msgError.push("Passwords do not match");
                if(this.msgError.length) this.error = 1;
                return this.error;
            },
            closeModal(){
                this.modal              = 0;
                this.titleModal        = "";
                this.name             = "";
                this.email              = "";
                this.tipoAccion         = 0;
                this.id                  = 0;
                this.password           = "";
                this.password2           = "";
                this.error       = 0;
            },
            openModal(model, accion, data=[]){
                switch (model) {
                    case "user":
                        {
                            switch (accion) {
                                case "register":
                                    {
                                        this.modal              = 1;
                                        this.titleModal        = "Register User";
                                        this.name             = "";
                                        this.email              = "";
                                        this.password           = "";
                                        this.password2           = "";
                                        this.tipoAccion         = 1;
                                    }
                                    break;
                                case "update":
                                    {
                                        this.modal              = 1;
                                        this.titleModal        = "Update Client";
                                        this.name             = data['name'];
                                        this.email              = data['email'];
                                        this.password           = data['password'];
                                        this.tipoAccion         = 2;
                                        this.id                 = data['id']; 
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
            this.listUser(1, this.buscar);
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