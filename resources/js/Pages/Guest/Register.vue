<template>
    <div class="max-w-screen min-h-screen">
        <div class="container mx-auto">
            <div
                class="
                    relative
                    w-full
                    h-80
                    rounded-b-[80px]
                    bg-blue-500
                    p-8
                    text-white
                    md:rounded-none
                "
            >
                <h2 class="text-4xl capitalize">Selamat datang</h2>
                <h2 class="my-4 text-2xl capitalize">
                    aplikasi pangajharan online sumenep
                </h2>
            </div>
            <div class="relative mx-8 -mt-32">
                <div class="mx-auto flex w-full items-center md:w-1/2">
                    <div
                        class="
                            w-full
                            rounded-3xl
                            border border-gray-300
                            bg-white
                            p-6
                            text-blue-800
                            shadow-xl
                            mb-12
                        "
                    >
                        <h2 class="text-center text-4xl">Daftar</h2>
                        <div class="mt-16 grid grid-cols-1 gap-8">
                            <div class="flex flex-row items-center gap-4">
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
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                </svg>
                                <div class="form-control w-full">
                                    <input
                                        type="text"
                                        class="
                                            w-full
                                            border-0 
                                            border-b-2 border-blue-800
                                            p-3
                                            outline-none
                                        "
                                        placeholder="Nama *"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-row items-center gap-4">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"
                                    />
                                </svg>
                                <div class="form-control w-full">
                                    <input
                                        type="text"
                                        class="
                                            w-full
                                            border-0 
                                            border-b-2 border-blue-800
                                            p-3
                                            outline-none
                                        "
                                        placeholder="Username *"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-row items-center gap-4">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                    />
                                </svg>
                                <div
                                    class="
                                        form-control
                                        flex
                                        w-full
                                        flex-row
                                        items-end
                                        justify-items-end
                                        gap-2
                                        border-b-2 border-blue-800
                                    "
                                >
                                    <input
                                        :type="(passwordVisible) ? 'text' : 'password'"
                                        class="w-full border-0 p-3 outline-none"
                                        placeholder="Password *"
                                    />
                                    <svg
                                        @click="passwordToggle"
                                        xmlns="http://www.w3.org/2000/svg"
                                        :class="(passwordVisible) ? 'hidden' : 'h-8 w-8'"
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
                                        :class="(!passwordVisible) ? 'hidden' : 'h-8 w-8'"
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
                        </div>
                        <div class="grid grid-cols-1 gap-6 mt-24 mx-auto w-fit">
                            <button
                                class="
                                    rounded-full
                                    py-3
                                    px-12
                                    bg-[#7796C3]
                                    text-white
                                "
                            >
                                Daftar
                            </button>
                            <div class="mb-12">
                                <h2 class="text-xs">
                                    Sudah punya akun?
                                    <a href="" class="text-gray-500"
                                        >Login</a
                                    >
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            passwordVisible: false,
        };
    },
    methods: {
        passwordToggle() {
            this.passwordVisible = !this.passwordVisible;
        },
    },
};
</script>