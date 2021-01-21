<template>
  <div class="container">
    <div class="row text-center justify-content-center" style=" margin-top: 20px">
        <div class="col-lg-8 col-md-8">
          <div class="card border-light">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img  v-if="userInfo.photoUrl" :src="userInfo.photoUrl" 
                    class="profile-user-img img-fluid img-circle mb-3" 
                    style=" width: 160px;  height: 160px; border: 5px solid #8284FF;"
                  >
                  <img v-else src="/img/man.png"
                    class="profile-user-img img-fluid img-circle mb-3" 
                    style=" width: 160px;  height: 160px; border: 5px solid #8284FF;"
                  >
                </div>

                <h3 class="profile-username text-center" 
                  style="font-size: 25px; color:#707070;font-weight: bold;">
                  {{userInfo.firstName + " " + userInfo.lastName}}
                </h3>
                <p class="text-muted titel-1"> Role 
                  <b class="roletitle">{{role}}</b> 
                </p>
                <p class="text-muted titel-1"> Department 
                  <b class="deptitle">{{department}}</b> 
                </p>
                <p class="text-muted titel-2" >
                    {{userInfo.email}}
                </p>
                
                <hr class="hr-line" style="margin-bottom: 1rem; margin-top: 1rem;">
                  <!-- -------------------- -->
                <div v-if="role=='manager'" class=row>
                  <div class="col">
                    <strong class="static"> {{managedProjectsCount}}</strong>
                      <p class="text-muted titel-1" >
                        Managed Projects
                      </p>
                  </div>
                  <div class="col">
                    <strong class="static">{{createdProjectsCount}}</strong>
                      <p class="text-muted titel-1" >
                        Created Projects
                      </p>
                  </div>
                </div>

                <div v-if="role=='user'" class="raw">
                  <div class="col">
                    <strong class="static"> {{tasksCounts}}</strong>
                      <p class="text-muted titel-1" >
                        Assigned Tasks
                      </p>
                  </div>
                </div>
                <div v-if="role=='user'" class="raw">
                  <div class="col">
                    <strong class="static"> 3 </strong>
                      <p class="text-muted titel-1" >
                        Participated Teams
                      </p>
                  </div>
                </div>

                <hr class="hr-line" style="margin-bottom: 1rem; margin-top: 1rem;">

                <div v-if="role=='manager'" class="raw">
                    <p class="text-muted titel-3 text-left" >
                        Created Projects
                    </p>
                    <div class="card  single-project-card" v-for="(createdproject, index) in this.createdprojects" :key="createdproject.id[index]">
                      <div class="card-body">
                        <div class="row" >
                            <div class="col-md-7 text-left"> 
                              <p>
                                <a :href="'/projectDetails/'+ createdproject.id" style="color:darkgrey"> 
                                  {{createdproject.name}} 
                                </a>
                              </p>
                            </div>
                            <div class="col-md-3 text-right">
                              <progress-bar :options="options" :value="createdproject.progress" />
                            </div>
                            <div class="col-md-2 ">
                              <project-status :data="createdproject.status_id"></project-status>
                            </div>
                        </div>
                      </div>
                    </div>
                    
                    <hr class="hr-line" style="margin-bottom: 1rem; margin-top: 1rem;">
                    
                    <p class="text-muted titel-3 text-left" >
                        Managed Projects
                    </p>
                    <div class="card  single-project-card" v-for="(managedProject, index) in this.managedprojects" :key="managedProject.id[index]">
                      <div class="card-body">
                        <div class="row" >
                          <div class="col-md-7 text-left"> 
                            <p>
                              <a :href="'/projectDetails/'+ managedProject.id" style="color:darkgrey"> 
                                {{managedProject.name}} 
                              </a>
                            </p>
                          </div>
                          <div class="col-md-3 text-right">
                            <progress-bar :options="options" :value="managedProject.progress" />
                          </div>
                          <div class="col-md-2 ">
                            <project-status :data="managedProject.status_id"></project-status>
                          </div>
                        </div>
                      </div>
                    </div>     
                </div>

                <div v-if="role=='user'" class="raw">
                  <p class="text-muted titel-3" >
                    Participated Teams
                  </p>
                  <p>
                    <a href=""  style="color:darkgrey"> 
                      teams 
                    </a>
                  </p> 
                </div>

              </div>
              <!-- /.card-body -->
          </div>
        </div>
    </div>
  </div>
</template>


<script>
import ProgressBar from 'vuejs-progress-bar';
import projectStatus from '../components/projects/projectStatus.vue';
Vue.use(ProgressBar)
  export default {
      props: ['model', 'managedprojects', 'createdprojects'],
      components: { 'progress-bar':ProgressBar ,'project-status': projectStatus},
      data() {
        return {
          userInfo:{
              id:this.model.id,
              photoUrl: '/uploads/avatar/'+ this.model.photo,
              firstName:this.model.first_name,
              lastName:this.model.last_name,
              userName:this.model.name,
              email:this.model.email,
              password:this.model.password,
          },
          role:this.model.role.title,
          department:this.model.department.name,
          tasks:[],
          //option for progress bar
          options: {
            text: {
              color: '#5DD1E2',
              fontSize: 9,
              fontFamily: 'Helvetica',
              dynamicPosition: false,
              hideText: false,
              shadowEnable:false,
            },
            progress: {
              color: '#8284FF',
              backgroundColor: '#F0F4FF'
            },
            layout: {
              height:10,
              width: 100,
              verticalTextAlign: 80,
              horizontalTextAlign: 43,
              zeroOffset: 0,
              strokeWidth: 30,
              progressPadding: 0,
              type: 'line'
            },
          }
        }  
      },
      created(){
          // for (const managedproject in this.managedprojects) {
          //   console.log(`${managedproject}: ${this.managedprojects[managedproject]}`);
          // }
          // console.log(Object.keys(this.managedprojects));
          //  for(managedProject in this.managedprojects){
          //    console.log(managedProject.status_id)
          //  }
      },
      methods:{
        showProjectDetailsPage(id){
           axios.get('/projectDetails/'+ managedProject.id);
        }
      },
      computed:{
        tasksCounts(){
            return this.model.tasks.length;
        },
        managedProjectsCount(){
          // convert object containing Objects into array of objects
          const projects= Object.entries(this.managedprojects).map((e) => ( { [e[0]]: e[1] } ));
           return projects.length;
        },
        createdProjectsCount(){
            return this.model.projects.length;
        },
        
      },
  }
</script>


// https://github.com/larsmars/vuejs-progress-bar
// https://codepen.io/shankarcabus/pen/GzAfb
// https://stackoverflow.com/questions/921789/how-to-loop-through-a-plain-javascript-object-with-the-objects-as-members
// https://javascript.info/keys-values-entries
// https://forum.vuejs.org/t/i-want-to-count-conditional-objects/76059

<style scoped>
.card.single-project-card:hover {
    border-left: 3px solid #6600FF;
}
.card.single-project-card {
    border-bottom: none;
    border-right: none;
    border-top: none;
    border-left: 1px
}
.progress-bar{
  display:contents;
  align-content:stretch;
  line-height:20px}
</style>