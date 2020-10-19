<template>
    <div>
    
        <table class="table">
            <thead>
                <th>Course</th>
                <th>Task</th>
                <th>TaskDescription</th>
                <th>Due-on</th>
            </thead>
            <tbody>
                <template v-if="!tasks.length">
                    <tr>
                        <td colspan="4" class="text-center">No Tasks Available</td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="task in tasks" :key="task.id">
                        <td>{{ task.course.name }}</td>
                        <td>{{ task.title }}</td>
                        <td>{{ task.description }}</td>
                        <td>{{ task.due_date }}</td>
                        <!-- <td>
                            <router-link :to="`/tasks/${task.id}`">View task</router-link>
                        </td> -->
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'list',
        mounted() {
            // if (this.tasks.length) {
            //     return;
            // }
            
            this.$store.dispatch('getTasks');
        },
        computed: {
            tasks() {
                return this.$store.getters.tasks;
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
