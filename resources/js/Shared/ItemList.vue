<template>
    <div class="bg-white rounded shadow overflow-x-auto mb-8">
        <table class="w-full whitespace-no-wrap">
            <tr class="text-left font-bold">
                <th v-for="field in headerFields" :key="field.name" class="px-6 pt-6 pb-4">{{ field.label }}</th>
            </tr>
            <tr v-for="item in data" :key="item.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                <td v-for="field in headerFields" :key="field.name" class="border-t">
                    <inertia-link class="px-6 py-4 flex items-center focus:text-blue-500" :href="route(`${entityName}.${rowAction}`, item.id)">
                        {{ item[field.name] }}
                        <icon v-if="item.deleted_at" name="trash" class="flex-no-shrink w-3 h-3 fill-gray-500 ml-2" />
                    </inertia-link>
                </td>
                <td class="border-t w-px">
                    <inertia-link class="px-4 flex items-center" :href="route(`${entityName}.${rowAction}`, item.id)" tabindex="-1">
                        <icon name="cheveron-right" class="block w-6 h-6 fill-gray-500" />
                    </inertia-link>
                </td>
            </tr>
            <tr v-if="data.length === 0">
                <td class="border-t px-6 py-4" colspan="4">{{ notFoundMessage }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
import Icon from '@/Shared/Icon';

export default {
    components: { Icon },
    props: {
        headerFields: {
            type: Array,
            default: () => [],
        },
        data: {
            type: Array,
            default: () => [],
        },
        sortField: {
            type: String,
            default: () => '',
        },
        sort: {
            type: String,
            default: () => 'asc',
        },
        entityName: {
            type: String,
            default: () => '',
        },
        rowAction: {
            type: String,
            default: () => 'show',
        },
        notFoundMessage: {
            type: String,
            default: () => 'No items found.',
        },
    },
}
</script>
