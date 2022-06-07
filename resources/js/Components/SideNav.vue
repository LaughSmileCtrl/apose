<template>
    <div
        class="
            fixed
            lg:relative
            inset-0
            h-full
            z-50
            bg-black/60
            lg:bg-transparent
        "
    >
        <div
            class="
                absolute
                lg:relative
                inset-y-0
                w-64
                bg-white
                text-blue-500
                rounded-r-3xl
                lg:rounded-3xl
                p-6
            "
        >
            <h2 class="text-xl text-center font-light capitalize w-fu">
                Aplikasi Pangajharan Online Sumenep
            </h2>
            <hr class="h-[2px] bg-blue-100 mt-4 mb-6 mx-3" />
            <Link
                :href="[
                    $page.props.auth.user.roles[0].name == 'teacher'
                        ? route('teacher.classroom.index')
                        : route('student.study.index'),
                ]"
                class="flex flex-row gap-2 p-2 my-3 w-full"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                    />
                </svg>
                <h3 class="text-md">Pelajaran</h3>
            </Link>
            <Link
                v-if="$page.props.auth.user.roles[0].name == 'student'"
                :href="route('student.task.index')"
                class="flex flex-row gap-2 p-2 my-3 w-full"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                    />
                </svg>
                <h3 class="text-md">Tugas</h3>
            </Link>
            <Link
                :href="route('client.profile')"
                class="flex flex-row gap-2 p-2 my-3 w-full"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    />
                </svg>
                <h3 class="text-md">Profile</h3>
            </Link>
            <button @click="logout" class="flex flex-row gap-2 p-2 my-3 w-full">
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
                <h3 class="text-md">Keluar</h3>
            </button>
        </div>
        <div class="h-full w-full" @click="$emit('close')"></div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Link,
    },
    methods: {
        logout() {
            axios.post(route("logout")).then(() => {
                this.$inertia.reload();
            });
        },
    },
};
</script>