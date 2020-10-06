$(document).ready(function () {
	$("#dinas-luar-table").DataTable({
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

	$("#dinas-luar-table").on("DOMSubtreeModified", function () {
		reloadEvent();
	});

	function reloadEvent() {
		$("#file-cuti").on("change", function () {
			var file = $("#file-cuti").prop("files")[0];
			$("#file-label").html(file["name"]);
		});

		$(".ubah-btn").click(function () {
			var id = $(this).data("id");
			$.ajax({
				type: "get",
				url: base_url + "Ajax/getCuti2/" + id,
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
						$("#modal-ubah #nama").html(user["nama"]);
						$("#modal-ubah #nama").attr("selected", true);
						$("#modal-ubah #unit-kerja").val(user["unit_kerja"]);
						$("#modal-ubah #unit-kerja").html(user["nama_unit"]);
						$("#modal-ubah #unit-kerja").attr("selected", true);
						$("#modal-ubah #nip").val(user["nip"]);
						$("#modal-ubah #tanggal-awal").val(user["tanggal_cuti_mulai"]);
						$("#modal-ubah #tanggal-akhir").val(user["tanggal_cuti_akhir"]);
						$("#modal-ubah #id").val(id);
						$("#modal-ubah").modal("show");

						$("#modal-ubah #view-file").click(function () {
							$("#view-modal .frame").attr(
								"src",
								"data:application/pdf;base64," + user["file"]
							);
							$("#modal-ubah").modal("hide");
							$("#view-modal").modal("show");
							$("#view-modal #back-btn").click(function () {
								$("#view-modal").modal("hide");
								$("#modal-ubah").modal("show");
							});
						});
					} catch (error) {
						$("#modal-ubah .modal-body").html(
							"<div><p>" + error + "</p></div>"
						);
						$("#modal-ubah").modal("show");
					}
				}
			});
		});

		$("#modal-ubah #file-cuti").on("change", function () {
			var file = $("#modal-ubah #file-cuti").prop("files")[0];
			$("#modal-ubah #file-label").html(file["name"]);
		});

		$(".hapus-btn").click(function () {
			var id = $(this).data("id");
			var nama = $(this)
				.parent()
				.siblings(".nama")
				.html();

			$("#modal-hapus .modal-body p").html(
				"Anda yakin menghapus dinas luar " + nama
			);
			$("#modal-hapus #hapus-dl").val(id);
			$("#modal-hapus").modal("show");
		});

		$(".tampil-btn").click(function () {
			var id = $(this).data("id");
			$.ajax({
				type: "get",
				url: base_url + "Ajax/getCuti2/" + id,
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
						$("#view-modal .frame").attr(
							"src",
							"data:application/pdf;base64," + user["file"]
						);
						$("#view-modal").modal("show");
						$("#view-modal #back-btn").click(function () {
							$("#view-modal").modal("hide");
						});
					} catch (error) {
						$("#view-modal .modal-body").html(
							"<div><p>" + error + "</p></div>"
						);
						$("#view-modal").modal("show");
					}
				}
			});
		});

		$("#modal-tambah #nama-pegawai").on("change", function () {
			var nip = $(this).val();
			$.ajax({
				type: "get",
				url: base_url + "Ajax/getUser/" + nip,
				dataType: "json",
				success: function (response) {
					var user = response;
					try {
						$("#modal-tambah #nip").val(user["nip"]);
						$("#modal-tambah #unit-kerja").val(user["unit_kerja"]);
						$("#modal-tambah #unit-kerja").html(user["nama_unit"]);
						$("#modal-tambah #unit-kerja").attr("selected", true);
					} catch (error) {
						alert(error);
					}
				}
			});
		});
	}
});
