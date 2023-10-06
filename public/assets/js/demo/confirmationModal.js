window.addEventListener('show-hidden-confirmation', event =>{
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
                if (result.isConfirmed) {
                    Liveware.emit('HideConfirmed')
                }
      })
});
$(document).ready(function() {
    $(document).on('click', 'hideBookBtn', function (e){
        e.preventDefault();

        var book_id = $(this).data('bookid');
        $('#book_id').val(book_id);
        $('#bookIdPlaceholder').text(book_id);
        $('#hideBookModal').modal('show');
    });

    $('#confirmHide').click(function() {
        // Add your code to handle hiding the book here.
        // You can use $('#book_id').val() to get the book ID.
        // Remember to close the modal if the action is successful.
        $('#hideBookModal').modal('hide');
    });
});

