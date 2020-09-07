function check_input()
{
    if (!document.loginSbmt.id.value)
    {
        alert("아이디를 입력하세요");    
        document.loginSbmt.id.focus();
        return;
    }

    if (!document.loginSbmt.pass.value)
    {
        alert("비밀번호를 입력하세요");    
        document.loginSbmt.pass.focus();
        return;
    }
    document.loginSbmt.submit();
}