<template>
    <swiper
        :pagination="{
            clickable: true,
        }"
        :modules="modules"
        :breakpoints="breakpoints"
    >
        <swiper-slide v-for="task in tasks" :key="task">
            <div
                class="
                    rounded-xl
                    p-6
                    mb-10
                    border border-gray-200
                    shadow-xl shadow-gray-300
                    bg-blue-500
                    text-white
                    w-[95%]
                    mx-auto
                "
            >
                <div class="flex flex-col">
                    <div class="w-full h-32">
                        <h2
                            class="text-md line-clamp-2 capitalize"
                            v-html="task.study.name"
                        />
                        <h2
                            class="
                                text-lg
                                line-clamp-2
                                capitalize
                                font-semibold
                            "
                            v-html="task.name"
                        />
                        <p
                            class="text-sm text-gray-100 line-clamp-3"
                            v-html="task.description"
                        />
                    </div>
                    <div class="flex flex-row justify-between items-center">
                        <div>
                            <h3 class="text-xs capitalize">Batas Waktu</h3>
                            <h3
                                class="text-xs capitalize font-semibold"
                                v-html="
                                    new Date(task.deadline).toLocaleString(
                                        'ID-id',
                                        {
                                            timezone: 'Asia/Jakarta',
                                            weekday: 'long',
                                            year: 'numeric',
                                            month: 'long',
                                            day: 'numeric',
                                            hour: 'numeric',
                                            minute: 'numeric',
                                        }
                                    )
                                "
                            />
                        </div>
                        <button
                            @click="showModal(task)"
                            class="btn bg-white text-blue-700"
                        >
                            Tampilkan
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
    props: ["tasks"],
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
                // 1536: {
                //     slidesPerView: 4,
                //     spaceBetween: 10,
                // },
                1536: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                1200: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                1024: {
                    slidesPerView: 1,
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
        showModal(task) {
            this.$swal({
                title: task.name,
                html: `
                <div class="flex flex-col gap-3 text-left">
                    <h2 class="text-md capitalize">${task.study.name}</h2>
                    <p class="text-sm text-gray-700">${task.description}</p>
                    <div>
                        <h3 class="text-sm capitalize">
                            Batas Waktu
                            <p
                                class="capitalize font-semibold"
                            >
                                ${new Date(task.deadline).toLocaleString(
                                    "ID-id",
                                    {
                                        timezone: "Asia/Jakarta",
                                        weekday: "long",
                                        year: "numeric",
                                        month: "long",
                                        day: "numeric",
                                        hour: "numeric",
                                        minute: "numeric",
                                    }
                                )}
                            </p>
                        </h3>
                    </div>
                    <div class="w-full flex flex-row gap-4 items-center justify-between">
                        <input id="file" type="file" class="">
                    </div>
                </div>
                `,
                showCloseButton: true,
                showCancelButton: true,
                textConfirmationButton: "Simpan",
                reverseButtons: true,
                preConfirm: () => {
                    return [
                        document.getElementById("file").files[0],
                    ];
                },
            }).then((input) => {
                if (input.value[0]) {
                    this.$inertia.post(
                        route("student.task.store",[task.study_id, task.id]),
                        {
                            'file': input.value[0],
                        },
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
                                    "Gagal menambah data",
                                    `<ul class="text-red-500 ">
                                        ${errorsMessage}
                                    </ul>`,
                                    "error"
                                );
                            },
                        }
                    );
                }
            });
        },
    },
};
</script>