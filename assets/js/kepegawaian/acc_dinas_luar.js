function printImg(url) {
	var win = window.open('');
	win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
	win.focus();
}

$(document).ready(function () {
	$("#dinas-luar-table").DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"language": {
			"search": "Cari:",
			"zeroRecords": "Data tidak ditemukan",
			"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
			"infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
			"infoFiltered": "(disaring dari _MAX_ total data)",
			"paginate": {
				"first": "Pertama",
				"last": "Terakhir",
				"next": "Selanjutnya",
				"previous": "Sebelumnya"
			}
		}
	});

	reloadEvent();

	$("#dinas-luar-table").on("DOMSubtreeModified", function () {
		reloadEvent();
	});


	function reloadEvent() {

		$(".detail-btn").click(function () {
			var id = $(this).data("id");
			$.ajax({
				type: "get",
				url: base_url + "Ajax/getCuti2/" + id,
				dataType: "json",
				beforeSend: function () {
					$("#loading-modal .modal-body>p").html('Mengambil Data. . .');
					$("#loading-modal").modal("show");
				},
				complete: function () {
					$("#loading-modal").modal("hide");
				},
				success: function (response) {
					var cuti = response;
					try {
						// alert(id);
						if (cuti["foto"] != "") {
							$("#modal-detail #user-photo").attr("src", "data:image/jpeg;base64," + cuti["foto"]);
						} else {
							$("#modal-detail #user-photo").attr("src", base_url + "/assets/img/user.svg");
						}
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
						if (cuti["tanggal_cuti_mulai"] != "0000-00-00") {
							var tanggalCutiMulai = moment(cuti["tanggal_cuti_mulai"]).format(
								"DD/MM/YYYY"
							);
						} else {
							var tanggalCutiMulai = "00/00/0000";
						}
						$("#modal-detail #tanggal-cuti-mulai").html(tanggalCutiMulai);
						if (cuti["tanggal_cuti_akhir"] != "0000-00-00") {
							var tanggalCutiAkhir = moment(cuti["tanggal_cuti_akhir"]).format(
								"DD/MM/YYYY"
							);
						} else {
							var tanggalCutiAkhir = "00/00/0000";
						}
						$("#modal-detail #tanggal-cuti-akhir").html(tanggalCutiAkhir);
						$("#modal-detail #alasan-cuti").html(cuti["alasan"]);
						var jk = "";
						if (cuti["jenis_kelamin"] == 0) {
							jk = "Laki-laki";
						} else {
							jk = "Perempuan";
						}
						$("#modal-detail #jenis-kelamin").html(jk);
						var c = "";
						if (cuti["persetujuan"] == 0) {
							c = "Belum Disetujui";
						} else if (cuti["persetujuan"] == 1) {
							c = "Disetujui";
							$("#batal-cuti").removeAttr("disabled");
							$("#setuju-cuti").attr("disabled", true);
							$("#tolak-cuti").attr("disabled", true);
						} else {
							c = "Ditolak";
							$("#batal-cuti").removeAttr("disabled");
							$("#setuju-cuti").attr("disabled", true);
							$("#tolak-cuti").attr("disabled", true);
						}
						$("#modal-detail #persetujuan").html(c);
						$("#tolak-cuti").val(id);
						$("#setuju-cuti").val(id);
						$("#batal-cuti").val(id);

						$("#modal-detail").modal("show");

						$("#modal-detail #view-file").click(function () {
							if (cuti["type"] == 0) {
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
							} else if (cuti["type"] == 1) {
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
							'<div><p>' +
							error +
							'</p></div>'
						);
						$("#modal-detail").modal("show");
					}
				}
			});

		});

		$(".hapus-btn").click(function () {
			var id = $(this).data("id");

			$("#modal-hapus .modal-body p").html("Anda yakin menghapus dinas luar ini ?");
			$("#modal-hapus #hapus-cuti").val(id);
			$("#modal-hapus").modal("show");
		});

	};

});
