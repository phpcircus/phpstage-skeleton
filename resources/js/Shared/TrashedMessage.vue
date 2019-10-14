<template>
    <div class="p-4 bg-yellow-300 rounded border border-yellow-700 flex items-center justify-between">
        <div class="flex items-center">
            <icon-base icon-fill="fill-yellow-800" classes="mr-2 flex-no-shrink">
                <trash />
            </icon-base>
            <div class="text-yellow-800">
                <slot />
            </div>
        </div>
        <button class="text-yellow-800 hover:underline" tabindex="-1" type="button" @click="$emit('restore')">Restore</button>
    </div>
</template>

<script>
import Trash from '@/Shared/Icons/Trash';
import IconBase from '@/Shared/IconBase';

export default {
    components: {
        Trash,
        IconBase,
    },
}
</script>
