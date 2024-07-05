<template>
    <Header />
    <router-view></router-view>
    <!-- <h1>DEFAULT LAYOUT</h1> -->
    <Footer />
</template>

<script>
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';
export default {
    components: {
        Header,
        Footer
    }
}
</script>
