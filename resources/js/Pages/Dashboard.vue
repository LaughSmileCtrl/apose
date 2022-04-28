<template>
    <div class="max-w-screen min-h-screen">
        <div class="container mx-auto">
            <SideNav v-if="showSideNav" @close="toggleSideNav" />
            <div
                class="
                    w-full
                    h-[21rem]
                    bg-blue-500
                    text-white
                    rounded-b-[80px]
                    px-4
                    py-0
                "
            >
                <div class="py-8">
                    <button @click="toggleSideNav">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 6h16M4 12h8m-8 6h16"
                            />
                        </svg>
                    </button>
                </div>
                <div class="">
                    <div class="flex flex-row items-center">
                        <div class="h-14 w-14 rounded-full">
                            <img
                                class="h-14 w-14"
                                src="/icons/avatar.png"
                                alt=""
                            />
                        </div>
                        <div class="flex flex-col ml-3">
                            <h2 class="text-md font-semibold">
                                {{ $page.props.auth.user.name }}
                            </h2>
                            <h3 class="text-xs">SMA Negeri 1 Sumenep</h3>
                            <h3 class="text-xs">1800211232</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="-mt-32 mb-5">
                    <div
                        class="
                            mx-4
                            rounded-xl
                            bg-white
                            shadow-lg shadow-gray-400
                        "
                    >
                        <div class="flex flex-col gap-3 px-6 pt-6 pb-2">
                            <h3 class="text-md">Pelajaran Hari Ini</h3>
                            <hr class="border" />
                        </div>
                        <div class="flex flex-col pb-4 px-12 justify-around">
                            <div class="grid grid-cols-2 gap-12 mt-3">
                                <Link
                                    :href="route('detail-study')"
                                    class="
                                        grid grid-cols-1
                                        justify-items-center
                                        gap-3
                                    "
                                >
                                    <div class="h-16 w-16">
                                        <img
                                            class="h-16 w-16"
                                            src="/icons/language.png"
                                            alt=""
                                        />
                                    </div>
                                    <h3 class="w-24 text-xs text-center">
                                        nama pelajaran yang cukup panjang
                                    </h3>
                                </Link>
                                <Link
                                    :href="route('detail-study')"
                                    class="
                                        grid grid-cols-1
                                        justify-items-center
                                        gap-3
                                    "
                                >
                                    <div class="h-16 w-16">
                                        <img
                                            class="h-16 w-16"
                                            src="/icons/sport.png"
                                            alt=""
                                        />
                                    </div>
                                    <h3 class="w-24 text-xs text-center">
                                        nama pelajaran yang cukup panjang
                                    </h3>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full my-8">
                <div class="flex flex-col gap-2 mx-4">
                    <h3 class="text-md">Daftar Mata Pelajaran</h3>
                    <div class="grid grid-cols-4 gap-4 py-6">
                        <Link
                            :href="route('detail-study')"
                            v-for="i in 7"
                            :key="i"
                            class="flex flex-col gap-1 items-center"
                        >
                            <div class="">
                                <img
                                    class="h-12 w-12"
                                    :src="`/icons/${icons[i - 1]}`"
                                    alt=""
                                />
                            </div>
                            <h3 class="w-20 text-xs text-center">
                                nama pelajaran
                            </h3>
                        </Link>
                        <Link
                            class="flex flex-col gap-1 items-center"
                            :href="route('list-study')"
                        >
                            <div class="">
                                <img
                                    class="h-12 w-12"
                                    src="/icons/plus.png"
                                    alt=""
                                />
                            </div>
                            <h3 class="w-20 text-xs text-center">
                                nama pelajaran
                            </h3>
                        </Link>
                    </div>
                </div>
            </div>
            <div class="w-full my-8">
                <div class="flex flex-col gap-5 mx-4">
                    <h3 class="text-md">Yuk Kerjain Tugas</h3>
                    <div class="flex flex-row">
                        <Slider />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import SideNav from "@/Components/SideNav.vue"
import Slider from "@/Components/Slider.vue";

export default {
    data() {
        return {
            icons: [
                "book.png",
                "language.png",
                "local.png",
                "mosque.png",
                "quran.png",
                "ruler.png",
                "sport.png",
            ],
            showSideNav: false,
        };
    },
    components: {
        Link,
        Head,
        SideNav,
        Slider,
    },
    methods: {
        toggleSideNav() {
            this.showSideNav = !this.showSideNav;
        },
    }
};
</script>