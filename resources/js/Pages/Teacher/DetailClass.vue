<template>
    <AuthenticatedLayout>
        <div class="flex flex-col m-4">
            <h2 class="text-xl font-semibold" v-html="study.class" />
            <p class="text-xl my-2" v-html="study.study" />

            <div class="flex flex-row justify-around my-8">
                <button class="btn btn-primary">
                    Atur Konverensi
                </button>
                <button
                    class="btn btn-secondary"
                >
                    Gabung kelas
                </button>
            </div>

            <hr class="my-5 h-[2px] bg-gray-200" />
            <div class="flex flex-row justify-around">
                <Link :href="route('teacher.module.index', study.study_id)" class="grid grid-cols-1 gap-3 place-items-center">
                    <img src="/icons/book-shelf.png" class="h-24 w-24" alt="">
                    <h3 class="text-md text-gray-500">Materi</h3>
                </Link>

                <Link :href="route('teacher.task.index', study.study_id)" class="grid grid-cols-1 gap-3 place-items-center">
                    <img src="/icons/task.png" class="h-24 w-24" alt="">
                    <h3 class="text-md text-gray-500">Tugas</h3>
                </Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/Autenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";


export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
    },
    props: ["study"],
}
</script>