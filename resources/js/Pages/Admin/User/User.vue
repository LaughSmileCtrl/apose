<template>
    <AdminLayout title="Ruang Kelas">
        <div class="flex flex-wrap">
            <div class="w-full mb-12 px-4">
                <UserTable
                    :schools="schools"
                    :users="users"
                    :roles="roles"
                />
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "@/Layouts/Admin.vue";
import UserTable from "./Component/UserTable.vue";

export default {
    props: ["schools","users" ,"roles"],
    components: {
        AdminLayout,
        UserTable,
    },
};
</script>

