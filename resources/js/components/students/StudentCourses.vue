<template>
    <div>
        <div class="card-header" style="text-align:center;">Enrolled Courses</div>

        <table class="table">
            <thead>
                <th>name</th>
                <th>description</th>
            </thead>
            <tbody>
                <template v-if="!usercourses">
                    <tr>
                        <td colspan="4" class="text-center">Enrolled in None Courses</td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="usercourse in usercourses" :key="usercourse.id">
                        <td>{{ usercourse.course.name }}</td>
                        <td>{{ usercourse.course.description }}</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>



<script>
    export default {

        name: 'StudentCourses',


           created() {
             
           axios.get('/api/Assignments/stdcourse')
            .then((response) => {
              
                this.usercourses=response.data.usercourses;
              
              //  context.commit('updateTasks', response.data.assignments);
            })
           },
        mounted() {
       
            // if (this.courses.length) {
            //     return;
            // }
            
           // this.$store.dispatch('getCourses');
        },
        data(){
            return{
                       usercourses:[]

            };
        },
        computed: {
  
        }
    }
</script>

<style scoped>
.btn-wrapper {
    text-align: right;
    margin-bottom: 20px;
}
</style>
