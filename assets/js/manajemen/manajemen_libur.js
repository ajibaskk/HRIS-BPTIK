$(document).ready(function () {
	$("#manajemen-libur-table").DataTable({
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

	$("#manajemen-libur-table").on("DOMSubtreeModified", function () {
		reloadEvent();
	});

	function reloadEvent() {
		$(".ubah-btn").click(function () {
			var id = $(this).data("id");
			$.ajax({
				type: "get",
				url: base_url + "Ajax/getLibur/" + id,
				dataType: "json",
				beforeSend: function () {
					$("#loading-modal .modal-body>p").html("Mengambil Data. . .");
					$("#loading-modal").modal("show");
				},
				complete: function () {
					$("#loading-modal").modal("hide");
				},
				success: function (response) {
					var libur = response;
					try {
						$("#modal-ubah #nama-hari-libur").val(libur["nama_hari_libur"]);
						$("#modal-ubah #tanggal").val(libur["tanggal"]);
						$("#modal-ubah #edit-hari-libur").val(id);
						$("#modal-ubah").modal("show");
					} catch (error) {
						$("#modal-ubah .modal-body").html(
							"<div><p>" + error + "</p></div>"
						);
						$("#modal-ubah").modal("show");
					}
				}
			});
		});

		$(".hapus-btn").click(function () {
			var id = $(this).data("id");
			var nama = $(this)
				.parent()
				.siblings(".nama")
				.html();
			$("#modal-hapus .modal-body p").html(
				"Anda yakin menghapus hari libur " + nama
			);
			$("#modal-hapus #hapus-hari-libur").val(id);
			$("#modal-hapus").modal("show");
		});
	}
});
