<template>
    <AuthenticatedLayout>
        <div class="max-w-screen min-h-screen">
            <div class="container mx-auto">
                <div class="m-4">
                    <h2 class="text-xl font-bold uppercase">Tugas {{ study }}</h2>
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
                                v-for="task in tasks"
                                :key="task"
                                class="w-full rounded-2xl border p-6 shadow-xl"
                            >
                                <h2
                                    class="text-lg font-bold"
                                    v-html="task.name"
                                />
                                <p
                                    class="my-2 text-sm text-gray-700"
                                    v-html="task.description"
                                />
                                <div
                                    class="
                                        flex flex-row
                                        items-end
                                        justify-between
                                        mt-12
                                    "
                                >
                                    <div class="shrink-0">
                                        <h3 class="text-sm font-semibold">
                                            Waktu Maksimal Pengumpulan
                                        </h3>
                                        <h3
                                            class="text-sm"
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
                                    <div
                                        v-if="
                                            $page.props.auth.user.roles[0]
                                                .name == 'teacher'
                                        "
                                        class="flex flex-wrap gap-2 ml-3 items-center justify-center"
                                    >
                                        <button
                                            @click="showSubmitedTask(task)"
                                            class="text-blue-500"
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
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                />
                                            </svg>
                                        </button>
                                        <button
                                            @click="deleteTask(task)"
                                            class="text-blue-500"
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
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                    <button
                                        v-else
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
    data() {
        return {
            studyId: route().params.studyId,
        };
    },
    props: ["tasks", "study"],
    methods: {
        showSubmitedTask(task) {
            this.$inertia.get(
                route(`teacher.task.destroy`, [this.studyId, task.id])
            );
        },
        deleteTask(task) {
            this.$swal({
                title: "Anda yakin?",
                text: `Anda akan menghapus ${task.name}?`,
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(
                        route(`teacher.task.destroy`, [this.studyId, task.id]),
                        {
                            onSuccess: (page) => {
                                this.$swal(
                                    "Berhasil Terhapus",
                                    this.$attrs["flash"].message,
                                    "success"
                                );
                            },
                            onError: (message) => {
                                this.$swal(
                                    "Gagal Menghapus",
                                    this.errors,
                                    "error"
                                );
                            },
                        }
                    );
                }
            });
        },
        showAddTask() {
            this.$swal({
                title: "Tambah Tugas Baru",
                html: `
                <div class="grid grid-cols-3 gap-y-6 gap-x-1 justify-items-start place-items-center px-3 ">
                    <label>Nama Tugas</label>
                    <input 
                        id="name" 
                        type="text" 
                        placeholder="Masukkan Nama Tugas" 
                        class="col-span-2 rounded-xl px-2 my-1 w-full"
                    >
                    <label>Deadline</label>
                    <div class="col-span-2 flex flex-row gap-2">
                        <input 
                            id="date" 
                            type="date" 
                            class="rounded-xl px-2 my-1"
                        >
                        <input 
                            id="time" 
                            type="time" 
                            class="rounded-xl px-2 my-1"
                        >
                    </div>
                    <label>Deskripsi</label>
                    <textarea 
                        id="description"
                        rows="5" 
                        placeholder="Isi jika perlu" 
                        class="col-span-2 rounded-xl px-2 my-1 w-full"
                    ></textarea>
                </div>
                `,
                showCloseButton: true,
                showCancelButton: true,
                reverseButtons: true,
                preConfirm: () => {
                    return [
                        document.getElementById("name").value,
                        document.getElementById("date").value,
                        document.getElementById("time").value,
                        document.getElementById("description").value,
                    ];
                },
            }).then((input) => {
                var time =
                    input.value[2] === ""
                        ? new Date().toLocaleTimeString("en-US", {
                              hour12: false,
                          })
                        : input.value[2];

                var inputJson = {
                    study_id: this.studyId,
                    name: input.value[0],
                    deadline: input.value[1] + " " + time,
                    description: input.value[3],
                };

                this.$inertia.post(
                    route("teacher.task.store", this.studyId),
                    inputJson,
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
            });
        },
    },
};
</script>