<style scoped> 
 @import '/css/profile.css';
</style>
<template>
    <div class="container"  v-cloak>
        
            <!-- <pm-welcome></pm-welcome> -->
        
        <div class="row text-center" style=" margin-top: 20px">
            <!-- photo section  -->
            <div class="col-lg-3 col-md-3">
                <div class="uplod_img_file_container" >
                     <img v-if="userInfo.photoUrl" :src="userInfo.photoUrl" 
                        class="profile-user-img img-fluid img-circle mb-3 text-center" 
                        style=" width: 160px; height: 160px; border: 5px solid #8284FF;">
                     <img  v-else src="/img/man.png" 
                        class="profile-user-img img-fluid img-circle mb-3 text-center" 
                        style=" width: 160px;  height: 160px; border: 5px solid #8284FF;">
                    <span class="fa-stack fa-lg edit-btn" data-toggle="modal"
                        data-target="#UplodPhotoModal" @click="openUplodPhotoDialog" >
                        <i class="fa fa-circle fa-stack-2x" style="color:#8284FF;"></i>
                        <i class="fas fa-marker fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <pm-uplode-photo-modal :userId="userInfo.id"  :imgSrc="userInfo.photoUrl" 
                    @updatedImg="userInfo.photoUrl=$event">
                </pm-uplode-photo-modal>
                 <!-- @close="showModal = false" -->
                <!-- role and dep section -->
                <p class="text-muted role">Role
                    <b class="d-block roletitle">{{role}}</b>
                </p>
                <p class="text-muted dep">Department
                    <b class="d-block deptitle">{{department}}</b>
                </p>
            </div>

            <!-- personal info form section -->
            <div class="col-lg-9 col-md-9  text-left" style="margin-top: 15px;">
                <div class="card border-light "  >
                    <div class="card-body" >
                        <h5 class="card-title my-tasks-card-title">Personal Information</h5> 
                        <hr class="hr-line">
                        <div class="form-inputs " >
                            <div class="row justify-content-center">
                                <div class="col-sm-12 col-xs-12 col-lg-6 col-md-12">
                                    <input type="text" class="form-control" placeholder="First name"
                                    v-model="userInfo.firstName" value="firstName">
                                </div>
                                <div class="col-sm-12 col-xs-12 col-lg-6 col-md-12">
                                    <input type="text" class="form-control" placeholder="Last name"
                                    v-model="userInfo.lastName" value="lastName">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-12 col-xs-12 col-lg-6 col-md-12">
                                    <input type="text" class="form-control" placeholder="User Name"
                                    v-model="userInfo.userName" value="userName">
                                </div>
                                <div class="col-sm-12 col-xs-12 col-lg-6 col-md-12">
                                    <input type="email" class="form-control" placeholder="example@example.com"
                                    v-model="userInfo.email" value="email">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-12 col-xs-12 col-lg-6 col-md-12">
                                    <input type="password" class="form-control" placeholder="password"
                                    v-model="userInfo.password" value="password">
                                </div>
                                <div class="col-sm-12 col-xs-12 col-lg-6 col-md-12">
                                    <input type="text" class="form-control" placeholder="Last name" style="visibility: hidden;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
         
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <form class=" " @submit.prevent="updatePersonalInfo">
                <button class="save-change-button float-right" 
                style="margin-right: 0px; width: 145px;">Save changes</button>
                </form>
            </div>
        </div>
        
        
        
    </div>
</template>

<script>

 import UplodModal from '../components/uplodPhotoModal.vue';
    export default {
        props: ['model'],
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
            }
        },
        components:{
            'pm-uplode-photo-modal': UplodModal,
        },
  
        mounted() {
            // console.log('Component mounted.')
        }, 
        created(){
            // console.log(this.model.name);
        },
        methods:{
            openUplodPhotoDialog(){
                $('#UplodPhotoModal').modal({
                    show: true,
                    backdrop: 'static',
                    keyboard: false
                });
            },
            updatePersonalInfo(){
                axios.post(`/profile/${this.userInfo.id}`, {
                    name:this.userInfo.userName,
                    first_name:this.userInfo.firstName,
                    last_name:this.userInfo.lastName,
                    email:this.userInfo.email,
                    password:this.userInfo.password,
                })
                .then(
                    res=>{console.log(res)}
                )
                .catch(error =>console.log(error))
            }
        }
    }
</script>



