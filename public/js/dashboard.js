$(document).ready(function() {
    $(".btn-pref .btn").click(function() {
        $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
        // $(".tab").addClass("active"); // instead of this do the below 
        $(this).removeClass("btn-default").addClass("btn-primary");
    });
});

$(function() {

    $('#show').on('click', function() {
        $('.card-reveal').slideToggle('slow');
    });

    $('.card-reveal .close').on('click', function() {
        $('.card-reveal').slideToggle('slow');
    });
});

$("#addVideo2").click(function() {
    var link = $("#link2");
    var type = $("#type2");

    link.toggleClass("hidden");
    type.toggleClass("hidden");

});

$("#addVideo").click(function() {
    var link = $("#link");
    var type = $("#type");

    link.toggleClass("hidden");
    type.toggleClass("hidden");

});


function go(url) {
    window.location.href = url;
}

function edit(question) {
    console.log(question);
    let questionObj = JSON.parse(question);
    $("#questionId").val(questionObj.id);
    $('#question').val(questionObj.question);
    $('#category').val(questionObj.category);
    $('#link3').val(questionObj.link);
    $('#type3').val(questionObj.type);



}

function reply(id) {
    $('#reply_form' + id).toggleClass('hidden');
}

function deleteQuestion(id) {
    if (confirm("Sure to delete question?")) {

        window.location.href = '/delete-question/' + id;
    }

}