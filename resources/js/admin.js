import '@popperjs/core'
import Bootstrap from './files/bootstrap.min'
import Swal from 'sweetalert2'
import Alpine from 'alpinejs'
import IMask from 'imask';
window.moment = require('jalali-moment')

window.Alpine = Alpine
window.Bootstrap = Bootstrap
window.IMask = IMask
Alpine.start()
window.Swal = Swal;
