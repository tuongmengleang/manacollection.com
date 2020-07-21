$(document).ready(function () {
  // Preview image before upload
  // drag & drop js
  var drop = $("#logo");
  drop.on('dragenter', function (e) {
    $(".drop").css({
      "border": "2px dashed #FE8A7D",
      "background": "rgba(0, 153, 255, .05)"
    });
    $(".cont").css({
      "color": "#09f"
    });
  }).on('dragleave dragend mouseout drop', function (e) {
    $(".drop").css({
      "border": "2px dashed #FE8A7D",
      "background": "transparent"
    });
    $(".cont").css({
      "color": "#8E99A5"
    });
  });

  // function reader single file
  function readURL(input) {
    if(input.files && input.files[0]){
      var reader = new FileReader();
      reader.onload = function (theFile) {
        var size =(input.files[0].size / (1024 * 1024)).toFixed(2);
        var filename = input.files[0].name;
        var title = escape(theFile.name);
        $('.thumbnail').removeClass("d-none");
        $('.thumbnail-img-own').addClass("d-none");
        $('.thumbnail-img').removeClass("d-none");
        $('.thumbnail-img').attr('src', theFile.target.result);
        $('.thumbnail-img').attr('title', title);
        $(".thumbnail span").removeClass("d-none");
        $('#size').text(size);
        $('.size').removeClass("d-none");
        $('#filename').text(filename);
        $('#filename').removeClass("d-none");
        // console.log(input.files[0]);
      };
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $('#logo').change(function () {
    readURL(this);
  });
});
