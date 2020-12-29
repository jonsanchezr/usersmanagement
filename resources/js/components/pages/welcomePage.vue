<template>
	<div>
	  <div class="flex-center position-ref full-height">
      <div class="top-right links">
      	<button @click="onLogin" type="button" class="btn btn-primary">Login</button>
      	<button @click="onRegister" type="button" class="btn btn-primary">Register</button>
      </div>

      <login-modal />
      <register-modal />

      <div class="content">
        <div class="title m-b-md">
          Users Management
        </div>
      </div>

    </div>
	</div>
</template>

<script>
import LoginModal from '../modals/loginModal';
import RegisterModal from '../modals/registerModal';

export default {
	components: {
    LoginModal,
    RegisterModal,
  },

  data() {
    return {
      showModal: false,
    }
  },

  methods: {
  	onLogin() {
  		$('#loginModal').modal('show');
  	},

  	onRegister() {
  		$('#registerModal').modal('show');
  	}
  },
  
  mounted() {
    console.log('Component mounted.')
  }
}
</script>