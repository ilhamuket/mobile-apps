<template>
  <div />
</template>

<script>
  import axios from 'axios'
  export default {
    created () {
      this.verify()
    },
    methods: {
      verify () {
        axios.defaults.headers.common.Authorization =
          'Bearer ' + localStorage.getItem('access_token')
        axios.defaults.baseURL = process.env.VUE_APP_API_URL

        axios.get('auth/verifications').then(res => {
          console.log(res)
          if (res.data.meta.status) {
            const Toast = this.$swal.mixin({
              toast: true,
              position: 'bottom-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: toast => {
                toast.addEventListener('mouseenter', this.$swal.stopTimer)
                toast.addEventListener('mouseleave', this.$swal.resumeTimer)
              },
              popup: 'swal2-show',
              backdrop: 'swal2-backdrop-show',
              icon: 'swal2-icon-show',
            })
            Toast.fire({
              icon: 'success',
              title: res.data.meta.message,
            })
            this.$router.push('/')
          } else {
            this.$router.push('/')
            const Toast = this.$swal.mixin({
              toast: true,
              position: 'bottom-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: toast => {
                toast.addEventListener('mouseenter', this.$swal.stopTimer)
                toast.addEventListener('mouseleave', this.$swal.resumeTimer)
              },
              popup: 'swal2-show',
              backdrop: 'swal2-backdrop-show',
              icon: 'swal2-icon-show',
            })
            Toast.fire({
              icon: 'success',
              title: 'Diem',
            })
          }
        })
      },
    },
  }
</script>

<style></style>
