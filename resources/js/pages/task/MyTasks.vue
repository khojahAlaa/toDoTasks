<!-- in this tamplate the main function is to show my task page-->
<!--1) define tabs data  and renderd on template by looping thrught tabs  -->
<!--2) show done and to do card when select specific tab name-->
<!--3) call to-do-card & done-card component and pass data via props  -->
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-left">
                <nav class="nav  nav-justified">
                    <a
                        v-for="tab in tabs"
                        :key="tab.id"
                        class="nav-item nav-link "
                        @click.prevent="setActive(tab.value)"
                        :class="{ active: isActive(tab.value) }"
                        :href="'#' + tab.id"
                    >
                        {{ tab.title }}
                        <span
                            class="badge count badge-pill badge-primary"
                            v-if="tab.taskcount"
                        >
                            {{ tab.taskcount }}
                        </span>
                        <span
                            class="badge count badge-pill badge-primary"
                            v-else
                        >
                            0
                        </span>
                    </a>
                </nav>
            </div>
        </div>
        <div class="tab-content py-5" id="myTabContent">
            <div
                v-for="tab in tabs"
                :key="tab.id"
                :id="tab.id"
                class="tab-pane fade"
                :class="{ 'active show': isActive(tab.value) }"
            >
                <div class="row ">
                    <div class="card-deck">
                        <!-- @donetogg="moveToDone" -->
                        <!-- @deleted="remove($event)" -->
                        <to-do-card
                            :title="tab.value"
                            :todos="tab.do"
                        ></to-do-card>
                        <done-card
                            @donetogg="moveToToDo"
                            :dones="tab.done"
                            :showDoneCard="tab.showDoneCard"
                        ></done-card>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col"></div>
            <div class="col">
                <button
                    class="add-button float-right"
                    style="margin-right: 0px; width: 145px;
                bottom: 1.25rem; position: fixed; right: 1.25rem; z-index: 1032;"
                    data-toggle="modal"
                    data-target="#NewTaskModal"
                    @click="openAddNewTaskDialog"
                >
                    New Task
                </button>
                <pm-new-task-modal
                    @created="add"
                    actionShow="createT"
                    modalId="NewTaskModal"
                ></pm-new-task-modal>
            </div>
        </div>
    </div>
</template>

<script>
import eventBus from "../../event-bus";
import MyTasksDoneCard from "../../components/tasks/myTasks/MyTasksDoneCard.vue";
import MyTasksToDoCard from "../../components/tasks/myTasks/MyTasksToDoCard.vue";
import NewTask from "../../components/tasks/myTasks/CreateNewTaskModal.vue";

export default {
    props: [
        "todaydone",
        "todaytodo",
        "tomorrowdone",
        "tomorrowtodo",
        "somedaytodo",
        "somedaydone",
        "overdue",
        "countall"
    ],
    components: {
        "to-do-card": MyTasksToDoCard,
        "done-card": MyTasksDoneCard,
        "pm-new-task-modal": NewTask
    },

    data() {
        return {
            // can not assign varibile in data method to another varibile in data method or in computed proprity method
            //e.g cand not assign todayTodoLists value to tabs.do -> do: this.todayTodoLists
            // but we can assign props like tabs.do:this.todaytodo -> todaytodo is prop
            tabs: [
                {
                    title: "Today Tasks",
                    id: "tab1",
                    value: "today",
                    do: this.todaytodo,
                    done: this.todaydone,
                    taskcount: parseInt(
                        this.todaytodo.length + this.todaydone.length
                    ),
                    showDoneCard: true
                },
                {
                    title: "Tomorrow Tasks",
                    id: "tab2",
                    value: "tomorrow",
                    do: this.tomorrowtodo,
                    done: this.tomorrowdone,
                    taskcount:
                        this.tomorrowtodo.length + this.tomorrowdone.length,
                    showDoneCard: true
                },
                {
                    title: "Someday Tasks",
                    id: "tab3",
                    value: "someday",
                    do: this.somedaytodo,
                    done: this.somedaydone,
                    taskcount:
                        this.somedaytodo.length + this.somedaydone.length,
                    showDoneCard: true
                },
                {
                    title: "Overdue Tasks",
                    id: "tab4",
                    value: "overdue",
                    do: this.overdue,
                    done: "",
                    taskcount: this.overdue.length,
                    showDoneCard: false
                }
            ],
            activeItem: "today",

            todayTodoLists: this.todaytodo,
            todayDoneLists: this.todaydone,
            overdueLists: this.overdue,
            tomorrowDoneLists: this.tomorrowdone,
            tomorrowTodoLists: this.tomorrowtodo,
            somedayTodoLists: this.somedaytodo,
            somedayDoneLists: this.somedaydone
        };
    },
    methods: {
        //lisent to event when communicate between pirent and child componets
        moveToToDo(event, task) {
            if (this.activeItem == "today") {
                this.todaydone.splice(event, 1);
                this.todaytodo.push(task);
                console.log(task.id);
                console.log(event);
            } else if (this.activeItem == "tomorrow") {
                this.tomorrowdone.splice(event, 1);
                this.tomorrowtodo.push(task);
                console.log(task.id);
                console.log(event);
            } else if (this.activeItem == "someday") {
                this.somedaydone.splice(event, 1);
                this.somedaytodo.push(task);
            } else {
                this.overdueLists.splice(event, 1);
            }
        },

        //lisent to event when communicate between pirent and child componets
        add(task) {
            var duedate = task.dueDate;
            if (duedate == this.todayDate()) {
                this.todaytodo.push(task);
                return this.tabs[0].taskcount++;
            } else if (duedate == this.tomorrowDate()) {
                this.tomorrowTodoLists.push(task);
                return this.tabs[1].taskcount++;
            } else if (duedate > this.tomorrowDate()) {
                this.somedayTodoLists.push(task);
                return this.tabs[2].taskcount++;
            } else {
                this.overdueLists.push(task);
                return this.tabs[3].taskcount++;
            }
        },

        todayDate() {
            return new Date()
                .toJSON()
                .slice(0, 10)
                .replace(/-/g, "/");
        },
        tomorrowDate() {
            var currentDate = new Date(
                new Date().getTime() + 24 * 60 * 60 * 1000
            );
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();
            return year + "/" + month + "/" + day;
        },
        // which tab is selected and activated
        isActive(menuItem) {
            return this.activeItem === menuItem;
        },
        setActive(menuItem) {
            this.activeItem = menuItem;
        },
        openAddNewTaskDialog() {
            $("#NewTaskModal").modal({
                show: true,
                backdrop: "static",
                keyboard: false
            });
        },
        // remove task info after update in duedate -> e.g update date from today to someday
        //it will remove it from todayTodoLists and push it to somedayTodoLists
        remove(taskId) {
            if (this.activeItem == "today") {
                const indexe = this.todayTodoLists.findIndex(
                    todo => todo.id === taskId
                );
                console.log(taskId);
                console.log(indexe);
                this.todayTodoLists.splice(indexe, 1);
                return this.tabs[0].taskcount--;
            } else if (this.activeItem == "tomorrow") {
                const indexe = this.tomorrowTodoLists.findIndex(
                    todo => todo.id === taskId
                );
                this.tomorrowTodoLists.splice(indexe, 1);
                return this.tabs[1].taskcount--;
            } else if (this.activeItem == "someday") {
                const indexe = this.somedayTodoLists.findIndex(
                    todo => todo.id === taskId
                );
                this.somedayTodoLists.splice(indexe, 1);
                return this.tabs[2].taskcount--;
            } else if (this.activeItem == "overdue") {
                const indexe = this.overdueLists.findIndex(
                    todo => todo.id === taskId
                );
                this.overdueLists.splice(indexe, 1);
                return this.tabs[3].taskcount--;
            } else {
                return;
            }
        }
    },

    created() {
        // emit from createNewTaskModal.vue component (updateTask() method)
        eventBus.$on("updated", task => {
            var duedate = task.dueDate;

            if (duedate == this.todayDate()) {
                this.remove(task.id);
                this.todaytodo.push(task);
                return this.tabs[0].taskcount++;
            } else if (duedate == this.tomorrowDate()) {
                this.remove(task.id);
                this.tomorrowTodoLists.push(task);
                return this.tabs[1].taskcount++;
            } else if (duedate > this.tomorrowDate()) {
                this.remove(task.id);
                this.somedayTodoLists.push(task);
                return this.tabs[2].taskcount++;
            } else if (duedate > this.todayDate()) {
                this.remove(task.id);
                this.overdueLists.push(task);
                return this.tabs[3].taskcount++;
            } else {
                return;
            }
        });
        // emit from SingleToDo.vue component (checkboxToggle() method)
        // move to done card after press on chick button
        eventBus.$on("donetogg", (index, task) => {
            if (this.activeItem == "today") {
                this.todaytodo.splice(index, 1);
                this.todaydone.push(task);
                console.log(task.id);
                console.log(index);
            } else if (this.activeItem == "tomorrow") {
                this.tomorrowtodo.splice(index, 1);
                this.tomorrowdone.push(task);
                console.log(task.id);
                console.log(index);
            } else if (this.activeItem == "someday") {
                this.somedaytodo.splice(index, 1);
                this.somedaydone.push(task);
            } else {
                this.overdueLists.splice(index, 1);
            }
        });

        // emit from SingleToDo.vue component (deleteTask() method)
        // delete task from  tamplte view after deleted from database
        eventBus.$on("deleted", index => {
            if (this.activeItem == "today") {
                this.todayTodoLists.splice(index, 1);
                return this.tabs[0].taskcount--;
            } else if (this.activeItem == "tomorrow") {
                this.tomorrowTodoLists.splice(index, 1);
                return this.tabs[1].taskcount--;
            } else if (this.activeItem == "someday") {
                this.somedayTodoLists.splice(index, 1);
                return this.tabs[2].taskcount--;
            } else {
                this.overdueLists.splice(index, 1);
                return this.tabs[3].taskcount--;
            }
        });
    }
};
//to do list in vue
// https://codepen.io/arfullight/pen/rwxbQx

// https://renatello.com/vue-js-tabs/#JSFiddle_Tabs_in_Vuejs_example
// https://github.com/karambafe/vue-tabs-with-active-line
</script>

<style>
.count {
    color: #b7caff;
    background: #ffffff;
    font-weight: bolder;
    border-radius: 70%;
    font-size: 15px;
    height: 28px;
    /* left: 18px; */
    margin-left: 20px;
    line-height: 20px;
    position: relative;
    text-align: center;
    /* top: 7px; */
    width: 28px;
    display: inline-block;
}
a.active {
    border-bottom: 4px solid #6600ff;
    color: #6600ff;
    font-weight: bold;
}
a:hover {
    color: #6600ff;
}
.my-tasks-card {
    width: 398px;
}
.my-tasks-card-title {
    /* border-bottom: 3px solid #B7CAFF;
        width: 350px;
        height: 30px; */
    color: #8284ff;
    font-weight: bold;
}
.single-task:hover {
    border-left: 3px solid #6600ff;
}
</style>
