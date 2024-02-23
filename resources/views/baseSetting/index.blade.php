    @extends('layouts.main')
    @section('title', 'LARAVEL | BASE SETTINGS')
    @section('content')
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0"></h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a>
                                    </li>
                                    <li class="breadcrumb-item active"></li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card p-3">
                            <div class="card-header">
                                <h4 class="card-title">Add Base Setting</h4>
                            </div>
                            <form id="save_base">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="brand_name">Enter Brand Name</label>
                                    <input name="brand_name" id="brand_name" placeholder="enter name"
                                        value="{{ $footerContent->brand_name ?? '' }}" class="form-control" rows="4">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="company_name">Enter Company Name</label>
                                    <input name="company_name" id="company_name" placeholder="enter name"
                                        value="{{ $footerContent->company_name ?? '' }}" class="form-control"
                                        rows="4" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="logo" class="form-label">Enter Logo</label>
                                    <input type="file" accept="image/*" id="logo" name="logo"
                                        class="form-control" placeholder="Enter Banner Image" />
                                </div>

                                <div class="form-group mb-3">
                                    <label for="favicon" class="form-label">Enter Favicon</label>
                                    <input type="file" accept="image/*" id="favicon" name="favicon"
                                        class="form-control" placeholder="Enter Banner Image" />
                                </div>

                                <button type="submit" id="save_btn" class="btn text-center mt-3 btn-primary">Save</button>
                            </form>

                        </div>
                    </div>
                </div>

                {{-- <div class="row">

                    <div class="col-xl-8">
                        <div class="card p-3">
                            <div class="card-header">
                                <h4 class="card-title">Add Base Setting</h4>
                            </div>

                            @if (!empty($footerContent->logo))
                                <div class="col-sm-6">
                                    <img src="{{ url('assets/application/logo/' . $footerContent->logo) }}" alt="Image"
                                        class="img-fluid">
                                </div>
                            @endif

                            @if (!empty($footerContent->favicon))
                                <div class="col-sm-6">
                                    <img src="{{ url('assets/application/favicon/' . $footerContent->favicon) }}"
                                        alt="Image" class="img-fluid">
                                </div>
                            @endif
                            <div class="col-sm-6">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © .
                                {{ $footerContent->footer_company ?? 'No content available' }}
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    {{ $footerContent->footer_service ?? 'No content available' }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div> --}}
            </div>
        @endsection


        @section('modal')
            @include('_includes.modals.delete_modal')
            @include('_includes.modals.edit_modal')
        @endsection


        @push('scripts')
            <script src="{{ url('assets/js/main/delete.js') }}"></script>
            <script src="{{ url('assets/js/main/edit.js') }}"></script>

            <script>
                $('#save_base').submit(function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);
                    formData.append('logo', $('#logo')[0].files[0]);
                    formData.append('favicon', $('#favicon')[0].files[0]);

                    $.ajax({
                        url: "{{ route('base.store') }}",
                        method: "POST",
                        data: formData,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        cache: false,
                        beforeSend: function() {
                            $('#save_btn').attr('disabled', true);
                            $('#save_btn').html(window.spinner);
                        },
                    }).done((response, statusText, xhr) => {
                        $(".error-text").text("");
                        $(".form-control").removeClass("is-invalid");
                        $('#save_btn').removeAttr('disabled');
                        $('#save_btn').html('submit');

                        if (xhr.status == 201) {
                            toastr(response.message, "bg-success");
                            location.reload();
                        }
                        if (xhr.status == 200) {
                            toastr(response.message, "bg-success");
                            location.reload();
                        }
                        $("#createRecordModal").modal("hide");
                    }).fail((error) => {
                        $(".error-text").text("");
                        $(".form-control").removeClass("is-invalid");
                        $('#save_btn').removeAttr('disabled');
                        $('#save_btn').html('submit');

                        if (error.status == 422) {

                            $.each(error.responseJSON, function(key, val) {
                                $("#" + key).addClass("is-invalid");
                                $("#" + key + "_error").text(val[0]);
                            });
                        } else {
                            toastr(error.responseJSON.message, "bg-danger");
                        }
                    });
                });
            </script>

            <script>
                function previewImage(input) {
                    var file = input.files[0];

                    if (file) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            document.getElementById('image-preview').setAttribute('src', e.target.result);
                            document.getElementById('image-preview-container').style.display = 'block';
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // If no file is selected, hide the image preview
                        document.getElementById('image-preview-container').style.display = 'none';
                    }
                }
            </script>
        @endpush
