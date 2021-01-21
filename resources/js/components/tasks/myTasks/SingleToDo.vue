<template>
    <div>
        <div class="row single-task" :id="index"  @mouseenter="showActionTools(index)" @mouseleave="hideActionTools(index)">
                <div class="col-8 col-md-8 task-info" >
                    <span class="text-left" style="margin-left: 10px;">
                        {{todo.name}}
                    </span>
                    <br>
                    <small class="label label-info text-left" style="margin-left: 30px;">
                        <i class="fas fa-hourglass-end"></i> 
                        {{todo.dueDate | dateFormat}}
                    </small>
                </div>
                <div class="col-4 col-md-4" style="margin-top: 10px;">
                    <div class="tools text-right " v-show="isActionToolShowen"  >
                        <!-- <input type="checkbox"  value="" style="color:#5DD1E2; width: 20px;height: 13px;"> -->
                        <!-- // source codepen https://codepen.io/avstorm/pen/Mowqre -->
                        <div calss="raw" v-if="title =='overdue'">
                            <a :id="todo.id"  @click.prevent="openTaskDialog(todo.id)" data-toggle="modal" data-target="#EditTaskModal">
                                <i :id="todo.id" class="fas fa-eye" style="font-size:20px;"></i>
                            </a>
                        </div>
                        <div calss="raw" v-else>
                            <div class="col-md-3">
                                <i class="cntr" :id="todo.id">
                                    <label  class="label-cbx">
                                    <input :id="todo.id" type="checkbox" class="invisible" v-model="todo.is_done" @click="checkboxToggle( index, todo)">
                                    <div class="checkbox" :id="todo.id">
                                        <svg width="20px" height="20px" viewBox="0 0 20 20">
                                        <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                        <polyline points="4 11 8 15 16 6"></polyline>
                                        </svg>
                                    </div>
                                    </label>
                                </i>
                            </div>
                            
                        <!-- <div class="col-md-3"> -->
                        <a :id="todo.id"  @click.prevent="openTaskDialog(todo.id)" data-toggle="modal" data-target="#EditTaskModal">
                            <i :id="todo.id" class="fa fa-edit" style="font-size:20px;"></i>
                        </a>
                        <!-- </div>
                        <div class="col-md-3"> -->
                        <a :id="todo.id" @click.prevent="deleteTask(todo.id, index)" >
                            <i class="fa fa-trash" style="font-size:20px;" ></i>
                        </a>
                        <!-- </div> -->
                        </div>  
                        
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
import eventBus from '../../../event-bus';
export default {
    props:['todo', 'index', 'title'],
    data() {
        return {
            isActionToolShowen: false, 
        }
    },
    methods: {
        checkboxToggle (index, todo) {
            axios.patch(`/myCreatedTasks/${todo.id}`, {
                    is_done: !todo.is_done
                }).then((response) => {
                    console.log(index)
                    console.log(todo)
                    // this.$emit('donetogg', index,todo);
                    eventBus.$emit('donetogg', index,todo);
                });
            // console.log(todo.id);
        },
        showActionTools(index){
            this.isActionToolShowen = !this.isActionToolShowen;  
            //  console.log(index);
        },
        hideActionTools(index){
            this.isActionToolShowen = false;
            // console.log(this.isActionToolShowen);
        },
        openTaskDialog(id){
            $('#EditTaskModal'+id).modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            });
        
        },
        deleteTask(id, index){
            this.$toast.question('Are you sure ?', "Confirm", {
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'Hey',            
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>', (instance, toast) => {
                        
                        axios.delete(`/myCreatedTasks/${id}`)
                        .then(({data}) => {
                                this.$toast.show(data.message, "Success", {position: "topCenter"},{timeout: 2000},{balloon: true});
                            // this.$emit('deleted',index)
                                eventBus.$emit('deleted',index)
                        })
                        .catch(error =>console.log(error));
                        
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }, true],
                    ['<button>NO</button>', function (instance, toast) {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }],
                ]            
            });
        },
    }
}
</script>