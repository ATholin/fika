<template>
    <div class="sidebar">
        <button class="px-5 py-2 bg-indigo-500 hover:bg-indigo-600 shadow rounded-lg font-bold text-white transition-all hover:shadow-none duration-100" type="button" @click.prevent="toggleSidebar">
            Fika recipes
        </button>
        <transition
            enter-active-class="transition-all duration-75"
            leave-active-class="transition-all duration-75"
            enter-class="opacity-0"
            leave-to-class="opacity-0"
        >
            <div class="fixed z-40 inset-0 cursor-pointer bg-black opacity-50" @click="toggleSidebar" v-if="open"></div>
        </transition>
        <transition
            enter-active-class="transition-all duration-150"
            leave-active-class="transition-all duration-200"
            enter-class="transform -translate-x-full"
            enter-to-class="transform translate-x-0"
            leave-class="transform translate-x-0"
            leave-to-class="transform -translate-x-full"
        >
            <div v-if="open"
                 class="fixed z-50 left-0 top-0 h-screen bg-gray-300 flex flex-col"
            >
                <div class="flex-1 overflow-auto mb-12 px-6 py-2">
                    <div class="flex justify-end">
                        <button aria-label="Remove" @click="toggleSidebar" class="p-4">
                            <i class="fa fa-times text-red-500 hover:text-red-600"></i>
                        </button>
                    </div>

                    <slot></slot>
                </div>
                <div class="absolute bottom-0 left-0 right-0 bg-white px-4 py-2">
                    <slot name="footer"></slot>
                </div>

            </div>
        </transition>
    </div>
</template>
<script>
    export default {
        data: () => ({
            open: false
        }),
        methods: {
            toggleSidebar() {
                this.open = !this.open
            }
        }
    }
</script>
