<template>
<div  class="container py-3" >
    <Header />
    
    
    <router-view/>
</div>
</template>


<script>

import Header from './components/Header.vue'

export default {
  name: 'Home',
  components: {
    Header
  }
}
</script>

<style>

</style>
