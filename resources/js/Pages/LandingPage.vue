<template>
    <div id="beranda" class="container mx-auto w-screen px-8 pt-6 bg-white">
        <div class="flex w-full flex-row justify-between text-blue-500">
            <div class="text-center text-xs">
                <img class="h-14" src="images/logo.png" alt="" />
                Aplikasi Pangajheren Online Sumenep
            </div>
            <button @click="toggleSideBar" class="lg:hidden">
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
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>
            </button>
            <div class="hidden lg:block">
                <div class="flex flex-row gap-5 items-center">
                    <a href="#beranda" class="uppercase">Beranda</a>
                    <a href="#tentang" class="uppercase">Tentang</a>
                    <a href="#pelayanan" class="uppercase">pelayanan</a>
                    <Link :href="route('login')" class="btn btn-primary">
                        Login
                    </Link>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto relative px-8">
        <div class="absolute top-1/4 md:top-1/3">
            <h2 class="mb-1 text-blue-400 text-xl lg:text-3xl">
                Mempelajari Hal Baru
            </h2>
            <h1
                class="
                    capitalize
                    leading-normal
                    text-yellow-500
                    text-2xl
                    lg:text-4xl
                    xl:text-6xl
                "
            >
                Setiap hari, Setiap Waktu
            </h1>
        </div>
        <img class="w-screen" src="images/landing.png" alt="" />
    </div>
    <div
        id="tentang"
        class="
            container
            mx-auto
            my-14
            grid grid-cols-1
            place-items-center
            gap-8
            px-8
            lg:grid-cols-2
        "
    >
        <div class="hidden h-fit lg:block">
            <img src="images/image1.jpg" alt="" />
        </div>
        <div class="grid justify-items-center h-fit gap-6">
            <h2 class="text-2xl md:text-4xl uppercase text-blue-500">Apose</h2>
            <div class="text-md md:text-lg text-justify">
                <p>
                    Apose merupakan media enterprise yang menjembatani
                    pembelajaran jarak jauh dan juga asinkronus (guru dapat
                    menyiapkan materi lebih dulu dan interaksi pembelajaran
                    dilakukan secara fleksibel dan tidak harus dalam waktu yang
                    sama) yang di khususkan untuk SMA daerah Sumenep.
                </p>
            </div>
        </div>
    </div>
    <div
        id="pelayanan"
        class="container my-14 mx-auto grid justify-items-center gap-12"
    >
        <h2 class="text-2xl md:text-4xl uppercase text-blue-500">
            pelayanan kami
        </h2>
        <div class="grid w-full gap-4 px-16 md:px-36 lg:px-48">
            <div
                class="
                    flex flex-row
                    items-center
                    gap-4
                    rounded-lg
                    bg-blue-400
                    p-4
                "
            >
                <div class="w-fit rounded-full bg-white p-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-blue-400"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"
                        />
                    </svg>
                </div>
                <div class="w-full text-white">
                    <h2 class="text-md md:text-lg mb-2 capitalize">
                        Pembelajaran Sinkron Konferensi
                    </h2>
                    <p class="text-justify text-xs md:text-sm">
                        Siswa dan Guru akan dapat berkomunikasi dan
                        mendiskusikan berbagai topik melalui fasilitas
                        konferensi video kami.
                    </p>
                </div>
            </div>
            <div
                class="
                    flex flex-row
                    items-center
                    gap-4
                    rounded-lg
                    bg-blue-400
                    p-4
                "
            >
                <div class="w-fit rounded-full bg-white p-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-blue-400"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>
                <div class="w-full text-white">
                    <h2 class="text-md md:text-lg mb-2 capitalize">Materi</h2>
                    <p class="text-justify text-xs md:text-sm">
                        Guru dapat mengupload materi yang akan diberikan kepada
                        siswa dan siswa dapat mengunduh materi yang diberikan
                        oleh guru.
                    </p>
                </div>
            </div>
            <div
                class="
                    flex flex-row
                    items-center
                    gap-4
                    rounded-lg
                    bg-blue-400
                    p-4
                "
            >
                <div class="w-fit rounded-full bg-white p-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-blue-400"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
                        />
                        <path
                            fill-rule="evenodd"
                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>
                <div class="w-full text-white">
                    <h2 class="text-md md:text-lg mb-2 capitalize">Tugas</h2>
                    <p class="text-justify text-xs md:text-sm">
                        Guru dapat memberikan tugas beserta batas maksimal
                        pengumpulannya kepada siswa dan siswa dapat melihat
                        tugas dan mengupload tugas yang diberikan oleh guru.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div
        v-if="showSideBar"
        class="fixed inset-0 z-50 h-screen w-screen bg-gray-600/60 lg:hidden"
    >
        <div @click="toggleSideBar" class="w-full h-full"></div>
        <div class="absolute inset-y-0 right-0 w-64 bg-white">
            <div class="grid gap-2 p-4">
                <a
                    href="#beranda"
                    class="
                        w-full
                        rounded-lg
                        p-3
                        text-left
                        uppercase
                        hover:bg-blue-200
                    "
                >
                    Beranda
                </a>
                <a
                    href="#tentang"
                    class="
                        w-full
                        rounded-lg
                        p-3
                        text-left
                        uppercase
                        hover:bg-blue-200
                    "
                >
                    Tentang
                </a>
                <a
                    href="#pelayanan"
                    class="
                        w-full
                        rounded-lg
                        p-3
                        text-left
                        uppercase
                        hover:bg-blue-200
                    "
                >
                    pelayanan
                </a>
                <Link
                    :href="route('login')"
                    class="
                        mt-10
                        w-full
                        rounded-lg
                        bg-blue-400
                        p-3
                        uppercase
                        text-white
                        hover:bg-blue-600
                    "
                >
                    login
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },
    data() {
        return {
            showSideBar: false,
        };
    },
    methods: {
        toggleSideBar() {
            this.showSideBar = !this.showSideBar;
        },
    },
};
</script>