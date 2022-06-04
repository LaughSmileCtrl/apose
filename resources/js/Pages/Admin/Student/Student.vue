<template>
    <AdminLayout title="Ruang Kelas">
        <div class="flex flex-wrap">
            <div class="w-full mb-12 px-4">
                <StudentTable
                    :schools="schools"
                    :users="users"
                    :classroomsBySchool="classroomsBySchool"
                />
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "@/Layouts/Admin.vue";
import StudentTable from "./Component/StudentTable.vue";

export default {
    props: ["schools", "classroomsBySchool", "users"],
    components: {
        AdminLayout,
        StudentTable,
    },
};
</script>

