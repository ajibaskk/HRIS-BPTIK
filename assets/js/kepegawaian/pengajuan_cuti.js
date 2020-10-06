$(document).ready(function () {
	$("#file-cuti").on("change", function () {
		var file = $("#file-cuti").prop("files")[0];
		$("#file-label").html(file["name"]);
	});
	$("#awal-cuti").on("change", function () {
		$("#akhir-cuti").attr("min", $(this).val());
	});
	$("#akhir-cuti").on("change", function () {
		$("#awal-cuti").attr("max", $(this).val());
	});
});
