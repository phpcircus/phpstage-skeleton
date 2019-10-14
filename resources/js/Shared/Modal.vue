<template>
    <div>
        <modal-component name="dialogModal" width="80%" :max-width="400" :adaptive="true" :delay="250" height="auto" class="text-center center" @before-open="beforeOpenDialog($event)">
            <dialog-modal :title="dialog.title" :text="dialog.text" :buttons="dialog.buttons" />
        </modal-component>
    </div>
</template>

<script>
import DialogModal from '@/Modals/DialogModal';

export default {
    components: {
        DialogModal,
    },
    data () {
        return {
            dialog: {
                title: null,
                text: null,
                buttons: [],
            },
        }
    },
    methods: {
        beforeOpenDialog (event) {
            this.dialog.title = event.params.title;
            this.dialog.text = event.params.text;
            this.dialog.buttons = event.params.buttons;
        },
    },
}
</script>
