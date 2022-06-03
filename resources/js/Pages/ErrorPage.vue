<template>
    <div class="h-screen w-screen bg-gray-100 flex items-center">
        <div
            class="
                container
                flex flex-col
                md:flex-row
                items-center
                justify-center
                px-5
                text-gray-700
            "
        >
            <div class="max-w-md">
                <div class="text-5xl font-dark font-bold">
                    Uppsss...

                    <strong> 404 </strong>
                </div>
                <br />
                <br />
                <p class="">
                    <strong>Page Not Found</strong>
                </p>
                <br />
                <br />

                <p class="text-2xl mb-8 bold" v-html="message" />
                <button @click="logout" class="btn btn-secondary">Keluar</button>
            </div>
            <div class="max-w-lg">
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: ['message'],
    methods: {
        logout() {
            axios.post(route('logout'))
            .then(() => {
                this.$inertia.get(route('login'));
            })
            .catch((e) => {
                this.$inertia.get(route('login'));
            })
            .then(() => {
                this.$inertia.get(route('login'));
            });
        }
    }
}
</script>