function activateDarkMode() {
	$('body').addClass('dark-mode');
	// change data-bs-theme to dark
	$('body').attr('data-bs-theme', 'dark');
	// add navbar-dark
	$('nav.main-header').addClass('navbar-dark');
	// remove navbar-white and navbar-light
	$('nav.main-header').removeClass('navbar-white navbar-light');
	// add session dark-mode
	$.ajax({
		url: '/dark-mode',
		type: 'POST',
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
			dark_mode: 1
		},
		success: function(response) {
			// console.log(response);
		}
	});
}

function deactivateDarkMode() {
	$('body').removeClass('dark-mode');
	// change data-bs-theme to light
	$('body').attr('data-bs-theme', 'light');
	// add navbar-white and navbar-light
	$('nav.main-header').addClass('navbar-white navbar-light');
	// remove navbar-dark
	$('nav.main-header').removeClass('navbar-dark');
	// remove session dark-mode
	$.ajax({
		url: '/dark-mode',
		type: 'POST',
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
			dark_mode: 0
		},
		success: function(response) {
			// console.log(response);
		}
	});
}

$('#dark-mode-switcher').on('change', function() {
	if ($(this).is(':checked')) {
		activateDarkMode();
	} else {
		deactivateDarkMode();
	}
});

$(document).ready(function() {
	// Logout
	$('#btn-logout').on('click', function (e) {
		e.preventDefault();
		this.innerHTML = `
			<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
			Keluar...
		`;
		Swal.fire({
			title: 'Yakin ingin keluar?',
			text: "Anda akan diarahkan ke halaman awal.",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#007bff',
			cancelButtonColor: '#dc3545',
			confirmButtonText: 'Ya, keluar!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = "/logout";
			} else {
				this.innerHTML = `Keluar`;
			}
		})
	})
});