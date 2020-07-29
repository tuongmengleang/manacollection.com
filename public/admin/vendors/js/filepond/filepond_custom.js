/*
We want to preview images, so we need to register the Image Preview plugin
*/
FilePond.registerPlugin(

  // encodes the file as base64 data
  FilePondPluginFileEncode,

  // validates the size of the file
  FilePondPluginFileValidateSize,

  // corrects mobile image orientation
  FilePondPluginImageExifOrientation,

  // previews dropped images
  FilePondPluginImagePreview,

  // crop image
  FilePondPluginImageEdit,
  FilePondPluginImageCrop,
  FilePondPluginImageTransform,
);

