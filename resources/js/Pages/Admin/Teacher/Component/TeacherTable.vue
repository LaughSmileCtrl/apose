<template>
    <div class="container mx-auto w-full px-4 sm:px-8">
        <div class="py-8">
            <div class="mb-1 flex w-full flex-row justify-between sm:mb-0">
                <div class="flex flex-wrap gap-2"></div>
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
                                    Sekolah
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
                                    Email
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
                                    Pelajaran
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
                            <tr v-for="user in users.data" :key="user.id">
                                <td
                                    class="
                                        border-b border-gray-200
                                        bg-white
                                        px-5
                                        py-5
                                        text-sm
                                    "
                                    v-html="user.id"
                                />
                                <td
                                    class="
                                        border-b border-gray-200
                                        bg-white
                                        px-5
                                        py-5
                                        text-sm
                                        capitalize
                                    "
                                    v-html="schools[user.school_id]"
                                />
                                <td
                                    class="
                                        border-b border-gray-200
                                        bg-white
                                        px-5
                                        py-5
                                        text-sm
                                        capitalize
                                    "
                                    v-html="user.name"
                                />
                                <td
                                    class="
                                        border-b border-gray-200
                                        bg-white
                                        px-5
                                        py-5
                                        text-sm
                                        lowercase
                                    "
                                    v-html="user.email"
                                />
                                <td
                                    class="
                                        border-b border-gray-200
                                        bg-white
                                        px-5
                                        py-5
                                        text-sm
                                        capitalize
                                    "
                                >
                                    <ul class="list-disc list-outside">
                                        <li
                                            v-for="study in user.teachs"
                                            :key="study"
                                            v-html="
                                                getStudyName(
                                                    user.school_id,
                                                    study.id
                                                )
                                            "
                                        />
                                    </ul>
                                </td>
                                <td
                                    class="
                                        border-b border-gray-200
                                        bg-white
                                        px-5
                                        py-5
                                        text-sm
                                    "
                                >
                                    <div class="flex flex-row gap-2">
                                        <button
                                            @click="editUser(user)"
                                            class="
                                                text-blue-400
                                                hover:text-blue-900
                                            "
                                        >
                                            Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination :links="users.links" />
                </div>
            </div>
        </div>
    </div>
    <CustomModal
        :show="modalStatus"
        @close="closeModal"
        @confirmed="confirmedModal"
    >
        <template #header>Edit Guru</template>
        <div
            class="
                grid grid-cols-3
                gap-y-6 gap-x-1
                justify-items-start
                place-items-center
                px-3
            "
        >
            <h2>Sekolah</h2>
            <h2
                class="col-span-2 capitalize"
                v-html="schools[selectedUser.school_id]"
            />
            <h2>Nama User</h2>
            <h2 class="col-span-2 capitalize" v-html="selectedUser.name" />
            <h2>Email User</h2>
            <h2 class="col-span-2 capitalize" v-html="selectedUser.email" />
            <div
                class="
                    col-span-3
                    w-full
                    grid grid-cols-3
                    justify-items-start
                    place-items-center
                "
            >
                <label>Pelajaran</label>
                <div class="col-span-2 w-full grid grid-col-1">
                    <select
                        @change="addStudiesId($event)"
                        class="rounded-xl px-2 my-1 w-full capitalize"
                    >
                        <option selected disabled></option>
                        <optgroup
                            v-for="classroom in studiesBySchool[
                                selectedUser.school_id
                            ]"
                            :key="classroom"
                            :label="classroom.name"
                        >
                            <option
                                v-for="study in classroom.studies"
                                :key="study"
                                :value="study.id"
                                v-html="study.name"
                                class="capitalize"
                            />
                        </optgroup>
                    </select>
                    <div class="flex flex-wrap gap-1">
                        <span
                            v-for="studyId in selectedUser.teachs"
                            :key="studyId"
                            class="
                                inline-block
                                rounded-full
                                text-white
                                bg-blue-500
                                px-2
                                py-1
                                text-xs
                                font-bold
                                capitalize
                            "
                        >
                            {{ getStudyName(selectedUser.school_id, studyId) }}
                            <button @click="deleteStudiesId(studyId)">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 inline"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
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
            selectedUser: null,
        };
    },
    props: ["schools", "users", "classroomsBySchool", "studiesBySchool"],
    components: {
        Pagination,
        CustomModal,
    },
    methods: {
        search() {
            this.$inertia.get(
                route("teachers.index"),
                { search: this.searchQuery },
                { only: ["users"], preserveState: true }
            );
        },
        showModal() {
            this.modalStatus = true;
        },
        closeModal() {
            this.modalStatus = false;
            this.selectedUser = null;
        },
        confirmedModal() {
            this.updateUser();
        },
        addStudiesId(event) {
            var id = Number(event.target.value);

            if (!this.selectedUser.teachs.includes(id)) {
                this.selectedUser.teachs.push(id);
            }
        },
        deleteStudiesId(studyId) {
            var filtered = this.selectedUser.teachs.filter((id) => {
                return id != studyId;
            });

            this.selectedUser.teachs = filtered;
        },
        getStudyName(schoolId, studyId) {
            var studyName;
            this.studiesBySchool[schoolId].forEach((classroom) => {
                classroom.studies.forEach((study) => {
                    if (study.id == studyId) {
                        studyName = classroom.name + " - " + study.name;
                    }
                });
            });
            return studyName;
        },
        editUser(user) {
            this.selectedUser = Object.assign({}, user);

            var teachs = [];
            this.selectedUser.teachs.forEach((study) => {
                teachs.push(study.id);
            });
            this.selectedUser.teachs = teachs;
            this.showModal();
        },
        updateUser() {
            var inputJson = {
                teachs: this.selectedUser.teachs,
            };

            this.$inertia.put(
                route("teachers.update", this.selectedUser.id),
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
                        this.selectedUserName = null;
                        this.selectedUser = null;

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
    },
};
</script>