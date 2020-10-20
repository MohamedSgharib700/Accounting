

var jqueryObj = $;

jqueryObj('#add').click(function () {
    jqueryObj('#create').show(500);
});

jqueryObj('#add-none').click(function () {
    jqueryObj('#create').hide(300);

});
jqueryObj("#edit").click(function () {
    jqueryObj('.edit').show(500);
})
jqueryObj("#edit-none").click(function () {
    jqueryObj('.edit').hide(500);
})

jqueryObj('#change-status').click(function () {
    jqueryObj('.change-status').show(500);
});

jqueryObj('#change-none').click(function () {
    jqueryObj('.change-status').hide(300);

});
jqueryObj(".edit-popup").click(function () {
    jqueryObj('.popup-edit').show(500);
});
jqueryObj('.close-edit').click(function () {
    jqueryObj('.popup-edit').hide(300);

});
jqueryObj(".default_option").click(function () {
    jqueryObj(this).parent().toggleClass("active");
});

let edit = document.querySelectorAll('#edit');
for (let i = 0; i < edit.length; i += 1) {
    edit[i].addEventListener('click', function () {
        document.querySelector(".edit").style.display = "block";

    });
}
let change = document.querySelectorAll('#change-status');
for (let x = 0; x < change.length; x += 1) {
    change[x].addEventListener('click', function () {
        document.querySelector(".change-status").style.display = "block";

    });
}
jqueryObj(".select_ul li").click(function () {
    var currentele = jqueryObj(this).html();
    jqueryObj(".default_option li").html(currentele);
    jqueryObj(this).parents(".select_wrap").removeClass("active");
});
jqueryObj('.open-menu ul').css("display", "none");
// let menuList = document.getElementsByClassName('open-menu');
// for (let m = 0; m < menuList.length; m++) {
//     menuList[m].addEventListener('click', function () {
//         document.querySelector("ul").style.display = "block";

//     })
// }
