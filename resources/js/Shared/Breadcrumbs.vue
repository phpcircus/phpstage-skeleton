<template>
    <ol v-if="$page.breadcrumbs" class="breadcrumb">
        <li v-for="crumb in breadcrumbTrail" :key="crumb.title" class="breadcrumb-item"><inertia-link :href="crumb.url">{{ crumb.title }}</inertia-link></li>
        <li class="breadcrumb-item active">{{ breadcrumbCurrent.title }}</li>
    </ol>
</template>

<script>
export default {
    computed: {
        breadcrumbTrail () {
            return this.$page.breadcrumbs ? this.$page.breadcrumbs.slice(0, -1): null;
        },
        breadcrumbCurrent () {
            return this.$page.breadcrumbs ? this.$page.breadcrumbs[this.$page.breadcrumbs.length -1] : null;
        },
    },
}
</script>
