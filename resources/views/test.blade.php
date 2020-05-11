<!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <title>CKFinder 3</title>
     <script src={{ url('editor/ckfinder/ckfinder.js') }}></script>
 </head>
 <body>
     <script>
         function openPopup() {
             CKFinder.popup( {
                 chooseFiles: true,
                 onInit: function( finder ) {
                     finder.on( 'files:choose', function( evt ) {
                         var file = evt.data.files.first();
                         document.getElementById( 'url' ).src = file.getUrl();
                         document.getElementById( 'url1' ).value = file.getUrl();
                         console.log(file.getUrl());
                     } );
                     finder.on( 'file:choose:resizedImage', function( evt ) {
                         document.getElementById( 'url' ).value = evt.data.resizedUrl;
                         document.getElementById( 'url1' ).value = evt.data.resizedUrl;
                     } );
                 }
             } );
         }
     </script>
     <img name="url" id="url">
     <input type="text" size="48" name="url1" id="url1" /> <button onclick="openPopup()">Select file</button>
 </body>
 </html>