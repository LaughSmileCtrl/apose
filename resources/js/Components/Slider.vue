<template>
  <swiper
    :slidesPerView="'auto'"
    :spaceBetween="30"
    :pagination="{
      clickable: true,
    }"
    :modules="modules"
  >
    <swiper-slide v-for="i in 5" :key="i">
        <div class="card bg-green-200 rounded-lg p-6 mb-10 shadow-lg shadow-gray-300">
          <div class="flex flex-col">
            <div class="w-full h-24">
              <h2 class="text-md line-clamp-2">Judul yang panjang Judul yang panjang Judul yang panjang Jud</h2>
            </div>
            <div class="flex flex-row justify-between items-center">
              <div>
                <h3 class="text-xs capitalize">Batas Waktu</h3>
                <h3 class="text-xs capitalize font-semibold">Senin, 24 Maret 2022</h3>
              </div>
              <button class="btn bg-red-400 h-12 px-8 rounded-xl text-white">Akses</button>
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
};
</script>