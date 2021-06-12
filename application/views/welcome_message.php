<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- Toastr CSS -->
	<link rel="stylesheet" href="https:////cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>CodeIgniter AJAX CRUD</title>
</head>
<body>
	<!-- Dashboard -->
    <div class="container">
		<!-- Header row -->
		<div class="row">
			<div class="col-md-12 mt-5">
				<h1 class="text-center">CodeIgniter AJAX CRUD</h1>
				<hr style="background-color: black; color: black; height: 1px;">
			</div>
		</div>

		<!-- Add Modal -->
		<div class="row">
			<div class="col-md-12 mt-2">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
					Add records
				</button>

				<!-- Add Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="" method="post" id="form">
									<div class="form-group">
										<label for="">Name</label>
										<input type="text" id="name" class="form-control">
									</div>
									<div class="form-group">
										<label for="">Email</label>
										<input type="email" id="email" class="form-control">
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
								<button type="button" class="btn btn-primary" id="add">ADD</button>
							</div>
						</div>
					</div>
				</div>

				<!-- Edit Modal -->
				<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Edit Modal</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="" method="post" id="form">
									<input type="hidden" name="edit_modal_id" id="edit_modal_id" value="">
									<div class="form-group">
										<label for="">Name</label>
										<input type="text" id="edit_name" class="form-control">
									</div>
									<div class="form-group">
										<label for="">Email</label>
										<input type="email" id="edit_email" class="form-control">
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
								<button type="button" class="btn btn-primary" id="update">UPDATE</button>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

		<!-- Display table -->
		<div class="row">
			<div class="col-md-12 mt-3">
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="tbody">
					</tbody>
				</table>
			</div>
		</div>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<!-- Toastr JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

	<!-- SweetAlert JS -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- jQuery AJAX Code -->
	<script>
		// if add btn is clicked, then execute function
		$(document).on("click", "#add", function(e){
			e.preventDefault();
			
			// get data from form => from ids
			var name = $("#name").val();
			var email = $("#email").val();

			if(name == "" || email == "")
				alert("All fields are required");
			else
			{
				$.ajax({
					url: "<?php echo base_url(); ?>insert",
					type: "post",
					dataType: "json",
					data: 
					{
						name: name,
						email: email
					},
					success: function(data)
					{
						fetch();

						$("#exampleModal").modal("hide");

						if (data.response == "success") 
						{
							toastr["success"](data.message);

							toastr.options = 
							{
								"closeButton": true,
								"debug": false,
								"newestOnTop": false,
								"progressBar": true,
								"positionClass": "toast-top-right",
								"preventDuplicates": false,
								"onclick": null,
								"showDuration": "300",
								"hideDuration": "1000",
								"timeOut": "5000",
								"extendedTimeOut": "1000",
								"showEasing": "swing",
								"hideEasing": "linear",
								"showMethod": "fadeIn",
								"hideMethod": "fadeOut"
							}
						}
						else
						{
							toastr["error"](data.message);

							toastr.options = 
							{
								"closeButton": true,
								"debug": false,
								"newestOnTop": false,
								"progressBar": true,
								"positionClass": "toast-top-right",
								"preventDuplicates": false,
								"onclick": null,
								"showDuration": "300",
								"hideDuration": "1000",
								"timeOut": "5000",
								"extendedTimeOut": "1000",
								"showEasing": "swing",
								"hideEasing": "linear",
								"showMethod": "fadeIn",
								"hideMethod": "fadeOut"
							}
						}
					}
				});
			}

			$("#form")[0].reset();
		});

		// fetch all records
		function fetch()
		{
			$.ajax({
				url: "<?php echo base_url(); ?>fetch",
				type: "post",
				dataType: "json",
				success: function(data)
				{
					var tbody = "";
					var i = 1;

					for(var key in data)
					{
						tbody += "<tr>";
						tbody += "<td>" + i++ + "</td>";
						tbody += "<td>" + data[key]['name'] + "</td>";
						tbody += "<td>" + data[key]['email'] + "</td>";
						tbody += '<td><a href=# id=del class="btn btn-sm btn-outline-danger" value="'+data[key]['id']+'"><i class="fa fa-trash"></i></a> &nbsp;&nbsp;&nbsp; <a href=# id=edit class="btn btn-sm btn-outline-info" value="'+data[key]['id']+'"><i class="fa fa-edit"></i></a></td>';
						tbody += "</tr>";
					}
					$("#tbody").html(tbody);
				}
			});
		}
		
		fetch();

		// delete record
		$(document).on("click", "#del", function(e){
			e.preventDefault();

			var del_id = $(this).attr("value");

			if(del_id == "")
				alert("Delete id required");
			else
			{
				const swalWithBootstrapButtons = Swal.mixin({
					customClass: 
					{
						confirmButton: 'btn btn-success',
						cancelButton: 'btn btn-danger mr-2'
					},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Yes, delete it!',
					cancelButtonText: 'No, cancel!',
					reverseButtons: true
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: "<?php echo base_url(); ?>delete",
							type: "post",
							dataType: "json",
							data:
							{
								del_id: del_id
							},
							success: function(data)
							{
								fetch();
								if(data.response == "success")
								{
									swalWithBootstrapButtons.fire(
										'Deleted!',
										'Your file has been deleted.',
										'success'
									)
								}
							}
						})
					} else if (
						/* Read more about handling dismissals below */
						result.dismiss === Swal.DismissReason.cancel
					) {
						swalWithBootstrapButtons.fire(
							'Cancelled',
							'Your imaginary file is safe :)',
							'error'
						)
					}
				})
			}
		});

		// edit record
		$(document).on("click", "#edit", function(e){
			e.preventDefault();

			var edit_id = $(this).attr("value");

			if(edit_id == "")
				alert("Edit id required");
			else
			{
				$.ajax({
					url: "<?php echo base_url(); ?>edit",
					type: "post",
					dataType: "json",
					data:
					{
						edit_id: edit_id
					},
					success: function(data)
					{
						if (data.response == "success")
						{
							$("#editModal").modal("show");

							$("#edit_modal_id").val(data.post.id);
							$("#edit_name").val(data.post.name);
							$("#edit_email").val(data.post.email);
						}
						else
						{
							toastr["error"](data.message);

							toastr.options = 
							{
								"closeButton": true,
								"debug": false,
								"newestOnTop": false,
								"progressBar": true,
								"positionClass": "toast-top-right",
								"preventDuplicates": false,
								"onclick": null,
								"showDuration": "300",
								"hideDuration": "1000",
								"timeOut": "5000",
								"extendedTimeOut": "1000",
								"showEasing": "swing",
								"hideEasing": "linear",
								"showMethod": "fadeIn",
								"hideMethod": "fadeOut"
							}
						}
					}
				})
			}
		});

		// update record
		$(document).on("click", "#update", function(e){
			e.preventDefault();

			var edit_id = $("#edit_modal_id").val();
			var edit_name = $("#edit_name").val();
			var edit_email = $("#edit_email").val();

			if(edit_id == "" || edit_name == "" || edit_email == "")
				alert("All fields are required");
			else
			{
				$.ajax({
					url: "<?php echo base_url(); ?>update",
					type: "post",
					dataType: "json",
					data:
					{
						edit_id: edit_id,
						edit_name: edit_name,
						edit_email: edit_email
					},
					success: function(data)
					{
						fetch();
						
						if(data.response == "success")
						{
							$("#editModal").modal("hide");

							toastr["success"](data.message);

							toastr.options = 
							{
								"closeButton": true,
								"debug": false,
								"newestOnTop": false,
								"progressBar": true,
								"positionClass": "toast-top-right",
								"preventDuplicates": false,
								"onclick": null,
								"showDuration": "300",
								"hideDuration": "1000",
								"timeOut": "5000",
								"extendedTimeOut": "1000",
								"showEasing": "swing",
								"hideEasing": "linear",
								"showMethod": "fadeIn",
								"hideMethod": "fadeOut"
							}
						}
						else
						{
							toastr["error"](data.message);

							toastr.options = 
							{
								"closeButton": true,
								"debug": false,
								"newestOnTop": false,
								"progressBar": true,
								"positionClass": "toast-top-right",
								"preventDuplicates": false,
								"onclick": null,
								"showDuration": "300",
								"hideDuration": "1000",
								"timeOut": "5000",
								"extendedTimeOut": "1000",
								"showEasing": "swing",
								"hideEasing": "linear",
								"showMethod": "fadeIn",
								"hideMethod": "fadeOut"
							}
						}
					}
				})
			}
		});
	</script>
</body>
</html>