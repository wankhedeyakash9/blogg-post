$(".form-toggle").click(function()
{
    if($(".form-signin").parent().css("display")=="block")

    $(".form-signin").parent().slideUp("",function()
    {
        $(".form-signup").parent().slideDown();
    });
    
    else
        $(".form-signup").parent().slideUp("",function()
        {
            $(".form-signin").parent().slideDown();
        });
})



function validate()
{
    
    // alert();
    if($(".form-signup  #inputPassword").val() != $(".form-signup  #inputCPassword").val() )
    {
        $(".form-signup  #inputCPassword").css( "border", "2px solid red" )
        $("#validation-msg").text("Passwords didn't match").css('color', "red")
        
        return false
    }
    else if($(".form-signup  #inputPhone").val().length!=10)
    {
        $(".form-signup  input").css( "border", "1px solid rgb(206, 212, 218)")
        $(".form-signup  #inputPhone").css( "border", "2px solid red" )
        $("#validation-msg").text("Phone number should contain 10 digits").css('color', "red")
        return false
    }
    else if($(".form-signup #inputPassword").val().length < 8)
    {
        $(".form-signup  input").css( "border", "1px solid rgb(206, 212, 218)")

        $(".form-signup  #inputCPassword, .form-signup  #inputPassword ").css( "border", "2px solid red" )
        $("#validation-msg").text("Password must contain atleast 8 characters").css('color', "red")
        return false
    }
    $(".form-signup").submit();

}

$(".form-signup  #inputCPassword").keyup(function(){

    if($(".form-signup  #inputPassword").val() != $(".form-signup  #inputCPassword").val() )
    
        $("#validation-msg").text("Passwords didn't match").css('color', "red");
    else 
        $("#validation-msg").text("Passwords matched").css('color', "green");


})