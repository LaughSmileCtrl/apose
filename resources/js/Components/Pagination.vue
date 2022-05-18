<template>
    <div
        class="
            xs:flex-row xs:justify-between
            flex flex-col
            items-center
            bg-white
            px-5
            py-5
        "
    >
        <div class="flex items-center rounded-xl border p-0.5 gap-1">
            <Link
                v-for="link in links"
                :key="link"
                :href="link.url"
                :class="[
                    link.active
                        ? 'w-fit rounded-xl bg-blue-100 px-4 py-2 text-base text-blue-900 hover:bg-blue-200'
                        : 'w-fit rounded-xl px-4 py-2 text-base text-gray-500 hover:bg-gray-100',
                ]"
                v-html="link.label"
            />
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    props: ["links"],
    components: {
        Link,
    },
};
</script>