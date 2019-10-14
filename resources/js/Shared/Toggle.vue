<template>
    <button class="flex btn shadow-md rounded-full px-3 py-2 text-white text-sm hover:bg-orange-500" :class="buttonClasses" type="button" @click="buttonClicked()">
        <div v-if="sending" class="spinner mr-2" />
        <icon-base v-if="value" :height="14" :width="14" icon-fill="fill-white" icon-name="checkmark" classes="mr-2">
            <checkmark />
        </icon-base>
        <icon-base v-else view="24 24" icon-fill="fill-white" icon-name="close" classes="mr-2">
            <close />
        </icon-base>
        {{ buttonText }}
    </button>
</template>

<script>
import Close from '@/Shared/Icons/Close';
import IconBase from '@/Shared/IconBase';
import Checkmark from '@/Shared/Icons/Checkmark';

export default {
    components: {
        Close,
        IconBase,
        Checkmark,
    },
    props: {
        onText: {
            type: String,
            default: () => 'On',
        },
        offText: {
            type: String,
            default: () => 'Off',
        },
        value: {
            type: Boolean,
            default: () => false,
        },
        sending: {
            type: Boolean,
            default: () => false,
        },
    },
    computed: {
        buttonText () {
            return this.value ? this.onText : this.offText;
        },
        buttonClasses () {
            return this.value ? 'bg-green-500' : 'bg-red-500';
        },
        checked () {
            return true;
        },
    },
    methods: {
        buttonClicked () {
            this.$emit('clicked');
        },
    },
}
</script>
