<template>
    <div class="container mt-20">
        <!-- <div class="row justify-content-center" style=" margin-top: 10px" >
           <div class="col-md-9 sm-12">
               <p class="welcom">welcome alaa</p>
           </div>
           <div class="col-md-3 sm-12 float-right text-right">
               <div class="row">
                   <div class="col text-right"> 
                        <p class="icontime" ><i class="fas fa-clock" ></i></p> 
                        <p class="date" >{{timeOfDay}}</p>
                    </div>
                   <div class="vl"></div>
                   <div class="col text-left"> 
                       <p class="dateWeekDay" >{{weekDay}}</p>
                        <p class="date" >{{fulldate}}</p>
                    </div>
               </div>
           </div>
       </div> -->

        <h6>Assigned Tasks</h6>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <static-card classsetting="col-sm-3 col-static-card" icon="fas fa-project-diagram fa-3x" :value="nprojects" title="Participated Projects"></static-card>
                    <static-card classsetting="col-sm-3 col-static-card" icon="fas fa-list-ol fa-3x" :value="getTotalAssignedTasks" title="Total Assigned Tasks"></static-card>
                    <static-card classsetting="col-sm-3 col-static-card" icon="fas fa-list-ol fa-3x" :value="getTotalToDoTasks" title="To Do Tasks"></static-card>
                    <static-card classsetting="col-sm-3 col-static-card" icon="fas fa-spinner fa-3x" :value="getTotalInProgressTasks" title="In Progress Tasks"></static-card>
                </div>
                <div class="row">
                    <static-card classsetting="col-sm-3 col-static-card" icon="fas fa-eye fa-3x" :value="getTotalInReviewTasks" title="In Review Tasks"></static-card>
                    <static-card classsetting="col-sm-3 col-static-card" icon="fas fa-hourglass-end fa-3x" :value="getTotalOverdueTasks" title="OverDeud Tasks"></static-card>
                    <static-card classsetting="col-sm-3 col-static-card" icon="fas fa-check-double fa-3x" :value="getTotalCompletdeTasks" title="Completed Tasks"></static-card>
                </div>
            </div>
            <div class="col-md-4 col-task-tracker">
                <div class="card border-light " style="height: 300px;">
                    <div class="card-body" style="overflow-y: scroll;">
                        <h5 class="card-title my-tasks-card-title">
                            Assigned Tasks Tracker
                        </h5>
                        <hr class="hr-line" />
                        <div v-if="tracker[0].tasks.length">
                            <div class="row"  v-for="(task, index) in tracker[0].tasks" :key="index"  >
                                <div class="col-md-10 task-info">
                                    <i v-if="task.pivot.status_id === 1"  class="fas fa-list-ol" ></i>
                                    <i v-else-if="task.pivot.status_id === 2" class="fas fa-spinner" ></i>
                                    <i v-else-if="task.pivot.status_id === 3"  class="fas fa-eye" ></i>
                                    <i v-if="task.pivot.status_id === 4" class="fas fa-check-double" ></i>
                                    <i v-if="task.pivot.status_id === 5" class="fas fa-hourglass-end" ></i>
                                    <span class="text-left">{{ task.name }}</span>
                                    <br />
                                    <small  class="label label-info text-left"  style="margin-left: 20px;"  >
                                        <i class="fa fa-clock-o"></i>
                                        {{ task.dueDate | dateFormat }}
                                    </small>
                                    <hr />
                                </div>
                            </div>
                        </div>
                        <div class="row" v-else>
                            <span class="text-center">
                                Great, you are committed with your assigned
                                tasks.
                                <i class="far fa-thumbs-up"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h5>My Tasks</h5>
        <div class="row">
            <div class="col-md-8 ">
                <div class="card border-light " style="height: 372px;">
                    <div class="card-body" style="overflow-y: scroll;">
                        <div class="row">
                            <div class="col text-left">
                                <h5 class="card-title my-tasks-card-title">
                                    My Tasks Progress
                                </h5>
                                <!-- <button @click="byMonth">click</button> -->
                            </div>
                            <div class="col-3 text-right">
                                <select class="form-control form-control-sm"  v-model="selected" >
                                    <!-- <option>Choose Option</option> -->
                                    <option  v-for="option in dropoptions" :key="option.id" :value="option.id">
                                        {{ option.name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <hr class="hr-line" />
                        <div v-if="selected === 1">
                            <tasks-by-week
                                :byweektasks="thisWeek"
                            ></tasks-by-week>
                        </div>
                        <div v-if="selected === 2">
                            <tasks-by-month
                                :bymonthtasks="byMonth"
                            ></tasks-by-month>
                        </div>
                        <div v-if="selected === 3">
                            <tasks-by-this-year></tasks-by-this-year>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-task-tracker">
                <div class="card border-light " style="height: 372px;">
                    <div class="card-body" style="overflow-y: scroll;">
                        <h5 class="card-title my-tasks-card-title">
                            Assigned Tasks
                        </h5>
                        <hr class="hr-line" />

                        <assigned-tasks-chart
                            :chart-data="chartData"
                            :options="options"
                            :style="myStyle"
                        ></assigned-tasks-chart>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import StaticCard from "../../components/staticCard";
import AssignedTaskChart from "../../components/charts/assignedTaskChart";
import MyTaskChart from "../../components/charts/myTaskBarChart";
import ByWeek from "../../components/charts/byWeek";
import byMonth from "../../components/charts/byMonth";
import thisYear from "../../components/charts/byYear";

const options = {
    responsive: true,
    maintainAspectRatio: false,
    cutoutPercentage: 50,
    animation: {
        animateRotate: true
    }
};

export default {
    props: ["assignedtasks", "nprojects", "mytasks", "tracker"],
    components: {
        "static-card": StaticCard,
        "assigned-tasks-chart": AssignedTaskChart,
        "my-task-chart": MyTaskChart,
        "tasks-by-week": ByWeek,
        "tasks-by-month": byMonth,
        "tasks-by-this-year":thisYear
    },
    data() {
        return {
            fulldate: "",
            timeOfDay: "",
            weekDay: "",
            taracer: [],
            chartData: {
                labels: [
                    "   To Do   ",
                    "In Progress",
                    " In Review ",
                    " Over Deud ",
                    " Completed "
                ],
                datasets: [
                    {
                        backgroundColor: [
                            "#8284FF",
                            "#B7CAFF",
                            "#FFDF6D",
                            "#D15858",
                            "#5DD1E2"
                        ],
                        data: [
                            this.assignedtasks.filter(
                                task => task.status_id == 1
                            ).length,
                            this.assignedtasks.filter(
                                task => task.status_id == 2
                            ).length,
                            this.assignedtasks.filter(
                                task => task.status_id == 3
                            ).length,
                            this.assignedtasks.filter(
                                task => task.status_id == 5
                            ).length,
                            this.assignedtasks.filter(
                                task => task.status_id == 4
                            ).length
                            // can not assign computed into data LIKE this:
                            // this.getTotalInProgressTasks,
                        ]
                    }
                ]
            },
            options,
            selected: 1,
            dropoptions: [
                { id: 1, name: "This Week" },
                { id: 2, name: "This Month" },
                { id: 3, name: "This Year" }
            ]
        };
    },
    created() {
        setInterval(this.getNow, 1000);
    },
    methods: {
        // getNow: function() {
        //     const today = new Date();
        //     const date = today.toLocaleString(['en-US'],{month: 'short', day: '2-digit', year: 'numeric'});
        //     const time = today.toLocaleString(['en-US'], { hour: '2-digit', minute: '2-digit',});
        //     const weekday = today.toLocaleString(['en-US'],{ weekday: 'long'});
        //     this.fulldate = date;
        //     this.weekDay= weekday;
        //     this.timeOfDay= time;
        //     console.log("hi");
        // }
       
    },
    computed: {
         byMonth() {
            const thisMonth = new Date();
            let lastMonth;
            if (thisMonth.getMonth() === 0) {
                lastMonth = new Date(
                    thisMonth.getFullYear(),
                    -1,
                    thisMonth.getDate() + 1
                );
            } else {
                lastMonth = new Date(
                    thisMonth.getFullYear(),
                    thisMonth.getMonth() - 1,
                    thisMonth.getDate() + 1
                );
            }
            const thisMonthToMatchSQL = convertToSqlDateFormat(thisMonth);

            let lastMonthToMatchSQL;
            if (lastMonth) {
                lastMonthToMatchSQL = convertToSqlDateFormat(lastMonth);
            }

            function convertToSqlDateFormat(dateToConvert) {
                return (
                    dateToConvert.toISOString().split("T")[0] + " " + "00:00:00"
                );
            }

            console.log(thisMonth);
            console.log(lastMonth);
            console.log(thisMonthToMatchSQL);
            console.log(lastMonthToMatchSQL);

            let tasksOfMonth = this.mytasks.filter(
                task =>
                    task.startDate >= lastMonthToMatchSQL &&
                    task.startDate <= thisMonthToMatchSQL
            );
            return tasksOfMonth;
            // console.log(tasksOfMonth);
        },
        thisWeek() {
            let date = new Date();
            let firstDateToMatchSQL =
                date.toISOString().split("T")[0] + " " + "00:00:00";
            let secondDate = new Date(date.setDate(date.getDate() - 6));
            let secondDateToMatchSQL =
                secondDate.toISOString().split("T")[0] + " " + "00:00:00";
            let week = this.mytasks.filter(
                task =>
                    task.startDate <= firstDateToMatchSQL &&
                    task.startDate >= secondDateToMatchSQL
            );
            // console.log(secondDate);
            // console.log(firstDateToMatchSQL);
            // console.log(secondDateToMatchSQL);
            return week;
        },
        myStyle() {
            return {
                display: "block",
                height: "300px",
                width: "230px"
            };
        },
        getTotalAssignedTasks() {
            return this.assignedtasks.length;
        },
        getTotalToDoTasks() {
            return this.assignedtasks.filter(task => task.status_id == 1)
                .length;
        },
        getTotalInProgressTasks() {
            return this.assignedtasks.filter(task => task.status_id == 2)
                .length;
        },
        getTotalInReviewTasks() {
            return this.assignedtasks.filter(task => task.status_id == 3)
                .length;
        },
        getTotalCompletdeTasks() {
            return this.assignedtasks.filter(task => task.status_id == 4)
                .length;
        },
        getTotalOverdueTasks() {
            return this.assignedtasks.filter(task => task.status_id == 5)
                .length;
        },
        verdueTasksTracker() {
            var track = this.assignedtasks.filter(task => task.status_id == 5);
            this.taracer.push(track);
        }
    }
};
</script>

<style>
/* .vl {
  border-left: 3px solid #B7CAFF;
  height: 60px;
}
.welcom{
    font-size: 24px; font-weight:bold; color: #8043FF;
}
.dateWeekDay{font-weight:bold ;}
.dateWeekDay,
.date{color:#8284FF ; font-size: 13px;}
.icontime{margin-right: 20px;color:#FFDF6D;} */

/* .static-card{
    width: 256px;
    height: 165px;
    margin-left: 0px;
} */

.col-static-card {
    padding: inherit;
    padding-left: 5px;
    padding-right: 5px;
}
.col-task-tracker {
    padding-left: 30px;
}

.my-tasks-card-title {
    /* border-bottom: 3px solid #B7CAFF;
    width: 350px;
    height: 30px; */
    color: #8284ff;
    font-weight: bold;
}

.hr-line {
    margin-top: 2rem;
    margin-bottom: 2rem;
    border: 0;
    border-top: 3px solid #b7caff;
}
</style>
