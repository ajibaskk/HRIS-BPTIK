$(document).ready(function () {
	var nip = $("#nip").val();
	var month_kehadiran = $("#bulan-kehadiran").val();
	var year_kehadiran = $("#tahun-kehadiran").val();
	var month_keterlambatan = $("#bulan-keterlambatan").val();
	var year_keterlambatan = $("#tahun-keterlambatan").val();

	var color = {
		green: "#28A745",
		yellow: "#FFC107",
		red: "#DC3545",
		blue: "#007BFF",
		cyan: "#17A2B8",
		grey: "#6C757D"
	};

	setChartKehadiran(month_kehadiran, year_kehadiran);
	setChartKeterlambatan(month_keterlambatan, year_keterlambatan);

	$("#tahun-kehadiran").on("change", function () {
		month_kehadiran = $("#bulan-kehadiran").val();
		year_kehadiran = $("#tahun-kehadiran").val();
		setChartKehadiran(month_kehadiran, year_kehadiran);
	});

	$("#bulan-kehadiran").on("change", function () {
		month_kehadiran = $("#bulan-kehadiran").val();
		year_kehadiran = $("#tahun-kehadiran").val();
		setChartKehadiran(month_kehadiran, year_kehadiran);
	});

	$("#tahun-keterlambatan").on("change", function () {
		month_kehadiran = $("#bulan-keterlambatan").val();
		year_kehadiran = $("#tahun-keterlambatan").val();
		setChartKeterlambatan(month_kehadiran, year_kehadiran);
	});

	$("#bulan-keterlambatan").on("change", function () {
		month_kehadiran = $("#bulan-keterlambatan").val();
		year_kehadiran = $("#tahun-keterlambatan").val();
		setChartKeterlambatan(month_kehadiran, year_kehadiran);
	});

	function setChartKehadiran(month, year) {
		$("#data1").html(
			'<canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>'
		);
		$.ajax({
			type: "post",
			url:
				base_url +
				"Ajax/getAnalisisKehadiran/" +
				nip +
				"/" +
				month +
				"/" +
				year,
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
					var donutChartCanvas = $("#donutChart")
						.get(0)
						.getContext("2d");

					var donutData = {
						labels: ["Hadir", "Cuti", "Dinas Luar", "Tidak Masuk"],
						datasets: [
							{
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
							}
						]
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
				} catch (error) { }
			}
		});
	}

	function setChartKeterlambatan(month, year) {
		$("#data2").html(
			'<canvas id="donutChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>'
		);
		$.ajax({
			type: "post",
			url:
				base_url +
				"Ajax/getAnalisisKeterlambatan/" +
				nip +
				"/" +
				month +
				"/" +
				year,
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
					var donutChartCanvas = $("#donutChart2")
						.get(0)
						.getContext("2d");
					var donutData = {
						labels: ["Terlambat", "Tepat Waktu"],
						datasets: [
							{
								data: [user["late"], user["ontime"]],
								backgroundColor: [color["yellow"], color["green"]]
							}
						]
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
				} catch (error) { }
			}
		});
	}
});
