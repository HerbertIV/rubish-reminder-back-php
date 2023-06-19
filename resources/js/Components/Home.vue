<template>
    <div class="container">
        <div class="row justify-content-center">

        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return {
            recipes: []
        }
    },

    mounted() {
        axios.defaults.headers.common['Content-type'] = "application/json";
        axios.defaults.headers.common['Accept'] = "application/json";


    }
}
</script>
