import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
const options = {
  toast: true,
  position: 'top-end',
  showConfirmButton: true,
  timer: 3000,
  timerProgressBar: false,

  
};
 
// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';
 
Vue.use(VueSweetalert2, options);
export default {

   
}
