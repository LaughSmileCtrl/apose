<template>
    <div class="max-w-screen min-h-screen">
        <div class="w-full h-64 bg-green-100 rounded-b-[80px]">
            <div class="mx-8 my-14 absolute">
                <div class="flex flex-row items-center">
                    <div class="h-12 w-12 rounded-full bg-slate-500"></div>
                    <div class="flex flex-col ml-3">
                        <h2 class="text-sm">Mohammad Firman Ramadhan</h2>
                        <h3 class="text-xs">SMA Negeri 1 Sumenep</h3>
                        <h3 class="text-xs">1800211232</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="-mt-24 mb-5">
            <div class="mx-8 rounded-xl bg-white shadow-lg shadow-gray-400">
                <div class="flex flex-col gap-3 px-6 pt-6 pb-2">
                    <h3 class="text-md">Pelajaran Hari Ini</h3>
                    <hr class="border" />
                </div>
                <div class="flex flex-col pb-4 px-12 justify-around">
                    <div class="grid grid-cols-2 gap-12 mt-3">
                        <div
                            class="grid grid-cols-1 justify-items-center gap-3"
                        >
                            <div
                                class="h-16 w-16 rounded-xl bg-green-300"
                            ></div>
                            <h3 class="w-24 text-xs text-center">
                                nama pelajaran yang cukup panjang
                            </h3>
                        </div>
                        <div
                            class="grid grid-cols-1 justify-items-center gap-3"
                        >
                            <div
                                class="h-16 w-16 rounded-xl bg-green-300"
                            ></div>
                            <h3 class="w-24 text-xs text-center">
                                nama pelajaran yang cukup panjang
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full my-8">
            <div class="flex flex-col gap-2 mx-8">
                <h3 class="text-md">Daftar Mata Pelajaran</h3>
                <div class="grid grid-cols-4 gap-4 py-6">
                    <div
                        v-for="i in 8"
                        :key="i"
                        class="flex flex-col gap-1 items-center"
                    >
                        <div class="h-14 w-14 rounded-full bg-slate-500"></div>
                        <h3 class="w-20 text-xs text-center">nama pelajaran</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full my-8">
            <div class="flex flex-col gap-5 mx-8">
                <h3 class="text-md">Yuk Kerjain Tugas</h3>
                <div class="flex flex-row">
                    <Slider />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Slider from "@/Components/Slider.vue";

export default {
    components: {
        Slider,
    },
};
</script>