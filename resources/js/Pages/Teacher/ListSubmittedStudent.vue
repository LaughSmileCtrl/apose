<template>
    <AuthenticatedLayout>
        <div class="max-w-screen min-h-screen">
            <div class="container mx-auto">
                <div class="m-4">
                    <h2 class="text-xl font-bold text-center uppercase">
                        Tugas {{ task.name }}
                    </h2>
                    <div class="mt-8">
                        <div class="grid grid-cols-1 gap-5">
                            <div
                                v-for="student in students"
                                :key="student"
                                class="
                                    flex
                                    w-full
                                    flex-row
                                    gap-2
                                    justify-between
                                    rounded-lg
                                    border border-gray-100
                                    p-4
                                    shadow shadow-blue-300
                                "
                            >
                                <h1
                                    class="line-clamp-1 text-lg capitalize"
                                    v-html="student.name"
                                />
                                <a
                                    :href="
                                        route('teacher.task.student', [
                                            task.id,
                                            student.id,
                                        ])
                                    "
                                    class="text-blue-500"
                                    target="_blank"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
                                        />
                                    </svg>
                                </a>
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
    data() {
        return {
            studyId: route().params.studyId,
        };
    },
    props: ["students", "task"],
    methods: {},
};
</script>