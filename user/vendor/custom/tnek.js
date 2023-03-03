/* Student Command */
function insertdata_student(){
    var id = document.getElementById("student_id").value;
    var fname = document.getElementById("firstname").value;
    var lname = document.getElementById("lastname").value;
    var mname = document.getElementById("middlename").value;
    var address = document.getElementById("address").value;
    var gender = document.getElementById("gender").value;
    var course = document.getElementById("course").value;
    var yearlvl = document.getElementById("yearlevel").value;
    var yearenrolled = document.getElementById("yearenrolled").value;
    var semester = document.getElementById("semester").value;
    $.ajax({
        type: "POST",
        url: "../controls/functions/adm_command.php",
        data: {"Stud_Id": id,"firstname": fname, "lastname": lname, "middlename": mname,
        "address": address, "gender": gender, "course": course, "yearlevel": yearlvl,
        "yearenrolled": yearenrolled, "semester": semester},
        success: function(html){
            $('#idsp').html(html);
        },
    });     
}
/* // Student Command */
 
/* Course Command */
function insertdata_course(){
    var coursex = document.getElementById("coursex").value;
    var description = document.getElementById("description").value;
    var program = document.getElementById("program").value;
    $.ajax({
        type: "POST",
        url: "../controls/functions/adm_command.php",
        data: {"coursex": coursex, "description": description, "program": program},
       success: function(html){
            $('#idsp').html(html);
        },
    });     
    }
/* // Course Command */

/* Edit Course Command */
function editdata_course(){
    var id = document.getElementById("idx").value;
    var coursex = document.getElementById("coursex").value;
    var description = document.getElementById("description").value;
    var program = document.getElementById("program").value;
    $.ajax({
        type: "POST",
        url: "../controls/functions/adm_command.php",
        data: {"c_idx": id, "c_coursex": coursex, "c_description": description, "c_program": program},
       success: function(html){
            $('#idsp').html(html);
        },
    });     
    }
/* // Edit Course Command */

/* Subjects */
function insertdata_subject(){
    var subject = document.getElementById("subject").value;
    var description = document.getElementById("description").value;
    var lec = document.getElementById("UnitLec").value;
    var lab = document.getElementById("UnitLab").value;
    var year = document.getElementById("year").value;
    var sem = document.getElementById("semester").value;
    var prer = document.getElementById("Prerequisite").value;
    $.ajax({
        type: "POST",
        url: "../controls/functions/adm_command.php",
        data: {"subject": subject, "description": description, "unitlec": lec, "unitlab": lab, "year": year, "sem": sem, "Prerequisite": prer},
       success: function(html){
            $('#idsp').html(html);
        },
    });     
    }
/* // Subjects */

/* Edit Subjects */
function editdata_subject(){
    var id = document.getElementById("idx").value;
    var subject = document.getElementById("subject").value;
    var description = document.getElementById("description").value;
    var lec = document.getElementById("UnitLec").value;
    var lab = document.getElementById("UnitLab").value;
    var year = document.getElementById("year").value;
    var sem = document.getElementById("semester").value;
    var prer = document.getElementById("Prerequisite").value;
    $.ajax({
        type: "POST",
        url: "../controls/functions/adm_command.php",
        data: {"e_idx": id, "e_subject": subject, "e_description": description, "e_unitlec": lec, "e_unitlab": lab, "e_year": year, "e_sem": sem, "e_Prerequisite": prer},
       success: function(html){
            $('#idsp').html(html);
        },
    });     
    }
/* // Edit Subjects */

/* Section */
function insertdata_section(){
    var section = document.getElementById("section").value;
    $.ajax({
        type: "POST",
        url: "../controls/functions/adm_command.php",
        data: {"section": section},
       success: function(html){
            $('#idsp').html(html);
        },
    });     
    }
/* // Section */

/* Account */
function insertdata_account(){
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var level = document.getElementById("level").value;
    $.ajax({
        type: "POST",
        url: "../controls/functions/adm_command.php",
        data: {"username": username, "email": email, "password": password, "level": level},
       success: function(html){
            $('#idsp').html(html);
        },
    });     
    }

function insertdata_account_edit(){
    var idx = document.getElementById("idx").value;
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var level = document.getElementById("level").value;
    $.ajax({
        type: "POST",
        url: "../controls/functions/adm_command.php",
        data: {"idx": idx, "username_e": username, "email_e": email, "password_e": password, "level_e": level},
       success: function(html){
            $('#idsp').html(html);
        },
    });     
    }

/* Edit Student Command */
function editdata_student(){
    var id = document.getElementById("idx").value;
    var idx = document.getElementById("student_id").value;
    var fname = document.getElementById("firstname").value;
    var lname = document.getElementById("lastname").value;
    var mname = document.getElementById("middlename").value;
    var address = document.getElementById("address").value;
    var gender = document.getElementById("gender").value;
    var course = document.getElementById("course").value;
    var yearlvl = document.getElementById("yearlevel").value;
    var yearenrolled = document.getElementById("yearenrolled").value;
    var semester = document.getElementById("semester").value;
    $.ajax({
        type: "POST",
        url: "../controls/functions/adm_command.php",
        data: {"idxs": id, "Stud_Id_edit": idx,"firstname_edit": fname, "lastname_edit": lname, "middlename_edit": mname,
        "address_edit": address, "gender_edit": gender, "course_edit": course, "yearlevel_edit": yearlvl,
        "yearenrolled_edit": yearenrolled, "semester_edit": semester},
        success: function(html){
            $('#idsp').html(html);
        },
    });     
}
/* // Edit Student Command */
