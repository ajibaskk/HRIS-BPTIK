$(document).ready(function () {
	var color = {
		green: "#28A745",
		yellow: "#FFC107",
		red: "#DC3545",
		blue: "#007BFF",
		cyan: "#17A2B8",
		grey: "#6C757D"
	};

	$.ajax({
		type: "post",
		url: base_url + "Ajax/getDatesKehadiran/" + $("#calendar").data("id"),
		dataType: "json",
		beforeSend: function () {
			$("#loading-modal .modal-body>p").html("Mengambil Data. . .");
			$("#loading-modal").modal("show");
		},
		complete: function () {
			$("#loading-modal").modal("hide");
		},
		success: function (response) {
			try {
				var dates = [];
				var data = response[2];
				var libur = [];
				const currentMoment = moment(response[0]);
				const endMoment = moment(response[1]);

				for (var i = 0; i < data.length; i++) {
					var obj = {};
					if (moment(data[i]["tanggal"]).isBefore(currentMoment) || moment(data[i]["tanggal"]).isAfter(endMoment)) {
						continue;
					} else if (
						!(
							moment(data[i]["tanggal"]).format("dddd") === "Saturday" ||
							moment(data[i]["tanggal"]).format("dddd") === "Sunday"
						) && data[i]["status"] == "libur"
					) {
						obj["title"] = data[i]["title"];
						obj["start"] = new Date(data[i]["tanggal"]);
						obj["allDay"] = true;
						obj["backgroundColor"] = color["grey"];
						obj["borderColor"] = color["grey"];
						libur.push(data[i]);
						data.splice(i, 1);
						dates.push(obj);
					}
				}

				for (var i = 0; i < data.length; i++) {
					var obj = {};
					if (moment(data[i]["tanggal"]).isBefore(currentMoment) || moment(data[i]["tanggal"]).isAfter(endMoment)) {
						continue;
					} else if (libur.find(x => x["tanggal"] === data[i]["tanggal"])) {
						continue;
					} else if (
						!(
							moment(data[i]["tanggal"]).format("dddd") === "Saturday" ||
							moment(data[i]["tanggal"]).format("dddd") === "Sunday"
						)
					) {
						obj["title"] = data[i]["title"];
						obj["start"] = new Date(data[i]["tanggal"]);
						obj["allDay"] = true;
						if (data[i]["status"] === "hadir") {
							obj["backgroundColor"] = color["green"];
							obj["borderColor"] = color["green"];
						} else if (data[i]["status"] === "terlambat") {
							obj["backgroundColor"] = color["yellow"];
							obj["borderColor"] = color["yellow"];
						} else if (data[i]["status"] === "cuti") {
							obj["backgroundColor"] = color["blue"];
							obj["borderColor"] = color["blue"];
						} else if (data[i]["status"] === "dl") {
							obj["backgroundColor"] = color["cyan"];
							obj["borderColor"] = color["cyan"];
						} else {
							continue;
						}
						dates.push(obj);
					}
				}

				while (!currentMoment.isAfter(endMoment)) {
					var obj = {};
					if (
						currentMoment.format("dddd") == "Saturday" ||
						currentMoment.format("dddd") == "Sunday"
					) {
						obj["title"] = "Akhir Pekan";
						obj["start"] = new Date(currentMoment.format("YYYY-MM-DD"));
						obj["allDay"] = true;
						obj["backgroundColor"] = color["grey"];
						obj["borderColor"] = color["grey"];
					} else if (
						!data.find(x => x["tanggal"] === currentMoment.format("YYYY-MM-DD")) && !libur.find(x => x["tanggal"] === currentMoment.format("YYYY-MM-DD"))
					) {
						obj["title"] = "Tidak Masuk";
						obj["start"] = new Date(currentMoment.format("YYYY-MM-DD"));
						obj["allDay"] = true;
						obj["backgroundColor"] = color["red"];
						obj["borderColor"] = color["red"];
					}
					dates.push(obj);
					currentMoment.add(1, "days");
				}

				var date = new Date();
				var d = date.getDate(),
					m = date.getMonth(),
					y = date.getFullYear();

				var Calendar = FullCalendar.Calendar;
				var calendarEl = document.getElementById("calendar");

				var calendar = new Calendar(calendarEl, {
					plugins: ["bootstrap", "dayGrid"],
					header: {
						left: "prev,next",
						center: "title",
						right: ""
					},
					events: dates
				});

				calendar.render();
			} catch (error) {}
		}
	});
});
