<!-- <style>
  @import '/css/myCss.css';
</style>
-->
<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
           
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Users</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 250px; display: inline-flex">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                  <!-- //add new user button -->
                  <button class="btn btn-success" title="Add New User"  data-toggle="modal" data-target="#User_modal"
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
                      <th>Name</th>
                      <th>Email</th>
                      <th>User Type</th>
                      <th>Registered At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <tr>
                      <td>175</td>
                      <td>Mike Doe</td>
                      <td>Mike Doe@hoo.com</td>
                      <td>admian</td>
                      <td>11-7-2014</td>
                      
                      <td>
                        <a href="#" >
                            <i class="fa fa-edit blue"></i> 
                        </a> 
                        /
                        <a href="#" >
                            <i class="fa fa-trash red"></i> 
                        </a> 
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        
        </div>

<!-- Modal -->
<div class="modal fade" id="User_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form @submit.prevent="editMode ? updateUser() : createUser() ">
        <div class="modal-body">
            <!-- name -->
            <div class="form-group">
                <div class="input-group-prepend ">
                    <span class="input-group-text">
                        <i aria-hidden="true" class="fa fa-user"></i>
                    </span>
                    <input v-model="userform.name" type="text" name="name" placeholder="User name" class="form-control">
                </div>
            </div>
            <!-- email -->
            <div class="form-group">
                <div class="input-group-prepend " >
                    <span class="input-group-text">
                        <i class="fas fa-at"></i> 
                    </span>
                     <input v-model="userform.email" type="text" name="email" placeholder="email@example.com"  class="form-control"
                     >
                </div> 
                
               
            </div>
            <!-- password -->
            <div class="form-group">
                <div class="input-group-prepend " >
                <span class="input-group-text" >
                   
                    <i class="fas fa-lock"></i> 
                </span>
                <input v-model="userform.password" type="password" name="password" placeholder="password"  class="form-control">
                </div> 
                    
            </div>
            <!-- User Type -->
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit"  class="btn btn-success" >Create</button>
            
        </div>
    </form>
    </div>
  </div>
</div>
</div>
</template>



<script>
    export default {
        data(){
            return{
            
            users:{},
                userform:{
                id:'',
                name:'',
                email:'',
                password:'',
                type:'',
                photo:'',
                },
            }
        },
        
        mounted() {
            console.log('Component mounted.')
        }

        
    }
</script>
