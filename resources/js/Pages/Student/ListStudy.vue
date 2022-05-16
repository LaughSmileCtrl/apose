<template>
    <AuthenticatedLayout>
        <div class="my-4">
            <div
                class="
                    grid grid-cols-1
                    md:grid-cols-3
                    lg:grid-cols-4
                    gap-6
                    mx-4
                "
            >
                <div
                    v-for="study in studies"
                    :key="study.id"
                    class="
                        h-full
                        flex flex-row
                        md:flex-col
                        gap-3
                        justify-between
                        items-center
                        md:items-start md:p-6 md:border
                        border-gray-100
                        md:shadow-md
                        shadow-blue-300
                        rounded-xl
                    "
                >
                    <div class="flex flex-row gap-5 items-center">
                        <img class="h-14 w-14" :src="study.icon_path" alt="" />
                        <div class="">
                            <h2 class="text-md capitalize" v-html="study.name" />
                        </div>
                    </div>
                    <div class="w-fit">
                        <Link
                            :href="route('student.study.show', study.id)"
                            class="btn btn-primary btn-sm md:w-full"
                        >
                            Akses Kelas
                        </Link>
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
    props: ["studies"],
    components: {
        Link,
        Head,
        AuthenticatedLayout,
    },
};
</script>