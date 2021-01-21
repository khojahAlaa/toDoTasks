<template>
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-8">
                <div class="card " style=" margin-top: 8px">

                    <div class="card-body">
                       <div class="row justify-content-center" style=" margin-top: 10px" >
                            <div class="col-md-9 sm-12">
                                <p class="welcom">welcome {{userName}}</p>
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
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
   data () {
      return {
            fulldate: "",
            timeOfDay:"",
            weekDay:"",
        }
   },
    created() {
        setInterval(this.getNow, 1000);
    },
    methods: {
        getNow: function() {
            const today = new Date();
            const date = today.toLocaleString(['en-US'],{month: 'short', day: '2-digit', year: 'numeric'});
            const time = today.toLocaleString(['en-US'], { hour: '2-digit', minute: '2-digit',});
            const weekday = today.toLocaleString(['en-US'],{ weekday: 'long'});
            this.fulldate = date;
            this.weekDay= weekday;
            this.timeOfDay= time;
            console.log("hi");
        }
    },
    computed:{
        //get user name from javasecript global window object defined in app1.blade
        userName(){
            return window.user.name;
        }
    }

}
</script>


<style>
.vl {
  border-left: 3px solid #B7CAFF;
  height: 60px;
}
.welcom{
    font-size: 24px; font-weight:bold; color: #8043FF;
}
.dateWeekDay{
    font-weight:bold ;
}

.dateWeekDay,
.date{color:#8284FF ; font-size: 13px;}

.icontime{margin-right: 20px;color:#FFDF6D;}
</style>