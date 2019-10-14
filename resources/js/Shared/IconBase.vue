<template>
    <svg ref="svg" xmlns="http://www.w3.org/2000/svg" :class="appliedClasses" :width="width" :height="height" :viewBox="`0 0 ${view}`" :aria-labelledby="iconName" role="presentation">
        <title :id="iconName" lang="en">{{ iconName }} icon</title>
        <g fill-rule="evenodd"><slot /></g>
    </svg>
</template>

<script>
export default {
    props: {
        iconName: {
            type: String,
            default: 'box',
        },
        width: {
            type: [Number, String],
            default: 18,
        },
        height: {
            type: [Number, String],
            default: 18,
        },
        classes: {
            type: String,
            default: '',
        },
        dynamicClasses: {
            type: String,
            default: '',
        },
        iconFill: {
            type: String,
            default: '',
        },
        view: {
            type: String,
            default: '20 20',
        },
    },
    computed: {
        appliedClasses () {
            var classes;
            if (this.classes) {
                classes = this.classes;
            }
            if (this.dynamicClasses) {
                classes = `${classes} ${this.dynamicClasses}`;
            }
            if (this.iconFill) {
                classes = `${classes} ${this.iconFill}`;
            }

            return classes ? classes : '';
        },
    },
}
</script>
