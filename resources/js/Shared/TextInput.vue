<template>
    <div>
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <input v-if="mask" :id="id" ref="input" v-mask="'#'" v-bind="$attrs" class="form-input" :class="{ error: errors.length }" :type="type" :value="value" @input="$emit('input', $event.target.value)">
        <input v-else :id="id" ref="input" v-bind="$attrs" class="form-input" :class="{ error: errors.length }" :type="type" :value="value" @input="$emit('input', $event.target.value)">
        <div v-if="errors.length" class="form-error">{{ errors[0] }}</div>
    </div>
</template>

<script>
import { mask } from 'vue-the-mask';

export default {
    directives: { mask },
    inheritAttrs: false,
    props: {
        id: {
            type: String,
            default () {
                return `text-input-${this._uid}`;
            },
        },
        type: {
            type: String,
            default: 'text',
        },
        value: String,
        label: String,
        mask: {
            type: Boolean,
            default: false,
        },
        errors: {
            type: Array,
            default: () => [],
        },
    },
    methods: {
        focus () {
            this.$refs.input.focus();
        },
        select () {
            this.$refs.input.select();
        },
        setSelectionRange (start, end) {
            this.$refs.input.setSelectionRange(start, end);
        },
    },
}
</script>
