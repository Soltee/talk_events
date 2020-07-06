<template>
    <div>
        <div class="flex flex-col">
            <div class="flex flex-col" @click="hideDropdownMenus">
    <div class="md:flex flex-shrink-0">
        <div class="bg-indigo-900 md:flex-shrink-0 md:w-56 px-6 py-4 flex items-center justify-between md:justify-center">
            <inertia-link class="mt-1" href="/">
                <logo class="fill-white" width="10" height="10" />
            </inertia-link>
        </div>
        <div class="bg-white border-b w-full p-4 md:py-0 md:px-12 text-sm md:text-md flex justify-between items-center">
        </div>
    </div>
</div>

        </div>
    </div>
</template>
<script>
// import FlashMessages from '../FlashMessages'
import Logo from './Logo'
export default {
    components: {
        // FlashMessages,
        Logo,
    },
    data() {
        return {
            showUserMenu: false,
            accounts: null,
        }
    },
    methods: {
        url() {
            return location.pathname.substr(1)
        },
        hideDropdownMenus() {
            this.showUserMenu = false
        },
    },
};

</script>
