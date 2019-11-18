//For images
var $collectionImageHolder;

var $addImageButton = $('<button type="button" class="add_image">Ajouter une nouvelle image</button>');
var $newLinkImage = $('<p></p>').append($addImageButton);

jQuery(document).ready(function() {
    $collectionImageHolder = $('div.images');
    $collectionImageHolder.append($newLinkImage);
    $collectionImageHolder.data('index', $collectionImageHolder.find(':input').length);

    $addImageButton.on('click', function(e) {
        addImageForm($collectionImageHolder, $newLinkImage);
    });
});

function addImageForm($collectionImageHolder, $newLinkImage) {
    var imagePrototype = $collectionImageHolder.data('prototype-image');

    var imageIndex = $collectionImageHolder.data('imageIndex');

    var newImageForm = imagePrototype;
    newImageForm = newImageForm.replace(/__name__label__/g, 'Sélectionner une image');

    $collectionImageHolder.data('imageIndex', imageIndex + 1);

    var $newFormImage = $('<p></p>').append(newImageForm);
    $newLinkImage.before($newFormImage);
}

//For videos
var $collectionVideoHolder;

var $addVideoButton = $('<button type="button" class="add_video_link">Ajouter un lien vers une vidéo</button>');
var $newLinkVideo = $('<p></p>').append($addVideoButton);

jQuery(document).ready(function() {
    $collectionVideoHolder = $('div.videos');
    $collectionVideoHolder.append($newLinkVideo);
    $collectionVideoHolder.data('index', $collectionVideoHolder.find(':input').length);

    $addVideoButton.on('click', function(e) {
        addVideoForm($collectionVideoHolder, $newLinkVideo);
    });
});

function addVideoForm($collectionVideoHolder, $newLinkVideo) {
    var videoPrototype = $collectionVideoHolder.data('prototype-video');

    var videoIndex = $collectionVideoHolder.data('videoIndex');

    var newVideoForm = videoPrototype;
    newVideoForm = newVideoForm.replace(/__name__label__/g, 'Entrer un lien vers une nouvelle vidéo');

    $collectionVideoHolder.data('videoIndex', videoIndex + 1);

    var $newFormVideoLi = $('<p></p>').append(newVideoForm);
    $newLinkVideo.before($newFormVideoLi);
}
