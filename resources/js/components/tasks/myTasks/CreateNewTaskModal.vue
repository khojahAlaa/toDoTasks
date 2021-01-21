<template>
    <div class="modal fade" :id="modalId" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5  class="modal-title" id="exampleModalLongTitle">{{modelTitle}} </h5>
                   
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row justify-content-center"> 
                        <div class="form-inputs">
                            <ValidationProvider ref='reset1' mode="eager" name="Task name" rules="required|min:4" v-slot="{ errors,classes }">
                                <input v-model="task.name" type="text" :class="classes" name="task name" class="form-control" placeholder="Task Name" v-if="actionShow== 'update' || actionShow== 'createT'">
                                <input v-model="task.name" type="text" :class="classes" name="task name" class="form-control" placeholder="Task Name" v-else disabled>
                                <span  class="warning">{{ errors[0] }}</span>
                            </ValidationProvider>
                            <ValidationProvider ref='reset2' mode="eager" name="Task Description" rules="required|min:4" v-slot="{ errors,classes }">
                                <textarea :class="classes" v-model="task.description" rows="2" class="form-control" placeholder="Task Description" v-if="actionShow== 'update' || actionShow== 'createT'"></textarea>
                                <textarea :class="classes" v-model="task.description" rows="2" class="form-control" placeholder="Task Description" v-else disabled></textarea>
                                <span class="warning">{{ errors[0] }}</span>
                            </ValidationProvider>
                            <!-- <vc-calendar  v-model="date" color="red" /> -->
                            
                            <!--  <input type="date"  v-model="date" class="form-control" id="" placeholder="Task date"> 
                        -->
                        <!-- <datepicker v-model="date" format="yyyy-MM-dd" name="uniquename"></datepicker> -->
                        <br>
                        <ValidationProvider ref='reset3' mode="eager" name="Task deu date" rules="required|min:4" v-slot="{ errors,classes }">
                            <p class="text-muted titel-3 text-center" v-if="task.dueDate" >
                                <span class="fa-stack fa-lg" >
                                    <i class="fa fa-circle fa-stack-2x" style="color:#F0F4FF;"></i>
                                    <i class="fas fa-hourglass-end fa-stack-1x fa-inverse"></i>
                                </span>
                                Due Date is:  
                                <span style="color: #707070;">{{task.dueDate | dateFormat}}</span>   
                            </p>
                        
                            <p class="text-muted titel-3 text-center" :class="classes" v-else>
                                    Select Due Date 
                            </p>

                            <span class="warning">{{ errors[0] }}</span>
                        </ValidationProvider>
                        
                            <div class="row" v-if="actionShow== 'update' || actionShow== 'createT'">
                                <div class="col-md-4">
                                    <button class="date-btn" @click="todayDate">Today</button>
                                </div>
                                <div class="col-md-4">
                                    <button class="date-btn" @click="tomorrowDate">Tomorrow</button>
                                </div>
                                <div class="col-md-4">
                                    <vc-date-picker 
                                        locale="en" placeholder="Someday" color="indigo"
                                        :min-date="new Date()"
                                        model-config="{type: 'string', mask: 'YYYY-MM-DD}"
                                        title-position="left" 
                                        v-model="somedate" style="width: 125px;" is-expanded
                                    >
                                        <template v-slot="{ inputValue, inputEvents }">
                                            <input placeholder="Someday" style="height: 60px; width: 125px; padding: 1px;"
                                            :value="inputValue" v-on="inputEvents"/>
                                        </template>
                                    </vc-date-picker>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form v-if="actionShow== 'update' || actionShow== 'createT'"
                class=" " @submit.prevent="modelAction" enctype="multipart/form-data">
                    <button @click="modelAction" :class="buttonAction" data-dismiss="modal" :disabled="isDisabled" >
                        {{buttonName}}
                    </button>
                </form>
                
            </div>
        </div>
    </div>
    
</template>
<script>
import eventBus from '../../../event-bus';
import Datepicker from 'vuejs-datepicker';
import { ValidationProvider,ValidationObserver, extend ,configure, setInteractionMode} from 'vee-validate';
import { required, min } from 'vee-validate/dist/rules';
extend('required', {
  ...required,
  message: '* {_field_}  field is required'
});
extend('min', {
  ...min,
  message: '* {_field_} Must be more than {length} character'
});
configure({
  classes: {
    valid: 'is-valid',
    invalid: 'is-invalid',
    dirty: ['is-dirty', 'is-dirty'], // multiple classes per flag!
  }
});
setInteractionMode('eager');

export default {
    data: function (){
        return{
            task:{
                name:"",
                description:"",
                dueDate: "",
                isDone:"",
                id:"", 
            },
            somedate:"",
        }
    },
    components: { Datepicker, ValidationProvider, ValidationObserver},
    props:[ 'actionShow', 'taskInfo', 'modalId'],
    
    created(){
        //to show task info in modal 
        if(this.taskInfo){
            this.task=this.taskInfo
        }  
        // eventBus.$on('donetogg',(index,task)=>{
        //     //  console.log("this.taskInfo");
        //     for (const task in this.taskInfo) {
        //     console.log(`${task}: ${this.taskInfo[task]}`);
           
        //   }
          
    },
    computed:{
        modelTitle(){
            if(this.actionShow=='createT'){
                return 'Create New Task';
            }
            else if(this.actionShow=='update'){
                return 'Update Task';
            }
            else
              return 'Show Task Info';
            },
        modelAction(){
            if(this.actionShow=='createT'){
                return this.createTask;
            }
            // else if(this.actionShow=='update'){
            //     return  this.updateTask;
            // }
            else
              return  this.updateTask;
            },
        buttonAction(){
            if(this.actionShow=='createT'){
                return 'add-button';
            }
            else
                return  'save-change-button';
            },
        buttonName(){
        if(this.actionShow=='createT'){
            return 'Create';
        }
        else
            return  'Update';
        },
        isDisabled() {
            return !this.task.name || !this.task.description || !this.task.dueDate ;
        }
    },
    watch:{
        //watch somedate datepicker selection and then assigned to duedate
        somedate: function(d){
           if(d){
                var day = d.getDate()
                var month = d.getMonth() + 1
                var year = d.getFullYear()
                this.task.dueDate= year + "/" + month + "/" + day;
           }
           return '';
            
        }, 
        // watch the change of prpos passed from (MyTasks) --> to (MyTasksToDoCard)
        // and then fire and fill the task in data with updated value to lunch modal with  (information of task)
        taskInfo: function(newVal, oldVal){
             this.task=this.taskInfo;
             console.log("change");
        }, 
    },
    methods:{
        createTask(){
            axios.post(`/myCreatedTasks`, {
                name:this.task.name,
                description:this.task.description,
                startDate:new Date().toJSON().slice(0,10).replace(/-/g,'/'),
                dueDate:this.task.dueDate,
                is_done:0,
                user_id:this.task.user_id
            })
            .then(
               ({data})=>{
                    this.$toast.show(data.message, "Success", {position: "topCenter"},{timeout: 2000},{balloon: true});
                    this.$emit('created',data.task);
                }
            )
            .catch(error =>
             this.$toast.error("Something get Wrong", "Error", {position: "topRight"},{timeout: 2000})
            );
            $(function () {
                $('.modal').modal('hide');
            });
            this.task.name= "";
            this.task.description= "";
            this.task.dueDate= "";
            this.somedate="";
            // this.task= "";
            console.log("create");
            //to reset validation errors  after submit
            this.$refs.reset1.validate().then(success => {
                if (!success) {
                return;
                }// Resetting Values
                this.task.name = this.task.description = this.task.dueDate =  '';
                // Wait until the models are updated in the UI
                this.$nextTick(() => {
                this.$refs.reset1.reset();
                this.$refs.reset2.reset();
                this.$refs.reset3.reset();
                });
            });
        },

        updateTask(){
            axios.post(`/myCreatedTasks/${this.task.id}`, {
                name:this.task.name,
                description:this.task.description,
                startDate:new Date().toJSON().slice(0,10).replace(/-/g,'/'),
                dueDate:this.task.dueDate,
                is_done:0,
                user_id:this.task.user_id
            })
            .then(
                ({data})=>{
                    this.$toast.show(data.message, "Success", {position: "topCenter"},{timeout: 2000}, {  progressBarColor: "rgb(0, 255, 184)"});
                    eventBus.$emit('updated',data.updatedtask);
                    // console.log(data.updatedtask);
                }
            )
            .catch(error =>console.log(error));
           console.log("update");
        },

        todayDate(){
            var currentDate = new Date();
            var day = currentDate.getDate()
            var month = currentDate.getMonth() + 1
            var year = currentDate.getFullYear()
             return this.task.dueDate=year + "/" + month + "/" + day;
            // return this.task.dueDate= new Date().toJSON().slice(0,10).replace(/-/g,'/');
        },
        tomorrowDate(){
            var currentDate = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
            var day = currentDate.getDate()
            var month = currentDate.getMonth() + 1
            var year = currentDate.getFullYear()
            return this.task.dueDate=year + "/" + month + "/" + day;
        },      
    },
}
</script>

<style scoped>
    .form-inputs{
        justify-content: center;
        margin-left: 30px;
        margin-right: 30px;
    }
    .form-inputs input,textarea{
        border: none !important;
        background-color: #F0F4FF !important;
        color: #8043FF !important;
        margin: 10px 162px 10px 0px !important;
        padding: 30px !important ;
        font-size: 15px !important;
    }
    .form-inputs input,
    ::-webkit-input-placeholder {
        color:#8043FF;
        opacity: 1; /* Firefox */
    }
    .form-inputs input, 
    :-ms-input-placeholder { /* Internet Explorer 10-11 */
    color: #8043FF;
    }
    .form-inputs input,
    ::-ms-input-placeholder { /* Microsoft Edge */
    color: #8043FF;
    }
    .date-btn{
    background-color: #F0F4FF !important;
        color: #8043FF !important;
    height: 60px;
        width: 125px;
    margin-top:10px ;
    border: none;
    border-radius: 5px;
    font-size: 15px !important;
    }
    .warning{
        margin: 13px;
        color: #D15858;
    }

</style>


