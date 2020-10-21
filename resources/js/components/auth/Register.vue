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
                         <label for="desgination" class="b">Teacher  </label> 
                           <input class="a" type="radio"  v-model="form.designation" value="1" >
                             <label for="desgination" class="k">   Student  </label>
                           <input class="a" type="radio"  v-model="form.designation" value="0" >
  
                       
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
                     <div class="form-group row d">
                     <button v-google-signin-button="clientId" class="btn btn-info btn-block my-4">Register with Google</button>
                     </div>


                                     <div class="errors" v-if="errors">
                                                            <ul>
                                                                <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                                                                    <strong>{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                                                                </li>
                                                            </ul>
                                                        </div>
                </div>
            </div>
        </div>


   
    

    </div>

   


</template>

<script>
    import {register} from '../../helpers/auth';
    import {googleLoginRegister} from '../../helpers/auth';
    import {setToken} from '../../helpers/auth';
    import GoogleSignInButton from 'vue-google-signin-button-directive';

    import validate from 'validate.js';
    export default {
        name: "register",

         directives: {
    GoogleSignInButton
          },
        data() {
            return {
                form: {
                    name:'',
                    email: '',
                    password: '',
                    designation:'0'

                },
                clientId: '6437600041-aelnie3o1icmg1105ecnkcbhk98tugnu.apps.googleusercontent.com',
                errors: null
            };
        },

        methods: {
            authenticate() {
                
                
               
                this.errors = null;

                const constraints = this.getConstraints();
                const errors = validate(this.$data.form, constraints);
                if(errors) {
                    this.errors = errors;
                    return;
                }

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



              OnGoogleAuthSuccess (idToken) {
                        // Receive the idToken and make your magic with the backend
                       



                        googleLoginRegister(idToken)
                        .then((res) => {
                        
                               this.form.name=res.name;
                               this.form.email=res.email;
                                this.form.password="secretsecret";

                                  axios.post('/api/auth/googlelogin', this.form)
                                    .then((response) => {
                                       this.$store.dispatch('login');
                                       setToken(response.data.access_token);
                                       this.$store.commit("loginSuccess", response.data);
                                       //alert("Registration Successfull")
                                       this.$router.push({path: '/'});
                                       
                                    })
                                    .catch((err) =>{
                                        
                                        console.log("Wrong Credentials");
                                    })

                            })
                            .catch((error) => {
                           
                                this.$store.commit("wrong credentials", {error});
                            });




                        },


                        OnGoogleAuthFail (error) {
                        console.log(error)
                        },
                        
        

             getConstraints() {
                return {
                    name: {
                        presence: true,
                        length: {
                            minimum: 5,
                            message: 'Must be at least 5 characters long'
                        },
                    },
                      email: {
                        presence: true,
                    },
                  
                   password: {
                        presence: true,
                         length: {
                            minimum: 9,
                            message: 'Must be at least 9 characters long'
                        },
                    }


                };
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
.d{
    margin-top:-3rem;
}.k{
    margin-left: 5px;
     margin-right: 1rem;
}
</style>

