// alert();


//New input field html

//Check maximum number of input fields
var num = 1;
// $(document).on("click", ".dobavit", function(){
//     var fieldHTML = "<div style='display: flex'>\n" +
//         "    <input class='form-control' type='text' name='info["+num+"][name]'>\n" +
//         "    <input class='form-control' type='text' name='info["+num+"][value]'>\n" +
//         "</div>";
//     $(".info").append(fieldHTML); //Add field html
//     num++;
// });
function addInputForm() {
    var numInput = num++;

    var fieldHTML = "<div style='display: flex'>\n" +
        "    <input class='form-control' type='text' name='info["+numInput+"][name]'>\n" +
        "    <input class='form-control' type='text' name='info["+numInput+"][value]'>\n" +
        "</div>";
    $(".info").append(fieldHTML); //Add field html
}