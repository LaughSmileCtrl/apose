<template>
  <AdminLayout>
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <card-table />
      </div>
      <div class="w-full mb-12 px-4">
        <card-table color="dark" />
      </div>
    </div>
  </AdminLayout>
</template>
<script>
import CardTable from "@/Components/Cards/CardTable.vue";
import AdminLayout from "@/Layouts/Admin.vue";

export default {
  components: {
    AdminLayout,
    CardTable,
  },
};
</script>
