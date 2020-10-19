<template>
    <div class="customer-view" >
        <!-- <div class="user-img">
            <img src="https://www.scottsdaleazestateplanning.com/wp-content/uploads/2018/01/user.png" alt="">
        </div> -->
   

        <div class="user-info" v-if="course">
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




              

              <div class="customer-new">
        <form @submit.prevent="add">
            <table class="table">
                <tr>
                    <th>Task title</th>
                    <td>
                        <input type="text" class="form-control" v-model="assignment.title" placeholder="Task Title"/>
                    </td>
                </tr>
                <tr>
                    <th>Task Description</th>
                    <td>
                        <input type="text" class="form-control" v-model="assignment.description" placeholder="Task Description"/>
                    </td>
                </tr>
            
                
                <tr>
                 
                    <td class="text-right">
                        <input type="submit" value="CreateTask" class="btn btn-info btn-block my-4 f">
                    </td>
                </tr>
            </table>
        </form>

        </div>











           <table class="table" v-if="tasks" >
            <thead>
              
                <th>Title</th>
                <th>Description</th>
            </thead>
            <tbody>
               <tr v-for="task in tasks" :key="task.id">
                        <td>{{ task.title }}</td>
                        <td>{{ task.description }}</td>
                        <!-- <td>
                            <router-link :to="`/tasks/${task.id}`">View task</router-link>
                        </td> -->
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
                

                axios.post(`/api/Courses/newTask/${this.$route.params.id}`, this.$data.assignment  )
                    .then((response) => {
                        alert("task added");
                        this.$router.push('/teacher');
                    });
            },
        },



        data() {
            return {
                assignment: {
                     
                    title: '',
                    description: '',
                },
                course: null,
                tasks:[]
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
            courses() {
                return this.$store.getters.courses;
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
}
</style>
