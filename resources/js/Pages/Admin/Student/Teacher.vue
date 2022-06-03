<template>
    <AdminLayout title="Ruang Kelas">
        <div class="flex flex-wrap">
            <div class="w-full mb-12 px-4">
                <TeacherTable
                    :schools="schools"
                    :classroomsBySchool="classroomsBySchool"
                    :users="users"
                    :studiesBySchool="studiesBySchool"
                />
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "@/Layouts/Admin.vue";
import TeacherTable from "./Component/TeacherTable.vue";

export default {
    props: ["schools", "classroomsBySchool", "users", "studiesBySchool"],
    components: {
        AdminLayout,
        TeacherTable,
    },
};
</script>

