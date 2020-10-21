$(document).ready(function () {
	$("#riwayat-cuti-pegawai-table").DataTable({
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

	$("#riwayat-cuti-pegawai-table").on("DOMSubtreeModified", function () {
		reloadEvent();
	});

	function reloadEvent() {
		$(".detail-btn").click(function () {
			$("#modal-detail #view-file").unbind();
			var id = $(this).data("id");
			$.ajax({
				type: "get",
				url: base_url + "Ajax/getCuti/" + id,
				dataType: "json",
				beforeSend: function () {
					$("#loading-modal .modal-body>p").html("Mengambil Data. . .");
					$("#loading-modal").modal("show");
				},
				complete: function () {
					$("#loading-modal").modal("hide");
				},
				success: function (response) {
					var cuti = response;
					try {
						$("#modal-detail #nama").html(cuti["nama"]);
						$("#modal-detail #nip").html(cuti["nip"]);
						$("#modal-detail #alamat").html(cuti["alamat"]);
						$("#modal-detail #unit-kerja").html(cuti["nama_unit"]);
						$("#modal-detail #tempat-lahir").html(cuti["tempat_lahir"]);
						if (cuti["tanggal_lahir"] != "0000-00-00") {
							var tanggalLahir = moment(cuti["tanggal_lahir"]).format(
								"DD/MM/YYYY"
							);
						} else {
							var tanggalLahir = "00/00/0000";
						}
						$("#modal-detail #tanggal-lahir").html(tanggalLahir);
						$("#modal-detail #jenis-kelamin").html(cuti["jenis_kelamin"]);
						$("#modal-detail #jenis-cuti").html(cuti["jenis"]);
						$("#modal-detail #tanggal-cuti-mulai").html(
							cuti["tanggal_cuti_mulai"]
						);
						$("#modal-detail #tanggal-cuti-akhir").html(
							cuti["tanggal_cuti_akhir"]
						);
						$("#modal-detail #alasan-cuti").html(cuti["alasan"]);
						var jk = "";
						if (cuti["jenis_kelamin"] === 0) {
							jk = "Laki-laki";
						} else {
							jk = "Perempuan";
						}
						$("#modal-detail #jenis-kelamin").html(jk);
						var c = "";
						if (cuti["persetujuan"] === 0) {
							c = "Belum Disetujui";
						} else if (cuti["persetujuan"] === 1) {
							c = "Disetujui";
						} else {
							c = "Ditolak";
						}
						$("#modal-detail #persetujuan").html(c);
						$("#modal-detail").modal("show");

						$("#modal-detail #view-file").click(function () {
							if (cuti["type"] === 0) {
								$("#view-modal object.modal-body").attr(
									"data",
									"data:application/pdf;base64," + cuti["file"]
								);
								$("#view-modal object.modal-body>.download").attr(
									"href",
									"data:application/pdf;base64," + cuti["file"]
								);
								$("#view-modal object.modal-body>.download").attr(
									"download",
									"Surat Cuti " + cuti["nama"] + " (" + moment(cuti["tanggal_cuti_mulai"]).format("DD-MM-YYYY") + " - " + moment(cuti["tanggal_cuti_akhir"]).format("DD-MM-YYYY") + ")"
								);
								$("#modal-detail").modal("hide");
								$("#view-modal").modal("show");
								$("#view-modal #back-btn").click(function () {
									$("#view-modal").modal("hide");
									$("#modal-detail").modal("show");
								});
							} else if (cuti["type"] === 1) {
								$("#view-modal-pict .modal-body>img").attr(
									"src",
									"data:image/jpeg;base64," + cuti["file"]
								);
								$("#view-modal-pict .modal-footer>.download").attr(
									"href",
									"data:image/jpeg;base64," + cuti["file"]
								);
								$("#view-modal-pict .modal-footer>.download").attr(
									"download",
									"Surat Cuti " + cuti["nama"] + " Tanggal " + cuti["tanggal_cuti_mulai"] + "-" + cuti["tanggal_cuti_akhir"]
								);
								$("#modal-detail").modal("hide");
								$("#view-modal-pict").modal("show");
								$("#view-modal-pict #back-btn").click(function () {
									$("#view-modal-pict").modal("hide");
									$("#modal-detail").modal("show");
								});
							}
						});
					} catch (error) {
						$("#modal-detail .modal-body").html(
							"<div><p>" + error + "</p></div>"
						);
						$("#modal-detail").modal("show");
					}
				}
			});
		});

		$(".hapus-btn").click(function () {
			var id = $(this).data("id");

			$("#modal-hapus .modal-body p").html(
				"Anda yakin menghapus riwayat cuti ?"
			);
			$("#modal-hapus #hapus-cuti").val(id);
			$("#modal-hapus").modal("show");
		});
	}
});
