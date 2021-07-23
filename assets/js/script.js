const flashData = $(".flash-data").data("flashdata");

if (flashData) {
	Swal.fire({
		icon: "success",
		title: "Menu",
		text: "Berhasil " + flashData,
		type: "success",
	});
}