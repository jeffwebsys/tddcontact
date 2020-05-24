<template>
<button @click="showAlert">Hello world</button>
  
</template>

<script>
import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
const options = {
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,

  
};
 
// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';
 
Vue.use(VueSweetalert2, options);
export default {

    name: "alert",

    methods: {
    showAlert() {
      // Use sweetalert2
      this.$swal('Hello Vue world!!!');
    }
  },

}
</script>

<style>

</style>