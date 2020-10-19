<template>
    <div>
  
        <table class="table">
            <thead>
                <th>name</th>
                <th>description</th>
            </thead>
            <tbody>
                <template v-if="!courses.length">
                    <tr>
                        <td colspan="4" class="text-center">No courses</td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="course in courses" :key="course.id">
                        <td>{{ course.name }}</td>
                        <td>{{ course.description }}</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>



<script>
    export default {

        name: 'StudentCourses',
        mounted() {
            
            // if (this.courses.length) {
            //     return;
            // }
            
            this.$store.dispatch('getCourses');
        },
        computed: {
            courses() {
                return this.$store.getters.courses;
            }
        }
    }
</script>

<style scoped>
.btn-wrapper {
    text-align: right;
    margin-bottom: 20px;
}
</style>
