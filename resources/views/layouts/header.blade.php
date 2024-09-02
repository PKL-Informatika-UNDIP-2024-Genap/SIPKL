<nav class="main-header navbar navbar-expand {{ (session()->get('dark_mode'))?"navbar-dark":"navbar-white navbar-light" }}">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link py-0 px-2" data-widget="pushmenu" href="#" role="button"><i class="bi bi-list fs-3 text-black"></i></a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<div class="navbar-nav ml-auto">
		<div class="custom-switch my-auto mr-2">
			<input type="checkbox" class="custom-control-input" id="dark-mode-switcher" {{ (session()->get('dark_mode'))?"checked":"" }}>
			<label class="custom-control-label" for="dark-mode-switcher"></label>
		</div>
		<a href="/logout" class="btn btn-primary" id="btn-logout">Keluar</a>
	</div>
</nav>