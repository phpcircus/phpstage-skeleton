<template>
    <div>
        <modal-component name="modal-name" width="80%" :max-width="1000" :adaptive="true" :delay="250" height="auto" class="text-center center" @before-open="beforeOpen($event)" />
    </div>
</template>

<script>
    export default {
        data () {
            return {
                //
            }
        },
        methods: {
            beforeOpen (event) {
            },
        }
    }
</script>
