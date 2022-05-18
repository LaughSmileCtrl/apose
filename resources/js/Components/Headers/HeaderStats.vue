<template>
    <!-- Header -->
    <div class=" bg-blue-500 md:pt-12 pb-32 pt-12 z-40">
        <div class="px-4 md:px-10 w-full">
            <!-- Card stats -->
            <div class="flex flex-wrap justify-around">
                <div class="w-full sm:w-1/2 lg:w-3/12 px-4">
                    <card-stats
                        statSubtitle="SCHOOL"
                        :statTitle="schoolCount"
                        statDescripiron="Since last month"
                        statIconName="fas fa-school"
                        statIconColor="bg-red-500"
                    />
                </div>
                <div class="w-full sm:w-1/2 lg:w-3/12 px-4">
                    <card-stats
                        statSubtitle="CLASSROOM"
                        :statTitle="classroomCount"
                        statDescripiron="Since last week"
                        statIconName="fas fa-chalkboard"
                        statIconColor="bg-orange-500"
                    />
                </div>
                <div class="w-full sm:w-1/2 lg:w-3/12 px-4">
                    <card-stats
                        statSubtitle="USER"
                        :statTitle="userCount"
                        statDescripiron="Since yesterday"
                        statIconName="fas fa-user-alt"
                        statIconColor="bg-pink-500"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CardStats from "@/Components/Cards/CardStats.vue";

export default {
    components: {
        CardStats,
    },
    props: [
        "schoolCount",
        "classroomCount",
        "userCount",
    ]
};
</script>
