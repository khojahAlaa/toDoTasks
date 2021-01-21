<template>
    <my-task-chart
        :chart-data="mytaskCh"
        :options="mytaskOptions"
    ></my-task-chart>
</template>

<script>
import MyTaskChart from "./myTaskBarChart";
const mytaskOptions = {
    responsive: true,
    maintainAspectRatio: false,
    //   cutoutPercentage: 50,
    //   barPercentage:1,
    //   categoryPercentage:1,
    //   minBarLength:1,
    animation: {
        animateRotate: true
    },
    scales: {
        yAxes: [
            {
                id: "A"
                // position: 'left'
            }
        ]
    }
};
let date = new Date();
let toDate = new Date();

let fromDate = new Date(date.setDate(date.getDate() - 6));

var dates = [];
while (fromDate <= toDate) {
    dates.push(new Date(fromDate));
    fromDate.setDate(fromDate.getDate() + 1);
}
const tdate = new Date();
function labelData(index) {
    return (
        //name of day as Mon
        new Date(dates[index]).toString().split(" ")[0] +
        " " +
        dates[index].toLocaleString(["en-US", "ar-SA"], {
            month: "short",
            day: "2-digit"
        })
        // .toISOString().split("T")[0] // return in yyyy-mm-dd format
    );
}
function toDoDatasetsData(dataObject, index) {
    return (
        dataObject.filter(
            task =>
                task.startDate ===
                    dates[index].toISOString().split("T")[0] +
                        " " +
                        "00:00:00" && task.is_done === 0
        ).length || 0
    );
}
function DoneDatasetsData(dataObject, index) {
    return (
        dataObject.filter(
            task =>
                task.startDate ===
                    dates[index].toISOString().split("T")[0] +
                        " " +
                        "00:00:00" && task.is_done === 1
        ).length || 0
    );
}

export default {
    components: {
        "my-task-chart": MyTaskChart
    },
    props: ["byweektasks"],
    data() {
        return {
            mytaskCh: {
                labels: [
                    labelData(0),
                    labelData(1),
                    labelData(2),
                    labelData(3),
                    labelData(4),
                    labelData(5),
                    labelData(6)
                ],
                datasets: [
                    {
                        label: "To Do",
                        yAxisID: "A",
                        backgroundColor: "#8284FF",
                        borderColor: "#8284FF",
                        data: [
                            toDoDatasetsData(this.byweektasks, 0),
                            toDoDatasetsData(this.byweektasks, 1),
                            toDoDatasetsData(this.byweektasks, 2),
                            toDoDatasetsData(this.byweektasks, 3),
                            toDoDatasetsData(this.byweektasks, 4),
                            toDoDatasetsData(this.byweektasks, 5),
                            toDoDatasetsData(this.byweektasks, 6)
                        ]
                    },
                    {
                        label: "Done",
                        yAxisID: "A",
                        backgroundColor: "#5DD1E2",
                        borderColor: "#5DD1E2",
                        data: [
                            DoneDatasetsData(this.byweektasks, 0),
                            DoneDatasetsData(this.byweektasks, 1),
                            DoneDatasetsData(this.byweektasks, 2),
                            DoneDatasetsData(this.byweektasks, 3),
                            DoneDatasetsData(this.byweektasks, 4),
                            DoneDatasetsData(this.byweektasks, 5),
                            DoneDatasetsData(this.byweektasks, 6)
                        ]
                    }
                ]
            },
            mytaskOptions
        };
    },
    computed: {
        // thisweek() {
        //     // // let firstDate = new Date();
        //     // let firstDateToMatchSQL =
        //     //     date.toISOString().split("T")[0] + " " + "00:00:00";
        //     // let secondDate = new Date(
        //     //     this.date.setDate(this.date.getDate() - 6)
        //     // );
        //     // let secondDateToMatchSQL =
        //     //     secondDate.toISOString().split("T")[0] + " " + "00:00:00";
        //     // var dates = [];
        //     // while (secondDate <= firstDate) {
        //     //     secondDate.setDate(secondDate.getDate() + 1);
        //     //     dates.push(new Date(secondDate));
        //     // }
        //     // console.log(firstDate);
        //     console.log(secondDate);
        //     console.log(firstDateToMatchSQL);
        //     console.log(secondDateToMatchSQL);
        //     // console.log(dates);
        //     let week = this.byweektasks.filter(
        //         task =>
        //             task.startDate <= firstDateToMatchSQL &&
        //             task.startDate >= secondDateToMatchSQL
        //     );
        //     console.log(week);
        //     var days = [
        //         "Sunday",
        //         "Monday",
        //         "Tuesday",
        //         "Wednesday",
        //         "Thursday",
        //         "Friday",
        //         "Saturday"
        //     ];
        //     var d = new Date(secondDate);
        //     var dayName = days[d.getDay()];
        //     // first 3 letters of the day name
        //     var dayN = d.toString().split(" ")[0];
        //     console.log(dayName);
        //     console.log(dayN);
        // }
    }
};
</script>
