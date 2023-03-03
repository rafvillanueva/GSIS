/* Student Command */
function insertdata_student(){
    var id = document.getElementById("student_id").value;
    var fname = document.getElementById("firstname").value;
    var lname = document.getElementById("lastname").value;
    var mname = document.getElementById("middlename").value;
    var contactnum = document.getElementById("contactnum").value;
    var address = document.getElementById("address").value;
    var gender = document.getElementById("gender").value;

    var m_fname = document.getElementById("mfirstname").value;
    var m_lname = document.getElementById("mlastname").value;
    var m_mname = document.getElementById("mmiddlename").value;
    var m_contact = document.getElementById("mcontactnum").value;

    var f_fname = document.getElementById("ffirstname").value;
    var f_lname = document.getElementById("flastname").value;
    var f_mname = document.getElementById("fmiddlename").value;
    var f_contact = document.getElementById("fcontactnum").value;

    var s_level = document.getElementById("zlevel").value;

    var name = document.getElementById("file").files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();

    $.ajax({
        type: "POST",
        url: "../../controls/functions/adm_command.php",
        data: {"Stud_Id": id,"firstname": fname, "lastname": lname, "middlename": mname, "contactnumm": contactnum,
        "address": address, "gender": gender, "mfirstname": m_fname, "mlastname": m_lname,
        "mmiddlename": m_mname, "mcontactnum": m_contact, "ffirstname": f_fname, "flastname": f_lname,
        "fmiddlename": f_mname, "fcontactnum": f_contact, "slevel": s_level},
        success: function(html){
            $('#idsp').html(html);
            //window.location.href = "enroll-student-subject?student=" + id;
            if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
            {
             alert("Invalid Image File");
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("file").files[0]);
            var f = document.getElementById("file").files[0];
            var fsize = f.size||f.fileSize;
            if(fsize > 2000000)
            {
             alert("Image File Size is very big");
            }
            else
            {
             form_data.append("file", document.getElementById('file').files[0]);
             $.ajax({
              url:"../registrar/upload.php?id=" + id,
              method:"POST",
              data: form_data,
              contentType: false,
              cache: false,
              processData: false,
              beforeSend:function(){
               $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
              },   
              success:function(data)
              {
                $('#uploaded_image').html(data);
                $('#file').attr('src', '');
              }
             });
            }
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
        url: "../../controls/functions/adm_command.php",
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
        url: "../../controls/functions/adm_command.php",
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
    var year = document.getElementById("year").value;
    $.ajax({
        type: "POST",
        url: "../../controls/functions/adm_command.php",
        data: {"subject": subject, "description": description, "year": year},
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
    var year = document.getElementById("year").value;
    $.ajax({
        type: "POST",
        url: "../../controls/functions/adm_command.php",
        data: {"e_idx": id, "e_subject": subject, "e_description": description, "e_year": year},
       success: function(html){
            $('#idsp').html(html);
        },
    });     
    }
/* // Edit Subjects */

/* Section */
function insertdata_section(){
    var section = document.getElementById("section").value;
    var building = document.getElementById("building").value;
    var max_stud = document.getElementById("max_stud").value;
    var year = document.getElementById("year").value;
    $.ajax({
        type: "POST",
        url: "../../controls/functions/adm_command.php",
        data: {"section": section, "building": building, "max_stud": max_stud, "year": year},
       success: function(html){
            $('#idsp').html(html);
        },
    });     
    }

function updatedata_section(){
    var section = document.getElementById("section").value;
    var building = document.getElementById("building").value;
    var max_stud = document.getElementById("max_stud").value;
    var id = document.getElementById("idx").value;
    $.ajax({
        type: "POST",
        url: "../../controls/functions/adm_command.php",
        data: {"section_u": section, "building_u": building, "idx_u": id, "max_stud_u": max_stud},
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
    var staff_a = document.getElementById("staff_a").value;
    $.ajax({
        type: "POST",
        url: "../controls/functions/adm_command.php",
        data: {"username": username, "email": email, "password": password, "level": level, "staff_a": staff_a},
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
    var contactnum = document.getElementById("contactnum").value;

    var mfname = document.getElementById("mfirstname").value;
    var mlname = document.getElementById("mlastname").value;
    var mmname = document.getElementById("mmiddlename").value;
    var mcontact = document.getElementById("contactmz").value;

    var ffname = document.getElementById("ffirstname").value;
    var flname = document.getElementById("flastname").value;
    var fmname = document.getElementById("fmiddlename").value;
    var fcontact = document.getElementById("contactfz").value;

    var s_level = document.getElementById("zlevel").value;

    $.ajax({
        type: "POST",
        url: "../../controls/functions/adm_command.php",
        data: {"idxs": id, "Stud_Id_edit": idx,"firstname_edit": fname, "lastname_edit": lname, "middlename_edit": mname, "contactnumm_edit" : contactnum,
        "address_edit": address, "gender_edit": gender, "mfirstname_edit": mfname, "mlastname_edit": mlname,
        "mmiddlename_edit": mmname, "mcontactnumm_edit": mcontact, "ffirstname_edit": ffname, "flastname_edit": flname,
        "fmiddlename_edit": fmname, "fcontactnumm_edit": fcontact, "slevel": s_level},
        success: function(html){
            $('#idsp').html(html);
            document.getElementById("edit_completename").style.display = "none";
            document.getElementById("edit_completenamem").style.display = "none";
            document.getElementById("edit_completenamef").style.display = "none";
            document.getElementById("edit_gender").style.display = "none";
            document.getElementById("edit_address").style.display = "none";
            document.getElementById("edit_contact").style.display = "none";
            document.getElementById("edit_contactf").style.display = "none";
            document.getElementById("edit_contactm").style.display = "none";
            document.getElementById("edit_std").style.display = "none";
            document.getElementById("edit_slevel").style.display = "none";

            document.getElementById("completename").style.display = "block";
            document.getElementById("completenamem").style.display = "block";
            document.getElementById("completenamef").style.display = "block";
            document.getElementById("genderb").style.display = "block";
            document.getElementById("addressb").style.display = "block";
            document.getElementById("contactb").style.display = "block";
            document.getElementById("contactf").style.display = "block";
            document.getElementById("contactm").style.display = "block";
            document.getElementById("idsp").style.display = "block";
            document.getElementById("std_idb").style.display = "block";
            document.getElementById("slevel").style.display = "block";

            document.getElementById("edit_btns").style.display = "none";
            document.getElementById("edit").style.display = "block";

            setTimeout(function(){               
                window.location.href = "view-student?id=" + idx;
            }, 3000);
        },
    });     
}
/* // Edit Student Command */

/* Book Command */
function insertdata_book(){
    var coursex = document.getElementById("book").value;
    var description = document.getElementById("description").value;
    var program = document.getElementById("price").value;
    $.ajax({
        type: "POST",
        url: "../../controls/functions/adm_command.php",
        data: {"coursex": coursex, "description": description, "price": program},
       success: function(html){
            $('#idsp').html(html);
        },
    });     
    }
/* // Book Command */
