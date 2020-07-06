<template>
<div class="single">

<div class="container">
<div class="col-md-9">
	<div class="col-md-5 grid">		
		<img class="img-responsive" src="images/pr1.jpg" alt="" />
	</div>	
<div class="col-md-7 single-top-in">
						<div class="single-para simpleCart_shelfItem">
							<h2 v-text="product.slug"></h2>
							<p v-text="product.description"></p>
							<div class="star-on">
								<ul>
									<li><a href="#"><i class="glyphicon glyphicon-star"> </i></a></li>
									<li><a href="#"><i class="glyphicon glyphicon-star"> </i></a></li>
									<li><a href="#"><i class="glyphicon glyphicon-star"> </i></a></li>
									<li><a href="#"><i class="glyphicon glyphicon-star"> </i></a></li>
									<li><a href="#"><i class="glyphicon glyphicon-star"> </i></a></li>
								</ul>
								<div class="review">
									<a href="#"> 3 reviews </a>/
									<a href="#">  Write a review</a>
								</div>
							<div class="clearfix"> </div>
							</div>
							
								<label  class="add-to item_price" v-text="product.price">$</label>
							
							<div class="available">
								<h6>Available Options :</h6>
								<ul>
									
								<li>Size:<select>
									<option>Large</option>
									<option>Medium</option>
									<option>small</option>
									<option>Large</option>
									<option>small</option>
								</select></li>
								<li>Cost:
										<select>
										<option>U.S.Dollar</option>
										<option>Euro</option>
									</select></li>
							</ul>
						</div>
						</div>
					</div>
			<div class="clearfix"> </div>	
</div>
<!----->
<div class="col-md-3 product-bottom">
		</div>
		<div class="clearfix"> </div>
	</div>
	</div>
</template>

<script>
    export default {
		props: ['id'],
        data(){
			return {
				product : {}
			}
		},
		created() {			
				let me = this;
                axios.get('/api/product/'+this.id)
                .then(function (response) {
					// handle success
					console.log(response.data);
                    me.product = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
		}
    }
</script>
