<template>
    <div class="container">
    <!--header-->
    <div class="header">
        <div class="header-top">
            <div class="container">
                <div class="col-sm-4 logo animated wow fadeInLeft" data-wow-delay=".5s">
                    <h1>Admin - <span v-text="name"></span></h1>
                    
                    
                </div>
                <div class="col-sm-4 world animated wow fadeInRight" data-wow-delay=".5s">
                    <div class="cart box_1">
                        <a href="#">
                            <h3>
                                <div class="total">
                                    <span class="simpleCart_total"></span></div>
                                <img src="images/logout.jpg" style="width:20px;height:20;" ></h3>
                        </a>
                        <p><a @click="logout()" class="btn">Logout</a></p>

                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <!-- {{-- menu --}} -->
        <div class="container">
            <div class="head-top">
                <div class="n-avigation">
        
                    <nav class="navbar nav_bottom" role="navigation">
        
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header nav_2">
                            <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                            <a class="navbar-brand" href="#"></a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                            <ul class="nav navbar-nav nav_1">
                                <li>
                                    <router-link :to="{name:'users'}">Users</router-link>
                                </li>
                                <li>
                                    <router-link :to="{name:'productsAdm'}">Products</router-link>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
        
                    </nav>
                </div>
        
                <div class="clearfix"> </div>
                <div id="small-dialog" class="mfp-hide">
                    <div class="search-top">
                        <div class="login">
                            <form action="#" method="post">
                                <input type="submit" value="">
                                <input type="text" name="search" value="Type something..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
        
                            </form>
                        </div>
                        <p> Shopping</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- {{-- end-menu --}} -->
    </div>
    <!-- {{-- Content --} -->
    <transition name="slide-fade" mode ="out-in">
        <router-view></router-view>
    </transition>
    <!-- {{--End-Content --}} -->
    </div>
</template>
<script>
    let user = document.head.querySelector('meta[name="user"]');
    
    export default {
        data: () => ({
			name : JSON.parse(user.content).name,
			password: "",
			error: 0,
			msgError: []
          }),
          methods:{
            logout(){
                window.location.href = '/';
            }
        },
        computed: {
            user(){
                return console.log(JSON.parse(user.content));
            }
        },        
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
