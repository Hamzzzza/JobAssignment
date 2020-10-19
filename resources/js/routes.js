import Home from './components/Home.vue';
import Login from './components/auth/Login.vue';

import Register from './components/auth/Register.vue';
import LoginGmail from './components/auth/LoginGmail.vue';

import StudentsMain from './components/students/Main.vue';
import CoursesLists from './components/students/List.vue';
import StudentCourses from './components/students/StudentCourses.vue';

import ChatApp from './components/chat/ChatApp.vue';

import TeacherMain from './components/teacher/TeacherMain.vue';
import CourseList from './components/teacher/CourseList.vue';
import NewCourse from './components/teacher/NewCourse.vue';
import AssignmentView from './components/teacher/AssignmentView.vue';
//import CourseAssignment from './components/students/View.vue';
//import NewCustomer from './components/students/New.vue';


export const routes=[
    {
        path:'/',
        component: Home,
        meta:{
            requiresAuth:true
        }
    },
    {
        path:'/chat',
        component: ChatApp,
        meta:{
            requiresAuth:true
        }
    },
    {
        path:'/login',
        component:Login
    },
    {
        path:'/register',
        component:Register
    },
    {
       path:'/api/auth/logins',
       name:'LoginGmail',
       component:LoginGmail,
    //    props: (route) => ({ foo: route.query.code }) 

    },

    {
        path: '/task',
        component: StudentsMain,
        meta: {
            requiresAuth: true
        },


        children: [
            
            {
                path: '/task/studentcourses',
                component: StudentCourses
            },
            {
                path: '/task/',
                component: CoursesLists
            }
        ]
        

    },
    
    {
        path: '/teacher',
        component: TeacherMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/teacher/',
                component: CourseList
            },
            
                {
                    path: '/teacher/addcourse',
                    component: NewCourse
                },

                {
                    path: '/teacher/tasks/:id',
                    component: AssignmentView
                }
         
        ]


    }



];