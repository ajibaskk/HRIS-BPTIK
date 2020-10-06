$(document).ready(function () {
	$(".analisis-kehadiran").click(function (e) {
		$("#tahun-kehadiran").unbind();
		$("#bulan-kehadiran").unbind();
		var unitId = $(this).data("unit");

		setChart(unitId);

		$("#tahun-kehadiran").on("change", function () {
			setChart(
				unitId,
				$("#bulan-kehadiran").val(),
				$("#tahun-kehadiran").val()
			);
		});

		$("#bulan-kehadiran").on("change", function () {
			setChart(
				unitId,
				$("#bulan-kehadiran").val(),
				$("#tahun-kehadiran").val()
			);
		});

		function setChart(unitId, month = 0, year = 0) {
			var color = {
				green: "#28A745",
				yellow: "#FFC107",
				red: "#DC3545",
				blue: "#007BFF",
				cyan: "#17A2B8",
				grey: "#6C757D"
			};

			$.ajax({
				type: "get",
				url: base_url +
					"Ajax/getAnalisisKehadiranUnit/" +
					unitId +
					"/" +
					month +
					"/" +
					year,
				dataType: "json",
				beforeSend: function () {
					$("#modal-analisis .data").html(
						'<div class="text-center align-middle"><p>Mengambil data...</p><img src=" ' +
						base_url +
						'assets/img/loading.svg" alt="loading"></div>'
					);
				},
				success: function (response) {
					var unit = response;
					try {
						$("#modal-analisis .data1").html(
							'<canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>'
						);
						$("#modal-analisis .data2").html(
							'<canvas id="donutChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>'
						);
						$("#modal-analisis .modal-title").html(
							"Analisis Kehadiran " + unit["nama_unit"]
						);
						$("#modal-analisis #jumlah-pegawai").html(
							"Jumlah Pegawai: " + unit["jumlah_pegawai"]
						);
						if (year == 0) {
							var row = "";
							for (var i = 0; i < unit["list_year"].length; i++) {
								if (i + 1 == unit["list_year"].length) {
									row +=
										'<option value="' +
										unit["list_year"][i] +
										'" selected>' +
										unit["list_year"][i] +
										"</option>";
								} else {
									row +=
										'<option value="' +
										unit["list_year"][i] +
										'">' +
										unit["list_year"][i] +
										"</option>";
								}
							}
							$("#tahun-kehadiran").html(row);
						} else {
							var row = "";
							for (var i = 0; i < unit["list_year"].length; i++) {
								if (unit["list_year"][i] == year) {
									row +=
										'<option value="' +
										unit["list_year"][i] +
										'" selected>' +
										unit["list_year"][i] +
										"</option>";
								} else {
									row +=
										'<option value="' +
										unit["list_year"][i] +
										'">' +
										unit["list_year"][i] +
										"</option>";
								}
							}
							$("#tahun-kehadiran").html(row);
						}

						if (month == 0) {
							var row = "";
							for (var i = 0; i < unit["list_month"].length; i++) {
								if (i + 1 == unit["list_month"].length) {
									row +=
										'<option value="' +
										unit["list_month"][i] +
										'" selected>' +
										unit["list_month"][i] +
										"</option>";
								} else {
									row +=
										'<option value="' +
										unit["list_month"][i] +
										'">' +
										unit["list_month"][i] +
										"</option>";
								}
							}
							$("#bulan-kehadiran").html(row);
						} else {
							var row = "";
							for (var i = 0; i < unit["list_month"].length; i++) {
								if (unit["list_month"][i] == month) {
									row +=
										'<option value="' +
										unit["list_month"][i] +
										'" selected>' +
										unit["list_month"][i] +
										"</option>";
								} else {
									row +=
										'<option value="' +
										unit["list_month"][i] +
										'">' +
										unit["list_month"][i] +
										"</option>";
								}
							}
							$("#bulan-kehadiran").html(row);
						}

						year = $("#tahun-kehadiran").val();
						month = $("#bulan-kehadiran").val();

						var donutChartCanvas = $("#donutChart")
							.get(0)
							.getContext("2d");
						var donutData = {
							labels: ["Cuti", "Dinas Luar", "Tidak Masuk"],
							datasets: [{
								data: [unit["cuti"], unit["dinas_luar"], unit["tidak_hadir"]],
								backgroundColor: [
									color["yellow"],
									color["blue"],
									color["red"]
								]
							}]
						};
						var donutOptions = {
							maintainAspectRatio: false,
							responsive: true,
							onHover: function (event, elements) {
								$("#donutChart").css("cursor", elements[0] ? "pointer" : "default");
							}
						};

						var donutChart = new Chart(donutChartCanvas, {
							type: "doughnut",
							data: donutData,
							options: donutOptions
						});

						$("#donutChart").click(
							function (evt) {
								var activePoints = donutChart.getElementsAtEvent(evt);
								if (activePoints.length > 0) {
									var index = activePoints[0]["_index"];
									var label = donutChart.data.labels[index];
									setTable(label, unitId, month, year)
								}
							}
						);

						var donutChartCanvas2 = $("#donutChart2")
							.get(0)
							.getContext("2d");
						var donutData2 = {
							labels: ["Terlambat", "Tepat Waktu"],
							datasets: [{
								data: [unit["late"], unit["ontime"]],
								backgroundColor: [color["yellow"], color["green"]]
							}]
						};
						var donutOptions2 = {
							maintainAspectRatio: false,
							responsive: true,
							onHover: function (event, elements) {
								$("#donutChart2").css("cursor", elements[0] ? "pointer" : "default");
							}
						};

						var donutChart2 = new Chart(donutChartCanvas2, {
							type: "doughnut",
							data: donutData2,
							options: donutOptions2
						});

						$("#donutChart2").click(
							function (evt) {
								var activePoints = donutChart2.getElementsAtEvent(evt);
								if (activePoints.length > 0) {
									var index = activePoints[0]["_index"];
									var label = donutChart2.data.labels[index];
									setTable(label, unitId, month, year)
								}
							}
						);

						$("#modal-analisis").modal("show");
					} catch (error) {
						$("#modal-analisis .modal-body").html(
							"<div><p>" + error + "</p></div>"
						);
						$("#modal-analisis").modal("show");
					}
				}
			});
		}

		function setTable(type, unitId, month, year) {
			$("#modal-analisis-tabel .modal-body .table-responsive").html('<table class="table table-bordered table-hover analisis-tabel"> <thead> <tr> <th class="text-center align-middle">ID</th> <th class="text-center align-middle">Nama</th> <th class="text-center align-middle type"></th> </tr> </thead> <tbody> <tr> <td class="text-center align-middle"></td> <td class="text-center align-middle"></td> <td class="text-center align-middle"></td> </tr> </tbody> </table>');
			$.ajax({
				type: "get",
				url: base_url +
					"Ajax/getTabelAnalisisKehadiranUnit/" +
					type +
					"/" +
					unitId +
					"/" +
					month +
					"/" +
					year,
				dataType: "json",
				beforeSend: function () {
					$("#modal-analisis").modal("hide");
					$("#loading-modal .modal-body>p").html("Mengambil Data. . .");
					$("#loading-modal").modal("show");
				},
				complete: function () {
					$("#loading-modal").modal("hide");
				},
				success: function (response) {
					var unit = response;
					try {
						$("#modal-analisis-tabel .modal-title").html("Tabel Analisis Kehadiran " + unit["nama_unit"]);
						$("#modal-analisis-tabel .modal-body .periode").html("Tahun: " + year + " | " + "Bulan: " + month);
						$("#modal-analisis-tabel .modal-body .type").html(type);

						var row = "";
						for (var i = 0; i < unit['data'].length; i++) {
							row += '<tr>';
							row += '<td class="text-center align-middle">';
							row += unit['data'][i]['id'];
							row += '</td>';
							row += '<td class="text-center align-middle">';
							row += unit['data'][i]['nama'];
							row += '</td>';
							row += '<td class="text-center align-middle">';
							row += unit['data'][i]['total'];
							row += '</td>';
							row += '</tr>';
						}
						$("#modal-analisis-tabel .analisis-tabel tbody").html(row);

						$("#modal-analisis-tabel .analisis-tabel").DataTable({
							paging: true,
							lengthChange: false,
							searching: false,
							ordering: true,
							info: false,
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

						$("#modal-analisis-tabel").modal("show");
					} catch (error) {
						$("#modal-analisis .modal-body").html(
							"<div><p>" + error + "</p></div>"
						);
						$("#modal-analisis-tabel").modal("show");
					}
				}
			});
		}
	});

	$("#modal-analisis-tabel .back").click(function () {
		$("#modal-analisis-tabel").modal("hide");
		$("#modal-analisis").modal("show");
	});
});
