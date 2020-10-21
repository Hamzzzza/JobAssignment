<template>

    <div class="customer-new">
         <div class="card-header" style="text-align:center;">Add Assignment/Task</div>
        <form @submit.prevent="add">
            <table class="table">
            
                <tr>
                    <th>Select Course</th>
                    <td>
                                <select class='form-control' v-model='a' required>
                                <option value='0' disabled selected >Plz Select Course</option>
                                <option v-for='course in this.courses' :key="course.id"  :value='course.id'>{{ course.name }}</option>
                                </select> 
                    </td>
                </tr>
                 

                  <tr>
                    <th>Assignment/Task Title</th>
                    <td>
                        <input type="text" class="form-control" v-model="assignment.title" placeholder="Assignment/Task Title" required/>
                    </td>
                </tr>
                <tr>
                    <th>Assignment/Task Description</th>
                    <td>
                        <input type="text" class="form-control" v-model="assignment.description" placeholder="Assignment/Task Description" required/>
                    </td>
                </tr>
            
                  <tr>
                    <th>Marks</th>
                    <td>
                        <input type="number" class="form-control" v-model="assignment.total_marks" placeholder="Assignment/Task Marks" required/>
                    </td>
                </tr>


                 <tr>
                    <th>Due Date</th>
                    <td>
                        <input type="date" class="form-control" v-model="assignment.due_date" placeholder="Due Date"/>
                    </td>
                </tr>
                     


                <tr>
                    <td>
                        <router-link to="/teacher/" class="btn">Cancel</router-link>
                    </td>
                    <td class="text-right">
                        <input type="submit" value="CreateAssignment" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</template>





<script>
    export default {
        name: 'AddAssignment',
       
        created() {


            axios.get("/api/Courses").then((response) => {
                        
                        this.courses=response.data.courses
                   
                    });


        },




        methods: {
            add() {
                
                
                this.assignment.course_id=this.a;
             
               console.log(this.assignment.data)
             
                axios.post('/api/Courses/addassignment', this.assignment)
                    .then((response) => {
                        alert("Assignment/Task Added");
                        this.$router.push('/teacher');
                    });
            },
        },



        data() {
            return {
                assignment:{
                    title:'',
                    description:'',
                    total_marks:0,
                    due_date:''
                },
                a:'',
                courses: []
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
           
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
