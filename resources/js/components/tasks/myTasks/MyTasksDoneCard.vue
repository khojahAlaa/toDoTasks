<template >
    <div v-show="this.showDoneCard" class="card border-light my-tasks-card" >
        <div class="card-body">
            <h5 class="card-title my-tasks-card-title">Done Tasks</h5>
            <hr class="hr-line">
            <div  v-if="this.dones.length ==0 "> 
                <span>
                    There is NO Done tasks yet 
                </span>
            </div>
            <div  v-for="(done, index) in this.dones" :key="done.id[index]" :id="done.id">
                <div class="row single-task">
                    <div class="col-10 col-md-10  task-info" >
                        <span class="text-left" style="margin-left: 10px;">
                            {{done.name}}
                        </span>
                        <br>
                        <small class="label label-info text-left" style="margin-left: 30px;">
                            <i class="fas fa-hourglass-end"></i> 
                             {{done.dueDate | dateFormat}}
                        </small>
                    </div>
                    <!-- <div class="col-md-1 text-right">
                        </div> -->
                    <div class="col-2 col-md-2 " style="margin-top: 10px;">
                        <div class="tools text-right" >
                            <i class="cntr" :id="done.id">
                                <label  class="label-cbx">
                                <input :id="done.id" type="checkbox" class="invisible" 
                                v-model="done.is_done" @click="checkboxToggle(index, done)" >
                                <div class="checkbox" :id="done.id">
                                    <svg width="20px" height="20px" viewBox="0 0 20 20">
                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                    <polyline points="4 11 8 15 16 6"></polyline>
                                    </svg>
                                </div>
                                </label>
                            </i>
                        </div>
                    </div>
                    
                    <a :id="done.id"  @click.prevent="openTaskDialog(done.id)" data-toggle="modal" data-target="#EditTaskModal">
                        <i :id="done.id" class="fas fa-eye" style="font-size:20px;"></i>
                    </a>

                    <pm-new-task-modal  
                        actionShow="show" 
                        :modalId="'EditTaskModal'+done.id" 
                        :taskInfo="done">
                    </pm-new-task-modal>
                    
                </div>
                <hr>
            </div>
        </div>
    </div>
</template>
<script>
import NewTask from './CreateNewTaskModal.vue';
export default {
    props:['dones','showDoneCard'],
    components: { 
        'pm-new-task-modal': NewTask,
     },
    data(){
        return{
            show: true,
        }
    },
    methods: {
        checkboxToggle (index, done ) {
            axios.patch(`/myCreatedTasks/${done.id}`, {
                is_done: !done.is_done
            })
            .then((response) => {
                this.$emit('donetogg', index, done);
                // console.log(response)
            });
            // console.log(done.id);
        },
        openTaskDialog(id){
            $('#EditTaskModal'+id).modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            });
        }
    },
}
</script>