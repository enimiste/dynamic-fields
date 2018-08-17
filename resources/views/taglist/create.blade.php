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
                <div class="form-group"  id="fields" >
                    <table data-row-number="{{$tags->count() + 1}}">
                        @foreach($tags as $tag)
                            <tr id="row_{{$loop->iteration}}">
                                <td class="col-1 align-top text-center">#{{$loop->iteration}}</td>
                                <td class="col align-top"><input type="text" class="form-control" name="names[{{$loop->iteration}}]" required value="{{$tag->name}}"/></td>
                                <td class="col-2 align-top"><button class="btn btn-danger deleteBtn" title="Delete this input" data-id="{{$loop->iteration}}">&times;</button></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </form>
            <button class="btn btn-success col" id="saveBtn">Save</button>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $.validator.setDefaults({'errorClass': 'error text-danger'})
        $(document).ready(function(){
            $('.deleteBtn').click(function(){
                var id = $(this).data('id');
                $('#row_' + id).remove();
            });

            $('#saveBtn').click(function(){
                var form = $('#fieldsForm');
                form.validate({
                    rules: {
                        'names[*]': {
                            required: true,
                            minlength: 3,
                            maxlength: 200
                        }
                    }
                });
                console.log('Form valid', form.valid());
            });

            $('#addFieldBtn').click(function(){
                var table = $('#fields table');
                var rowNumber = table.data('row-number');
                var tr = document.createElement('tr');
                tr.id = `row_${rowNumber}`;
                //Id
                var td = document.createElement('td');
                td.className="col-1 align-top text-center";
                td.innerHTML = `#${rowNumber}`;
                tr.append(td);
                //Input
                var td = document.createElement('td');
                td.className="col align-top";
                var input = document.createElement('input');
                input.type = 'text';
                input.className="form-control";
                input.name=`names[${rowNumber}]`;
                input.required=true;
                td.append(input);
                tr.append(td);
                //Button
                var td = document.createElement('td');
                td.className="col-2 align-top";
                var btn = document.createElement('button');
                btn.className="btn btn-danger deleteBtn";
                btn.dataset.id = rowNumber;
                btn.innerHTML = '&times;';
                btn.addEventListener('click', function(){
                    tr.remove();
                });
                td.append(btn);
                tr.append(td);

                table.append(tr);
                table.data('row-number', rowNumber + 1);
            });
        });
    </script>
@endpush
