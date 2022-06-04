<template>
    <div class="container mx-auto w-full px-4 sm:px-8">
        <div class="py-8">
            <div class="mb-1 flex w-full flex-row justify-between sm:mb-0">
                <div class="flex flex-wrap gap-2">
                    <button @click="showModal" class="btn btn-primary">
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
                                    px-4showModalgray-400
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
                                        px-5
                                        py-3
                                        text-left text-sm
                                        font-normal
                                        uppercase
                                        text-gray-800
                                    "
                                >
                                    Nama Sekolah
                                </th>
                                <th
                                    scope="col"
                                    class="
                                        border-b border-gray-200
                                        px-5
                                        py-3
                                        text-left text-sm
                                        font-normal
                                        uppercase
                                        text-gray-800
                                    "
                                >
                                    Ruang Kelas
                                </th>
                                <th
                                    scope="col"
                                    class="
                                        border-b border-gray-200
                                        px-5
                                        py-3
                                        text-left text-sm
                                        font-normal
                                        uppercase
                                        text-gray-800
                                    "
                                >
                                    Nama Pelajaran
                                </th>
                                <th
                                    scope="col"
                                    class="
                                        border-b border-gray-200
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
                            <tr
                                v-for="study in studies.data"
                                :key="study.id"
                                :class="[
                                    study.deleted_at == null
                                        ? 'bg-white hover:bg-blue-100'
                                        : 'bg-red-50 hover:bg-blue-100 text-red-400',
                                ]"
                            >
                                <td
                                    class="
                                        border-b border-gray-200
                                        p-5
                                        text-sm
                                    "
                                    v-html="study.id"
                                />
                                <td
                                    class="
                                        border-b border-gray-200
                                        p-5
                                        text-sm
                                        capitalize
                                    "
                                    v-html="study.classroom.school.name"
                                />
                                <td
                                    class="
                                        border-b border-gray-200
                                        p-5
                                        text-sm
                                        capitalize
                                    "
                                    v-html="study.classroom.name"
                                />
                                <td
                                    class="
                                        border-b border-gray-200
                                        p-5
                                        text-sm
                                        capitalize
                                    "
                                    v-html="study.name"
                                />
                                <td
                                    class="
                                        border-b border-gray-200
                                        p-5
                                        text-sm
                                    "
                                    v-html="
                                        new Date(
                                            study.created_at
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
                                        p-5
                                        text-sm
                                    "
                                >
                                    <div class="flex flex-row gap-2">
                                        <button
                                            v-if="study.deleted_at"
                                            @click="restoreStudy(study)"
                                            class="
                                                text-yellow-500
                                                hover:text-yellow-900
                                            "
                                        >
                                            Restore
                                        </button>
                                        <button
                                            v-if="! study.deleted_at"
                                            @click="editStudy(study)"
                                            class="
                                                text-blue-400
                                                hover:text-blue-900
                                            "
                                        >
                                            Edit
                                        </button>
                                        <button
                                            v-if="! study.deleted_at"
                                            @click="deleteStudy(study)"
                                            class="
                                                text-red-400
                                                hover:t
                                                ext-red-900
                                            "
                                        >
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination :links="studies.links" />
                </div>
            </div>
        </div>
    </div>
    <CustomModal
        :show="modalStatus"
        @close="closeModal"
        @confirmed="confirmedModal"
    >
        <div
            class="
                grid grid-cols-3
                gap-y-6 gap-x-1
                justify-items-start
                place-items-center
                px-3
            "
        >
            <label>Sekolah</label>
            <select
                v-model="schoolSelectedId"
                :disabled="selectedStudy != null"
                class="col-span-2 rounded-xl px-2 my-1 w-full"
            >
                <option
                    v-for="school in schools"
                    :key="school"
                    :value="school.id"
                    v-html="school.name"
                />
            </select>
            <label>Kelas</label>
            <select
                v-model="classroomSelectedId"
                :disabled="selectedStudy != null"
                class="col-span-2 rounded-xl px-2 my-1 w-full"
            >
                <option
                    v-for="classroom in classrooms[schoolSelectedId]"
                    :key="classroom"
                    :value="classroom.id"
                    v-html="classroom.name"
                />
            </select>
            <label>Nama Pelajaran</label>
            <input
                v-model="studyName"
                type="text"
                placeholder="Masukkan Nama Pelajaran"
                class="col-span-2 rounded-xl px-2 my-1 w-full"
            />
        </div>
    </CustomModal>
</template>

<script>
import Pagination from "@/Components/Pagination.vue";
import CustomModal from "@/Components/CustomModal.vue";

export default {
    data() {
        return {
            searchQuery: "",
            modalStatus: false,
            schoolSelectedId: null,
            classroomSelectedId: null,
            studyName: null,
            selectedStudy: null,
        };
    },
    props: ["schools", "classrooms", "studies"],
    components: {
        Pagination,
        CustomModal,
    },
    computed: {
        schoolsOptions() {
            var schoolsOptions = "";
            this.schools.forEach((school) => {
                schoolsOptions += `<option value="${school.id}" class="capitalize">
                        ${school.name}
                    </option>`;
            });

            return schoolsOptions;
        },
    },
    methods: {
        search() {
            this.$inertia.get(
                route("studies.index"),
                { search: this.searchQuery },
                { only: ["studies"], preserveState: true }
            );
        },
        showModal() {
            this.modalStatus = true;
        },
        closeModal() {
            this.modalStatus = false;
            this.selectedStudy = null;
            this.schoolSelectedId = null;
            this.classroomSelectedId = null;
            this.studyName = null;
        },
        confirmedModal() {
            if (this.selectedStudy === null) {
                this.postStudy();
            } else {
                this.updateStudy();
            }
        },
        postStudy() {
            var inputJson = {
                classroom_id: this.classroomSelectedId,
                study_name: this.studyName,
            };

            this.$inertia.post(route("studies.store"), inputJson, {
                onSuccess: (page) => {
                    this.$swal(
                        "Berhasil Menyimpan",
                        page.props.flash.message,
                        "success"
                    );

                    this.schoolSelectedId = null;
                    this.classroomSelectedId = null;
                    this.studyName = null;

                    this.closeModal();
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
        },
        editStudy(study) {
            this.selectedStudy = study;
            this.schoolSelectedId = study.classroom.school_id;
            this.classroomSelectedId = study.classroom.id;
            this.studyName = study.name;
            this.showModal();
        },
        updateStudy() {
            var inputJson = {
                classroom_id: this.classroomSelectedId,
                study_name: this.studyName,
            };

            this.$inertia.put(
                route("studies.update", this.selectedStudy.id),
                inputJson,
                {
                    onSuccess: (page) => {
                        this.$swal(
                            "Berhasil Menyimpan",
                            page.props.flash.message,
                            "success"
                        );

                        this.schoolSelectedId = null;
                        this.classroomSelectedId = null;
                        this.studyName = null;
                        this.selectedStudy = null;

                        this.closeModal();
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
        },
        deleteStudy(study) {
            this.$swal({
                title: "Anda yakin?",
                text: `Anda akan menghapus ${study.name}?`,
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(route(`studies.destroy`, study.id), {
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
        restoreStudy(study) {
            this.$swal({
                title: "Anda yakin?",
                text: `Anda akan mengembalikan ${study.name}?`,
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.put(route('studies.restore', study.id),
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
    },
};
</script>