$('table').on('mouseup keyup', 'input[type=number]', () => calculateTotals());

$('.btn-add-row').on('click', () => {

  const $lastRow = $('.item:last');
  const $newRow = $lastRow.clone();

  $newRow.find('input').val('');
  $newRow.find('td:last').text('$0.00');
  $newRow.insertAfter($lastRow);

  $newRow.find('input:first').focus();
  $(".btn-remove-row").show();
});
$(".btn-remove-row").hide();
$('.btn-remove-row').on("click", function () {
  if ($(".item").length > 1) {

    $('.item:last').remove();
    $(this).show();
  } else {
    $(this).hide();
  }
});
function calculateTotals() {
  const subtotals = $('.item').map((idx, val) => calculateSubtotal(val)).get();
  const total = subtotals.reduce((a, v) => a + Number(v), 0);
  $('.total td:eq(1)').text(formatAsCurrency(total));
}



function calculateSubtotal(row) {
  const $row = $(row);
  const inputs = $row.find('input');
  const subtotal = inputs[1].value * inputs[2].value;

  $row.find('td:last').text(formatAsCurrency(subtotal));

  return subtotal;
}

function formatAsCurrency(amount) {
  return `$${Number(amount).toFixed(2)}`;
}

$(".title").on("click", function (e) {

  $("#invoice_img").trigger('click');

});

$("#invoice_img").on("change", function () {
  inp_file(this);
});
function inp_file(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(".title img").attr("src", e.target.result);


    };
    reader.readAsDataURL(input.files[0]); 
    return false;
  }
}

ajax_saveF = function (name) {
  var id = Date.now();
  var content = $(".invoice-box").html();
  $.ajax({
    url: "/?plugin=" + name,
    type: "POST",
    data: {
      "ajax": content,
      "ajax-fl": id,
      "ajax-name": name,
    }, success: function (e) {
      //console.log(e);
      open_notify(`Invoice saved complete!  ID: ${id}`);
    }, error: function () {
      open_notify(`Unable to save file. Please try again in a few minutes! `, "error");

    }
  });

};

 

setInterval(() => {
  if ($(".item").length > 1) {

    $(".btn-remove-row").show();
  } else {
    $(".btn-remove-row").hide();
  }
}, 100);