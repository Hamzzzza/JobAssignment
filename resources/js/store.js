import { getLocalUser } from "./helpers/auth";


const user=getLocalUser();

export default {
    state:{
        
        currentUser:user,
        //!!for bool
        usLoggedIn:!!user,
        auth_errors:null,
        students:[],
        courses:[],
        course:null,

        tasks:[],
        coursetasks:[],

        teacherCourses:[],
        studentCourses:[],
        welcomeMessage:'welcome to my vue app'
    },
    getters:{
             
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        tasks(state) {
            return state.tasks;
        },
        welcome(state){
            return state.welcomeMessage;
        },
        courses(state){
            return state.courses;
        },

        coursetask()
        {
                   return state.coursetasks;
        }




    },
    mutations:{



        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.access_token});

            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;
        },




        updateTasks(state, payload) {
            state.tasks = payload;
        },
        updateCourses(state, payload) {
            state.courses = payload;
        },

        
        updateSingleCourse(state, payload) {
            state.course = payload;
        },

        updateCourseTasks(state, payload)
        {
            state.coursetasks = payload;
        }



    },





    actions:{


        login(context) {
            context.commit("login");
        },
        
        getTasks(context) {
            axios.get('/api/Assignments',{
                headers:{
                    "Authorization":`Bearer ${context.state.currentUser.token}`
                }
            })
            .then((response) => {
                context.commit('updateTasks', response.data.assignments);
            })
        },


             
       
        getCourses(context) {
            axios.get('/api/Courses',{
                headers:{
                    "Authorization":`Bearer ${context.state.currentUser.token}`
                }
            })
            .then((response) => {
                context.commit('updateCourses', response.data.courses);
            })
        }
         



         

        

            


    }
}