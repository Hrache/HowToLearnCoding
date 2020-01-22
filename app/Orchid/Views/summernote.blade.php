@push('head')
<link rel="stylesheet" href="{{ asset('/plugins/summernote-editor/summernote-bs4.css') }}" />
@endpush

@push('scripts')
<script src="{{ asset('/plugins/summernote-editor/summernote-bs4.min.js') }}"></script>
<script>
var tareaid = $('#post-form textarea').first().attr('id');
$('#'+tareaid).summernote({

 toolbar: [
  // [groupName, [list of button]]
 	['style', ['style']],
  ['font', ['bold', 'underline', 'clear']],
  ['fontname', ['fontname']],
  ['color', ['color']],
  ['para', ['ul', 'ol', 'paragraph']],
  ['table', ['table']],
  ['view', ['fullscreen', 'codeview', 'help']],
//['insert', ['link', 'picture', 'video']],
 ]

});
</script>
@endpush