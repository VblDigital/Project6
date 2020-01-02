//For images
var $collectionImageHolder;

var $addImageButton = $('<button type="button" class="add_image">Ajouter une nouvelle image</button>');
var $newLinkImage = $('<p></p>').append($addImageButton);

function addImageForm($collectionImageHolder, $newLinkImage) {
    var imagePrototype = $collectionImageHolder.data('prototype-image');

    var imageIndex = $collectionImageHolder.data('imageIndex');

    var newImageForm = imagePrototype;

    newImageForm = newImageForm.replace(/__name__/g, imageIndex);

    $collectionImageHolder.data('imageIndex', imageIndex + 1);

    var $newFormImage = $('<p></p>').append(newImageForm);
    $newLinkImage.before($newFormImage);
}

jQuery(document).ready(function() {
    $collectionImageHolder = $('div.images');
    $collectionImageHolder.append($newLinkImage);
    $collectionImageHolder.data('imageIndex',$('.startIndex').val());

    $addImageButton.on('click', function(e) {
        addImageForm($collectionImageHolder, $newLinkImage);
    });
});

//For videos
var $collectionVideoHolder;

var $addVideoButton = $('<button type="button" class="add_video_link">Ajouter un lien vers une vidéo</button>');
var $newLinkVideo = $('<p></p>').append($addVideoButton);

function addVideoForm($collectionVideoHolder, $newLinkVideo) {
    var videoPrototype = $collectionVideoHolder.data('prototype-video');

    var videoIndex = $collectionVideoHolder.data('videoIndex');

    var newVideoForm = videoPrototype;
    newVideoForm = newVideoForm.replace(/__name__/g, videoIndex);

    $collectionVideoHolder.data('videoIndex', videoIndex + 1);

    var $newFormVideoLi = $('<p></p>').append(newVideoForm);
    $newLinkVideo.before($newFormVideoLi);
}

jQuery(document).ready(function() {
    $collectionVideoHolder = $('div.videos');
    $collectionVideoHolder.append($newLinkVideo);
    $collectionVideoHolder.data('videoIndex',$('.startIndex').val());

    $addVideoButton.on('click', function(e) {
        addVideoForm($collectionVideoHolder, $newLinkVideo);
    });
});
