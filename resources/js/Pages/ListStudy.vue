<template>
    <AuthenticatedLayout>
        <div class="my-4">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mx-4">
                <div
                    v-for="i in 10"
                    :key="i"
                    class="
                        flex flex-row
                        gap-3
                        md:flex-col
                        justify-between
                        md:p-6
                        md:border
                        border-gray-600
                        rounded-xl
                    "
                >
                    <div class="flex flex-row gap-5">
                        <div class="h-14 w-14 bg-slate-700 rounded-lg"></div>
                        <div class="">
                            <h2 class="text-md ">Baca Tulis Quran </h2>
                            <h2 class="text-sm ">Senin (07.00 - 08.00) </h2>
                            <h2 class="text-sm ">Guru Surejo S.pd </h2>
                        </div>
                    </div>
                    <div class="w-fit">
                        <button class="bg-blue-400 text-white py-2 px-5 rounded-xl">
                            Akses Kelas
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/Autenticated.vue";

export default {
    data() {
        return {};
    },
    components: {
        Link,
        Head,
        AuthenticatedLayout,
    },
};
</script>