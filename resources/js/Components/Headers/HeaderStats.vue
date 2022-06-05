<template>
    <!-- Header -->
    <div class="bg-blue-500 md:pt-12 pb-32 pt-12 z-40">
        <div class="px-4 md:px-10 w-full">
            <!-- Card stats -->
            <div class="flex flex-wrap justify-around gap-y-5">
                <div
                    v-if="$page.props.auth.user.roles[0].name == 'super-admin'"
                    class="w-full sm:w-1/2 lg:w-4/12 px-4"
                >
                    <card-stats
                        statSubtitle="Sekolah"
                        :statTitle="schoolCount"
                        statDescripiron="Since last month"
                        statIconName="fas fa-school"
                        statIconColor="bg-red-500"
                    />
                </div>
                <div class="w-full sm:w-1/2 lg:w-4/12 px-4">
                    <card-stats
                        statSubtitle="RuangKelas"
                        :statTitle="classroomCount"
                        statDescripiron="Since last week"
                        statIconName="fas fa-chalkboard"
                        statIconColor="bg-orange-500"
                    />
                </div>
                <div class="w-full sm:w-1/2 lg:w-4/12 px-4">
                    <card-stats
                        statSubtitle="Pengguna"
                        :statTitle="userCount"
                        statDescripiron="Since yesterday"
                        statIconName="fas fa-user-alt"
                        statIconColor="bg-pink-500"
                    />
                </div>
                <div class="w-full sm:w-1/2 lg:w-4/12 px-4">
                    <card-stats
                        statSubtitle="Guru"
                        :statTitle="teacherCount"
                        statDescripiron="Since yesterday"
                        statIconName="fas fa-user-alt"
                        statIconColor="bg-green-500"
                    />
                </div>
                <div class="w-full sm:w-1/2 lg:w-4/12 px-4">
                    <card-stats
                        statSubtitle="Siswa"
                        :statTitle="studentCount"
                        statDescripiron="Since yesterday"
                        statIconName="fas fa-user-alt"
                        statIconColor="bg-violet-500"
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
        "teacherCount",
        "studentCount",
    ],
};
</script>
