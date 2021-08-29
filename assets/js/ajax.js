$("#btn-add-assets").click(function() {
    Swal.fire({
        title: 'Add new assets',
        html: '<input id="swal-input1" class="swal2-input" placeholder="Assets name">' +
            '<input id="swal-input2" class="swal2-input">',
        focusConfirm: false,
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Simpan',
        cancelButtonText: 'Batalkan',
        showLoaderOnConfirm: true,
        preConfirm: (values) => {
            $.post("Home/add_assets", { username: u, paket: values })
                .done(function(responses) {
                    var res = JSON.parse(responses);
                    if (res.status == "OK") {
                        $('td[data-nama-paket="' + u + '"]').text(res.paket)
                    }
                });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {

        }
    })
})