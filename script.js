	$(document).ready(function(){
		
		findAllUsers();

		function findAllUsers(){
			$.ajax({
				url:'action.php',
				type: 'post',
				data:{action:'view'},
				success:function(response){
					$("#table-list").html(response);
					$(".table").DataTable({
						order: [0, 'desc']
					});
				}
			})
		}

        // Adding a user
		$(document).on('click', '#add-btn', function(e){
            e.preventDefault();
            $("#user-form")[0].checkValidity();
			const fname = $('#fname').val();
			const lname = $('#lname').val();
			const email = $('#email').val();
			const phone = $('#tel').val();

			if(fname == ''|| lname == ''|| email == ''|| phone == '') {
				alert("All fields needs to be filled");
			} else {
				$.ajax({
					url:'action.php',
					type:'POST',
					data:{fname:fname, lname:lname, email:email, phone:phone, action:'insert'},
					success:function(response){
						if (response == 'Inserted') {
							Swal.fire({
								title: 'User Added Successfully',
								icon: 'success',
							});
							$("#user-form")[0].reset();
							$("#add-modal").modal('hide');
							findAllUsers();
                        } 
                        else {
                            Swal.fire({
								title: 'Email already registered...try another',
								icon: 'error',
							});
							
                        }

					}
				})
			}
		});

        // Editing a user
		$(document).on("click", ".editbtn",function(e){
			e.preventDefault();
			const edit_id = $(this).attr("id");
			$.ajax({
				url:"action.php",
				type:"POST",
				data:{user_edit_id:edit_id},
				success:function(resp){
					let data = JSON.parse(resp);
					
					$("#id").val(data.id);
					$("#edit_fname").val(data.firstname);
					$("#edit_lname").val(data.lastname);
					$("#edit_email").val(data.email);
					$("#edit_tel").val(data.phone);
				}
			});
		});


        // Updating a user
		$(document).on('click', '#update-btn', function(e){
			e.preventDefault();
			let id = $("#id").val();
			let fname = $("#edit_fname").val();
			let lname = $("#edit_lname").val();
			let email = $("#edit_email").val();
			let phone = $("#edit_tel").val();

			if (fname == '' || lname == '' || email == '' || phone == '') {
				alert('Please fill all fields');
			}else {

				Swal.fire({
					title:"Are you sure?",
					text:'You won\'t be able to revert this',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: 'green',
					cancelButtonColor: 'red',
					confirmButtonText: "Yes, Update"
				}).then((result) => {
					if (result.value) {
						$.ajax({
							url:'action.php',
							type:'POST',
							data:{id:id, firstname:fname, lastname:lname, email:email, phone:phone, action:'update'},
							success:function(result){
								if (result == 'success') {
									Swal.fire({
										position:'top',
										title:'User Updated',
										icon:'success',
										showConfirmButton: false,
										timer: 1500
									})
									$("#edit-modal").modal('hide');
									findAllUsers();
									
								}
							}
						})
					}
				})

				
			}
			
		});


        // Deleting a user
		$(document).on('click', '.delbtn', function(e){
			e.preventDefault();
			let id = $(this).attr('id');
			// alert(id);
			Swal.fire({
				title: 'Are you sure?',
				text:'You won\'t be able to revert this',
				icon:'warning',
				showCancelButton:true,
				cancelButtonColor:'red',
				confirmButtonColor:'green',
				confirmButtonText: 'Yes, Delete it'
			}).then((result) => {
				if(result.value) {
					$.ajax({
						url:'action.php',
						type:'POST',
						data:{delete_id:id},
						success:function(resp){
							if (resp == 'deleted'){
								Swal.fire({
									position: 'top',
									title:'User deleted',
									icon: 'success',
									showConfirmButton: false,
									timer: 1000
								})
								
								findAllUsers();
							}
						}
					})
				}
			})
			
        })
        

        // Viewing a user
        $(document).on('click', '.infobtn', function(e){
            e.preventDefault();
            let id = $(this).attr("id");
            $.ajax({
                url:'action.php',
                type:'POST',
                data:{user_info_id:id},
                success:function(user_resp){
                    data = JSON.parse(user_resp);
                    Swal.fire({
                        title: '<strong>User Info: ID('+data.id+')</strong>',
                        icon: 'info',
                        html: '<b>First Name: </b>'+data.firstname+'<br><b>Lastname: </b>'
                            +data.lastname+'<br><b>Email: </b>'+data.email+'<br><b>Phone: </b>'+data.phone,
                        
                    })
                }
            })
        })

	});

