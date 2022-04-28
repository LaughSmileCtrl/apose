<template>
    <AuthenticatedLayout>
        <div class="m-4">
            <h2 class="text-xl">Materi Nama Mata Pelajaran</h2>
            <div class="mt-8">
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
                        class="
                            w-full
                            rounded-2xl
                            p-6
                            border
                            shadow-xl
                        "
                    >
                        <h2 class="text-lg">Materi {{ i }}</h2>
                        <div class="flex flex-row items-end justify-between mt-12">
                            <button
                                class="
                                    btn
                                    btn-primary
                                "
                            >
                                Unduh
                            </button>
                            <div class="">
                                <h3 class="text-sm text-gray-500">
                                    Senin, 23 Februari 2020
                                </h3>
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
    }    
}
</script>