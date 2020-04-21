<template>
    <div>
        <a href="#">
        <button class="btn btn-info btn-sm" v-text="text"><i class="fa fa-undo"></i> </button>
        </a>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        props: [
            'text'
        ]
    }
</script>
