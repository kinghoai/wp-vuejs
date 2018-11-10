<template>
  <div class="main_content container">
    <comma_header></comma_header>
      <router-view :key="$route.fullPath"></router-view>
    <comma_footer></comma_footer>
  </div>
</template>

<script>
    import Header from "./components/share/Header"
    import Footer from "./components/share/Footer"

    export default {
        components: {
            comma_header: Header,
            comma_footer: Footer
        },
        name: 'app',
    }
</script>