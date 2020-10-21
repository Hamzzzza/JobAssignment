
<template>
    <nav class="navbar navbar-expand-md navbar-light bg-primary navbar-laravel  cls">
        <div class="container">
            <router-link class="navbar-brand" to="/">Job Assignment</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <template v-if="!currentUser">
                        <li>
                            <router-link to="/login" class="nav-link">Login</router-link>
                        </li>
                        <li>
                            <router-link to="/register" class="nav-link">Register</router-link>
                        </li>
                    </template>
                    <template v-else>

                        <template v-if="currentUser.designation=='1'">
                       
                      
                           
                         <li>
                            <router-link to="/teacher/addTask" class="nav-link" >AddTasks</router-link>
                        </li> 

                        
                         <li>
                            <router-link to="/teacher/assignCourse" class="nav-link" >AssignCourse</router-link>
                        </li>


                            <li>
                            <router-link to="/teacher/" class="nav-link" >Courses</router-link>
                        </li>
                        
               
                           <li>
                            <router-link to="/chat" class="nav-link" >Chat</router-link>
                        </li>

                        
                          </template>

                            




                            <template v-else>
                           <li>
                            <router-link to="/task/" class="nav-link" >Courses/Tasks</router-link> 
                            
                            <!-- /studentcourses -->
                            </li>
                             <li>
                            <router-link to="/task/studentcourses" class="nav-link" >MyCourses</router-link> 
                            
                           
                            </li>
                            <li>
                            <router-link to="/chat" class="nav-link" >Chat</router-link>
                             </li>
                            
                          </template>


                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                {{ currentUser.name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="#!" @click.prevent="logout" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                       


                        
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: 'app-header',
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        }
    }
</script>


<style scoped>

.cls{

    margin-bottom: 4rem;
}

</style>