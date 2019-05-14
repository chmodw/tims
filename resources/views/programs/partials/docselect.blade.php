<form class="" method="POST" action="{{route('doc.generate')}}">
    {{ csrf_field() }}
    <input type="hidden" name="program_id"  value="{{$program->program_id}}">
    <input type="hidden" name="program_type"  value="{{$program_type}}">
    <div class="form-group">
        <label for="doc_option">Select Document Type :</label>
        <select name="doc_type" id="doc_option" class="form-control">
            @foreach($available_documents as $doc)
                <option value="{{$doc->id}}">{{$doc->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Generate and Download" class="btn btn-default pull-right">
        <input type="submit" name="submit" value="Generate" class="btn btn-primary margin-right-sm pull-right">
    </div>
</form>