<template>
    <div class="max-w-screen min-h-screen">
        <div class="container mx-auto">
            <div class="m-8">
                <h2 class="text-xl">Materi Nama Mata Pelajaran</h2>
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
                                bg-yellow-300
                                p-6
                            "
                        >
                            <h2 class="text-lg">Materi {{ i }}</h2>
                            <div class="flex flex-row items-end justify-between mt-12">
                                <div class="">
                                    <h3 class="text-sm font-semibold">
                                        Tanggal Upload
                                    </h3>
                                    <h3 class="text-sm">
                                        Senin, 23 Februari 2020
                                    </h3>
                                </div>
                                <div
                                    class="
                                        btn
                                        bg-red-400
                                        px-6
                                        py-3
                                        uppercase
                                        rounded-lg
                                        h-fit
                                    "
                                >
                                    Submit
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>