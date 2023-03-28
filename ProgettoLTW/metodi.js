function see_or_unsee_form(){
    var value=document.getElementById("bottone_login").value;
    var form=document.getElementById("my_form");
    if(value=="LOGIN"){
    form.style.display="block";
    document.getElementById("bottone_login").value="CLOSE";
    }
    else{
        document.getElementById("bottone_login").value="LOGIN";
        form.style.display="none";
    }
}