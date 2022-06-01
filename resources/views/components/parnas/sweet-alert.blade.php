<script>
  document.addEventListener('deleteMessage' , evt => {
      let {event , id , force} = evt.detail;
      const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
          title: 'اطمینان دارید؟',
          text : force ? 'شما نمیتوانید آن را برگردونید!!' : 'به سطل آشغال انتقال پیدا میکند!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'بله، حذف کن!',
          cancelButtonText: 'نه، لغو کن!',
          reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
              Livewire.emit(event , id)
          }
      })
  });

  document.addEventListener('toastMessage' , evt => {
      let {message , icon , position} = evt.detail;
      if (position === undefined || position === null) {
          position = 'top-end';
      }
      const Toast = Swal.mixin({
          toast: true,
          position: position,
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
      })

      Toast.fire({
          icon: icon,
          title: message
      })
  });

  document.addEventListener('message' , evt => {
      let {message , icon , title , btnCText , btnCAText , event , data} = evt.detail;
      const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
          title: title,
          text: message,
          icon: icon,
          showCancelButton: true,
          confirmButtonText: btnCText,
          cancelButtonText: btnCAText,
          reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
              Livewire.emit(event , data)
          }
      });
  });

</script>
