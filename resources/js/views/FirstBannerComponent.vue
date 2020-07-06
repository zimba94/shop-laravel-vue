<template>
       <!--banner-->
    <div class="banner">
        <div class="matter-banner">
            <div class="slider">
                <div class="callbacks_container">
                    <ul class="rslides" id="slider">
                        <li>
                            <img src="images/1.jpg" alt="">
                            <div class="tes animated wow fadeInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                <h2 style="font-size:128px;">Shop</h2>
                                <h3 style="font-size:64px;">Clothing</h3>
                            </div>
                        </li>
                        <li>
                            <img src="images/3.jpg" alt="">
                            <div class="tes animated wow fadeInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                <h2>MEN & WOMEN</h2>
                                <h3>Trousers & Chinos</h3>
                                <h4>UPTO 50%</h4>
                                <p>OFFER</p>
                            </div>
                        </li>
                        <li>
                            <img src="images/2.jpg" alt="">
                            <div class="tes animated wow fadeInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                <h2>MEN & WOMEN</h2>
                                <h3>Trousers & Chinos</h3>
                                <h4>UPTO 50%</h4>
                                <p>OFFER</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
