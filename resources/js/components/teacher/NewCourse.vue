<template>
    <div class="customer-new">
        <form @submit.prevent="add">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td>
                        <input type="text" class="form-control" v-model="course.name" placeholder="Customer Name"/>
                    </td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>
                        <input type="text" class="form-control" v-model="course.description" placeholder="Customer Description"/>
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
        <div class="errors" v-if="errors">
            <ul>
                <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                    <strong>{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import validate from 'validate.js';

    export default {
        name: 'NewCourse',
        data() {
            return {
                course: {

                    name: '',
                    description: '',
                },
                errors: null
            };
        },
        methods: {
            add() {
                this.errors = null;

                const constraints = this.getConstraints();

                const errors = validate(this.$data.course, constraints);
                if(errors) {
                    this.errors = errors;
                    return;
                }

                axios.post('/api/Courses/new', this.$data.course  )
                    .then((response) => {
                        this.$router.push('/teacher');
                    });
            },
            getConstraints() {
                return {
                    name: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'Must be at least 3 characters long'
                        },
                    },
                  
                   description: {
                        presence: true,
                        
                    }


                };
            }
        }

    }
</script>

<style>
.errors {
    background: lightcoral;
    border-radius:5px;
    padding: 21px 0 2px 0;
}
</style>

