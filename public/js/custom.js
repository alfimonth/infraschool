// Menampilkan tombol scroll ketika pengguna menggulir ke bawah
$(window).scroll(function() {
  if ($(this).scrollTop() > 100) {  // Ketika scroll lebih dari 100px
    $('.scroll-top').fadeIn();  // Tampilkan tombol
  } else {
    $('.scroll-top').fadeOut();  // Sembunyikan tombol
  }
});

// Fungsi untuk scroll ke atas saat tombol diklik
$('.scroll-top').click(function() {
  $('html, body').animate({ scrollTop: 0 }, 'smooth');  // Gulir ke atas dengan smooth
  return false;  // Mencegah perilaku default
});
