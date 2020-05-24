<template>
<button class="bg-blue-500 py-2 px-4 text-white rounded hover:bg-blue-400">Add</button>

</template>

<script>
import VueLoadingButton from 'vue-loading-button';

export default {

    name: "loadbtn",

    prop: [

        'loading'
    ]

}
</script>

<style>

</style>