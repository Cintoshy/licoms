$(document).ready(function() {
  $('#collection').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy',
      'csv',
      'excel',
      'pdf',
      'print'
    ],
    "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" + 
           "<'row'<'col-sm-12'tr>>" +
           "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
  });
});

$(document).ready(function() {
  $('#dataTable').DataTable({

  });
});
function toggleChangeStatusButton(button) {
  var changeStatusButtons = button.closest('.changeStatusButtons');
  var statusButtons = button.closest('.statusButtons');
  changeStatusButtons.style.display = 'none';
  statusButtons.style.display = 'block';
}
$(document).ready(function() {
  $('.search-input').on('input', function() {
    var searchValue = $(this).val().toLowerCase();
    var dropdownOptions = $(this).siblings('.dropdown-options');
    dropdownOptions.find('a').filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
    });
  });

  $('.dropdown-options').on('click', 'a', function() {
    var selectedOption = $(this).text();
    var searchInput = $(this).closest('.dropdown').find('.search-input');
    searchInput.val(selectedOption);
  });
});

function openEditUserModal(editUserUrl) {
  // Perform any additional actions before opening the modal

  // Make an AJAX request to fetch the edit user content
  $.ajax({
      url: editUserUrl,
      method: 'GET',
      success: function(response) {
          // Update the modal body with the fetched content
          $('#EditUser .modal-body').html(response);

          // Open the modal
          $('#EditUser').modal('show');
      },
      error: function() {
          // Handle error if needed
      }
  });
}

function openEditBookModal(editBookUrl) {
  // Perform any additional actions before opening the modal

  // Make an AJAX request to fetch the edit user content
  $.ajax({
      url: editBookUrl,
      method: 'GET',
      success: function(response) {
          // Update the modal body with the fetched content
          $('#EditUser .modal-body').html(response);

          // Open the modal
          $('#EditUser').modal('show');
      },
      error: function() {
          // Handle error if needed
      }
  });
}

$(document).ready(function() {
  var popup = $('#popup');
  if (popup.length > 0) {
      popup.fadeIn().delay(3000).fadeOut(); // Adjust the duration (in milliseconds) as needed
  }
});

$(document).ready(function() {
  var popupModal = $('#popupModal');
  if (popupModal.length > 0) {
      popupModal.modal('show');
      setTimeout(function() {
          popupModal.modal('hide');
          popupModal.on('hidden.bs.modal', function() {
              popupModal.remove();
          });
      }, 3000); // Adjust the duration (in milliseconds) as needed
  }
});

$(document).ready(function() {
  // Button click event handlers
  $('#details-btn').click(function() {
    $('#details-form').show();
    $('#status-form, #files-form, #messages-form, #lib-form, #actions-form, #classifications-form, #project-team-form, #cash-program-form, #reprogramming-status-form').hide();
  });
});


