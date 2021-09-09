$(function() {
  'use strict';
  $('#videoFile').change(ev => {
      $(ev.target).closest('form').trigger('submit');
  });


  // $("#modalButton").click(function(e){
  //     e.preventDefault();
  //     $("#create-modal").modal("show").find("#modalContent").load($(this).attr("href"));
  // });
  function ajax(type,url,processData,contentType,form,callback)
	{
		var result;
		$.ajax
		({
			type: type, //THIS NEEDS TO BE GET
			url: url,
			dataType: 'json',
			data: form,
			async: false, // to make js wait unitl ajax finish
			processData: processData,
			contentType: contentType,

			success: function (data) 
			{
				//console.log(data);
				//$(section).load(link +" "+ contanier);
				result = data;
			},
			error:function(data)
			{ 
				//console.log(data);
				//console.log(data.responseJSON);
				//console.log(data.responseJSON.message);
				result = data;
      }
		});
		return result;

  }
  
  $(document).on('submit','#modal_create',function(e){

	  e.preventDefault();
	  console.log("aaa");
      let url = $(this).data('href');
      let type='post';
      let processData = false;
      let contentType = false;
      let formData = new FormData($(this)[0]);

	  let response = ajax(type,url,processData,contentType,formData);
	  console.log(response);
    //   if(result.success == "success")
    //   {
	// 	  console.log("success");
	// 	  $("#main-section").load(location.href +" #main-section");
	//   }
	//   else
	//   {
	// 	  console.log(response);
	//   }


  });

});
