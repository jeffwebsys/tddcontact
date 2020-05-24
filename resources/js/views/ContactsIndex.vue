<template>
<!-- props endpoint  -->
<ContactsList endpoint="/api/contacts" />

</template>

<script>

import ContactsList from '../components/ContactsList';


export default {

    name: "ContactsIndex",

    components: {

        ContactsList

    },


    
    //mounted for API request
   

}
</script>

<style>

</style>