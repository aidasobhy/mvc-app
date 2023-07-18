<style>
    * {
        margin: 0;
        padding: 0;
        border: 0;
        outline: none;
        line-height: 1.2;
        font-size: 1em;
    }

    div .wrapper
    {
        overflow: hidden;
    }
    div.wrapper div.empForm
    {
        width: 80%;
        margin: 0 auto;
    }

    div.wrapper div.employees
    {
       margin: 0 auto;
        width:  80%;
    }

    form.appForm {
        width:  80%;
        margin: 0 auto;


    }

    form.appForm fieldset {
        border: solid 1px #e4e4e4;
        padding: 10px;
        background: #f1f1f1;
    }

    form.appForm fieldset legend  {

        padding: 5px;
        background: #e4e4e4;
        font: 1em 'Arial.Helvetica.sans-serif';
        color: #666;
    }


    form.appForm fieldset p.message {
        background: green;
        color: #fff;
        padding: 5px;
        margin: 3px 0;
        border-radius: 3px;
        font:0.85em Arial;

    }

    form.appForm fieldset p.message.error{
        background: #900;
    }



    form.appForm table {
        width:  98%;
    }

    form.appForm label {
        font-family: Arial;
        font-size: 0.86em;
        color: #666666;
    }

    form.appForm table tr td input[type=text],
    form.appForm table tr td input[type=number]{
        font-family: Arial;
        font-size: 0.86em;
        width: 88%;
        padding: 2%;
    }

    form.appForm table tr td input[type=submit] {
        font-family: Arial;
        font-size: 0.86em;
        padding: 8px;
        border-right: 3px;
        background-color: green;
        color: #fff;
    }

    form.appForm table tr td {
        padding: 3px 0;
    }

    div.wrapper div.employees table
    {
        width:85%;
        margin: 20px 20px 0 0;
        border-collapse: collapse;

    }

    div.wrapper div.employees table thead th
    {

        padding: 5px;
        border-right: 2px solid #e4e4e4;
        border-bottom: 2px solid #e4e4e4;
        font: bold 1.1em Arial,Helvetica,sans-serif ;
        color: #666;
    }
    div.wrapper div.employees table thead th:last-of-type
    {
        border-right:none;
    }

    div.wrapper div.employees table tbody td
    {

        padding: 5px;
        border-bottom: 1px solid #e4e4e4;
        font: 0.8em Arial,Helvetica,sans-serif ;
        color: #666;
    }

    div.wrapper div.employees table tbody tr:nth-last-child(2n) td
    {
        background: #f1f1f1;
    }

</style>

<div class="wrapper">
    <div class="empForm">
        <form class="appForm" method="post">
            <fieldset>
                <legend>Employees Information</legend>
                <?php
                if (isset($_SESSION['message'])) {
                    ?>
                    <p class="message <?= isset($error) ? 'error' : '' ?>"><?= $_SESSION['message'] ?></p>
                    <?php
                    unset($_SESSION['message']);
                }
                ?>

                <table>
                    <tr>
                        <td>
                            <label for="name"> Employee Name:</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" name="name" placeholder="Type Employee Name here" id="name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="age"> Employee Age:</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="number" name="age" id="age" min="22" max="60">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="address"> Employee Address:</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" name="address" id="address" max="100">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="salary"> Employee Salary:</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="number" name="salary" id="salary" min="1500" max="9000" step="0.01">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="tax"> Employee Tax(%):</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="number" name="tax" id="tax" min="1" max="5" step="0.01">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" value="Save">
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>