<template>
<!-- props endpoint  -->
<BirthdaysList endpoint="/api/birthdays" />

</template>

<script>

import BirthdaysList from '../components/BirthdaysList';


export default {

    name: "ContactsIndex",

    components: {

        BirthdaysList

    },


    
    //mounted for API request
   

}
</script>

<style>

</style>