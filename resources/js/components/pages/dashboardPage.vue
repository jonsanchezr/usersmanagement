<template>
	<div>
	  <div class="position-ref">
      <div class="top-right links">
        <button @click="onAddUser" type="button" class="btn btn-primary">Add user</button>
      	<button @click="onLogout" type="button" class="btn btn-primary">Logout</button>
      </div>

      <register-modal @addUserSuccess="onAddUserSuccess" />

      <div class="content">
        <div class="title m-b-md">

          List Users

        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Email</th>
                <th scope="col">Country</th>
                <th scope="col">Phone</th>
                <th scope="col">Age</th>
                <th scope="col">Birthday</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in arrayUsers" :key="user.id">
                <th scope="row" v-text="user.id"></th>
                <td v-text="user.name"></td>
                <td v-text="user.profile.firstname"></td>
                <td v-text="user.profile.lastname"></td>
                <td v-text="user.email"></td>
                <td v-text="user.profile.country"></td>
                <td v-text="user.profile.phone"></td>
                <td v-text="user.profile.age"></td>
                <td v-text="user.profile.birthday_date"></td>
                <td>
                  <button class="btn" @click="onEditUser(user)">Modificar</button>
                  <button class="btn" @click="onDeleteuser(user)">Borrar</button>
                </td>
              </tr>
              
            </tbody>
          </table>
      </div>

    </div>
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
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
                  <label for="eemail">Email address *</label>
                  <input v-model="email" type="email" class="form-control" id="eemail" placeholder="Enter email" required="">
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="eusername">Username *</label>
                  <input v-model="username" type="text" class="form-control" id="eusername" placeholder="username" required="">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="epassword">Password *</label>
                  <input v-model="password" type="password" class="form-control" id="epassword" placeholder="Password" min="8" required="">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="epassword_confirmation">Password confirmation *</label>
                  <input v-model="password_confirmation" type="password" class="form-control" id="epassword_confirmation" placeholder="Password" min="8" required="">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="efirstname">Firstname *</label>
                  <input v-model="firstname" type="text" class="form-control" id="efirstname" placeholder="Firstname" required="">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="elastname">Lastname *</label>
                  <input v-model="lastname" type="text" class="form-control" id="elastname" placeholder="Lastname" required="">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="ecountry">Country *</label>
                  <input v-model="country" type="text" class="form-control" id="ecountry" placeholder="Country" required="">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="ephone">Phone *</label>
                  <input v-model="phone" type="text" class="form-control" id="ephone" placeholder="Phone" required="">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="eage">Age *</label>
                  <input v-model="age" type="number" class="form-control" id="eage" placeholder="00" required="">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="ebirthday_date">Birthday *</label>
                  <input v-model="birthday_date" type="date" class="form-control" id="ebirthday_date" required="">
                </div>
              </div>


            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="checkForm">Edit</button>
          </div>
        </div>
      </div>
    </div>

	</div>
</template>

<script>
import RegisterModal from '../modals/registerModal';


export default {
  components: {
    RegisterModal,
  },

  data(){
    return{
      updateId:0,
      arrayUsers:[],
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
    getUsers(){
    let me = this;    
      axios.get('/users')
        .then(function (response) {
          me.arrayUsers = response.data.data;
        })
        .catch(function (error) {
          confirm('Validate Data');
          console.log(error);
        });
    },

    onEditUser(user) {
      this.updateId = user.id;
      this.email = user.email;
      this.username = user.name;
      this.firstname = user.profile.firstname;
      this.lastname = user.profile.lastname;
      this.country = user.profile.country;
      this.phone = user.profile.phone;
      this.age = user.profile.age;
      this.birthday_date = user.profile.birthday_date;
      $('#editUserModal').modal('show');
    },

    onAddUser() {
      $('#registerModal').modal('show');
    },

    onAddUserSuccess() {
      this.getUsers();
    },

    onLogout() {
      axios.post('/auth/logout')
        .then(function (response) {
          window.open("/","_self")
        })
        .catch(function (error) {
          confirm('Validate Data');
          console.log(error);
        });   
    },

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

      axios.put("/users/"+this.updateId, formData)
        .then(response => {
          console.log(response.data);
          $('#editUserModal').modal('hide');
          this.getUsers();
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

    onDeleteuser(user) {
      let me =this;
      if (confirm('You want to delete this user?')) {
        axios.delete('/users/'+user.id)
          .then(function (response) {
            me.getUsers();
          })
          .catch(function (error) {
            console.log(error);
          }); 
      }
    }
  },
  
  mounted() {
    this.getUsers();
  }
}
</script>