<template>
    <AdminLayout title="Pelajaran">
        <div class="flex flex-wrap">
            <div class="w-full mb-12 px-4">
                <StudyTable
                    :schools="schools"
                    :classrooms="classrooms"
                    :studies="studies"
                />
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "@/Layouts/Admin.vue";
import StudyTable from "./Component/StudyTable.vue";

export default {
    props: ["schools", "classrooms", "studies"],
    components: {
        AdminLayout,
        StudyTable,
    },
};
</script>

