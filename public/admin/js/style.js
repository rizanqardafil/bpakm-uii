function datePemesanan(){
    var fromDate;
    var toDate;

    $('#tanggalPeminjaman').on('change', function () {
        fromDate = $(this).val();
        $('#tanggalPengembalian').prop('min', function () {
            return fromDate;
        })
    });

    $('#tanggalPengembalian').on('change', function () {
        toDate = $(this).val();
        $('#tanggalPeminjaman').prop('max', function () {
            return toDate;
        })
    });
}

function datePemesananEdit(){
    var fromDate;
    var toDate;

    var tanggalPeminjamanSekarang = document.getElementById("tanggalPeminjaman").value;
    var tanggalPengembalianSekarang = document.getElementById("tanggalPengembalian").value;

    $('#tanggalPeminjaman').prop('max', function(){
        return tanggalPengembalianSekarang;
    });

    $('#tanggalPengembalian').prop('min', function(){
        return tanggalPeminjamanSekarang;
    });

    $('#tanggalPeminjaman').on('change', function () {
        fromDate = $(this).val();
        $('#tanggalPengembalian').prop('min', function () {
            return fromDate;
        })
    });

    $('#tanggalPengembalian').on('change', function () {
        toDate = $(this).val();
        $('#tanggalPeminjaman').prop('max', function () {
            return toDate;
        })
    });
}