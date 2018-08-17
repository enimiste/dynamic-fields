@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="w-100 text-center">Tag List</h1>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-3"><h3>New Tags</h3></div>
                <div class="col text-right">
                    <button class="btn btn-dark" id="addFieldBtn">Add Field</button>
                </div>
            </div>
            <hr/>
            <form id="fieldsForm">
                <div class="form-group"  id="fields">
                    <table>
                        <tr id="row_1" class="mb-2">
                            <td class="col align-top"><input type="text" class="form-control" name="names[]" required/></td>
                            <td class="col-2 align-top"><button class="btn btn-danger deleteBtn" title="Delete this input" data-id="1">&times;</button></td>
                        </tr>
                    </table>
                </div>
            </form>
            <button class="btn btn-success col" id="saveBtn">Save</button>
        </div>
        <div class="col-3">
            <h3>Existings Tags</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $.validator.setDefaults({'errorClass': 'error text-danger'})
        $(document).ready(function(){
            var rowNumber = 2;

            $('.deleteBtn').click(function(){
                var id = $(this).data('id');
                $('#row_' + id).remove();
            });

            $('#saveBtn').click(function(){
                var form = $('#fieldsForm');
                form.validate({
                    rules: {
                        'names[]': {
                            required: true,
                            minlength: 3,
                            maxlength: 20
                        }
                    }
                });
                console.log('Form valid', form.valid());
            });

            $('#addFieldBtn').click(function(){
                var tr = document.createElement('tr');
                //Input
                var td = document.createElement('td');
                td.className="col align-top";
                var input = document.createElement('input');
                input.type = 'text';
                input.className="form-control";
                input.name="names[]";
                input.required=true;
                td.append(input);
                tr.append(td);
                //Button
                var td = document.createElement('td');
                td.className="col align-top";
                var btn = document.createElement('button');
                btn.className="btn btn-danger deleteBtn";
                btn.dataset.id = rowNumber;
                btn.innerHTML = '&times;';
                btn.addEventListener('click', function(){
                    tr.remove();
                });
                td.append(btn);
                tr.append(td);

                $('#fields table').append(tr);
                rowNumber++;
            });
        });
    </script>
@endpush
