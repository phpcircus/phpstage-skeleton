import Checkbox from '@/Components/Checkbox';

export default {
    props: {
        label: {
            type: String,
            default: () => 'Checkbox',
        },
        checked: {
            type: Boolean,
            default: () => false,
        },
        height: {
            type: Number,
            default: () => 6,
        },
        width: {
            type: Number,
            default: () => 6,
        },
        errors: {
            type: Array,
            default: () => [],
        },
    },

    render (h) {
        return h('div', {
            on: {
                change: event => this.$emit('input', event.target.checked),
              },
            domProps: {
                innerHTML: this.setInnerHTML(),
                checked: this.checked,
            },
        });
    },
    methods: {
        setInnerHTML () {
            let checkbox = new Checkbox(this.checked)
                .addLabel(this.label)
                .setWidth(this.width)
                .setHeight(this.height);

            if (this.errors.length) {
                checkbox.setErrors(this.errors);
            }

            return checkbox.buildHTML();
        },
    },
};
