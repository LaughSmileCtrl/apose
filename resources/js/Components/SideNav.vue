<template>
    <div class="fixed inset-0 z-50 overflow-y-hidden bg-black/60">
        <div
            class="
                absolute
                inset-y-0
                w-64
                bg-white
                text-blue-500
                rounded-r-3xl
                p-6
            "
        >
            <h2 class="text-xl text-center font-light">
                Sumenep High School Online Learning
            </h2>
            <hr class="h-[2px] bg-blue-100 my-4 mx-3" />
            <button @click="logout" class="flex flex-row justify-between p-2 w-full">
                <h3 class="text-md">Keluar</h3>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-red-500"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                    />
                </svg>
            </button>
        </div>
        <div class="h-full w-full" @click="$emit('close')"></div>
    </div>
</template>

<script>

export default {
    methods: {
        logout() {
            axios.post(route('logout'))
                .then(() => {
                    this.$inertia.reload();
                });
        }
    }
}
</script>