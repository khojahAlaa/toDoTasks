<template>
    <div :class="classsetting">
        <div class="card  text-center border-light">
            <div class="card-body ">
                <div class="row">
                    <div class="col">
                        <i :class="icon"></i>
                    </div>
                    <div class="col" v-if="value!=null">
                        <h3>{{value}}</h3>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <p class="card-text">
                        <small class="text-muted">{{title}} </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        classsetting:{required : true},
        icon: {required :true},
        value:{required :true},
        title:{required :true}
    }
}
</script>

<style>
.col-static-card {
    padding: inherit;
    padding-left: 5px;
    padding-right: 5px;
}
</style>
