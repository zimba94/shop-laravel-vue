<template>
    <div class="container">
	<div class="register">
		<h2>Register</h2>
		  	  <form action="#" method="post">
				 <div class="col-md-6  register-top-grid">
					
					<div class="mation">
						<span>Name</span>
						<input v-model="name" type="text" >  
					 
						 <span>Email Address</span>
						 <input type="text" v-model="email"> 
					</div>
					 <div class="clearfix"> </div>
					   <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up</label>
					   </a>
					 </div>
				     <div class=" col-md-6 register-bottom-grid">
						   
							<div class="mation">
								<span>Password</span>
								<input type="password" v-model="password">
								<span>Confirm Password</span>
								<input type="password" v-model="password2">
							</div>
					 </div>
					 <div class="clearfix"> </div>
					 <div v-show="error"  class="wor-in div-error">
						  <div class="text-center text-error">
							  <div v-for="error in msgError" :key="error" v-text="error">
								
							  </div>
						  </div>
					  </div>
				</form>
				
				<div class="register-but">
				  <form action="#" method="post">
					  <router-link  :to="{name:'account'}">
						   <input @click="registerUser()" type="submit" value="submit">
					  </router-link>
					  
					   <div class="clearfix"> </div>
				   </form>
				</div>
		   </div>
</div>
</template>

<script>
    export default {
         data(){
			return {
				name			:	'',
				email			:	'',
				password		:	'',
				password2		:	'',
				error			:	0,
				msgError		:	[]
			}
		},
		methods : {
			
			registerUser(){
				if (this.validate()) {
					return;
				}
				let me = this;
                axios.post('/api/user/register',{
					'name' 		: me.name,
					'email'		: me.email,
					'password'	: me.password
				})
                .then(function (response) {
                    // handle success
					this.name  		= '';
					this.email 		= '';
					this.password	= '';
					this.password2	= '';
					alert("Registered user");
					//router.Push("account");
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

			},
			validate(){
                this.error=0;
                this.msgError=[];
                if (!this.name) this.msgError.push("The name cannot be empty.");
                if (!this.email) this.msgError.push("The email cannot be empty.");
				if (!this.password) this.msgError.push("The password cannot be empty.");
				if (!this.password2) this.msgError.push("The confirm password cannot be empty.");
                if(this.msgError.length) this.error = 1;
                return this.error;
            },
		},
        mounted() {
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