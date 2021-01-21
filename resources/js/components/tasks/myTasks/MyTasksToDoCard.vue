<template>
    <div class="card border-light my-tasks-card" > 
        <!-- or style="width: 20rem;" -->
        <div class="card-body">
            <h5 class="card-title my-tasks-card-title">To Do Tasks</h5>
            <hr class="hr-line">

            <div  v-if="this.todos.length ==0"> 
                <span>
                    There is NO To Do tasks yet 
                </span>
            </div>

            <div  v-for="(todo, index) in this.todos" :key="todo.id[index]">
                <!-- create a separate component for each list item, 
                so you would have a component that accepts an item as a prop, 
                then each component can have it's own isActionToolShowen value to show tools sepatelly -->
               <single-todo :todo="todo" :index="index" :title="title"></single-todo>
                <hr> 
                <!-- title of tab passed from props -->
                <pm-new-task-modal  
                    v-if="title =='overdue'"
                    actionShow="show" :modalId="'EditTaskModal'+todo.id" 
                    :taskInfo="todo" >
                </pm-new-task-modal>

                 <pm-new-task-modal  
                    v-else
                    actionShow="update" :modalId="'EditTaskModal'+todo.id" 
                    :taskInfo="todo" >
                </pm-new-task-modal>
            </div> 
        </div>
    </div>
</template>

<script>
 import NewTask from './CreateNewTaskModal.vue';
//  import SingleToDo from './SingleToDo.vue';
import SingleToDo from './SingleToDo';

export default {
    props:['todos', 'title'],
    components: { 
        'pm-new-task-modal': NewTask,
        'single-todo': SingleToDo,
    },
}
</script>