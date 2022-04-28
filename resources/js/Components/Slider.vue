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
        <div class="card rounded-xl p-6 mb-10 border border-gray-200 shadow-xl shadow-gray-300 bg-blue-500 text-white">
          <div class="flex flex-col">
            <div class="w-full h-24">
              <h2 class="text-md line-clamp-2">Judul yang panjang Judul yang panjang Judul yang panjang Jud</h2>
            </div>
            <div class="flex flex-row justify-between items-center">
              <div>
                <h3 class="text-xs capitalize">Batas Waktu</h3>
                <h3 class="text-xs capitalize font-semibold">Senin, 24 Maret 2022</h3>
              </div>
              <button class="btn bg-white h-12 px-8 rounded-xl text-blue-700 shadow-lg">Akses</button>
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