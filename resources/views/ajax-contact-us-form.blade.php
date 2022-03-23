<!DOCTYPE html>
<html>

<head>
    <title>Laravel 8 Ajax Form Submit using jQuery Validation and sweetalert2</title>
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
                <h2>Laravel 8 Ajax Form Submit using jQuery Validation and sweetalert2</h2>
            </div>
            <div class="card-body">
                <form name="contactUsForm" enctype="multipart/form-data" id="contactUsForm" method="post" action="javascript:void(0)">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>
                    <div class="my-2">
                        <label for="avatar">Select image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Message</label>
                        <textarea name="message" id="message" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        if ($("#contactUsForm").length > 0) {
            $("#contactUsForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 50
                    },
                    email: {
                        required: true,
                        maxlength: 50,
                        email: true,
                    },
                    message: {
                        required: true,
                        maxlength: 300
                    },
                },
                messages: {
                    name: {
                        required: "Please enter name",
                        maxlength: "Your name maxlength should be 50 characters long."
                    },
                    email: {
                        required: "Please enter valid email",
                        email: "Please enter valid email",
                        maxlength: "The email name should less than or equal to 50 characters",
                    },
                    message: {
                        required: "Please enter message",
                        maxlength: "Your message name maxlength should be 300 characters long."
                    },
                },
                submitHandler: function(form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('#submit').html('Please Wait...');
                    $("#submit").attr("disabled", true);
                    $.ajax({
                        url: "{{url('store-data')}}",
                        type: "POST",
                        data: $('#contactUsForm').serialize(),
                        success: function(response) {
                            $('#submit').html('Submit');
                            $("#submit").attr("disabled", false);
                            Swal.fire(
                                'Message sent!',
                                'Ajax form message contact has been submitted successfully!',
                                'success'
                            )
                            /*alert('Ajax form has been submitted successfully');*/
                            document.getElementById("contactUsForm").reset();


                        }
                    });
                }
            })
        }
    </script>
</body>

</html>
