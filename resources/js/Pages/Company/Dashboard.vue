<template>
    <div class="">
        <!-- <Layout></Layout> -->
        <div class="bg-white rounded shadow">
            <table class="w-full whitespace-no-wrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">Name</th>
                </tr>
                <tr v-for="event in events" :id="event.id" class="text-left font-semibold text-sm">
                    <td class="px-6 py-3">{{ event.name }}</td>
                </tr>
            </table>
            <div class="flex justify-between items-center">
            </div>
        </div>
    </div>
</template>
<script>
import Layout from '../../Shared/Layout'
export default {
    metaInfo: { title: 'Dashboard' },
    // layout: Layout,
    components: {
        Layout
    },
    props: {
        events: Array,
        prev: String,
        next: String
    },
};

</script>
