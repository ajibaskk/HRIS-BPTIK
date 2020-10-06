$(document).ready(function () {
	$("#daftar-kehadiran-table").DataTable({
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

	$("#kehadiran").on("change", function () {
		var file = $("#kehadiran").prop("files")[0];
		$("#kehadiran-label").html(file["name"]);
	});

	reloadEvent();

	$("#daftar-kehadiran-table").on("DOMSubtreeModified", function () {
		reloadEvent();
	});

	function reloadEvent() {
		$(".analisis-kehadiran").click(function () {
			var id = $(this).data("id");
			var month = $("#bulan-kehadiran").val();
			var year = $("#tahun-kehadiran").val();
			var color = {
				green: "#28A745",
				yellow: "#FFC107",
				red: "#DC3545",
				blue: "#007BFF",
				cyan: "#17A2B8",
				grey: "#6C757D"
			};

			$("#modal-analisis #data1").html(
				'<canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>'
			);
			$("#modal-analisis #data2").html(
				'<canvas id="donutChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>'
			);

			$.ajax({
				type: "get",
				url: base_url + "Ajax/getAnalisisAbsen/" + id + "/" + month + "/" + year,
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
							$("#modal-analisis #user-photo").attr(
								"src",
								"data:image/jpeg;base64," + user["foto"]
							);
						} else {
							$("#modal-analisis #user-photo").attr(
								"src",
								base_url + "/assets/img/user.svg"
							);
						}
						$("#modal-analisis #nama").html(user["nama"]);
						$("#modal-analisis #nip").html(user["nip"]);

						var donutChartCanvas = $("#donutChart")
							.get(0)
							.getContext("2d");
						var donutData = {
							labels: ["Hadir", "Cuti", "Dinas Luar", "Tidak Masuk"],
							datasets: [{
								data: [
									user["hadir"],
									user["cuti"],
									user["dinas_luar"],
									user["tidak_hadir"]
								],
								backgroundColor: [
									color["green"],
									color["blue"],
									color["cyan"],
									color["red"]
								]
							}]
						};
						var donutOptions = {
							maintainAspectRatio: false,
							responsive: true
						};

						var donutChart = new Chart(donutChartCanvas, {
							type: "doughnut",
							data: donutData,
							options: donutOptions
						});

						var donutChartCanvas2 = $("#donutChart2")
							.get(0)
							.getContext("2d");

						var donutData2 = {
							labels: ["Terlambat", "Tepat Waktu"],
							datasets: [{
								data: [user["late"], user["ontime"]],
								backgroundColor: [color["yellow"], color["green"]]
							}]
						};

						var donutOptions2 = {
							maintainAspectRatio: false,
							responsive: true
						};

						var donutChart2 = new Chart(donutChartCanvas2, {
							type: "doughnut",
							data: donutData2,
							options: donutOptions2
						});

						$("#modal-analisis").modal("show");
					} catch (error) {
						$("#modal-analisis .modal-body").html(
							"<div><p>" + error + "</p></div>"
						);
						$("#modal-analisis").modal("show");
					}
				}
			});
		});
	}
});
