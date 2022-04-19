<template>
    <div class="max-w-screen min-h-screen">
        <div class="container mx-auto">
            <div class="m-8">
                <h2 class="text-xl font-bold">Tugas Nama Mata Pelajaran</h2>
                <div class="mt-8">
                    <div
                        class="
                            grid grid-cols-1
                            md:grid-cols-2
                            lg:grid-cols-3
                            gap-5
                        "
                    >
                        <div
                            v-for="i in 7"
                            :key="i"
                            class="
                                w-full
                                rounded-2xl
                                border-2 border-green-500
                                bg-green-300
                                p-6
                            "
                        >
                            <h2 class="text-lg font-bold">Tugas latihan</h2>
                            <hr class="my-2 border border-green-500" />
                            <div class="flex flex-row items-end justify-between mt-12">
                                <div class="">
                                    <h3 class="text-sm font-semibold">
                                        Waktu Maksimal Pengumpulan
                                    </h3>
                                    <h3 class="text-sm">
                                        Senin, 23 Februari 2020
                                    </h3>
                                </div>
                                <button
                                    @click="showModal"
                                    class="
                                        btn
                                        bg-yellow-300
                                        px-6
                                        py-3
                                        uppercase
                                        rounded-lg
                                        h-fit
                                        shadow-lg
                                        text-xs
                                    "
                                >
                                    kumpulkan
                                </button>
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
  methods: {
    showModal() {
      
      this.$swal({
          width: '20rem',
          title: 'Pilih File',
          input: 'file',
          inputAttributes: {
            'accept': 'all/*'
          }
        })
    },
  },
};
    // function showModal() {
    //   (async () => {

    //     const { value: file } = await Swal.fire({
    //       width: '20rem',
    //       title: 'Pilih File',
    //       input: 'file',
    //       inputAttributes: {
    //         'accept': 'all/*'
    //       }
    //     })

    //     if (file) {
    //       const reader = new FileReader()
    //       reader.onload = (e) => {
    //         Swal.fire({
    //           title: 'Tugas telah dikumpulkan',
    //         })
    //       }
    //       reader.readAsDataURL(file)
    //     }

    //   })
    // }
  </script>