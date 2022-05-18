<template>
  <AdminLayout>
    <header-stats />
    <div class="px-4 md:px-10 mx-auto  w-full -m-24 min-h-screen">
      <div class="w-full h-56 bg-red-100">
      </div>
    </div>
  </AdminLayout>
</template>
<script>
import CardTable from "@/Components/Cards/CardTable.vue";
import AdminLayout from "@/Layouts/Admin.vue";
import HeaderStats from "@/Components/Headers/HeaderStats.vue";

export default {
  components: {
    AdminLayout,
    HeaderStats,
  },
};
</script>
