$(document).ready(function(e){

    let $uploadfile=$('#register .upload-profile-image input[type="file"]');
    $uploadfile.change(function(){
        readURL(this);
    });
    
    function checkEmail() {
            var email = document.getElementById('email');
            var filter = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!filter.test(email.value)) {
                email.focus;
                return false;
            }
        }
    
    $("#reg-form").submit(function(event){
        let $password=$("#password");
        let $confirm=$("#confirm_pwd");
        let $error=$("#confirm_error");
        let $email_error=$("#email_error");
        if(checkEmail()==false){
            $email_error.text("Not a correct e-mail address");
            event.preventDefault();
            if($password.val()!=$confirm.val()){
                $error.text("Passwords did not match");
                event.preventDefault();
            }
        }
        else{
            if($password.val()==$confirm.val()){
                return true;
            }
            else{
                $error.text("Passwords did not match");
                event.preventDefault();
            }
        }
    });
});

function readURL(input){
    if(input.files && input.files[0])
    {
        let reader=new FileReader();
        reader.onload=function(e){
            $("#register .upload-profile-image .img").attr('src',e.target.result);
            $("#register .upload-profile-image .camera-icon").css({display:"none"});
        }

        reader.readAsDataURL(input.files[0]);
    }
}