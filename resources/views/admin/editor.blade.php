<script src="{{ asset('/js/ckeditor/ckeditor.js') }}" type="text/javascript" charset="utf-8" ></script>


<div class="form-group form-element-wysiwyg ">
    <label for="content" class="control-label">
        content

    </label>


    <textarea class="form-control" id="content" name="content" cols="50" rows="10">{{ $text->content }}
</textarea>

</div>

<script>
    var editor = CKEDITOR.replace( 'content' );
</script>