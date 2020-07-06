<template>
<div class="products">
	<div class="container">
		<h2>Products</h2>
		<div class="col-md-9">
			<div class="content-top1">
				<div v-for="product in arrayProducts" :key="product.id" class="col-md-4 col-md4">
					<div class="col-md1 simpleCart_shelfItem">
						
						<router-link :to="{name:'single', params:{id: product.id}}">
							<img class="img-responsive" src="images/pr1.jpg" alt="" />
						</router-link>
							
						
						<h3><a v-text="product.name" href="single.html"></a></h3>
						<div class="price">
								<h5 v-text="product.price" class="item_price">$</h5>
								<a href="#" class="item_add">Add To Cart</a>
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
		<div class="clearfix"> </div>
	</div>
</div>

<!--//content-->
</template>

<script>
    export default {
		data(){
			return {
				name			:	'',
				slug			:	'',
				price			:   0,
				description		:	'',
				status			:	1,
				arrayProducts	:	[]
			}
		},
		methods : {
			listProducts(){
				let me = this;
                axios.get('/api/products')
                .then(function (response) {
                    // handle success
                    console.log(response);
                    me.arrayProducts = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

			}
		},
        mounted() {
            this.listProducts();
        }
    }
</script>
