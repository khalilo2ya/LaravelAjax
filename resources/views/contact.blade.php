<!DOCTYPE html>
<html>

<head>
    <title>Laravel 8 Ajax Form Submit using jQuery Validation and sweetalert2 </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2>Laravel 8 Ajax Form Submit using jQuery Validation and sweetalert2 </h2>
            </div>
            <div class="card-body">
                <form name="contactUsForm" enctype="multipart/form-data" id="contactUsForm" method="post" action="javascript:void(0)">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="avatar">Select image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Message</label>
                        <textarea name="message" id="message" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit">Send message</button>
                </form>
            </div>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // add new employee ajax request
            $("#contactUsForm").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#submit").text('Sending...');
                $("#submit").attr("disabled", true);
                $.ajax({
                url: '{{url("store-data-json")}}',
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    console.log(response);

                    if (response.status == 200) {
                        Swal.fire(
                            'Sent!',
                            'Messege sent Successfully!' ,
                            'success'
                            )
                    }
                    if (response.status == 403) {
                        Swal.fire(
                            'Error!',
                            'Messege not sent try again!' ,
                            'error'
                            )
                    }
                    if (response.status == 413) {
                        Swal.fire(
                            'Error!',
                            'Messege not sent or image too large try again!' ,
                            'error'
                            )

                    }

                    $("#submit").text('Send message');
                    $("#submit").attr("disabled", false);
                    $("#contactUsForm")[0].reset();
                }
                });
            });
    </script>
</body>

</html>
