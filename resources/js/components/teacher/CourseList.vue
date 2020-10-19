<template>
    <div>
        <div class="btn-wrapper">
            <router-link to="/teacher/addcourse" class="btn btn-primary btn-sm">Add New Course</router-link>
        </div>
        <table class="table">
            <thead>
                <th>name</th>
                <th>description</th>
                <th>add tasks</th>
            </thead>
            <tbody>
                <template v-if="!courses.length">
                    <tr>
                        <td colspan="4" class="text-center">No courses Available</td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="course in courses" :key="course.id">
                        <td>{{ course.name }}</td>
                        <td>{{ course.description }}</td>

                        <td>
                            <router-link :to="`/teacher/tasks/${course.id}`">View task</router-link>
                        </td> 
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>



<script>
    export default {

        name: 'CourseList',
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
