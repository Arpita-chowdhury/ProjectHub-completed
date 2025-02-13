
<script>
    //for dynamically adding member
    var member = 1;

    function addMember() {

        member++;
        var html = "<tr id='reg2'>";
        html += "<td class='h6 pt-5 ps-5'>" + 'Member ' + member;
        html += "<br><button class='btn btn-transparent btn-outline-secondary fw-bold mt-5' type='button' onclick='deleteRow(this);'>Remove</button></td>"

        html += "<td class='pe-4'><div class='form-input'>";
        html += "<label class='form-label mb-0' for=''>Student ID</label>";
        html += "<input id='sid2' class='form-control' placeholder='123 456 7890' type='text' name='id[]' >";
        html += "<p class='text-danger mb-0 pb-1' style='font-size: 13px;'><?php echo $idErr ?></p></div>";

        html += "<div class='form-input'>";
        html += "<label class='form-label mb-0' for=''>Name</label>";
        html += "<input id='name2' class='form-control' placeholder='member name' type='text' name='name[]' >";
        html += "<p class='text-danger mb-0 pb-1' style='font-size: 13px;'><?php echo $nameErr ?></p></div>";

        html += "<div class='form-input'>";
        html += "<label class='form-label mb-0' for=''>Email</label>";
        html += "<input id='email2' class='form-control' placeholder='example@gmail.com' type='text' name='email[]' >";
        html += "<p class='text-danger mb-0 pb-1' style='font-size: 13px;'><?php echo $emailErr ?></p></div>";

        html += "<div class='form-input'>";
        html += "<label class='form-label mb-0' for=''>Phone</label>";
        html += "<input id='phone2' class='form-control' placeholder='01234 567890' type='text' name='phone[]' >";
        html += "<p class='text-danger mb-0 pb-1' style='font-size: 13px;'><?php echo $phoneErr ?></p></div>";

        html += "</td></tr>";

        document.getElementById("addRow").insertRow().innerHTML = html;
    }

    //remove a member
    function deleteRow(button) {
        member--
        button.parentElement.parentElement.remove();
    }

</script>
