<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('argon') }}/assets/img/LOGO_ALODIA.png">
    <link rel="icon" type="image/png" href="{{ asset('argon') }}/assets/img/LOGO_ALODIA.png">
    <title>
        Alodia
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('argon') }}/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('argon') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('argon') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('argon') }}/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('assets/img/bg-profile.jpg'); background-position: top;">
            <span class="mask opacity-6" style="background-color: #C07F00;"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Alodia</h1>
                        {{-- <p class="text-lead text-white">Use these awesome forms to login or create new account in your
                            project for free.</p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header pt-1">
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Kolom Pertama -->
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <p class="font-weight-bolder">Kami menghargai keputusan Anda untuk menghapus akun
                                        Anda. Berikut adalah langkah-langkah yang perlu Anda ikuti untuk memastikan
                                        bahwa penghapusan akun Anda dilakukan dengan aman dan efisien:
                                    </p>
                                    <p class="font-weight-bolder">Masukan alamat Email</p>
                                    <p class="font-weight-bolder">Untuk memulai proses penghapusan akun, silakan
                                        masukkan alamat email yang terdaftar dengan akun Anda di kolom di bawah ini.
                                        Kami akan mengirimkan link verifikasi ke alamat email tersebut.
                                    </p>
                                    <form role="form" action="{{ url('/account/delete-request') }}" method="POST">
                                        @csrf
                                        <div>
                                            <input name="email" type="email" class="form-control form-control-lg"
                                                placeholder="Email" aria-label="Email">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary w-100 mt-4 mb-0">Submit</button>
                                        </div>
                                    </form>
                                    <p class="font-weight-bolder pt-4">Setelah mengirimkan email Anda, periksa kotak
                                        masuk Anda untuk pesan dari kami. Kami akan mengirimkan link verifikasi ke email
                                        tersebut. Jika Anda tidak menerima email dalam waktu beberapa menit, pastikan
                                        untuk memeriksa folder spam atau promosi Anda.
                                    </p>
                                    <p class="font-weight-bolder">Klik Link Verifikasi</p>
                                    <p class="font-weight-bolder">Buka email yang kami kirimkan dan klik link verifikasi
                                        yang ada di dalamnya. Link ini akan membawa Anda ke halaman konfirmasi
                                        penghapusan akun.</p>
                                </div>
                                <!-- Kolom Kedua -->
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <p class="font-weight-bolder">Konfirmasi Penghapusan Akun</p>
                                    <p class="font-weight-bolder">Di halaman konfirmasi, Anda akan diminta untuk
                                        mengonfirmasi bahwa Anda benar-benar ingin menghapus akun Anda. Harap
                                        diperhatikan bahwa tindakan ini tidak dapat dibatalkan dan semua data terkait
                                        akun Anda akan dihapus secara permanen.</p>
                                    <p class="font-weight-bolder">Selesai</p>
                                    <p class="font-weight-bolder">Setelah Anda mengonfirmasi penghapusan, akun Anda akan
                                        diproses untuk dihapus. Anda akan menerima email konfirmasi yang menyatakan
                                        bahwa penghapusan akun Anda telah berhasil diproses.</p>
                                    <p class="font-weight-bolder">Perhatian</p>
                                    <p class="font-weight-bolder">Penghapusan akun akan menghapus semua data terkait,
                                        termasuk pengaturan, riwayat aktivitas, dan konten yang diunggah. Pastikan Anda
                                        sudah mencadangkan data penting sebelum memulai proses penghapusan.</p>
                                    <p class="font-weight-bolder">Jika Anda mengalami masalah atau memiliki pertanyaan,
                                        jangan ragu untuk menghubungi tim dukungan kami di [email dukungan] atau
                                        kunjungi [halaman dukungan].</p>
                                    <p class="font-weight-bolder">Terima kasih telah menggunakan layanan kami.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('sweetalert::alert')

        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="{{ asset('argon') }}/assets/js/core/popper.min.js"></script>
    <script src="{{ asset('argon') }}/assets/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('argon') }}/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('argon') }}/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('argon') }}/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>
