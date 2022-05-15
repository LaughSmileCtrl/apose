<template>
    <AuthenticatedLayout>
        <div class="max-w-screen min-h-screen">
            <div class="container mx-auto">
                <div class="m-4">
                    <h2 class="text-xl font-bold">Tugas Nama Mata Pelajaran</h2>
                    <div class="mt-8">
                        <div class="w-full flex justify-end my-8">
                            <button
                                @click="showAddTask"
                                class="btn btn-primary"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-7 w-7 inline"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                    />
                                </svg>
                                Tambah
                            </button>
                        </div>
                        <div
                            class="
                                grid grid-cols-1
                                md:grid-cols-2
                                lg:grid-cols-3
                                gap-5
                            "
                        >
                            <div
                                v-for="i in 7"
                                :key="i"
                                class="w-full rounded-2xl border p-6 shadow-xl"
                            >
                                <h2 class="text-lg font-bold">Tugas latihan</h2>
                                <div
                                    class="
                                        flex flex-row
                                        items-end
                                        justify-between
                                        mt-12
                                    "
                                >
                                    <div class="">
                                        <h3 class="text-sm font-semibold">
                                            Waktu Maksimal Pengumpulan
                                        </h3>
                                        <h3 class="text-sm">
                                            Senin, 23 Februari 2020
                                        </h3>
                                    </div>
                                    <button
                                        @click="showModal"
                                        class="btn btn-primary"
                                    >
                                        kumpulkan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import AuthenticatedLayout from "@/Layouts/Autenticated.vue";

export default {
    components: {
        AuthenticatedLayout,
    },
    methods: {
        showModal() {
            this.$swal({
                width: "20rem",
                title: "Pilih File",
                input: "file",
                inputAttributes: {
                    accept: "all/*",
                },
            });
        },
    },
};
</script>