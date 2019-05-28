<template>
    <div>
        <flash-message />
        <slot />
    </div>
</template>

<script>
import FlashMessage from '@/Shared/FlashMessage';

export default {
    components: { FlashMessage },
}
</script>
