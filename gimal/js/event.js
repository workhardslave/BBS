/* 댓글 작성 이벤트(ajax) */
$(function(){
	$("#rep_btn").click(function(){
		$.ajax({				//비동기통신방법, 객체로 보낼때{}사용
			url : "reply_ok.php",
			type : "post",
			data : {
				"bno" : $(".bno").val(),
				"dat_user" : $(".dat_user").val(),
				"dat_pw" : $(".dat_pw").val(),
				"rep_con" : $(".rep_con").val(),
			},
			success : function(data){
//				$(".reply_view").html(data);
				alert("댓글이 작성되었습니다");
				location.reload();
			}
		});
	});


	/* 댓글 삭제 이벤트 */
	$(".dat_del_btn").click(function(){
		
		console.log("먹나요?");
		$("#rep_modal_del").modal();
		
	});
	
		
});