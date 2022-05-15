<template>
    <swiper
        :slidesPerView="1"
        :spaceBetween="30"
        :pagination="{
            clickable: true,
        }"
        :modules="modules"
        :breakpoints="breakpoints"
    >
        <swiper-slide v-for="i in 5" :key="i">
            <div
                class="
                    rounded-xl
                    p-6
                    mb-10
                    border border-gray-200
                    shadow-xl shadow-gray-300
                    bg-blue-500
                    text-white
                "
            >
                <div class="flex flex-col">
                    <div class="w-full h-24">
                        <h2 class="text-md line-clamp-2">
                            Judul yang panjang Judul yang panjang Judul yang
                            panjang Jud
                        </h2>
                    </div>
                    <div class="flex flex-row justify-between items-center">
                        <div>
                            <h3 class="text-xs capitalize">Batas Waktu</h3>
                            <h3 class="text-xs capitalize font-semibold">
                                Senin, 24 Maret 2022
                            </h3>
                        </div>
                        <button
                            @click="showModal"
                            class="btn bg-white text-blue-700"
                        >
                            Kumpulkan
                        </button>
                    </div>
                </div>
            </div>
        </swiper-slide>
    </swiper>
</template>
<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";

import "swiper/css/pagination";

// import required modules
import { Pagination } from "swiper";

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        return {
            modules: [Pagination],
        };
    },
    data() {
        return {
            breakpoints: {
                1536: {
                    slidesPerView: 4,
                    spaceBetween: 10,
                },
                1280: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                1024: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                640: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 5,
                },
            },
        };
    },
    methods: {
        showModal() {
            this.$swal({
                width: "20rem",
                title: "Pilih File",
                input: "file",
                inputAttributes: {
                    accept: "all/*",
                },
            });
        },
    },
};
</script>