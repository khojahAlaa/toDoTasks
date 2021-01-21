<template>
    <div class="container">
      
      <!-- table -->
        <div class="row mt-5" v-if="$gate.isAdmin()">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 250px; display: inline-flex">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                  <button class="btn btn-success" title="Add New User" @click="newModal" data-toggle="modal" data-target="#User_modal"
                    id="usermodal" style="border-radius: 1.25rem;" > 
                      <i class="fas fa-user-plus fa-fw"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User</th>
                      <th>Email</th>
                      <th>User Type</th>
                      <th>Registered At</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                      <td>{{user.id}}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.type | upperText}}</td>
                      <td>{{user.created_at | dateFormat}}</td>
                      <td>
                         <a href="#" @click="EditModal(user)">
                            <i class="fa fa-edit blue"></i> 
                        </a> 
                        /
                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fa fa-trash red"></i> 
                        </a> 
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="users" @pagination-change-page="getResults" align="center"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div v-if="!$gate.isAdmin()">
          <not-found></not-found>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="User_Modal" tabindex="-1" role="dialog" aria-labelledby="AddUserTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editMode" id="AddUserTitle">ِAdd New Users</h5>
                    <h5 class="modal-title" v-show="editMode" id="AddUserTitle">ِUpdate The User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editMode ? updateUser() : createUser() ">
                  <div class="modal-body">
                      <!-- name -->
                      <div class="form-group">
                          <div class="input-group-prepend ">
                              <span class="input-group-text" 
                                  style="color: #28a745; background-color: #e9ecef00;
                                  border: 3px solid #1b5a3700;
                                  border-radius: 1.25rem;">
                                  <i aria-hidden="true" class="fa fa-user"></i>
                              </span>
                              <input v-model="form.name" type="text" name="name" placeholder="User name" class="form-control"
                                  style="border: 1px solid rgba(134, 138, 135, 0.11);
                                      border-radius: 0.25rem;
                                      border-left: 4px solid #38c172;"
                                  v-validate="'required'" data-vv-as="firstname" 
                                  :class="{'input': true, 'text-danger': errors.has('name') }">
                          </div>
                          <span v-show="errors.has('name')" class="text-danger" style="margin-left: 45px;" v-cloak>
                            {{ errors.first('name') }}
                          </span>
                      </div>
                      <!-- email -->
                      <div class="form-group">
                        <div class="input-group-prepend " >
                          <span class="input-group-text" 
                              style="color: #28a745; background-color: #e9ecef00;
                              border: 3px solid #1b5a3700;
                              border-radius: 1.25rem;">
                              <i class="fas fa-at"></i> 
                          </span>
                          <input v-model="form.email" type="text" name="email" placeholder="email@example.com"  class="form-control" 
                              style="border: 1px solid rgba(134, 138, 135, 0.11);
                                      border-radius: 0.25rem;
                                      border-left: 4px solid #38c172;"
                              v-validate="'required|email'" :class="{'input': true, 'text-danger': errors.has('email') }">
                        </div> 
                        <span v-show="errors.has('email')" class="text-danger" style="margin-left: 45px;">
                          {{ errors.first('email') }}
                        </span> 
                        <span v-if="emailerros.email" :class="['text-danger']" style="margin-left: 45px;">{{ emailerros.email[0] }}</span>
                        
                      </div>
                      <!-- password -->
                      <div class="form-group">
                        <div class="input-group-prepend " >
                          <span class="input-group-text" 
                              style="color: #28a745; background-color: #e9ecef00;
                              border: 3px solid #1b5a3700;
                              border-radius: 1.25rem;">
                              <i class="fas fa-lock"></i> 
                          </span>
                          <input v-model="form.password" type="password" name="password" placeholder="password"  class="form-control" 
                              style="border: 1px solid rgba(134, 138, 135, 0.11);
                                      border-radius: 0.25rem;
                                      border-left: 4px solid #38c172;"
                              v-validate="'required|min:8'" :class="{'input': true, 'text-danger': errors.has('password') }">
                        </div> 
                        <span v-show="errors.has('email')" class="text-danger" style="margin-left: 45px;">
                          {{ errors.first('password') }}
                        </span> 
                            
                      </div>
                      <!-- User Type -->
                      <div class="form-group">
                        <div class="input-group-prepend " >
                          <span class="input-group-text" 
                              style="color: #28a745; background-color: #e9ecef00;
                              border: 3px solid #1b5a3700;
                              border-radius: 1.25rem;">
                              <i class="fas fa-users-cog"></i> 
                          </span>
                          <multiselect v-model="form.type" :options="options" :searchable="false" :close-on-select="false" 
                          :show-labels="false" placeholder="User Type"  name="type"
                          v-validate="'required'" data-vv-validate-on="input|close" 
                          :class="{'input': true, 'text-danger': errors.has('type') }"
                          style="border: 1px solid rgba(134, 138, 135, 0.11);
                                      border-radius: 0.25rem;
                                      border-left: 4px solid #38c172;
                                      margin-left: -5px;"
                          ></multiselect>
                          </div>
                          <span v-show="errors.has('type')" class="text-danger" style="margin-left: 45px;">
                            {{ errors.first('type') }}
                          </span>
                      </div>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" v-show="!editMode" class="btn btn-success" :disabled='!isComplete'>Create</button>
                      <button type="submit" v-show="editMode"  class="btn btn-success" >Update</button>
                  </div>
                </form>
              </div>
          </div>
        </div>
        
    </div>
</template>

<script>
  import Multiselect from 'vue-multiselect';
    export default {
      // components: {
      //   Multiselect: window.VueMultiselect.default,
      //   },
      components: {
        Multiselect
        },
        
        data(){
            return{
              editMode: false,
              users:{},
                form:{
                  id:'',
                  name:'',
                  email:'',
                  password:'',
                  type:'',
                  photo:'',
                },
                options: ['User', 'Manager', 'Member','Excutive'],
                emailerros: [],
                
                
            }
        },
        
        computed: {
          isComplete () {
            return this.form.name && this.form.password && this.form.email && this.form.type;
          }
        },
        
        methods: {
          newModal(){
            this.editMode= false;
            this.form.name='',
            this.form.email='',
            this.form.password='',
            this.form.type='',
            $('#User_Modal').modal('show');
          },
          
          EditModal(user){
            this.editMode= true;
            this.form.name='',
            this.form.email='',
            this.form.password='',
            this.form.type='',
            $('#User_Modal').modal('show');
            this.form.id=user.id;
            this.form.name=user.name;
            this.form.email=user.email;
            this.form.password=user.password;
            this.form.type=user.type;
            
          },
          
          loadUser(){
            if (this.$gate.isAdmin()){
              axios.get("api/user").then(({ data }) => (this.users =data)); 
            }
          },
          //for paganation
          getResults(page = 1){
            axios.get('api/user?page=' + page)
              .then(response => {
                this.users = response.data;
              });
          },
          
          createUser(){
            // this.form.post('api/user');
            axios.post(`/api/user`, {
              name: this.form.name,
              email:this.form.email,
              password:this.form.password,
              type:this.form.type,
            })
            .then(res=>{
              console.log('successful');
              // emit is to create a custom event to send http request to server when do any action or see any changes
              Fire.$emit('AfterCreateUser');
              $('#User_Modal').modal('hide');
              this.$toast.success("User Created Successfully..! ", "Sucess" , {timeout:4000, progressBarColor: 'rgb(40, 167, 69)'});
            })
            .catch(err=>{
              // console.log(err);
              // source: https://github.com/baianat/vee-validate/issues/818
              // console.log("err", err.response.data);
            // if(err.response.status == 422 && typeof err.response.data == "object" && err.response.data) { 
            //   $.each(err.response.data, function(field, messages) { 
            //       app.errors.add(field, messages[0]); 
            //   }); 
            // }
            this.emailerros = err.response.data.errors;
            this.$toast.warning(err.response.data.message , "Caution" , {timeout:4000, progressBarColor: 'rgb(40, 167, 69)'});
            });
          },
          
          
          updateUser(){
            axios.put(`api/user/`+this.form.id, {
              name: this.form.name,
              email:this.form.email,
              password:this.form.password,
              type:this.form.type,
              
            })
            .then(res=>{
              console.log("updated");
              Fire.$emit('AfterCreateUser');
              $('#User_Modal').modal('hide');
              this.$toast.success("User Updated Successfully..! ", "Sucess" , {timeout:4000, progressBarColor: 'rgb(40, 167, 69)'});
            })
            .catch(err=>{
              console.log(err);
              
            }) 
          },
          
          
          deleteUser(id){
            this.$toast.question('Are you sure about that?', 'Delete This User',{
                        timeout: 20000,
                        close: false,
                        overlay: true,
                        toastOnce: true,
                        id: 'question',
                        zindex: 999,
                        position: 'center',
                        progressBarColor: 'rgb(40, 167, 69)',
                        buttons: [
                            ['<button><b>YES</b></button>', function (instance, toast) {
                              axios.delete(`api/user/`+id ).then(()=>{
                                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                                Fire.$emit('AfterCreateUser');                                
                              })
                              .catch(()=>{
                                
                              })
                            }, true],
                            ['<button>NO</button>', function (instance, toast) {
                                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            }]
                        ],
                    });
          },
          
        },
        
        mounted() {
            console.log('Component mounted.')
        },
        
        created(){
          //for searching
          Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('api/findUser?q=' + query)
                .then((data) => {
                    this.users = data.data
                })
                .catch(() => {
                })
            })
          this.loadUser();
          //every 3000 secend will send http request to server which will affect on preformance//
          // setInterval(()=>this.loadUser(), 3000);
          // lisent to event AfterCreateUser then treger a function and then load user again
          Fire.$on('AfterCreateUser', ()=>{
            this.loadUser();
          });
          
          
        },
    }
    
// make modal static   
$(document).ready(function(){
  $('#usermodal').click(function(){
    $('#User_Modal').modal({
      backdrop: 'static'
    });
  }); 
});
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
