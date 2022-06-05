<template>
    <AuthenticatedLayout>
        <div class="max-w-screen min-h-screen">
            <div class="container mx-auto">
                <div class="m-4">
                    <h2 class="text-xl font-bold capitalize mb-5">
                        Tugas {{ study_name }}
                    </h2>

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
                                v-for="task in tasks"
                                :key="task.id"
                                class="
                                    w-full
                                    rounded-2xl
                                    border
                                    p-6
                                    shadow-md
                                    hover:shadow-x hover:border-blue-300
                                "
                            >
                                <div class="h-16">
                                    <div
                                        class="
                                            flex flex-row
                                            justify-between
                                            items-center
                                        "
                                    >
                                        <div class="grid w-full">
                                            <h2
                                                v-if="
                                                    route().current(
                                                        'student.task.index'
                                                    )
                                                "
                                                class="text-md capitalize"
                                                v-html="task.study.name"
                                            />
                                            <h2
                                                class="
                                                    text-lg
                                                    font-bold
                                                    capitalize
                                                "
                                                v-html="task.name"
                                            />
                                        </div>

                                        <svg
                                            v-if="task.pivot.status == 1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-7 w-7 text-blue-400"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </div>
                                    <p
                                        class="
                                            text-sm text-gray-500
                                            line-clamp-3
                                        "
                                        v-html="task.description"
                                    />
                                </div>
                                <div
                                    class="
                                        flex flex-row
                                        items-end
                                        justify-between
                                        mt-12
                                    "
                                >
                                    <div class="">
                                        <h3 class="text-sm">
                                            Batas Pengumpulan
                                        </h3>
                                        <h3
                                            class="text-sm font-semibold"
                                            v-html="
                                                new Date(
                                                    task.deadline
                                                ).toLocaleString('ID-id', {
                                                    timezone: 'Asia/Jakarta',
                                                    weekday: 'long',
                                                    year: 'numeric',
                                                    month: 'long',
                                                    day: 'numeric',
                                                    hour: 'numeric',
                                                    minute: 'numeric',
                                                })
                                            "
                                        />
                                    </div>
                                    <button
                                        @click="showModal(task)"
                                        class="btn btn-primary"
                                    >
                                        Tampilkan
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
    props: ["tasks", "study_name"],
    methods: {
        showModal(task) {
            this.$swal({
                title: task.study.name.toUpperCase(),
                html: `
                <div class="flex flex-col gap-3 text-left">
                    <h2 class="text-md capitalize">${task.name}</h2>
                    <p class="text-sm text-gray-700">${task.description}</p>
                    <div>
                        <h3 class="text-sm capitalize">
                            Batas Waktu
                            <p
                                class="capitalize font-semibold"
                            >
                                ${new Date(task.deadline).toLocaleString(
                                    "ID-id",
                                    {
                                        timezone: "Asia/Jakarta",
                                        weekday: "long",
                                        year: "numeric",
                                        month: "long",
                                        day: "numeric",
                                        hour: "numeric",
                                        minute: "numeric",
                                    }
                                )}
                            </p>
                        </h3>
                    </div>
                    <div class="w-full flex flex-row gap-4 items-center justify-between">
                        <input id="file" type="file" class="">
                    </div>
                </div>
                `,
                showCloseButton: true,
                showCancelButton: true,
                textConfirmationButton: "Simpan",
                reverseButtons: true,
                preConfirm: () => {
                    return [document.getElementById("file").files[0]];
                },
            }).then((input) => {
                if (input.value[0]) {
                    this.$inertia.post(
                        route("student.task.store", [task.study.id, task.id]),
                        {
                            file: input.value[0],
                        },
                        {
                            onSuccess: (page) => {
                                this.$swal(
                                    "Berhasil Menyimpan",
                                    page.props.flash.message,
                                    "success"
                                );
                            },
                            onError: (message) => {
                                var errorsMessage = [];
                                for (var key in this.$attrs["errors"]) {
                                    errorsMessage.push(
                                        `<li class="capitalize">
                                            ${this.$attrs["errors"][key]}
                                        </li>`
                                    );
                                }

                                this.$swal(
                                    "Gagal menambah data",
                                    `<ul class="text-red-500 ">
                                        ${errorsMessage}
                                    </ul>`,
                                    "error"
                                );
                            },
                        }
                    );
                }
            });
        },
    },
};
</script>