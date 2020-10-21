<template>
    <div>
      <div class="card-header" style="text-align:center;">Course wise Assignments/Tasks</div>

           

         <div id="accordion">


          <div class="card"    v-for="task in tasks" :key="task.id">
            <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#collapseOne">
            <th>Course : <b>{{task.course.name}}</b></th> 
            <th style="float:right;">Status : {{task.rel}}</th>  
            </a>
            </div>
            <div id="collapseOne" class="collapse show" data-parent="#accordion">
            <div class="card-body">

                <table class="table" v-if="task.assignment.length">
            <thead>
                <th>Title</th>
                <th>Description</th>
                <th>DueDate</th>
            </thead>
            <tbody>
                 
                 <tr v-for="assignment in task.assignment" :key="assignment.id">
            
                        <td>{{ assignment.title }}</td>
                        <td>{{ assignment.description }}</td>
                        <td>{{ assignment.due_date }}</td>

                        </tr>

                           </tbody>
                       </table>
                </div>
                </div>
            </div>


            </div>


    </div>
</template>

<script>
    export default {
        name: 'list',


        
        created() {

           axios.get('/api/Assignments')
            .then((response) => {
                
                this.tasks=response.data.assignments;
             

            })
        
        },
         data() {
            return {
              
                tasks:[]
            };
        },
        computed: {
            // tasks() {
            //     return this.$store.getters.tasks;
            // }
        }
    }
</script>

<style scoped>
.btn-wrapper {
    text-align: right;
    margin-bottom: 20px;
}
</style>
