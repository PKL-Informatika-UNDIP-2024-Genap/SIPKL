<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIPKL</title>

    <!-- Primary Meta Tags -->
    <meta name="title" content="SIPKL">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="/images/logo_if.png"/>

    <!-- ===== All CSS files ===== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/animate.css" />
    <link rel="stylesheet" href="/css/lineicons.css" />
    <link rel="stylesheet" href="/css/ud-styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
      html {
        overflow-y: auto;
        scrollbar-gutter: stable;
        scrollbar-width: thin; /* Firefox */
        -ms-overflow-style: none; /* IE 10+ */
        ::-webkit-scrollbar-track {
          -webkit-box-shadow: none !important;
          background-color: transparent !important;
        }
        ::-webkit-scrollbar {
          /* width: .6rem !important; */
          background-color: transparent;
        }
        ::-webkit-scrollbar-thumb {
          background-color: #acacac;
          border-radius: 100vw;
        }
      }

      table td, table th {
        background-color: transparent !important;
      }
    </style>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ====== Header Start ====== -->
    <header class="ud-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg">
              <a class="navbar-brand" href="/">
                <div class="d-flex align-items-center">
                  <img src="/images/logo_if.png" alt="Logo" style="height: 55px"/>
                  <h3 class="d-inline" id="navbar-brand-text" style="margin-left: 10px; color:white">SIPKL</h3>
                </div>
              </a>
              <button class="navbar-toggler">
                <span class="toggler-icon"> </span>
                <span class="toggler-icon"> </span>
                <span class="toggler-icon"> </span>
              </button>

              <div class="navbar-collapse">
                <ul id="nav" class="navbar-nav mx-auto">
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#home">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#pengumuman">Pengumuman</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#dokumen">Dokumen</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#grupwa">Grup WA</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#contact">Jadwal Seminar</a>
                  </li>
                </ul>
              </div>

              <div class="navbar-btn d-sm-inline-block">
                <a class="ud-main-btn ud-white-btn" data-bs-toggle="modal" data-bs-target="#modal_login">
                  Login
                </a>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- ====== Header End ====== -->

    @include('modal_login')

    <!-- ====== Hero Start ====== -->
    <section class="ud-hero" id="home">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-hero-content wow fadeInUp" data-wow-delay=".2s">
              <h1 class="ud-hero-title">
                Sistem Informasi PKL Informatika Undip
              </h1>
              <p class="ud-hero-desc">
                Praktik Kerja Lapangan (PKL) adalah bentuk penyelenggaraan kegiatan pendidikan dan pelatihan dengan bekerja secara langsung, secara sistematik dan terarah dengan supervisi yang kompeten.
              </p>
            </div>
            {{-- <div
              class="ud-hero-brands-wrapper wow fadeInUp"
              data-wow-delay=".3s">
              <img src="/images/hero/brand.svg" alt="brand" />
            </div> --}}
            <div class="ud-hero-image wow fadeInUp" data-wow-delay=".25s">
              <img src="/images/hero/office-pana.svg" alt="hero-image" />
              <img src="/images/hero/dotted-shape.svg" alt="shape" class="shape shape-1"/>
              <img src="/images/hero/dotted-shape.svg" alt="shape" class="shape shape-2"/>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Hero End ====== -->

    <!-- ====== Pengumuman Start ====== -->
    <section id="pengumuman" class="ud-features">
      <div class="container wow fadeInUp" data-wow-delay=".2s">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title">
              <span>Announcements</span>
              <h2>Pengumuman</h2>
            </div>
          </div>
        </div>
        <div class="row table-responsivee pt-1">
          <table class="table table-hover text-center border-primary" id="tabelPengumuman">
            <thead>
              <tr>
                <th class="tanggal text-center">Tanggal</th>
                <th class="text-center">Deskripsi</th>
                <th class="lampiran text-center" style="white-space: nowrap; width: 1%">Lampiran</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data_pengumuman as $pengumuman)
              <tr>
                <td>{{ $pengumuman->updated_at }}</td>
                <td>{{ $pengumuman->deskripsi }}</td>
                <td class="py-0 align-middle"><a href="{{ $pengumuman->lampiran }}" class="btn btn-primary btn-sm">Download</a></td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- ====== Pengumuman End ====== -->

    <!-- ====== Dokumen Start ====== -->
    <section id="dokumen" class="ud-about">
      <div class="container wow fadeInUp" data-wow-delay=".2s">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title">
              <span>Files</span>
              <h2>Dokumen</h2>
            </div>
          </div>
        </div>
        <div class="row table-responsive pt-1">
          <table class="table table-hover text-center border-primary" id="tabelDokumen" style="width: 100%">
            <thead>
              <tr>
                <th class="tanggal hidden text-center">Tanggal</th>
                <th class="text-center">Deskripsi</th>
                <th class="lampiran text-center" style="white-space: nowrap; width: 1%">Lampiran</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data_dokumen as $dokumen)
              <tr>
                <td>{{ $dokumen->updated_at }}</td>
                <td>{{ $dokumen->deskripsi }}</td>
                <td class="py-0 align-middle"><a href="{{ $dokumen->lampiran }}" class="btn btn-primary btn-sm">Download</a></td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- ====== dokumen End ====== -->

    <!-- ====== About Start ====== -->
    <section id="grupwa" class="ud-features">
      <div class="container">
        <div class="ud-about-wrapper wow fadeInUp d-flex justify-content-center text-center" data-wow-delay=".2s">
          <div class="ud-about-content-wrapper">
            <div class="ud-about-content row d-flex text-center">
              <div class="col-auto">
                <span class="tag">Penting</span>
                <h2>Grup WA</h2>
                <p>
                  Gabung grup WhatsApp berikut untuk mendapatkan informasi terbaru seputar PKL Informatika Undip!
                </p>
                <a href="javascript:void(0)" class="ud-main-btn">Gabung</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== About End ====== -->

    <!-- ====== Footer Start ====== -->
    <footer class="ud-footer wow fadeInLeft" data-wow-delay=".15s">
      <div class="shape shape-1">
        <img src="/images/footer/shape-1.svg" alt="shape" />
      </div>
      <div class="shape shape-2">
        <img src="/images/footer/shape-2.svg" alt="shape" />
      </div>
      <div class="shape shape-3">
        <img src="/images/footer/shape-3.svg" alt="shape" />
      </div>
      <div class="ud-footer-widgets">
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6">
              <div class="ud-widget">
                <a href="/" class="ud-footer-logo">
                  <div class="d-flex align-items-center">
                    <img src="/images/logo_if.png" alt="Logo" style="height: 55px; width:55px">
                    <h3 class="d-inline" id="navbar-brand-text" style="margin-left: 10px; color: white;">SIPKL</h3>
                  </div>
                </a>
                <p class="ud-widget-desc">
                  Sistem Informasi PKL Informatika UNDIP
                </p>
                <ul class="ud-widget-socials">
                  <li>
                    <a href="https://twitter.com/MusharofChy">
                      <i class="lni lni-facebook-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://twitter.com/MusharofChy">
                      <i class="lni lni-twitter-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://twitter.com/MusharofChy">
                      <i class="lni lni-instagram-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://twitter.com/MusharofChy">
                      <i class="lni lni-linkedin-original"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
              <div class="ud-widget">
                <h5 class="ud-widget-title">About Us</h5>
                <ul class="ud-widget-links">
                  <li>
                    <a href="javascript:void(0)">Home</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Features</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">About</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Testimonial</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
              <div class="ud-widget">
                <h5 class="ud-widget-title">Features</h5>
                <ul class="ud-widget-links">
                  <li>
                    <a href="javascript:void(0)">How it works</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Privacy policy</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Terms of service</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Refund policy</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
              <div class="ud-widget">
                <h5 class="ud-widget-title">Our Products</h5>
                <ul class="ud-widget-links">
                  <li>
                    <a
                      href="https://lineicons.com/"
                      rel="nofollow noopner"
                      target="_blank"
                      >Lineicons
                    </a>
                  </li>
                  <li>
                    <a
                      href="https://ecommercehtml.com/"
                      rel="nofollow noopner"
                      target="_blank"
                      >Ecommerce HTML</a
                    >
                  </li>
                  <li>
                    <a
                      href="https://ayroui.com/"
                      rel="nofollow noopner"
                      target="_blank"
                      >Ayro UI</a
                    >
                  </li>
                  <li>
                    <a
                      href="https://graygrids.com/"
                      rel="nofollow noopner"
                      target="_blank"
                      >Plain Admin</a
                    >
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-8 col-sm-10">
              <div class="ud-widget">
                <h5 class="ud-widget-title">Partners</h5>
                <ul class="ud-widget-brands">
                  <li>
                    <a
                      href="https://ayroui.com/"
                      rel="nofollow noopner"
                      target="_blank"
                    >
                      <img
                        src="/images/footer/brands/ayroui.svg"
                        alt="ayroui"
                      />
                    </a>
                  </li>
                  <li>
                    <a
                      href="https://ecommercehtml.com/"
                      rel="nofollow noopner"
                      target="_blank"
                    >
                      <img
                        src="/images/footer/brands/ecommerce-html.svg"
                        alt="ecommerce-html"
                      />
                    </a>
                  </li>
                  <li>
                    <a
                      href="https://graygrids.com/"
                      rel="nofollow noopner"
                      target="_blank"
                    >
                      <img
                        src="/images/footer/brands/graygrids.svg"
                        alt="graygrids"
                      />
                    </a>
                  </li>
                  <li>
                    <a
                      href="https://lineicons.com/"
                      rel="nofollow noopner"
                      target="_blank"
                    >
                      <img
                        src="/images/footer/brands/lineicons.svg"
                        alt="lineicons"
                      />
                    </a>
                  </li>
                  <li>
                    <a
                      href="https://uideck.com/"
                      rel="nofollow noopner"
                      target="_blank"
                    >
                      <img
                        src="/images/footer/brands/uideck.svg"
                        alt="uideck"
                      />
                    </a>
                  </li>
                  <li>
                    <a
                      href="https://tailwindtemplates.co/"
                      rel="nofollow noopner"
                      target="_blank"
                    >
                      <img
                        src="/images/footer/brands/tailwindtemplates.svg"
                        alt="tailwindtemplates"
                      />
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- ====== Footer End ====== -->

    <!-- ====== Back To Top Start ====== -->
    <a href="javascript:void(0)" class="back-to-top">
      <i class="lni lni-chevron-up"> </i>
    </a>
    <!-- ====== Back To Top End ====== -->

    <!-- ====== All Javascript Files ====== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="/js/wow.min.js"></script>
    <script src="/js/main.js"></script>
    <script type="text/javascript">
      // ==== for menu scroll
      const pageLink = document.querySelectorAll(".ud-menu-scroll");

      pageLink.forEach((elem) => {
        elem.addEventListener("click", (e) => {
          e.preventDefault();
          document.querySelector(elem.getAttribute("href")).scrollIntoView({
            behavior: "smooth",
            offsetTop: 1 - 60,
          });
        });
      });

      // section menu active
      function onScroll(event) {
        const sections = document.querySelectorAll(".ud-menu-scroll");
        const scrollPos =
          window.pageYOffset ||
          document.documentElement.scrollTop ||
          document.body.scrollTop;

        for (let i = 0; i < sections.length; i++) {
          const currLink = sections[i];
          const val = currLink.getAttribute("href");
          const refElement = document.querySelector(val);
          const scrollTopMinus = scrollPos + 73;
          if (
            refElement.offsetTop <= scrollTopMinus &&
            refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
          ) {
            document
              .querySelector(".ud-menu-scroll")
              .classList.remove("active");
            currLink.classList.add("active");
          } else {
            currLink.classList.remove("active");
          }
        }
      }

      window.document.addEventListener("scroll", onScroll);

    </script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="/lte/plugins/moment/moment.min.js"></script>
    <script src="/lte/plugins/moment/locale/id.js"></script>
    <script type="text/javascript">
      function dataTableInit(idTable) {
        const table = new DataTable(idTable, {
          columnDefs: [
            {
              targets: ["lampiran"],
              searchable: false,
              orderable: false,
            },
            {
              target: 'tanggal',
              render: DataTable.render.datetime( "D MMMM YYYY", "id"),
            },
            {
              target: 'hidden',
              visible: false,
              searchable: false
            },
          ],
          order: [[0, 'asc']],
          lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
          pageLength: 10,
          // language: {
          //   url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json',
          // },
        });
        $(idTable+'_filter input').css('width', '200px');
      }
  
      $(document).ready(function() {
        dataTableInit('#tabelPengumuman');
        dataTableInit('#tabelDokumen');

        $('.ud-footer-logo').on('click', function(e) {
          e.preventDefault();
          location.reload();
        })
      });
    </script>
  </body>
</html>
