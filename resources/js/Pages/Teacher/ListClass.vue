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
                    :key="study"
                    class="flex flex-col w-full"
                >
                    <div
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
                        <div class="flex flex-col gap-1 md:gap-2 md:mb-3">
                            <h2
                                class="text-lg uppercase"
                                v-html="study.classroom.name"
                            />
                            <h2
                                class="text-md capitalize"
                                v-html="study.name"
                            />
                        </div>
                        <div class="w-fit shrink-0">
                            <Link
                                :href="
                                    route('teacher.classroom.show', [
                                        study.classroom.id,
                                        study.id,
                                    ])
                                "
                                class="btn btn-primary"
                            >
                                Akses Kelas
                            </Link>
                        </div>
                    </div>
                    <hr class="md:hidden h-[2px] m-4 bg-slate-100" />
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
    props: ["studies"],
};
</script>