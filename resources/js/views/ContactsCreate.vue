<template>
<div>
    <form @submit.prevent="submitForm()">
        <!-- InputField.Vue -->
     <InputField name="name" label="Contact Name" placeholder="Contact Name" :errors="errors" @update:field="form.name = $event"/>
     <InputField name="email" label="Contact Email" placeholder="Contact Email" :errors="errors" @update:field="form.email = $event"/>
     <InputField name="company" label="Company" placeholder="Company" :errors="errors" @update:field="form.company = $event"/>
     <InputField name="birthday" label="Birthday" placeholder="MM/DD/YYYY" :errors="errors" @update:field="form.birthday = $event"/>

     
     

    <!-- buttons -->
         <div class="flex justify-end">
             <button class="py-2 px-4 rounded text-red-700 border mr-5 hover:border-red-700">Cancel</button>
            <loadbtn />
         </div>
    </form>
</div>
    
</template>

<script>
// import InputField.vue 
// and add as component
import InputField from '../components/InputField';
import loadbtn from '../components/loadbtn';


export default {
    name: "ContactsCreate",

    components: {
        InputField,loadbtn
    },

    data: function (){

        return {
            //forms value
            form: {
                'name': '',
                'email': '',
                'company': '',
                'birthday': '',

            },
            errors: null, 
        }
    },

    methods: {
        //laravel api call through axios and laravel POST
        submitForm: function (){
            axios.post('/api/contacts', this.form)
            .then(response =>{
                this.$router.push(response.data.links.self);
                this.$swal('Success!','Contact Added','success','top-end');

            })
            .catch(errors => {
                //if has error
                this.errors =  errors.response.data.errors;
                this.$swal('Check inputs!','Failed','error','top-end');
            });
        }
    }
}
</script>

<style scoped>

</style>