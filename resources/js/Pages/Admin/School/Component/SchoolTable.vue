<template>
    <div class="container mx-auto w-full px-4 sm:px-8">
        <div class="py-8">
            <div class="mb-1 flex w-full flex-row justify-between sm:mb-0">
                <div class="flex flex-wrap gap-2">
                    <button @click="showAddSchool" class="btn btn-primary">
                        Tambah
                    </button>
                </div>
                <div class="text-end">
                    <form
                        class="
                            flex
                            w-3/4
                            max-w-sm
                            flex-col
                            justify-center
                            items-center
                            space-y-3
                            md:w-full md:flex-row md:space-x-3 md:space-y-0
                        "
                    >
                        <div class="relative">
                            <input
                                @keyup="search"
                                v-model="searchQuery"
                                type="text"
                                id='"form-subscribe-Filter'
                                class="
                                    w-full
                                    flex-1
                                    appearance-none
                                    rounded-lg
                                    border border-transparent border-gray-300
                                    bg-white
                                    py-3
                                    px-4showAddSchoolgray-400
                                    shadow-sm
                                    focus:border-transparent
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-blue-600
                                "
                                placeholder="Cari"
                            />
                        </div>
                    </form>
                </div>
            </div>
            <div class="-mx-4 overflow-x-auto px-4 py-4 sm:-mx-8 sm:px-8">
                <div
                    class="
                        inline-block
                        min-w-full
                        overflow-hidden
                        rounded-lg
                        shadow
                    "
                >
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    scope="col"
                                    class="
                                        border-b border-gray-200
                                        bg-white
                                        px-5
                                        py-3
                                        text-left text-sm
                                        font-normal
                                        uppercase
                                        text-gray-800
                                    "
                                >
                                    ID
                                </th>
                                <th
                                    scope="col"
                                    class="
                                        border-b border-gray-200
                                        bg-white
                                        px-5
                                        py-3
                                        text-left text-sm
                                        font-normal
                                        uppercase
                                        text-gray-800
                                    "
                                >
                                    Nama
                                </th>
                                <th
                                    scope="col"
                                    class="
                                        border-b border-gray-200
                                        bg-white
                                        px-5
                                        py-3
                                        text-left text-sm
                                        font-normal
                                        uppercase
                                        text-gray-800
                                    "
                                >
                                    Tanggal dibuat
                                </th>
                                <th
                                    scope="col"
                                    class="
                                        border-b border-gray-200
                                        bg-white
                                        px-5
                                        py-3
                                        text-left text-sm
                                        font-normal
                                        uppercase
                                        text-gray-800
                                    "
                                ></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- @click="$inertia.get(route('classrooms.index', {_query: {school_id: school.id}}))" -->
                            <tr
                                v-for="school in schools.data"
                                :key="school.id"
                                :class="[
                                    school.deleted_at == null
                                        ? 'bg-white hover:bg-blue-100'
                                        : 'bg-red-50 hover:bg-blue-100 text-red-400',
                                ]"
                            >
                                <td
                                    class="
                                        border-b border-gray-200
                                        px-5
                                        py-5
                                        text-sm
                                    "
                                    v-html="school.id"
                                />
                                <td
                                    class="
                                        border-b border-gray-200
                                        px-5
                                        py-5
                                        text-sm
                                        capitalize
                                    "
                                    v-html="school.name"
                                />
                                <td
                                    class="
                                        border-b border-gray-200
                                        px-5
                                        py-5
                                        text-sm
                                    "
                                    v-html="
                                        new Date(
                                            school.created_at
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
                                <td
                                    class="
                                        border-b border-gray-200
                                        px-5
                                        py-5
                                        text-sm
                                    "
                                >
                                    <div class="flex flex-row gap-2">
                                        <button
                                            v-if="school.deleted_at"
                                            @click="restoreSchool(school)"
                                            class="
                                                text-yellow-500
                                                hover:text-yellow-900
                                            "
                                        >
                                            Restore
                                        </button>
                                        <button
                                            v-if="! school.deleted_at"
                                            @click="editSchool(school)"
                                            class="
                                                text-blue-400
                                                hover:text-blue-900
                                            "
                                        >
                                            Edit
                                        </button>
                                        <button
                                            v-if="!school.deleted_at"
                                            @click="deleteSchool(school)"
                                            class="
                                                text-red-400
                                                hover:text-red-900
                                            "
                                        >
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination :links="schools.links" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Pagination from "@/Components/Pagination.vue";

export default {
    data() {
        return {
            searchQuery: "",
        };
    },
    props: ["schools"],
    components: {
        Pagination,
    },
    methods: {
        search() {
            this.$inertia.get(
                route("schools.index"),
                { search: this.searchQuery },
                { only: ["schools"], preserveState: true }
            );
        },
        showAddSchool() {
            this.$swal({
                title: "Tambah Sekolah Baru",
                html: `
                <div class="grid grid-cols-3 gap-y-6 gap-x-1 justify-items-start place-items-center px-3 ">
                    <label>Nama Sekolah</label>
                    <input 
                        id="name" 
                        type="text" 
                        placeholder="Masukkan Nama Sekolah" 
                        class="col-span-2 rounded-xl px-2 my-1 w-full"
                    >
                </div>
                `,
                showCloseButton: true,
                showCancelButton: true,
                reverseButtons: true,
                preConfirm: () => {
                    return [document.getElementById("name").value];
                },
                customClass: {
                    container: "bg-blue-500 rounded-3xl",
                    popup: "rounded-3xl text-red-200",
                },
            }).then((input) => {
                var inputJson = {
                    name: input.value[0],
                };

                this.$inertia.post(route("schools.store"), inputJson, {
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
                });
            });
        },
        editSchool(school) {
            this.$swal({
                title: "Edit Sekolah",
                html: `
                <div class="grid grid-cols-3 gap-y-6 gap-x-1 justify-items-start place-items-center px-3 ">
                    <label>Nama Sekolah</label>
                    <input 
                        id="name" 
                        type="text"
                        value="${school.name}"
                        placeholder="Masukkan Nama Sekolah" 
                        class="col-span-2 rounded-xl px-2 my-1 w-full"
                    >
                </div>
                `,
                showCloseButton: true,
                showCancelButton: true,
                reverseButtons: true,
                preConfirm: () => {
                    return [document.getElementById("name").value];
                },
            }).then((input) => {
                var inputJson = {
                    name: input.value[0],
                };

                this.$inertia.put(
                    route("schools.update", school.id),
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
        restoreSchool(school) {
            this.$swal({
                title: "Anda yakin?",
                text: `Anda akan mengembalikan ${school.name}?`,
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.put(route('schools.restore', school.id),
                        {onSuccess: (page) => {
                            this.$swal(
                                "Berhasil merestore",
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
                                "Gagal merestore data",
                                `<ul class="text-red-500 ">
                                    ${errorsMessage}
                                </ul>`,
                                "error"
                            );
                        },
                    });
                }
            });
        },
        deleteSchool(school) {
            this.$swal({
                title: "Anda yakin?",
                text: `Anda akan menghapus ${school.name}?`,
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(route(`schools.destroy`, school.id), {
                        onSuccess: (page) => {
                            this.$swal(
                                "Berhasil Terhapus",
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
                    });
                }
            });
        },
    },
};
</script>