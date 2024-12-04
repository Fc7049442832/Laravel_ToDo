import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

$(document).ready(function () {
    // Page load hone par hidden div ko hide karna
    $("#AddForm").hide();

    // Button click hone par hidden div ko show karna
    $("#AddButton").click(function () {
        $("#AddForm").show();
    });
});
