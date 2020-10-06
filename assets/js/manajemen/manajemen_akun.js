$(document).ready(function () {
	$("#manajemen-akun-table").DataTable({
		paging: true,
		lengthChange: false,
		searching: true,
		ordering: true,
		info: true,
		autoWidth: false,
		language: {
			search: "Cari:",
			zeroRecords: "Data tidak ditemukan",
			info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
			infoFiltered: "(disaring dari _MAX_ total data)",
			paginate: {
				first: "Pertama",
				last: "Terakhir",
				next: "Selanjutnya",
				previous: "Sebelumnya"
			}
		}
	});

	reloadEvent();

	$("#manajemen-akun-table").on("DOMSubtreeModified", function () {
		reloadEvent();
	});

	function reloadEvent() {
		$(".detail-btn").click(function () {
			var nip = $(this).data("id");
			$.ajax({
				type: "get",
				url: base_url + "Ajax/getUser/" + nip,
				dataType: "json",
				beforeSend: function () {
					$("#loading-modal .modal-body>p").html("Mengambil Data. . .");
					$("#loading-modal").modal("show");
				},
				complete: function () {
					$("#loading-modal").modal("hide");
				},
				success: function (response) {
					var user = response;
					try {
						if (user["foto"] != "") {
							$("#modal-detail #user-photo").attr(
								"src",
								"data:image/jpeg;base64," + user["foto"]
							);
						} else {
							$("#modal-detail #user-photo").attr(
								"src",
								base_url + "/assets/img/user.svg"
							);
						}
						$("#modal-detail #nama").html(user["nama"]);
						$("#modal-detail #nip").html(user["nip"]);
						$("#modal-detail #unit-kerja").html(user["nama_unit"]);
						$("#modal-detail #tempat-lahir").html(user["tempat_lahir"]);
						if (user["tanggal_lahir"] != "0000-00-00") {
							var tanggal = moment(user["tanggal_lahir"]).format("DD/MM/YYYY");
						} else {
							var tanggal = "00/00/0000";
						}
						$("#modal-detail #tanggal-lahir").html(tanggal);
						var jk = "";
						if (user["jenis_kelamin"] == 0) {
							jk = "Laki-laki";
						} else {
							jk = "Perempuan";
						}
						var j = "";
						if (user["jenjang"] == 0) {
							j = "SMA/SMK";
						} else if (user["jenjang"] == 1) {
							j = "D3";
						} else if (user["jenjang"] == 2) {
							j = "S1";
						} else if (user["jenjang"] == 3) {
							j = "S2";
						} else if (user["jenjang"] == 4) {
							j = "S3";
						}
						$("#modal-detail #jenjang").html(j);
						$("#modal-detail #alamat").html(user["alamat"]);
						$("#modal-detail #jenis-kelamin").html(jk);
						var lv = "";
						if (user["level"] == 0) {
							lv = "Admin";
						} else if (user["level"] == 1) {
							lv = "Pimpinan";
						} else {
							lv = "Pegawai";
						}
						$("#modal-detail #level").html(lv);
						$("#modal-detail").modal("show");
					} catch (error) {
						$("#modal-detail .modal-body").html(
							"<div><p>" + error + "</p></div>"
						);
					}
				}
			});
		});

		$(".ubah-btn").click(function () {
			var nip = $(this).data("id");
			$.ajax({
				type: "get",
				url: base_url + "Ajax/getUser/" + nip,
				dataType: "json",
				beforeSend: function () {
					$("#loading-modal .modal-body>p").html("Mengambil Data. . .");
					$("#loading-modal").modal("show");
				},
				complete: function () {
					$("#loading-modal").modal("hide");
				},
				success: function (response) {
					var user = response;
					try {
						$("#modal-ubah #nama").val(user["nama"]);
						$("#modal-ubah #nip").val(user["nip"]);
						$("#modal-ubah #nip-hidden").val(user["nip"]);
						$("#modal-ubah #alamat").val(user["alamat"]);
						$("#modal-ubah #jenjang").val(user["jenjang"]);
						$("#modal-ubah #unit-kerja").val(user["nama_unit"]);
						$("#modal-ubah #tempat-lahir").val(user["tempat_lahir"]);
						$("#modal-ubah #tanggal-lahir").val(user["tanggal_lahir"]);
						$("#modal-ubah #reset-password-btn").data("id", user["nip"]);
						$("#modal-ubah #reset-password-btn").data("name", user["nama"]);
						$("#modal-ubah #edit-akun").val(user["nip"]);

						if (user["unit_kerja"] == 0) {
							$("#modal-ubah #unit-kerja-0").prop("selected", true);
							$("#modal-ubah #unit-kerja-1").prop("selected", false);
							$("#modal-ubah #unit-kerja-2").prop("selected", false);
							$("#modal-ubah #unit-kerja-3").prop("selected", false);
						} else if (user["unit_kerja"] == 1) {
							$("#modal-ubah #unit-kerja-0").prop("selected", false);
							$("#modal-ubah #unit-kerja-1").prop("selected", true);
							$("#modal-ubah #unit-kerja-2").prop("selected", false);
							$("#modal-ubah #unit-kerja-3").prop("selected", false);
						} else if (user["unit_kerja"] == 2) {
							$("#modal-ubah #unit-kerja-0").prop("selected", false);
							$("#modal-ubah #unit-kerja-1").prop("selected", false);
							$("#modal-ubah #unit-kerja-2").prop("selected", true);
							$("#modal-ubah #unit-kerja-3").prop("selected", false);
						} else if (user["unit_kerja"] == 3) {
							$("#modal-ubah #unit-kerja-0").prop("selected", false);
							$("#modal-ubah #unit-kerja-1").prop("selected", false);
							$("#modal-ubah #unit-kerja-2").prop("selected", false);
							$("#modal-ubah #unit-kerja-3").prop("selected", true);
						}

						if (user["jenjang"] == 0) {
							$("#modal-ubah #jenjang-0").prop("selected", true);
							$("#modal-ubah #jenjang-1").prop("selected", false);
							$("#modal-ubah #jenjang-2").prop("selected", false);
							$("#modal-ubah #jenjang-3").prop("selected", false);
							$("#modal-ubah #jenjang-4").prop("selected", false);
						} else if (user["jenjang"] == 1) {
							$("#modal-ubah #jenjang-0").prop("selected", false);
							$("#modal-ubah #jenjang-1").prop("selected", true);
							$("#modal-ubah #jenjang-2").prop("selected", false);
							$("#modal-ubah #jenjang-3").prop("selected", false);
							$("#modal-ubah #jenjang-4").prop("selected", false);
						} else if (user["jenjang"] == 2) {
							$("#modal-ubah #jenjang-0").prop("selected", false);
							$("#modal-ubah #jenjang-1").prop("selected", false);
							$("#modal-ubah #jenjang-2").prop("selected", true);
							$("#modal-ubah #jenjang-3").prop("selected", false);
							$("#modal-ubah #jenjang-4").prop("selected", false);
						} else if (user["jenjang"] == 3) {
							$("#modal-ubah #jenjang-0").prop("selected", false);
							$("#modal-ubah #jenjang-1").prop("selected", false);
							$("#modal-ubah #jenjang-2").prop("selected", false);
							$("#modal-ubah #jenjang-3").prop("selected", true);
							$("#modal-ubah #jenjang-4").prop("selected", false);
						} else if (user["jenjang"] == 4) {
							$("#modal-ubah #jenjang-0").prop("selected", false);
							$("#modal-ubah #jenjang-1").prop("selected", false);
							$("#modal-ubah #jenjang-2").prop("selected", false);
							$("#modal-ubah #jenjang-3").prop("selected", false);
							$("#modal-ubah #jenjang-4").prop("selected", true);
						}

						if (user["jenis_kelamin"] == 0) {
							$("#modal-ubah #jenis-kelamin-0").prop("selected", true);
							$("#modal-ubah #jenis-kelamin-1").prop("selected", false);
						} else {
							$("#modal-ubah #jenis-kelamin-0").prop("selected", false);
							$("#modal-ubah #jenis-kelamin-1").prop("selected", true);
						}

						if (user["level"] == 2) {
							$("#modal-ubah #level-0").prop("selected", false);
							$("#modal-ubah #level-1").prop("selected", false);
							$("#modal-ubah #level-2").prop("selected", true);
						} else if (user["level"] == 1) {
							$("#modal-ubah #level-0").prop("selected", false);
							$("#modal-ubah #level-1").prop("selected", true);
							$("#modal-ubah #level-2").prop("selected", false);
						} else {
							$("#modal-ubah #level-0").prop("selected", true);
							$("#modal-ubah #level-1").prop("selected", false);
							$("#modal-ubah #level-2").prop("selected", false);
						}
						$("#modal-ubah").modal("show");
					} catch (error) {
						$("#modal-ubah .modal-body").html(
							"<div><p>" + error + "</p></div>"
						);
					}
				}
			});
		});

		$(".hapus-btn").click(function () {
			var nip = $(this).data("id");
			var nama = $(this)
				.parent()
				.siblings(".nama")
				.html();
			$("#modal-hapus .modal-body p").html(
				"Anda yakin menghapus akun " + nama + " (NIP." + nip + ")?"
			);
			$("#modal-hapus #hapus-akun").val(nip);
			$("#modal-hapus").modal("show");
		});

		$("#modal-ubah #reset-password-btn").click(function () {
			var nip = $(this).data("id");
			var nama = $(this).data("name");
			$("#modal-reset-password .modal-body p").html(
				"Anda yakin mereset password akun " + nama + " (NIP." + nip + ")?"
			);
			$("#modal-reset-password #reset-password-akun").val(nip);
			$("#modal-ubah").modal("hide");
			$("#modal-reset-password").modal("show");
		});
	}
});
