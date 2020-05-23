<template>
<!--    <div v-if="show">-->
<!--        <transition-->
<!--            enter-active-class="transition-all duration-75"-->
<!--            leave-active-class="transition-all duration-75"-->
<!--            enter-class="opacity-0"-->
<!--            leave-to-class="opacity-0"-->
<!--        >-->
<!--            <div class="transform fixed z-40 inset-0 cursor-pointer bg-black opacity-50" @click="close"></div>-->
<!--        </transition>-->
<!--        <transition-->
<!--            enter-active-class="transition-all duration-75"-->
<!--            leave-active-class="transition-all duration-75"-->
<!--            enter-class="opacity-0 scale-90 skew-x-3"-->
<!--            enter-to-class="opacity-100 scale-100 skew-x-0"-->
<!--            leave-class="opacity-100 scale-100 skew-x-0"-->
<!--            leave-to-class="opacity-0 scale-90 skew-x-3"-->
<!--        >-->
<!--            <div class="transform absolute left-0 right-0 bg-white z-50 max-w-3xl w-full mx-auto">-->
<!--                asd-->
<!--                <slot></slot>-->
<!--            </div>-->
<!--        </transition>-->
<!--    </div>-->
    <div>

        <button @click="show" class="flex px-2 py-1 items-center text-sm font-medium transition-colors duration-200 text-gray-500 hover:text-gray-700">
            <i class="mr-2 fa fa-share"></i>
            Share this
        </button>

        <div v-if="open" class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
            <transition
                enter-active-class="transition-all duration-75"
                leave-active-class="transition-all duration-75"
                enter-class="opacity-0 scale-90 skew-x-3"
                enter-to-class="opacity-100 scale-100 skew-x-0"
                leave-class="opacity-100 scale-100 skew-x-0"
                leave-to-class="opacity-0 scale-90 skew-x-3"
            >
                <div class="transform modal-overlay absolute w-full h-full bg-gray-900 opacity-75" @click="close"></div>
            </transition>

            <transition
                enter-active-class="transition-all duration-200"
                leave-active-class="transition-all duration-200"
                enter-class="opacity-0 scale-90 skew-x-3"
                enter-to-class="opacity-100 scale-100 skew-x-0"
                leave-class="opacity-100 scale-100 skew-x-0"
                leave-to-class="opacity-0 scale-90 skew-x-3"
            >
                <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                        <button @click="close" class="flex items-center">
                            <i class="fa fa-times p-2 text-lg text-white"></i>
                            <span class="text-sm">(Esc)</span>
                        </button>
                    </div>

                    <div class="modal-content py-4 text-left px-6">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-2xl text-gray-900 font-bold">Share fika</p>
                            <div class="modal-close cursor-pointer z-50">
                                <button @click="close">
                                    <i class="fa fa-times p-2 text-lg text-gray-600 hover:text-gray-700"></i>
                                </button>
                            </div>
                        </div>

                        <!--Body-->
                        <slot />

                        <!--Footer-->
                        <div class="flex justify-end pt-2">
                            <!-- <button class="px-4 bg-transparent px-3 py-2 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Action</button> -->
                            <button @click="close" class="modal-close px-6 bg-indigo-500 py-2 rounded-lg text-white hover:bg-indigo-400">Close</button>
                        </div>

                    </div>
                </div>
            </transition>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                open: false
            }
        },
        mounted: function () {
            document.addEventListener("keydown", this.keyDownListener)
        },
        destroyed() {
            document.removeEventListener("keydown", this.keyDownListener)
        },
        methods: {
            keyDownListener(e) {
                if (this.open && e.key === 'Escape') {
                    this.close()
                }
            },
            close() {
                this.open = false
            },
            show() {
                this.open = true
            },
            toggle() {
                this.open = !this.show
            }
        }
    }
</script>
