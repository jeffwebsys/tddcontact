<template>
  <div>
    <div v-if="loading">Please wait..</div>
    <div v-else>
        <div v-if="contacts.length === 0">
            <p>No contacts yet <router-link to="/contacts/create" class=" px-4 py-2 bg-gray-900 rounded text-sm font-bold text-white">Create</router-link></p>
        </div>
       <div v-for="contact in contacts">
          <router-link :to="'/contacts/' + contact.data.contact_id" class="flex items-center border-b border-gray-400 p-4 hover:bg-gray-100">

               <UserCircle :name="contact.data.name" />

           <div class="pl-4">
               <p class="text-blue-400 font-bold"> {{contact.data.name}} </p>
               <p class="text-gray-600"> {{contact.data.company}} </p>

           </div>

          </router-link>
    </div>

    </div>
</div>
  
</template>

<script>
import UserCircle from './UserCircle';

export default {

    name: "BirthdaysList",
    // props endpoint to accomodate the API request to ContactsIndex

    props: [

        'endpoint'
    ],


    components: {
        UserCircle
    },
     mounted() {

        axios.get(this.endpoint)
        .then(response => {
            //if data is loaded
            this.contacts = response.data.data;
            //if data is initiated then hide the loading state
            this.loading = false;

        })
        .catch(error => {
            this.loading = false;
            alert('Unable to fetch Contact');

        });

    },
    
    //data for variables
    data: function (){
        return {
            //initiate at loading state
            // mounted variables
            loading: true,
            contacts: null,
        }
    }


}
</script>

<style>

</style>