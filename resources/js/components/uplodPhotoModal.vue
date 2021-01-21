<template>
    <div class="modal fade" id="UplodPhotoModal" tabindex="-1" role="dialog" aria-labelledby="UplodPhotoModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Uplod Your Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center"> 
                        <!-- bind with newImg in this data instanc -->
                         <img v-if="newImg" :src="newImg"
                            class="rounded-circle photo_model img-fluid mb-3 text-center">
                        <!-- bind with props value -->
                        <img v-else-if="imgSrc != null" :src="imgSrc"
                            class="rounded-circle photo_model img-fluid mb-3 text-center">
                        <!-- if props return null value , i.e if user have not photo yet -->
                        <img v-else src="/img/man.png" 
                            class="rounded-circle photo_model img-fluid mb-3 text-center">
                    </div>

                    <div class="row justify-content-center">
                        <div class="custom-uplod-photo">
                            <span>
                                <i class="fa fa-upload" style="font-size:20px; padding-right: 10px;"></i>
                                Choose Your Photo
                            </span>
                            <!-- to lisent to change and if photo changed show newImg in img tag -->
                            <input type="file" class="my_photo" @change="onFileChange" name="photo" accept="image/*">
                        </div>
                    </div>
                </div>

                <form class=" "  enctype="multipart/form-data">
                    <button @click.prevent="removeImg" class="removeImgBtn" data-dismiss="modal">
                        Remove Photo
                    </button>
                </form>

                <form class=" " @submit.prevent="saveChangedImg" enctype="multipart/form-data">
                    <button @click="saveChangedImg" class="save-change-button" data-dismiss="modal"  v-if="uploaded">
                        Save changes
                    </button>
                </form>
                
            </div>
        </div>
    </div>
    
</template>
<script>
export default {
    data: function (){
        return{
            newImg: null,
            uploaded:false,
            imgFile:null,
        }
    },
    props:[ 'imgSrc', 'userId'],
    computed:{
        
    },
    methods:{
        // onFileChange(e) {
        //     const file = e.target.files[0];
        //     console.log(file);
        //     this.newImg = URL.createObjectURL(file);
        //     },
        onFileChange(e) {
            const img = e.target.files[0];
            this.readImage(img);
            this.uploaded=true; 
        },
        //to read as base64
        readImage(img){
            let reader= new FileReader();
            reader.readAsDataURL(img);
            reader.onload= e=>{
                // this.newImg=e.target.result
                this.newImg=reader.result
            }
        },
        saveChangedImg(){
            //emit or pass changes to Parents component
            this.$emit('updatedImg', this.newImg);
            // const config = {
            //         headers: { 'content-type': 'multipart/form-data' }
            //     }
            //     let formData = new FormData();
            //     formData.append('photo', this.newImg);
            
            axios.post(`/userimg/${this.userId}`, {
                    photo:this.newImg,
                })
                .then(
                    res=>{console.log(res)}
                )
                .catch(error =>console.log(error))
        },
        removeImg(){

        },       
    },   
}
</script>
<style scoped>
.removeImgBtn{
    height: 50px;
    width: 60%;
    border: 3px solid;
    border-radius: 20px;
    margin-bottom: 20px;
    border: 3px solid #707070;
    background-color: white;
    color: #707070;
}
.removeImgBtn:hover{
     border: 3px dashed #707070;
}
</style>
