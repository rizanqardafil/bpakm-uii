function date(){
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

function xzoom() {
    $(document).ready(function () {
        $('.xzoom, .xzoom-gallery').xzoom({
            zoomWidth: 500,
            title: false,
            tint: '#333',
            Xoffset: 15
        });
    });
}


$(document).on("click", "#modal-btn", function () {
  var slug_album = $(this).data('id');
  
  const modal = document.querySelector('#my-modal-' + slug_album);
  const closeBtn = document.querySelector('#close-' + slug_album);
  
  closeBtn.addEventListener('click', closeModal);
  window.addEventListener('click', outsideClick);
  
  modal.style.display = 'block';

  // Close
  function closeModal() {
    modal.style.display = 'none';
  }

  // Close If Outside Click
  function outsideClick(e) {
    if (e.target == modal) {
      modal.style.display = 'none';
    }
  }

  $(document).ready(function() {

    $('.modal-body').magnificPopup({

        delegate: '.a-'+ slug_album,
        type: 'image',
        gallery: {
            enabled: true
        }

    });

  });

});

// Get DOM Elements // JS Halaman Galeri Foto
// const modal = document.querySelector('#my-modal');
// const modalBtn = document.querySelector('#modal-btn');
// const closeBtn = document.querySelector('.close');

// Events
// modalBtn.addEventListener('click', openModal);
// closeBtn.addEventListener('click', closeModal);
// window.addEventListener('click', outsideClick);

// Open
// function openModal() {
//   modal.style.display = 'block';
// }
