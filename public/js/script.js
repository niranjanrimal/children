//Different Address checkbox

const differentAddress = document.getElementById("enable-address");
const address = document.getElementById("address");
const city = document.getElementById("city");
const state = document.getElementById("state");
const country = document.getElementById("country");
const zipcode = document.getElementById("zipcode");

differentAddress.addEventListener("change", () => {
    const isChecked = differentAddress.checked;
    address.disabled = !isChecked;
    city.disabled = !isChecked;
    state.disabled = !isChecked;
    country.disabled = !isChecked;
    zipcode.disabled = !isChecked;

    address.readOnly = !isChecked;
    city.readOnly = !isChecked;
    state.readOnly = !isChecked;
    country.readOnly = !isChecked;
    zipcode.readOnly = !isChecked;
});

//Timer for success message

setTimeout(function () {
    $("#success-message").fadeOut("slow", function () {
        $(this).remove();
    });
}, 1000);

//delete

const deleteBtns = document.querySelectorAll(".delete-btn");
deleteBtns.forEach((deleteBtn) => {
    deleteBtn.addEventListener("click", (e) => {
        e.preventDefault();
        const childId = deleteBtn.getAttribute("data-id");
        const deleteForm = document.querySelector(`#delete-form-${childId}`);

        if (confirm("Are you sure you want to delete this record?")) {
            deleteForm.submit();
        }
    });
});

//ajax
$(document).ready(function () {
    $("#myForm").on("submit", function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: $(this).attr("action"),
            method: "POST",
            data: formData,
            success: function (response) {
                $("#addchildrenModal").modal("hide");
                $("body").removeClass("modal-open");
                $(".modal-backdrop").remove();
                $("#myForm")[0].reset();
                location.reload();
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    for (var field in errors) {
                        var input = $('input[name="' + field + '"]');
                        input.addClass("is-invalid");
                        input.next(".invalid-feedback").html(errors[field][0]);

                        input.on("input", function () {
                            $(this).removeClass("is-invalid");
                            $(this).next(".invalid-feedback").html("");
                        });
                    }
                } else {
                    location.reload();
                }
            },
        });
    });
});

//end
