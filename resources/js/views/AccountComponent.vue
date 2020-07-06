<template>
    <div class="account">
	<div class="container">
		<h2>Account</h2>
		<div class="account_grid">
			   <div class="col-md-6 login-right">
				<form  @submit.prevent="login">

					<span>Email Address</span>
					<input v-model="email"  type="text"> 
				
					<span>Password</span>
					<input v-model="password" type="password" name="password"> 
					<div class="word-in">
						 
				  		<a class="forgot" href="#">Forgot Your Password?</a>
				 		 <input type="submit" value="Login">
				  	</div>
					  <div v-show="error"  class="wor-in div-error">
						  <div class="text-center text-error">
							  <div v-for="error in msgError" :key="error" v-text="error">
								
							  </div>
						  </div>
					  </div>
			    </form>
			   </div>	
			   <div class="col-md-6 login-left">
			  	 <h4>NEW CUSTOMERS</h4>
				 <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
				 <router-link :to="{name:'register'}" class="account-btn">Create an Account</router-link>
			   </div>
			   <div class="clearfix"> </div>
			 </div>
	</div>
</div>
</template>

<script>

    export default {

       data: () => ({
			email: "",
			password: "",
			error: 0,
			msgError: []
  		}),
		methods: {
			login() {
				if (this.validate()) {
					return;
				}
				let me = this;
                axios.post('login',{
					'email'		: me.email,
					'password'	: me.password
				})
                .then(function (response) {
					// handle success
					console.log(response);
					this.email 		= '';
					this.password	= '';
					//router.Push("account");
                })
                .catch(function (error) {
					// handle error
					console.log("aqui paps");
                    console.log(error);
				});						
			},
			validate(){
                this.error=0;
                this.msgError=[];
                if (!this.email) this.msgError.push("The email cannot be empty.");
                if (!this.password) this.msgError.push("The password cannot be empty.");
                if(this.msgError.length) this.error = 1;
                return this.error;
            }
		}
	}
</script>

<style>
.div-error{
	display: flex;
	justify-content: center;
	margin: 25px;
}
.text-error{
	color: red !important;
	font-weight: bold;
}	
</style>