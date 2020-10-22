<template>
    <div class="login row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">login</div>
                <div class="card-body">
                    <form @submit.prevent="authenticate">
                        <div class="form-group row">
                            <label for="email">Email:</label>
                            <input type="email" v-model="form.email" class="form-control" placeholder="Email Address" required>
                        </div>
                        <div class="form-group row">
                            <label for="password">Password:</label>
                            <input type="password" v-model="form.password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group row">
                            <input type="submit" value="Login" class="btn btn-info btn-block my-4">
                        </div>
                        
                        <div class="form-group row" v-if="authError">
                            <p class="error">
                                {{ authError }}
                            </p>
                        </div>
                    </form>
                     <div class="form-group row d">
                     <button v-google-signin-button="clientId" class="btn btn-info btn-block my-4">Login with Google</button>
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
    import {login} from '../../helpers/auth';
    import {gmail} from '../../helpers/auth';
    import validate from 'validate.js';
    import {googleLoginRegister} from '../../helpers/auth';
    import {setToken} from '../../helpers/auth';
    import GoogleSignInButton from 'vue-google-signin-button-directive';


    export default {
        name: "login",
        
      
         
    directives: {
    GoogleSignInButton
          },

        data() {
            return {
                form: {
                    email: '',
                    password: '',
    
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
                 
                this.$store.dispatch('login');

                login(this.$data.form)
                    .then((res) => {
                        this.$store.commit("loginSuccess", res);
                                       this.$router.push({path: '/'});
                    })
                    .catch((error) => {
                        this.$store.commit("loginFailed", {error});
                    });
            },
            


            
            
                      OnGoogleAuthSuccess (idToken) {
                        // Receive the idToken and make your magic with the backend
                        //console.log(idToken)
                        googleLoginRegister(idToken)
                        .then((res) => {
                                 
                            this.$store.dispatch('login');
                            
                                this.form.email=res.email;
                                this.form.password="secretsecret";
                                
                                  axios.post('/api/auth/googlelogin', this.form)
                                    .then((response) => {
                                        console.log(response.data.access_token)
                                        setToken(response.data.access_token);
                                       this.$store.commit("loginSuccess", response.data);
                                       this.$router.push({path: '/'});
                                       
                                    })
                                    .catch((err) =>{

                                        console.log("Wrong Credentials plz register first");
                                        alert('Wrong Credentials plz register first')
                                         this.$router.push({path: '/register'});
                                    })

                            })
                            .catch((error) => {
                                this.$store.commit("wrong credentials", {error});
                               
                            });




                        },


                        OnGoogleAuthFail (error) {
                        console.log(error)
                        },







                       
           gmailLogin() {
            //const newWindow = openWindow('', 'message')
              axios.get('/api/auth/google')
                    .then(response => {
                    //     if(response.data){
                    //   console.log(res.data);
                    //     }
                        if(response.data.url){
                      window.location.href = response.data.url;
                        }
                        
                       
                    }).then(res=>{
                            //console.log(this.$route.query.code);
                    })
                    .catch(function (error) {
                      //console.error(error);
                    });
                        },










           


                         
             getConstraints() {
                return {
                 
                      email: {
                        presence: true,
                    },
                  
                   password: {
                        presence: true,
                     
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
</style>

