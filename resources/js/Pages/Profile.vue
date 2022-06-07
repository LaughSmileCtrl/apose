<template>
    <AuthenticatedLayout>
        <div class="">
            <div
                class="
                    w-full
                    border-gray-300
                    shadow-lg
                    bg-white
                    md:w-3/4 md:rounded-3xl md:border
                    lg:w-1/2
                    absolute
                    md:relative
                    inset-x-0
                "
            >
                <div
                    class="
                        w-full
                        -mt-12
                        md:mt-0
                        bg-blue-500
                        md:bg-white
                        p-6
                        md:rounded-t-3xl
                    "
                >
                    <h2 class="text-2xl text-white md:text-gray-800">
                        Profile
                    </h2>
                    <div class="flex w-full items-center justify-center py-12">
                        <input
                            @change="addAvatar($event)"
                            id="file"
                            type="file"
                            class="hidden"
                            accept="image/png, image/jpeg"
                        />
                        <label
                            for="file"
                            class="flex h-fit w-fit cursor-pointer items-end"
                        >
                            <div v-if="userData.avatar != null">
                                <img
                                    :src="getAvatar()"
                                    class="w-24 h-24 border rounded-full"
                                    alt=""
                                />
                            </div>
                            <div
                                v-else-if="userData.avatar_path == null"
                                class="p-4 rounded-full bg-white border"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-20 w-20 text-blue-400"
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
                            </div>

                            <div v-else>
                                <img
                                    :src="userData.avatar_path"
                                    class="w-24 h-24 border rounded-full"
                                    alt=""
                                />
                            </div>
                            <div
                                class="
                                    -ml-6
                                    rounded-full
                                    bg-red-500
                                    p-1
                                    text-white
                                "
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>
                            </div>
                        </label>
                    </div>
                </div>
                <div
                    class="
                        -mt-8
                        grid
                        h-full
                        w-full
                        gap-y-6
                        rounded-3xl
                        bg-white
                        p-8
                    "
                >
                    <div class="grid">
                        <label for="" class="text-sm text-gray-400"
                            >Username</label
                        >
                        <input
                            v-model="userData.name"
                            type="text"
                            class="
                                w-full
                                border-b-2
                                py-2
                                border-0
                                focus:border-b-2
                                focus:border-blue-500
                                focus:outline-none
                                focus:ring-0
                            "
                        />
                    </div>
                    <div class="grid">
                        <label for="" class="text-sm text-gray-400"
                            >Email</label
                        >
                        <input
                            v-model="userData.email"
                            type="email"
                            class="
                                w-full
                                border-b-2
                                py-2
                                border-0
                                focus:border-b-2
                                focus:border-blue-500
                                focus:outline-none
                                focus:ring-0
                            "
                        />
                    </div>
                    <div class="grid">
                        <label for="" class="text-sm text-gray-400"
                            >Password</label
                        >
                        <div class="w-full flex flex-row">
                            <input
                                v-model="userData.password"
                                :type="passwordVisible ? 'text' : 'password'"
                                class="
                                    w-full
                                    border-b-2
                                    py-2
                                    border-0
                                    focus:border-b-2
                                    focus:border-blue-500
                                    focus:outline-none
                                    focus:ring-0
                                "
                            />
                            <svg
                                @click="passwordToggle"
                                xmlns="http://www.w3.org/2000/svg"
                                :class="passwordVisible ? 'hidden' : 'h-7 w-7'"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"
                                />
                            </svg>
                            <svg
                                @click="passwordToggle"
                                xmlns="http://www.w3.org/2000/svg"
                                :class="!passwordVisible ? 'hidden' : 'h-7 w-7'"
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
                        </div>
                    </div>
                    <div class="my-4">
                        <button
                            @click="updateProfile"
                            class="btn btn-primary w-full"
                        >
                            Simpan
                        </button>
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
    props: ["user"],
    data() {
        return {
            userData: this.user,
            passwordVisible: false,
        };
    },
    methods: {
        passwordToggle() {
            this.passwordVisible = !this.passwordVisible;
        },
        addAvatar(event) {
            this.userData.avatar = event.target.files[0];
        },
        getAvatar() {
            return URL.createObjectURL(this.userData.avatar);
        },
        updateProfile() {
            var inputJson = {
                _method: "put",
                name: this.userData.name,
                email: this.userData.email,
                password: this.userData.password,
                avatar: this.userData.avatar,
            };

            this.$inertia.post(
                route("client.profile", this.user.id),
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
                            "Gagal mengubah data",
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