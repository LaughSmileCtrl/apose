<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <header-stats
                :schoolCount="schoolCount"
                :classroomCount="classroomCount"
                :userCount="userCount"
                :teacherCount="teacherCount"
                :studentCount="studentCount"
            />
        </template>
    </AdminLayout>
</template>
<script>
import AdminLayout from "@/Layouts/Admin.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";

export default {
    components: {
        AdminLayout,
        HeaderStats,
    },
    props: [
        "schoolCount",
        "classroomCount",
        "userCount",
        "teacherCount",
        "studentCount",
    ],
};
</script>
