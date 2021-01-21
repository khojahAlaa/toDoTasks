<template>
  <div>
    <ValidationProvider ref='refForValidationReset' mode="eager"  rules="selected" v-slot="{ errors,classes }" >
      <select :class="classes" class="form-control form-control-lg custum-select "  v-model="selectedValue">
          <option class="selectOption"  :value="0" disabled="true">{{lable}} </option>
          <option v-for="option in options" 
          :key="option.id" :value="option.id"
          v-bind="selectValue"
          >{{option.name}}</option>
      </select>
   <!-- <span  class="warning">{{ customError }}</span> -->
      <span  class="warning">{{ errors[0] }}</span>
    </ValidationProvider>
  </div>
 
</template>

<script>
import { ValidationProvider,ValidationObserver, extend ,configure, setInteractionMode} from 'vee-validate';

extend('selected', value => {
  if (value != 0) {
    return true;
  }

  return '* This field is required please select one !';
});
configure({
  classes: {
    valid: 'is-valid',
    invalid: 'is-invalid',
    dirty: ['is-dirty', 'is-dirty'], // multiple classes per flag!
  }
});
setInteractionMode('eager');
export default {
  components: {  ValidationProvider, ValidationObserver,},
  props: {
    options: {
      type: Array,
      required: true,
    },
    lable: {
      type: String,
      required: true,
    },
    selectedV:{
       required: false,
    }
  },
  data() {
    return {
      selectedValue: 0,
      refForValidationReset:''
    };
  },
  created(){
    if(this.selectedV){
      this.selectedValue=this.selectedV
    }

  },
  computed:{
    selectValue(){
        this.$emit('selectedValue', this.selectedValue)
    }
      
  },
  mounted() {
    this.$emit("selectedValue", this.selectValue);
  },
  
};
</script>

<style scoped>
  .custum-select{
        background-color: #F0F4FF !important;
        color: #8043FF !important;
        border: none !important;
        font-size: 15px !important;
        margin: 10px 162px 10px 0px !important;
        height: 60px;
  }
  .custum-select option{
        /* background-color: #F0F4FF !important;
        color: #8043FF !important; */
        border: none !important;
  }
  .selectOption:hover{
      background-color: #ad8225;
  }
  .warning{
        margin: 13px;
        color: #D15858;
  }
</style>
