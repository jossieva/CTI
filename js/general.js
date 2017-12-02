function redirectPage(page){
				$.get("vista/admin/"+page+".php", function(data){
					$('#pagePrimary').html(data).trigger("create");
				},'html');
			}