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
                                placeholder="Cari Email"
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
                                    Nama Sekolah
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
                                    Nama User
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
                                    Role
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
                                    <span
                                        v-for="role in user.roles"
                                        :key="role"
                                        :class="'whitespace-nowrap text-xs font-semibold inline-block py-1 px-2 rounded uppercase last:mr-0 mr-1 ' + roleColor[role.name]"
                                        v-html="role.name"
                                    />
                                </td>
                                <td
                                    class="
                                        border-b border-gray-200
                                        bg-white
                                        px-5
                                        py-5
                                        text-sm
                                        h-full
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
                                        <button
                                            @click="deleteUser(user)"
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
        <template #header>Tambah User Baru</template>
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
                @change="resetSelectClassroom"
                v-model="selectedUser.school_id"
                :disabled="selectedUser.id != null"
                class="col-span-2 rounded-xl px-2 my-1 w-full uppercase"
            >
                <option
                    v-for="(school, id) in schools"
                    :key="id"
                    :value="id"
                    v-html="school"
                    class="capitalize"
                />
            </select>
            <label>Role</label>
            <select
                @change="resetSelectClassroom"
                v-model="selectedUser.role"
                :disabled="selectedUser.id != null"
                class="col-span-2 rounded-xl px-2 my-1 w-full capitalize"
            >
                <option
                    v-for="(role, id) in roles"
                    :key="id"
                    v-html="role"
                    class="capitalize"
                />
            </select>
            <label>Nama User</label>
            <input
                v-model="selectedUser.name"
                type="text"
                placeholder="Masukkan Nama user"
                class="col-span-2 rounded-xl px-2 my-1 w-full"
            />
            <label>Email User</label>
            <input
                v-model="selectedUser.email"
                type="email"
                placeholder="Masukkan Email"
                class="col-span-2 rounded-xl px-2 my-1 w-full"
            />
            <label>Pasword</label>
            <input
                v-model="selectedUser.password"
                type="text"
                placeholder="Masukkan Password"
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
            selectedUser: {
                id: null,
                name: null,
                email: null,
                password: "password",
                school_id: null,
                role: null,
            },
            roleColor: {
                student: "text-emerald-600 bg-emerald-200",
                teacher: "text-indigo-600 bg-indigo-200",
                admin: "text-amber-600 bg-amber-200",
                'super-admin': "text-red-600 bg-red-200",
            },
        };
    },
    props: ["schools", "users", "roles"],
    components: {
        Pagination,
        CustomModal,
    },
    methods: {
        search() {
            this.$inertia.get(
                route("users.index"),
                { search: this.searchQuery },
                { only: ["users"], preserveState: true }
            );
        },
        showModal() {
            this.modalStatus = true;
        },
        closeModal() {
            this.modalStatus = false;
            this.selectedUser = {
                id: null,
                name: null,
                email: null,
                password: "password",
                school_id: null,
                role: null,
            };
        },
        confirmedModal() {
            if (this.selectedUser.id === null) {
                this.postUser();
            } else {
                this.updateUser();
            }
        },
        postUser() {
            var inputJson = {
                name: this.selectedUser.name,
                role: this.selectedUser.role,
                email: this.selectedUser.email,
                password: this.selectedUser.password,
                school_id: this.selectedUser.school_id,
            };

            this.$inertia.post(route("users.store"), inputJson, {
                onSuccess: (page) => {
                    this.$swal(
                        "Berhasil Menyimpan",
                        page.props.flash.message,
                        "success"
                    );

                    this.schoolSelectedId = null;
                    this.classroomSelectedId = null;
                    this.userName = null;
                    this.password = "password";

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
        editUser(user) {
            this.selectedUser = {
                id: user.id,
                name: user.name,
                email: user.email,
                password: user.password,
                school_id: user.school_id,
                role: user.roles[0].name,
            };
            this.showModal();
        },
        updateUser() {
            var inputJson = {
                id: this.selectedUser.id,
                name: this.selectedUser.name,
                email: this.selectedUser.email,
                password: this.selectedUser.password,
            };

            this.$inertia.put(
                route("users.update", this.selectedUser.id),
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
                        this.userName = null;
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
        deleteUser(user) {
            this.$swal({
                title: "Anda yakin?",
                text: `Anda akan menghapus ${user.name}?`,
                icon: "warning",
                showCloseButton: true,
                showCancelButton: true,
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(route(`users.destroy`, user.id), {
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