 <!-- jquery vendor -->
 <script src="../../dashboard/js/lib/jquery.min.js"></script>
 <script src="../../dashboard/js/lib/jquery.nanoscroller.min.js"></script>
 <!-- nano scroller -->
 <script src="../../dashboard/js/lib/menubar/sidebar.js"></script>
 <script src="../../dashboard/js/lib/preloader/pace.min.js"></script>
 <!-- sidebar -->

 <script src="../../dashboard/js/lib/bootstrap.min.js"></script>
 <script src="../../dashboard/js/scripts.js"></script>
 <!-- bootstrap -->

 <script src="../../dashboard/js/lib/calendar-2/moment.latest.min.js"></script>
 <script src="../../dashboard/js/lib/calendar-2/pignose.calendar.min.js"></script>
 <script src="../../dashboard/js/lib/calendar-2/pignose.init.js"></script>


 <script src="../../dashboard/js/lib/weather/jquery.simpleWeather.min.js"></script>
 <script src="../../dashboard/js/lib/weather/weather-init.js"></script>
 <script src="../../dashboard/js/lib/circle-progress/circle-progress.min.js"></script>
 <script src="../../dashboard/js/lib/circle-progress/circle-progress-init.js"></script>
 <script src="../../dashboard/js/lib/chartist/chartist.min.js"></script>
 <script src="../../dashboard/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
 <script src="../../dashboard/js/lib/sparklinechart/sparkline.init.js"></script>
 <script src="../../dashboard/js/lib/owl-carousel/owl.carousel.min.js"></script>
 <script src="../../dashboard/js/lib/owl-carousel/owl.carousel-init.js"></script>
 <!-- scripit init-->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/venobox/2.0.4/venobox.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


 <script>
window.showToast = function(message) {
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
        icon: 'success',
        title: message
    })
}
showToast('{{ session('
        message ')
 </script>
