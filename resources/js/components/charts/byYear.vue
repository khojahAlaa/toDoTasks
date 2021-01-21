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
//https://stackoverflow.com/questions/30464628/javascript-get-all-months-between-two-dates
const thisMonth = new Date();
let lastMonth;
if (thisMonth.getMonth() === 0) {
    lastMonth = new Date(thisMonth.getFullYear(), -1, thisMonth.getDate() + 1);
} else {
    lastMonth = new Date(
        thisMonth.getFullYear(),
        thisMonth.getMonth() - 1,
        thisMonth.getDate() + 1
    );
}

// const month = new Date(lastMonth.getTime());
// const monthConvert = convertToSqlDateFormat(month);

// const week1 = new Date(month.setDate(month.getDate() + 7));
// const w1 = new Date(week1.getTime());

// const week2 = new Date(w1.setDate(w1.getDate() + 7));
// const w2 = new Date(week2.getTime());

// const week3 = new Date(w2.setDate(w2.getDate() + 7));
// const w3 = new Date(week3.getTime());

// const week4 = new Date(w3.setDate(w3.getDate() + 9)); //from week3 to now

// const thisMonthToMatchSQL = convertToSqlDateFormat(thisMonth);
// const lastMonthToMatchSQL = convertToSqlDateFormat(lastMonth);

// const week1Convert = convertToSqlDateFormat(week1);
// const week2Convert = convertToSqlDateFormat(week2);
// const week3Convert = convertToSqlDateFormat(week3);
// const week4Convert = convertToSqlDateFormat(week4);

function convertToSqlDateFormat(dateToConvert) {
    // if (dateToConvert === thisMonth || dateToConvert === lastMonth) {
    //     return dateToConvert.toLocaleString(["en-US", "ar-SA"], {
    //         month: "short",
    //         day: "2-digit"
    //     });
    // } else return dateToConvert.toISOString().split("T")[0] + " " + "00:00:00";
}

function toDoDatasetsData(dataObject, fristDate, secondDate) {
    // return (
    //     dataObject.filter(
    //         task =>
    //             task.startDate >= fristDate &&
    //             task.startDate < secondDate &&
    //             task.is_done === 0
    //     ).length || 0
    // );
}
function DoneDatasetsData(dataObject, fristDate, secondDate) {
    // return (
    //     dataObject.filter(
    //         task =>
    //             task.startDate >= fristDate &&
    //             task.startDate < secondDate &&
    //             task.is_done === 1
    //     ).length || 0
    // );
}

export default {
    components: {
        "my-task-chart": MyTaskChart
    },
    props: ["thisyeartasks"],
    data() {
        return {
            mytaskCh: {
                labels: [
                    "month 1",
                    "month 2",
                    "month 3",
                    "month 4",
                    "month 5",
                    "month 6",
                    "month 7",
                    "month 8",
                    "month 9",
                    "month 10",
                    "month 11",
                    "month 12",
                   
                ],
                datasets: [
                    {
                        label: "To Do",
                        yAxisID: "A",
                        backgroundColor: "#8284FF",
                        borderColor: "#8284FF",
                        data: [
                           1,4,6,9,4,9,4,0,6,9,3,5
                        ]
                    },
                    {
                        label: "Done",
                        yAxisID: "A",
                        backgroundColor: "#5DD1E2",
                        borderColor: "#5DD1E2",
                        data: [
                            0,6,9,3,5,1,4,6,9,4,0,6
                        ]
                    }
                ]
            },
            mytaskOptions
        };
    },
    computed: {}
};
</script>
