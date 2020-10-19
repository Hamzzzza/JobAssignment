<template>
   
   <div>
           
                      
                
                       
 
                      <template v-if="currentUser.designation=='1'">
                        <div class="container">


                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card card-default">
                                                        
                                        <div class="card-header">Teacher Management</div>


                                        <div class="card-body">
                                            <h2>Teacher's Dashboard</h2>
                                            <img src="../../../public/imagestwo.jpg" >
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                            </template>


                            <template v-else>

                                                        <div class="container">


                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card card-default">
                                                        
                                        <div class="card-header">Student Management</div>


                                        <div class="card-body">
                                            <h2>Student's Dashboard</h2>
                                            <img src="../../../public/imagesone.jpg">
                                        </div>


                                        



                                    </div>
                                </div>
                            </div>
                        </div>




                              </template>



       

   </div>
       

         





</template>

<script>
    export default {
        name: 'home',
        computed: {
           currentUser() {
                return this.$store.getters.currentUser
            }
        }
    }
</script>
