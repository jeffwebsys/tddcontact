<template>
  <div class="flex items-center pt-3">
      <div class="text-gray-900 font-mono pr-3 text-xs">Switch Theme</div>
   
        <toggle-button :value="togglebtn()"
               :labels="{checked: 'On', unchecked: 'Off'}" :color="{checked: '#44972b', unchecked: '#7f7f7f'}" :width="50" />

              
              
     
    </div>
</template>

<script>
import Vue from 'vue';
import ToggleButton from 'vue-js-toggle-button';
import alert from './alert';
 
Vue.use(ToggleButton);


export default {

    name: "toggle",

//    data: function (){
//          return {

//             value: ''
//         }

//    },

    methods: { 

        togglebtn: function() {
           

         return false;

        },
        showAlert: function() {
      // Use sweetalert2
      this.$swal('Hello Vue world!!!');
    }
    }, 
    
    components: {
        alert
    }
    }
  
</script>

<style>

</style>