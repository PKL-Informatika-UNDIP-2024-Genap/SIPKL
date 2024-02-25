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
          <table class="table table-hover border-primary text-center" id="tabelPengumuman">
            <thead>
              <tr>
                <th class="text-center tanggal">Tanggal</th>
                <th class="text-center">Deskripsi</th>
                <th class="text-center">Lampiran</th>
              </tr>
            </thead>
            @php
              $i = 0;
            @endphp
            <tbody>
            @foreach ($data_pengumuman as $pengumuman)
              <tr>
                <td class="">{{ $pengumuman->updated_at }}</td>
                <td>{{ $pengumuman->deskripsi }}</td>
                <td><a class="btn btn-primary btn-sm" href="javascript:void(0)">Download</a></td>
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
          <table class="table table-hover border-primary text-center" id="tabelDokumen" style="width: 100%">
            <thead>
              <tr>
                <th class="text-center tanggal hidden">Tanggal</th>
                <th class="text-center">Deskripsi</th>
                <th class="text-center">Lampiran</th>
              </tr>
            </thead>
            @php
              $i = 0;
            @endphp
            <tbody>
            @foreach ($data_dokumen as $dokumen)
              <tr>
                <td>{{ $dokumen->updated_at }}</td>
                <td>{{ $dokumen->deskripsi }}</td>
                <td><a class="btn btn-primary btn-sm" href="javascript:void(0)">Download</a></td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- ====== dokumen End ====== -->

    <!-- ====== Features Start ====== -->
    {{-- <section id="features" class="ud-features">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-feature wow fadeInUp" data-wow-delay=".1s">
              <div class="ud-feature-icon">
                <i class="lni lni-gift"></i>
              </div>
              <div class="ud-feature-content">
                <h3 class="ud-feature-title">Free and Open-Source</h3>
                <p class="ud-feature-desc">
                  Lorem Ipsum is simply dummy text of the printing and industry.
                </p>
                <a href="javascript:void(0)" class="ud-feature-link">
                  Learn More
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> --}}
    <!-- ====== Features End ====== -->

    <!-- ====== About Start ====== -->
    <section id="grupwa" class="ud-about">
      <div class="container">
        <div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
          <div class="ud-about-content-wrapper">
            <div class="ud-about-content">
              <span class="tag">Penting</span>
              <h2>Grup WA</h2>
              <p>
                Gabung grup What's App berikut untuk mendapatkan informasi terbaru seputar PKL Informatika Undip!
              </p>
              <a href="javascript:void(0)" class="ud-main-btn">Gabung</a>
            </div>
          </div>
          <div class="ud-about-image">
            <img src="/images/about/about-image.svg" alt="about-image" />
          </div>
        </div>
      </div>
    </section>
    <!-- ====== About End ====== -->

    <!-- ====== FAQ Start ====== -->
    <section id="faq" class="ud-faq">
      <div class="shape">
        <img src="/images/faq/shape.svg" alt="shape" />
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title text-center mx-auto">
              <span>FAQ</span>
              <h2>Any Questions? Answered</h2>
              <p>
                There are many variations of passages of Lorem Ipsum available
                but the majority have suffered alteration in some form.
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".1s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseOne"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>How to use UIdeck?</span>
                </button>
                <div id="collapseOne" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".15s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>How to download icons from Lineicons?</span>
                </button>
                <div id="collapseTwo" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".2s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseThree"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Is GrayGrids part of UIdeck?</span>
                </button>
                <div id="collapseThree" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".1s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseFour"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Can I use this template for commercial project?</span>
                </button>
                <div id="collapseFour" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".15s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseFive"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Do you have plan releasing Play Pro?</span>
                </button>
                <div id="collapseFive" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".2s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseSix"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>Where and how to host this template?</span>
                </button>
                <div id="collapseSix" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== FAQ End ====== -->

    <!-- ====== Testimonials Start ====== -->
    <section id="testimonials" class="ud-testimonials">
      <div class="container">

        <div class="row">
          <div class="col-lg-12">
            <div class="ud-brands wow fadeInUp" data-wow-delay=".2s">
              <div class="ud-title">
                <h6>Trusted and Used by</h6>
              </div>
              <div class="ud-brands-logo">
                <div class="ud-single-logo">
                  <img src="/images/brands/ayroui.svg" alt="ayroui" />
                </div>
                <div class="ud-single-logo">
                  <img src="/images/brands/uideck.svg" alt="uideck" />
                </div>
                <div class="ud-single-logo">
                  <img
                    src="/images/brands/graygrids.svg"
                    alt="graygrids"
                  />
                </div>
                <div class="ud-single-logo">
                  <img
                    src="/images/brands/lineicons.svg"
                    alt="lineicons"
                  />
                </div>
                <div class="ud-single-logo">
                  <img
                    src="/images/brands/ecommerce-html.svg"
                    alt="ecommerce-html"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Testimonials End ====== -->

    <!-- ====== Team Start ====== -->
    <section id="team" class="ud-team">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title mx-auto text-center">
              <span>Our Team</span>
              <h2>Meet The Team</h2>
              <p>
                There are many variations of passages of Lorem Ipsum available
                but the majority have suffered alteration in some form.
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".1s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                  <img src="/images/team/team-01.png" alt="team" />
                </div>
                <img src="/images/team/dotted-shape.svg" alt="shape" class="shape shape-1"/>
                <img src="/images/team/shape-2.svg" alt="shape" class="shape shape-2" />
              </div>
              <div class="ud-team-info">
                <h5>Adveen Desuza</h5>
                <h6>UI Designer</h6>
              </div>
              <ul class="ud-team-socials">
                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                <li><a href="javascript:void(0)"><i class="lni lni-twitter-filled"></i></a></li>
                <li><a href="javascript:void(0)"><i class="lni lni-instagram-filled"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".15s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                  <img src="/images/team/team-02.png" alt="team" />
                </div>
                <img src="/images/team/dotted-shape.svg" alt="shape" class="shape shape-1" />
                <img src="/images/team/shape-2.svg" alt="shape" class="shape shape-2" />
              </div>
              <div class="ud-team-info">
                <h5>Jezmin uniya</h5>
                <h6>Product Designer</h6>
              </div>
              <ul class="ud-team-socials">
                <li>
                  <a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                </li>
                <li>
                  <a href="javascript:void(0)"><i class="lni lni-twitter-filled"></i></a>
                </li>
                <li>
                  <a href="javascript:void(0)"><i class="lni lni-instagram-filled"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Team End ====== -->

    <!-- ====== Contact Start ====== -->
    <section id="contact" class="ud-contact">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-8 col-lg-7">
            <div class="ud-contact-content-wrapper">
              <div class="ud-contact-title">
                <span>CONTACT US</span>
                <h2>
                  Let’s talk about <br />
                  Love to hear from you!
                </h2>
              </div>
              <div class="ud-contact-info-wrapper">
                <div class="ud-single-info">
                  <div class="ud-info-icon">
                    <i class="lni lni-map-marker"></i>
                  </div>
                  <div class="ud-info-meta">
                    <h5>Our Location</h5>
                    <p>401 Broadway, 24th Floor, Orchard Cloud View, London</p>
                  </div>
                </div>
                <div class="ud-single-info">
                  <div class="ud-info-icon">
                    <i class="lni lni-envelope"></i>
                  </div>
                  <div class="ud-info-meta">
                    <h5>How Can We Help?</h5>
                    <p>info@yourdomain.com</p>
                    <p>contact@yourdomain.com</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-5">
            <div
              class="ud-contact-form-wrapper wow fadeInUp"
              data-wow-delay=".2s"
            >
              <h3 class="ud-contact-form-title">Kirim Masukan</h3>
              <form class="ud-contact-form">
                <div class="ud-form-group">
                  <label for="fullName">Full Name*</label>
                  <input
                    type="text"
                    name="fullName"
                    placeholder="Adam Gelius"
                  />
                </div>
                <div class="ud-form-group">
                  <label for="email">Email*</label>
                  <input
                    type="email"
                    name="email"
                    placeholder="example@yourmail.com"
                  />
                </div>
                <div class="ud-form-group">
                  <label for="phone">Phone*</label>
                  <input
                    type="text"
                    name="phone"
                    placeholder="+885 1254 5211 552"
                  />
                </div>
                <div class="ud-form-group">
                  <label for="message">Message*</label>
                  <textarea
                    name="message"
                    rows="1"
                    placeholder="type your message here"
                  ></textarea>
                </div>
                <div class="ud-form-group mb-0">
                  <button type="submit" class="ud-main-btn">
                    Send Message
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Contact End ====== -->

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
                  <img src="/images/logo/logo.svg" alt="logo" />
                </a>
                <p class="ud-widget-desc">
                  We create digital experiences for brands and companies by
                  using technology.
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
      <div class="ud-footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <ul class="ud-footer-bottom-left">
                <li>
                  <a href="javascript:void(0)">Privacy policy</a>
                </li>
                <li>
                  <a href="javascript:void(0)">Support policy</a>
                </li>
                <li>
                  <a href="javascript:void(0)">Terms of service</a>
                </li>
              </ul>
            </div>
            <div class="col-md-4">
              <p class="ud-footer-bottom-right">
                Designed and Developed by
                <a href="https://uideck.com" rel="nofollow">UIdeck</a>
              </p>
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
          // "initComplete": function(settings, json) {
          // 	$.fn.dataTable.ext.search.push(
          // 	function (setting, data, index) {
          // 		if (setting.nTable.id !== 'myTable') {
          // 			return true;
          // 		}
          // 		var selectedStatus = $('#status').val();
          // 		if (selectedStatus == "") {
          // 			return true;
          // 		}
          // 		if (selectedStatus == data[3]) {
          // 			return true;
          // 		}
          // 		return false;
          // 	})
          // }
        });
        $(idTable+'_filter input').css('width', '200px');
        // table.on('order.dt search.dt', function () {
        //   let i = 1;
        //   table
        //     .cells(null, 0, { search: 'applied', order: 'applied' })
        //     .every(function (cell) {
        //         this.data(i++);
        //     });
        // }).draw();
  
        // $('#status').on('change', function() {
        // 	table.draw();
        // })
      
        // $.fn.dataTableExt.afnFiltering.push(
        // 	function (setting, data, index) {
        // 		var selectedStatus = $('#status').val();
        // 		if (selectedStatus == "") {
        // 			return true;
        // 		}
        // 		if (selectedStatus == data[3]) {
        // 			return true;
        // 		}
        // 		return false;
        // 	});
      }
  
      $(document).ready(function() {
        dataTableInit('#tabelPengumuman');
        dataTableInit('#tabelDokumen');
      });
    </script>
  </body>
</html>
