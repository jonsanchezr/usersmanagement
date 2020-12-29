<template>
  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Register</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12 text-center">
            <p v-if="errors.length">
              <b>Please correct the following error(s):</b>
              <ul class="list-group">
                <li v-for="error in errors" class="list-group-item list-group-item-danger">{{ error }}</li>
              </ul>
            </p>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="remail">Email address *</label>
                <input v-model="email" type="email" class="form-control" id="remail" placeholder="Enter email" required="">
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="rusername">Username *</label>
                <input v-model="username" type="text" class="form-control" id="rusername" placeholder="username" required="">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="rpassword">Password *</label>
                <input v-model="password" type="password" class="form-control" id="rpassword" placeholder="Password" min="8" required="">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="rpassword_confirmation">Password confirmation *</label>
                <input v-model="password_confirmation" type="password" class="form-control" id="rpassword_confirmation" placeholder="Password" min="8" required="">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="rfirstname">Firstname *</label>
                <input v-model="firstname" type="text" class="form-control" id="rfirstname" placeholder="Firstname" required="">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="rlastname">Lastname *</label>
                <input v-model="lastname" type="text" class="form-control" id="rlastname" placeholder="Lastname" required="">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="rcountry">Country *</label>
                <input v-model="country" type="text" class="form-control" id="rcountry" placeholder="Country" required="">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="rphone">Phone *</label>
                <input v-model="phone" type="text" class="form-control" id="rphone" placeholder="Phone" required="">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="rage">Age *</label>
                <input v-model="age" type="number" class="form-control" id="rage" placeholder="00" required="">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="rbirthday_date">Birthday *</label>
                <input v-model="birthday_date" type="date" class="form-control" id="rbirthday_date" required="">
              </div>
            </div>


          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click="checkForm">Register</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      errors: [],
      email: '',
      username: '',
      password: '',
      password_confirmation:'',
      firstname:'',
      lastname:'',
      country:'',
      phone:'',
      age:'',
      birthday_date:''
    }
  },

  methods:{
    checkForm () {       
      this.errors = [];
      
      this.validateForm();

      if (this.errors.length >= 1) {
        return;
      }

      let formData = {
        'email': this.email,
        'username': this.username,
        'password': this.password,
        'password_confirmation': this.password_confirmation,
        'firstname': this.firstname,
        'lastname': this.lastname,
        'country': this.country,
        'phone': this.phone,
        'age': this.age,
        'birthday_date': this.birthday_date,
      };

      axios.post("auth/register", formData)
        .then(response => {
          console.log(response.data);
          $('#registerModal').modal('hide');
          $('#loginModal').modal('show');
          this.$emit('addUserSuccess');
          this.clearForm();
        })
        .catch(error => {
          confirm('Validate Data');
          console.error("There was an error!", error);
        });

    },

    validateForm () {
      if (!this.email) {
        this.errors.push('Email required.');
      }

      if (!this.username) {
        this.errors.push('Username required.');
      }
      
      if (!this.password) {
        this.errors.push('Password required.');
      }

      if (!this.password_confirmation) {
        this.errors.push('Password confirmation required.');
      }

      if (!this.firstname) {
        this.errors.push('Firstname required.');
      }

      if (!this.lastname) {
        this.errors.push('Lastname required.');
      }

      if (!this.country) {
        this.errors.push('Country required.');
      }

      if (!this.phone) {
        this.errors.push('Phone required.');
      }

      if (!this.age) {
        this.errors.push('Age required.');
      }

      if (!this.birthday_date) {
        this.errors.push('Birthday required.');
      }
    },

    clearForm() {
      this.email = '';
      this.username = '';
      this.password = '';
      this.password_confirmation = '';
      this.firstname = '';
      this.lastname = '';
      this.country = '';
      this.phone = '';
      this.age = '';
      this.birthday_date = '';
    }
  }
}
</script>
