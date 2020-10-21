<template>

    <div class="customer-new">
         <div class="card-header" style="text-align:center;">Assign Course</div>
        <form @submit.prevent="add">
            <table class="table">
                <tr>
                    <th>Select Student</th>
                    <td>
            
            
                            <select class='form-control' v-model='a' required>
                                <option value='0' disabled selected >Plz Select Student</option>
                                <option v-for='student in this.students' :key="student.id"  :value='student.id'>{{ student.name }}</option>
                            </select>
      
                    </td>
                </tr>
                <tr>
                    <th>Select Course</th>
                    <td>
                                <select class='form-control' v-model='b' required>
                                <option value='0' disabled selected >Plz Select Course</option>
                                <option v-for='course in this.courses' :key="course.id"  :value='course.id'>{{ course.name }}</option>
                                </select> 
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <router-link to="/teacher/" class="btn">Cancel</router-link>
                    </td>
                    <td class="text-right">
                        <input type="submit" value="Create" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</template>





<script>
    export default {
        name: 'AssignCourse',
       
        created() {


            axios.get("/api/Courses").then((response) => {
                  
                        this.courses=response.data.courses
                        this.students=response.data.students
             
                    });


        },




        methods: {
            add() {
                
                
                this.course.user_id=this.a;
                this.course.course_id=this.b;
             
 
             
                axios.post('/api/Courses/enrollstudent', this.course)
                    .then((response) => {
                        alert("student enrolled");
                        this.$router.push('/teacher');
                    });
            },
        },



        data() {
            return {
                course: {
                  
                    user_id: '',
                    rel: 'enroll',
                    course_id:''
                },
                a:'',
                b:'',
                courses: [],
                students:[]
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
