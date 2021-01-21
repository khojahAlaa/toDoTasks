import { ValidationProvider } from 'vee-validate';
import { extend } from 'vee-validate';

extend('positive', value => {
  return value >= 0;
});
export default {
    
    components: { ValidationProvider }
}

import { extend } from 'vee-validate';
import { required, email } from 'vee-validate/dist/rules';
extend('required', {
  validate (value) {
    return {
      required: true,
      valid: ['', null, undefined].indexOf(value) === -1
    };
  },
   message: '{_field_} field is required',
  computesRequired: true,
});