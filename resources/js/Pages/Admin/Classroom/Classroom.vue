<template>
    <AdminLayout title="Sekolah">
        <div class="flex flex-wrap">
            <div class="w-full mb-12 px-4">
                <SchoolTable :schools="schools" />
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "@/Layouts/Admin.vue";
import SchoolTable from "./Component/SchoolTable.vue";

export default {
    props: ["schools"],
    components: {
        AdminLayout,
        SchoolTable,
    },
};
</script>

