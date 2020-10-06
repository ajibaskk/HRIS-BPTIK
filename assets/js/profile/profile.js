$(document).ready(function () {
	$('#photo').on('change', function () {
		var file = $('#photo').prop('files')[0];
		$('.photo-label').html(file['name']);
	});

	$("#submit-profile").click(function (e) {
		if ($(this).data("btn") == "edit") {
			e.preventDefault();
			$(this).parent().prepend('<button id="cancel-profile" class="btn btn-danger">Batal</button>');
			$(this).val("Simpan Profil");
			$(this).removeClass("btn-primary");
			$(this).addClass("btn-success");
			$("#profile #nama").removeAttr("disabled");
			$("#profile #alamat").removeAttr("disabled");
			$("#profile #jenis_kelamin").removeAttr("disabled");
			$("#profile #tempat_lahir").removeAttr("disabled");
			$("#profile #tanggal_lahir").removeAttr("disabled");
			$("#profile #jenjang").removeAttr("disabled");
			$(this).data("btn", "save");
			$("#cancel-profile").click(function () {
				$("#submit-profile").val("Ubah Profil");
				$("#submit-profile").removeClass("btn-success");
				$("#submit-profile").addClass("btn-primary");
				$("#submit-profile").data("btn", "edit");
				$("#profile #nama").attr("disabled", true);
				$("#profile #alamat").attr("disabled", true);
				$("#profile #jenis_kelamin").attr("disabled", true);
				$("#profile #tempat_lahir").attr("disabled", true);
				$("#profile #tanggal_lahir").attr("disabled", true);
				$("#profile #jenjang").attr("disabled", true);
				$(this).remove();
			});
		}
	});

	$("#submit-password").click(function (e) {
		if ($(this).data("btn") == "edit") {
			e.preventDefault();
			$(this).parent().prepend('<button id="cancel-password" class="btn btn-danger">Batal</button>');
			$(this).val("Simpan Password");
			$(this).removeClass("btn-primary");
			$(this).addClass("btn-success");
			$("#password #old-password").removeAttr("disabled");
			$("#password #new-password").removeAttr("disabled");
			$("#password #repeat-new-password").removeAttr("disabled");
			$(this).data("btn", "save");
			$("#cancel-password").click(function () {
				$("#submit-password").val("Ubah Password");
				$("#submit-password").removeClass("btn-success");
				$("#submit-password").addClass("btn-primary");
				$("#submit-password").data("btn", "edit");
				$("#password #old-password").attr("disabled", true);
				$("#password #new-password").attr("disabled", true);
				$("#password #repeat-new-password").attr("disabled", true);
				$(this).remove();
			});
		}
	});

});
