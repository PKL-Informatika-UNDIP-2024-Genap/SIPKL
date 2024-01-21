@extends('layouts.main_mhs')

{{-- @push('styles')
  <style>
    .timeline-icon {
      background-color: #adb5bd;
      border-radius: 50%;
      font-size: 16px;
      height: 30px;
      left: 18px;
      line-height: 30px;
      position: absolute;
      text-align: center;
      top: 0;
      width: 30px;
    }
  </style>
@endpush --}}

@section('container')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- /.row (main row) -->
      <!-- Timelime example  -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <div class="timeline">
            <!-- timeline time label -->
            <div class="time-label">
              <span class="bg-red">21 Jan 2024</span>
            </div>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <div>
              <i class="fas bi bi-envelope-fill bg-blue"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas bi bi-clock"></i> 12:05</span>
                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                <div class="timeline-body">
                  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                  weebly ning heekya handango imeem plugg dopplr jibjab, movity
                  jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                  quora plaxo ideeli hulu weebly balihoo...
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-primary btn-sm">Read more</a>
                  <a class="btn btn-danger btn-sm">Delete</a>
                </div>
              </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
              <i class="fas bi bi-person-fill bg-green"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas bi bi-clock"></i> 5 mins ago</span>
                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
              </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
              <i class="fas bi bi-chat-fill bg-yellow"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas bi bi-clock"></i> 27 mins ago</span>
                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                <div class="timeline-body">
                  Take me to your leader!
                  Switzerland is small and neutral!
                  We are more like Germany, ambitious and misunderstood!
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-sm">View comment</a>
                </div>
              </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline time label -->
            <div class="time-label">
              <span class="bg-green">5 Jan 2024</span>
            </div>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <div>
              <i class="fa bi bi-camera-fill bg-purple"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas bi bi-clock"></i> 2 days ago</span>
                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                <div class="timeline-body">
                  <img src="https://placehold.it/150x100" alt="...">
                  <img src="https://placehold.it/150x100" alt="...">
                  <img src="https://placehold.it/150x100" alt="...">
                  <img src="https://placehold.it/150x100" alt="...">
                  <img src="https://placehold.it/150x100" alt="...">
                </div>
              </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
              <i class="fas bi bi-camera-video-fill bg-maroon"></i>

              <div class="timeline-item">
                <span class="time"><i class="fas bi bi-clock"></i> 5 days ago</span>

                <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>

                <div class="timeline-body">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen></iframe>
                  </div>
                </div>
                <div class="timeline-footer">
                  <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                </div>
              </div>
            </div>
            <!-- END timeline item -->
            <div>
              <i class="fas bi bi-clock bg-gray"></i>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
