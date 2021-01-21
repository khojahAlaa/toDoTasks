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
/*  to show my tasks by month for e.g from 08-11-2020 to today date 08-12-2020:-
 1) you need frist get today date -->> thisMonth varible.
 2) Subtract 1 month from today date ->>> lastMonth varible  .
 3) to copy Date object of (lastMonth ) into another date Object( month ) 
 without using a reference i use .getTime() ->>> new Date(lastMonth.getTime()).
 4) to copy Date object of (week1 ) into another date Object( w1 )
  then used to define the next week without affect and change the week1 date .
 5) convert the date into sql format date  by define this function (convertToSqlDateFormat).
 6) to show the task static based on weeks and number of done and todo tasks ->> i use these 2 function
    toDoDatasetsData and doneDatasetsData -->> where i get all tasks and then filter based on weeks range i have defined
    task.startDate (>=greeter than or equal) week1 &&  task.startDate (< smaller than) week2 
  */
const thisMonth = new Date();
let lastMonth;
// month start from 0 to 11 ->> if month ==0 will subtract 1 from the year to get past year e.g if 
// date 08-01-2021 it become date 08-12-2020
if (thisMonth.getMonth() === 0) {
    lastMonth = new Date(thisMonth.getFullYear(), -1, thisMonth.getDate() + 1);
} else {
    lastMonth = new Date(
        thisMonth.getFullYear(),
        thisMonth.getMonth() - 1,
        thisMonth.getDate() + 1
    );
}

const month = new Date(lastMonth.getTime());
const monthConvert = convertToSqlDateFormat(month);

const week1 = new Date(month.setDate(month.getDate() + 7));
const w1 = new Date(week1.getTime());

const week2 = new Date(w1.setDate(w1.getDate() + 7));
const w2 = new Date(week2.getTime());

const week3 = new Date(w2.setDate(w2.getDate() + 7));
const w3 = new Date(week3.getTime());

const week4 = new Date(w3.setDate(w3.getDate() + 9)); //from week3 to now

const thisMonthToMatchSQL = convertToSqlDateFormat(thisMonth);
const lastMonthToMatchSQL = convertToSqlDateFormat(lastMonth);

const week1Convert = convertToSqlDateFormat(week1);
const week2Convert = convertToSqlDateFormat(week2);
const week3Convert = convertToSqlDateFormat(week3);
const week4Convert = convertToSqlDateFormat(week4);

function convertToSqlDateFormat(dateToConvert) {
    if (dateToConvert === thisMonth || dateToConvert === lastMonth) {
        return dateToConvert.toLocaleString(["en-US", "ar-SA"], {
            month: "short",
            day: "2-digit"
        });
    } else return dateToConvert.toISOString().split("T")[0] + " " + "00:00:00";
}

function toDoDatasetsData(dataObject, fristDate, secondDate) {
    return (
        dataObject.filter(
            task =>
                task.startDate >= fristDate &&
                task.startDate < secondDate &&
                task.is_done === 0
        ).length || 0
    );
}
function DoneDatasetsData(dataObject, fristDate, secondDate) {
    return (
        dataObject.filter(
            task =>
                task.startDate >= fristDate &&
                task.startDate < secondDate &&
                task.is_done === 1
        ).length || 0
    );
}

export default {
    components: {
        "my-task-chart": MyTaskChart
    },
    props: ["bymonthtasks"],
    data() {
        return {
            mytaskCh: {
                labels: [
                    // `${monthConvert} -to- ${week1Convert} ` ,
                    // `${week1Convert} -to- ${week2Convert} ` ,
                    // `${week2Convert} -to- ${week3Convert} ` ,
                    // `${week3Convert} -to- ${week4Convert} ` ,
                    "week 1",
                    "week 2",
                    "week 3",
                    "week 4",
                    `${lastMonthToMatchSQL} - ${thisMonthToMatchSQL} `
                ],
                datasets: [
                    {
                        label: "To Do",
                        yAxisID: "A",
                        backgroundColor: "#8284FF",
                        borderColor: "#8284FF",
                        data: [
                            toDoDatasetsData(
                                this.bymonthtasks,
                                monthConvert,
                                week1Convert
                            ),
                            toDoDatasetsData(
                                this.bymonthtasks,
                                week1Convert,
                                week2Convert
                            ),
                            toDoDatasetsData(
                                this.bymonthtasks,
                                week2Convert,
                                week3Convert
                            ),
                            toDoDatasetsData(
                                this.bymonthtasks,
                                week3Convert,
                                week4Convert
                            )
                        ]
                    },
                    {
                        label: "Done",
                        yAxisID: "A",
                        backgroundColor: "#5DD1E2",
                        borderColor: "#5DD1E2",
                        data: [
                            DoneDatasetsData(
                                this.bymonthtasks,
                                monthConvert,
                                week1Convert
                            ),
                            DoneDatasetsData(
                                this.bymonthtasks,
                                week1Convert,
                                week2Convert
                            ),
                            DoneDatasetsData(
                                this.bymonthtasks,
                                week2Convert,
                                week3Convert
                            ),
                            DoneDatasetsData(
                                this.bymonthtasks,
                                week3Convert,
                                week4Convert
                            )
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
