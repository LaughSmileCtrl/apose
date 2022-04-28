<template>
    <AuthenticatedLayout>
        <div class="flex flex-col min-h-screen m-4">
            <h2 class="text-xl">BTQ</h2>
            <hr class="my-5 h-[2px] bg-gray-300" />
            <p>Pengajar: nama_guru</p>
            <p>Waktu: senin (08:00 - 08:30)</p>

            <div class="flex flex-row justify-around my-8">
                <button class="bg-blue-400 h-12 px-8 rounded-lg text-white">
                    Presensi
                </button>
                <button
                    class="bg-yellow-400 h-12 px-8 rounded-lg text-blue-700"
                >
                    Gabung kelas
                </button>
            </div>

            <hr class="my-5 h-[2px] bg-gray-200" />
            <div class="flex flex-row justify-around">
                <div class="grid grid-cols-1 gap-3 place-items-center">
                    <img src="/icons/book-shelf.png" class="h-24 w-24" alt="">
                    <h3 class="text-md">Materi</h3>
                </div>

                <div class="grid grid-cols-1 gap-3 place-items-center">
                    <img src="/icons/task.png" class="h-24 w-24" alt="">
                    <h3 class="text-md">Tugas</h3>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/Autenticated.vue"

export default {
    components: {
        AuthenticatedLayout,
    }
}
</script>