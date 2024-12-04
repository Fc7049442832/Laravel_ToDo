import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

$(document).ready(function () {
    // Page load hone par hidden div ko hide karna
    $("#AddForm").hide();

    // Button click hone par hidden div ko show karna
    $(".AddButton").click(function () {
        $("#AddForm").show();
    });

    // Button click hone par hidden div ko show karna
    $("#moveForm").click(function () {
        $("#AddForm").hide();
    });
});

// add row function
$(document).ready(function () {
    // Button click par naya div add karna
    $("#addDiv").click(function () {
        let count = 0;
        $("#mainContainer").append(`
            <tr>
                <tr>
                        <td>
                            <form class="cell-form">
                                <input type="txt" name="sno" class="form-control" value="${count}">
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                <input type="text" name="name" class="form-control" value="John" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                <input type="text" name="surname" class="form-control" value="Doe" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                <input type="date" name="dob" class="form-control" value="2000-01-01" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                <input type="text" name="university" class="form-control" value="ABC University" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                <input type="text" name="college" class="form-control" value="XYZ College" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                <input type="text" name="roll_no" class="form-control" value="12345" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                <input type="text" name="batch_no" class="form-control" value="2023" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                <select name="dept" required>
                                    <option value="CS">Computer Science</option>
                                    <option value="CV">Civil</option>
                                    <option value="EC">Electronics</option>
                                    <option value="ME">Mechanical</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                 <input type="text" name="phone" class="form-control" value="189291020" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                 <input type="text" name="a-phone" class="form-control" value="0929839291">
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                 <input type="text" name="email" class="form-control" value="ak@gmail.com" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                 <input type="text" name="a-email" class="form-control" value="makkk@gmail.com">
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                 <input type="text" name="f-name" class="form-control" value="Father" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                 <input type="text" name="m-name" class="form-control" value="Mother" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                 <input type="text" name="address" class="form-control" value="Vijay Nagar" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                 <input type="text" name="city" class="form-control" value="Indore" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                 <input type="file" name="doc" class="form-control" value="2023" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                 <input type="text" name="phone" class="form-control" value="2023" required>
                            </form>
                        </td>
                        <td>
                            <form class="cell-form">
                                <button type="submit" class="btn btn-sm btn-success">Save</button>
                            </form>
                        </td>
            </tr> ` );
        count++; // Increment the counter
       
    });
});
