<template>
    <div class="customer-view" >
   

        <div class="user-info l" v-if="course">
            <table class="table">
                <tr>
                    <th>CourseName</th>
                    <td>{{ course.name}}</td>
                </tr>
                <tr>
                    <th>CourseDescription</th>
                    <td>{{ course.description }}</td>
                </tr>
            
                
            </table>





          

          <div class="card-header j" style="text-align:center;">CourseTask</div>
           <table class="table" v-if="tasks" >
            <thead>
              
                <th>Title</th>
                <th>Description</th>
                 <th>Due_Date</th>
                  <th>Total_Marks</th>
            </thead>
            <tbody>
               <tr v-for="task in tasks" :key="task.id">
                        <td>{{ task.title }}</td>
                        <td>{{ task.description }}</td>
                        <td>{{ task.due_date }}</td>
                        <td>{{ task.total_marks }}</td>
                            <!-- <router-link :to="`/tasks/${task.id}`">Delete</router-link> -->
                       
                    </tr>
                </tbody>
            </table>


        
              <router-link class="bt" to="/teacher/">Back to all courses</router-link>

        </div>







    </div>
</template>

<script>
    export default {
        name: 'AssignmentView',
       
        created() {
    


                axios.get(`/api/Courses/${this.$route.params.id}`,{
                    headers:{
                    "Authorization":`Bearer ${this.currentUser.token}`
                }
                })
                    .then((response) => {
                        this.course = response.data.course
                      
                    });
            


            axios.get(`/api/Courses/Assignment/${this.$route.params.id}`,{
                headers:{
                    "Authorization":`Bearer ${this.currentUser.token}`
                }
                })
                    .then((response) => {
                        this.tasks = response.data.tasks
                    });



        },




        methods: {
            add() {
                

                axios.post('/api/Courses/newTask', this.assignment,{
                headers:{
                    "Authorization":`Bearer ${this.currentUser.token}`
                }
                }  )
                    .then((response) => {
                        alert("task added");
                        this.$router.push('/teacher');
                    });
            },
        },



        data() {
            return {
               
                course: null,
                tasks:[]
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        }
    }
</script>

<style scoped>
.customer-view {
    display: flex;
    align-items: center;
}
.user-img {
    flex: 1;
}
.user-img img {
    max-width: 160px;
}
.user-info {
    flex: 3;
    overflow-x: scroll;
}
.bt{
    margin-left: 10px;
}.f{
    
   margin-left: 7rem;
}.j{
    margin-top:5rem;
}
.l{
    margin-bottom: 5rem;
}
</style>
