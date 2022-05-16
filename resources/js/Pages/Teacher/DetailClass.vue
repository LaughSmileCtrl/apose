<template>
    <AuthenticatedLayout>
        <div class="flex flex-col m-4">
            <h2 class="text-xl font-semibold" v-html="study.class" />
            <p class="text-xl my-2" v-html="study.study" />

            <div class="flex flex-row justify-around my-8">
                <button @click="setConversation" class="btn btn-primary">
                    Atur Konverensi
                </button>
                <a :href="study.conversation_url" class="btn btn-secondary" target="_blank">Gabung kelas</a>
            </div>

            <hr class="my-5 h-[2px] bg-gray-200" />
            <div class="flex flex-row justify-around">
                <Link
                    :href="route('teacher.module.index', study.study_id)"
                    class="grid grid-cols-1 gap-3 place-items-center"
                >
                    <img src="/icons/book-shelf.png" class="h-24 w-24" alt="" />
                    <h3 class="text-md text-gray-500">Materi</h3>
                </Link>

                <Link
                    :href="route('teacher.task.index', study.study_id)"
                    class="grid grid-cols-1 gap-3 place-items-center"
                >
                    <img src="/icons/task.png" class="h-24 w-24" alt="" />
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
    data() {
        return {
            studyId: route().params.studyId,
        };
    },
    methods: {
        setConversation() {
            this.$swal({
                title: "Tambah Tugas Baru",
                html: `
                <div class="grid grid-cols-3 gap-y-6 gap-x-1 justify-items-start place-items-center px-3 ">
                    <label>URL Pertemuan</label>
                    <input 
                        id="url" 
                        type="text" 
                        placeholder="Masukkan URL Pertemuan" 
                        class="col-span-2 rounded-xl px-2 my-1 w-full"
                    >
                    
                </div>
                `,
                showCloseButton: true,
                showCancelButton: true,
                reverseButtons: true,
                preConfirm: () => {
                    return [
                        document.getElementById("url").value,
                    ];
                },
            }).then((input) => {
                var inputJson = {
                    url: input.value[0],
                };

                this.$inertia.post(
                    route("teacher.conversation.store", this.studyId),
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
        }
    }
};
</script>