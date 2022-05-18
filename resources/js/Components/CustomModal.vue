<template>
    <div
        v-if="show"
        class="
            absolute
            inset-0
            z-50
            bg-gray-500/40
        "
    >
        <div
            class="
                fixed
                top-1/3
                left-0
                md:left-1/3
                grid
                w-[32rem]
                grid-cols-1
                gap-0
                rounded-md
                bg-white
                p-3
            "
        >
            <button
                @click="$emit('close')"
                class="justify-self-end text-gray-400 hover:text-gray-700"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
            <h1 class="p-0 text-center text-2xl capitalize">
                <slot name="header" />
            </h1>
            <div class="my-4 px-3">
                <slot />
            </div>
            <div class="my-4 flex flex-row items-center justify-center gap-2">
                <button
                    @click="$emit('close')"
                    class="
                        btn
                        rounded-md
                        bg-red-400
                        py-2
                        px-4
                        capitalize
                        text-white
                    "
                >
                    Cancel
                </button>
                <button
                    @click="$emit('confirmed')"
                    class="btn rounded-md bg-blue-400 py-2 px-4 text-white"
                >
                    OK
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        show: {
            default: false,
        },
    },
};
</script>