<template>
    <AuthenticatedLayout>
        <div class="m-4">
            <h2 class="text-xl font-semibold capitalize">
                Materi {{ studyName }}
            </h2>
            <div class="w-full flex justify-end my-8">
                <button @click="showAddModule" class="btn btn-primary">
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
            <div class="">
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5"
                >
                    <div
                        v-for="moduleOfStudy in modules"
                        :key="moduleOfStudy"
                        class="w-full rounded-2xl p-6 border shadow-lg"
                    >
                        <h2 class="text-lg capitalize">
                            {{ moduleOfStudy.name }}
                        </h2>
                        <div
                            class="
                                flex flex-row
                                items-end
                                justify-between
                                mt-12
                            "
                        >
                            <div class="flex flex-row gap-5">
                                <a
                                    :href="route('teacher.module.show', [studyId, moduleOfStudy.id])"
                                    target="_blank"
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
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
                                        />
                                    </svg>
                                </a>
                                <button @click="deleteModule(moduleOfStudy)" class="text-blue-500">
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
                            <div class="">
                                <h3
                                    class="text-sm text-gray-500"
                                    v-html="
                                        new Date(
                                            moduleOfStudy.updated_at
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
    props: ["modules", "studyName"],
    data() {
        return {
            studyId: route().params.id,
        }
    },
    methods: {
        deleteModule(moduleOfStudy) {
            this.$swal({
                title: "Anda yakin?",
                text: `Anda akan menghapus ${moduleOfStudy.name} ini?`,
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {    
                   this.$inertia.delete(route(`teacher.module.destroy`, [this.studyId, moduleOfStudy.id]), {
                        onSuccess: (page) => {
                            this.$swal('Berhasil Terhapus', this.$attrs['flash'].message, 'success');
                        },
                        onError: (message) => {
                            this.$swal('Gagal Menghapus', this.errors, 'error')

                        }
                    }); 
                }
            });
        },
        showAddModule() {
            this.$swal({
                title: "Tambah Materi Baru",
                html: `
                <div class="flex flex-col gap-6 px-3">
                    <input id="name" 
                        type="text" 
                        placeholder="Masukkan Nama File" 
                        class="rounded-xl px-2 my-1 w-full"
                    >
                    <div class="w-full flex flex-row gap-4 items-center">
                        <label for="file" class="label shrink-0">
                            <span class="label-text md:text-lg">File</span>
                        </label>
                        <input id="file" type="file" class="">
                    </div>
                </div>
                `,
                showCloseButton: true,
                showCancelButton: true,
                reverseButtons: true,
                preConfirm: () => {
                    return [
                        document.getElementById("name").value,
                        document.getElementById("file").files[0],
                    ];
                },
            }).then((input) => {
                var name =
                    input.value[0] != ""
                        ? input.value[0]
                        : document.getElementById("file").value.split("\\")[2];
                var file = input.value[1];

                this.$inertia.post(
                    route("teacher.module.store", this.studyId),
                    {
                        name: name,
                        file: file,
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
                            this.$swal(
                                "Gagal menambah data",
                                `<ul class="text-red-500 ">
                                <li class="capitalize">${
                                    this.$attrs['errors'].name ? this.$attrs['errors'].name : ""
                                }</li>
                                <li class="capitalize">${
                                    this.$attrs['errors'].file ? this.$attrs['errors'].file : ""
                                }</li>
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