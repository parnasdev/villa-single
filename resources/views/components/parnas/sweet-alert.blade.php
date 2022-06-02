{{-- <div class="modal-alert pos-fixed-top-right" x-data="{
    alert: [],
    showToast(e) {
        let {message} = e.detail;
        console.log(message);
        this.alert.push(message);

    }
}" @toast-message.window="showToast">
    <div class="p-alert" >
        <!-- info alert -->
        <template x-for="(item , index) in alert">
            <div class="wrapper-alert" :class="'alert_'+index" x-init="
                setTimeout(() => {
                    $('.alert_'+index).hide();
                }, 1300);
            ">
                <div class="-card p-0 flex-direction-column align-items-start">
                    <div class="subject m-left-auto pr-10 pl-10 pt-8">
                        {{--                    <h5>پیام شما با موفقیت ثبت شد</h5>--}}
                        <p class="f-12" x-text="item"></p>
                    </div>
                    <div class="progress-bar bg-info m-left-auto"></div>
                </div>
            </div>
        </template>
    </div>
</div> --}}
<script>
  document.addEventListener('deleteMessage' , evt => {
      let {event , id , force} = evt.detail;
      Swal.fire({
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

      Swal.fire({
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

  @if(session()->has('alert-toast'))
  const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
  })

  Toast.fire({
      icon: '{{ session('alert-toast')['icon'] }}',
      title: '{{ session('alert-toast')['message'] }}'
  })
  @endif

//   Swal.fire({
//     title: 'Error!',
//     text: 'Do you want to continue',
//     icon: 'error',
//     confirmButtonText: 'Cool'
//   })
</script>
