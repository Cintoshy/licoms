$(document).ready(function() {
  var table = $('#example22').DataTable({
    dom: 'frtip',
    // buttons: [
    // 'copyHtml5', 
    //   'csv',
    //   'excel',
    //   'pdf',

    //   'print',
    // ],
    // "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" + 
    //        "<'row'<'col-sm-12'tr>>" +
    //        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
  });
});


// $(document).ready(function() {
//   var table = $('#collection').DataTable({
//     dom: 'Bfrtip',
//     buttons: [
//       {
//         extend: 'copy'
//       },
//       {
//         extend: 'csv'
//       },
//       {
//         extend: 'excel'
//       },
//       {
//         extend: 'pdf',
//         customize: function(doc) {
//           var now = new Date();
//           var customFooter = 'Custom Footer - Exported on: ' + now.toLocaleString();
          
//           // Add custom footer using jsPDF
//           doc.footer = function(currentPage, pageCount) {
//             return {
//               text: customFooter,
//               alignment: 'center'
//             };
//           };
//         }
//       },
//       'print'
//     ],
//     "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" + 
//            "<'row'<'col-sm-12'tr>>" +
//            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
//   });
// });

// $(document).ready(function() {
//   var table = $('#collection').DataTable({
//       dom: 'Bfrtip',
//       buttons: [
//           {
//               extend: 'pdf',
//               customize: function(doc) {
//                   var now = new Date();
//                   var customHeader = 'Custom Header - Exported on: ' + now.toLocaleString();
                  
//                   // Add custom header with logo using jsPDF
//                   var imgPath = "{{ asset('img/Logo.png') }}";
//                   doc.content.splice(0, 0, {
//                       text: customHeader,
//                       alignment: 'center',
//                       margin: [0, 10]
//                   });
//                   doc.content.splice(1, 0, {
//                       image: imgPath,
//                       width: 50,  // Adjust the width as needed
//                       alignment: 'left'
//                   });
//               }
//           },
//           'print'
//       ],
//       "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" + 
//              "<'row'<'col-sm-12'tr>>" +
//              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
//   });
// });






$(document).ready(function() {
  $('#tableData').DataTable({
    dom: 'lBfrtip',

    "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" + 
           "<'row'<'col-sm-12'tr>>" +
           "<'row'<'d-flex justify-content-center'i>>"+
           "<'row'<'d-flex justify-content-center'p>>",
  });
});
/*
$(document).ready(function () {
  $('#collection').DataTable({
      dom: 'Bfrtip',
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
  });
});*/

$(document).ready(function() {
  $('#dataTable').DataTable({

  });
});
function closeSnackbar() {
  var snackbar = document.getElementById("snackbar");
  snackbar.style.display = "none";
}

$(document).ready(function() {
  $('#index').DataTable({
    dom: 'lfrti',
    "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" + 
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-12 col-md-5'i>>",

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
$(document).ready(function() {
  $('.selectpicker').selectpicker();
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
          $('#EditBook .modal-body').html(response);

          // Open the modal
          $('#EditBook').modal('show');
      },
      error: function() {
          // Handle error if needed
      }
  });
}

function openLibEditBookModal(editBookUrl) {
  // Perform any additional actions before opening the modal

  // Make an AJAX request to fetch the edit user content
  $.ajax({
      url: editBookUrl,
      method: 'GET',
      success: function(response) {
          // Update the modal body with the fetched content
          $('#EditBook .modal-body').html(response);

          // Open the modal
          $('#EditBook').modal('show');
      },
      error: function() {
          // Handle error if needed
      }
  });
}


function openDeptEditBookModal(editBookUrl) {
  // Perform any additional actions before opening the modal

  // Make an AJAX request to fetch the edit user content
  $.ajax({
      url: editBookUrl,
      method: 'GET',
      success: function(response) {
          // Update the modal body with the fetched content
          $('#EditDeparment .modal-body').html(response);

          // Open the modal
          $('#EditDeparment').modal('show');
      },
      error: function() {
          // Handle error if needed
      }
  });
}

function openEditCourseModal(editBookUrl) {
  // Perform any additional actions before opening the modal

  // Make an AJAX request to fetch the edit user content
  $.ajax({
      url: editBookUrl,
      method: 'GET',
      success: function(response) {
          // Update the modal body with the fetched content
          $('#EditCourse .modal-body').html(response);

          // Open the modal
          $('#EditCourse').modal('show');
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




    document.addEventListener("DOMContentLoaded", function() {
        var yearSelect = document.getElementById("year");
        
        var years = Array.from({ length: 82 }, (_, index) => 2018 + index);
        years.sort((a, b) => a - b);

        years.forEach(function(year) {
            var option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        });
    });


    document.addEventListener("DOMContentLoaded", function () {
      const idInput = document.getElementById("id");
      idInput.addEventListener("input", function () {
          if (idInput.validity.valid) {
              idInput.classList.remove("is-invalid");
              idInput.classList.add("is-valid");
          } else {
              idInput.classList.remove("is-valid");
              idInput.classList.add("is-invalid");
          }
      });
  });

  $(document).ready(function() {
    var detailsBtn = $('#details-btn');
    var detailsForm = $('#details-form');
    var originalText = detailsBtn.find('span').text(); // Assuming the text is wrapped in a <span> element
    var originalClass = detailsBtn.attr('class');
    var iconElement = detailsBtn.find('i');

    // Button click event handler
    detailsBtn.click(function() {
        if (detailsForm.is(":visible")) {
            detailsForm.hide();
            detailsBtn.removeClass('btn-danger').addClass('btn-primary').find('span').text(originalText);
            iconElement.removeClass('fa-times').addClass('fa-filter');
            // Other actions as needed
        } else {
            detailsForm.show();
            detailsBtn.removeClass('btn-primary').addClass('btn-danger').find('span').text('Exit');
            iconElement.removeClass('fa-filter').addClass('fa-times');
            // Other actions as needed
        }
    });

    // Reset button to default style
    function resetButtonStyle() {
        detailsForm.hide();
        detailsBtn.attr('class', originalClass).find('span').text(originalText);
        iconElement.removeClass('fa-times').addClass('fa-filter');
        // Other actions as needed
    }

    // You can call resetButtonStyle() when needed to reset the button to its default style.
});

function validateContact(input) {
  input.value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
  if (input.value.length > 11) {
      input.value = input.value.slice(0, 11); // Limit to 11 digits
  }
}




    document.addEventListener("DOMContentLoaded", function () {
      const detailsBtn = document.getElementById("details-btn");
      const detailsColumn = document.getElementById("details-column");
      const exitDetailsBtn = document.getElementById("exit-details");


      exitDetailsBtn.addEventListener("click", function () {
        const aaa = document.getElementById("details");
          detailsColumn.classList.add("d-none");
          aaa.classList.add("col-md-12");
          aaa.classList.toggle("col-md-8");
      
        });
        
      detailsBtn.addEventListener("click", function () {
          const details = document.getElementById("details");
          details.classList.toggle("col-md-8");
          details.classList.toggle("col-md-12");
          detailsColumn.classList.toggle("d-none");
      });
    });


    $(document).ready(function() {
      $('#aaaa').DataTable({
          dom: 'Bfrtip',
          buttons: [
              {
                  extend: 'excelHtml5',
                  text: 'Export',
                  action: function(e, dt, node, config) {
                      var exportData = dt.buttons.exportData();
  
                      // Create a workbook and add a worksheet
                      var wb = XLSX.utils.book_new();
                      var ws = XLSX.utils.aoa_to_sheet(exportData.body);
  
                      // Add the custom header rows
                      var header1 = [
                          ['CCS', '', '2024', '', '2023', '', '2022', '', '2021', '', '2020', '', 'Printed Books', '',
                          'Electronics Books', '', 'Grand Total', '% per Subject', 'Titles Needed', '2019 Below']
                      ];
  
                      var header2 = [
                          ['CC', 'Courses', 'T', 'V', 'T', 'V', 'T', 'V', 'T', 'V', 'T', 'V',
                          'T', 'V', 'T', 'V', 'T', 'V']
                      ];
  
                      // Merge cells for the colspan effect
                      ws['!merges'] = [
                        { s: { r: 0, c: 0 }, e: { r: 0, c: 1 } }, // CCS
                        { s: { r: 0, c: 2 }, e: { r: 0, c: 3 } }, // 2024
                    ];
  
                      XLSX.utils.sheet_add_aoa(ws, header1, { origin: 'A1' });
                      XLSX.utils.sheet_add_aoa(ws, header2, { origin: 'A2' });
  
                      // Add the worksheet to the workbook
                      XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
  
                      // Save the workbook as a file
                      XLSX.writeFile(wb, 'exported_table.xlsx');
                  }
              }
          ]
      });
  });
  

  
  $(document).ready(function() {
    // Detect input changes in the 'volume' field
    $("#volume").on("input", function() {
        var volumeCount = parseInt($(this).val()) || 0;
        var volumeFields = $("#volumeFields");

        // Clear existing fields
        volumeFields.empty();

        // Create input fields based on volume count
        for (var i = 1; i <= volumeCount; i++) {
            var inputField = `
                                <input type="number" class="form-control form-control-user mt-3"
                                    id="volume_${i}" name="access_no[]" value=""
                                    placeholder="Accession Number ${i}" pattern="[0-9]*" inputmode="numeric" min="1" required>`;
            volumeFields.append(inputField);
        }
    });
});

//validateVolume//
function validateVolume(input) {
  input.value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
  if (input.value.length > 2) {
      input.value = input.value.slice(0, 1, 2); // Limit to 2 digits
  }
}

function showSnackbar() {
  var snackbar = document.getElementById("snackbar");
  snackbar.style.display = "block"; // Show the snackbar
  snackbar.style.animation = "fadein 1s";

  setTimeout(function() {
    snackbar.style.animation = "fadeout 1s 2.5s";
    setTimeout(function() {
      snackbar.style.display = "none"; // Hide the snackbar
    }, 2500); // 0.5 seconds for fadeout animation
  }, 3500); // 2.5 seconds delay before fadeout
}

// Call the function to start the animation
showSnackbar();

function submitReportForm() {
  // You can perform any actions you need here before submitting the form.
  // For example, you can validate user inputs or make additional AJAX requests.

  // Once you're ready to submit the form, you can do so using JavaScript.
  // Here's an example of submitting the form with the ID "reportForm":
  document.getElementById('reportForm').submit();
}