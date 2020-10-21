$(document).ready(function () {
	$("#manajemen-pegawai-table").DataTable({
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

	$("#manajemen-pegawai-table").on("DOMSubtreeModified", function () {
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
						$("#modal-detail #alamat").html(user["alamat"]);
						$("#modal-detail #unit-kerja").html(user["nama_unit"]);
						$("#modal-detail #tempat-lahir").html(user["tempat_lahir"]);
						if (user["tanggal_lahir"] != "0000-00-00") {
							var tanggalLahir = moment(user["tanggal_lahir"]).format(
								"DD/MM/YYYY"
							);
						} else {
							var tanggalLahir = "00/00/0000";
						}
						$("#modal-detail #tanggal-lahir").html(tanggalLahir);
						var jk = "";
						if (user["jenis_kelamin"] === 0) {
							jk = "Laki-laki";
						} else {
							jk = "Perempuan";
						}
						$("#modal-detail #jenis-kelamin").html(jk);

						var j = "";
						if (user["jenjang"] === 0) {
							j = "SMA/SMK";
						} else if (user["jenjang"] === 1) {
							j = "D3";
						} else if (user["jenjang"] === 2) {
							j = "S1";
						} else if (user["jenjang"] === 3) {
							j = "S2";
						} else if (user["jenjang"] === 4) {
							j = "S3";
						}
						$("#modal-detail #jenjang").html(j);
						$("#modal-detail").modal("show");
					} catch (error) {
						$("#modal-detail .modal-body").html(
							"<div><p>" + error + "</p></div>"
						);
						$("#modal-detail").modal("show");
					}
				}
			});
		});
	}
});
