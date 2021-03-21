@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body" id="listBox">

                            <div class="loading"></div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width:20%">Name</th>
                                <th style="width:20%">Email</th>
                                <th style="width:20%">Select All&nbsp;<input type="checkbox" class="checkAll"></th>
                                <th style="width:40%"><a href="" id="viewActivity" class="btn btn-primary float-right" data-toggle="modal" data-target='#view-modal' data-backdrop='static' data-keyboard='false'>Send Email</a>
</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($subscribers) && $subscribers->count())
                                @foreach($subscribers as $key => $value)
                                    <tr>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td><input type="checkbox" class="checkBoxClass" name="checked" value="{{$value->id}}"></td>


                                        <td class="text-center">
                                            <form action="/destroy/{{ $value->id}}" method="post">
                                                @csrf
                                                
                                                <button class="btn btn-danger" type="submit"><strong>X</strong></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">No data found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {!! $subscribers->links() !!}
                        <div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="view-modal-label" aria-hidden="true">

                                <div class="modal-dialog modal-lg" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-modal-label">Send Email</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="attachment-body-content">
                                        <input type="hidden" id="id" name="id" value="">
                                        <div class="card mb-0">
                                            <div class="card-body">

                                                <div class="form-group">
                                                    <label class="col-form-label" for="user_name">Subject</label>
                                                    <input type="text" name="subject" class="form-control" id="subject" >
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label" for="type">Message</label>
                                                    <textarea  name="message" class="form-control" id="message"></textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary"  data-dismiss="modal" onClick="submit()" >Submit</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'message' );
    $(document).ready(function () {
        $(".checkAll").click(function () {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        });
        $('#view_modal').modal({backdrop: 'static', keyboard: false})
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function submit() {
        event.preventDefault();
       if( $("#subject").val() && CKEDITOR.instances.message.getData()) {
           $('.loading').html('<div class="alert alert-success" role="alert">Loading...! Please wait<div>');
           var values = [];
           $.each($("input[name='checked']:checked"), function(){
               values.push($(this).val());
           });
          $.ajax({
              url: "/sendEmail",
              type: "POST",
              data: {'mailValues':values,'message':CKEDITOR.instances.message.getData(),'subject':$("#subject").val()},
              success: function (result) {
                  alert('Email sent successfully!');
                  window.location.reload(true);
              }
          });
      }else{
         alert('Please enter subject & message!');
          $('#view_modal').modal('show');
      }

    }
    $("#viewActivity").on('click', function () {

    if(!$('#listBox input[type=checkbox]:checked').length){
        alert("Select atleast one subscriber");
        return false;
    }
    });
</script>
@endpush