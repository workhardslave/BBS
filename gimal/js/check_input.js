function check_input() {

      if (!document.write_form.title.value)
      {
          alert("제목을 입력하세요!");
          document.write_form.title.focus();
          return;
      }
      if (!document.write_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.write_form.content.focus();
          return;
      }
 
      document.write_form.submit();
   }