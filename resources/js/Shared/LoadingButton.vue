<template>
    <button :disabled="loading" class="flex items-center bg-indigo-600 hover:bg-indigo-500 px-6 py-3 rounded text-white">
        <div v-if="loading" class="btn-spinner mr-2" />
        <slot />
    </button>
</template>
<script>
export default {
    props: {
        loading: Boolean,
    },
};

</script>
