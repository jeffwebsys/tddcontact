<template>
     <div class="relative pb-4">
            <label :for="name" class=" text-blue-500 pt-2 uppercase text-xs font-bold absolute">{{ label }}</label>
            <input :id="name" type="text" class="pt-8 w-full text-gray-900 border-b pb-2 focus:outline-none focus:border-blue-400" :class="errorClassObject()" :placeholder="placeholder" v-model="value" @input="updateField()">
       <p class="text-red-600 text-sm" v-text="errorMessage()">Error Here</p>
        </div>
</template> 

<script>
//add props name, label, placeholder
export default {
    //name of the component
    name: "InputField",
    //props form values for the ContactsCreate
    props: [

        'name', 'label','placeholder' ,'errors'
    ],

    data: function (){
        return {

            value: ''
        }

    },
    
    //like a private function for hasError
    computed: {

        hasError: function (){

            return this.errors && this.errors[this.name] && this.errors[this.name].length > 0;
        }

    },
    //methods for the inputvue
    methods: {

//optional field parameter can be added as instance
//function (field)
        updateField: function (){

            this.clearErrors(this.name);
            this.$emit('update:field', this.value)
        },

        errorMessage: function () {
            if(this.hasError){
                return this.errors[this.name][0];
            }

        },

        clearErrors: function () {
            if(this.hasError){
               this.errors[this.name] = null;
            }
        },

        errorClassObject: function (){
            return {
                'error-field': this.hasError
            }
        }
    }
    
}
</script>

<style scoped>
        .error-field {

            @apply .border-red-500 .border-b-2
        }
</style>