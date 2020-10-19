<template>
    <div class="login row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form @submit.prevent="authenticate">
                          <div class="form-group row">
                            <label for="email">name:</label>
                            <input type="text" v-model="form.name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group row">
                            <label for="email">Email:</label>
                            <input type="email" v-model="form.email" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="form-group row">
                            <label for="password">Password:</label>
                            <input type="password" v-model="form.password" class="form-control" placeholder="Password">
                        </div>
                         <div class="form-group row">
                         <label for="desgination" class="b">Teacher  </label> <input class="a" type="checkbox"  v-model="form.designation" value="1" >
                        </div>
                        <div class="form-group row">
                            <input type="submit" value="Register" class="btn btn-info btn-block my-4">
                        </div>
                        <div class="form-group row" v-if="authError">
                            <p class="error">
                                {{ authError }}
                            </p>
                        </div>
                    </form>
                     <form @submit.prevent="gmailLogin" >
                    <div class="form-group row">
                            <input type="submit" value="Register with Gmail" class="btn btn-info btn-block my-4">
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {register} from '../../helpers/auth';

    export default {
        name: "register",
        data() {
            return {
                form: {
                    name:'',
                    email: '',
                    password: '',
                    designation:"0"

                },
                error: null
            };
        },
        methods: {
            authenticate() {
                
                register(this.$data.form)
                    .then((res) => {
                         alert("User Registered plz login");
                        this.$router.push({path: '/login'});


                    })
                    .catch((error) => {
                         alert("User Registration failed : Try again");
                        this.$store.commit("loginFailed", {error});
                    });
            },


            gmailLogin() {
            //const newWindow = openWindow('', 'message')
              axios.get('/api/auth/google')
                    .then(response => {

                        if(response.data.url){
                      window.location.href = response.data.url;
                        }
                        
                       

                    }).then(res=>{
                            console.log(this.$route.query.code);
                    })
                    .catch(function (error) {
                      console.error(error);
                    });
                        },


                        
        },
        computed: {
            authError() {
                return this.$store.getters.authError;
            }
        }
    }
</script>

<style scoped>
.error {
    text-align: center;
    color: red;
}
.a{
    margin-top: 5px;
}
.b{
    margin-right: 1rem;
}
</style>

