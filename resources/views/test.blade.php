<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=UTF-8>
    <title>Document</title>
</head>
<body>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  
    <textarea name=text id="text" cols="30" rows="10"></textarea>
    <script src={{ url('editor/ckeditor/ckeditor.js') }}></script>
    <script>
    CKEDITOR.replace( 'text');
    // CKEDITOR.replace( 'text', {
        // filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
        // filebrowserBrowseUrl: '{{ asset('editor/ckfinder/ckfinder.html') }}',
        // filebrowserImageBrowseUrl: '{{ asset('editor/ckfinder/ckfinder.html?type=Images') }}',
        // filebrowserFlashBrowseUrl: '{{ asset('editor/ckfinder/ckfinder.html?type=Flash') }}',
        // filebrowserUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        // filebrowserImageUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        // filebrowserFlashUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        

    // } );
    </script>
</body>
</html>