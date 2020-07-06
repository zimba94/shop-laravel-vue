<template>
	<main>
    <div class="container">
	<div class="check-out">
		<h2>Checkout</h2>
    	    <table >
		  <tr>
			<th>Item</th>
			<th>Qty</th>		
			<th>Prices</th>
			<th>Delivery details</th>
			<th>Sub total</th>
		  </tr>
		  <tr>
			<td class="ring-in"><a href="single.html" class="at-in"><img src="images/ce.jpg" class="img-responsive" alt=""></a>
			<div class="sed">
				<h5>Sed ut perspiciatis unde</h5>
				<p>(At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium) </p>
			
			</div>
			<div class="clearfix"> </div></td>
			<td class="check"><input type="text" value="1" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='';}"></td>		
			<td>$100.00</td>
			<td>FREE SHIPPING</td>
			<td>$100.00</td>
		  </tr>
		  <tr>
		  <td class="ring-in"><a href="single.html" class="at-in"><img src="images/ce1.jpg" class="img-responsive" alt=""></a>
			<div class="sed">
				<h5>Sed ut perspiciatis unde</h5>
				<p>(At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium ) </p>
			</div>
			<div class="clearfix"> </div></td>
			<td class="check"><input type="text" value="1" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='';}"></td>		
			<td>$200.00</td>
			<td>FREE SHIPPING</td>
			<td>$200.00</td>
		  </tr>
	</table>
	<a href="#" class=" to-buy"  @click="openModal(total)">PROCEED TO BUY</a>
	<div class="clearfix"> </div>
    </div>
	</div>
	 <!--Inicio del modal agregar/update-->
    <div class="modal fade"  tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Checkout</h4>
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
                            <label class="col-md-3 form-control-label" for="text-input">State</label>
                            <div class="col-md-9">
                                <input type="text" v-model="state" class="form-control" placeholder="State">
                            </div>
                        </div>
						<div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Country</label>
                            <div class="col-md-9">
                                <input type="text" v-model="country" class="form-control" placeholder="Country">
                            </div>
                        </div>
						<div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Credit Card Number</label>
                            <div class="col-md-9">
                                <input type="text" v-model="creditCardNumber" class="form-control" placeholder="0000 0000 0000 0000">
                            </div>
                        </div>
						<div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Credit Card Expiration</label>
                            <div class="col-md-9">
                                <input type="month" v-model="creditCardExpiration" class="form-control" placeholder="MM/YY">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">CVV</label>
                            <div class="col-md-9">
                                <input type="text" v-model="cvv" class="form-control" placeholder="XXX">
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
                    <button type="button" class="btn btn-success"  @click="validateModal()">Buy</button>
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
    export default {
		data(){
            return {
				name: "",
				address:"",
				state:"",
				country:"",
				creditCardNumber:"",
				creditCardExpiration:"",
				cvv:"",
                modal               : 0,
                error               : 0,
				msgError            :[],
				total				:300 //For this moment, it´s static		
            }
		},
		methods:{
            validateModal(){
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
                this.name             = "";
                this.address              = "";
                this.creditCardNumber           = "";
				this.creditCardExpiration           = "";
				this.cvv = "";
				this.country="";
				this.state="";
                this.error       = 0;
            },
            openModal(total){
                
				this.modal              = 1;
				this.name             = "";
                this.address              = "";
                this.creditCardNumber           = "";
				this.creditCardExpiration           = "";
				this.cvv = "";
				this.country="";
				this.state="";
				this.total 				= total
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
