<template>
    <div >
     <h1>login with gmail : please wait</h1>
    </div>
</template>


<script>


    export default {
        name: "LoginGmail",
        
        created(){
           this.getLogin();
        },

        methods: {
     

             getLogin() {

               this.$store.commit("loginSuccess", this.$route.query.code);
               alert("login with gmail");
               this.$router.push({path: '/'});

                
            },


           


        }
    }






</script>

<style scoped>
</style>

