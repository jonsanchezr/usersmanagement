<template>
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Login</h5>
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
            <div class="form-group">
              <label for="exampleInputEmail1">Email address *</label>
              <input v-model="email" type="email" class="form-control" id="email" placeholder="Enter email" required="">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password *</label>
              <input v-model="password" type="password" class="form-control" id="password" placeholder="Password" min="8" required="">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click="checkForm">Login</button>
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
      password: ''
    }
  },

  methods:{
    checkForm () {       
      this.errors = [];
      
      if (!this.email) {
        this.errors.push('Email required.');
      }
      
      if (!this.password) {
        this.errors.push('Password required.');
      } 

      if (this.errors.length >= 1) {
        return;
      }

      let formData = {
        'email': this.email,
        'password': this.password
      };

      axios.post("auth/login", formData)
        .then(response => {
          window.open("/dashboard","_self");
        })
        .catch(error => {
          confirm('Validate Data');
          console.error("There was an error!", error);
        });

    }
  }
}
</script>
