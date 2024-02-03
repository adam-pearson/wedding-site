<template>
    <header id="home" class="flex items-center justify-center h-screen hero-image">
        <div>
            <div>
                <div class="col-md-12 text-center caption">
                    <h5>The wedding of</h5>
                    <h1>Heather & Adam</h1>
                    <h5>2nd October, 2024</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="arrow bounce text-center">
                        <a href="index.html#couple"> <i class="ti-heart"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>

</script>

<style scoped lang="postcss">
.hero-image {
    background-image: url(/resources/assets/heroImage.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-position-x: 50%;
    overflow:hidden;
}

header .caption h1 {
    font-family: 'Alex Brush', cursive;
    font-weight: 400;
    margin: 0 0 15px 0;
    font-size: 120px;
    color: #FFF;
    display: block;
    line-height: 1em;
    position: relative;
}

header .caption h5 {
    @apply font-sans;
     font-size: 20px;
     font-weight: 400;
     letter-spacing: 5px;
     margin-bottom: 0;
     color: #fff;
     text-transform: uppercase;
 }

 .header .arrow {
    position: relative;
    top: 27vh;
    width: 100%;
    text-align: center;
    z-index: 8;
}
.header .arrow.bounce {
    -webkit-animation: bounce 2s infinite;
    animation: bounce 2s infinite;
}
.header .arrow i {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    color: #fff;
    font-size: 20px;
}
.header .arrow i:hover:after {
    -webkit-transform: scale(1.2);
    transform: scale(1.2);
    opacity: 0;
    -webkit-transition: all .5s;
    transition: all .5s;
}
</style>